<?php

namespace App\Http\Controllers;

use App\Helpers\Pdfs\PdfDocuments;
use App\Helpers\Tickets\Ticket;
use App\Models\Ndinvoice;
use App\Http\Requests\StoreNdinvoiceRequest;
use App\Http\Requests\UpdateNdinvoiceRequest;
use App\Models\BranchProduct;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\DocumentType;
use App\Models\Employee;
use App\Models\EmployeeInvoiceProduct;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\NdinvoiceProduct;
use App\Models\NdinvoiceResponse;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Resolution;
use App\Models\Tax;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryInvoices;
use App\Traits\KardexCreate;
use App\Traits\GetTaxesLine;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeightNotes;

class NdinvoiceController extends Controller
{
    use InventoryInvoices, KardexCreate, GetTaxesLine;
    /*
    function __construct()
    {
        $this->middleware('permission:ndinvoice.index|ndinvoice.store|ndinvoice.show', ['only'=>['index']]);
        $this->middleware('permission:ndinvoice.store', ['only'=>['create','store']]);
        $this->middleware('permission:ndinvoice.show', ['only'=>['show']]);
    }*/
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ndinvoice = session('ndinvoice');
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas debito a admin y superadmin
                $ndinvoices = Ndinvoice::get();
            } else {
                //Consulta para mostrar notas debito de los demas roles
                $ndinvoices = Ndinvoice::where('user_id', $user->id)->get();
            }
            return DataTables::of($ndinvoices)
            ->addIndexColumn()
            ->addColumn('branch', function (ndinvoice $ndinvoice) {
                return $ndinvoice->branch->name;
            })
            ->addColumn('customer', function (ndinvoice $ndinvoice) {
                return $ndinvoice->third->name;
            })
            ->addColumn('invoice', function (ndinvoice $ndinvoice) {
                return $ndinvoice->invoice->document;
            })

            ->addColumn('user', function (ndinvoice $ndinvoice) {
                return $ndinvoice->user->name;
            })

            ->editColumn('created_at', function(ndinvoice $ndinvoice){
                return $ndinvoice->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ndinvoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ndinvoice.index', compact('ndinvoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNdinvoiceRequest $request)
    {
        //dd($request->all());
        $company = company();
        $configuration = Configuration::findOrFail($company->id);
        $invoice = Invoice::findOrFail($request->invoice_id);//encontrando la factura
        $cashRegister = cashRegisterComprobation();
        $pay = Pay::where('type', 'invoice')->where('payable_id', $invoice->id)->get();//pagos hechos a esta factura

        $voucherTypes = '';
        $resolution = '';
        $documentType = '';
        if (indicator()->dian == 'on') {
            if ($invoice->document_type_id == 1) {
                $resolution = Resolution::findOrFail(9);//NC factura de venta
                $voucherTypes = VoucherType::findOrFail(6);//voucher type FV
                $documentType = DocumentType::findOrFail(5);
            } else if ($invoice->document_type_id == 15) {
                $resolution = Resolution::findOrFail(11);//NC factura de venta pos
                $voucherTypes = VoucherType::findOrFail(22); //voucher type pos
                $documentType = DocumentType::findOrFail(25);
            }
        } else {
            if ($invoice->document_type_id == 1) {
                $resolution = Resolution::findOrFail(9);//NC factura de venta
                $voucherTypes = VoucherType::findOrFail(6);//voucher type FV
                $documentType = DocumentType::findOrFail(5);
            } else if ($invoice->document_type_id == 104) {
                $resolution = Resolution::findOrFail(6);//NC factura de venta pos
                $voucherTypes = VoucherType::findOrFail(22); //voucher type pos
                $documentType = DocumentType::findOrFail(105);
            }
        }

        $typeDocument = 'ndinvoice';
        $quantity = $request->quantity;
        $price = $request->price;
        $total_pay = $request->total_pay;
        $product_id = $request->product_id;
        $discrepancy = $request->discrepancy_id;
        $tax_rate = $request->tax_rate;
        $retention = 0;
        //variables del request
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        //gran total de la compra
        $grandTotalold = $invoice->grand_total;
        $grandTotalNd = $total_pay - $retention;
        $newGrandTotal = $grandTotalold + $grandTotalNd;
        $newBalance = $newGrandTotal - $invoice->pay;

        $branch = $invoice->branch_id;

        //Registrar tabla Nota Credito
        $ndinvoice = new Ndinvoice();
        $ndinvoice->document = $resolution->prefix . $resolution->consecutive;
        $ndinvoice->user_id = current_user()->id;
        $ndinvoice->branch_id = current_user()->branch_id;
        $ndinvoice->invoice_id = $invoice->id;
        $ndinvoice->customer_id = $invoice->customer_id;
        $ndinvoice->resolution_id = $resolution->id;
        $ndinvoice->discrepancy_id = $discrepancy;
        $ndinvoice->voucher_type_id = $voucherTypes->id;
        $ndinvoice->document_type_id = $documentType->id;
        $ndinvoice->cash_register_id = $cashRegister->id;
        $ndinvoice->retention = $retention;
        $ndinvoice->total = $request->total;
        $ndinvoice->total_tax = $request->total_tax;
        $ndinvoice->total_pay = $request->total_pay;
        $ndinvoice->save();

        if (indicator()->pos == 'on') {
            //actualizar la caja
            $cashRegister->ndinvoice += $total_pay;
            $cashRegister->update();
        }

        $service = '';
        $errorMessages = '';
        $store = false;
        if (indicator()->dian == 'on') {
            $data = ndinvoiceData($request, $invoice);
            //dd($data);
            $environment = Environment::where('id', 13)->first();//Url nota de ajuste documento soporte
            $url = $environment->protocol . $configuration->ip . $environment->url;
            $requestResponse = sendDocuments($url, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }

        if ($store == true) {
            switch($discrepancy) {
                case(7):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("invoice");
                    }
                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];
                        //selecciona el producto que viene del array
                        $product = Product::findOrFail($id);

                        $branchProducts = BranchProduct::where('product_id', '=', $id)
                        ->where('branch_id', '=', $branch)
                        ->first();

                        //registrando nota debito productos
                        $ndinvoiceProduct = new NdinvoiceProduct();
                        $ndinvoiceProduct->ndinvoice_id = $ndinvoice->id;
                        $ndinvoiceProduct->product_id = $id;
                        $ndinvoiceProduct->quantity = $quantity[$i];
                        $ndinvoiceProduct->price = $price[$i];
                        $ndinvoiceProduct->tax_rate = $tax_rate[$i];
                        $ndinvoiceProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndinvoiceProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndinvoiceProduct->save();

                        $quantityLocal = $quantity[$i];
                        $priceLocal = $price[$i];
                        //dd($branch);
                        $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                    }
                break;
                case(8):
                    /*
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0 en ningun item.','warning');
                        return redirect("invoice");
                    }*/
                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];

                        $product = Product::findOrFail($id);
                        //registrando nota debito productos
                        $ndinvoiceProduct = new NdinvoiceProduct();
                        $ndinvoiceProduct->ndinvoice_id = $ndinvoice->id;
                        $ndinvoiceProduct->product_id = $id;
                        $ndinvoiceProduct->quantity = $quantity[$i];
                        $ndinvoiceProduct->price = $price[$i];
                        $ndinvoiceProduct->tax_rate = $tax_rate[$i];
                        $ndinvoiceProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndinvoiceProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndinvoiceProduct->save();
                        if (indicator()->work_labor == 'on') {
                            //obtenemos los productos de esta factura que se hace ND
                            $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();

                            for ($i=0; $i < count($invoiceProducts); $i++) {
                                $ideip = $invoiceProducts[$i]->id;

                                $employeeInvoiceProduct = EmployeeInvoiceProduct::where('invoice_product_id', $ideip)->first();
                                if ($employeeInvoiceProduct) {
                                    $idEmployee = $employeeInvoiceProduct->employee_id;
                                    $employee = Employee::findOrFail($idEmployee);
                                    $subtotal = $quantity[$i] * $price[$i];
                                    $commission = $employee->commission;
                                    $valueCommission = ($subtotal/100) * $commission;

                                    $employeeInvoiceProduct->price += $price[$i];
                                    $employeeInvoiceProduct->subtotal += $subtotal;
                                    $employeeInvoiceProduct->value_commission += $valueCommission;
                                    $employeeInvoiceProduct->update();
                                }
                            }
                        }
                    }
                break;
            }

            $document = $ndinvoice;
            $quantityBag = 0;
            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);//Helper para impuestos de linea
            retentions($request, $document, $typeDocument);//Helper para retenciones

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            $invoice->grand_total = $newGrandTotal;
            $invoice->balance = $newBalance;
            if ($invoice->status == 'invoice') {
                $invoice->status = 'debit_note';
            } elseif ($invoice->status == 'credit_note') {
                $invoice->status = 'complete';
            }
            $invoice->update();

            if (indicator()->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $ndinvoiceResponse = new NdinvoiceResponse();
                $ndinvoiceResponse->document = $invoice->document;
                $ndinvoiceResponse->message = $service['message'];
                $ndinvoiceResponse->valid = $valid;
                $ndinvoiceResponse->code = $code;
                $ndinvoiceResponse->description = $description;
                $ndinvoiceResponse->status_message = $statusMessage;
                $ndinvoiceResponse->cude = $service['cude'];
                $ndinvoiceResponse->ncinvoice_id = $ndinvoice->id;
                $ndinvoiceResponse->save();

                $environmentPdf = Environment::findOrFail(10);
                $urlpdf = $environmentPdf->protocol . $configuration->ip . $environmentPdf->url;

                $pdf = file_get_contents($urlpdf . $company->nit ."/NDS-" . $ndinvoice->document .".pdf");
                Storage::disk('public')->put('files/graphical_representations/ndinvoice/' .
                $ndinvoice->document . '.pdf', $pdf);


            }
            $resolution->consecutive += 1;
            $resolution->update();

            session()->forget('ndinvoice');
            session(['ndinvoice' => $ndinvoice->id]);

            toast('Nota Debito Registrada satisfactoriamente.','success');
            return redirect('ndinvoice');
        } else {
            toast($errorMessages,'Danger');
            return redirect('ndinvoice');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ndinvoice $ndinvoice)
    {
        $ndinvoiceProducts = NdinvoiceProduct::where('ndinvoice_id', $ndinvoice->id)->where('quantity', '>', 0)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->get();

       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');
        return view('admin.ndinvoice.show', compact(
            'ndinvoice',
            'ndinvoiceProducts',
            'retentions',
            'retentionsum'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ndinvoice $ndinvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNdinvoiceRequest $request, Ndinvoice $ndinvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ndinvoice $ndinvoice)
    {
        //
    }
    /*
    public function ndinvoicePdf(Request $request, $id)
    {
       $ndinvoice = ndinvoice::findOrFail($id);
       $ndinvoiceProducts = ndinvoiceProduct::where('ndinvoice_id', $id)->where('quantity', '>', 0)->get();
       $company = Company::findOrFail(1);
       $indicator = Indicator::findOrFail(1);
       $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

       $ndinvoicepdf = $ndinvoice->document;
       $logo = './imagenes/logos'.$company->logo;
       $view = \view('admin.ndinvoice.pdf', compact(
            'ndinvoice',
            'ndinvoiceProducts',
            'company',
            'indicator',
            'logo',
            'retentions',
            'retentionsum'
        ));
       $pdf = App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       //$pdf->setPaper ( 'A7' , 'landscape' );

       return $pdf->stream('vista-pdf', "$ndinvoicepdf.pdf");
       //return $pdf->download("$invoicepdf.pdf");
    }*/
    /*
    public function pdfNdinvoice(Request $request)
    {
        $ndinvoices = session('ndinvoice');
        $ndinvoice = Ndinvoice::findOrFail($ndinvoices);
        session()->forget('ndinvoice');
        $ndinvoiceProducts = ndinvoiceProduct::where('ndinvoice_id', $ndinvoice->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ndinvoicepdf = $ndinvoice->document;
        $view = \view('admin.ndinvoice.pdf', compact(
            'ndinvoice',
            'ndinvoiceProducts',
            'company',
            'indicator',
            'retentions',
            'retentionsum'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('vista-pdf', "$ndinvoicepdf.pdf");
    }*/

    public function posPdfNdinvoice(Request $request, Ndinvoice $ndinvoice)
    {
        $document = $ndinvoice;
        $typeDocument = 'ndinvoice';
        $title = '';
        $consecutive = $document->document;
        $invoice = Invoice::findOrFail($ndinvoice->invoice_id);//encontrando la factura
        if ($invoice->document_type_id == 1) {
            $title = 'NOTA DEBITO';
        } else if ($invoice->document_type_id == 15){
            $title = 'NOTA DE AJUSTE DE TIPO DEBITO AL DOCUMENTO EQUIVALENTE.';
        }
        $thirdPartyType = 'customer';
        $logoHeight = 26;
        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0]/$image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60/$multiplier;
            }
        }

        $pdfHeight = ticketHeightNotes($logoHeight, $ndinvoice, "ncinvoice");

        $pdf = new Ticket('P', 'mm', array(70, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(1, 10, 4);
        $pdf->SetTitle($ndinvoice->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();



        if (indicator()->logo == 'on') {
            if (file_exists($logo)) {
                $pdf->generateLogo($logo, $width, $height);
            }
        }
        $pdf->generateTitle($title, $consecutive);
        $pdf->generateCompanyInformation();

        $barcodeGenerator = new BarcodeGeneratorPNG();
        $barcodeCode = $barcodeGenerator->getBarcode($ndinvoice->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($ndinvoice->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document, $typeDocument);

        if (indicator()->dian == 'on') {
            $pdf->generateInvoiceInformation($document);

            //$cufe = 'este-es-un-cufe-de-prueba';
            $cufe = $ndinvoice->ncinvoiceResponse->cude;
            $url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $ndinvoice->document,
                'FecFac' => $ndinvoice->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $ndinvoice->third->identification,
                'ValFac' => $ndinvoice->total,
                'ValIva' => $ndinvoice->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $ndinvoice->total_pay,
                'CUFE' => $cufe,
                'URL' => $url . $cufe,
            ];

            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            $pdf->generateQr($qrImage);

            //$confirmationCode = formatText("CUFE: " . $invoice->response->cufe);
            $confirmationCode = formatText("CUFE: " . $cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            $pdf->generateConfirmationCode($confirmationCode);
        }
        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $ndinvoice->document . ".pdf", true);
        exit;
    }

    public function pdfNdinvoice(Request $request, Ndinvoice $ndinvoice) {
        
        $invoice = Invoice::findOrFail($ndinvoice->invoice_id);
        $typeDocument = 'ndinvoice';
        $title = '';
        if ($invoice->document_type_id == 1) {
            $title = 'NOTA DEBITO';
            //$title = 'DOCUMENTO EQUIVALENTE ELECTRONICO DEL TIQUETE DE MAQUINA REGISTRADORA CON SISTEMA P.O.S.';
        } else {
            $title = 'NOTA DE AJUSTE DE TIPO DEBITO AL DOCUMENTO EQUIVALENTE P.O.S';
        }
        
        $document = $ndinvoice;
        $thirdPartyType = 'customer';
        $logoHeight = 26;
        $logo = '';
        $width = 0;
        $height = 0;
        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0]/$image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60/$multiplier;
            }
        }

        //$pdfHeight = ticketHeight($logoHeight, company(), $invoice, "invoice");

        $pdf = new PdfDocuments('P', 'mm', 'Letter', true, 'UTF-8');
        $pdf->SetMargins(10, 10, 6);
        $pdf->SetTitle($document->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();

        if (indicator()->dian == 'on') {
            //$pdf->generateInvoiceInformation($document);
            $cufe =  $document->invoiceResponse->cufe;
            $url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $document->document,
                'FecFac' => $document->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $document->third->identification,
                'ValFac' => $document->total,
                'ValIva' => $document->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $document->total_pay,
                'CUFE' => $cufe,
                'URL' => $url . $cufe,
            ];

            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            //$pdf->generateQr($qrImage);

            //$confirmationCode = formatText("CUFE: " . $invoice->response->cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            //$pdf->generateConfirmationCode($confirmationCode);
        } else {
            //$pdf->generateInvoiceInformation($document);
            $cufe =  '00';
            $url = '#';
            $data = [
                'NumFac' => $document->document,
                'FecFac' => $document->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $document->third->identification,
                'ValFac' => $document->total,
                'ValIva' => $document->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $document->total_pay,
                'CUFE' => $cufe,
                //'URL' => $url . $cufe,
            ];

            $writer = new PngWriter();
            $qrCode = new QrCode(implode("\n", $data));
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            $result = $writer->write($qrCode);

            $qrCodeImage = $result->getString();
            $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
            //$pdf->generateQr($qrImage);
        }

        $pdf->generateHeader($logo, $width, $height, $title, $document);
        $pdf->generateInfoPredocuments($document->third, $thirdPartyType, $document, $qrImage);
        $pdf->generateTablePdf($document, $typeDocument);
        $pdf->generateTotals($document, $typeDocument);


        $pdf->footer($document, $cufe);
        $pdf->documentInformation($document, $cufe);
        $pdf->footer();
        //$pdf->generateHeader($logo, $width, $height);
        //$refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        //$pdf->generateDisclaimerInformation($refund);

        $pdf->Output("I", $document->document . ".pdf", true);
        exit;
    }
}

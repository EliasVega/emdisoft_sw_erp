<?php

namespace App\Http\Controllers;

use App\Helpers\Pdfs\PdfDocuments;
use App\Helpers\Tickets\Ticket;
use App\Models\Ncpurchase;
use App\Http\Requests\StoreNcpurchaseRequest;
use App\Http\Requests\UpdateNcpurchaseRequest;
use App\Models\DocumentType;
use App\Models\NcpurchaseProduct;
use App\Models\NcpurchaseRawmaterial;
use App\Models\Purchase;
use App\Models\Resolution;
use App\Models\Tax;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryPurchases;
use App\Traits\KardexCreate;
use App\Traits\GetTaxesLine;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeightNotes;

class NcpurchaseController extends Controller
{
    use InventoryPurchases, KardexCreate, GetTaxesLine;
    /*
    function __construct()
    {
        $this->middleware('permission:ncpurchase.index|ncpurchase.store|ncpurchase.show', ['only'=>['index']]);
        $this->middleware('permission:ncpurchase.store', ['only'=>['create','store']]);
        $this->middleware('permission:ncpurchase.show', ['only'=>['show']]);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeDocument = '';
        $ncpurchase = '';
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas credito a admin y superadmin
                $ncpurchases = Ncpurchase::get();
            } else {
                //Consulta para mostrar notas credito de los demas roles
                $ncpurchases = Ncpurchase::where('user_id', $user->id)->get();
            }
            return DataTables::of($ncpurchases)
            ->addIndexColumn()
            ->addColumn('provider', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->third->name;
            })
            ->addColumn('reference', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->purchase->document;
            })

            ->addColumn('user', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->user->name;
            })

            ->editColumn('created_at', function(Ncpurchase $ncpurchase){
                return $ncpurchase->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ncpurchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ncpurchase.index', compact('ncpurchase', 'typeDocument'));
    }

    public function indexNcpurchase(Request $request)
    {
        $typeDocument = session('typeDocument');
        $ncpurchase = session('ncpurchase');
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas credito a admin y superadmin
                $ncpurchases = Ncpurchase::get();
            } else {
                //Consulta para mostrar notas credito de los demas roles
                $ncpurchases = Ncpurchase::where('user_id', $user->id)->get();
            }
            return DataTables::of($ncpurchases)
            ->addIndexColumn()
            ->addColumn('provider', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->third->name;
            })
            ->addColumn('reference', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->purchase->document;
            })

            ->addColumn('user', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->user->name;
            })

            ->editColumn('created_at', function(Ncpurchase $ncpurchase){
                return $ncpurchase->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ncpurchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ncpurchase.index', compact('ncpurchase', 'typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNcpurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNcpurchaseRequest $request)
    {
        //dd($request->all());
        $cashRegister = cashRegisterComprobation();
        $typeDocument = 'ncpurchase';
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

        $resolution = Resolution::findOrFail(2);
        $purchase = Purchase::findOrFail($request->purchase_id);

        //gran total de la compra
        $grandTotalold = $purchase->grand_total;
        $grandTotalNd = $total_pay - $retention;
        $newGrandTotal = $grandTotalold + $grandTotalNd;
        $newBalance = $newGrandTotal - $purchase->pay;

        $branch = $purchase->branch_id;

        $resolution = Resolution::findOrFail(2);//NC factura de venta pos
        $voucherTypes = VoucherType::findOrFail(10); //voucher type pos
        $documentType = DocumentType::findOrFail(102);

        //Registrar tabla Nota Credito
        $ncpurchase = new Ncpurchase();
        $ncpurchase->document = $resolution->prefix . '-' . $resolution->consecutive;
        $ncpurchase->user_id = current_user()->id;
        $ncpurchase->branch_id = current_user()->branch_id;
        $ncpurchase->purchase_id = $purchase->id;
        $ncpurchase->provider_id = $purchase->provider_id;
        $ncpurchase->resolution_id = $resolution->id;
        $ncpurchase->discrepancy_id = $discrepancy;
        $ncpurchase->voucher_type_id = $voucherTypes->id;
        $ncpurchase->document_type_id = $documentType->id;
        $ncpurchase->cash_register_id = $cashRegister->id;
        $ncpurchase->retention = $retention;
        $ncpurchase->total = $request->total;
        $ncpurchase->total_tax = $request->total_tax;
        $ncpurchase->total_pay = $request->total_pay;
        $ncpurchase->save();

        if (indicator()->pos == 'on') {
            //actualizar la caja
            $cashRegister->ncpurchase += $total_pay;
            $cashRegister->update();
        }

        //Seleccionar los productos de la compra
        switch($discrepancy) {
            case(7):
                if ($total_pay <= 0) {
                    toast(' Nota credito no debe ser menor o igual a 0.','warning');
                    return redirect("purchase");
                }
                for ($i=0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    //selecciona el producto que viene del array
                    if ($purchase->type_product == 'product') {

                        //registrando nota debito productos
                        $ncpurchaseProduct = new NcpurchaseProduct();
                        $ncpurchaseProduct->ncpurchase_id = $ncpurchase->id;
                        $ncpurchaseProduct->product_id = $id;
                        $ncpurchaseProduct->quantity = $quantity[$i];
                        $ncpurchaseProduct->price = $price[$i];
                        $ncpurchaseProduct->tax_rate = $tax_rate[$i];
                        $ncpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                        $ncpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ncpurchaseProduct->save();

                    } else {
                        //registrando nota debito productos
                        $ncpurchaseRawmaterial = new NcpurchaseRawmaterial();
                        $ncpurchaseRawmaterial->ncpurchase_id = $ncpurchase->id;
                        $ncpurchaseRawmaterial->raw_material_id = $id;
                        $ncpurchaseRawmaterial->quantity = $quantity[$i];
                        $ncpurchaseRawmaterial->price = $price[$i];
                        $ncpurchaseRawmaterial->tax_rate = $tax_rate[$i];
                        $ncpurchaseRawmaterial->subtotal = $quantity[$i] * $price[$i];
                        $ncpurchaseRawmaterial->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ncpurchaseRawmaterial->save();
                    }
                }
                break;
            case(8):

                if ($total_pay <= 0) {
                    toast(' Nota credito no debe ser menor o igual a 0 en ningun item.','warning');
                    return redirect("purchase");
                }
                for ($i=0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    if ($purchase->type_product == 'product') {
                        //registrando nota debito productos
                        $ncpurchaseProduct = new NcpurchaseProduct();
                        $ncpurchaseProduct->ncpurchase_id = $ncpurchase->id;
                        $ncpurchaseProduct->product_id = $id;
                        $ncpurchaseProduct->quantity = $quantity[$i];
                        $ncpurchaseProduct->price = $price[$i];
                        $ncpurchaseProduct->tax_rate = $tax_rate[$i];
                        $ncpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                        $ncpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ncpurchaseProduct->save();
                    } else {
                        //registrando nota debito productos
                        $ncpurchaseRawmaterial = new NcpurchaseRawmaterial();
                        $ncpurchaseRawmaterial->ncpurchase_id = $ncpurchase->id;
                        $ncpurchaseRawmaterial->raw_material_id = $id;
                        $ncpurchaseRawmaterial->quantity = $quantity[$i];
                        $ncpurchaseRawmaterial->price = $price[$i];
                        $ncpurchaseRawmaterial->tax_rate = $tax_rate[$i];
                        $ncpurchaseRawmaterial->subtotal = $quantity[$i] * $price[$i];
                        $ncpurchaseRawmaterial->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ncpurchaseRawmaterial->save();
                    }
                }
                break;
        }

        $document = $ncpurchase;
        $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
        taxesLines($document, $taxes, $typeDocument);//Helper para impuestos de linea
        retentions($request, $document, $typeDocument);//Helper para retenciones

        $voucherTypes = VoucherType::findOrFail(10);
        $voucherTypes->consecutive += 1;
        $voucherTypes->update();

        $resolution->consecutive += 1;
        $resolution->update();

        $purchase->grand_total = $newGrandTotal;
        $purchase->balance = $newBalance;
        if ($purchase->status == 'purchase') {
            $purchase->status = 'credit_note';
        } elseif ($purchase->status == 'debit_note') {
            $purchase->status = 'complete';
        }
        $purchase->update();

        $typeDocument = $request->type_document;
        session()->forget('ncpurchase');
        session()->forget('typeDocument');
        session(['ncpurchase' => $ncpurchase->id]);
        session(['typeDocument' => $typeDocument]);
        toast('Nota Credito Registrada satisfactoriamente.','success');
        return redirect('indexNcpurchase');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function show(Ncpurchase $ncpurchase)
    {
        $ncpurchaseProducts = NcpurchaseProduct::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->get();

       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        return view('admin.ncpurchase.show', compact(
            'ncpurchase',
            'ncpurchaseProducts',
            'retentions',
            'retentionsum'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Ncpurchase $ncpurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNcpurchaseRequest  $request
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNcpurchaseRequest $request, Ncpurchase $ncpurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ncpurchase  $ncpurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ncpurchase $ncpurchase)
    {
        //
    }
    /*
    public function ncpurchasePdf(Request $request, $id)
    {
        $ncpurchase = Ncpurchase::findOrFail($id);
        $purchase = Purchase::findOrFail($ncpurchase->purchase_id);
        if ($purchase->type_product == 'product') {
            $ncpurchaseProducts = ncpurchaseProduct::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        } else {
            $ncpurchaseProducts = NcpurchaseRawmaterial::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        }
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $retentions = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncpurchase')
            ->where('tax.taxable_id', $ncpurchase->id)
            ->where('tt.type_tax', 'retention')->get();
        $retentionsum = Tax::from('taxes as tax')
            ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
            ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
            ->select('tax.tax_value', 'ct.name')
            ->where('tax.type', 'ncpurchase')
            ->where('tax.taxable_id', $ncpurchase->id)
            ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ncpurchasepdf = $ncpurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $type = $purchase->type_product;
        $view = \view('admin.ncpurchase.pdf', compact(
                'ncpurchase',
                'ncpurchaseProducts',
                'company',
                'indicator',
                'logo',
                'retentions',
                'retentionsum',
                'type'
            ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$ncpurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");
    }*/
    /*
    public function pdfNcpurchase(Request $request)
    {
        $ncpurchases = session('ncpurchase');
        $ncpurchase = Ncpurchase::findOrFail($ncpurchases);
        session()->forget('ncpurchase');
        $purchase = Purchase::findOrFail($ncpurchase->purchase_id);
        if ($purchase->type_product == 'product') {
            $ncpurchaseProducts = ncpurchaseProduct::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        } else {
            $ncpurchaseProducts = NcpurchaseRawmaterial::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        }
        $company = company();
        $indicator = indicator();

        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncpurchase')
        ->where('tax.taxable_id', $ncpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ncpurchasepdf = $ncpurchase->document;
        $type = $purchase->type_product;
        $view = \view('admin.ncpurchase.pdf', compact(
            'ncpurchase',
            'ncpurchaseProducts',
            'company',
            'retentions',
            'retentionsum',
            'indicator',
            'type'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('vista-pdf', "$ncpurchasepdf.pdf");
    }*/

    public function posPdfNcpurchase(Request $request, Ncpurchase $ncpurchase)
    {
        $document = $ncpurchase;
        $typeDocument = 'ncpurchase';

        $title = 'NOTA CREDITO COMPRA';
        $consecutive = $document->document;
        $documentOrigin = Purchase::findOrFail($document->purchase_id);//encontrando la factura
        if ($documentOrigin->document_type_id == 101) {
            $title = 'NOTA CREDITO COMPRA';
        } else if ($documentOrigin->document_type_id == 11){
            $title = 'NOTA DE AJUSTE AL DOCUMENTO SOPORTE ELECTRONICO.';
        }
        $thirdPartyType = 'provider';
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

        $pdfHeight = ticketHeightNotes($logoHeight, $document);

        $pdf = new Ticket('P', 'mm', array(70, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(1, 10, 4);
        $pdf->SetTitle($document->document);
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
        $barcodeCode = $barcodeGenerator->getBarcode($document->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($document->third, $thirdPartyType);
        $pdf->generateReference($documentOrigin);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document, $typeDocument);

        if (indicator()->dian == 'on' && $documentOrigin->document_type_id == 11) {
            $pdf->generateInvoiceInformation($document);

            //$cufe = 'este-es-un-cufe-de-prueba';
            $cufe = $document->ncpurchaseResponse->cude;
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
            $pdf->generateQr($qrImage);

            //$confirmationCode = formatText("CUFE: " . $invoice->response->cufe);
            $confirmationCode = formatText("CUFE: " . $cufe);
            //$confirmationCode = formatText("CUFE: " . $invoice->invoiceResponse->cufe);
            $pdf->generateConfirmationCode($confirmationCode);
        }
        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $document->document . ".pdf", true);
        exit;
    }

    public function pdfNcpurchase(Request $request, Ncpurchase $ncpurchase) {
        
        $document = $ncpurchase;
        $documentOrigin = Purchase::findOrFail($document->purchase_id);
        $typeDocument = 'ncpurchase';
        $title = '';
        $documentType = $documentOrigin->document_type_id;
        $documentOrigin = Purchase::findOrFail($document->purchase_id);//encontrando la factura
        if ($documentType == 101) {
            $title = 'NOTA CREDITO';
        } else if ($documentType == 11){
            $title = 'NOTA DE AJUSTE AL DOCUMENTO SOPORTE ELECTRONICO.';
        }
        
        $document = $document;
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

        if (indicator()->dian == 'on' && $documentType == 11) {
            //$pdf->generateInvoiceInformation($document);
            $cufe =  $document->nsdResponse->cufe;
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
        $pdf->generateReferencesNotes($documentOrigin);
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

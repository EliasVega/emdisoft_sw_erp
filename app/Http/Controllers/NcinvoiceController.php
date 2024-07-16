<?php

namespace App\Http\Controllers;

use App\Helpers\Tickets\Ticket;
use App\Models\Ncinvoice;
use App\Http\Requests\StoreNcinvoiceRequest;
use App\Http\Requests\UpdateNcinvoiceRequest;
use App\Models\BranchProduct;
use App\Models\CashInflow;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Employee;
use App\Models\EmployeeInvoiceProduct;
use App\Models\Environment;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\NcinvoiceProduct;
use App\Models\NcinvoiceResponse;
use App\Models\Pay;
use App\Models\PayPaymentMethod;
use App\Models\Product;
use App\Models\Resolution;
use App\Models\Tax;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\AdvanceCreate;
use App\Traits\KardexCreate;
use App\Traits\GetTaxesLine;
use App\Traits\NcinvoiceProductCreate;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeight;
use function App\Helpers\Tickets\ticketHeightNcinvoice;

class NcinvoiceController extends Controller
{
    use AdvanceCreate, KardexCreate, GetTaxesLine, NcinvoiceProductCreate;
    function __construct()
    {
        $this->middleware('permission:ncinvoice.index|ncinvoice.store|ncinvoice.show', ['only'=>['index']]);
        $this->middleware('permission:ncinvoice.store', ['only'=>['create','store']]);
        $this->middleware('permission:ncinvoice.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ncinvoice = session('ncinvoice');
        $typeDocument = session('typeDocument');
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas credito a admin y superadmin
                $ncinvoices = Ncinvoice::get();
            } else {
                //Consulta para mostrar notas credito de los demas roles
                $ncinvoices = Ncinvoice::where('user_id', $user->id)->get();
            }
            return DataTables::of($ncinvoices)
            ->addIndexColumn()
            ->addColumn('branch', function (Ncinvoice $ncinvoice) {
                return $ncinvoice->branch->name;
            })
            ->addColumn('customer', function (Ncinvoice $ncinvoice) {
                return $ncinvoice->third->name;
            })
            ->addColumn('document', function (Ncinvoice $ncinvoice) {
                return $ncinvoice->invoice->document;
            })
            ->addColumn('user', function (Ncinvoice $ncinvoice) {
                return $ncinvoice->user->name;
            })
            ->addColumn('dian', function (Ncinvoice $ncinvoice) {
                return $ncinvoice->branch->company->indicator->dian;
            })
            ->addColumn('documentType', function (Ncinvoice $ncinvoice) {
                return $ncinvoice->invoice->document_type_id;
            })
            ->editColumn('created_at', function(Ncinvoice $ncinvoice){
                return $ncinvoice->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ncinvoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ncinvoice.index', compact('ncinvoice', 'typeDocument'));
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
    public function store(StoreNcinvoiceRequest $request)
    {
        //dd($request->all());
        $typeDocument = 'ncinvoice';
        $branch = current_user()->branch_id;

        $invoice = Invoice::findOrFail($request->invoice_id);//encontrando la factura
        $configuration = Configuration::where('company_id', company()->id)->first();
        $cashRegister = cashRegisterComprobation();
        $pay = Pay::where('type', 'invoice')->where('payable_id', $invoice->id)->get();//pagos hechos a esta factura

        $voucherTypes = '';
        $resolution = '';
        if (indicator()->dian == 'on') {
            if ($invoice->document_type_id == 1) {
                $resolution = Resolution::findOrFail(8);//NC factura de venta
                $voucherTypes = VoucherType::findOrFail(5);//voucher type FV
            } else if ($invoice->document_type_id == 15) {
                $resolution = Resolution::findOrFail(11);//NC factura de venta pos
                $voucherTypes = VoucherType::findOrFail(21); //voucher type pos
            }
        } else {
            if ($invoice->document_type_id == 1) {
                $resolution = Resolution::findOrFail(8);//NC factura de venta
                $voucherTypes = VoucherType::findOrFail(5);//voucher type FV
            } else if ($invoice->document_type_id == 104) {
                $resolution = Resolution::findOrFail(5);//NC factura de venta pos
                $voucherTypes = VoucherType::findOrFail(21); //voucher type pos
            }
        }

        //variables del request
        $quantity = $request->quantity;
        $price = $request->price;
        $total_pay = $request->total_pay;
        $product_id = $request->id;
        $discrepancy = $request->discrepancy_id;
        $retention = 0;
        //variables del request
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        $payCash = 0;//suma de todos los pagos hechos a esta compra en efectivo
        foreach ($pay as $key => $value) {
            $payCash += PayPaymentMethod::where('pay_id', $value->id)->where('payment_method_id', 10)->sum('pay');
        }

        //gran total de la compra
        $grandTotalold = $invoice->grand_total;//total de la factura antes de NC
        $grandTotalNc = $total_pay - $retention;//total NC - retenciones
        $newGrandTotal = $grandTotalold - $grandTotalNc;//total factura - esta NC

        $date1 = Carbon::now()->toDateString();
        $date2 = $invoice->created_at->toDateString();

        $reverse = $request->reverse;//1 si desea volver valor a caja 2 si desea crear un avance
        $advancePay = $invoice->pay - $newGrandTotal;//abonos de factura  - NC
        $documentOrigin = $invoice;
        $voucherType = $voucherTypes->id;
        $service = '';
        $errorMessages = '';
        $store = true;

        if (indicator()->dian == 'on') {
            $environment = Environment::where('id', 12)->first();
            $url = $environment->protocol . $configuration->ip . $environment->url;
            $data = ncinvoiceData($request, $invoice);
            $requestResponse = sendDocuments($url, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }

        if ($store == true) {
            //Registrar tabla Nota Credito
            $ncinvoice = new Ncinvoice();
            $ncinvoice->document = $resolution->prefix . $resolution->consecutive;
            $ncinvoice->user_id = current_user()->id;
            $ncinvoice->branch_id = $branch;
            $ncinvoice->invoice_id = $invoice->id;
            $ncinvoice->resolution_id = $resolution->id;
            $ncinvoice->customer_id = $invoice->customer_id;
            $ncinvoice->discrepancy_id = $discrepancy;
            $ncinvoice->voucher_type_id = 5;
            $ncinvoice->cash_register_id = $cashRegister->id;
            $ncinvoice->retention = $retention;
            $ncinvoice->total = $request->total;
            $ncinvoice->total_tax = $request->total_tax;
            $ncinvoice->total_pay = $request->total_pay;
            $ncinvoice->save();

            $document = $ncinvoice;
            $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();
            switch($discrepancy) {
                case(1):
                    //creando registro de ncinvoice productos
                    $this->ncinvoiceProductCreate($request, $document);//crear ncinvoiceProduct
                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];
                        $product = Product::findOrFail($id);
                        if ($product->type_product == 'product') {
                            //devolviendo productos al inventario
                            if (indicator()->inventory == 'on') {
                                $product->stock += $quantity[$i];
                                $product->update();

                                //devolviendo productos a la sucursal
                                $branchProduct = BranchProduct::where('branch_id', $invoice->branch_id)->where('product_id', $id)->first();
                                $branchProduct->stock += $quantity[$i];
                                $branchProduct->update();
                            }
                            //Actualizando el  Kardex
                            $quantityLocal = $quantity[$i];
                            $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
                        }
                    }
                    if (indicator()->work_labor == 'on') {
                        for ($i=0; $i < count($invoiceProducts); $i++) {
                            $ideip = $invoiceProducts[$i]->id;

                            $employeeInvoiceProduct = EmployeeInvoiceProduct::where('invoice_product_id', $ideip)->first();
                            if ($employeeInvoiceProduct) {
                                $idEmployee = $employeeInvoiceProduct->employee_id;
                                $employee = Employee::findOrFail($idEmployee);
                                $subtotal = $quantity[$i] * $price[$i];
                                $commission = $employee->commission;
                                $valueCommission = ($subtotal/100) * $commission;

                                $employeeInvoiceProduct->quantity -= $quantity[$i];
                                $employeeInvoiceProduct->subtotal -= $subtotal;
                                $employeeInvoiceProduct->value_commission -= $valueCommission;
                                $employeeInvoiceProduct->status = 'credit_note';
                                $employeeInvoiceProduct->update();
                            }
                        }
                    }
                    break;
                case(2):
                    //$invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();
                    if ($store == true) {
                        for ($i=0; $i < count($invoiceProducts); $i++) {

                            //foreach ($invoiceProducts as $productPurchase) {
                            $id = $invoiceProducts[$i]->product_id;
                            $product = Product::findOrFail($id);

                            //creando registro de ncinvoice productos
                            $ncinvoiceProduct = new NcinvoiceProduct();
                            $ncinvoiceProduct->ncinvoice_id = $ncinvoice->id;
                            $ncinvoiceProduct->product_id = $id;
                            $ncinvoiceProduct->quantity = $invoiceProducts[$i]->quantity;
                            $ncinvoiceProduct->price = $invoiceProducts[$i]->price;
                            $ncinvoiceProduct->tax_rate = $invoiceProducts[$i]->tax_rate;
                            $ncinvoiceProduct->subtotal = $invoiceProducts[$i]->subtotal;
                            $ncinvoiceProduct->tax_subtotal = $invoiceProducts[$i]->tax_subtotal;
                            $ncinvoiceProduct->save();

                            if ($product->type_product == 'product') {
                                //devolviendo productos al inventario
                                if (indicator()->inventory == 'on') {
                                    $product->stock += $invoiceProducts[$i]->quantity;
                                    $product->update();

                                    //devolviendo productos a la sucursal
                                    $branchProduct = BranchProduct::where('branch_id', $invoice->branch_id)->where('product_id', $id)->first();
                                    $branchProduct->stock += $invoiceProducts[$i]->quantity;
                                    $branchProduct->update();
                                }
                                //registrando el kardex
                                $quantityLocal = $quantity[$i];
                                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
                            }

                            if (indicator()->work_labor == 'on') {
                                $ideip = $invoiceProducts[$i]->id;

                                $employeeInvoiceProduct = EmployeeInvoiceProduct::where('invoice_product_id', $ideip)->first();
                                if ($employeeInvoiceProduct) {

                                    $employeeInvoiceProduct->quantity = 0;
                                    $employeeInvoiceProduct->price = 0;
                                    $employeeInvoiceProduct->subtotal = 0;
                                    $employeeInvoiceProduct->value_commission = 0;
                                    $employeeInvoiceProduct->status = 'credit_note';
                                    $employeeInvoiceProduct->update();
                                }
                            }
                        }
                    }
                    break;
                case(3):
                    $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();

                    for ($i=0; $i < count($price); $i++) {
                        foreach ($invoiceProducts as $key => $invoiceProduct) {
                            if ($invoiceProduct->product_id == $product_id[$i]) {
                                if ($invoiceProduct->price < $price[$i]) {
                                    toast(' precio de uno de los items no debe ser mayor al inicial en la compra','warning');
                                    return redirect("invoice");
                                }
                            }
                        }
                    }
                    //creando registro ncinvoice productos
                    $this->ncinvoiceProductCreate($request, $document);//crear ncinvoiceProduct

                    if (indicator()->work_labor == 'on') {
                        for ($i=0; $i < count($invoiceProducts); $i++) {
                            $ideip = $invoiceProducts[$i]->id;

                            $employeeInvoiceProduct = EmployeeInvoiceProduct::where('invoice_product_id', $ideip)->first();
                            if ($employeeInvoiceProduct) {
                                $idEmployee = $employeeInvoiceProduct->employee_id;
                                $employee = Employee::findOrFail($idEmployee);
                                $subtotal = $quantity[$i] * $price[$i];
                                $commission = $employee->commission;
                                $valueCommission = ($subtotal/100) * $commission;

                                $employeeInvoiceProduct->price -= $price[$i];
                                $employeeInvoiceProduct->subtotal -= $subtotal;
                                $employeeInvoiceProduct->value_commission -= $valueCommission;
                                $employeeInvoiceProduct->status = 'credit_note';
                                $employeeInvoiceProduct->update();
                            }
                        }
                    }
                    break;
                case(4):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("invoice");
                    }

                    $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();

                    for ($i=0; $i < count($price); $i++) {
                        foreach ($invoiceProducts as $key => $productPurchase) {
                            if ($productPurchase->product_id == $product_id[$i]) {
                                if ($productPurchase->price < $price[$i]) {
                                    toast(' precio de uno de los items no debe ser mayor al inicial en la compra','warning');
                                    return redirect("invoice");
                                }
                            }
                        }
                    }
                    //creando registro ncinvoice productos
                    $this->ncinvoiceProductCreate($request, $document);//crear ncinvoiceProduct

                    if (indicator()->work_labor == 'on') {
                        for ($i=0; $i < count($invoiceProducts); $i++) {
                            $ideip = $invoiceProducts[$i]->id;

                            $employeeInvoiceProduct = EmployeeInvoiceProduct::where('invoice_product_id', $ideip)->first();
                            if ($employeeInvoiceProduct) {
                                $idEmployee = $employeeInvoiceProduct->employee_id;
                                $employee = Employee::findOrFail($idEmployee);
                                $subtotal = $quantity[$i] * $price[$i];
                                $commission = $employee->commission;
                                $valueCommission = ($subtotal/100) * $commission;

                                $employeeInvoiceProduct->price -= $price[$i];
                                $employeeInvoiceProduct->subtotal -= $subtotal;
                                $employeeInvoiceProduct->value_commission -= $valueCommission;
                                $employeeInvoiceProduct->status = 'credit_note';
                                $employeeInvoiceProduct->update();
                            }
                        }
                    }
                    break;
                default:
                    $msg = 'No has seleccionado voucher.';
            }
            $quantityBag = 0;
            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);//Helper para Impuestos de linea
            retentions($request, $document, $typeDocument);// Helper para retenciones

            if ($advancePay > 0) {
                if ($reverse == 1) {
                    $cashInflow = new CashInflow();
                    $cashInflow->cash = $advancePay;
                    $cashInflow->reason = 'Ingreso de efectivo por nota debito' . $ncinvoice->id;
                    $cashInflow->cash_register_id = $cashRegister->id;
                    $cashInflow->user_id = current_user()->id;
                    $cashInflow->branch_id = current_user()->branch_id;
                    $cashInflow->admin_id = current_user()->id;
                    $cashInflow->save();

                    if (indicator()->pos == 'on') {
                        $cashRegister->cash_in_total -= $advancePay;
                        $cashRegister->in_cash -= $advancePay;
                        $cashRegister->in_total -= $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->invoice -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                } else {
                    //creando registro d avance a clientes
                    $this->advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument);

                    if (indicator()->pos == 'on') {
                        $cashRegister->in_advance += $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->invoice -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                }
                $invoice->balance = 0;
                $invoice->grand_total = $newGrandTotal;
                $invoice->update();
            } else {

                $invoice->balance -= $grandTotalNc;
                $invoice->grand_total = $newGrandTotal;
                $invoice->update();
            }

            if (indicator()->pos == 'on') {
                if ($date1 == $date2) {
                    $cashRegister->ncinvoice += $total_pay;
                    $cashRegister->update();
                }
            }

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            if ($invoice->status == 'invoice') {
                if ($discrepancy == 2) {
                    $invoice->status = 'complete';
                } else {
                    $invoice->status = 'credit_note';
                }

            } elseif ($invoice->status == 'debit_note') {
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

                $ncinvoiceResponse = new NcinvoiceResponse();
                $ncinvoiceResponse->document = $invoice->document;
                $ncinvoiceResponse->message = $service['message'];
                $ncinvoiceResponse->valid = $valid;
                $ncinvoiceResponse->code = $code;
                $ncinvoiceResponse->description = $description;
                $ncinvoiceResponse->status_message = $statusMessage;
                $ncinvoiceResponse->cude = $service['cude'];
                $ncinvoiceResponse->ncinvoice_id = $ncinvoice->id;
                $ncinvoiceResponse->save();

                $environmentPdf = Environment::findOrFail(10);
                $urlpdf = $environmentPdf->protocol . $configuration->ip . $environmentPdf->url;

                $pdf = file_get_contents($urlpdf . company()->nit ."/NCS-" . $ncinvoice->document .".pdf");
                Storage::disk('public')->put('files/graphical_representations/ncinvoice/' .
                $ncinvoice->document . '.pdf', $pdf);
            }

            $resolution->consecutive += 1;
            $resolution->update();

            session()->forget('ncinvoice');
            session()->forget('typeDocument');
            session(['ncinvoice' => $ncinvoice->id]);
            session(['typeDocument' => $typeDocument]);

            toast('Nota Credito Registrada satisfactoriamente.','success');
            return redirect('ncinvoice');
        } else {
            toast($errorMessages,'Danger');
            return redirect('ncinvoice');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Ncinvoice $ncinvoice)
    {
        $ncinvoiceProducts = NcinvoiceProduct::where('ncinvoice_id', $ncinvoice->id)->where('quantity', '>', 0)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncinvoice')
        ->where('tax.taxable_id', $ncinvoice->id)
        ->where('tt.type_tax', 'retention')->get();

       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncinvoice')
        ->where('tax.taxable_id', $ncinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        return view('admin.ncinvoice.show', compact(
            'ncinvoice',
            'ncinvoiceProducts',
            'retentions',
            'retentionsum'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ncinvoice $ncinvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNcinvoiceRequest $request, Ncinvoice $ncinvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ncinvoice $ncinvoice)
    {
        //
    }

    public function ncinvoicePdf(Request $request, $id)
    {
       $ncinvoice = Ncinvoice::findOrFail($id);
       $ncinvoiceProducts = NcinvoiceProduct::where('ncinvoice_id', $id)->where('quantity', '>', 0)->get();
       $company = Company::findOrFail(1);
       $indicator = indicator();
       $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncinvoice')
        ->where('tax.taxable_id', $ncinvoice->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncinvoice')
        ->where('tax.taxable_id', $ncinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

       $ncinvoicepdf = $ncinvoice->document;
       $logo = './imagenes/logos'.$company->logo;
       $view = \view('admin.ncinvoice.pdf', compact(
            'ncinvoice',
            'ncinvoiceProducts',
            'company',
            'indicator',
            'logo',
            'retentions',
            'retentionsum'
        ));
       $pdf = App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       //$pdf->setPaper ( 'A7' , 'landscape' );

       return $pdf->stream('vista-pdf', "$ncinvoicepdf.pdf");
       //return $pdf->download("$invoicepdf.pdf");*/
    }

    public function pdfNcinvoice(Request $request)
    {
        $ncinvoices = session('ncinvoice');
        $ncinvoice = Ncinvoice::findOrFail($ncinvoices);
        session()->forget('ncinvoice');
        $ncinvoiceProducts = NcinvoiceProduct::where('ncinvoice_id', $ncinvoice->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncinvoice')
        ->where('tax.taxable_id', $ncinvoice->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ncinvoice')
        ->where('tax.taxable_id', $ncinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ncinvoicepdf = $ncinvoice->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.ncinvoice.pdf', compact(
            'ncinvoice',
            'ncinvoiceProducts',
            'company',
            'indicator',
            'logo',
            'retentions',
            'retentionsum'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('vista-pdf', "$ncinvoicepdf.pdf");
    }

    public function posPdfNcinvoice(Request $request, Ncinvoice $ncinvoice)
    {
        $document = $ncinvoice;
        $typeDocument = 'ncinvoice';
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

        $pdfHeight = ticketHeightNcinvoice($logoHeight, $ncinvoice, "ncinvoice");

        $pdf = new Ticket('P', 'mm', array(80, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(4, 10, 4);
        $pdf->SetTitle($ncinvoice->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();



        if (indicator()->logo == 'on') {
            if (file_exists($logo)) {
                $pdf->generateLogo($logo, $width, $height);
            }
        }
        $pdf->generateTitle();
        $pdf->generateCompanyInformation();

        $barcodeGenerator = new BarcodeGeneratorPNG();
        $barcodeCode = $barcodeGenerator->getBarcode($ncinvoice->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($ncinvoice->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document);

        if (indicator()->dian == 'on') {
            $pdf->generateInvoiceInformation($document);

            //$cufe = 'este-es-un-cufe-de-prueba';
            $cufe = $ncinvoice->invoiceResponse->cude;
            $url = 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=';
            $data = [
                'NumFac' => $ncinvoice->document,
                'FecFac' => $ncinvoice->created_at->format('Y-m-d'),
                'NitFac' => company()->nit,
                'DocAdq' => $ncinvoice->third->identification,
                'ValFac' => $ncinvoice->total,
                'ValIva' => $ncinvoice->total_tax,
                'ValOtroIm' => '0.00',
                'ValTotal' => $ncinvoice->total_pay,
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

        $pdf->Output("I", $ncinvoice->document . ".pdf", true);
        exit;
    }
}

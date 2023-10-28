<?php

namespace App\Http\Controllers;

use App\Models\Ncinvoice;
use App\Http\Requests\StoreNcinvoiceRequest;
use App\Http\Requests\UpdateNcinvoiceRequest;
use App\Models\BranchProduct;
use App\Models\CashInflow;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Environment;
use App\Models\Indicator;
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
use App\Traits\Taxes;
use App\Traits\NcinvoiceProductCreate;

class NcinvoiceController extends Controller
{
    use AdvanceCreate, KardexCreate, Taxes, NcinvoiceProductCreate;
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

            ->editColumn('created_at', function(Ncinvoice $ncinvoice){
                return $ncinvoice->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ncinvoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ncinvoice.index', compact('ncinvoice'));
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

        $company = Company::findOrFail(current_user()->company_id);
        $invoice = Invoice::findOrFail($request->invoice_id);//encontrando la factura
        $environment = Environment::where('id', 12)->first();//Url nota de ajuste documento soporte
        $pay = Pay::where('type', 'invoice')->where('payable_id', $invoice->id)->get();//pagos hechos a esta factura
        $indicator = Indicator::findOrFail(1);
        $voucherTypes = VoucherType::findOrFail(5);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $voucherTypes = '';
        $resolution = '';
        if ($invoice->document_type_id == 1) {
            $resolution = Resolution::findOrFail(8);
            $voucherTypes = VoucherType::findOrFail(5);
        } else {
            $resolution = Resolution::findOrFail(5);
            $voucherTypes = VoucherType::findOrFail(21);
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
        $grandTotalold = $invoice->grand_total;
        $grandTotalNd = $total_pay - $retention;
        $newGrandTotal = $grandTotalold - $grandTotalNd;

        $date1 = Carbon::now()->toDateString();
        $date2 = $invoice->created_at->toDateString();

        $reverse = $request->reverse;//1 si desea volver valor a caja 2 si desea crear un avance
        $advancePay = $invoice->pay - $newGrandTotal;
        $documentOrigin = $invoice;
        $voucherType = $voucherTypes->id;
        $service = '';
        $errorMessages = '';
        $store = false;
        if ($indicator->dian == 'on') {
            $data = ncinvoiceSend($request, $invoice);
            $requestResponse = sendDocuments($company, $environment, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
        if ($store == true) {
            //Registrar tabla Nota Credito
            $ncinvoice = new Ncinvoice();
            $ncinvoice->document = $resolution->prefix . '-' . $resolution->consecutive;
            $ncinvoice->user_id = current_user()->id;
            $ncinvoice->branch_id = current_user()->branch_id;
            $ncinvoice->invoice_id = $invoice->id;
            $ncinvoice->resolution_id = $resolution->id;
            $ncinvoice->customer_id = $invoice->customer_id;
            $ncinvoice->discrepancy_id = $discrepancy;
            $ncinvoice->voucher_type_id = $voucherType;
            $ncinvoice->retention = $retention;
            $ncinvoice->total = $request->total;
            $ncinvoice->total_tax = $request->total_tax;
            $ncinvoice->total_pay = $request->total_pay;
            $ncinvoice->save();

            $document = $ncinvoice;
            $invoiceProducts = InvoiceProduct::where('invoice_id', $invoice->id)->get();
            switch($discrepancy) {
                case(1):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("invoice");
                    }
                    $this->ncinvoiceProductCreate($request, $document);//crear ncinvoiceProduct
                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];
                        $product = Product::findOrFail($id);
                        if ($product->type_product == 'product') {
                            //devolviendo productos al inventario
                            if ($indicator->inventory == 'on') {
                                $product->stock -= $quantity[$i];
                                $product->update();

                                //devolviendo productos a la sucursal
                                $branchProduct = BranchProduct::where('branch_id', $invoice->branch_id)->where('product_id', $id)->first();
                                $branchProduct->stock -= $quantity[$i];
                                $branchProduct->update();
                            }
                            //Actualizando el  Kardex
                            $quantityLocal = $quantity[$i];
                            $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
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

                            //registrando nota debito productos
                            $ncinvoiceProduct = new NcinvoiceProduct();
                            $ncinvoiceProduct->ncinvoice_id = $ncinvoice->id;
                            $ncinvoiceProduct->product_id = $id;
                            $ncinvoiceProduct->quantity = $invoiceProducts[$i]->quantity;
                            $ncinvoiceProduct->price = $invoiceProducts[$i]->price;
                            $ncinvoiceProduct->tax_rate = $invoiceProducts[$i]->tax_rate;
                            $ncinvoiceProduct->subtotal = $invoiceProducts[$i]->subtotal;
                            $ncinvoiceProduct->tax_subtotal = $invoiceProducts[$i]->tax_subtotal;
                            $ncinvoiceProduct->save();

                            $product = Product::findOrFail($id);
                            if ($product->type_product == 'product') {
                                //devolviendo productos al inventario
                                if ($indicator->inventory == 'on') {
                                    $product->stock -= $invoiceProducts[$i]->quantity;
                                    $product->update();

                                    //devolviendo productos a la sucursal
                                    $branchProduct = BranchProduct::where('branch_id', $invoice->branch_id)->where('product_id', $id)->first();
                                    $branchProduct->stock -= $invoiceProducts[$i]->quantity;
                                    $branchProduct->update();
                                }

                                $quantityLocal = $quantity[$i];
                                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
                            }
                        }
                    }
                    break;
                case(3):
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
                    $this->ncinvoiceProductCreate($request, $document);//crear ncinvoiceProduct
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
                    $this->ncinvoiceProductCreate($request, $document);//crear ncinvoiceProduct
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

                    if ($indicator->pos == 'on') {
                        $cashRegister->cash_in_total += $advancePay;
                        $cashRegister->in_cash += $advancePay;
                        $cashRegister->in_total += $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->invoice -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                } else {
                    $this->advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument);

                    if ($indicator->pos == 'on') {
                        $cashRegister->out_advance += $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->invoice -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                }
                $invoice->balance = 0;
                $invoice->update();
            } else {

                $invoice->balance -= $grandTotalNd;
                $invoice->grand_total = $newGrandTotal;
                $invoice->update();
            }

            if ($indicator->pos == 'on') {
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

            if ($indicator->dian == 'on') {
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

                $environmentPdf = Environment::where('code', 'PDF')->first();

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/NCS-" . $resolution->prefix .
                $resolution->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/ncinvoice/' .
                $resolution->prefix . $resolution->consecutive . '.pdf', $pdf);
            }

            $resolution->consecutive += 1;
            $resolution->update();

            session()->forget('ncinvoice');
            session(['ncinvoice' => $ncinvoice->id]);

            toast('Nota Debito Registrada satisfactoriamente.','success');
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
       $indicator = Indicator::findOrFail(1);
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
        $indicator = Indicator::findOrFail(1);
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
}

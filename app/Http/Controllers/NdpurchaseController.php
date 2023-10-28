<?php

namespace App\Http\Controllers;

use App\Models\Ndpurchase;
use App\Http\Requests\StoreNdpurchaseRequest;
use App\Http\Requests\UpdateNdpurchaseRequest;
use App\Models\BranchProduct;
use App\Models\BranchRawmaterial;
use App\Models\CashInflow;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\NdpurchaseProduct;
use App\Models\NsdResponse;
use App\Models\Pay;
use App\Models\PayPaymentMethod;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductRawmaterial;
use App\Models\Purchase;
use App\Models\RawMaterial;
use App\Models\Resolution;
use App\Models\Tax;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Traits\AdvanceCreate;
use App\Traits\KardexCreate;
use App\Traits\Taxes;
use App\Traits\NdpurchaseProductCreate;
use App\Traits\reverse;
use Illuminate\Support\Facades\Storage;

class NdpurchaseController extends Controller
{
    use AdvanceCreate, KardexCreate, Taxes, NdpurchaseProductCreate, reverse;

    function __construct()
    {
        $this->middleware('permission:ndpurchase.index|ndpurchase.store|ndpurchase.show', ['only'=>['index']]);
        $this->middleware('permission:ndpurchase.store', ['only'=>['create','store']]);
        $this->middleware('permission:ndpurchase.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ndpurchase = session('ndpurchase');
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas debito a admin y superadmin
                $ndpurchases = Ndpurchase::get();
            } else {
                //Consulta para mostrar notas debito de los demas roles
                $ndpurchases = Ndpurchase::where('user_id', $user->id)->get();
            }
            return DataTables::of($ndpurchases)
            ->addIndexColumn()
            ->addColumn('branch', function (ndpurchase $ndpurchase) {
                return $ndpurchase->branch->name;
            })
            ->addColumn('provider', function (ndpurchase $ndpurchase) {
                return $ndpurchase->third->name;
            })
            ->addColumn('document', function (ndpurchase $ndpurchase) {
                return $ndpurchase->purchase->document;
            })

            ->addColumn('user', function (ndpurchase $ndpurchase) {
                return $ndpurchase->user->name;
            })

            ->editColumn('created_at', function(ndpurchase $ndpurchase){
                return $ndpurchase->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ndpurchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ndpurchase.index', compact('ndpurchase'));
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
     * @param  \App\Http\Requests\StoreNdpurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNdpurchaseRequest $request)
    {
        //dd($request->all());
        $resolut = $request->resolution_id;
        $typeDocument = 'ndpurchase';
        $voucherType = 11;
        $branch = current_user()->branch_id;

        if ($resolut) {
            $resolution = Resolution::findOrFail($request->resolution_id);//resolucion selecionada en el request
        } else {
            $resolution = Resolution::findOrFail(3);//resolucion selecionada en el request
        }
        $company = Company::findOrFail(current_user()->company_id);
        $purchase = Purchase::findOrFail($request->purchase_id);//encontrando la factura
        $environment = Environment::where('id', 17)->first();//Url nota de ajuste documento soporte
        $pay = Pay::where('type', 'purchase')->where('payable_id', $purchase->id)->get();//pagos hechos a esta factura
        $indicator = Indicator::findOrFail(1);
        $voucherTypes = VoucherType::findOrFail(18);
        $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
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
        $grandTotalold = $purchase->grand_total;
        $grandTotalNd = $total_pay - $retention;
        $newGrandTotal = $grandTotalold - $grandTotalNd;

        $date1 = Carbon::now()->toDateString();
        $date2 = Purchase::find($purchase->id)->created_at->toDateString();

        $reverse = $request->reverse;//1 si desea volver valor a caja 2 si desea crear un avance
        $advancePay = $purchase->pay - $newGrandTotal;
        $documentType = $request->document_type_id;
        $documentOrigin = $purchase;
        $service = '';
        $errorMessages = '';
        $store = false;
        if ($documentType == 11 && $indicator->dian == 'on') {
            $data = adjustmentNoteSend($request, $purchase);
            $requestResponse = sendDocuments($company, $environment, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
        if ($store == true) {
            //Registrar tabla Nota Debito
            $ndpurchase = new Ndpurchase();
            $ndpurchase->document = $resolution->prefix . '-' . $resolution->consecutive;
            $ndpurchase->user_id = current_user()->id;
            $ndpurchase->branch_id = $branch;
            $ndpurchase->purchase_id = $purchase->id;
            $ndpurchase->resolution_id = $resolution->id;
            $ndpurchase->provider_id = $purchase->provider_id;
            $ndpurchase->discrepancy_id = $discrepancy;
            $ndpurchase->voucher_type_id = 11;
            $ndpurchase->retention = $retention;
            $ndpurchase->total = $request->total;
            $ndpurchase->total_tax = $request->total_tax;
            $ndpurchase->total_pay = $request->total_pay;
            $ndpurchase->save();

            $document = $ndpurchase;
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
            switch($discrepancy) {
                case(1):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("purchase");
                    }
                    if ($purchase->type_product == 'product') {
                        $this->ndpurchaseProductCreate($request, $document);//crear ndpurchaseProduct
                    } else {
                        $this->ndpurchaseRawmaterials($request, $document);//crear ndpurchaseProduct
                    }

                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];
                        if ($purchase->type_product == 'product') {
                            $product = Product::findOrFail($id);
                            $branchProduct = BranchProduct::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();
                        } else {
                            $product = RawMaterial::findOrFail($id);
                            $branchProduct = BranchRawmaterial::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();
                        }
                        if ($product->type_product == 'product') {
                            //devolviendo productos al inventario
                            if ($indicator->inventory == 'on') {
                                $product->stock -= $quantity[$i];
                                $product->update();

                                //devolviendo productos a la sucursal
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
                    //$productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
                    if ($store == true) {
                        for ($i=0; $i < count($productPurchases); $i++) {

                            //foreach ($productPurchases as $productPurchase) {
                            $id = $productPurchases[$i]->product_id;
                            if ($purchase->type_product == 'product') {
                                $product = Product::findOrFail($id);
                                $branchProduct = BranchProduct::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();
                            } else {
                                $product = RawMaterial::findOrFail($id);
                                $branchProduct = BranchRawmaterial::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();
                            }

                            //registrando nota debito productos
                            $ndpurchaseProduct = new NdpurchaseProduct();
                            $ndpurchaseProduct->ndpurchase_id = $ndpurchase->id;
                            $ndpurchaseProduct->product_id = $id;
                            $ndpurchaseProduct->quantity = $productPurchases[$i]->quantity;
                            $ndpurchaseProduct->price = $productPurchases[$i]->price;
                            $ndpurchaseProduct->tax_rate = $productPurchases[$i]->tax_rate;
                            $ndpurchaseProduct->subtotal = $productPurchases[$i]->subtotal;
                            $ndpurchaseProduct->tax_subtotal = $productPurchases[$i]->tax_subtotal;
                            $ndpurchaseProduct->save();

                            if ($product->type_product == 'product') {
                                //devolviendo productos al inventario
                                if ($indicator->inventory == 'on') {
                                    $product->stock -= $productPurchases[$i]->quantity;
                                    $product->update();

                                    //devolviendo productos a la sucursal
                                    $branchProduct = BranchProduct::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();
                                    $branchProduct->stock -= $productPurchases[$i]->quantity;
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
                        return redirect("purchase");
                    }
                    if ($purchase->type_product == 'product') {
                        $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
                    } else {
                        $productPurchases = ProductRawmaterial::where('purchase_id', $purchase->id)->get();
                    }

                    for ($i=0; $i < count($price); $i++) {
                        foreach ($productPurchases as $key => $productPurchase) {
                            if ($productPurchase->product_id == $product_id[$i]) {
                                if ($productPurchase->price < $price[$i]) {
                                    toast(' precio de uno de los items no debe ser mayor al inicial en la compra','warning');
                                    return redirect("purchase");
                                }
                            }
                        }
                    }
                    if ($purchase->type_product == 'product') {
                        $this->ndpurchaseProductCreate($request, $document);//crear ndpurchaseProduct
                    } else {
                        $this->ndpurchaseRawmaterials($request, $document);//crear ndpurchaseProduct
                    }
                break;
                case(4):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("purchase");
                    }

                    if ($purchase->type_product == 'product') {
                        $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
                    } else {
                        $productPurchases = ProductRawmaterial::where('purchase_id', $purchase->id)->get();
                    }

                    for ($i=0; $i < count($price); $i++) {
                        foreach ($productPurchases as $key => $productPurchase) {
                            if ($productPurchase->product_id == $product_id[$i]) {
                                if ($productPurchase->price < $price[$i]) {
                                    toast(' precio de uno de los items no debe ser mayor al inicial en la compra','warning');
                                    return redirect("purchase");
                                }
                            }
                        }
                    }
                    if ($purchase->type_product == 'product') {
                        $this->ndpurchaseProductCreate($request, $document);//crear ndpurchaseProduct
                    } else {
                        $this->ndpurchaseRawmaterials($request, $document);//crear ndpurchaseProduct
                    }
                break;
                default:
                    $msg = 'No has seleccionado voucher.';
            }
            $document = $ndpurchase;
            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesLines($document, $taxes, $typeDocument);//Helper para Impuestos de linea
            retentions($request, $document, $typeDocument);// Helper para retenciones

            if ($advancePay > 0) {
                if ($reverse == 1) {
                    $cashInflow = new CashInflow();
                    $cashInflow->cash = $advancePay;
                    $cashInflow->reason = 'Ingreso de efectivo por nota debito' . $ndpurchase->id;
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
                            $cashRegister->out_purchase -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                } else {
                    $this->advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument);

                    if ($indicator->pos == 'on') {
                        $cashRegister->out_advance += $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->out_purchase -= $advancePay;
                        }
                        $cashRegister->update();
                    }
                }
                $purchase->balance = 0;
                $purchase->pay = $newGrandTotal;
                $purchase->update();
            }

            if ($indicator->pos == 'on' && $date1 == $date2) {
                $cashRegister->ndpurchase += $total_pay;
                $cashRegister->update();
            }

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            $purchase->balance -= $grandTotalNd;
            $purchase->grand_total = $newGrandTotal;
            //$purchase->pay = $newGrandTotal;
            if ($purchase->status == 'purchase') {
                if ($documentType == 11) {
                    $purchase->status = 'adjustment_note';
                } else {
                    if ($discrepancy == 2) {
                        $purchase->status = 'complete';
                    } else {
                        $purchase->status = 'debit_note';
                    }
                }
            } elseif ($purchase->status == 'credit_note') {
                $purchase->status = 'complete';
            } elseif ($purchase->status == 'support_document') {
                $purchase->status = 'adjustment_note';
            } elseif ($purchase->status == 'credit_note') {
                $purchase->status = 'complete';
            }
            $purchase->update();

            if ($documentType == 11 && $indicator->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $nsdResponse = new NsdResponse();
                $nsdResponse->document = $purchase->document;
                $nsdResponse->message = $service['message'];
                $nsdResponse->valid = $valid;
                $nsdResponse->code = $code;
                $nsdResponse->description = $description;
                $nsdResponse->status_message = $statusMessage;
                $nsdResponse->cuds = $service['cuds'];
                $nsdResponse->ndpurchase_id = $ndpurchase->id;
                $nsdResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/NDSNS-" . $resolution->prefix .
                $resolution->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/adjustment_notes_ds/' .
                $resolution->prefix . $resolution->consecutive . '.pdf', $pdf);
            }
            $resolution->consecutive += 1;
            $resolution->update();

            session()->forget('ndpurchase');
            session(['ndpurchase' => $ndpurchase->id]);

            toast('Nota Debito Registrada satisfactoriamente.','success');
            return redirect('ndpurchase');
        } else {
            toast($errorMessages,'Danger');
            return redirect('ndpurchase');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ndpurchase  $ndpurchase
     * @return \Illuminate\Http\Response
     */
    public function show(Ndpurchase $ndpurchase)
    {
        $ndpurchaseProducts = NdpurchaseProduct::where('ndpurchase_id', $ndpurchase->id)->where('quantity', '>', 0)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndpurchase')
        ->where('tax.taxable_id', $ndpurchase->id)
        ->where('tt.type_tax', 'retention')->get();

       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndpurchase')
        ->where('tax.taxable_id', $ndpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');
        return view('admin.ndpurchase.show', compact(
            'ndpurchase',
            'ndpurchaseProducts',
            'retentions',
            'retentionsum'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ndpurchase  $ndpurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Ndpurchase $ndpurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNdpurchaseRequest  $request
     * @param  \App\Models\Ndpurchase  $ndpurchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNdpurchaseRequest $request, Ndpurchase $ndpurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ndpurchase  $ndpurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ndpurchase $ndpurchase)
    {
        //
    }

    public function ndpurchasePdf(Request $request, $id)
    {
       $ndpurchase = ndpurchase::findOrFail($id);
       $ndpurchaseProducts = ndpurchaseProduct::where('ndpurchase_id', $id)->where('quantity', '>', 0)->get();
       $company = Company::findOrFail(1);
       $indicator = Indicator::findOrFail(1);
       $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndpurchase')
        ->where('tax.taxable_id', $ndpurchase->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndpurchase')
        ->where('tax.taxable_id', $ndpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

       $ndpurchasepdf = "COMP-". $ndpurchase->document;
       $logo = './imagenes/logos'.$company->logo;
       $view = \view('admin.ndpurchase.pdf', compact(
            'ndpurchase',
            'ndpurchaseProducts',
            'company',
            'indicator',
            'logo',
            'retentions',
            'retentionsum'
        ));
       $pdf = App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       //$pdf->setPaper ( 'A7' , 'landscape' );

       return $pdf->stream('vista-pdf', "$ndpurchasepdf.pdf");
       //return $pdf->download("$purchasepdf.pdf");*/
    }

    public function pdfNdpurchase(Request $request)
    {
        $ndpurchases = session('ndpurchase');
        $ndpurchase = Ndpurchase::findOrFail($ndpurchases);
        session()->forget('ndpurchase');
        $ndpurchaseProducts = ndpurchaseProduct::where('ndpurchase_id', $ndpurchase->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndpurchase')
        ->where('tax.taxable_id', $ndpurchase->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndpurchase')
        ->where('tax.taxable_id', $ndpurchase->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ndpurchasepdf = "COMP-". $ndpurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.ndpurchase.pdf', compact(
            'ndpurchase',
            'ndpurchaseProducts',
            'company',
            'indicator',
            'logo',
            'retentions',
            'retentionsum'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$ndpurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }
}

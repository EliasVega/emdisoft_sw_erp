<?php

namespace App\Http\Controllers;

use App\Models\Ndpurchase;
use App\Http\Requests\StoreNdpurchaseRequest;
use App\Http\Requests\UpdateNdpurchaseRequest;
use App\Models\Advance;
use App\Models\BranchProduct;
use App\Models\CashInflow;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Kardex;
use App\Models\NdpurchaseProduct;
use App\Models\Pay;
use App\Models\PayPaymentMethod;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Resolution;
use App\Models\Retention;
use App\Models\Tax;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Traits\AdvanceCreate;

class NdpurchaseController extends Controller
{
    use AdvanceCreate;

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
        $resolut = $request->resolution_id;
        $typeDocument = 'ndpurchase';
        //dd($request->all());


        if ($resolut) {
            $resolution = Resolution::findOrFail($request->resolution_id);//resolucion selecionada en el request
        } else {
            $resolution = Resolution::findOrFail(3);//resolucion selecionada en el request
        }
        $company = Company::findOrFail(current_user()->company_id);
        $purchase = Purchase::findOrFail($request->purchase_id);//encontrando la factura
        $environment = Environment::where('code', 'NDS')->first();//Url nota de ajuste documento soporte
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
        $tax_rate = $request->tax_rate;
        $retention = $request->total_retention;
        //$taxNdpurchase = $request->tax_iva;

        $payOld = $purchase->pay;//valor que registra la factura como pagos
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
        //$reversePay = $payOld - $payCash;
        $advancePay = $purchase->pay - $newGrandTotal;
        //variables para manejo segun discrepancia
        //$total_payOld = $purchase->total_pay;//valor de la compra antes de nota debito
        //$newTotal_pay = $total_payOld - $total_pay;//valor de compra menos la nota debito

        $newRetention = 0;//retencion compra menos retencion ND
        //$advancePay = 0;//valor del avance total compra menos newTotal_pay - new retention

        //$advancePay = $payOld - $payCash;
        //$data = AdjustmentNoteSend($request, $purchase);
        //dd($data);
        $documentType = $request->document_type_id;
        $store = false;
        if ($documentType == 11 && $indicator->dian == 'on') {
            $data = AdjustmentNoteSend($request, $purchase);
            $requestResponse = SendDocuments($company, $environment, $data);
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
            $ndpurchase->branch_id = current_user()->branch_id;;
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

            $voucher = VoucherType::findOrFail(11);
            $voucher->consecutive += 1;
            $voucher->update();

            //Seleccionar los productos de la compra
            $taxes[] = [];
            $contax = 0;
            $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
            switch($discrepancy) {
                case(1):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("purchase");
                    }

                    for ($i=0; $i < count($quantity); $i++) {
                        $id = $product_id[$i];
                        $product = Product::findOrFail($id);
                        if ($product->type_product == 'product') {
                            //devolviendo productos al inventario
                            if ($indicator->inventory == 'on') {
                                $product->stock -= $quantity[$i];
                                $product->update();

                                //devolviendo productos a la sucursal
                                $branchProduct = BranchProduct::where('branch_id', $purchase->branch_id)->where('product_id', $id)->first();
                                $branchProduct->stock -= $quantity[$i];
                                $branchProduct->update();
                            }

                            //Actualizando el  Kardex
                            $kardex = new Kardex();
                            $kardex->document = $ndpurchase->document;
                            $kardex->quantity = $quantity[$i];
                            $kardex->stock = $product->stock;
                            $kardex->movement = $typeDocument;
                            $kardex->product_id = $id;
                            $kardex->branch_id = $purchase->branch_id;
                            $kardex->voucher_type_id = 11;
                            $kardex->save();
                        }

                        //registrando nota debito productos
                        $ndpurchaseProduct = new NdpurchaseProduct();
                        $ndpurchaseProduct->ndpurchase_id = $ndpurchase->id;
                        $ndpurchaseProduct->product_id = $id;
                        $ndpurchaseProduct->quantity = $quantity[$i];
                        $ndpurchaseProduct->price = $price[$i];
                        $ndpurchaseProduct->tax_rate = $tax_rate[$i];
                        $ndpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndpurchaseProduct->save();

                        $companyTaxProduct = $product->category->company_tax_id;
                        $companyTax = CompanyTax::findOrFail($companyTaxProduct);
                        $taxAmount = $ndpurchaseProduct->tax_subtotal;
                        $amount = $ndpurchaseProduct->subtotal;
                        $taxRate = $ndpurchaseProduct->tax_rate;

                        if ($ndpurchaseProduct->tax_subtotal > 0) {

                            if ($taxes[0] != []) { //contax > 0
                                $contsi = 0;
                                foreach ($taxes as $key => $tax) {

                                    if ($tax[0] == $companyTaxProduct) {
                                        //$taxes[$key][2] += $productPurchase->tax_subtotal;
                                        $tax[2] += $taxAmount;
                                        $tax[3] += $amount;
                                        $contsi++;
                                    }
                                }
                                if ($contsi == 0) {
                                    $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                        $contax++;
                                }
                            } else {
                                //$taxes[$contax] = [$companyTaxProduct, $productPurchase->tax_rate, $productPurchase->tax_subtotal];
                                $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                $contax++;
                            }
                        }
                    }
                    break;
                case(2):
                    //$productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();
                    if ($store == true) {
                        for ($i=0; $i < count($productPurchases); $i++) {

                            //foreach ($productPurchases as $productPurchase) {
                            $id = $productPurchases[$i]->product_id;
                            $product = Product::findOrFail($id);

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

                            $companyTaxProduct = $product->category->company_tax_id;
                            $companyTax = CompanyTax::findOrFail($companyTaxProduct);
                            $taxAmount = $ndpurchaseProduct->tax_subtotal;
                            $amount = $ndpurchaseProduct->subtotal;
                            $taxRate = $ndpurchaseProduct->tax_rate;

                            if ($ndpurchaseProduct->tax_subtotal > 0) {
                                if ($taxes[0] != []) { //contax > 0
                                    $contsi = 0;
                                    foreach ($taxes as $key => $tax) {

                                        if ($tax[0] == $companyTaxProduct) {
                                            //$taxes[$key][2] += $productPurchase->tax_subtotal;
                                            $tax[2] += $taxAmount;
                                            $tax[3] += $amount;
                                            $contsi++;
                                        }
                                    }
                                    if ($contsi == 0) {
                                        $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                            $contax++;
                                    }
                                } else {
                                    //$taxes[$contax] = [$companyTaxProduct, $productPurchase->tax_rate, $productPurchase->tax_subtotal];
                                    $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                    $contax++;
                                }
                            }

                            $product = Product::findOrFail($id);
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

                                //Actualizando el  Kardex
                                $kardex = new Kardex();
                                $kardex->document = $ndpurchase->document;
                                $kardex->quantity = $productPurchases[$i]->quantity;
                                $kardex->stock = $product->stock;
                                $kardex->movement = $typeDocument;
                                $kardex->product_id = $id;
                                $kardex->branch_id = $purchase->branch_id;
                                $kardex->voucher_type_id = 11;
                                $kardex->save();
                            }
                        }
                    }
                    break;
                case(3):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("purchase");
                    }

                    $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();

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
                    for ($i=0; $i < count($quantity); $i++) {
                        $id = $product_id[$i];
                        $product = Product::findOrFail($id);

                        //registrando nota debito productos
                        $ndpurchaseProduct = new NdpurchaseProduct();
                        $ndpurchaseProduct->ndpurchase_id = $ndpurchase->id;
                        $ndpurchaseProduct->product_id = $id;
                        $ndpurchaseProduct->quantity = $quantity[$i];
                        $ndpurchaseProduct->price = $price[$i];
                        $ndpurchaseProduct->tax_rate = $tax_rate[$i];
                        $ndpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndpurchaseProduct->save();

                        $companyTaxProduct = $product->category->company_tax_id;
                        $companyTax = CompanyTax::findOrFail($companyTaxProduct);
                        $taxAmount = $ndpurchaseProduct->tax_subtotal;
                        $amount = $ndpurchaseProduct->subtotal;
                        $taxRate = $ndpurchaseProduct->tax_rate;

                        if ($ndpurchaseProduct->tax_subtotal > 0) {
                            if ($taxes[0] != []) { //contax > 0
                                $contsi = 0;
                                foreach ($taxes as $key => $tax) {

                                    if ($tax[0] == $companyTaxProduct) {
                                        //$taxes[$key][2] += $productPurchase->tax_subtotal;
                                        $tax[2] += $taxAmount;
                                        $tax[3] += $amount;
                                        $contsi++;
                                    }
                                }
                                if ($contsi == 0) {
                                    $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                        $contax++;
                                }
                            } else {
                                //$taxes[$contax] = [$companyTaxProduct, $productPurchase->tax_rate, $productPurchase->tax_subtotal];
                                $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                $contax++;
                            }
                        }
                    }
                    break;
                case(4):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("purchase");
                    }

                    $productPurchases = ProductPurchase::where('purchase_id', $purchase->id)->get();

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
                    for ($i=0; $i < count($quantity); $i++) {
                        $id = $product_id[$i];
                        $product = Product::findOrFail($id);

                        //registrando nota debito productos
                        $ndpurchaseProduct = new NdpurchaseProduct();
                        $ndpurchaseProduct->ndpurchase_id = $ndpurchase->id;
                        $ndpurchaseProduct->product_id = $id;
                        $ndpurchaseProduct->quantity = $quantity[$i];
                        $ndpurchaseProduct->price = $price[$i];
                        $ndpurchaseProduct->tax_rate = $tax_rate[$i];
                        $ndpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndpurchaseProduct->save();

                        $companyTaxProduct = $product->category->company_tax_id;
                        $companyTax = CompanyTax::findOrFail($companyTaxProduct);
                        $taxAmount = $ndpurchaseProduct->tax_subtotal;
                        $amount = $ndpurchaseProduct->subtotal;
                        $taxRate = $ndpurchaseProduct->tax_rate;

                        if ($ndpurchaseProduct->tax_subtotal > 0) {
                            if ($taxes[0] != []) { //contax > 0
                                $contsi = 0;
                                foreach ($taxes as $key => $tax) {

                                    if ($tax[0] == $companyTaxProduct) {
                                        //$taxes[$key][2] += $productPurchase->tax_subtotal;
                                        $tax[2] += $taxAmount;
                                        $tax[3] += $amount;
                                        $contsi++;
                                    }
                                }
                                if ($contsi == 0) {
                                    $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                        $contax++;
                                }
                            } else {
                                //$taxes[$contax] = [$companyTaxProduct, $productPurchase->tax_rate, $productPurchase->tax_subtotal];
                                $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                                $contax++;
                            }
                        }
                    }
                    break;
                default:
                    $msg = 'No has seleccionado voucher.';
            }
            $document = $ndpurchase;
            TaxesLines($document, $taxes, $typeDocument);
            Retentions($request, $document, $typeDocument);

            if ($advancePay > 0) {
                if ($reverse == 1) {
                    $cashInflow = new CashInflow();
                    $cashInflow->cash = $advancePay;
                    $cashInflow->reason = 'Ingreso de efectivo por nota devito' . $ndpurchase->id;
                    $cashInflow->cash_register_id = $cashRegister->id;
                    $cashInflow->user_id = current_user()->id;
                    $cashInflow->branch_id = current_user()->branch_id;
                    $cashInflow->admin_id = current_user()->id;
                    $cashInflow->save();

                    if ($indicator->post == 'on') {
                        $cashRegister->cash += $advancePay;
                        $cashRegister->in_cash += $advancePay;
                        $cashRegister->in_total += $advancePay;

                        $cashRegister->out_purchase -= $advancePay;
                        //$cashRegister->out_total -= $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->purchase -= $total_pay;
                        }

                        $cashRegister->ndpurchase = $total_pay;
                        $cashRegister->update();
                    }

                    $purchase->balance = 0;
                    $purchase->grand_total = $newGrandTotal;
                    $purchase->pay = $newGrandTotal;
                    $purchase->update();
                } else {
                    $this->advanceCreate($voucherTypes, $purchase, $advancePay);

                    if ($indicator->post == 'on') {
                        $cashRegister->out_advance += $advancePay;

                        $cashRegister->out_purchase -= $advancePay;
                        //$cashRegister->out_total -= $advancePay;
                        if ($date1 == $date2) {
                            $cashRegister->purchase -= $total_pay;
                        }

                        $cashRegister->ndpurchase += $total_pay;

                        $cashRegister->update();
                    }

                    $purchase->balance = 0;
                    $purchase->grand_total = $newGrandTotal;
                    $purchase->pay = $newGrandTotal;
                    if ($purchase->status == 'purchase') {
                        if ($documentType == 11) {
                            $purchase->status = 'adjustment_note';
                        } else {
                            $purchase->status = 'debit_note';
                        }
                    } elseif ($purchase->status == 'credit_note') {
                        $purchase->status = 'complete';
                    }
                    $purchase->update();
                }
            } else {
                $advancePayPos = $advancePay * (-1);
                $purchase->grand_total = $newGrandTotal;
                $purchase->balance = $advancePayPos;
                if ($purchase->status == 'purchase') {
                    if ($documentType == 11) {
                        $purchase->status = 'adjustment_note';
                    } else {
                        $purchase->status = 'debit_note';
                    }
                } elseif ($purchase->status == 'credit_note') {
                    $purchase->status = 'complete';
                }
                $purchase->update();

                if ($indicator->post == 'on') {
                    $cashRegister->ndpurchase += $total_pay;
                    if ($date1 == $date2) {
                        $cashRegister->purchase -= $total_pay;
                    }
                    $cashRegister->update();
                }
            }

            session(['ndpurchase' => $ndpurchase->id]);

            toast('Nota Debito Registrada satisfactoriamente.','success');
            return redirect('ndpurchase');
        } else {
            toast('Nota Debito No fue Registrada.','success');
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
        return view('admin.ndpurchase.show', compact('ndpurchase', 'ndpurchaseProducts'));
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
       $retention = Retention::where('type', 'ndpurchase')->where('retentionable_id', $id)->first();
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
       $view = \view('admin.ndpurchase.pdf', compact('ndpurchase', 'ndpurchaseProducts', 'company', 'logo', 'retentions', 'retentionsum'));
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
        $retention = Retention::where('type', 'ndpurchase')->where('retentionable_id', $ndpurchase->id)->first();

        $ndpurchasepdf = "COMP-". $ndpurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.ndpurchase.pdf', compact('ndpurchase', 'ndpurchaseProducts', 'company', 'logo', 'retention'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$ndpurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }
}

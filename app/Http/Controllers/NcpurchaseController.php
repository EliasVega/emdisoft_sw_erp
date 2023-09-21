<?php

namespace App\Http\Controllers;

use App\Models\Ncpurchase;
use App\Http\Requests\StoreNcpurchaseRequest;
use App\Http\Requests\UpdateNcpurchaseRequest;
use App\Models\BranchProduct;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Indicator;
use App\Models\Kardex;
use App\Models\NcpurchaseProduct;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Resolution;
use App\Models\Retention;
use App\Models\Tax;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class NcpurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ncpurchase.index|ncpurchase.store|ncpurchase.show', ['only'=>['index']]);
        $this->middleware('permission:ncpurchase.store', ['only'=>['create','store']]);
        $this->middleware('permission:ncpurchase.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
            ->addColumn('branch', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->branch->name;
            })
            ->addColumn('provider', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->third->name;
            })
            ->addColumn('document', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->purchase->document;
            })

            ->addColumn('user', function (Ncpurchase $ncpurchase) {
                return $ncpurchase->user->name;
            })

            ->editColumn('created_at', function(Ncpurchase $ncpurchase){
                return $ncpurchase->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ncpurchase/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ncpurchase.index', compact('ncpurchase'));
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
        $typeDocument = 'ncpurchase';
        $quantity = $request->quantity;
        $price = $request->price;
        $total_pay = $request->total_pay;
        $product_id = $request->product_id;
        $discrepancy = $request->discrepancy_id;
        $tax_rate = $request->tax_rate;
        $retention = $request->total_retention;
        $taxNcpurchase = $request->tax_iva;

        $resolution = Resolution::findOrFail(2);
        $purchase = Purchase::findOrFail($request->purchase_id);
        //$pay = Pay::where('type', 'purchase')->where('payable_id', $purchase->id)->get();
        $indicator = Indicator::findOrFail(1);
        //$voucherTypes = VoucherType::findOrFail(18);
        $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
        //$retentions = Retention::where('type', 'purchase')->where('retentionable_id', $purchase->id)->first();
        //$taxPurchase = Tax::where('type', 'purchase')->where('taxable_id', $purchase->id)->get();
        $taxPurchase = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->where('tax.type', 'purchase')
        ->where('tax.taxable_id', $purchase->id)
        ->where('tt.id', 1)
        ->sum('tax.tax_value');

        $branch = $purchase->branch_id;
        $total_payOld = $purchase->total_pay;

        //variables para manejo segun discrepancia
        $newTotal_pay = $total_payOld + $total_pay;
        $newRetention = 0;
        $retentionPurchase = 0;
        $retentionnc = 0;


        //Registrar tabla Nota Credito
        $ncpurchase = new Ncpurchase();
        $ncpurchase->document = $resolution->prefix . '-' . $resolution->consecutive;
        $ncpurchase->user_id = current_user()->id;
        $ncpurchase->branch_id = current_user()->branch_id;
        $ncpurchase->purchase_id = $purchase->id;
        $ncpurchase->provider_id = $purchase->provider_id;
        $ncpurchase->resolution_id = $resolution->id;
        $ncpurchase->discrepancy_id = $discrepancy;
        $ncpurchase->voucher_type_id = 10;
        $ncpurchase->retention = $retention;
        $ncpurchase->total = $request->total;
        $ncpurchase->total_tax = $request->total_tax;
        $ncpurchase->total_pay = $request->total_pay;
        $ncpurchase->save();



        if ($indicator->post == 'on') {
            //actualizar la caja
            $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
            $cashRegister->ncpurchase += $ncpurchase->total_pay;
            $cashRegister->update();
        }
        /*
        if ($retentions) {
            $percentage = $retentions->percentage->percentage;

            $retention = new Retention();
            $retention->retention = ($total * $percentage)/100;
            $retention->type = 'ncpurchase';
            $retention->percentage_id = $retentions->percentage_id;
            $ncpurchase->retention()->save($retention);

            $retentionnc = $retention->retention;
            $retentionPurchase = $retentions->retention;
            $newRetention = $retentionPurchase + $retentionnc;
        }*/

        /*
        $purchase->balance += ($total_pay - $retentionnc);
        $purchase->grand_total += ($total_pay - $retentionnc);
        $purchase->update();*/

        //Seleccionar los productos de la compra

        //Toma el Request del array
        $taxes[] = [];
        $contax = 0;
        switch($discrepancy) {
            case(7):
                if ($total_pay <= 0) {
                    toast(' Nota credito no debe ser menor o igual a 0.','warning');
                    return redirect("purchase");
                }
                for ($i=0; $i < count($quantity); $i++) {
                    $id = $product_id[$i];
                    //selecciona el producto que viene del array
                    $product = Product::findOrFail($id);
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

                    $product->stock += $quantity[$i];
                    $product->update();

                    $branchProducts = BranchProduct::where('product_id', '=', $id)
                    ->where('branch_id', '=', $branch)
                    ->first();

                    //selecciona el impuesto que tiene la categoria IVA o INC
                    $companyTaxProduct = $product->category->company_tax_id;
                    $companyTax = CompanyTax::findOrFail($companyTaxProduct);
                    $taxAmount = $ncpurchaseProduct->tax_subtotal;
                    $amount = $ncpurchaseProduct->subtotal;
                    $taxRate = $ncpurchaseProduct->tax_rate;

                    if ($ncpurchaseProduct->tax_subtotal > 0) {
                        if ($taxes[0] != []) { //contax > 0
                            $contsi = 0;
                            foreach ($taxes as $key => $tax) {

                                if ($tax[0] == $companyTaxProduct) {
                                    $tax[2] += $taxAmount;
                                    $tax[3] += $amount;
                                    $contsi++;
                                }
                            }
                            if ($contsi == 0) {
                                $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate[$i]];
                                    $contax++;
                            }
                        } else {
                            $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate[$i]];
                            $contax++;
                        }
                    }

                    if ($product->type_product == 'product') {
                        if ($indicator->inventory == 'on') {

                            if ($indicator->product_price == 'automatic') {
                                //Actualizar stock y precio del producto
                                $utility = $product->category->utility_rate;//valor registrado de utilidad
                                $priceOld = $product->price; //precio actual del producto
                                $stockardex = $product->stock; //stock actual del producto
                                //Actualizando el valor de venta del producto
                                $priceNew = (($stockardex * $priceOld) + ($quantity[$i] * $price[$i])) / ($stockardex + $quantity[$i]);
                                $priceSale = $priceNew + ($priceNew * $utility / 100); //Actualizando el valor
                                //Actualizando los valores en los registros de la BD
                                $product->stock += $quantity[$i]; //reempazando triguer
                                $product->price = $priceNew;
                                $product->sale_price = $priceSale;
                                $product->update();

                            } else {
                                //Actualizar stock y precio del producto
                                $product->stock += $quantity[$i]; //reempazando triguer
                                $product->price = $price[$i];
                                $product->sale_price = $price[$i];
                                $product->update();
                            }


                            //Actualizando o creando productos en determinada sucursal
                            if (isset($branchProducts)) {
                                //metodo para actualizar el producto en la sucursal stock
                                $branchProducts->stock += $quantity[$i];
                                $branchProducts->update();
                            } else {
                                //metodo para crear el producto en la sucursal y asignar stock
                                $branchProduct = new BranchProduct();
                                $branchProduct->branch_id = $branch;
                                $branchProduct->product_id = $product_id[$i];
                                $branchProduct->stock = $quantity[$i];
                                $branchProduct->order_product = 0;
                                $branchProduct->save();
                            }
                        }
                    } else {
                        if ($indicator->inventory == 'on') {
                            //Actualizar stock y precio del producto
                            $product->stock += $quantity[$i];
                            $product->price = $price[$i];
                            $product->sale_price = $price[$i];
                            $product->update();

                            //Actualizando o creando productos en determinada sucursal
                            if (isset($branchProducts)) {
                                //metodo para actualizar el producto en la sucursal stock
                                $branchProducts->stock += $quantity[$i];
                                $branchProducts->update();
                            } else {
                                //metodo para crear el producto en la sucursal y asignar stock
                                $branchProduct = new BranchProduct();
                                $branchProduct->branch_id = $branch;
                                $branchProduct->product_id = $product_id[$i];
                                $branchProduct->stock = $quantity[$i];
                                $branchProduct->order_product = 0;
                                $branchProduct->save();
                            }
                        }
                    }
                    //Actualiza la tabla del Kardex
                    $kardex = new Kardex();
                    $kardex->product_id = $product_id[$i];
                    $kardex->branch_id = $branch;
                    $kardex->voucher_type_id = 10;
                    $kardex->document = $purchase->document;
                    $kardex->quantity = $quantity[$i];
                    $kardex->stock = $product->stock;
                    $kardex->movement = $typeDocument;
                    $kardex->save();

                }
                break;
            case(8):

                if ($total_pay <= 0) {
                    toast(' Nota credito no debe ser menor o igual a 0 en ningun item.','warning');
                    return redirect("purchase");
                }
                for ($i=0; $i < count($quantity); $i++) {
                    $id = $product_id[$i];

                    $product = Product::findOrFail($id);
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

                    //selecciona el impuesto que tiene la categoria IVA o INC
                    $companyTaxProduct = $product->category->company_tax_id;
                    $companyTax = CompanyTax::findOrFail($companyTaxProduct);
                    $taxAmount = $ncpurchaseProduct->tax_subtotal;
                    $amount = $ncpurchaseProduct->subtotal;
                    $taxRate = $ncpurchaseProduct->tax_rate;

                    if ($ncpurchaseProduct->tax_subtotal > 0) {
                        if ($taxes[0] != []) { //contax > 0
                            $contsi = 0;
                            foreach ($taxes as $key => $tax) {

                                if ($tax[0] == $companyTaxProduct) {
                                    $tax[2] += $taxAmount;
                                    $tax[3] += $amount;
                                    $contsi++;
                                }
                            }
                            if ($contsi == 0) {
                                $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate[$i]];
                                    $contax++;
                            }
                        } else {
                            $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate[$i]];
                            $contax++;
                        }
                    }
                }
                break;
        }

        $document = $ncpurchase;
        TaxesLines($document, $taxes, $typeDocument);
        Retentions($request, $document, $typeDocument);

        $voucherTypes = VoucherType::findOrFail(10);
        $voucherTypes->consecutive += 1;
        $voucherTypes->update();

        $resolution->consecutive += 1;
        $resolution->update();

        $purchase->grand_total = $newTotal_pay;
        if ($purchase->status == 'purchase') {
            $purchase->status = 'credit_note';
        } elseif ($purchase->status == 'debit_note') {
            $purchase->status = 'complete';
        }
        $purchase->update();

        session(['ncpurchase' => $ncpurchase->id]);

        toast('Nota Credito Registrada satisfactoriamente.','success');
        return redirect('ncpurchase');
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
        return view('admin.ncpurchase.show', compact('ncpurchase', 'ncpurchaseProducts'));
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

    public function ncpurchasePdf(Request $request, $id)
    {
       $ncpurchase = Ncpurchase::findOrFail($id);
       $ncpurchaseProducts = NcpurchaseProduct::where('ncpurchase_id', $id)->where('quantity', '>', 0)->get();
       $company = Company::findOrFail(1);

       $ncpurchasepdf = "COMP-". $ncpurchase->document;
       $logo = './imagenes/logos'.$company->logo;
       $view = \view('admin.ncpurchase.pdf', compact('ncpurchase', 'ncpurchaseProducts', 'company', 'logo'));
       $pdf = App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       //$pdf->setPaper ( 'A7' , 'landscape' );

       return $pdf->stream('vista-pdf', "$ncpurchasepdf.pdf");
       //return $pdf->download("$purchasepdf.pdf");*/
    }

    public function pdfNcpurchase(Request $request)
    {
        $ncpurchases = session('ncpurchase');
        $ncpurchase = Ncpurchase::findOrFail($ncpurchases);
        session()->forget('ncpurchase');
        $ncpurchaseProducts = NcpurchaseProduct::where('ncpurchase_id', $ncpurchase->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);

        $ncpurchasepdf = "COMP-". $ncpurchase->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.ncpurchase.pdf', compact('ncpurchase', 'ncpurchaseProducts', 'company', 'logo'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$ncpurchasepdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }
}

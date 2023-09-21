<?php

namespace App\Http\Controllers;

use App\Models\PrePurchaseProduct;
use App\Http\Requests\StorePrePurchaseProductRequest;
use App\Http\Requests\UpdatePrePurchaseProductRequest;
use App\Models\Advance;
use App\Models\BranchProduct;
use App\Models\CashRegister;
use App\Models\Indicator;
use App\Models\Kardex;
use App\Models\pay;
use App\Models\PayPaymentMethod;
use App\Models\Percentage;
use App\Models\PrePurchase;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\Resolution;
use App\Models\Retention;
use App\Models\VoucherType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isNull;

class PrePurchaseProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:prePurchaseProduct.store', ['only'=>['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePrePurchaseProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrePurchaseProductRequest $request)
    {
        try{
            DB::beginTransaction();
            $resolutions = Resolution::findOrFail($request->resolution_id);
            $prePurchase = PrePurchase::findOrFail($request->prePurchase);
            $indicator = Indicator::where('id', 1)->first();

            //Variables del request
            $product_id = $request->product_id;
            $quantity = $request->quantity;
            $price = $request->price;
            $salePrice = $request->salePrice;
            $tax_rate = $request->tax_rate;
            $branch = $request->branch_id;
            $total_pay = $request->total_pay;
            $total = $request->total;
            $totalpay = $request->totalpay;
            $retention = $request->retention;
            $percentage = $request->percentage_id;
            //variables del request
            $paymentMethod = $request->payment_method_id;
            $bank = $request->bank_id;
            $card = $request->card_id;
            $advance_id = $request->advance_id;
            $payment = $request->pay;
            $transaction = $request->transaction;
            $payAdvance = $request->payment;
            $documentType = $request->document_type_id;

            if ($percentage > 0) {
                $percentages = Percentage::findOrFail($percentage);
            }

            //Crea un registro de compras
                        //Crea un registro de compras
            $purchase = new Purchase();
            $purchase->user_id = $prePurchase->user_id;
            $purchase->branch_id = Auth::user()->branch_id;
            $purchase->provider_id = $prePurchase->provider_id;
            $purchase->payment_form_id = $request->payment_form_id;
            $purchase->payment_method_id = $request->payment_method_id[0];
            $purchase->resolution_id = $request->resolution_id;
            $purchase->generation_type_id = $request->generation_type_id;
            $purchase->document_type_id = $documentType;
            if ($documentType == 11) {
                $voucherTypes = VoucherType::findOrFail(12);
                $purchase->document = $resolutions->prefix . '-' . $resolutions->consecutive;
                $purchase->invoice_code = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $purchase->voucher_type_id = 12;
                $voucherTypes->consecutive += 1;
                $voucherTypes->update();
            } else {
                $voucherTypes = VoucherType::findOrFail(7);
                $purchase->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $purchase->invoice_code = $request->invoice_code;
                $purchase->voucher_type_id = 7;
                $voucherTypes->consecutive += 1;
                $voucherTypes->update();
            }
            $purchase->generation_date = $request->generation_date;
            $purchase->due_date = $request->due_date;
            $purchase->total = $total;
            $purchase->total_iva = $request->total_iva;
            $purchase->total_pay = $total_pay;
            $purchase->status = 'active';
            if ($totalpay > 0) {
                $purchase->pay = $totalpay;
            } else {
                $purchase->pay = 0;
            }
            $purchase->balance = $total_pay - $totalpay - $retention;
            $purchase->grand_total = $total_pay - $retention;
            $purchase->start_date = $request->start_date;
            $purchase->save();

            if ($retention > 0) {
                $retentions = new Retention();
                $retentions->retention = $total * $percentages->percentage/100;
                $retentions->type = 'purchase';
                $retentions->percentage_id = $percentage;
                $purchase->retention()->save($retentions);
            }

            $voucher = VoucherType::findOrFail(19);
            $voucher->consecutive = $purchase->id;
            $voucher->update();

            if ($indicator->post == 'on') {
                //actualizar la caja
                $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
                $cashRegister->purchase += $purchase->total_pay;
                $cashRegister->out_total += $totalpay;
                $cashRegister->update();
            }

            //Toma el Request del array

            for ($i=0; $i < count($product_id); $i++) {
                $productPurchase = new ProductPurchase();
                $productPurchase->purchase_id = $purchase->id;
                $productPurchase->product_id = $product_id[$i];
                $productPurchase->quantity = $quantity[$i];
                $productPurchase->price = $price[$i];
                $productPurchase->tax_rate = $tax_rate[$i];
                $productPurchase->subtotal = $quantity[$i] * $price[$i];
                $productPurchase->iva_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                $productPurchase->save();

                //selecciona el producto que viene del array
                $products = Product::where('id', $productPurchase->product_id)->first();

                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('product_id', '=', $productPurchase->product_id)
                ->where('branch_id', '=', $branch)
                ->first();

                if ($products->type == 'product') {
                    if ($indicator->inventory == 'on') {
                        if ($indicator->product_price == 'automatic') {
                            //Actualizar stock y precio del producto
                            $utility = $products->category->utility_rate;//valor registrado de utilidad
                            $priceOld = $products->price; //precio actual del producto
                            $stockardex = $products->stock; //stock actual del producto
                            //Actualizando el valor de venta del producto
                            $priceNew = (($stockardex * $priceOld) + ($quantity[$i] * $price[$i])) / ($stockardex + $quantity[$i]);
                            $priceSale = $priceNew + ($priceNew * $utility / 100); //Actualizando el valor
                            //Actualizando los valores en los registros de la BD
                            $products->stock += $quantity[$i]; //reempazando triguer
                            $products->price = $priceNew;
                            $products->sale_price = $priceSale;
                            $products->update();

                        } else {
                            //Actualizar stock y precio del producto
                            $products->stock += $quantity[$i]; //reempazando triguer
                            $products->price = $price[$i];
                            $products->sale_price = $salePrice[$i];
                            $products->update();
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
                    if ($products->type == 'product') {
                        //Actualizar stock y precio del producto
                        $products->price = $price[$i];
                        $products->sale_price = $salePrice[$i];
                        $products->update();

                        //Actualizando o creando productos en determinada sucursal
                        if ($branchProducts) {
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
                if ($documentType == 11) {
                    $kardex->voucher_type_id = 12;
                } else {
                    $kardex->voucher_type_id = 7;
                }
                $kardex->document = $purchase->document;
                $kardex->quantity = $quantity[$i];
                $kardex->stock = $stockardex;
                $kardex->movement = 'purchase';
                $kardex->save();
            }

            //variables necesarias

            if ($totalpay > 0) {
                //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
                $pay = new pay();
                $pay->user_id = $prePurchase->user->id;
                $pay->branch_id = Auth::user()->branch_id;
                $pay->pay = $totalpay;
                $pay->balance = $purchase->balance;
                $pay->type = 'purchase';
                $purchase->pays()->save($pay);


                for ($i=0; $i < count($payment); $i++) {

                    //Metodo que descuenta el valor del pago de un anticipo
                    if ($payAdvance != 0) {

                        $advance = Advance::findOrFail( $request->advance_id);
                            //si el pago es utilizado en su totalidad agregar el destino aplicado
                            if ($advance->pay > $advance->balance) {
                                $advance->destination = $advance->destination . '<->' . $purchase->document;
                            } else {
                                $advance->destination = $purchase->document;
                            }
                            //variable si hay saldo en el pago anticipado
                            $payAdvance_total = $advance->balance - $payAdvance;
                            //cambiar el status del pago anticipado
                            if ($payAdvance_total == 0) {
                                $advance->status      = 'applied';
                            } else {
                                $advance->status      = 'partial';
                            }
                            //actualizar el saldo del pago anticipado
                            $advance->balance = $payAdvance_total;
                            $advance->update();
                    }

                    //Metodo para registrar la relacion entre pago y metodo de pago
                    $pay_paymentMethod = new PayPaymentMethod();
                    $pay_paymentMethod->pay_id = $pay->id;
                    $pay_paymentMethod->payment_method_id = $paymentMethod[$i];
                    $pay_paymentMethod->bank_id = $bank[$i];
                    $pay_paymentMethod->card_id = $card[$i];
                    if (isset($advance_id[$i])){
                        $pay_paymentMethod->advance_id = $advance_id[$i];
                    }
                    $pay_paymentMethod->pay = $payment[$i];
                    $pay_paymentMethod->transaction = $transaction[$i];
                    $pay_paymentMethod->save();

                    $mp = $paymentMethod[$i];
                    if ($indicator->post == 'on') {
                        //metodo para actualizar la caja

                        $cashRegister = CashRegister::where('user_id', '=', $purchase->user_id)->where('status', '=', 'open')->first();
                        if($mp == 10){
                            $cashRegister->out_purchase_cash += $payment[$i];
                            $cashRegister->cash_out_total += $payment[$i];
                        }
                        $cashRegister->out_purchase += $payment[$i];
                        $cashRegister->update();
                    }

                }

            $prePurchase->status = 'generated';
            $prePurchase->update();
            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        Alert::success('Compra','Creada Satisfactoriamente.');
        return redirect('purchase');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrePurchaseProduct  $prePurchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function show(PrePurchaseProduct $prePurchaseProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrePurchaseProduct  $prePurchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PrePurchaseProduct $prePurchaseProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrePurchaseProductRequest  $request
     * @param  \App\Models\PrePurchaseProduct  $prePurchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrePurchaseProductRequest $request, PrePurchaseProduct $prePurchaseProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrePurchaseProduct  $prePurchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrePurchaseProduct $prePurchaseProduct)
    {
        //
    }
}

<?php
namespace App\Traits;

use App\Models\NdpurchaseProduct;
use App\Models\Product;

trait NdpurchaseProductCreate {
    public function ndpurchaseProductCreate($request, $ndpurchase){
        //variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        for ($i=0; $i < count($product_id); $i++) {

            //registrando nota debito productos
            $ndpurchaseProduct = new NdpurchaseProduct();
            $ndpurchaseProduct->ndpurchase_id = $ndpurchase->id;
            $ndpurchaseProduct->product_id = $product_id[$i];
            $ndpurchaseProduct->quantity = $quantity[$i];
            $ndpurchaseProduct->price = $price[$i];
            $ndpurchaseProduct->tax_rate = $tax_rate[$i];
            $ndpurchaseProduct->subtotal = $quantity[$i] * $price[$i];
            $ndpurchaseProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $ndpurchaseProduct->save();
        }

        return $ndpurchaseProduct;
    }
}

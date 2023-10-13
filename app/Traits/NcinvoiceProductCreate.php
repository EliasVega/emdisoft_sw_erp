<?php
namespace App\Traits;

use App\Models\NcinvoiceProduct;

trait NcinvoiceProductCreate {
    public function ncinvoiceProductCreate($request, $document){
        //variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        for ($i=0; $i < count($product_id); $i++) {

            //registrando nota debito productos
            $ncinvoiceProduct = new NcinvoiceProduct();
            $ncinvoiceProduct->ncinvoice_id = $document->id;
            $ncinvoiceProduct->product_id = $product_id[$i];
            $ncinvoiceProduct->quantity = $quantity[$i];
            $ncinvoiceProduct->price = $price[$i];
            $ncinvoiceProduct->tax_rate = $tax_rate[$i];
            $ncinvoiceProduct->subtotal = $quantity[$i] * $price[$i];
            $ncinvoiceProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $ncinvoiceProduct->save();
        }

        return $ncinvoiceProduct;
    }
}

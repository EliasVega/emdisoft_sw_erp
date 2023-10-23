<?php
namespace App\Traits;

use App\Models\NdpurchaseProduct;
use App\Models\NdpurchaseRawmaterial;

trait NdpurchaseRawmaterials {
    public function ndpurchaseRawmaterials($request, $document){
        //variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        for ($i=0; $i < count($product_id); $i++) {

            //registrando nota debito productos
            $ndpurchaseRawmaterial = new NdpurchaseRawmaterial();
            $ndpurchaseRawmaterial->ndpurchase_id = $document->id;
            $ndpurchaseRawmaterial->raw_material_id = $product_id[$i];
            $ndpurchaseRawmaterial->quantity = $quantity[$i];
            $ndpurchaseRawmaterial->price = $price[$i];
            $ndpurchaseRawmaterial->tax_rate = $tax_rate[$i];
            $ndpurchaseRawmaterial->subtotal = $quantity[$i] * $price[$i];
            $ndpurchaseRawmaterial->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $ndpurchaseRawmaterial->save();
        }

        return $ndpurchaseRawmaterial;
    }
}

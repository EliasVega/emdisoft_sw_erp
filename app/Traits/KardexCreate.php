<?php
namespace App\Traits;

use App\Models\Kardex;

trait KardexCreate {
    public function kardexCreate($product, $branch, $voucherType, $document, $quantity, $typeDocument){
        //Actualiza la tabla del Kardex
        $kardex = new Kardex();
        $kardex->product_id = $product->id;
        $kardex->branch_id = $branch;
        $kardex->voucher_type_id = $voucherType;
        $kardex->document = $document->document;
        $kardex->quantity = $quantity;
        $kardex->stock = $product->stock;
        $kardex->movement = $typeDocument;
        $kardex->save();
    }
}

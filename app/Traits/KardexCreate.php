<?php
namespace App\Traits;

use App\Models\Kardex;

trait KardexCreate {
    public function kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument){
        //Actualiza la tabla del Kardex
        if ($typeDocument == 'pos') {
            $typeDocument = 'invoice';
        }
        if ($typeDocument == 'remissionPos') {
            $typeDocument = 'remission';
        }

        $kardex = new Kardex();
        $kardex->branch_id = $branch;
        $kardex->voucher_type_id = $voucherType;
        $kardex->document = $document->document;
        $kardex->quantity = $quantityLocal;
        $kardex->stock = $product->stock;
        $kardex->movement = $typeDocument;
        $product->kardexes()->save($kardex);
    }
}

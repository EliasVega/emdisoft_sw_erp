<?php
namespace App\Traits;

use App\Models\Advance;
use App\Models\Provider;

trait Taxes {
    public function getTaxesLine($voucherTypes, $purchase, $reversePay, $payCash){

        $advance = new Advance();
        $advance->user_id = current_user()->id;
        $advance->branch_id = current_user()->branch_id;
        $advance->voucher_type_id = 18;
        $advance->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
        $advance->origin = 'Factura de Compra' . '-' . $purchase->id;
        $advance->destination = null;
        $advance->pay = $reversePay;
        $advance->balance = $reversePay;
        $advance->note = 'por eliminacion de compra' . '-' . $purchase->id . ' Ingresado a caja ' . $payCash ;
        $advance->status = 'pending';
        $provider = Provider::findOrFail($purchase->provider_id);
        $advance->type = 'provider';
        $provider->advances()->save($advance);
    }
}

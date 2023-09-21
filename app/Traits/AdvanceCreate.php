<?php
namespace App\Traits;

use App\Models\Advance;
use App\Models\Provider;

trait AdvanceCreate {
    public function advanceCreate($voucherTypes, $purchase, $advancePay){

        $advance = new Advance();
        $advance->user_id = current_user()->id;
        $advance->branch_id = current_user()->branch_id;
        $advance->voucher_type_id = 18;
        $advance->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
        $advance->origin = 'Factura de Compra' . '-' . $purchase->id;
        $advance->destination = null;
        $advance->pay = $advancePay;
        $advance->balance = $advancePay;
        $advance->note = 'por nota de Ajuste (debito) a compra' . '-' . $purchase->id;
        $advance->status = 'pending';
        $provider = Provider::findOrFail($purchase->provider_id);
        $advance->type_third = 'provider';
        $provider->advances()->save($advance);
    }
}

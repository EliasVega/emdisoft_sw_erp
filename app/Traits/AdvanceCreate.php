<?php
namespace App\Traits;

use App\Models\Advance;
use App\Models\Provider;

trait AdvanceCreate {
    public function advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument){

        $advance = new Advance();
        $advance->user_id = current_user()->id;
        $advance->branch_id = current_user()->branch_id;
        $advance->voucher_type_id = 18;
        $advance->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
        $advance->destination = null;
        $advance->pay = $advancePay;
        $advance->balance = $advancePay;
        $advance->status = 'pending';
        switch ($typeDocument) {
            case 'ndpurchase':
                $advance->origin = 'Factura de Compra' . '-' . $documentOrigin->id;
                $advance->note = 'por nota de Ajuste (debito) a compra' . '-' . $documentOrigin->id;
                $provider = Provider::findOrFail($typeDocument->provider_id);
                $advance->type_third = 'provider';
                $provider->advances()->save($advance);
                break;
        }
    }
}

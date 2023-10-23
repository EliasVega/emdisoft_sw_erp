<?php
namespace App\Traits;

use App\Models\CashInflow;
use App\Models\VoucherType;
use App\Traits\AdvanceCreate;

trait reverse {
    use AdvanceCreate;
    public function reverse($reverse, $advancePay, $cashRegister, $indicator, $documentOrigin, $typeDocument, $document, $date1, $date2){

        if ($reverse == 1) {
            $cashInflow = new CashInflow();
            $cashInflow->cash = $advancePay;
            $cashInflow->reason = 'Ingreso de efectivo Nota de Ajuste a documento' . $document->id;
            $cashInflow->cash_register_id = $cashRegister->id;
            $cashInflow->user_id = current_user()->id;
            $cashInflow->branch_id = current_user()->branch_id;
            $cashInflow->admin_id = current_user()->id;
            $cashInflow->save();

            if ($indicator->pos == 'on') {
                $cashRegister->cash_in_total += $advancePay;
                $cashRegister->in_cash += $advancePay;
                $cashRegister->in_total += $advancePay;
                $cashRegister->update();
            }
        } else {
            $voucherTypes = VoucherType::findOrFail(18);
            //Metodo para crear un nuevo advance

            $this->advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument);

            if ($indicator->pos == 'on') {
                //actualizar la caja
                $cashRegister->out_advance = $advancePay;
                $cashRegister->update();
            }

            $voucherTypes->consecutive += 1;
        }

    }
}

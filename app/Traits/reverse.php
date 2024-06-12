<?php
namespace App\Traits;

use App\Models\CashInflow;
use App\Models\VoucherType;
use App\Traits\AdvanceCreate;

trait Reverse {
    use AdvanceCreate;
    public function reverse($reverse, $advancePay, $documentOrigin, $typeDocument, $document, $date1, $date2){

        if ($reverse == 1) {
            $cashInflow = new CashInflow();
            $cashInflow->cash = $advancePay;
            $cashInflow->reason = 'Ingreso de efectivo Nota de Ajuste a documento' . $document->id;
            $cashInflow->cash_register_id = cashRegisterComprobation()->id;
            $cashInflow->user_id = current_user()->id;
            $cashInflow->branch_id = current_user()->branch_id;
            $cashInflow->admin_id = current_user()->id;
            $cashInflow->save();

            if (indicator()->pos == 'on') {
                cashRegisterComprobation()->cash_in_total += $advancePay;
                cashRegisterComprobation()->in_cash += $advancePay;
                cashRegisterComprobation()->in_total += $advancePay;
                cashRegisterComprobation()->update();
            }
        } else {
            $voucherTypes = VoucherType::findOrFail(18);
            //Metodo para crear un nuevo advance

            $this->advanceCreate($voucherTypes, $documentOrigin, $advancePay, $typeDocument);

            if (indicator()->pos == 'on') {
                //actualizar la caja
                cashRegisterComprobation()->out_advance = $advancePay;
                cashRegisterComprobation()->update();
            }

            $voucherTypes->consecutive += 1;
        }

    }
}

<?php

use App\Models\CashRegister;
use RealRashid\SweetAlert\Facades\Alert;

if (! function_exists('cashRegisterModel')) {
    function cashregisterModel()
    {
        $cashRegisterModel = CashRegister::where('user_id', current_user()->id)->where('status', 'open')->first();
        return $cashRegisterModel;
    }
}

if (! function_exists('CashRegisterComprobation')) {
    function cashRegisterComprobation()
    {
        $cashRegister = null;
        if (indicator()->pos == 'on') {
            if(is_null(cashregisterModel())){
                Alert::success('danger','Debes tener una caja Abierta para realizar Operaciones');

            } else {
                $cashRegister = cashregisterModel();
            }
        } else {
            $cashRegister = CashRegister::findOrFail(1);
        }

        return $cashRegister;
    }
}

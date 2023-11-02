<?php

use App\Models\CashRegister;

if (! function_exists('cashRegisterModel')) {
    function cashregisterModel()
    {
        $cashRegisterModel = CashRegister::where('user_id', current_user()->id)->where('status', 'open')->first();
        return $cashRegisterModel;
    }
}

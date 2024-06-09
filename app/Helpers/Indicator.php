<?php

use App\Models\Company;
use App\Models\Indicator;

if (! function_exists('indicator')) {
    function indicator()
    {
        $indicator = Indicator::findOrFail(1);
        return $indicator;
    }

    function company()
    {
        $company = Company::findOrFail(current_user()->company_id);
        return $company;
    }
}

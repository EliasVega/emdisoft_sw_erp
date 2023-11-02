<?php

use App\Models\Indicator;

if (! function_exists('indicator')) {
    function indicator()
    {
        $indicator = Indicator::findOrFail(1);
        return $indicator;
    }
}

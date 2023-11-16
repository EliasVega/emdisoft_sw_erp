<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('current_user')) {
    function current_user()
    {
        return Auth::user();
    }
}

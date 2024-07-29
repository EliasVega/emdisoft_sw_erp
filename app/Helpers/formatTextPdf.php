<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('formatTextPdf')) {
    function formatTextPdf($text)
    {
        return mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
    }
}

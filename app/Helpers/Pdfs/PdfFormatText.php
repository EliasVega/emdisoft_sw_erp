<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('pdfFormatText')) {
    function pdfFormatText($text)
    {
        return mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
    }
}

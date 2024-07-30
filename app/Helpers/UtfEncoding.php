<?php

if (! function_exists('utfEncoding')) {
    function utfEncoding($text)
    {
        return mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
    }
}

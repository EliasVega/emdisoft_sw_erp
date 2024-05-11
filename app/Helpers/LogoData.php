<?php

if (!function_exists('LogoData')) {
    function logoData($request)
    {
        $data = [
            "logo" => base64_encode(file_get_contents($request->file('file'))),
        ];

        return $data;
    }
}

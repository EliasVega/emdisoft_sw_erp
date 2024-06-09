<?php

if (!function_exists('logoData')) {
    function logoData($request)
    {
        //dd($request);
        $data = [
            "logo" => base64_encode(file_get_contents($request->file('logo'))),
        ];

        return $data;
    }
}

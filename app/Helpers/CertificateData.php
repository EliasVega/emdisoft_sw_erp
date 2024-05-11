<?php

if (!function_exists('CertificateData')) {
    function certificateData($request)
    {
        $data = [
            "certificate" => base64_encode(file_get_contents($request->file('file'))),
            "password" => $request->get('password')
        ];

        return $data;
    }
}

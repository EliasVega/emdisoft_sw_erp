<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('sendCompany')) {
    function sendCompany($urlCompany, $data)
    {
        $requestResponse = [];

        $nit = company()->nit;
        $dv = company()->dv;
        $urlSend = $urlCompany . $nit . '/' . $dv;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($urlSend, $data);

        $service = $response->json();

        $response = $service['success'] ?? '';

        if ($response == true) {
            $requestResponse['store'] = true;
        } else {
            $requestResponse['store'] = false;
        }

        $requestResponse['response'] = $service;

        return $requestResponse;
    }
}

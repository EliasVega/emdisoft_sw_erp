<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('ResolutionDownload')) {
    function resolutionDownload($company, $software, $environment)
    {
        $data = [
            "IDSoftware" => $software->identifier
        ];

        $requestResponse = [];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $company->api_token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($environment->url, $data);

        $service = $response->json();

        $requestResponse['response'] = $service;

        return $requestResponse;
    }
}

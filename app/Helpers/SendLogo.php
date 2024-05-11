<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('SendLogo')) {
    function sendLogo($company, $urlLogo, $data)
    {
        $requestResponse = [];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $company->api_token,
            'Content-Type' => 'application/json',
            'cache-control' => 'no-cache',
            'Connection' => 'keep-alive',
            'Accept-Encoding' => 'gzip, deflate',
            'Host' => 'localhost',
            'Accept' => 'application/json',
            'X-CSRF-TOKEN'
        ])->put($urlLogo, $data);

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

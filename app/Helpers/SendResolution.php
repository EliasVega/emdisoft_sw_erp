<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('SendResolution')) {
    function sendResolution($company, $urlResolution, $data)
    {
        $requestResponse = [];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $company->api_token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->put($urlResolution, $data);

        $service = $response->json();

        $response = $service['success'] ?? '';

        if ($response == true) {
            $requestResponse['store'] = true;
            $requestResponse['errorMessages'] = null;
        } else {
            $requestResponse['store'] = false;
            $requestResponse['errorMessages'] = $service['message'];
        }

        $requestResponse['response'] = $service;

        return $requestResponse;
    }
}

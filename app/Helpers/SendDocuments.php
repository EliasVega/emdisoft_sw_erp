<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('sendDocuments')) {
    function sendDocuments($company, $environment, $data)
    {
        $requestResponse = [];
        $errorMessages = null;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $company->api_token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($environment->url, $data);

        $service = $response->json();

        $responseErrors = $service['errors'] ?? '';
        if ($responseErrors == '') {
            $responseDian = $service['ResponseDian'] ?? '';
            if ($responseDian != '') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];

                if ($code == '00' && $valid == true) {
                    $requestResponse['store'] = true;
                } else {
                    $errorMessages = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                        ['SendBillSyncResult']['ErrorMessage']['string'];

                    $requestResponse['store'] = false;
                }
            } else {
                $errorMessages = $service;
                $requestResponse['store'] = false;
            }
        } else {
            foreach ($responseErrors as $key => $errors) {
                foreach ($errors as $key => $error) {
                    $errorMessages[$key] = $error;
                }
            }
            $requestResponse['store'] = false;
        }

        $requestResponse['response'] = $service;
        $requestResponse['errorMessages'] = $errorMessages;

        return $requestResponse;
    }
}

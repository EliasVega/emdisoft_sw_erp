<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('sendInvoiceTestSet')) {
    function sendInvoiceTestSet($company, $url, $data)
    {
        $requestResponse = [];
        $errorMessages = null;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $company->api_token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, $data);

        $service = $response->json();

        $responseErrors = $service['errors'] ?? '';
        if ($responseErrors == '') {
            $responseDian = $service['ResponseDian'] ?? '';
            if ($responseDian != '') {
                $zip = $service['ResponseDian']['Envelope']['Body']['SendTestSetAsyncResponse']['SendTestSetAsyncResult']['ZipKey'];
                if ($zip != '') {
                    $requestResponse['store'] = true;
                } else {
                    $errorMessages = $service['ResponseDian']['Envelope']['Body']['SendTestSetAsyncResponse']['SendTestSetAsyncResult']['ErrorMessageList'];

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

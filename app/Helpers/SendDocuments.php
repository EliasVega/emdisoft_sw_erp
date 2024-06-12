<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('sendDocuments')) {
    function sendDocuments($url, $data)
    {
        $requestResponse = [];
        $errorMessages = null;
        //dd($data);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . company()->api_token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, $data);

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
                $errorMessages = $service['message'];
                $requestResponse['store'] = false;
            }
        } else {
            foreach ($responseErrors as $key => $errors) {
                foreach ($errors as $key => $error) {
                    $errorMessages[$key] = $error;
                }
                //para comprobacion
            }
            $requestResponse['store'] = false;
        }

        $requestResponse['response'] = $service;
        $requestResponse['errorMessages'] = $errorMessages;

        return $requestResponse;
    }
}

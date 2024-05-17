<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('SendStatusQuery')) {
    function sendStatusQuery($apiToken, $url)
    {
        $requestResponse = [];
        $errorMessages = null;
        //dd($data);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url);

        $service = $response->json();

        $responseErrors = $service['errors'] ?? '';
        if ($responseErrors == '') {
            $responseDian = $service['ResponseDian'] ?? '';
            if ($responseDian != '') {
                $valid = $service['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']
                    ['GetStatusZipResult']['DianResponse']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']
                ['GetStatusZipResult']['DianResponse']['StatusCode'];
                $message = $service['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']['GetStatusZipResult']['DianResponse']['StatusDescription'];

                if ($code == '00' && $valid == true) {
                    $requestResponse['store'] = 'no aceptado';
                } else if ($message != ''){

                    $requestResponse['store'] = 'aceptado';
                } else {
                    $errorMessages = $service['ResponseDian']['Envelope']['Body']['GetStatusZipResponse']
                    ['GetStatusZipResult']['DianResponse']['ErrorMessage']['string'];

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

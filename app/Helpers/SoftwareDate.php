<?php

if (!function_exists('SoftwareData')) {
    function softwareData($request, $typeSoftware)
    {
        if ($typeSoftware == 'invoice') {
            $data = [
                "id" => $request->identifier,
                "pin" => $request->pin

            ];
        } else if ($typeSoftware == 'payroll') {
            $data = [
                "idpayroll" => $request->identifier_payroll,
	            "pinpayroll" => $request->pin_payroll
            ];
        } else if($typeSoftware == 'payroll') {
            $data = [
                "urleqdocs" => "https://gtpa-webservices-input-test-dian.azurewebsites.net/WcfDianCustomerServices.svc?wsdl",
                "ideqdocs" => $request->identifier_equidoc,
                "pineqdocs" => $request->pin_equidoc
            ];
        }

        return $data;
    }
}

<?php

if (!function_exists('CompanyData')) {
    function companyData($request)
    {
        $data = [
            "type_document_identification_id" => $request->identification_type_id,
            "type_organization_id" => $request->organization_id,
            "type_regime_id" => $request->regime_id,
            "type_liability_id" => $request->liability_id,
            "business_name" => $request->name,
            "merchant_registration" => $request->merchant_registration,
            "municipality_id" => $request->municipality_id,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,

            "type_document_identification_id" => $request->identification_type_id,
            "type_organization_id" => $request->organization_id,
            "type_regime_id" => $request->regime_id,
            "type_liability_id" => $request->liability_id,
            "business_name" => $request->name,
            "merchant_registration" => $request->merchant_registration,
            "municipality_id" => $request->municipality_id,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "mail_host" => "smtp.gmail.com",
            "mail_port" => "587",
            "mail_username" => "info.ecounts@gmail.com",
            "mail_password" => "hfsmxqchdthixrgm",
            "mail_encryption" => "tls"
        ];

        return $data;
    }
}

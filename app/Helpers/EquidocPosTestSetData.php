<?php

use App\Models\Branch;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Resolution;
use Carbon\Carbon;

if (! function_exists('EquiDocPosTestSetData')) {
    function equiDocPosTestSetData()
    {
        //dd($request->all());
        $custRandom = rand(1, 3);
        $otherRandom = rand(1, 100);
        $cust_identification = 0;
        $cust_dv = '';
        $cust_name = '';
        $cust_phone = '3155554455';
        $cust_address = 'BUCARAMANGA';
        $cust_email = 'prueba@gmail.com';
        $cust_merchant_registration = '000.00';
        $cust_identification_type_id = 3;
        $cust_organization_id = 2;
        $cust_liability_id = 117;
        $cust_municipality_id = 846;
        $cust_regime_id = 2;

        $measure_unit_id = 70;
        $quantity = '';
        $price = '';

        $tax_type_id = 1;
        $taxAmount = '0.00';
        $taxRate = '19.00';

        $productname = '';
        $productcode = '';
        $taxLines = [];
        $productLines = [];

        if ($custRandom == 1) {
            $cust_identification = 91260182;
            $cust_dv = 8;
            $cust_name = 'ENRIQUE ZAFRA PEREZ';
            $quantity = number_format($otherRandom, 2, '.', '');
            $price = '1000.00';
            $productname = 'PAN FRANCES';
            $productcode = '202401';
        } else if ($custRandom == 2) {
            $cust_identification = 91343991;
            $cust_dv = 7;
            $cust_name = 'GUSTAVO PETRO';
            $quantity = number_format($otherRandom, 2, '.', '');
            $price = '2000.00';
            $productname = 'PAN OCAÑERO';
            $productcode = '202402';
        } else {
            $cust_identification = 91283760;
            $cust_dv = 4;
            $cust_name = 'MARTIN LUTERO';
            $quantity = number_format($otherRandom, 2, '.', '');
            $price = '3000.00';
            $productname = 'PAN NEVADO';
            $productcode = '202403';
        }
        $amount = number_format($quantity * $price, 2, '.', '');

        $company = Company::findOrFail(current_user()->company_id);
        $branch = Branch::findOrFail(current_user()->branch_id);
        $configuration = Configuration::where('company_id', $company->id)->first();
        //$customer = Customer::findOrFail($request->customer_id);//cliente de la factura
        $resolution = Resolution::findOrFail(10);//Resolucion seleccionada
        $cashRegister = cashregisterModel();
        $note = '';//observaciones del documento
        $date = Carbon::now();
        $dueDate = $date->format('Y-m-d');
        $generationDate = $date->format('Y-m-d');
        $points = "0.00";

        //$taxAmount = ($quantity * $price * $taxRate)/100;
        $amount = $quantity * $price;
        $taxAmount =number_format(round($taxAmount), 2, '.', '');
        $amount = number_format(round($amount), 2, '.', '');

        $productLine = [
            "unit_measure_id" => $measure_unit_id,
            "invoiced_quantity" => $quantity,
            "line_extension_amount" => $amount,
            "free_of_charge_indicator" => false,
            "tax_totals" => [
                [
                    "tax_id" => $tax_type_id,
                    "tax_amount" => $taxAmount,
                    "taxable_amount" => $amount,
                    "percent" => $taxRate
                ]
            ],
            "description" => $productname,
            "notes" => "",
            "code" => $productcode,
            "type_item_identification_id" => 4,
            "price_amount" => $price,
            "base_quantity" => $quantity
        ];

        $productLines[] = $productLine;

        $taxLine = [
            "tax_id" => $tax_type_id,
            "tax_amount" => $taxAmount,
            "percent" => $taxRate,
            "taxable_amount" => $amount
        ];

        $taxLines[] = $taxLine;

        $data = [
            "number" => $resolution->consecutive,
            "type_document_id" => $resolution->documentType->id,
            "date" => $generationDate,
            "time" => $date->toTimeString(),
            "postal_zone_code" => $branch->postalCode->postal_code,
            "resolution_number" => $resolution->resolution,
            "prefix" => $resolution->prefix,
            "notes" => $note,
            "sendmail" => true,
            "sendmailtome" => true,
            "foot_note" => "",
            "software_manufacturer" => [
                "name" => $configuration->creator_name,
                "business_name" => $configuration->company_name,
                "software_name" => $configuration->software_name
            ],
            "buyer_benefits" => [
                "code" => "$cust_identification",
                "name" => $cust_name,
                "points" => $points
            ],
            "cash_information" => [
                "plate_number" => cashregisterModel()->salePoint->plate_number,
                "location" => cashregisterModel()->salePoint->location,
                "cashier" => current_user()->name,
                "cash_type" => cashregisterModel()->salePoint->cash_type,
                "sales_code" => $resolution->prefix .$resolution->consecutive,
                "subtotal" => $amount
            ],
            "customer" => [
                "identification_number" => $cust_identification,
                "dv" => $cust_dv,
                "name" => $cust_name,
                "phone" => $cust_phone,
                "address" => $cust_address,
                "email" => $cust_email,
                "merchant_registration" => $cust_merchant_registration,
                "type_document_identification_id" => $cust_identification_type_id,
                "type_organization_id" => $cust_organization_id,
                "type_liability_id" => $cust_liability_id,
                "municipality_id" => $cust_municipality_id,
                "type_regime_id" => $cust_regime_id
            ],
            "payment_form" => [
                "payment_form_id" => 1,
                "payment_method_id" => 10,
                "payment_due_date" => $dueDate,
                "duration_measure" => '0'
            ],
            "legal_monetary_totals" => [
                "line_extension_amount" => $amount,
                "tax_exclusive_amount" => $amount,
                "tax_inclusive_amount" => $amount,
                "payable_amount" => $amount
            ],
            "invoice_lines" => $productLines,
            "tax_totals" => $taxLines,
        ];

        return $data;
    }
}

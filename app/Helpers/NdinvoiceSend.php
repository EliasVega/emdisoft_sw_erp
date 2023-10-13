<?php

use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Customer;
use App\Models\Discrepancy;
use App\Models\Invoice;
use App\Models\InvoiceResponse;
use App\Models\Product;
use App\Models\Resolution;
use Carbon\Carbon;

if (!function_exists('ndinvoiceSend')) {
    function ndinvoiceSend($request, Invoice $invoice)
    {
        $invoiceResponse = InvoiceResponse::where('invoice_id', $invoice->id)->first();//respuesta factura a NC
        $discrepancy = Discrepancy::findOrFail($request->discrepancy_id);//mtivos de la nota Credito
        $resolution = Resolution::findOrFail(9);//resolucion de la nota credito
        $date = Carbon::now();//fecha de hoy
        $company = Company::findOrFail(current_user()->company_id);//compañia
        $customer = Customer::findOrFail($request->customer_id);//cliente de la factura y nota credito

        $product_id = $request->id; //Array de request id de productos
        $quantity = $request->quantity;//array de request de cantidades
        $price = $request->price;// array de request de precios
        $taxRate = $request->tax_rate;// array de taxas de impuesto

        $note = $request->note;//observaciones del documento
        $totalDocument = $request->total;//total del documento
        $total = $request->total_pay;//Total mas impuestos

        $productLines = [];
        $taxLines = [];
        $taxCont = 0;

        $taxes[] = [];
        $contax = 0;

        for ($i=0; $i < count($product_id); $i++) {
            $product = Product::findOrFail($product_id[$i]);
            $companyTaxProduct = $product->category->company_tax_id;
            $companyTax = CompanyTax::findOrFail($companyTaxProduct);

            $taxAmount = ($quantity[$i] * $price[$i] * $taxRate[$i])/100;
            $amount = $quantity[$i] * $price[$i];

            if ($taxes[0] != []) { //contax > 0
                $contsi = 0;
                foreach ($taxes as $key => $tax) {

                    if ($tax[0] == $companyTaxProduct) {
                        $tax[2] += $taxAmount;
                        $tax[3] += $amount;
                        $contsi++;
                    }
                }
                if ($contsi == 0) {
                    $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate[$i]];
                        $contax++;
                }
            } else {
                $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate[$i]];
                $contax++;
            }
            $productLine = [
                "unit_measure_id" => $product->measure_unit_id,
                "invoiced_quantity" => round($quantity[$i], 2),
                "line_extension_amount" => round($amount, 2),
                "free_of_charge_indicator" => false,
                "tax_totals" => [
                    [
                        "tax_id" => $companyTax->tax_type_id,
                        "tax_amount" => $taxAmount,
                        "taxable_amount" => $amount,
                        "percent" => $taxRate[$i]
                    ]
                ],
                "description" => $product->name,
                "notes" => "",
                "code" => $product->code,
                "type_item_identification_id" => 4,
                "price_amount" => $price[$i],
                "base_quantity" => round($quantity[$i], 2)
            ];

            $productLines[$i] = $productLine;
        }

        for ($i=0; $i < count($taxes); $i++) {
            $taxLine = [
                "tax_id" => $taxes[$i][1],
                "tax_amount" => $taxes[$i][2],
                "percent" => $taxes[$i][4],
                "taxable_amount" => $taxes[$i][3]
            ];

            $taxLines[$taxCont] = $taxLine;
            $taxCont++;
        }

        $data = [
            "billing_reference" => [
                "number" => $invoice->document,
                "uuid" => $invoiceResponse->cufe,
                "issue_date" => $invoice->generation_date
            ],
            "discrepancyresponsecode" => $discrepancy->code,
            "discrepancyresponsedescription" => $discrepancy->description,
            "notes" => $note,
            "resolution_number" => $resolution->resolution,
            "prefix" => $resolution->prefix,
            "number" => $resolution->consecutive,
            "type_document_id" => $resolution->document_type_id,
            "date" => $date->toDateString(),
            "time" => $date->toTimeString(),
            "establishment_name" => $company->name,
            "establishment_address" => $company->address,
            "establishment_phone" => $company->phone,
            "establishment_municipality" => $company->municipality_id,
            "sendmail" => true,
            "sendmailtome" => true,
            "seze" => "2021-2017",
            "head_note" => "",
            "foot_note" => "",
            "customer" => [
                "identification_number" => $customer->identification,
                "dv" => $customer->dv,
                "name" => $customer->name,
                "phone" => $customer->phone,
                "address" => $customer->address,
                "email" => $customer->email,
                "merchant_registration" => $customer->merchant_registration,
                "type_document_identification_id" => $customer->identification_type_id ?? '',
                "type_organization_id" => $customer->organization_id,
                "type_liability_id" => $customer->liability_id,
                "municipality_id" => $customer->municipality_id,
                "type_regime_id" => $customer->regime_id
            ],
            "requested_monetary_totals" => [
                "line_extension_amount" => $totalDocument,
                "tax_exclusive_amount" => $totalDocument,
                "tax_inclusive_amount" => $total,
                "allowance_total_amount" => "0.00",
                "charge_total_amount" => "0.00",
                "payable_amount" => $total
            ],
            "debit_note_lines" => $productLines,
            "tax_totals" => $taxLines,
        ];
        return $data;
    }
}

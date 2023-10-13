<?php

use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Discrepancy;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Resolution;
use App\Models\SupportDocumentResponse;
use Carbon\Carbon;

if (! function_exists('adjustmentNoteSend')) {
    function adjustmentNoteSend($request, Purchase $purchase)
    {
        $resolut = $request->resolution_id;
        if ($resolut) {
            $resolution = Resolution::findOrFail($request->resolution_id);//resolucion selecionada en el request
        } else {
            $resolution = Resolution::findOrFail(3);//resolucion selecionada en el request
        }
        $company = Company::findOrFail(current_user()->company_id);
        $provider = Provider::findOrFail($purchase->provider_id);
        $discrepancy = Discrepancy::findOrFail($request->discrepancy_id);
        //$resolution = Resolution::findOrFail($request->resolution_id);
        $supportDocumentResponse = SupportDocumentResponse::where('purchase_id', $purchase->id)->first();
        $date = Carbon::now();

        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $taxRate = $request->tax_rate;
        $total = $request->total;
        $total_pay = $request->total_pay;
        //$totalIva = $request->tax_iva;

        //$retentions = $request->company_tax_id;


        $productLines = [];
        $taxLines = [];
        $taxCont = 0;
        //$withholdingLines = [];
        //$withholdingCont = 0;
        //$discountLines = [];

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
                "invoiced_quantity" => $quantity[$i],
                "line_extension_amount" => $amount,
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
                "brandname" => $product->category->name,
                "modelname" => $product->code,
                "type_item_identification_id" => 4,
                "price_amount" => $price[$i],
                "base_quantity" => $quantity[$i]
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
                "number" => $purchase->document,
                "uuid" => $supportDocumentResponse->cuds,
                "issue_date" => $purchase->generation_date
            ],
            "discrepancyresponsecode" => $discrepancy->code,
            "discrepancyresponsedescription" => $discrepancy->description,
            "notes" => "",
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
            "foot_note" => $request->note,
            "seller" => [
                "identification_number" => $provider->identification,
                "dv" => $provider->dv,
                "name" => $provider->name,
                "phone" => $provider->phone,
                "address" => $provider->address,
                "email" => $provider->email,
                "merchant_registration" => $provider->merchant_registration,
                "postal_zone_code" => $provider->postalCode->postal_code,
                "type_document_identification_id" => $provider->identification_type_id,
                "type_organization_id" => $provider->organization_id,
                "municipality_id" => $provider->municipality->id,
                "type_regime_id" => $provider->regime_id
            ],
            "legal_monetary_totals" => [
                "line_extension_amount" => $total,
                "tax_exclusive_amount" => $total,
                "tax_inclusive_amount" => $total_pay,
                "allowance_total_amount" => "0.00",
                "charge_total_amount" => "0.00",
                "payable_amount" => $total_pay
            ],
            "credit_note_lines" => $productLines,
            "tax_totals" => $taxLines,
        ];

        return $data;
    }
}

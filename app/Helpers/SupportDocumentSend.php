<?php

use App\Models\CompanyTax;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Resolution;
use Carbon\Carbon;

if (! function_exists('supportDocumentSend')) {
    function supportDocumentSend($request)
    {

        $provider = Provider::findOrFail($request->provider_id);
        $resolution = Resolution::findOrFail($request->resolution_id);
        $note = $request->note;//observaciones del documento
        $generationDate = $request->generation_date;//Fecha de generacion
        $dueDate = $request->due_date;//feecha de vencimiento del documento
        $date = Carbon::now();
        $expirationTime = Carbon::parse($generationDate)->diffInDays(Carbon::parse($dueDate));

        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $taxRate = $request->tax_rate;
        $totalDocument = $request->total;
        $totalIva = $request->tax_iva;
        $total = $request->total_pay;

        $retentions = $request->company_tax_id;

        //$subtotal = 0;
        $discountTotal = 0.00;

        $productLines = [];
        $taxLines = [];
        $taxCont = 0;
        $withholdingLines = [];
        $withholdingCont = 0;
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
                "type_item_identification_id" => 4,
                "price_amount" => $price[$i],
                "base_quantity" => $quantity[$i],
                "type_generation_transmition_id"=> $request->generation_type_id,
                "start_date"=> $request->start_date
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
        if ($retentions != null) {
            for ($i=0; $i < count($retentions); $i++) {
                $companyTax = CompanyTax::findOrFail($retentions[$i]);
                $id = $companyTax->tax_type_id;//seleccionando el typo de impuesto retencion
                $percentageTax = $companyTax->percentage->percentage;//tomando el porcentage
                $percentageBase = $companyTax->percentage->base;//tomandola base de impuesto

                if ($id == 5 && $totalIva >= $percentageBase) {
                    $withholdingLine = [
                        "tax_id" => $id,
                        "tax_amount" => ($totalIva * $percentageTax)/100,
                        "percent" => $percentageTax,
                        "taxable_amount" => $totalIva
                    ];
                    $withholdingLines[$withholdingCont] = $withholdingLine;
                    $withholdingCont++;
                } else {
                    $withholdingLine = [
                        "tax_id" => $id,
                        "tax_amount" => ($totalDocument * $percentageTax)/100,
                        "percent" => $percentageTax,
                        "taxable_amount" => $totalDocument
                    ];
                    $withholdingLines[$withholdingCont] = $withholdingLine;
                    $withholdingCont++;
                }

            }
        } else {
            $withholdingLine = [
                "tax_id" => 4,
                "tax_amount" => 0.00,
                "percent" => 0.00,
                "taxable_amount" => $totalDocument
            ];
            $withholdingLines[$withholdingCont] = $withholdingLine;
            $withholdingCont++;
        }

        //$total = $total + $subtotal;

        $data = [
            "number" => $resolution->consecutive,
            "type_document_id" => $resolution->document_type_id,
            "date" => $generationDate,
            "time" => $date->toTimeString(),
            "resolution_number" => $resolution->resolution,
            "prefix" => $resolution->prefix,
            "notes" => $note,
            "sendmail" => false,
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
                "municipality_id" => $provider->municipality_id,
                "type_regime_id" => $provider->regime_id,
            ],
            "payment_form" => [
                "payment_form_id" => $request->payment_form_id,
                "payment_method_id" => $request->payment_method_id[0],
                "payment_due_date" => $dueDate,
                "duration_measure" => $expirationTime
            ],
            "legal_monetary_totals" => [
                "line_extension_amount" => $totalDocument,
                "tax_exclusive_amount" => $totalDocument,
                "tax_inclusive_amount" => $total,
                "allowance_total_amount" => $discountTotal,
                "charge_total_amount" => "0.00",
                "payable_amount" => ($total - $discountTotal)
            ],
            "invoice_lines" => $productLines,
            "tax_totals" => $taxLines,
            "with_holding_tax_total" => $withholdingLines,
            //"allowance_charges" => $discountLines,
        ];

        return $data;
    }
}

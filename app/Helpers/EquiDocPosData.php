<?php

use App\Models\Branch;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Configuration;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Resolution;
use Carbon\Carbon;

if (! function_exists('EquiDocPosData')) {
    function equiDocPosData($request)
    {
        //dd($request->all());

        $company = Company::findOrFail(current_user()->company_id);
        $branch = Branch::findOrFail(current_user()->branch_id);
        $configuration = Configuration::where('company_id', $company->id)->first();
        $customer = Customer::findOrFail($request->customer_id);//cliente de la factura
        $resolution = Resolution::findOrFail($request->resolution_id);//Resolucion seleccionada
        $cashRegister = cashregisterModel();
        $note = $request->note;//observaciones del documento
        $generationDate = $request->generation_date;//Fecha de generacion
        $dueDate = $request->due_date;//feecha de vencimiento del documento
        $date = Carbon::now();
        $expirationTime = Carbon::parse($generationDate)->diffInDays(Carbon::parse($dueDate));
        //$expirationTime = number_format(round($expirationTime), 2, '.', '');

        //Variables request
        $product_id = $request->product_id;//Array de productos
        $quantity = $request->quantity;//Array de cantidades
        $price = $request->price;//Array de precios
        $taxRate = $request->tax_rate;//Array de tasa de cada producto
        $points = "0.00";

        $totalDocument = $request->total;//total del documento
        $totalIva = $request->tax_iva;//Total de impuesto de iva
        $total = $request->total_pay;//Total mas impuestos

        $retentions = $request->company_tax_id;

        $discountTotal = "0.00";
        $chargeTotal = "0.00";
        $productLines = [];
        $taxLines = [];
        $taxCont = 0;
        $withholdingLines = [];
        $withholdingCont = 0;

        $payableAmount = number_format(($total - $discountTotal + $chargeTotal), 2, '.', '');

        $taxes[] = [];
        $contax = 0;

        for ($i=0; $i < count($product_id); $i++) {
            $product = Product::findOrFail($product_id[$i]);
            $companyTaxProduct = $product->category->company_tax_id;
            $companyTax = CompanyTax::findOrFail($companyTaxProduct);
            $taxAmount = ($quantity[$i] * $price[$i] * $taxRate[$i])/100;
            $amount = $quantity[$i] * $price[$i];
            $taxAmount =number_format($taxAmount, 2, '.', '');
            //$amount = number_format($amount, 2, '.', '');
            $amount = number_format(round($amount), 2, '.', '');



            if ($taxes[0] != []) { //contax > 0
                $contsi = 0;
                foreach ($taxes as $key => $tax) {

                    if ($tax[0] == $companyTaxProduct) {
                        $tax[2] += $taxAmount;
                        $tax[3] += $amount;
                        $contsi++;
                        $taxes[$key] = $tax;
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
            $quantityProducts = number_format($quantity[$i], 2, '.', '');
            $productLine = [
                "unit_measure_id" => $product->measure_unit_id,
                "invoiced_quantity" => $quantityProducts,
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
                "code" => $customer->identification,
                "name" => $customer->name,
                "points" => $points
            ],
            "cash_information" => [
                "plate_number" => $cashRegister->salePoint->plate_number,
                "location" => $cashRegister->salePoint->location,
                "cashier" => current_user()->name,
                "cash_type" => $cashRegister->salePoint->cash_type,
                "sales_code" => $resolution->prefix .$resolution->consecutive,
                "subtotal" => $totalDocument
            ],
            "customer" => [
                "identification_number" => $customer->identification,
                "dv" => $customer->dv,
                "name" => $customer->name,
                "phone" => $customer->phone,
                "address" => $customer->address,
                "email" => $customer->email,
                "merchant_registration" => $customer->merchant_registration,
                "type_document_identification_id" => $customer->identification_type_id,
                "type_organization_id" => $customer->organization_id,
                "type_liability_id" => $customer->liability_id,
                "municipality_id" => $customer->municipality_id,
                "type_regime_id" => $customer->regime_id
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
                "payable_amount" => $payableAmount
            ],
            "invoice_lines" => $productLines,
            "tax_totals" => $taxLines,
            //"with_holding_tax_total" => $withholdingLines,
            //"allowance_charges" => $discountLines,
        ];

        return $data;
    }
}

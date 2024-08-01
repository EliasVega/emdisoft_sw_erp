<?php

namespace App\Helpers\Tickets;

use App\Models\InvoiceOrderProduct;
use App\Models\InvoiceProduct;
use App\Models\NcinvoiceProduct;
use App\Models\Product;
use App\Models\Tax;

if (!function_exists('ticketHeight')) {
    function ticketHeight($logoHeight, $company, $document, $typeDocument)
    {
        $title = 36;
        $consecutive = 10;
        $logo = $logoHeight;
        $companyInformation = 20;
        $barcode = 25;
        $thirdPartyInformation = 16;
        $productHeader = 8;
        $productRow = 5;
        $productFooter = 5;
        $subtotal = 5;
        $taxRow = 5;
        $total = 5;
        $invoiceInformation = 98;
        $refund = 20;
        $copyright = 15;
        $disclaimerInformation = 15;
        $pdfHeight = 0;

        if (company()->logo != null) {
            $image = storage_path('app/public/images/logos/' . $company->imageName);

            if (file_exists($image)) {
                $pdfHeight += $logo;
            }
        }



        if ($typeDocument == 'invoice') {
            $title = 20;
            $invoiceProducts = InvoiceProduct::where('invoice_id', $document->id)->get();
        } else if ($typeDocument == 'invoiceOrder') {
            $title = 10;
            $invoiceInformation = 5;
            $invoiceProducts = InvoiceOrderProduct::where('invoice_order_id', $document->id)->get();
        }

        $pdfHeight += $title + $consecutive + $companyInformation + $barcode + $thirdPartyInformation + $disclaimerInformation;

        $pdfHeight += $productHeader;

        foreach ($invoiceProducts as $invoiceProduct) {

            $product = Product::findOrFail($invoiceProduct->product_id);
            $length = strlen($product->name);
            if ($length > 20) {
                $pdfHeight += 12;
            } else {
                $pdfHeight += $productRow;
            }
        }

        $taxes = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.taxable_id', $document->id)
        ->where('tax.type', $typeDocument)
        ->where('tt.type_tax', 'tax_item')
        ->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.taxable_id', $document->id)
        ->where('tax.type', $typeDocument)
        ->where('tt.type_tax', 'retention')
        ->get();


        $pdfHeight += $productFooter;
        $pdfHeight += $subtotal;

        if (empty($taxes)) {
            $pdfHeight += $taxRow * count($taxes);
        } else {
            $pdfHeight += $taxRow;
        }
        if (empty($retentions)) {
            $pdfHeight += $taxRow * count($retentions);
        } else {
            $pdfHeight += $taxRow;
        }
        /*
        foreach ($document->percentages as $percentage) {
            $pdfHeight += $taxRow;
        }*/

        $pdfHeight += $total;

        if (indicator()->dian == 'on') {
            $pdfHeight += $invoiceInformation;
        }
        /*
        if ($type == "retail") {
            if ($document->invoice == 'enabled') {
                $pdfHeight += $invoiceInformation;
            }
        } elseif ($type == "purchase") {
            if ($document->type == 'support_document') {
                $pdfHeight += $invoiceInformation;
            }
        } else {
            $pdfHeight += $invoiceInformation;
        }*/

        $pdfHeight += $refund + $copyright;

        return $pdfHeight;
    }
}

if (!function_exists('ticketHeightNcinvoice')) {
    function ticketHeightNcinvoice($logoHeight, $document, $type)
    {
        $title = 32;
        $logo = $logoHeight;
        $companyInformation = 17;
        $barcode = 25;
        $complementaryInformation = 26;
        $thirdPartyInformation = 16;
        $productHeader = 10;
        $productRow = 5;
        $productFooter = 4;
        $subtotal = 5;
        $taxRow = 5;
        $total = 5;
        $invoiceInformation = 104;
        $refund = 22;
        $copyright = 15;
        $disclaimerInformation = 10;
        $footer = 10;
        $pdfHeight = 0;

        if (company()->logo != null) {
            $image = storage_path('app/public/images/logos/' . company()->imageName);

            if (file_exists($image)) {
                $pdfHeight += $logo;
            }
        }

        $pdfHeight += $title + $companyInformation + $barcode + $complementaryInformation + $thirdPartyInformation;

        $ncinvoiceProducts = NcinvoiceProduct::where('ncinvoice_id', $document->id)->get();

        $pdfHeight += $productHeader;
        foreach ($ncinvoiceProducts as $ncinvoiceProduct) {
            $product = Product::findOrFail($ncinvoiceProduct->product_id);
            $length = strlen($product->name);
            if ($length > 20) {
                $h = $length / 30;
                $hh = $h + 2;
                $pdfHeight += ($hh * 4);
            } else {
                $pdfHeight += $productRow;
            }
        }
        $pdfHeight += $productFooter;

        $pdfHeight += $subtotal;
        $pdfHeight += $taxRow;
        /*
        foreach ($document->percentages as $percentage) {
            $pdfHeight += $taxRow;
        }*/

        $pdfHeight += $total;

        if (indicator()->dian == 'on') {
            $pdfHeight += $invoiceInformation;
        }
        /*
        if ($type == "retail") {
            if ($document->invoice == 'enabled') {
                $pdfHeight += $invoiceInformation;
            }
        } elseif ($type == "purchase") {
            if ($document->type == 'support_document') {
                $pdfHeight += $invoiceInformation;
            }
        } else {
            $pdfHeight += $invoiceInformation;
        }*/

        $pdfHeight += $disclaimerInformation + $refund + $copyright + 15;

        return $pdfHeight;
    }
}

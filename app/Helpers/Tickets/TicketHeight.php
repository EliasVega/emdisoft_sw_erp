<?php

namespace App\Helpers\Tickets;

use App\Models\InvoiceProduct;
use App\Models\NcinvoiceProduct;
use App\Models\Product;

if (!function_exists('ticketHeight')) {
    function ticketHeight($logoHeight, $company, $document)
    {
        $title = 28;
        $logo = $logoHeight;
        $companyInformation = 17;
        $barcode = 25;
        $complementaryInformation = 26;
        $thirdPartyInformation = 16;
        $productHeader = 10;
        $productRow = 4;
        $productFooter = 4;
        $subtotal = 5;
        $taxRow = 5;
        $total = 5;
        $invoiceInformation = 104;
        $refund = 22;
        $copyright = 15;
        $disclaimerInformation = 10;
        $pdfHeight = 0;

        if (company()->logo != null) {
            $image = storage_path('app/public/images/logos/' . $company->imageName);

            if (file_exists($image)) {
                $pdfHeight += $logo;
            }
        }

        $pdfHeight += $title + $companyInformation + $barcode + $complementaryInformation + $thirdPartyInformation;

        $invoiceProducts = InvoiceProduct::where('invoice_id', $document->id)->get();

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
            $length = strlen($product->product->name);
            if ($length > 20) {
                $pdfHeight += 12;
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

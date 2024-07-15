<?php

namespace App\Helpers\Tickets;

use App\Models\InvoiceProduct;

if (!function_exists('ticketHeight')) {
    function ticketHeight($logoHeight, $company, $document)
    {
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

        $pdfHeight += $companyInformation + $barcode + $complementaryInformation + $thirdPartyInformation;

        $invoiceProducts = InvoiceProduct::where('invoice_id', $document->id)->get();

        $pdfHeight += $productHeader;
        foreach ($invoiceProducts as $invoiceProduct) {
            $pdfHeight += $productRow;
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
        $title = 24;
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
            $image = storage_path('app/public/images/logos/' . company()->imageName);

            if (file_exists($image)) {
                $pdfHeight += $logo;
            }
        }

        $pdfHeight += $title + $companyInformation + $barcode + $complementaryInformation + $thirdPartyInformation;

        $invoiceProducts = InvoiceProduct::where('invoice_id', $document->id)->get();

        $pdfHeight += $productHeader;
        foreach ($invoiceProducts as $invoiceProduct) {
            $pdfHeight += $productRow;
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

        $pdfHeight += $disclaimerInformation + $refund + $copyright;

        return $pdfHeight;
    }
}

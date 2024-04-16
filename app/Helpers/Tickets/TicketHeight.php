<?php

namespace App\Helpers\Tickets;

use App\Models\InvoiceProduct;

if (!function_exists('ticketHeight')) {
    function ticketHeight($company, $document, $type)
    {
        $logo = 25;
        $companyInformation = 20;
        $barcode = 25;
        $complementaryInformation = 30;
        $thirdPartyInformation = 25;
        $productHeader = 10;
        $productRow = 4;
        $productFooter = 4;
        $subtotal = 5;
        $taxRow = 5;
        $total = 5;
        $invoiceInformation = 104;
        $refund = 22;
        $copyright = 15;

        $pdfHeight = 0;

        if ($company->logo != null) {
            $image = storage_path('app/public/images/logos/' . $company->logo);

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
        }

        $pdfHeight += $refund + $copyright;

        return $pdfHeight;
    }
}

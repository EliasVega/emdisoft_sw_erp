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

if (!function_exists('ticketHeightCashRegister')) {
    function ticketHeightCashRegister(
        $cashRegister,
        $logoHeight,
        $productPurchases,
        $invoiceProducts,
        $expenseProducts,
        $productRemissions,
        $purchases,
        $expenses,
        $invoices,
        $remissions,
        $purchaseOrders,
        $invoiceOrders,
        $restaurantOrders,
        $ncinvoices,
        $ndinvoices,
        $ncpurchases,
        $ndpurchases,
        $invoicePays,
        $remissionPays,
        $purchasePays,
        $expensePays,
        $cashInflows,
        $cashOutflows,
        $advanceProviders,
        $advanceCustomers,
        $advanceEmployees,
        $sumAdvanceCustomers,
        $sumAdvanceEmployees,
        $sumAdvanceProviders
        )
    {
        $lns = 5;//separaciones
        $logo = $logoHeight;
        $name = 5;
        $reportItems = 19;
        $items = 4;
        $reportNull = 10;
        $title = 21;
        $reportTotals = 13;
        $pdfHeight = 19;

        if (company()->logo != null) {
            $image = storage_path('app/public/images/logos/' . company()->imageName);

            if (file_exists($image)) {
                $pdfHeight += $logo;
            }
        }

        $pdfHeight += $name + ($lns * 2);

        if ($cashRegister->purchase > 0) {
            foreach ($productPurchases as $productPurchase) {
                $length = strlen($productPurchase->name);
                if ($length > 20) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }

            foreach ($purchases as $purchase) {

                $length = strlen($purchase->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }

            $pdfHeight += ($lns *2) + ($reportItems * 2) + $reportTotals;//total reportItemPurchase raya y espacio

        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }

        if ($cashRegister->expense > 0) {
            foreach ($expenseProducts as $expenseProduct) {

                $length = strlen($expenseProduct->name);
                if ($length > 20) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }

            foreach ($expenses as $expense) {
                $length = strlen($expense->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += ($lns *2) + ($reportItems * 2) + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }

        if ($cashRegister->invoice > 0) {
            foreach ($invoiceProducts as $invoiceProduct) {

                $length = strlen($invoiceProduct->name);
                if ($length > 20) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }

            foreach ($invoices as $invoice) {

                $length = strlen($invoice->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += ($lns *2) + ($reportItems * 2) + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }

        if ($cashRegister->remission > 0) {
            foreach ($productRemissions as $productRemission) {

                $length = strlen($productRemission->name);
                if ($length > 20) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }


            foreach ($remissions as $remission) {

                $length = strlen($remission->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += ($lns *2) + ($reportItems * 2) + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }

        if ($cashRegister->purchase_order > 0) {


            foreach ($purchaseOrders as $purchaseOrder) {

                $length = strlen($purchaseOrder->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if (indicator()->restaurant = 'off') {
            if ($cashRegister->invoice_order > 0) {


                foreach ($invoiceOrders as $invoiceOrders) {

                    $length = strlen($invoiceOrders->third->name);
                    if ($length > 40) {
                        $h = $length / 30;
                        $hh = $h + 2;
                        $pdfHeight += ($hh * 4);
                    } else {
                        $pdfHeight += $items;
                    }
                }
                $pdfHeight += $lns + $reportItems + $reportTotals;;//total reportItemPurchase raya y espacio
            } else {
                $pdfHeight += $reportNull;//reporte de nulo
            }
        } else {
            if ($cashRegister->restaurant_order > 0) {


                foreach ($restaurantOrders as $restaurantOrders) {

                    $length = strlen($restaurantOrders->third->name);
                    if ($length > 40) {
                        $h = $length / 30;
                        $hh = $h + 2;
                        $pdfHeight += ($hh * 4);
                    } else {
                        $pdfHeight += $items;
                    }
                }
                $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
            } else {
                $pdfHeight += $reportNull;//reporte de nulo
            }
        }
        if ($cashRegister->ncinvoice > 0) {
            foreach ($ncinvoices as $ncinvoice) {

                $length = strlen($ncinvoice->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->ndinvoice > 0) {
            foreach ($ndinvoices as $ndinvoice) {

                $length = strlen($ndinvoice->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->ncpurchase > 0) {
            foreach ($ncpurchases as $ncpurchase) {

                $length = strlen($ncpurchase->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->ndpurchase > 0) {
            foreach ($ndpurchases as $ndpurchase) {

                $length = strlen($ndpurchase->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->in_invoice > 0) {
            foreach ($invoicePays as $invoicePay) {

                $length = strlen($invoicePay->payable->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->in_remission > 0) {
            foreach ($remissionPays as $remissionPay) {

                $length = strlen($remissionPay->payable->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->out_purchase > 0) {
            foreach ($purchasePays as $purchasePay) {

                $length = strlen($purchasePay->payable->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->out_expense > 0) {
            foreach ($expensePays as $expensePay) {

                $length = strlen($expensePay->payable->third->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems + $reportTotals;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->in_cash > 0) {
            foreach ($cashInflows as $cashInflow) {

                $length = strlen($cashInflow->reason);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->out_cash > 0) {
            foreach ($cashOutflows as $cashOutflow) {

                $length = strlen($cashOutflow->reason);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($sumAdvanceCustomers > 0) {
            foreach ($advanceCustomers as $advanceCustomer) {

                $length = strlen($advanceCustomer->advanceable->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($sumAdvanceEmployees > 0) {
            foreach ($advanceEmployees as $advanceEmployee) {

                $length = strlen($advanceEmployee->advanceable->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($sumAdvanceProviders > 0) {
            foreach ($advanceProviders as $advanceProvider) {

                $length = strlen($advanceProvider->advanceable->name);
                if ($length > 40) {
                    $h = $length / 30;
                    $hh = $h + 2;
                    $pdfHeight += ($hh * 4);
                } else {
                    $pdfHeight += $items;
                }
            }
            $pdfHeight += $lns + $reportItems;//total reportItemPurchase raya y espacio
        } else {
            $pdfHeight += $reportNull;//reporte de nulo
        }
        if ($cashRegister->out_total > 0) {
            $pdfHeight += $reportTotals;
        }
        if ($cashRegister->in_total > 0) {
            $pdfHeight += $reportTotals;
        }
        if ($cashRegister->cash_initial > 0) {
            $pdfHeight += $reportTotals;
        }
        if ($cashRegister->out_purchase_cash > 0) {
            $pdfHeight += $reportTotals;
        }
        if ($cashRegister->out_expense_cash > 0) {
            $pdfHeight += $reportTotals;
        }
        if ($cashRegister->in_invoice_cash > 0) {
            $pdfHeight += $reportTotals;
        }
        if ($cashRegister->in_remission_cash > 0) {
            $pdfHeight += $reportTotals;
        }
        //reportes totales finales
        $pdfHeight += ($reportTotals * 3) + ($title * 2);

        return $pdfHeight;
    }
}

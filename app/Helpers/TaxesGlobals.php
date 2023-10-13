<?php

use App\Models\CompanyTax;
use App\Models\Indicator;
use App\Models\Purchase;
use App\Models\Tax;

if (! function_exists('taxesGlobals')) {
    function taxesGlobals($document, $quantityBag, $typeDocument)
    {
        $total = $document->total;
        $indicator = Indicator::findOrFail(1);
        //Impuestos globales
        $companyTaxes = CompanyTax::get();
        foreach ($companyTaxes as $key => $companyTax) {
            $id = $companyTax->tax_type_id;
            $percentageTax = $companyTax->percentage->percentage;
            $percentageBase = $companyTax->percentage->base;

            switch($id) {
                case(2):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                                break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                                break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                                break;
                        }
                    }
                break;
                case(3):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                                break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                                break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                                break;
                        }
                    }
                break;
                case(8):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(9):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(10):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(11):
                    if ($quantityBag > 0) {
                        $tax = new Tax();
                        $tax->tax_value = $indicator->plasctic_bag_tax * $quantityBag;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(12):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(13):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(14):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(15):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(16):
                    if ($total >= $percentageBase) {
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTax->id;
                        switch ($typeDocument) {
                            case 'purchase':
                                $purchase = $document;
                                $purchase->taxes()->save($tax);
                            break;
                            case 'ndpurchase':
                                $ndpurchase = $document;
                                $ndpurchase->taxes()->save($tax);
                            break;
                            case 'ncpurchase':
                                $ncpurchase = $document;
                                $ncpurchase->taxes()->save($tax);
                            break;
                            case 'invoice':
                                $invoice = $document;
                                $invoice->taxes()->save($tax);
                            break;
                            case 'ncinvoice':
                                $ncinvoice = $document;
                                $ncinvoice->taxes()->save($tax);
                            break;
                            case 'ndinvoice':
                                $ndinvoice = $document;
                                $ndinvoice->taxes()->save($tax);
                            break;
                        }
                    }
                break;
                case(18):
                    $tax = new Tax();
                    $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                    $tax->type = $typeDocument;
                    $tax->company_tax_id = $companyTax->id;
                    switch ($typeDocument) {
                        case 'purchase':
                            $purchase = $document;
                            $purchase->taxes()->save($tax);
                        break;
                        case 'ndpurchase':
                            $ndpurchase = $document;
                            $ndpurchase->taxes()->save($tax);
                        break;
                        case 'ncpurchase':
                            $ncpurchase = $document;
                            $ncpurchase->taxes()->save($tax);
                        break;
                        case 'invoice':
                            $invoice = $document;
                            $invoice->taxes()->save($tax);
                        break;
                        case 'ncinvoice':
                            $ncinvoice = $document;
                            $ncinvoice->taxes()->save($tax);
                        break;
                        case 'ndinvoice':
                            $ndinvoice = $document;
                            $ndinvoice->taxes()->save($tax);
                        break;
                    }
                break;
                default:
            }
        }
    }
}

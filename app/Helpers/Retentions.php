<?php

use App\Models\CompanyTax;
use App\Models\Tax;

if (! function_exists('retentions')) {
    function retentions($request, $document, $typeDocument)
    {
        $companyTaxId = $request->company_tax_id;
        $total = $document->total;
        $taxTotal = $request->tax_iva;
        if ($companyTaxId != null) {
            for ($i=0; $i < count($companyTaxId); $i++) {

                //seleccionando el impuesto de la compañia que viene del request
                $companyTax = CompanyTax::findOrFail($companyTaxId[$i]);
                $id = $companyTax->tax_type_id;//seleccionando el typo de impuesto retencion
                $percentageTax = $companyTax->percentage->percentage;//tomando el porcentage
                $percentageBase = $companyTax->percentage->base;//tomandola base de impuesto

                switch($id) {
                    case(5):
                        if ($typeDocument == 'purchase' || $typeDocument == 'invoice') {
                            if ($taxTotal >= $percentageBase) {
                                $tax = new Tax();
                                $tax->tax_value = ($taxTotal * $percentageTax)/100;//valor del Reteiva
                                $tax->type = $typeDocument;
                                $tax->company_tax_id = $companyTax->id;
                                switch ($typeDocument) {
                                    case 'purchase':
                                        $purchase = $document;
                                        $purchase->taxes()->save($tax);
                                    break;
                                    case 'invoice':
                                        $invoice = $document;
                                        $invoice->taxes()->save($tax);
                                    break;
                                }
                            }
                        } else {
                            if ($taxTotal > 0) {
                                $tax = new Tax();
                                $tax->tax_value = ($taxTotal * $percentageTax)/100;//valor del Reteiva
                                $tax->type = $typeDocument;
                                $tax->company_tax_id = $companyTax->id;
                                switch ($typeDocument) {
                                    case 'ndpurchase':
                                        $ndpurchase = $document;
                                        $ndpurchase->taxes()->save($tax);
                                    break;
                                    case 'ncpurchase':
                                        $ncpurchase = $document;
                                        $ncpurchase->taxes()->save($tax);
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
                        }
                    break;
                    case(6):
                        if ($typeDocument == 'purchase' || $typeDocument == 'invoice') {
                            if ($total >= $percentageBase) {
                                $tax = new Tax();
                                $tax->tax_value = ($total * $percentageTax)/100;//valor del Reterenta
                                $tax->type = $typeDocument;
                                $tax->company_tax_id = $companyTax->id;
                                switch ($typeDocument) {
                                    case 'purchase':
                                        $purchase = $document;
                                        $purchase->taxes()->save($tax);
                                    break;
                                    case 'invoice':
                                        $invoice = $document;
                                        $invoice->taxes()->save($tax);
                                    break;
                                }
                            }
                        } else {
                            $tax = new Tax();
                            $tax->tax_value = ($total * $percentageTax)/100;//valor del Reterenta
                            $tax->type = $typeDocument;
                            $tax->company_tax_id = $companyTax->id;
                            switch ($typeDocument) {
                                case 'ndpurchase':
                                    $ndpurchase = $document;
                                    $ndpurchase->taxes()->save($tax);
                                break;
                                case 'ncpurchase':
                                    $ncpurchase = $document;
                                    $ncpurchase->taxes()->save($tax);
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
                    case(7):
                        if ($typeDocument == 'purchase' || $typeDocument == 'invoice') {
                            if ($total >= $percentageBase) {
                                $tax = new Tax();
                                $tax->tax_value = ($total * $percentageTax)/100;//valor del ReteIca
                                $tax->type = $typeDocument;
                                $tax->company_tax_id = $companyTax->id;
                                switch ($typeDocument) {
                                    case 'purchase':
                                        $purchase = $document;
                                        $purchase->taxes()->save($tax);
                                    break;
                                    case 'invoice':
                                        $invoice = $document;
                                        $invoice->taxes()->save($tax);
                                    break;
                                }
                            }
                        } else {
                            $tax = new Tax();
                            $tax->tax_value = ($total * $percentageTax)/100;//valor del ReteIca
                            $tax->type = $typeDocument;
                            $tax->company_tax_id = $companyTax->id;
                            switch ($typeDocument) {
                                case 'ndpurchase':
                                    $ndpurchase = $document;
                                    $ndpurchase->taxes()->save($tax);
                                break;
                                case 'ncpurchase':
                                    $ncpurchase = $document;
                                    $ncpurchase->taxes()->save($tax);
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
                    default:
                }
            }
        }
    }
}

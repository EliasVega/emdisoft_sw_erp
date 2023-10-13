<?php

use App\Models\CompanyTax;
use App\Models\Tax;

if (! function_exists('taxesLine')) {
    function taxesLines($document, $taxes, $typeDocument)
    {

        $total = $document->total;
        if ($taxes[0] != []) {
        //impuestos de linea IVA INC
            for ($i=0; $i < count($taxes); $i++) {
                $id = $taxes[$i][0];
                $companyTaxes = CompanyTax::findOrFail($id);
                $percentageTax = $companyTaxes->percentage->percentage;
                $idTax = $companyTaxes->tax_type_id;

                switch($idTax) {
                    case(1):
                        $tax = new Tax();
                        $tax->tax_value = $taxes[$i][2];//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTaxes->id;
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
                    case(4):
                        $tax = new Tax();
                        $tax->tax_value = $taxes[$i][2];//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTaxes->id;
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
                    case(17):
                        $tax = new Tax();
                        $tax->tax_value = ($total * $percentageTax)/100;//valor del impuesto
                        $tax->type = $typeDocument;
                        $tax->company_tax_id = $companyTaxes->id;
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
}

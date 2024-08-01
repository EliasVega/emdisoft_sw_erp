<?php

namespace App\Helpers\Tickets;

use App\Models\InvoiceOrderProduct;
use App\Models\InvoiceProduct;
use App\Models\NcinvoiceProduct;
use App\Models\ProductPurchase;
use App\Models\Resolution;
use App\Models\Tax;
use FPDF;
use Symfony\Polyfill\Mbstring\Mbstring;

class Ticket extends FPDF
{

    public function generateLogo($logo, $width, $height)
    {
        //ancho, alto, mensaje, bordes, salto linea alineacion relleno
        //$this->Cell(0, 5, $messageFooter, 0, 0, 'C',0);

        //ancho, alto, mensaje, bordes, alineacion, relleno
        //$this->MultiCell(0, 5, strtoupper($title), 0, 'C', false);
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($logo, $xPos, 5, $width, $height);
        $this->SetY($this->GetY() + $height);
    }

    public function generateTitle($title, $consecutive)
    {
        //$title = 'DOCUMENTO EQUIVALENTE ELECTRONICO DEL TIQUETE DE MAQUINA REGISTRADORA CON SISTEMA P.O.S.';

        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, strtoupper($title), 0, 'C', false);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(0,5,$consecutive,0,1,'C',false);
    }

    public function generateCompanyInformation()
    {
        $identificationType = formatText(company()->identificationType->initial);
        $nit = formatText(company()->nit);
        $dv = formatText(company()->dv);
        $address = formatText('Dirección: ' . company()->address);
        $phone = formatText('Teléfono: ' . company()->phone);
        $email = formatText('Email: ' . company()->email);
        $companyInformation = $identificationType . ' - ' . $nit . ' - ' . $dv . ' - ' . $address . ' - ' . $phone . ' - ' . $email;
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, strtoupper(company()->name), 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 3, $companyInformation, 0, 'C', false);
        $this->ln(2);
    }

    public function generateBarcode($barcode)
    {
        $width = 25;
        $height = 10;
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($barcode, $xPos, $this->GetY(), $width, $height, 'png');
        $this->SetY($this->GetY() + $height);
        $this->Cell(0, 3, "", 'B', 1, 'C');
        $this->Ln(3);
    }

    public function generateBranchInformation($document)
    {
        $date = formatText('Fecha: ' . $document->generation_date);
        $branch = formatText('Sucursal: ' . $document->branch->name);
        $number = formatText('Consecutivo: ' . $document->id);
        $cashRegister = $document->cashRegister;
        $cashRegisterNumber = formatText('Caja Nro: ' . $cashRegister->id . ' - ' . $cashRegister->salePoint->plate_number);
        $cashierName = formatText('Cajero: ' . $cashRegister->user->name);

        $this->Cell(0, 4, $date, 0, 1, 'C',0);
        $this->Cell(0, 4, $branch, 0, 1, 'C',0);
        $this->Cell(0, 4, $cashRegisterNumber, 0, 1, 'C',0);
        $this->Cell(0, 4, $cashierName, 0, 1, 'C',0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 4, $number, 0, 1, 'C',0);
        $this->Cell(0, 4, "", 'B', 1, 'C');
    }

    /*
    public function generateCashboxInformation($document)
    {
        $date = formatText('Fecha: ' . $document->created_at->format('Y-m-d'));
        $cashRegister = $document->cashRegister;
        $cashRegisterNumber = formatText('Caja Nro: ' . $cashRegister->id . ' - ' . $cashRegister->salePoint->plate_number);
        $cashierName = formatText('Cajero: ' . $cashRegister->user->name);
        $ticketNumber = formatText('Ticket Nro: ' . $document->id);

        $this->MultiCell(0, 5, $date, 0, 'C', false);
        $this->MultiCell(0, 5, $cashRegisterNumber, 0, 'C', false);
        $this->MultiCell(0, 5, $cashierName, 0, 'C', false);
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(0, 5, $ticketNumber, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->generateBreakLine(1, 'short', 5);
    }*/

    public function generateThirdPartyInformation($thirdParty, $thirdPartyType)
    {
        if ($thirdPartyType == "provider") {
            $name = formatText('Proveedor: ' . $thirdParty->name);
        } elseif ($thirdPartyType == "customer") {
            $name = formatText('Cliente: ' . $thirdParty->name);
        }
        $identificationType = $thirdParty->identificationType->initial;
        $identification = formatText($thirdParty->identification);
        $email = formatText('Correo: ' . $thirdParty->email);
        $this->Ln(3);
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(0, 5, $name, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, $identificationType . ': ' . $identification, 0, 1, 'C',0);
        $this->Cell(0, 4, $email, 0, 1, 'C',0);
        $this->Cell(0, 4, "", 'B', 1, 'C');
    }

    public function generateProductsTable($document, $typeDocument)
    {
        switch ($typeDocument) {
            case 'invoice':
                $products = InvoiceProduct::where('invoice_id', $document->id)->get();
                break;
            case 'ncinvoice':
                $products = NcinvoiceProduct::where('ncinvoice_id', $document->id)->get();
                break;
            case 'invoiceOrder':
                $products = InvoiceOrderProduct::where('invoice_order_id', $document->id)->get();
                break;
            case 'purchase':
                $products = ProductPurchase::where('purchase_id', $document->id)->get();
                break;
            default:
                # code...
                break;
        }

        $this->SetFont('Arial', '', 9);
        $this->Ln(2);
        $this->Cell(28, 4, formatText('Producto'), 0, 0, 'C');
        $this->Cell(9, 4, formatText('Cant.'), 0, 0, 'C');
        $this->Cell(13, 4, formatText('Precio'), 0, 0, 'C');
        $this->Cell(18, 4, formatText('Subtotal'), 0, 1, 'C');
        $this->Cell(0, 2, "", 'T', 1, 'C');

        foreach ($products as $product) {
            //$length = strlen($product->product->name);
            $length = $this->GetStringWidth($product->product->name);

            //$this->Multicell(30,5, formatText($invoiceProduct->product->name),'J',1);
            //$this->MultiCell(0, 10, formatText($invoiceProduct->product->name), 0, 'L');
            $this->SetFont('Arial', '', 7);
            if ($length > 28) {
                $this->Multicell(50,4, formatText($product->product->name),'J',1);
                $this->SetX(30);
                $this->Cell(8, 4, $product->quantity, 0, 0, 'R');
            } else {
                $this->Cell(28, 4, formatText($product->product->name), 0, 0, 'L');
                $this->Cell(8, 4, $product->quantity, 0, 0, 'R');
            }
            $this->Cell(12, 4, number_format($product->price), 0, 0, 'R');
            $this->Cell(17, 4, number_format($product->price * $product->quantity), 0, 1, 'R');

            /*
            if ($products->last() != $product) {
                $this->Ln(4);
            }*/
        }
        $this->Cell(0, 3, "", 'T', 1, 'C');
        //$this->generateBreakLine(0, 'long', 5);
    }

    public function generateSummaryInformation($document, $typeDocument)
    {
        if ($typeDocument == 'pos') {
            $typeDocument = 'invoice';
        } else if ($typeDocument == 'support_document'){
            $typeDocument = 'purhase';
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
        $this->SetFont('Arial', '', 9);
        $this->SetX(18);
        $this->Cell(18, 4, formatText("SUBTOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($document->total,2), 0, 1, 'R');
        foreach ($taxes as $tax) {
            $this->SetX(18);
            $this->Cell(18, 5, formatText($tax->name), 0, 0, 'R');
            $this->Cell(30, 5, "$" . number_format($tax->tax_value,2), 0, 1, 'R');
        }
        foreach ($retentions as $retention) {
            $this->SetX(18);
            $this->Cell(18, 5, formatText($retention->name), 0, 0, 'R');
            $this->Cell(30, 5, "$" . number_format($retention->tax_value,2), 0, 1, 'R');
        }
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(18);
        $this->Cell(18, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($document->total_pay,2), 0, 1, 'R');
    }

    public function generateInvoiceInformation($document)
    {
        $this->Ln(10);
        $resolution_id = $document->resolution_id;
        $resolution = Resolution::findOrFail($resolution_id);
        $startDate = $resolution->start_date;
        $endDate = $resolution->end_date;
        $invoiceInformation = formatText("Numeración habilitada por la DIAN.");
        $prefix = formatText("Prefijo: " . $resolution->prefix);
        $consecutive = formatText(" del No. " . $resolution->start_number . " al " . $resolution->end_number);
        $resolution = formatText("Resolución: " . $resolution->resolution);
        $resolutionDate = formatText(" del " . $startDate . " al " . $endDate);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 4, $invoiceInformation, 0, 1, 'C');
        $this->SetFont('Arial', '', 7);
        $this->Cell(0, 4, $prefix . $consecutive, 0, 1, 'C');
        $this->Cell(0, 4, $resolution . $resolutionDate, 0, 1, 'C');
    }


    public function generateQr($qrCode)
    {
        $width = 50;
        $height = 50;
        $xPos = ($this->GetPageWidth() - $width) / 2;
        $this->Ln(3);
        $this->Image($qrCode, $xPos, $this->GetY(), $width, $height, 'png');
        $this->SetY($this->GetY() + $height);
    }

    public function generateConfirmationCode($code)
    {
        $this->MultiCell(0, 5, $code, 0, 'C', false);
        $this->Ln(5);
    }

    public function generateDisclaimerInformation($message)
    {
        $this->Ln(5);
        $this->SetFont('Arial', '', 8);
        $this->MultiCell(0, 4, $message, 0, 'C', false);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 10, formatText("Gracias por su compra"), '', 0, 'C');

    }
    /*

    public function generateBreakLine($marginTop, $size, $marginBottom)
    {
        if ($size == 'short') {
            $this->Cell(0, 3, "-----------------------------------------------------------", 0, 1, 'C');
        } elseif ($size == 'long') {
            $this->Cell(0, 5, "------------------------------------------------------------------------", 0, 1, 'C');
        }
    }*/

    public function footer()
    {
        $messageFooter = "Modo de operacion: Software Propio";
        $messageName = "EMDISOFT S.A.S";
        $this->setY(-10);
        $this->SetFont('Arial', '', 9);
        //$this->Cell(0, 10, formatText(), '', 0, 'C');
        $this->MultiCell(0, 5, $messageFooter, 0, 'C', false);
        $this->MultiCell(0, 5, $messageName, 0, 'C', false);
    }
}

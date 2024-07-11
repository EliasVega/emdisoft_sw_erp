<?php

namespace App\Helpers\Tickets;

use App\Models\InvoiceProduct;
use App\Models\NcinvoiceProduct;
use App\Models\Resolution;
use App\Models\Tax;
use FPDF;
use Symfony\Polyfill\Mbstring\Mbstring;

class Ticket extends FPDF
{
    public function generateLogo($logo, $width, $height)
    {
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($logo, $xPos, 5, $width, $height);
        $this->SetY($this->GetY() + $height);
    }

    public function generateCompanyInformation()
    {
        $identificationType = formatText(company()->identificationType->initial);
        $nit = formatText(company()->nit);
        $dv = formatText(company()->dv);
        $address = formatText('Dirección: ' . company()->address);
        $phone = formatText('Teléfono: ' . company()->phone);
        $email = formatText('Email: ' . company()->email);

        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(72, 5, strtoupper(company()->name), 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(72, 3, $identificationType . ":" . $nit . " - " . $dv, 0, 'C', false);
        $this->MultiCell(72, 3, $address, 0, 'C', false);
        $this->MultiCell(72, 3, $phone, 0, 'C', false);
        $this->MultiCell(72, 3, $email, 0, 'C', false);
        $this->ln(2);
    }

    public function generateBarcode($barcode)
    {
        $width = 25;
        $height = 10;
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($barcode, $xPos, $this->GetY(), $width, $height, 'png');
        $this->SetY($this->GetY() + $height);
        $this->generateBreakLine(1, 'short', 5);
    }

    public function generateBranchInformation($document)
    {
        $date = formatText('Fecha: ' . $document->generation_date);
        $branch = formatText('Sucursal: ' . $document->branch->name);
        $number = formatText('Consecutivo: ' . $document->document);
        $cashRegister = $document->cashRegister;
        $cashRegisterNumber = formatText('Caja Nro: ' . $cashRegister->id . ' - ' . $cashRegister->salePoint->plate_number);
        $cashierName = formatText('Cajero: ' . $cashRegister->user->name);

        $this->MultiCell(0, 3, $date, 0, 'C', false);
        $this->MultiCell(0, 3, $branch, 0, 'C', false);
        $this->MultiCell(0, 5, $cashRegisterNumber, 0, 'C', false);
        $this->MultiCell(0, 5, $cashierName, 0, 'C', false);
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(0, 5, $number, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->generateBreakLine(1, 'short', 5);
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

        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(0, 5, $name, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 3, $identificationType . ': ' . $identification, 0, 'C', false);
        $this->MultiCell(0, 3, $email, 0, 'C', false);
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
            default:
                # code...
                break;
        }

        $this->SetFont('Arial', '', 9);
        $this->generateBreakLine(1, 'long', 3);
        $this->Cell(29, 5, formatText('Producto'), 0, 0, 'C');
        $this->Cell(10, 5, formatText('Cant.'), 0, 0, 'C');
        $this->Cell(15, 5, formatText('Precio'), 0, 0, 'C');
        $this->Cell(20, 5, formatText('Subtotal'), 0, 0, 'C');
        $this->generateBreakLine(3, 'long', 3);

        foreach ($products as $product) {
            $length = strlen($product->product->name);

            //$this->Multicell(30,5, formatText($invoiceProduct->product->name),'J',1);
            //$this->MultiCell(0, 10, formatText($invoiceProduct->product->name), 0, 'L');
            $this->SetFont('Arial', '', 7);
            if ($length > 20) {
                $this->Multicell(50,5, formatText($product->product->name),'J',1);
                $this->Cell(38, 5, $product->quantity, 0, 0, 'R');
            } else {
                $this->Cell(29, 5, formatText($product->product->name), 0, 0, 'L');
                $this->Cell(9, 5, $product->quantity, 0, 0, 'R');
            }
            $this->Cell(14, 5, "$" . number_format($product->price), 0, 0, 'R');
            $this->Cell(19, 5, "$" . number_format($product->price * $product->quantity,2), 0, 0, 'R');
            if ($products->last() != $product) {
                $this->Ln(4);
            }
        }
        $this->generateBreakLine(3, 'long', 3);
    }

    public function generateSummaryInformation($document)
    {
        $taxes = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.taxable_id', $document->id)
        ->where('tt.type_tax', 'tax_item')
        ->get();
        $this->Cell(15, 5, "", 0, 0, 'C');
        $this->Cell(22, 5, formatText("SUBTOTAL"), 0, 0, 'R');
        $this->Cell(34, 5, "$" . number_format($document->total,2), 0, 0, 'R');


        foreach ($taxes as $tax) {
            $this->Ln(5);
            $this->Cell(15, 5, "", 0, 0, 'C');
            $this->Cell(22, 5, formatText($tax->name), 0, 0, 'R');
            $this->Cell(34, 5, "$" . number_format($tax->tax_value,2), 0, 0, 'R');
        }
        $this->Ln(5);
        $this->Cell(15, 5, "", 0, 0, 'C');
        $this->Cell(22, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(34, 5, "$" . number_format($document->total_pay,2), 0, 0, 'R');
        $this->Ln(10);
    }

    public function generateInvoiceInformation($document)
    {
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
        $this->MultiCell(0, 5, $invoiceInformation, 0, 'C', false);
        $this->SetFont('Arial', '', 7);
        $this->MultiCell(0, 5, $prefix . $consecutive, 0, 'C', false);
        $this->MultiCell(0, 5, $resolution . $resolutionDate, 0, 'C', false);
    }

    public function generateQr($qrCode)
    {
        $width = 50;
        $height = 50;
        $xPos = ($this->GetPageWidth() - $width) / 2;

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
        $this->MultiCell(0, 5, $message, 0, 'C', false);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 10, formatText("Gracias por su compra"), '', 0, 'C');

    }

    public function generateBreakLine($marginTop, $size, $marginBottom)
    {
        $this->Ln($marginTop);

        if ($size == 'short') {
            $this->Cell(0, 5, "-----------------------------------------------------------", 0, 0, 'C');
        } elseif ($size == 'long') {
            $this->Cell(0, 5, "------------------------------------------------------------------------", 0, 0, 'C');
        }
        $this->Ln($marginBottom);
    }/*

    public function footer()
    {
        $this->setY(-10);
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 10, formatText("Generado por emdisoft.sas"), '', 0, 'C');
    }*/
}

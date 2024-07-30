<?php

namespace App\Helpers\Pdfs;

//use App\Models\InvoiceOrderProduct;
//use App\Models\InvoiceProduct;
//use App\Models\NcinvoiceProduct;
//use App\Models\ProductPurchase;
//use App\Models\Resolution;
//use App\Models\Tax;

use App\Models\InvoiceOrderProduct;
use App\Models\InvoiceProduct;
use App\Models\NcinvoiceProduct;
use App\Models\ProductPurchase;
use App\Models\Resolution;
use App\Models\Tax;
use FPDF;
use Symfony\Polyfill\Mbstring\Mbstring;

use function App\Helpers\Tickets\formatText;

class PdfDocuments extends FPDF
{
    public function generateHeader($logo, $width, $height, $title, $document)
    {
        $identificationType = formatTextPdf(company()->identificationType->initial);
        $nit = formatTextPdf(company()->nit);
        $dv = formatTextPdf(company()->dv);
        $address = formatTextPdf('Dirección: ' . company()->address);
        $phone = formatTextPdf('Teléfono: ' . company()->phone);
        $email = formatTextPdf('Email: ' . company()->email);

        $resolution = Resolution::findOrFail($document->resolution_id);
        if (indicator()->dian == 'on') {
            $regime = formatTextPdf(company()->regime->name) . ' - ';
            $resolutionNumber = 'Resolucion de Facturacion Electronica No.' . ' - ' . $resolution->resolution . ' - ';
            $resolutionPrefix = 'Prefijo: '. ' - ' . $resolution->prefix . ' - Rango - ' . $resolution->start_number . ' AL ' . $resolution->end_number . ' - ';
            $resolutionDates = 'Vigencia: ' . $resolution->start_date . ' HASTA ' . $resolution->end_date . ' - ';
        } else {
            $regime = '';
            $resolutionNumber = '';
            $resolutionPrefix = '';
            $resolutionDates = '';
        }
        $companyInformation = $identificationType . ' - ' . $nit . ' - ' . $dv . ' - ' . $regime . $resolutionNumber . $resolutionPrefix . $resolutionDates . $address . ' - ' . $phone . ' - ' . $email;

        $heigthInitial = 10;
        $documentType = $document->document_type_id;
        if ($documentType == 15) {
            $heigthInitial = 20;
            $this->SetFont('Arial','B',14);
            $page = $this->GetPageWidth();
            //$w = $this->GetStringWidth($title);
            //dd($w);
            $this->SetDrawColor(0,80,180);
            $this->SetFillColor(230,230,0);
            $this->SetTextColor(0,0,111);
            $this->SetXY(0,10);
            //$this->setY(10);
            //$this->SetLineWidth(1);
            $this->MultiCell(0,5,$title,0,'C',false);
        }

        $this->SetFont('Arial', 'B', 18);
        $page = $this->GetPageWidth();
        $nameCompany = company()->name;
        $nameComp = $this->GetStringWidth($nameCompany);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        $this->SetXY(0,$heigthInitial);
        if ($nameComp < 200) {
            $this->Cell(0,10,strtoupper($nameCompany),0,0,'C', false);
        } else {
            $this->MultiCell(0, 10, strtoupper($nameCompany), 0, 'C', false);
        }
        $addWitch = 0;
        if ($documentType != 15) {
            $addWitch = 10;
            $this->SetFont('Arial','B',14);
            $this->SetXY(10,$heigthInitial + 12);
            $this->SetDrawColor(0,80,180);
            $this->SetFillColor(230,230,0);
            $this->SetTextColor(0,0,111);
            $this->SetLineWidth(1);
            $this->Cell(55,5,$title,0,0,'C',false);

        }
        $this->SetXY(10,$heigthInitial + 10 + $addWitch);
        $this->SetFont('Arial','B',16);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(0,0,111);
        $this->Cell(55,5,$document->document,0,0,'C',false);

        $this->SetFont('Arial','B',12);
        $this->SetXY(10,$heigthInitial + 18 + $addWitch);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        $this->Cell(55,5,'Fecha de Emision:',0,0,'C',false);

        $this->SetFont('Arial','B',12);
        $this->SetXY(10,$heigthInitial + 32);
        $this->Cell(55,5,$document->created_at,0,0,'C',false);


        $this->SetFont('Arial', '', 9);
        $this->setXY(65,$heigthInitial + 13);
        $this->MultiCell(80,4,$companyInformation,0,'C',false);

        $this->Image($logo, 160, $heigthInitial + 13, $width, $height);
    }

    public function generateInformation($thirdParty, $thirdPartyType, $document, $qrImage)
    {
        if ($thirdPartyType == "provider") {
            $name = formatTextPdf('Proveedor: ' . $thirdParty->name);
        } elseif ($thirdPartyType == "customer") {
            $name = formatTextPdf('Cliente: ' . $thirdParty->name);
        }
        $identificationType = $thirdParty->identificationType->initial;
        $identification = formatTextPdf($thirdParty->identification);
        $dv = formatTextPdf($thirdParty->dv);
        $regime = formatTextPdf('Regimen:' . ' - ' . $thirdParty->regime->name);
        $municipality = formatTextPdf('Ciudad:' . ' - ' . $thirdParty->municipality->name);
        $address = formatTextPdf('Direccion:' . ' - ' . $thirdParty->address);
        $phone = formatTextPdf('Telefono:' . ' - ' . $thirdParty->phone);
        $email = formatTextPdf('Correo: ' . $thirdParty->email);
        $paymentForm = formatTextPdf('Forma de pago: ' . $document->paymentForm->name);
        $paymentMethod = formatTextPdf('Medio de pago: ' . $document->paymentMethod->name);
        $dueDate = formatTextPdf('Fecha Vencimiento: ' . $document->due_date);

        $width = 40;
        $height = 35;

        $this->SetFont('Arial', '', 10);
        $this->setXY(10,55);
        $this->Cell(70, 4, $name, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(10,59);
        $this->Cell(70, 4, $identificationType . ': ' . $identification . ' - ' . $dv, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(10,63);
        $this->Cell(70, 4, $regime, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(10,67);
        $this->Cell(70, 4, $municipality, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(10,71);
        $this->Cell(70, 4, $address, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(10,75);
        $this->Cell(70, 4, $phone, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(10,79);
        $this->Cell(70, 4, $email, 0, 'L', false);

        $this->SetFont('Arial', '', 10);
        $this->setXY(80,59);
        $this->Cell(70, 4, $paymentForm, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(80,63);
        $this->Cell(70, 4, $paymentMethod, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->setXY(80,67);
        $this->Cell(70, 4, $dueDate, 0, 'L', false);


        $xPos = ($this->GetPageWidth() - $width) / 2;
        //$this->Image($qrImage, 160, 65, $width, $height);
        $this->Image($qrImage, 160, 50, $width, $height, 'png');
        //$this->SetY($this->GetY() + $height);
    }

    public function generateTablePdf($document, $typeDocument)
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

        $this->SetDrawColor(184,180,180);
        $this->SetFillColor(210,230,255);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(10, 90);
        $this->Cell(10, 8, formatText('#'), 1, 0, 'C', 1);
        $this->Cell(25, 8, formatText('Codigo'), 1, 0, 'C', 1);
        $this->Cell(90, 8, formatText('Producto'), 1, 0, 'C', 1);
        $this->Cell(20, 8, formatText('Cant.'), 1, 0, 'C', 1);
        $this->Cell(25, 8, formatText('Precio'), 1, 0, 'C', 1);
        $this->Cell(30, 8, formatText('Subtotal'), 1, 1, 'C', 1);
        $this->ln(0.5);
        foreach ($products as $key => $product) {
            $length = strlen($product->product->name);
            $this->SetX(10);
            $this->SetDrawColor(236,233,233);
            $this->SetFillColor(250,250,250);
            $this->SetTextColor(0,0,0);

            $this->SetFont('Arial', '', 9);
            $this->Cell(10, 7, $key + 1, 1, 0, 'C',1);
            $this->Cell(25, 7, $product->product->code, 1, 0, 'R',1);
            if ($length > 60) {
                $this->Multicell(90,7, formatText($product->product->name),'J',1);
            } else {
                $this->Cell(90, 7, formatText($product->product->name), 1, 0, 'L',1);
            }
            $this->Cell(20, 7, $product->quantity, 1, 0, 'R',1);
            $this->Cell(25, 7, "$" . number_format($product->price), 1, 0, 'R',1);
            $this->Cell(30, 7, "$" . number_format($product->price * $product->quantity,2), 1, 1, 'R',1);
        }
    }

    public function generateTotals($document, $typeDocument)
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
        $this->Ln(2);
        $this->SetDrawColor(236,233,233);
        $this->SetFillColor(250,250,250);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(120);
        $this->Cell(50, 8, formatText('Subtotal'), 1, 0, 'L', 1);
        $this->Cell(40, 8, '$' . number_format($document->total,2), 1, 1, 'R', 1);

        foreach ($taxes as $tax) {
            $this->SetFont('Arial', 'B', 10);
            $this->SetX(120);
            $this->Cell(50, 8, formatText($tax->name), 1, 0, 'L',1);
            $this->Cell(40, 8, "$" . number_format($tax->tax_value,2), 1, 1, 'R',1);
        }
        foreach ($retentions as $retention) {
            $this->SetFont('Arial', 'B', 10);
            $this->SetX(120);
            $this->Cell(50, 8, formatText($retention->name), 1, 0, 'L',1);
            $this->Cell(40, 8, "$" . number_format($retention->tax_value,2), 1, 1, 'R',1);
        }
        $this->SetFont('Arial', 'B', 12);
        $this->SetX(120);
        $this->Cell(50, 10, formatText("TOTAL"), 1, 0, 'L',1);
        $this->Cell(40, 10, "$" . number_format($document->total_pay,2), 1, 1, 'R',1);
    }

    public function documentInformation($document, $cufe)
    {
        $page = $this->GetPageHeight();
        $documentInformation = 'Factura de Venta Electronica ' .  $document->document . '  ' . 'Fecha y Hora de Creacion ' . $document->created_at;
        $cufe = $cufe;
        $this->setY($page - 20);
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0, 10, formatText(), '', 0, 'C');
        $this->Cell(0, 5, $documentInformation, 'T', 1, 'C',0);
        if (indicator()->dian == 'off') {
            $this->Cell(0, 5, $cufe, 0, 1, 'C',0);
        }
    }

    public function footer()
    {
        $page = $this->GetPageHeight();
        $messageFooter = "Modo de operacion: Software Propio By  EMDISOFT S.A.S";
        $this->setY($page -10);
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0, 10, formatText(), '', 0, 'C');
        $this->Cell(0, 5, $messageFooter, 0, 0, 'C',0);
    }
/*
    public function generateBarcode($barcode)
    {
        $width = 25;
        $height = 10;
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($barcode, $xPos, $this->GetY(), $width, $height, 'png');
        $this->SetY($this->GetY() + $height);
        $this->generateBreakLine(1, 'short', 5);
    }
*/
/*
    public function generateBranchInformation($document)
    {
        $date = formatText('Fecha: ' . $document->generation_date);
        $branch = formatText('Sucursal: ' . $document->branch->name);
        $number = formatText('Consecutivo: ' . $document->id);
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
*/
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
/*
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
*/
/*
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
        $this->generateBreakLine(1, 'long', 5);
        $this->Cell(28, 5, formatText('Producto'), 0, 0, 'C');
        $this->Cell(10, 5, formatText('Cant.'), 0, 0, 'C');
        $this->Cell(14, 5, formatText('Precio'), 0, 0, 'C');
        $this->Cell(19, 5, formatText('Subtotal'), 0, 0, 'C');
        $this->generateBreakLine(3, 'long', 5);

        foreach ($products as $product) {
            $length = strlen($product->product->name);

            //$this->Multicell(30,5, formatText($invoiceProduct->product->name),'J',1);
            //$this->MultiCell(0, 10, formatText($invoiceProduct->product->name), 0, 'L');
            $this->SetFont('Arial', '', 7);
            if ($length > 18) {
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
        $this->generateBreakLine(3, 'long', 5);
    }
*/
/*
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
*/
/*
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
*/
/*
    public function generateQr($qrCode)
    {
        $width = 50;
        $height = 50;
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($qrCode, $xPos, $this->GetY(), $width, $height, 'png');
        $this->SetY($this->GetY() + $height);
    }
*/
/*
    public function generateConfirmationCode($code)
    {
        $this->MultiCell(0, 5, $code, 0, 'C', false);
        $this->Ln(5);
    }
*/
/*
    public function generateDisclaimerInformation($message)
    {
        $this->MultiCell(0, 5, $message, 0, 'C', false);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 10, formatText("Gracias por su compra"), '', 0, 'C');

    }
*/
/*
    public function generateBreakLine($marginTop, $size, $marginBottom)
    {
        $this->Ln($marginTop);

        if ($size == 'short') {
            $this->Cell(0, 5, "-----------------------------------------------------------", 0, 0, 'C');
        } elseif ($size == 'long') {
            $this->Cell(0, 5, "------------------------------------------------------------------------", 0, 0, 'C');
        }
        $this->Ln($marginBottom);
    }
*/
/*
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
*/
}


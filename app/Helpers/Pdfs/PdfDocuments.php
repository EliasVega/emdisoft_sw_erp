<?php

namespace App\Helpers\Pdfs;

//use App\Models\InvoiceOrderProduct;
//use App\Models\InvoiceProduct;
//use App\Models\NcinvoiceProduct;
//use App\Models\ProductPurchase;
//use App\Models\Resolution;
//use App\Models\Tax;
use FPDF;
use Symfony\Polyfill\Mbstring\Mbstring;

use function App\Helpers\Tickets\formatText;

class PdfDocuments extends FPDF
{
    public function generateHeader($logo, $width, $height, $title, $document)
    {
        $identificationType = formatText(company()->identificationType->initial);
        $nit = formatText(company()->nit);
        $dv = formatText(company()->dv);
        $address = formatText('Dirección: ' . company()->address);
        $phone = formatText('Teléfono: ' . company()->phone);
        $email = formatText('Email: ' . company()->email);
        $widthInitial = 10;
        /*
        // Logo
        $this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Title',1,0,'C');
        // Salto de línea
        $this->Ln(20);*/
        $documentType = $document->document_type_id;
        if ($documentType == 15) {
            $widthInitial = 30;
            $this->SetFont('Arial','B',14);
            $page = $this->GetPageWidth();
            //$w = $this->GetStringWidth($title);
            //dd($w);
            $this->SetDrawColor(0,80,180);
            $this->SetFillColor(230,230,0);
            $this->SetTextColor(220,50,50);
            //$this->SetLineWidth(1);
            $this->MultiCell(0,10,$title,0,'C',false);
        }

        $this->SetFont('Arial', 'B', 18);
        $page = $this->GetPageWidth();
        $nameCompany = company()->name;
        $nameComp = $this->GetStringWidth($nameCompany);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        if ($nameComp < 200) {
            $this->Cell(0,$widthInitial,strtoupper($nameCompany),0,0,'C', false);
        } else {
            $this->MultiCell(0, 10, strtoupper($nameCompany), 0, 'C', false);
        }

        if ($documentType != 15) {
            $this->SetFont('Arial','B',14);
            $this->SetX(50);
            $this->setY(20);
            $this->SetDrawColor(0,80,180);
            $this->SetFillColor(230,230,0);
            $this->SetTextColor(220,50,50);
            $this->SetLineWidth(1);
            $this->Cell(50,20,$title,0,0,'C',false);

        }
        $this->SetX(50);
        $this->setY(20);
        $this->SetFont('Arial','B',16);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(220,50,50);
        $this->Cell(50,30,$document->document,0,0,'C',false);
        $this->SetFont('Arial','B',12);
        $this->SetX(50);
        $this->setY(25);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        $this->Cell(50,30,'Fecha de Emision:',0,0,'C',false);
        $this->SetFont('Arial','B',12);
        $this->SetX(50);
        $this->setY(30);
        $this->Cell(50,30,$document->created_at,0,0,'C',false);

        //$this->Ln(10);
        /*
        $this->SetX(70);
        $this->setY(24);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(220,50,50);
        $this->SetLineWidth(1);
        $this->Cell(70,24,$title2,0,0,'C',false);
        //$this->Ln(10);

        $this->SetX(70);
        $this->setY(28);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(220,50,50);
        $this->SetLineWidth(1);
        $this->Cell(70,28,$title3,0,0,'C',false);
        //$this->Ln(10);
        // Guardar ordenada
        //$this->y = $this->GetY();
        //$this->SetFont('Arial', '', 9);
        //$this->ln(2);
        */
        /*
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(10,10,strtoupper(company()->name),0,0,'C');
        //$this->Cell(5,0,"FACTURA");
        //$this->Cell(120, 10, strtoupper(company()->name), 0, 0, 'C');
        //$this->MultiCell(0, 10, strtoupper(company()->name), 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->Cell(10,20,$identificationType . ":" . $nit . " - " . $dv,0,0,'C');
        //$this->Cell(0, 3, $identificationType . ":" . $nit . " - " . $dv, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(10);
        $this->Cell(10,28,$address,0,0,'C');
        //$this->Cell(0, 3, $address, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(10);
        $this->Cell(10,36,$phone,0,0,'C');
        //$this->Cell(0, 3, $phone, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(10);
        $this->Cell(10,44,$email,0,0,'C');
        //$this->Cell(0, 3, $email, 0, 'C', false);
        //$this->ln(2);*/

/*
        $this->SetFont('Arial', 'B', 18);
        $this->setY(20);
        $this->setX(10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(10,10,strtoupper(company()->name),0,0,'C');*/
        //$this->Cell(5,0,"FACTURA");
        //$this->Cell(120, 10, strtoupper(company()->name), 0, 0, 'C');
        //$this->MultiCell(0, 10, strtoupper(company()->name), 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(105);
        $this->Cell(10,20,$identificationType . ":" . $nit . " - " . $dv,0,0,'C');
        //$this->Cell(0, 3, $identificationType . ":" . $nit . " - " . $dv, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(105);
        $this->Cell(10,28,$address,0,0,'C');
        //$this->Cell(0, 3, $address, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(105);
        $this->Cell(10,36,$phone,0,0,'C');
        //$this->Cell(0, 3, $phone, 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->setY(20);
        $this->setX(105);
        $this->Cell(10,44,$email,0,0,'C');
        //$this->Cell(0, 3, $email, 0, 'C', false);
        //$this->ln(2);


        $this->Image($logo, 160, $widthInitial + 15, $width, $height);
        /*
        //$this->Image($logo, $xPos, 5, $width, $height);
        //$this->SetY($this->GetY() + $height);
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(120);
        // Título
        $this->Cell(30,10,'EMDISOFT S.A.S.',1,0,'C');
        // Salto de línea
        $this->Ln(20);*/
    }

/*
    public function generateTitle($title)
    {
        //$title = 'DOCUMENTO EQUIVALENTE ELECTRONICO DEL TIQUETE DE MAQUINA REGISTRADORA CON SISTEMA P.O.S.';

        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, strtoupper($title), 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->ln(2);
    }
*/
/*
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
        $this->MultiCell(0, 5, strtoupper(company()->name), 0, 'C', false);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 3, $identificationType . ":" . $nit . " - " . $dv, 0, 'C', false);
        $this->MultiCell(0, 3, $address, 0, 'C', false);
        $this->MultiCell(0, 3, $phone, 0, 'C', false);
        $this->MultiCell(0, 3, $email, 0, 'C', false);
        $this->ln(2);
    }
*/
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


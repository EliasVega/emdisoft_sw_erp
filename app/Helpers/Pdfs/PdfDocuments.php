<?php

namespace App\Helpers\Pdfs;

use App\Models\InvoiceOrderProduct;
use App\Models\InvoiceProduct;
use App\Models\Ncinvoice;
use App\Models\NcinvoiceProduct;
use App\Models\Ndinvoice;
use App\Models\NdinvoiceProduct;
use App\Models\ProductPurchase;
use App\Models\ProductRemission;
use App\Models\Resolution;
use App\Models\Tax;
use FPDF;
use Symfony\Polyfill\Mbstring\Mbstring;

class PdfDocuments extends FPDF
{
    public function generateHeader($logo, $width, $height, $title, $document)
    {
        $identificationType = pdfFormatText(company()->identificationType->initial);
        $nit = pdfFormatText(company()->nit);
        $dv = pdfFormatText(company()->dv);
        $address = pdfFormatText('Dirección: ' . company()->address);
        $phone = pdfFormatText('Teléfono: ' . company()->phone);
        $email = pdfFormatText('Email: ' . company()->email);
        
        $resolution = Resolution::findOrFail($document->resolution_id);
        if (indicator()->dian == 'on') {
            $regime = pdfFormatText(company()->regime->name) . ' - ';
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
        if ($documentType == 15 || $documentType == 104) {
            $heigthInitial = 20;
            $this->SetFont('Arial','B',14);
            $page = $this->GetPageWidth();

            //$w = $this->GetStringWidth($title);
            //dd($w);
            $this->SetDrawColor(0,80,180);
            $this->SetFillColor(230,230,0);
            $this->SetTextColor(0,0,111);
            $this->SetXY(10,10);
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
        if ($documentType != 15 && $documentType != 104) {
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
        $this->SetXY(10,$heigthInitial + 16 + $addWitch);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        $this->Cell(55,5,'Fecha de Emision:',0,1,'C',false);
        $this->Cell(55,5,$document->created_at,0,0,'C',false);


        $this->SetFont('Arial', '', 9);
        $this->setXY(65,$heigthInitial + 13);
        $this->MultiCell(80,4,$companyInformation,0,'C',false);
        if (indicator()->logo == 'on') {
            $this->Image($logo, 160, $heigthInitial + 13, $width, $height);
        }
        
    }

    public function generateHeaderPurchase($logo, $width, $height, $title, $document)
    {
        $identificationType = pdfFormatText(company()->identificationType->initial);
        $nit = pdfFormatText(company()->nit);
        $dv = pdfFormatText(company()->dv);
        $address = pdfFormatText('Dirección: ' . company()->address);
        $phone = pdfFormatText('Teléfono: ' . company()->phone);
        $email = pdfFormatText('Email: ' . company()->email);
        
        $resolution = Resolution::findOrFail($document->resolution_id);
        $documentType = $document->document_type_id;
        if (indicator()->dian == 'on' && $documentType == 11) {
            $regime = pdfFormatText(company()->regime->name) . ' - ';
            $resolutionNumber = 'Resolucion Documento Soporte No.' . ' - ' . $resolution->resolution . ' - ';
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
        //Nombre de la empresa
        $this->SetFont('Arial', 'B', 16);
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
        //Nombre documento 
        $addWitch = 10;
        $titleWitch = $this->GetStringWidth($title);
        
        $this->SetFont('Arial','B',12);
        $this->SetXY(10,$heigthInitial + 13);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(0,0,111);
        $this->SetLineWidth(1);
        
        if ($titleWitch < 60) {
            $this->Cell(10,4,strtoupper($title),0,0,'C', false);
        } else {
            $this->MultiCell(60,4, strtoupper($title), 0, 'C', false);
        }
        
        $this->SetXY(10,$heigthInitial + 13 + $addWitch);
        $this->SetFont('Arial','B',14);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(0,0,111);
        $this->Cell(55,5,$document->document,0,0,'C',false);

        $this->SetFont('Arial','B',12);
        $this->SetXY(10,$heigthInitial + 18 + $addWitch);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        $this->Cell(55,5,'Fecha de Emision:',0,1,'C',false);
        $this->Cell(55,5,$document->created_at,0,0,'C',false);


        $this->SetFont('Arial', '', 9);
        $this->setXY(65,$heigthInitial + 13);
        $this->MultiCell(80,4,$companyInformation,0,'C',false);
        if (indicator()->logo == 'on') {
            $this->Image($logo, 150, $heigthInitial + 13, $width, $height);
        }
        
    }

    public function generateHeaderOrders($logo, $width, $height, $title, $document)
    {
        $identificationType = pdfFormatText(company()->identificationType->initial);
        $nit = pdfFormatText(company()->nit);
        $dv = pdfFormatText(company()->dv);
        $address = pdfFormatText('Dirección: ' . company()->address);
        $phone = pdfFormatText('Teléfono: ' . company()->phone);
        $email = pdfFormatText('Email: ' . company()->email);

        $regime = '';
        $resolutionNumber = '';
        $resolutionPrefix = '';
        $resolutionDates = '';
        
        $companyInformation = $identificationType . ' - ' . $nit . ' - ' . $dv . ' - ' . $regime .  ' - ' . $phone . ' - ' . $email;

        $heigthInitial = 10;
        //Nombre de la empresa
        $this->SetFont('Arial', 'B', 16);
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
        //Nombre documento 
        $addWitch = 10;
        $titleWitch = $this->GetStringWidth($title);
        
        $this->SetFont('Arial','B',12);
        $this->SetXY(10,$heigthInitial + 13);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(0,0,111);
        $this->SetLineWidth(1);
        
        if ($titleWitch < 60) {
            $this->Cell(60,4,strtoupper($title),0,0,'C', false);
        } else {
            $this->MultiCell(60,4, strtoupper($title), 0, 'C', false);
        }
        
        $this->SetXY(10,$heigthInitial + 13 + $addWitch);
        $this->SetFont('Arial','B',14);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(0,0,111);
        $this->Cell(60,5,'DOC' . ' - ' . $document->id,0,0,'C',false);

        $this->SetFont('Arial','B',12);
        $this->SetXY(10,$heigthInitial + 18 + $addWitch);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0,0,0);
        $this->Cell(60,5,'Fecha de Emision:',0,1,'C',false);
        $this->Cell(60,5,$document->created_at,0,0,'C',false);


        $this->SetFont('Arial', '', 9);
        $this->setXY(65,$heigthInitial + 13);
        $this->MultiCell(80,4,$companyInformation,0,'C',false);
        if (indicator()->logo == 'on') {
            $this->Image($logo, 150, $heigthInitial + 13, $width, $height);
        }
    }

    public function generateInformation($thirdParty, $thirdPartyType, $document, $qrImage)
    {
        if ($thirdPartyType == "provider") {
            $name = pdfFormatText('Proveedor: ' . $thirdParty->name);
        } elseif ($thirdPartyType == "customer") {
            $name = pdfFormatText('Cliente: ' . $thirdParty->name);
        }
        $identificationType = $thirdParty->identificationType->initial;
        $identification = pdfFormatText($thirdParty->identification);
        $dv = pdfFormatText($thirdParty->dv);
        $regime = pdfFormatText('Regimen:' . ' - ' . $thirdParty->regime->name);
        $municipality = pdfFormatText('Ciudad:' . ' - ' . $thirdParty->municipality->name);
        $address = pdfFormatText('Direccion:' . ' - ' . $thirdParty->address);
        $phone = pdfFormatText('Telefono:' . ' - ' . $thirdParty->phone);
        $email = pdfFormatText('Correo: ' . $thirdParty->email);
        $paymentForm = pdfFormatText('Forma de pago: ' . $document->paymentForm->name);
        $paymentMethod = pdfFormatText('Medio de pago: ' . $document->paymentMethod->name);
        $dueDate = pdfFormatText('Fecha Vencimiento: ' . $document->due_date);

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

    public function generateInfoPredocuments($thirdParty, $thirdPartyType, $document, $qrImage)
    {
        if ($thirdPartyType == "provider") {
            $name = pdfFormatText('Proveedor: ' . $thirdParty->name);
        } elseif ($thirdPartyType == "customer") {
            $name = pdfFormatText('Cliente: ' . $thirdParty->name);
        }
        $identificationType = $thirdParty->identificationType->initial;
        $identification = pdfFormatText($thirdParty->identification);
        $dv = pdfFormatText($thirdParty->dv);
        $regime = pdfFormatText('Regimen:' . ' - ' . $thirdParty->regime->name);
        $municipality = pdfFormatText('Ciudad:' . ' - ' . $thirdParty->municipality->name);
        $address = pdfFormatText('Direccion:' . ' - ' . $thirdParty->address);
        $phone = pdfFormatText('Telefono:' . ' - ' . $thirdParty->phone);
        $email = pdfFormatText('Correo: ' . $thirdParty->email);
        $dueDate = pdfFormatText('Fecha Vencimiento: ' . $document->due_date);

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
            case 'ndinvoice':
                $products = NdinvoiceProduct::where('ndinvoice_id', $document->id)->get();
                break;
            case 'invoiceOrder':
                $products = InvoiceOrderProduct::where('invoice_order_id', $document->id)->get();
                break;
            case 'remission':
                $products = ProductRemission::where('remission_id', $document->id)->get();
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
        $this->Cell(10, 8, pdfFormatText('#'), 1, 0, 'C', 1);
        //$this->Cell(25, 8, pdfFormatText('Codigo'), 1, 0, 'C', 1);
        $this->Cell(88, 8, pdfFormatText('Producto'), 1, 0, 'C', 1);
        $this->Cell(20, 8, pdfFormatText('Cant.'), 1, 0, 'C', 1);
        $this->Cell(25, 8, pdfFormatText('Precio'), 1, 0, 'C', 1);
        $this->Cell(25, 8, pdfFormatText('IVA/INC'), 1, 0, 'C', 1);
        $this->Cell(32, 8, pdfFormatText('Subtotal'), 1, 1, 'C', 1);
        $this->ln(0.5);
        foreach ($products as $key => $product) {
            //$subtotal = $product->price * $product->quantity;
            //$taxLine = $subtotal *
            $length = strlen($product->product->name);
            $this->SetX(10);
            $this->SetDrawColor(236,233,233);
            $this->SetFillColor(250,250,250);
            $this->SetTextColor(0,0,0);

            $this->SetFont('Arial', '', 9);
            $this->Cell(10, 7, $key + 1, 1, 0, 'C',1);
            //$this->Cell(25, 7, $product->product->code, 1, 0, 'R',1);
            if ($length > 60) {
                $this->Multicell(88,7, pdfFormatText($product->product->name),'J',1);
            } else {
                $this->Cell(88, 7, pdfFormatText($product->product->name), 1, 0, 'L',1);
            }
            $this->Cell(20, 7, $product->quantity, 1, 0, 'R',1);
            $this->Cell(25, 7, number_format($product->price,2), 1, 0, 'R',1);
            $this->Cell(25, 7, number_format($product->tax_subtotal,2), 1, 0, 'R',1);
            $this->Cell(32, 7, number_format($product->price * $product->quantity,2), 1, 1, 'R',1);
        }
    }

    public function generateTotals($document, $typeDocument)
    {
        if ($typeDocument == 'pos') {
            $typeDocument = 'invoice';
        } else if ($typeDocument == 'support_document'){
            $typeDocument = 'purhase';
        } else if ($typeDocument == 'remissionPos'){
            $typeDocument = 'remission';
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
        $this->Cell(50, 8, pdfFormatText('Subtotal'), 1, 0, 'L', 1);
        $this->Cell(40, 8, '$' . number_format($document->total,2), 1, 1, 'R', 1);

        if ($typeDocument == 'invoiceOrder' || $typeDocument == 'remission') {
            $this->SetFont('Arial', 'B', 10);
            $this->SetX(120);
            $this->Cell(50, 8, pdfFormatText('IMPUESTO'), 1, 0, 'L',1);
            $this->Cell(40, 8, "$" . number_format($document->total_tax,2), 1, 1, 'R',1);
        }
        foreach ($taxes as $tax) {
            $this->SetFont('Arial', 'B', 10);
            $this->SetX(120);
            $this->Cell(50, 8, pdfFormatText($tax->name), 1, 0, 'L',1);
            $this->Cell(40, 8, "$" . number_format($tax->tax_value,2), 1, 1, 'R',1);
        }
        foreach ($retentions as $retention) {
            $this->SetFont('Arial', 'B', 10);
            $this->SetX(120);
            $this->Cell(50, 8, pdfFormatText($retention->name), 1, 0, 'L',1);
            $this->Cell(40, 8, "$" . number_format($retention->tax_value,2), 1, 1, 'R',1);
        }
        $this->SetFont('Arial', 'B', 12);
        $this->SetX(120);
        $this->Cell(50, 10, pdfFormatText("TOTAL"), 1, 0, 'L',1);
        $this->Cell(40, 10, "$" . number_format($document->total_pay,2), 1, 1, 'R',1);

        if ($typeDocument == 'invoice') {
            $debitNotes = Ndinvoice::where('invoice_id', $document->id)->first();
            $creditNotes = Ncinvoice::where('invoice_id', $document->id)->first();
            $retention = Tax::where('type', 'invoice')->where('taxable_id', $document->id)->get();
            //$paymentReturns = PaymentReturn::where('invoice_id', $document->id)->first();

            $debitNote = 0;
            $creditNote = 0;
            $retentionnd = 0;
            $retentionnc = 0;
            if ($debitNotes != null) {
                $debitNote = $debitNotes->total_pay;
                $retnd = Tax::where('type', 'ndinvoice')->where('retentionable_id', $debitNotes->id)->first();
                $retentionnd = $retnd->retention;
            }
            if ($creditNotes != null) {
                $creditNote = $creditNotes->total_pay;
                $retnc = Tax::where('type', 'ncinvoice')->where('retentionable_id', $creditNotes->id)->first();
                $retentionnc = $retnc->retention;
            }

            if ($document->pay > 0) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('ABONOS'), 1, 0, 'L',1);
                $this->Cell(40, 8, "-$" . number_format($document->pay,2), 1, 1, 'R',1);
            }
            if ($debitNote > 0) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('NOTA DEBITO'), 1, 0, 'L',1);
                $this->Cell(40, 8, "$" . number_format($debitNote,2), 1, 1, 'R',1);
            }
            if ($retentionnd > 0) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('RETEENCION ND'), 1, 0, 'L',1);
                $this->Cell(40, 8, "-$" . number_format($retentionnd,2), 1, 1, 'R',1);
            }
            if ($creditNote > 0) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('NOTA CREDITO'), 1, 0, 'L',1);
                $this->Cell(40, 8, "-$" . number_format($creditNote,2), 1, 1, 'R',1);
            }
            if ($retentionnc > 0) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('RETEENCION NC'), 1, 0, 'L',1);
                $this->Cell(40, 8, "-$" . number_format($retentionnc,2), 1, 1, 'R',1);
            }
            if ($document->total_pay != $document->balance) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('SALDO X PAGAR'), 1, 0, 'L',1);
                $this->Cell(40, 8, "$" . number_format($document->total_pay - $document->pay - $creditNote + $debitNote + $retentionnc - $retentionnd,2), 1, 1, 'R',1);
            }
            /*
            if (isset($paymentReturns)) {
                $this->Cell(0, 3, "", 'B', 1, 'C');

                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('EFECTIVO'), 1, 0, 'L',1);
                $this->Cell(40, 8, "$" . number_format($paymentReturns->payment,2), 1, 1, 'R',1);

                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('CAMBIO'), 1, 0, 'L',1);
                $this->Cell(40, 8, "$" . number_format($paymentReturns->return,2), 1, 1, 'R',1);
            }*/
        } elseif ($typeDocument == 'remission'){
            //$paymentRemissionReturns = PaymentRemissionReturn::where('remission_id', $document->id)->first();
            if ($document->pay > 0) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('ABONOS'), 1, 0, 'L',1);
                $this->Cell(40, 8, "-$" . number_format($document->pay,2), 1, 1, 'R',1);
            }

            if ($document->total_pay != $document->balance) {
                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('SALDO X PAGAR'), 1, 0, 'L',1);
                $this->Cell(40, 8, "-$" . number_format($document->total_pay - $document->pay,2), 1, 1, 'R',1);
            }
            /*
            if (isset($paymentRemissionReturns)) {
                $this->Cell(0, 3, "", 'B', 1, 'C');

                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('EFECTIVO'), 1, 0, 'L',1);
                $this->Cell(40, 8, "$" . number_format($paymentRemissionReturns->payment,2), 1, 1, 'R',1);

                $this->SetFont('Arial', '', 10);
                $this->SetX(120);
                $this->Cell(50, 8, pdfFormatText('CAMBIO'), 1, 0, 'L',1);
                $this->Cell(40, 8, "$" . number_format($paymentRemissionReturns->return,2), 1, 1, 'R',1);
            }*/
        }
    }

    public function documentInformation($document, $cufe)
    {
        $page = $this->GetPageHeight();
        $documentInformation = 'Factura de Venta Electronica ' .  $document->document . '  ' . 'Fecha y Hora de Creacion ' . $document->created_at;
        $cufe = 'cufe: ' . $cufe;
        $this->setY($page - 20);
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0, 10, pdfFormatText(), '', 0, 'C');
        $this->Cell(0, 5, $documentInformation, 'T', 1, 'C',0);
        if (indicator()->dian == 'on') {
            $this->Cell(0, 5, $cufe, 0, 1, 'C',0);
        }
    }

    public function footer()
    {
        $page = $this->GetPageHeight();
        $messageFooter = "Modo de operacion: Software Propio By  EMDISOFT S.A.S";
        $this->setY($page -10);
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0, 10, pdfFormatText(), '', 0, 'C');
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
        $date = pdfFormatText('Fecha: ' . $document->generation_date);
        $branch = pdfFormatText('Sucursal: ' . $document->branch->name);
        $number = pdfFormatText('Consecutivo: ' . $document->id);
        $cashRegister = $document->cashRegister;
        $cashRegisterNumber = pdfFormatText('Caja Nro: ' . $cashRegister->id . ' - ' . $cashRegister->salePoint->plate_number);
        $cashierName = pdfFormatText('Cajero: ' . $cashRegister->user->name);

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
        $date = pdfFormatText('Fecha: ' . $document->created_at->format('Y-m-d'));
        $cashRegister = $document->cashRegister;
        $cashRegisterNumber = pdfFormatText('Caja Nro: ' . $cashRegister->id . ' - ' . $cashRegister->salePoint->plate_number);
        $cashierName = pdfFormatText('Cajero: ' . $cashRegister->user->name);
        $ticketNumber = pdfFormatText('Ticket Nro: ' . $document->id);

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
            $name = pdfFormatText('Proveedor: ' . $thirdParty->name);
        } elseif ($thirdPartyType == "customer") {
            $name = pdfFormatText('Cliente: ' . $thirdParty->name);
        }
        $identificationType = $thirdParty->identificationType->initial;
        $identification = pdfFormatText($thirdParty->identification);
        $email = pdfFormatText('Correo: ' . $thirdParty->email);

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
        $this->Cell(28, 5, pdfFormatText('Producto'), 0, 0, 'C');
        $this->Cell(10, 5, pdfFormatText('Cant.'), 0, 0, 'C');
        $this->Cell(14, 5, pdfFormatText('Precio'), 0, 0, 'C');
        $this->Cell(19, 5, pdfFormatText('Subtotal'), 0, 0, 'C');
        $this->generateBreakLine(3, 'long', 5);

        foreach ($products as $product) {
            $length = strlen($product->product->name);

            //$this->Multicell(30,5, pdfFormatText($invoiceProduct->product->name),'J',1);
            //$this->MultiCell(0, 10, pdfFormatText($invoiceProduct->product->name), 0, 'L');
            $this->SetFont('Arial', '', 7);
            if ($length > 18) {
                $this->Multicell(50,5, pdfFormatText($product->product->name),'J',1);
                $this->Cell(38, 5, $product->quantity, 0, 0, 'R');
            } else {
                $this->Cell(29, 5, pdfFormatText($product->product->name), 0, 0, 'L');
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
        $this->Cell(22, 5, pdfFormatText("SUBTOTAL"), 0, 0, 'R');
        $this->Cell(34, 5, "$" . number_format($document->total,2), 0, 0, 'R');


        foreach ($taxes as $tax) {
            $this->Ln(5);
            $this->Cell(15, 5, "", 0, 0, 'C');
            $this->Cell(22, 5, pdfFormatText($tax->name), 0, 0, 'R');
            $this->Cell(34, 5, "$" . number_format($tax->tax_value,2), 0, 0, 'R');
        }
        $this->Ln(5);
        $this->Cell(15, 5, "", 0, 0, 'C');
        $this->Cell(22, 5, pdfFormatText("TOTAL"), 0, 0, 'R');
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
        $invoiceInformation = pdfFormatText("Numeración habilitada por la DIAN.");
        $prefix = pdfFormatText("Prefijo: " . $resolution->prefix);
        $consecutive = pdfFormatText(" del No. " . $resolution->start_number . " al " . $resolution->end_number);
        $resolution = pdfFormatText("Resolución: " . $resolution->resolution);
        $resolutionDate = pdfFormatText(" del " . $startDate . " al " . $endDate);

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
        $this->Cell(0, 10, pdfFormatText("Gracias por su compra"), '', 0, 'C');

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
        //$this->Cell(0, 10, pdfFormatText(), '', 0, 'C');
        $this->MultiCell(0, 5, $messageFooter, 0, 'C', false);
        $this->MultiCell(0, 5, $messageName, 0, 'C', false);
    }
*/
}


<?php

namespace App\Helpers\Tickets;

use FPDF;
use Symfony\Polyfill\Mbstring\Mbstring;

class TicketCashRegister extends FPDF
{
    public function cashRegisterLogo($logo, $width, $height)
    {
        //ancho, alto, mensaje, bordes, salto linea alineacion relleno
        //$this->Cell(0, 5, $messageFooter, 0, 0, 'C',0);

        //ancho, alto, mensaje, bordes, alineacion, relleno
        //$this->MultiCell(0, 5, strtoupper($title), 0, 'C', false);
        $xPos = ($this->GetPageWidth() - $width) / 2;

        $this->Image($logo, $xPos, 5, $width, $height);
        $this->SetY($this->GetY() + $height);
    }

    public function cashRegisterName()
    {
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, strtoupper(current_user()->name), 0, 'C', false);
    }

    public function reportNull($documentNull)
    {
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, strtoupper($documentNull), 0, 'C', false);
    }

    public function reportItemDocuments($documentItems, $name, $totales)
    {
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText($name), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(3, 4, formatText('Id'), 'B', 0, 'C');
        $this->Cell(28, 4, formatText('Producto'), 'B', 0, 'C');
        $this->Cell(9, 4, formatText('Cant.'), 'B', 0, 'C');
        $this->Cell(10, 4, formatText('Imp'), 'B', 0, 'C');
        $this->Cell(18, 4, formatText('Subtotal'), 'B', 1, 'C');
        $this->Ln(3);
        foreach ($documentItems as $documentItem) {
            //$length = strlen($product->product->name);
            $length = $this->GetStringWidth($documentItem->name);

            $this->SetFont('Arial', '', 7);
            $this->Cell(3, 4, number_format($documentItem->id), 0, 0, 'R');
            if ($length > 27) {
                $this->Multicell(50,4, formatText($documentItem->name),'J',1);
                $this->SetX(31);
                $this->Cell(9, 4, $documentItem->quantity, 0, 0, 'R');
            } else {
                $this->Cell(28, 4, formatText($documentItem->name), 0, 0, 'L');
                $this->Cell(9, 4, $documentItem->quantity, 0, 0, 'R');
            }
            $this->Cell(10, 4, number_format($documentItem->tax_subtotal), 0, 0, 'R');
            $this->Cell(18, 4, number_format($documentItem->subtotal + $documentItem->tax_subtotal), 0, 1, 'R');
        }
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(18);
        $this->Cell(20, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($totales,2), 0, 1, 'R');
        $this->Cell(0, 3, "", 'B', 1, 'C');
    }

    public function reportDocuments($documents, $name, $totales, $type)
    {
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText($name), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(10, 4, formatText('Doc'), 'B', 0, 'C');
        $this->Cell(38, 4, formatText('Proveedor'), 'B', 0, 'C');
        $this->Cell(20, 4, formatText('Valor.'), 'B', 0, 'C');
        $this->Ln(5);

        foreach ($documents as $document) {
            if ($type == 'doc') {
                $numberDocument = $document->document;
                $third = $document->third->name;
            } else if ($type == 'order') {
                $numberDocument = $document->id;
                $third = $document->third->name;
            } else if ($type == 'restOrder') {
                $numberDocument = $document->id;
                $table = $document->restaurant_table_id;
                if ($table == 1) {
                    $third = $document->customerHome->name;
                } else {
                    $third = $document->customer->name;
                }
            }
            //$length = strlen($product->product->name);
            $length = $this->GetStringWidth($third);

            $this->SetFont('Arial', '', 7);
            $this->Cell(10, 4, $numberDocument, 0, 0, 'L');
            if ($length > 37) {
                $this->Multicell(50,4, formatText($third),'L',1);
                $this->SetX(48);
                $this->Cell(20, 4, number_format($document->total_pay), 0, 1, 'R');
            } else {
                $this->Cell(38, 4, formatText($third), 0, 0, 'L');
                $this->Cell(20, 4, number_format($document->total_pay), 0, 1, 'R');
            }
        }
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(18);
        $this->Cell(20, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($totales), 0, 1, 'R');
        $this->Cell(0, 3, "", 'B', 1, 'C');
    }

    public function reportVouchers($documents, $name, $totales, $type)
    {
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText($name), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(10, 4, formatText('Doc'), 'B', 0, 'C');
        $this->Cell(38, 4, formatText('Proveedor'), 'B', 0, 'C');
        $this->Cell(20, 4, formatText('Valor.'), 'B', 0, 'C');
        $this->Ln(5);
        foreach ($documents as $document) {
            if ($type == 'comp') {
                $numberDocument = $document->payable->document;
                $third = $document->payable->third->name;
            }
            //$length = strlen($product->product->name);
            $length = $this->GetStringWidth($third);

            $this->SetFont('Arial', '', 7);
            $this->Cell(12, 4, $numberDocument, 0, 0, 'L');
            if ($length > 37) {
                $this->Multicell(50,4, formatText($third),'L',1);
                $this->SetX(48);
                $this->Cell(20, 4, number_format($document->pay), 0, 1, 'R');
            } else {
                $this->Cell(38, 4, formatText($third), 0, 0, 'L');
                $this->Cell(20, 4, number_format($document->pay), 0, 1, 'R');
            }
        }
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(18);
        $this->Cell(20, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($totales), 0, 1, 'R');
        $this->Cell(0, 3, "", 'B', 1, 'C');
    }

    public function reportMovementCash($documents, $name, $totales)
    {
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText($name), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(45, 4, formatText('Motivo'), 'B', 0, 'C');
        $this->Cell(22, 4, formatText('Valor.'), 'B', 0, 'C');
        $this->Ln(5);
        foreach ($documents as $document) {
            //$length = strlen($product->product->name);
            $length = $this->GetStringWidth($document->reason);

            $this->SetFont('Arial', '', 7);
            if ($length > 45) {
                $this->Multicell(60,4, formatText($document->reason),'L',1);
                $this->SetX(45);
                $this->Cell(22, 4, number_format($document->cash), 0, 1, 'R');
            } else {
                $this->Cell(45, 4, formatText($document->reason), 0, 0, 'L');
                $this->Cell(22, 4, number_format($document->cash), 0, 1, 'R');
            }
        }
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(18);
        $this->Cell(20, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($totales), 0, 1, 'R');
        $this->Cell(0, 3, "", 'B', 1, 'C');
    }

    public function reportAdvances($documents, $name, $totales)
    {
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText($name), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(45, 4, formatText('Tercero'), 'B', 0, 'C');
        $this->Cell(22, 4, formatText('Valor.'), 'B', 0, 'C');
        $this->Ln(5);
        foreach ($documents as $document) {
            //$length = strlen($product->product->name);
            $length = $this->GetStringWidth($document->advanceable->name);

            $this->SetFont('Arial', '', 7);
            if ($length > 45) {
                $this->Multicell(60,4, formatText($document->advanceable_name),'L',1);
                $this->SetX(45);
                $this->Cell(22, 4, number_format($document->cash), 0, 1, 'R');
            } else {
                $this->Cell(45, 4, formatText($document->advanceable_name), 0, 0, 'L');
                $this->Cell(22, 4, number_format($document->cash), 0, 1, 'R');
            }
        }
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(18);
        $this->Cell(20, 5, formatText("TOTAL"), 0, 0, 'R');
        $this->Cell(30, 5, "$" . number_format($totales), 0, 1, 'R');
        $this->Cell(0, 3, "", 'B', 1, 'C');
    }

    public function cashRegisterTitle()
    {
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText('REPORTES DE TOTALES'), 0, 1, 'C');
        $this->Ln(5);
    }

    public function reportTotals($cashRegister)
    {
        $this->SetFont('Arial', 'B', 8);
        if ($cashRegister->purchase > 0) {
            $this->Cell(44, 5, formatText("TOTAL COMPRAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->purchase), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->expense > 0) {
            $this->Cell(44, 5, formatText("TOTAL GASTOS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->expense), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->invoice > 0) {
            $this->Cell(44, 5, formatText("TOTAL VENTAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->invoice), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->remission > 0) {
            $this->Cell(44, 5, formatText("TOTAL REMISIONES"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->remission), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->purchase_order > 0) {
            $this->Cell(44, 5, formatText("TOTAL ORDEN DE COMPRA"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->purchase_order), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->invoice_order > 0) {
            $this->Cell(44, 5, formatText("TOTAL ORDEN DE VENTA"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->invoice_order), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->restaurant_order > 0) {
            $this->Cell(44, 5, formatText("TOTAL COMANDAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->restaurant_order), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->ncpurchase > 0) {
            $this->Cell(44, 5, formatText("TOTAL NC COMPRAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->ncpurchase), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->ndpurchase > 0) {
            $this->Cell(44, 5, formatText("TOTAL ND COMPRAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->ndpurchase), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->ncinvoice > 0) {
            $this->Cell(50, 5, formatText("TOTAL NC VENTAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->ncinvoice), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->ndinvoice > 0) {
            $this->Cell(44, 5, formatText("TOTAL ND VENTAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->ndinvoice), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->out_purchase > 0) {
            $this->Cell(44, 5, formatText("TOTAL EGRESOS COMPRAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->out_purchase), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->out_expense > 0) {
            $this->Cell(44, 5, formatText("TOTAL EGRESOS GASTOS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->out_expense), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->in_invoice > 0) {
            $this->Cell(44, 5, formatText("TOTAL INGRESOS VENTAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->in_invoice), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->in_remission > 0) {
            $this->Cell(44, 5, formatText("TOTAL INGRESOS REMISIONES"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->in_remission), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->out_total > 0) {
            $this->Cell(44, 5, formatText("TOTAL EGRESOS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->out_total), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->in_total > 0) {
            $this->Cell(44, 5, formatText("TOTAL INGRESOS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->in_total), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->cash_initial > 0) {
            $this->Cell(44, 5, formatText("EFECTIVO INICIAL"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->cash_initial), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->out_purchase_cash > 0) {
            $this->Cell(44, 5, formatText("SALIDA EFECTIVO COMPRAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->out_purchase_cash), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->out_expense_cash > 0) {
            $this->Cell(44, 5, formatText("SALIDA EFECTIVO GASTOS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->out_expense_cash), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->in_invoice_cash > 0) {
            $this->Cell(44, 5, formatText("ENTRADA EFECTIVO VENTAS"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->in_invoice_cash), 0, 1, 'R');
            $this->Ln(3);
        }
        if ($cashRegister->in_remission_cash > 0) {
            $this->Cell(44, 5, formatText("ENTRADA EFECTIVO REMISIONES"), 0, 0, 'R');
            $this->Cell(24, 5, "$" . number_format($cashRegister->in_remission_cash), 0, 1, 'R');
            $this->Ln(3);
        }
    }

    public function cashRegisterTitleTotals()
    {
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 6, formatText('REPORTE TOTAL FINAL'), 0, 1, 'C');
        $this->Ln(5);
    }

    public function reportTotalEnds($cashRegister)
    {

        $this->SetFont('Arial', 'B', 9);

        $this->Cell(44, 5, formatText("ENTRADAS DE EFECTIVO"), 0, 0, 'R');
        $this->Cell(24, 5, "$" . number_format($cashRegister->cash_in_total,2), 0, 1, 'R');
        $this->Ln(3);

        $this->Cell(44, 5, formatText("SALIDAS DE EFECTIVO"), 0, 0, 'R');
        $this->Cell(24, 5, "$" . number_format($cashRegister->cash_out_total,2), 0, 1, 'R');
        $this->Ln(3);

        $this->Cell(44, 5, formatText("SALDO EN CAJA"), 0, 0, 'R');
        $this->Cell(24, 5, "$" . number_format($cashRegister->cash_in_total - $cashRegister->cash_out_total ,2), 0, 1, 'R');
        $this->Ln(3);
    }

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

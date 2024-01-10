<?php

use App\Models\Advance;
use App\Models\Pay;
use App\Models\PaymentPaymentMethod;

if (! function_exists('payThirds')) {
    function payThirds($request, $document, $typeDocument, $payDocument, $payment_id, $cont)
    {
        $indicator = indicator();
        $cashRegister = cashregisterModel();
        //Variables del request
        $totalpay = $payDocument;
        //variables del request.
        $paymentMethod = $request->payment_method_id;
        $bank = $request->bank_id;
        $card = $request->card_id;
        $advance_id = $request->advance_id;
        $transaction = $request->transaction;
        $payment = $request->pay;
        $payAdvance = $request->payment;




        //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
        $pay = new Pay();
        $pay->pay = $totalpay;
        $pay->balance = $document->balance;
        $pay->type = $typeDocument;
        $pay->user_id = current_user()->id;
        $pay->branch_id = current_user()->branch_id;
        $pay->payment_id = $payment_id;

        switch($typeDocument) {
            case 'purchase':
                $purchase = $document;
                $purchase->pays()->save($pay);
            break;
            case 'expense':
                $expense = $document;
                $expense->pays()->save($pay);
            break;
            case 'invoice':
                $invoice = $document;
                $invoice->pays()->save($pay);
            break;
            default:
                $msg = 'No has seleccionado voucher.';
        }

        if ($cont == 0) {

            for ($i=0; $i < count($payment); $i++) {

                //Metodo que descuenta el valor del pago de un anticipo
                if ($payAdvance != 0) {

                    $advance = Advance::findOrFail( $request->advance_id);
                        //si el pago es utilizado en su totalidad agregar el destino aplicado
                        if ($advance->pay > $advance->balance) {
                            $advance->destination = $advance->destination . '<->' . $document->document;
                        } else {
                            $advance->destination = $document->document;
                        }
                        //variable si hay saldo en el pago anticipado
                        $payAdvance_total = $advance->balance - $payAdvance;
                        //cambiar el status del pago anticipado
                        if ($payAdvance_total == 0) {
                            $advance->status      = 'applied';
                        } else {
                            $advance->status      = 'partial';
                        }
                        //actualizar el saldo del pago anticipado
                        $advance->balance = $payAdvance_total;
                        $advance->update();
                }

                for ($i=0; $i < count($payment); $i++) {

                    //Metodo que descuenta el valor del pago de un anticipo
                    if ($payAdvance != 0) {

                        $advance = Advance::findOrFail( $request->advance_id);
                            //si el pago es utilizado en su totalidad agregar el destino aplicado
                            if ($advance->pay > $advance->balance) {
                                $advance->destination = $advance->destination . '<->' . $document->document;
                            } else {
                                $advance->destination = $document->document;
                            }
                            //variable si hay saldo en el pago anticipado
                            $payAdvance_total = $advance->balance - $payAdvance;
                            //cambiar el status del pago anticipado
                            if ($payAdvance_total == 0) {
                                $advance->status      = 'applied';
                            } else {
                                $advance->status      = 'partial';
                            }
                            //actualizar el saldo del pago anticipado
                            $advance->balance = $payAdvance_total;
                            $advance->update();
                    }

                    //Metodo para registrar la relacion entre pago y metodo de pago
                    $payment_paymentMethod = new PaymentPaymentMethod();
                    $payment_paymentMethod->payment_id = $payment_id;
                    $payment_paymentMethod->payment_method_id = $paymentMethod[$i];
                    $payment_paymentMethod->bank_id = $bank[$i];
                    $payment_paymentMethod->card_id = $card[$i];
                    if (isset($advance_id[$i])){
                        $payment_paymentMethod->advance_id = $advance_id[$i];
                    }
                    $payment_paymentMethod->pay = $payment[$i];
                    $payment_paymentMethod->transaction = $transaction[$i];
                    $payment_paymentMethod->save();

                    $mp = $paymentMethod[$i];
                    switch($typeDocument) {
                        case 'purchase':
                            if ($indicator->pos == 'on') {
                                //metodo para actualizar la caja
                                if($mp == 10){
                                    $cashRegister->out_purchase_cash += $payment[$i];
                                    $cashRegister->cash_out_total += $payment[$i];
                                }
                                $cashRegister->out_purchase += $payment[$i];
                                $cashRegister->out_total += $payment[$i];
                                $cashRegister->update();
                            }
                        break;
                        case 'expense':
                            if ($indicator->pos == 'on') {
                                //metodo para actualizar la caja
                                if($mp == 10){
                                    $cashRegister->out_expense_cash += $payment[$i];
                                    $cashRegister->cash_out_total += $payment[$i];
                                }
                                $cashRegister->out_expense += $payment[$i];
                                $cashRegister->out_total += $payment[$i];
                                $cashRegister->update();
                            }
                        break;
                        case 'invoice':
                            if ($indicator->pos == 'on') {
                                //metodo para actualizar la caja
                                if($mp == 10){
                                    $cashRegister->in_invoice_cash += $payment[$i];
                                    $cashRegister->cash_in_total += $payment[$i];
                                }
                                $cashRegister->in_invoice += $payment[$i];
                                $cashRegister->in_total += $payment[$i];
                                $cashRegister->update();
                            }
                        break;
                        default:
                            $msg = 'No has seleccionado voucher.';
                    }

                }
            }
        }
    }
}

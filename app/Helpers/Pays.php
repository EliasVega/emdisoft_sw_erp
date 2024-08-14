<?php

use App\Models\Advance;
use App\Models\Pay;
use App\Models\PayPaymentMethod;

if (! function_exists('pays')) {
    function pays($request, $document, $typeDocument)
    {
        //dd($request->all());
        $advanceRequest = $request->advance_id;
        if (isset($advanceRequest)) {
            $adv = explode("_", $advanceRequest);
            $advance = Advance::where('id', $adv[0])->first();
            $advance_id = $advance->id;
        }

        $indicator = indicator();
        $cashRegister = cashregisterModel();
        //Variables del request
        $total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
        //variables del request
        $paymentMethod = $request->payment_method_id;
        $bank = $request->bank_id;
        $card = $request->card_id;
        $payment = $request->pay;
        $transaction = $request->transaction;
        $payAdvance = $request->payment;

        if ($typeDocument == 'invoice') {
            $totalpay = $request->totalpay;
        } elseif ($typeDocument == 'pos') {
            $payment = $request->pay;
            if ($payment[0] >= $total_pay) {
                $totalpay = $total_pay;
            } else {
                $totalpay = $payment[0];
            }
        } else {
            $payment = $request->pay;
        }
        //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
        $pay = new Pay();
        $pay->user_id = current_user()->id;
        $pay->branch_id = current_user()->branch_id;
        $pay->pay = $totalpay;
        $pay->balance = $document->balance;
        switch($typeDocument) {
            case 'purchase':
                $pay->type = $typeDocument;
                $document->pays()->save($pay);
            break;
            case 'expense':
                $pay->type = $typeDocument;
                $document->pays()->save($pay);
            break;
            case 'invoice':
                $pay->type = $typeDocument;
                $document->pays()->save($pay);
            break;
            case 'pos':
                $pay->type = 'invoice';
                $document->pays()->save($pay);
            break;
            case 'remission':
                $pay->type = $typeDocument;
                $remission = $document;
                $remission->pays()->save($pay);
            break;
            case 'remissionPos':
                $pay->type = 'remission';
                $document->pays()->save($pay);
            break;
            default:
                $msg = 'No has seleccionado voucher.';
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
            $pay_paymentMethod = new PayPaymentMethod();
            $pay_paymentMethod->pay_id = $pay->id;
            $pay_paymentMethod->payment_method_id = $paymentMethod[$i];

            if ($typeDocument == 'pos' || $typeDocument == 'remissionPos') {
                $pay_paymentMethod->bank_id = 1;
                $pay_paymentMethod->card_id = 1;
                $pay_paymentMethod->transaction = 1;
            } else {
                $pay_paymentMethod->bank_id = $bank[$i];
                $pay_paymentMethod->card_id = $card[$i];
                $pay_paymentMethod->transaction = $transaction[$i];
            }
            if (isset($advance_id[$i])){
                $pay_paymentMethod->advance_id = $advance_id[$i];
            }
            $pay_paymentMethod->pay = $payment[$i];

            $pay_paymentMethod->save();

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
                case 'remission':
                    if ($indicator->pos == 'on') {
                        //metodo para actualizar la caja
                        if($mp == 10){
                            $cashRegister->in_remission_cash += $payment[$i];
                            $cashRegister->cash_in_total += $payment[$i];
                        }
                        $cashRegister->in_remission += $payment[$i];
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

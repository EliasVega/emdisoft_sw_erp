<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Advance;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Pay;
use App\Models\PaymentPaymentMethod;
use App\Models\Provider;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:payment.index|payment.create|payment.show|payment.edit|payment.destroy', ['only'=>['index']]);
        $this->middleware('permission:payment.create', ['only'=>['create','store']]);
        $this->middleware('permission:payment.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin'||$user == 'admin') {
                //Consulta para mostrar todas las pagos a admin y superadmin
                $payments = Payment::get();
            } else {
                //Consulta para mostrar pagos de los demas roles
                $payments = Payment::where('user_id', $users->id)->get();
            }
            return DataTables::of($payments)
            ->addIndexColumn()
            ->addColumn('third', function (Payment $payment) {
                return $payment->paymentable->name;
            })
            ->addColumn('identification', function (Payment $payment) {
                return $payment->paymentable->identification;
            })
            ->addColumn('branch', function (Payment $payment) {
                return $payment->user->branch->name;
            })
            ->addColumn('user', function (Payment $payment) {
                return $payment->user->name;
            })
            ->addColumn('type_third', function (Payment $payment) {
                if ($payment->type_third == 'customer') {
                    return $payment->type_third == 'customer' ? 'Cliente' : 'Cliente';
                } elseif ($payment->type_third == 'provider') {
                    return $payment->type_third == 'provider' ? 'Proveedor' : 'Proveedor';
                }
            })
            ->editColumn('created_at', function(Payment $payment){
                return $payment->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/payment/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {

        //dd($request->all());
        $third_id = $request->third_id;
        $totalPay = $request->totalpay;
        $typeThird = $request->type_third;
        $documents = '';
        $payPartial = $request->totalpay;
        $payDocument = 0;
        $typeDocument = $request->type_document;
        $document = '';
        $payment = new Payment();
        $payment->pay = $totalPay;
        $payment->note = $request->note;
        $payment->type_third = $typeThird;
        $payment->user_id = current_user()->id;



        switch($typeDocument) {
            case 'invoice':
                $customer = Customer::findOrFail($third_id);
                $customer->payments()->save($payment);
                $documents = Invoice::where('customer_id', $customer->id)->where('balance', '>', 0)->get();
            break;
            case 'purchase':
                $provider = Provider::findOrFail($third_id);
                $provider->payments()->save($payment);
                $documents = Purchase::where('provider_id', $provider->id)->where('balance', '>', 0)->get();
            break;
            case 'expense':
                $provider = Provider::findOrFail($third_id);
                $provider->payments()->save($payment);
                $documents = Expense::where('provider_id', $provider->id)->where('balance', '>', 0)->get();
            break;
            default:
                $msg = 'No has seleccionado voucher.';
        }
        $payment_id = $payment->id;
        $cont = 0;
        foreach ($documents as $key => $document) {

            if ($payPartial > 0) {
                $voucher = $document->voucher_type_id;
                $documentBalance = $document->balance;
                $payResult = $payPartial - $documentBalance;
                if ($payResult >= 0) {

                    $payPartial -= $documentBalance;
                    $payDocument = $documentBalance;

                    if ($typeDocument == 'invoice') {
                        switch($voucher) {
                            case(1):
                                $invoice = Invoice::findOrFail($document->id);
                                $invoice->balance = 0;
                                $invoice->pay += $documentBalance;
                                $invoice->update();
                                $document = $invoice;
                            break;
                            case(2):
                                $invoice = Invoice::findOrFail($document->id);
                                $invoice->balance = 0;
                                $invoice->pay += $documentBalance;
                                $invoice->update();
                                $document = $invoice;
                            break;
                            default:
                                $msg = 'No has seleccionado voucher.';
                        }
                    } else {
                        switch($voucher) {
                            case(1):
                                $purchase = Purchase::findOrFail($document->id);
                                $purchase->balance = 0;
                                $purchase->pay += $documentBalance;
                                $purchase->update();
                                $document = $purchase;
                            break;
                            case(2):
                                $purchase = Purchase::findOrFail($document->id);
                                $purchase->balance = 0;
                                $purchase->pay += $documentBalance;
                                $purchase->update();
                                $document = $purchase;
                            break;
                            default:
                                $msg = 'No has seleccionado voucher.';
                        }
                    }
                    //payThirds($request, $document, $typeDocument, $payDocument, $payment_id, $cont);
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



                } else {
                    $payDocument = $payPartial;
                    if ($typeDocument == 'invoice') {
                        switch($voucher) {
                            case(1):
                                $invoice = Invoice::findOrFail($document->id);
                                $invoice->balance -= $payPartial;
                                $invoice->pay += $payPartial;
                                $invoice->update();
                                $document = $invoice;
                            break;
                            case(2):
                                $invoice = Invoice::findOrFail($document->id);
                                $invoice->balance -= $payPartial;
                                $invoice->pay += $payPartial;
                                $invoice->update();
                                $document = $invoice;
                            break;
                            default:
                                $msg = 'No has seleccionado voucher.';
                        }
                    } else {
                        switch($voucher) {
                            case(1):
                                $purchase = Purchase::findOrFail($document->id);
                                $purchase->balance -= $payPartial;
                                $purchase->pay += $payPartial;
                                $purchase->update();
                                $document = $purchase;
                            break;
                            case(2):
                                $purchase = Purchase::findOrFail($document->id);
                                $purchase->balance -= $payPartial;
                                $purchase->pay += $payPartial;
                                $purchase->update();
                                $document = $purchase;
                            break;
                            default:
                                $msg = 'No has seleccionado voucher.';
                        }
                    }
                    payThirds($request, $document, $typeDocument, $payDocument, $payment_id, $cont);
                }
            }
            $cont++;
        }

            Alert::success('Pago','Realizado Satisfactoriamente.');
        return redirect('payment');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $paymentPaymentMethods = PaymentPaymentMethod::where('payment_id', $payment->id)->get();
        return view('admin.payment.show', compact('payment', 'paymentPaymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function paymentPdf(Request $request, $id)
    {
        $indicator = indicator();
        $payment = Payment::findOrFail($id);
        $paymentPaymentMethods = PaymentPaymentMethod::where('payment_id', $id)->get();
        $company = Company::findOrFail(1);
        $users = current_user();

        $payPdf = "PAGO-". $payment->id;
        $view = \view('admin.payment.pdf', compact('payment', 'paymentPaymentMethods', 'company', 'users', 'indicator'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$payPdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }
}

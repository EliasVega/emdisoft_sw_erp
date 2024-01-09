<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Provider;
use App\Models\Purchase;
use Illuminate\Http\Request;
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
                    payThirds($request, $document, $typeDocument, $payDocument, $payment_id, $cont);

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
        //
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
}

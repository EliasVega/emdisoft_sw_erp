<?php

namespace App\Http\Controllers;

use App\Models\pay;
use App\Http\Requests\StorepayRequest;
use App\Http\Requests\UpdatepayRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Expense;
use App\Models\PaymentMethod;
use App\Models\PayPaymentMethod;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PayController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pay.index|pay.create|pay.show|pay.edit|pay.destroy', ['only'=>['index']]);
        $this->middleware('permission:pay.create', ['only'=>['create','store']]);
        $this->middleware('permission:pay.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las pagos a admin y superadmin
                $pays = pay::get();
            } else {
                //Consulta para mostrar pagos de los demas roles
                $pays = pay::where('user_id', $user->id)->get();
            }
            return DataTables::of($pays)
            ->addIndexColumn()
            ->addColumn('document', function (Pay $pay) {
                return $pay->payable->document;
            })
            ->addColumn('type', function (Pay $pay) {
                return $pay->type;
            })
            ->addColumn('third', function (Pay $pay) {
                if ($pay->type == 'purchase') {
                    $third = $pay->payable->third->name;
                } elseif ($pay->type == 'advance') {
                    $third = $pay->payable->advanceable->name;
                } elseif ($pay->type == 'expense') {
                    $third = $pay->payable->third->name;
                }

                return $third;
            })
            ->addColumn('branch', function (Pay $pay) {
                return $pay->branch->name;
            })
            ->addColumn('user', function (Pay $pay) {
                return $pay->user->name;
            })
            ->addColumn('total_pay', function (Pay $pay) {
                return $pay->payable->total_pay;
            })
            ->editColumn('created_at', function(Pay $pay){
                return $pay->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/pay/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.pay.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $purchase = Purchase::where('id', '=', $request->session()->get('purchase'))->first();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $purchase->provider->id)->get();

        return view('admin.pay.create', compact(
            'banks',
            'paymentMethods',
            'cards',
            'purchase',
            'advances'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepayRequest $request)
    {
        try{
            DB::beginTransaction();
            //variables necesarias
            $purchase = '';
            $balance = '';
            $totalPay = $request->total;
            $document_id = $request->document_id;

            //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
            $pay = new pay();
            $pay->user_id    = Auth::user()->id;
            $pay->branch_id  = Auth::user()->branch_id;
            $pay->pay        = $totalPay;
            switch($request->voucher) {
                case(7):
                    $purchase = Purchase::findOrFail($document_id);
                    $balance = $purchase->balance;
                    $pay->balance = $balance - $totalPay;
                    $pay->type = 'purchase';
                    $purchase->pays()->save($pay);

                    $purchase->pay += $totalPay;
                    $purchase->balance -= $totalPay;
                    $purchase->grand_total -= $totalPay;
                    $purchase->update();
                break;
                case(20):
                    $expense = Expense::findOrFail($document_id);
                    $balance = $expense->balance;
                    $pay->balance = $balance - $totalPay;
                    $pay->type = 'expense';
                    $expense->pays()->save($pay);

                    $expense->pay += $totalPay;
                    $expense->balance -= $totalPay;
                    $expense->update();
                break;
                default:
                    $msg = 'No has seleccionado voucher.';
            }

            $cont = 0;
            //variables del request
            $paymentMethod = $request->payment_method_id;
            $bank = $request->bank_id;
            $card = $request->card_id;
            $advance_id = $request->advance_id;
            $payment = $request->pay;
            $transaction = $request->transaction;
            $payAdvance = $request->payment;



            //Metodo que descuenta el valor del pago de un anticipo
            if ($payAdvance != 0) {

                $advance = Advance::findOrFail( $request->advance_id);
                    //si el pago es utilizado en su totalidad agregar el destino aplicado
                    if ($advance->pay > $advance->balance) {
                        $advance->destination = $advance->destination . '<->' . $purchase->document;
                    } else {
                        $advance->destination = $purchase->document;
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
                /*
                $sale_box = Sale_box::where('user_id', '=', $pay_expense->user_id)->where('status', '=', 'open')->first();
                $sale_box->out_payment += $payu;
                $sale_box->update();*/
            }

            //Metodo de control para la iteracion con las formas de pago
            while($cont < count($paymentMethod)){
                $paymentLine = $request->pay[$cont];

                //Metodo para registrar la relacion entre pago y metodo de pago
                $pay_paymentMethod = new PayPaymentMethod();
                $pay_paymentMethod->pay_id = $pay->id;
                $pay_paymentMethod->payment_method_id = $paymentMethod[$cont];
                $pay_paymentMethod->bank_id = $bank[$cont];
                $pay_paymentMethod->card_id = $card[$cont];
                if (isset($advance_id[$cont])){
                    $pay_paymentMethod->advance_id = $advance_id[$cont];
                }
                $pay_paymentMethod->pay = $payment[$cont];
                $pay_paymentMethod->transaction = $transaction[$cont];
                $pay_paymentMethod->save();

                $mp = $paymentMethod[$cont];

                $cashRegister = CashRegister::where('user_id', $pay->user_id)
                ->where('status', '=', 'open')
                ->first();
                if (isset($cashRegister)) {
                    if($mp == 10){
                        $cashRegister->out_purchase_cash += $paymentLine;
                        $cashRegister->cash_out_total += $paymentLine;
                    }
                    if ($pay->type == 'purchase') {
                        $cashRegister->out_purchase += $paymentLine;
                    } elseif ($pay->type == 'expense') {
                        $cashRegister->out_expense += $paymentLine;
                    }
                    $cashRegister->out_total += $paymentLine;
                    $cashRegister->update();
                }
                $cont++;
            }

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        Alert::success('Pago','Realizado Satisfactoriamente.');
        return redirect('pay');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(pay $pay)
    {
        $payPaymentMethods = PayPaymentMethod::where('pay_id', $pay->id)->get();
        return view('admin.pay.show', compact('pay', 'payPaymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function edit(pay $pay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepayRequest  $request
     * @param  \App\Models\pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepayRequest $request, pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function destroy(pay $pay)
    {
        //
    }

    public function payPdf(Request $request, $id)
   {
       $pay = pay::findOrFail($id);
       $payPaymentMethods = PayPaymentMethod::where('pay_id', $id)->get();
       $company = Company::findOrFail(1);
       $users = Auth::user();

       $payPdf = "PAGO-". $pay->id;
       $logo = './imagenes/logos'.$company->logo;
       $view = \view('admin.pay.pdf', compact('pay', 'payPaymentMethods', 'company', 'logo', 'users'));
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       //$pdf->setPaper ( 'A7' , 'landscape' );

       return $pdf->stream('vista-pdf', "$payPdf.pdf");
       //return $pdf->download("$purchasepdf.pdf");*/
   }
}

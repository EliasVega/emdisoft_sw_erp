<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Http\Requests\StoreAdvanceRequest;
use App\Http\Requests\UpdateAdvanceRequest;
use App\Models\Bank;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Indicator;
use App\Models\pay;
use App\Models\PaymentMethod;
use App\Models\PayPaymentMethod;
use App\Models\Provider;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdvanceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:advance.index|advance.create|advance.show', ['only'=>['index']]);
        $this->middleware('permission:advance.create', ['only'=>['create','store']]);
        $this->middleware('permission:advance.show', ['only'=>['show']]);
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
                //Consulta para mostrar Anticipos a admin y superadmin
                $advances = Advance::get();
            } else {
                //Consulta para mostrar Anticipos de los demas roles
                $advances = Advance::where('user_id', $user->id)->get();
            }
            return DataTables::of($advances)
            ->addIndexColumn()
            ->addColumn('pay', function (Advance $advance) {
                return number_format($advance->pay, 2);
            })
            ->addColumn('balance', function (Advance $advance) {
                return number_format($advance->balance, 2);
            })
            ->addColumn('third', function (Advance $advance) {
                return $advance->advanceable->name;
            })
            ->addColumn('branch', function (Advance $advance) {
                return $advance->branch->name;
            })
            ->addColumn('user', function (Advance $advance) {
                return $advance->user->name;
            })
            ->addColumn('type_third', function (Advance $advance) {
                if ($advance->type_third == 'customer') {
                    return 'Cliente';
                } elseif ($advance->type_third == 'provider') {
                    return 'Proveedor';
                } else {
                    return 'Empleado';
                }
            })
            ->editColumn('created_at', function(Advance $advance){
                return $advance->created_at->format('yy-m-d: h:m');
            })

            ->addColumn('btn', 'admin/advance/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.advance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $cards = Card::get();
        $customers = Customer::get();
        $providers = Provider::get();
        $employees = Employee::get();
        $advances = Advance::get();

        return view('admin.advance.create', compact(
            'banks',
            'paymentMethods',
            'cards',
            'customers',
            'providers',
            'employees',
            'advances',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdvanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvanceRequest $request)
    {

        $indicator = Indicator::findOrFail(1);
        //Llamando de variables del request
        $cont = 0;
        $paymentMethod = $request->payment_method_id;
        $bank = $request->bank_id;
        $card = $request->card_id;
        $payment = $request->pay;
        $transaction = $request->transaction;
        $total = $request->total;

        $voucherTypes = VoucherType::findOrFail(18);

        //Metodo para crear un nuevo advance
        $advance = new Advance();
        $advance->user_id = Auth::user()->id;
        $advance->branch_id = Auth::user()->branch_id;
        $advance->voucher_type_id = 18;
        $advance->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
        $advance->origin = 'Medio de pago';
        $advance->destination = null;
        $advance->pay = $total;
        $advance->balance = $total;
        $advance->note = $request->note;
        $advance->status = 'pending';
        //Metodo para crear la relacion polimorfica segun el tipi de tercero
        switch($request->third) {
            case('1'):
                $customer = Customer::findOrFail($request->customer_id);
                $advance->type_third = 'customer';
                $customer->advances()->save($advance);
                break;
            case('2'):
                $provider = Provider::findOrFail($request->provider_id);
                $advance->type_third = 'provider';
                $provider->advances()->save($advance);
                break;
            case('3'):
                $employee = Employee::findOrFail($request->employee_id);
                $advance->type_third = 'employee';
                $employee->advances()->save($advance);
                break;
            default:
                $msg = 'No has seleccionado tercero.';
        }

        //Metodo para crear un nuevo pago y su relacion polimorfica con el tipo de documento
        $pay = new pay();
        $pay->user_id    = Auth::user()->id;
        $pay->branch_id  = Auth::user()->branch_id;
        $pay->pay        = $total;
        $pay->balance = $total;
        $pay->type = 'advance';
        $advance->pays()->save($pay);
        //Metodo de control
        while($cont < count($payment)){
            $paymentLine = $payment[$cont];
            //metodo para crear la tabla intermedia entre pagos y metodos de pago
            $pay_paymentMethod = new PayPaymentMethod();
            $pay_paymentMethod->pay_id = $pay->id;
            $pay_paymentMethod->payment_method_id = $paymentMethod[$cont];
            $pay_paymentMethod->bank_id = $bank[$cont];
            $pay_paymentMethod->card_id = $card[$cont];
            if (isset($advance_id[$cont])){
                $pay_paymentMethod->advance_id = $request->advance_id[$cont];
            }
            $pay_paymentMethod->pay = $payment[$cont];
            $pay_paymentMethod->transaction = $transaction[$cont];
            $pay_paymentMethod->save();

            $mp = $paymentMethod[$cont];

            if ($indicator->pos == 'on') {

                $cashRegister = CashRegister::where('user_id', '=', Auth::user()->id)
                ->where('status', '=', 'open')
                ->first();

                if ($advance->type_third == 'customer') {
                    if($mp == 10){
                        $cashRegister->in_advance_cash += $paymentLine;
                        $cashRegister->cash_in_total += $paymentLine;
                    }
                    $cashRegister->in_advance += $paymentLine;
                    $cashRegister->in_total += $paymentLine;
                    $cashRegister->update();
                } else {
                    if($mp == 10){
                        $cashRegister->out_advance_cash += $paymentLine;
                        $cashRegister->cash_out_total += $paymentLine;
                    }
                    $cashRegister->out_advance += $paymentLine;
                    $cashRegister->out_total += $paymentLine;
                    $cashRegister->update();
                }
            }
            $cont++;
        }

        return redirect('advance');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        $advance = Advance::where('id', $advance->id)->first();
        $pay = Pay::where('type', 'advance')->where('payable_id', $advance->id)->first();
        //$payPaymentMethods = PayPaymentMethod::where('pay_id', $pay->id)->get();

        if ($pay) {
            $payPaymentMethods = PayPaymentMethod::where('pay_id', $pay->id)->get();
        } else {
            $payPaymentMethods = null;
        }


        return view('admin.advance.show', compact('advance', 'payPaymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvanceRequest  $request
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvanceRequest $request, Advance $advance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        //
    }

    public function advancePdf(Request $request, $id)
    {
        $advance = Advance::where('id', $id)->first();
        $company = Company::where('id', 1)->first();
        $user = auth::user();
        $pay = Pay::where('type', 'advance')->where('payable_id', $advance->id)->first();
        if ($pay) {
            $payPaymentMethods = PayPaymentMethod::where('pay_id', $pay->id)->get();
        } else {
            $payPaymentMethods = null;
        }
        //$payPaymentMethods = PayPaymentMethod::where('pay_id', $pay->id)->get();
        $advancepdf = "ADV-". $advance->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.advance.pdf', compact('payPaymentMethods', 'company', 'logo', 'advance', 'user'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$advancepdf.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }
}

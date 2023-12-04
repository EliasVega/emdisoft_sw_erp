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
use App\Models\Invoice;
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
                } elseif ($pay->type == 'invoice') {
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
        //dd($request->all());
        $document_id = $request->document_id;
        $voucher = $request->voucher;
        $totalpay = $request->totalpay;
        $document = '';
        switch($voucher) {
            case(7):
                $purchase = Purchase::findOrFail($document_id);
                $typeDocument = 'purchase';
                $document = $purchase;
                $purchase->balance -= $totalpay;
                $purchase->pay += $totalpay;
                $purchase->update();
            break;
            case(12):
                $purchase = Purchase::findOrFail($document_id);
                $typeDocument = 'purchase';
                $document = $purchase;
                $purchase->balance -= $totalpay;
                $purchase->pay += $totalpay;
                $purchase->update();
            break;
            case(20):
                $expense = Expense::findOrFail($document_id);
                $typeDocument = 'expense';
                $document = $expense;
                $expense->balance -= $totalpay;
                $expense->pay += $totalpay;
                $expense->update();
            break;
            case(1):
                $invoice = Invoice::findOrFail($document_id);
                $typeDocument = 'invoice';
                $document = $invoice;
                $invoice->balance -= $totalpay;
                $invoice->pay += $totalpay;
                $invoice->update();
            break;
            case(2):
                $invoice = Invoice::findOrFail($document_id);
                $typeDocument = 'invoice';
                $document = $invoice;
                $invoice->balance -= $totalpay;
                $invoice->pay += $totalpay;
                $invoice->update();
            break;
            default:
                $msg = 'No has seleccionado voucher.';
        }

        pays($request, $document, $typeDocument);

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

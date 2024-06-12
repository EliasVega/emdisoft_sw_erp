<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Http\Requests\StorePayRequest;
use App\Http\Requests\UpdatePayRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Card;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use App\Models\PayPaymentMethod;
use App\Models\Purchase;
use App\Models\Remission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin'||$user == 'admin') {
                //Consulta para mostrar todas las pagos a admin y superadmin
                $pays = Pay::get();
            } else {
                //Consulta para mostrar pagos de los demas roles
                $pays = Pay::where('user_id', $users->id)->get();
            }
            return DataTables::of($pays)
            ->addIndexColumn()
            ->addColumn('document', function (Pay $pay) {
                return $pay->payable->document;
            })
            ->addColumn('type', function (Pay $pay) {
                if ($pay->type == 'purchase') {
                    $type = 'Compra';
                } elseif ($pay->type == 'advance') {
                    $type = 'Anticipo';
                } elseif ($pay->type == 'expense') {
                    $type = 'Gasto';
                } elseif ($pay->type == 'invoice') {
                    $type = 'Venta';
                } elseif ($pay->type == 'work_labor') {
                    $type = 'Obra_labor';
                } elseif ($pay->type == 'remission') {
                    $type = 'Remision';
                }
                return $type;
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
                } elseif ($pay->type == 'remission') {
                    $third = $pay->payable->third->name;
                } elseif ($pay->type == 'work_labor') {
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
                return $pay->created_at->format('Y-m-d: h:m');
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
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
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
     * @param  \App\Http\Requests\StorePayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayRequest $request)
    {
        //dd($request->all());
        $document_id = $request->document_id;
        $voucher = $request->voucher;
        $totalpay = $request->totalpay;
        $document = '';
        $typeDocument = '';
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
            case(25):
                $remission = Remission::findOrFail($document_id);
                $typeDocument = 'remission';
                $document = $remission;
                $remission->balance -= $totalpay;
                $remission->pay += $totalpay;
                $remission->update();
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
     * @param  \App\Http\Requests\UpdatePayRequest  $request
     * @param  \App\Models\pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayRequest $request, pay $pay)
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
        $pay = Pay::findOrFail($id);
        $payPaymentMethods = PayPaymentMethod::where('pay_id', $id)->get();
        $company = Company::findOrFail(1);
        $indicator = indicator();
        $users = Auth::user();

        $payPdf = "PAGO-". $pay->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.pay.pdf', compact('pay', 'payPaymentMethods', 'company', 'logo', 'users', 'indicator'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$payPdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }

    public function payPos($id)
    {
        $pay = Pay::findOrFail($id);
        $payPaymentMethods = PayPaymentMethod::where('pay_id', $id)->get();
        $company = Company::where('id', 1)->first();
        $indicator = indicator();
        $payPos = "Comision-". $pay->id;
        $view = \view('admin.pay.pos', compact(
            'pay',
            'payPaymentMethods',
            'company',
            'indicator'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,1246.64), 'portrait');

        return $pdf->stream('vista-pdf', "$payPos.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }
}

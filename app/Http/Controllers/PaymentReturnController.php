<?php

namespace App\Http\Controllers;

use App\Models\PaymentReturn;
use App\Http\Requests\StorePaymentReturnRequest;
use App\Http\Requests\UpdatePaymentReturnRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentReturnController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:paymentReturn.index', ['only'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentReturns = PaymentReturn::get();

            return DataTables::of($paymentReturns)
            ->addIndexColumn()
            ->addColumn('invoice', function (PaymentReturn $paymentReturn) {
                return $paymentReturn->invoice->document;
            })
            ->addColumn('customer', function (PaymentReturn $paymentReturn) {
                return $paymentReturn->invoice->third->name;
            })
            ->editColumn('created_at', function(PaymentReturn $paymentReturn){
                return $paymentReturn->created_at->format('yy-m-d: h:m');
            })
            ->make(true);
        }

        return view('admin.paymentReturn.index');
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
    public function store(StorePaymentReturnRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentReturn $payment_return)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentReturn $payment_return)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentReturnRequest $request, PaymentReturn $payment_return)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentReturn $payment_return)
    {
        //
    }
}

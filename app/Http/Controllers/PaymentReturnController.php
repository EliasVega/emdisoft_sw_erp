<?php

namespace App\Http\Controllers;

use App\Models\paymentReturn;
use App\Http\Requests\StorepaymentReturnRequest;
use App\Http\Requests\UpdatepaymentReturnRequest;
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
            $paymentReturns = paymentReturn::get();

            return DataTables::of($paymentReturns)
            ->addIndexColumn()
            ->addColumn('invoice', function (paymentReturn $paymentReturn) {
                return $paymentReturn->invoice->document;
            })
            ->addColumn('customer', function (paymentReturn $paymentReturn) {
                return $paymentReturn->invoice->third->name;
            })
            ->editColumn('created_at', function(paymentReturn $paymentReturn){
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
    public function store(StorepaymentReturnRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(paymentReturn $payment_return)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paymentReturn $payment_return)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaymentReturnRequest $request, paymentReturn $payment_return)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paymentReturn $payment_return)
    {
        //
    }
}

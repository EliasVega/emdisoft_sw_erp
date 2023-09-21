<?php

namespace App\Http\Controllers;

use App\Models\PaymentFrecuency;
use App\Http\Requests\StorePaymentFrecuencyRequest;
use App\Http\Requests\UpdatePaymentFrecuencyRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentFrecuencyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paymentFrecuency.index|paymentFrecuency.create|paymentFrecuency.show|paymentFrecuency.edit|paymentFrecuency.destroy', ['only'=>['index']]);
        $this->middleware('permission:paymentFrecuency.create', ['only'=>['create','store']]);
        $this->middleware('permission:paymentFrecuency.show', ['only'=>['show']]);
        $this->middleware('permission:paymentFrecuency.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:paymentFrecuency.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentFrecuencies = PaymentFrecuency::get();

            return DataTables::of($paymentFrecuencies)
            ->addColumn('edit', 'admin/paymentFrecuency/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.paymentFrecuency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentFrecuency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentFrecuencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentFrecuencyRequest $request)
    {
        $paymentFrecuency = new PaymentFrecuency();
        $paymentFrecuency->code = $request->code;
        $paymentFrecuency->name = $request->name;
        $paymentFrecuency->save();

        return redirect('paymentFrecuency');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentFrecuency  $paymentFrecuency
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentFrecuency $paymentFrecuency)
    {
        return view("admin.paymentFrecuency.show", compact('paymentFrecuency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentFrecuency  $paymentFrecuency
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentFrecuency $paymentFrecuency)
    {
        return view("admin.paymentFrecuency.edit", compact('paymentFrecuency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentFrecuencyRequest  $request
     * @param  \App\Models\PaymentFrecuency  $paymentFrecuency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentFrecuencyRequest $request, PaymentFrecuency $paymentFrecuency)
    {
        $paymentFrecuency->code = $request->code;
        $paymentFrecuency->name = $request->name;
        $paymentFrecuency->update();

        return redirect('paymentFrecuency');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentFrecuency  $paymentFrecuency
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentFrecuency $paymentFrecuency)
    {
        $paymentFrecuency->delete();
        toast('Frecuencia de pago eliminada con éxito.','success');
        return redirect('paymentFrecuency');
    }
}

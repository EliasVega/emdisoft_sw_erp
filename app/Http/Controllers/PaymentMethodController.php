<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paymentMethod.index|paymentMethod.create|paymentMethod.show|paymentMethod.edit|paymentMethod.destroy|paymentMethod.paymentmethodStatus', ['only'=>['index']]);
        $this->middleware('permission:paymentMethod.create', ['only'=>['create','store']]);
        $this->middleware('permission:paymentMethod.show', ['only'=>['show']]);
        $this->middleware('permission:paymentMethod.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:paymentMethod.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:paymentMethod.paymentMethodStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentMethods = PaymentMethod::get();

            return DataTables::of($paymentMethods)
            ->addColumn('edit', 'admin/paymentMethod/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.paymentMethod.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentMethod.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $paymentMethod = new PaymentMethod();
        $paymentMethod->code = $request->code;
        $paymentMethod->name = $request->name;
        $paymentMethod->status = $request->status;
        $paymentMethod->save();
        return redirect('paymentMethod');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return view('admin.paymentMethod.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.paymentMethod.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentMethodRequest  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->code = $request->code;
        $paymentMethod->name = $request->name;
        $paymentMethod->status = $request->status;
        $paymentMethod->update();
        return redirect('paymentMethod');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        toast('Metodo de pago eliminado con éxito.','success');
        return redirect('paymentMethod');
    }

    public function status($id)
    {

        $paymentMethod = PaymentMethod::findOrFail($id);
        if ($paymentMethod->status == 'active') {
            $paymentMethod->status = 'inactive';
        } else {
            $paymentMethod->status = 'active';
        }
        $paymentMethod->update();

        return redirect('paymentMethod');
    }
}

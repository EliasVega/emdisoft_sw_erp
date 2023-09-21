<?php

namespace App\Http\Controllers;

use App\Models\PaymentForm;
use App\Http\Requests\StorePaymentFormRequest;
use App\Http\Requests\UpdatePaymentFormRequest;
use Illuminate\Http\Request;

class PaymentFormController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paymentForm.index|paymentForm.create|paymentForm.show|paymentForm.edit|paymentForm.destroy', ['only'=>['index']]);
        $this->middleware('permission:paymentForm.create', ['only'=>['create','store']]);
        $this->middleware('permission:paymentForm.show', ['only'=>['show']]);
        $this->middleware('permission:paymentForm.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:paymentForm.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentForms = PaymentForm::get();

            return datatables()
            ->of($paymentForms)
            ->addColumn('edit', 'admin/paymentForm/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.paymentForm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentForm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentFormRequest $request)
    {
        $paymentForm = new PaymentForm();
        $paymentForm->name = $request->name;
        $paymentForm->save();
        return redirect('paymentForm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentForm $paymentForm)
    {
        return view('admin.paymentForm.show', compact('paymentForm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentForm $paymentForm)
    {
        return view('admin.paymentForm.edit', compact('paymentForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentFormRequest  $request
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentFormRequest $request, PaymentForm $paymentForm)
    {
        $paymentForm->name = $request->name;
        $paymentForm->update();
        return redirect('paymentForm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentForm $paymentForm)
    {
        $paymentForm->delete();
        toast('Forma de pago eliminada con éxito.','success');
        return redirect('paymentForm');
    }
}

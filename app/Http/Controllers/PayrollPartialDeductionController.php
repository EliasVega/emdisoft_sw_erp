<?php

namespace App\Http\Controllers;

use App\Models\PayrollPartialDeduction;
use App\Http\Requests\StorePayrollPartialDeductionRequest;
use App\Http\Requests\UpdatePayrollPartialDeductionRequest;

class PayrollPartialDeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePayrollPartialDeductionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PayrollPartialDeduction $payrollPartialDeduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayrollPartialDeduction $payrollPartialDeduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollPartialDeductionRequest $request, PayrollPartialDeduction $payrollPartialDeduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayrollPartialDeduction $payrollPartialDeduction)
    {
        //
    }
}

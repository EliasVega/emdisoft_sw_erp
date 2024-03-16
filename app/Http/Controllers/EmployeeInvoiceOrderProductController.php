<?php

namespace App\Http\Controllers;

use App\Models\EmployeeInvoiceOrderProduct;
use App\Http\Requests\StoreEmployeeInvoiceOrderProductRequest;
use App\Http\Requests\UpdateEmployeeInvoiceOrderProductRequest;
use App\Models\Employee;
use App\Models\InvoiceOrder;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeInvoiceOrderProductController extends Controller
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
    public function store(StoreEmployeeInvoiceOrderProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeInvoiceOrderProduct $employeeInvoiceOrderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeInvoiceOrderProduct $employeeInvoiceOrderProduct)
    {
        //dd($employeeInvoiceProduct);
        $id = $employeeInvoiceOrderProduct->invoiceOrderProduct->invoice_order_id;
        $invoiceOrder = InvoiceOrder::findOrFail($id);
        $employees = Employee::get();
        return view('admin.employeeInvoiceOrderProduct.edit', compact(
            'employeeInvoiceOrderProduct',
            'invoiceOrder',
            'employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeInvoiceOrderProductRequest $request, EmployeeInvoiceOrderProduct $employeeInvoiceOrderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeInvoiceOrderProduct $employeeInvoiceOrderProduct)
    {
        //
    }
}

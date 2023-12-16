<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Models\Employee;
use App\Models\Indicator;
use App\Models\OvertimeType;
use App\Models\PaymentFrecuency;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PayrollController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:payroll.index|payroll.create|payroll.show|payroll.edit|payroll.destroy', ['only'=>['index']]);
        $this->middleware('permission:payroll.create', ['only'=>['create','store']]);
        $this->middleware('permission:payroll.show', ['only'=>['show']]);
        $this->middleware('permission:payroll.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:payroll.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payrolls = Payroll::all();

            return DataTables::of($payrolls)
            ->addIndexColumn()
            ->addColumn('employee', function (Payroll $payroll) {
                return $payroll->employee->name;
            })
            ->addColumn('actions', 'admin/payroll/actions')
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.payroll.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::get();
        $paymentFrecuencies = PaymentFrecuency::where('code', '>', 3)->get();
        $indicators = Indicator::select('smlv', 'transport_assistance', 'weekly_hours')->get();
        $overtimeTypes = OvertimeType::get();
        return view('admin.payroll.create', compact(
            'employees',
            'paymentFrecuencies',
            'indicators',
            'overtimeTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}

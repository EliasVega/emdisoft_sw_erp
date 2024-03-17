<?php

namespace App\Http\Controllers;

use App\Models\WorkLabor;
use App\Http\Requests\StoreWorkLaborRequest;
use App\Http\Requests\UpdateWorkLaborRequest;
use App\Models\Company;
use App\Models\EmployeeInvoiceOrderProduct;
use App\Models\EmployeeInvoiceProduct;
use App\Models\Indicator;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class WorkLaborController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $workLabors = WorkLabor::get();
            return DataTables::of($workLabors)
            ->addIndexColumn()
            ->addColumn('employee', function (WorkLabor $workLabor) {
                return $workLabor->employee->name;
            })
            ->addColumn('user', function (WorkLabor $workLabor) {
                return $workLabor->user->name;
            })
            ->addColumn('btn', 'admin/workLabor/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.workLabor.index');
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
    public function store(StoreWorkLaborRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkLabor $workLabor)
    {
        $employeeInvoiceProducts = EmployeeInvoiceProduct::where('work_labor_id', $workLabor->id)->get();

        return view('admin.workLabor.show', compact('workLabor', 'employeeInvoiceProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkLabor $workLabor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkLaborRequest $request, WorkLabor $workLabor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkLabor $workLabor)
    {
        //
    }

    public function workLaborPdf(Request $request, $id)
    {
        $indicator = Indicator::findOrFail(1);
        $workLabor = WorkLabor::findOrFail($id);
        $pay = Pay::findOrFail($workLabor->pay_id);
        $company = Company::findOrFail(1);
        $employeeInvoiceProducts = EmployeeInvoiceProduct::where('work_labor_id', $workLabor->id)->get();

        $workLaborPdf = "PAGO-". $workLabor->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.workLabor.pdf', compact('workLabor', 'employeeInvoiceProducts', 'pay', 'company', 'logo', 'indicator'));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$workLaborPdf.pdf");
        //return $pdf->download("$purchasepdf.pdf");*/
    }

    public function workLaborPos($id)
    {
        $workLabor = WorkLabor::findOrFail($id);
        $employeeInvoiceProducts = EmployeeInvoiceProduct::where('work_labor_id', $workLabor->id)
        ->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $workLaborPos = "Comision-". $workLabor->id;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.workLabor.pos', compact(
            'workLabor',
            'employeeInvoiceProducts',
            'company',
            'indicator',
            'logo',
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,226.76,1246.64), 'portrait');

        return $pdf->stream('vista-pdf', "$workLaborPos.pdf");
        //return $pdf->download("$invoicepdf.pdf");
    }
}

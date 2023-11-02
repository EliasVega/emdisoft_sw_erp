<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Http\Requests\StoreOvertimeRequest;
use App\Http\Requests\UpdateOvertimeRequest;
use App\Models\Employee;
use App\Models\OvertimeType;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OvertimeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:overtime.index|overtime.create|overtime.show|overtime.edit|overtime.destroy', ['only'=>['index']]);
        $this->middleware('permission:overtime.create', ['only'=>['create','store']]);
        $this->middleware('permission:overtime.show', ['only'=>['show']]);
        $this->middleware('permission:overtime.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:overtime.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $overtimes = Overtime::get();

            return DataTables::of($overtimes)
            ->addIndexColumn()
            ->addColumn('employee', function(Overtime $overtime) {
                return $overtime->employee->name;
            })
            ->addColumn('type', function(Overtime $overtime) {
                return $overtime->overtimeType->code;
            })
            ->addColumn('edit', 'admin/overtime/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.overtime.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::get();
        $overtimeTypes = OvertimeType::get();
        return view("admin.overtime.create", compact('employees', 'overtimeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOvertimeRequest $request)
    {
        //dd($request->all());
        
        $inicio = new DateTime($request->start_time);
        $fin = new DateTime($request->end_time);
        $tiempo = $inicio->diff($fin);
        $horas = $tiempo->format('%H');
        $minutos = $tiempo->format('%I');

        dd(($minutos/60) * 6000);

        $overtime = new Overtime();
        $overtime->date = $request->date;
        $overtime->start_time = $request->start_time;
        $overtime->end_time = $request->end_time;
        $overtime->quantity = $request->quantity;
        $overtime->hour_value = 0;
        $overtime->total = 0;
        $overtime->employee_id = $request->employee_id;
        $overtime->overtime_type_id = $request->overtime_type_id;
        $overtime->save();

        return redirect('overtime');
    }

    /**
     * Display the specified resource.
     */
    public function show(Overtime $overtime)
    {
        return view("admin.overtime.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Overtime $overtime)
    {
        $employees = Employee::get();
        $overtimeTypes = OvertimeType::get();
        return view("admin.overtime.edit", compact('employees', 'overtimeTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOvertimeRequest $request, Overtime $overtime)
    {
        dd($request->all());
        $overtime->date = $request->date;
        $overtime->start_time = $request->start_time;
        $overtime->end_time = $request->end_time;
        $overtime->quantity = $request->quantity;
        $overtime->hour_value = 0;
        $overtime->total = 0;
        $overtime->employee_id = $request->employee_id;
        $overtime->overtime_type_id = $request->overtime_type_id;
        $overtime->update();

        return redirect('overtime');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Overtime $overtime)
    {
        $overtime->delete();
        toast('Hora extra eliminada con éxito.','success');
        return redirect('overtime');
    }
}

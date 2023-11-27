<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Http\Requests\StoreOvertimeRequest;
use App\Http\Requests\UpdateOvertimeRequest;
use App\Models\Employee;
use App\Models\Indicator;
use App\Models\OvertimeDay;
use App\Models\OvertimeMonth;
use App\Models\OvertimeType;
use Carbon\Carbon;
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
        $indicator = Indicator::findOrFail(1);
        return view("admin.overtime.create", compact('employees', 'overtimeTypes', 'indicator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOvertimeRequest $request)
    {
        //dd($request->all());

        $overtime_tipe_id = $request->overtime_type_id;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $percentage = $request->percentage;
        $quantity = $request->hours;
        $valueHour = $request->value_hour;

        $emp = $request->employee_id;
        //dd(intval(explode("_", $emp[0])));
        $employee = Employee::findOrFail(intval(explode("_", $emp[0])));



        for ($i=0; $i < count($overtime_tipe_id); $i++) {

            $subtotal = $quantity[$i] * $valueHour[$i];
            $startDateTime = Carbon::parse($startTime[$i]);
            $yearMonth = $startDateTime->format('Y-m');

            $overtime = Overtime::where('year_month', $yearMonth)->first();

            if ($overtime) {
                $overtime->total += $subtotal;
                $overtime->update();
            } else {
                $overtime = new Overtime();
                $overtime->year_month = $yearMonth;
                $overtime->total = $subtotal;
                $overtime->employee_id = $employee->id;
                $overtime->save();
            }

            //crear registro overtime_month
            $overtimeMonth = OvertimeMonth::where('overtime_id', $overtime->id)
            ->where('year_month', $yearMonth)
            ->where('overtime_type_id', $overtime_tipe_id[$i])->first();

            if ($overtimeMonth) {
                $overtimeMonth->quantity += $quantity[$i];
                $overtimeMonth->subtotal += $subtotal;
                $overtimeMonth->update();
            } else {
                $overtimeMonth = new OvertimeMonth();
                $overtimeMonth->year_month = $yearMonth;
                $overtimeMonth->percentage = $percentage[$i];
                $overtimeMonth->quantity = $quantity[$i];
                $overtimeMonth->value_hour = $valueHour[$i];
                $overtimeMonth->subtotal = $subtotal;
                $overtimeMonth->overtime_type_id = $overtime_tipe_id[$i];
                $overtimeMonth->overtime_id = $overtime->id;
                $overtimeMonth->save();
            }

            $overtimeDay = new OvertimeDay();
            $overtimeDay->year_month = $yearMonth;
            $overtimeDay->start_time = $startTime[$i];
            $overtimeDay->end_time = $endTime[$i];
            $overtimeDay->percentage = $percentage[$i];
            $overtimeDay->quantity = $quantity[$i];
            $overtimeDay->value_hour = $valueHour[$i];
            $overtimeDay->subtotal = $subtotal;
            $overtimeDay->overtime_id = $overtime->id;
            $overtimeDay->overtime_month_id = $overtimeMonth->id;
            $overtimeDay->save();
        }

        return redirect('overtime');
    }

    /**
     * Display the specified resource.
     */
    public function show(Overtime $overtime)
    {
        $overtimeMonths = OvertimeMonth::where('overtime_id', $overtime->id)->get();
        $overtimeMonthHours = OvertimeMonth::where('overtime_id', $overtime->id)->sum('quantity');
        $overtimeDays = OvertimeDay::where('overtime_id', $overtime->id)->where('quantity', '>', 0)->get();
        return view("admin.overtime.show", compact(
            'overtime',
            'overtimeMonths',
            'overtimeMonthHours',
            'overtimeDays'

        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Overtime $overtime)
    {
        $indicator = Indicator::findOrFail(1);
        $employees = Employee::get();
        $overtimeTypes = OvertimeType::get();
        $overtimeDays = OvertimeDay::from('overtime_days as od')
        ->join('overtimes as ov', 'od.overtime_id', 'ov.id')
        ->join('overtime_months as om', 'od.overtime_month_id', 'om.id')
        ->join('overtime_types as ot', 'om.overtime_type_id', 'ot.id')
        ->select('od.id', 'od.start_time', 'od.end_time', 'od.quantity', 'od.value_hour', 'od.subtotal', 'ot.id as idOT', 'ot.hour_type', 'ot.percentage')
        ->where('od.overtime_id', $overtime->id)
        ->where('od.quantity', '>', 0)
        ->get();
        return view("admin.overtime.edit", compact('overtime', 'indicator', 'employees', 'overtimeTypes', 'overtimeDays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOvertimeRequest $request, Overtime $overtime)
    {
        //dd($request->all());
        $overtime_day_id = $request->overtime_day_id;
        $overtime_tipe_id = $request->overtime_type_id;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $quantity = $request->hours;
        $valueHour = $request->value_hour;

        $overtimeDays = OvertimeDay::where('overtime_id', $overtime->id)->get();
        foreach ($overtimeDays as $key => $overtimeDay) {

            $overtimeDay->quantity = 0;
            $overtimeDay->subtotal = 0;
            $overtimeDay->update();
        }

        $overtimeMonths = OvertimeMonth::where('overtime_id', $overtime->id)->get();
        foreach ($overtimeMonths as $key => $overtimeMonth) {
            $overtimeMonth->quantity = 0;
            $overtimeMonth->subtotal = 0;
            $overtimeMonth->save();
        }

        $overtime->total = 0;
        $overtime->update();


        for ($i=0; $i < count($overtime_tipe_id); $i++) {

            $subtotal = $quantity[$i] * $valueHour[$i];

            $overtimeDay = OvertimeDay::findOrFail($overtime_day_id[$i]);
            $overtimeMonth = OvertimeMonth::findOrFail($overtimeDay->overtime_month_id);

            $overtime->total += $subtotal;
            $overtime->update();

            //crear registro overtime_month

            $overtimeMonth->quantity += $quantity[$i];
            $overtimeMonth->subtotal += $subtotal;
            $overtimeMonth->update();

            $overtimeDay->start_time = $startTime[$i];
            $overtimeDay->end_time = $endTime[$i];
            $overtimeDay->quantity = $quantity[$i];
            $overtimeDay->subtotal = $subtotal;
            $overtimeDay->save();
        }
        toast('Hora extra editada con éxito.','success');
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

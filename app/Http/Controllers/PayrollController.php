<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Models\Employee;
use App\Models\Indicator;
use App\Models\Overtime;
use App\Models\OvertimeMonth;
use App\Models\OvertimeType;
use App\Models\PaymentFrecuency;
use App\Models\PayrollAcrued;
use App\Models\PayrollDeduction;
use Carbon\Carbon;
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
        $startDate = $request->start_date;
        $startDateT = Carbon::parse($startDate);
        $yearMonth = $startDateT->format('Y-m');

        $employee_id = $request->employee_id;
        $overtime_type_id = $request->overtime_type_id;
        $percentage = $request->percentage;
        $quantity = $request->quantity;
        $valueHour = $request->value_hour;
        //$days = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        //$dia = $days[(date('N', strtotime($startDate))) - 1];
        $day = date('N', strtotime($startDate));
        $startDateTime = '';
        $endDateTime = '';

        for ($i=0; $i < count($overtime_type_id); $i++) {
            $subtotal = $quantity[$i] * $valueHour[$i];
            if ($overtime_type_id[$i] == 1 || $overtime_type_id[$i] == 4 || $overtime_type_id[$i] == 5) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . '06:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . '21:00:00');
            } else {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . '21:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . '06:00:00');
            }

            $overtime = Overtime::where('year_month', $yearMonth)->first();

            if ($overtime) {
                $overtime->total += $subtotal;
                $overtime->update();
            } else {
                $overtime = new Overtime();
                $overtime->year_month = $yearMonth;
                $overtime->total = $subtotal;
                $overtime->save();
            }

            $overtimeMonth = new OvertimeMonth();
            $overtimeMonth->year_month = $yearMonth;
            $overtimeMonth->percentage = $percentage[$i];
            $overtimeMonth->quantity = $quantity[$i];
            $overtimeMonth->value_hour = $valueHour[$i];
            $overtimeMonth->subtotal = $subtotal;
            $overtimeMonth->status = 'pendient';
            $overtimeMonth->overtime_type_id = $overtime_type_id[$i];
            $overtimeMonth->overtime_id = $overtime->id;
            $overtimeMonth->save();

        }
        dd($startDateTime . '---' . $endDateTime);
        dd($request->all());
        $payroll = new Payroll();
        $payroll->start_date = $request->start_date;//fecha inicio de Liquidacion
        $payroll->end_date = $request->end_date;//fecha fin de liquidacion
        $payroll->payment_date = $request->payment_date;//fecha de pago a empleado
        $payroll->generation_date = $request->generation_date;//fecha generacion nomina
        $payroll->days = $request->days;//dias laborados por el empleado
        $payroll->employee_id = $request->employee_id;//empleado
        $payroll->save();

        $payrollAcrued = new PayrollAcrued();
        $payrollAcrued->salary = 0;//salario asignado
        $payrollAcrued->transport_assistance = 0;//auxilio de trasporte
        $payrollAcrued->overtime = 0;//horas extras
        $payrollAcrued->vacations = 0;//vacaciones
        $payrollAcrued->bonus = 0;//prima
        $payrollAcrued->layoffs = 0;//cesantias
        $payrollAcrued->disabilities = 0;//incapacidades
        $payrollAcrued->licenses = 0;//licencias
        $payrollAcrued->bonuses = 0;//bonificaciones
        $payrollAcrued->aids  = 0;//ayudas
        $payrollAcrued->commissions = 0;//comisiones
        $payrollAcrued->payment_thirds = 0;//pagos a terceros
        $payrollAcrued->advances = 0;//anticipos
        $payrollAcrued->compensations = 0;//compensaciones
        $payrollAcrued->bonuses_EPCTV = 0;//bonOS EPCTV
        $payrollAcrued->other_concepts = 0;//otros conceptos
        $payrollAcrued->legal_strikes = 0;//huelgas legales
        $payrollAcrued->optionales = 0;//huelgas

        $payrollAcrued->employee_id = 0;
        $payrollAcrued->payroll_id = 0;
        $payrollAcrued->payroll_partial_id = 0;
        $payrollAcrued->save();

        $payrollDeduction = new PayrollDeduction();
        $payrollDeduction->eps = 0;//empres promotora de salud
        $payrollDeduction->pension = 0;//aportes a pension
        $payrollDeduction->fsp = 0;//fondo de solidaridad pensional
        $payrollDeduction->subsistence_fund = 0;//fondo de subsistencia
        $payrollDeduction->unions = 0;//sindicatos
        $payrollDeduction->sanctions = 0;//sanciones
        $payrollDeduction->advances = 0;//anticipos
        $payrollDeduction->payment_thirds = 0;//pagos a terceros
        $payrollDeduction->other_deductions = 0;//otras deducciones
        $payrollDeduction->releases = 0;//libranzas
        $payrollDeduction->optionales = 0;//huelgas legales

        $payrollDeduction->employee_id = 0;
        $payrollDeduction->payroll_id = 0;
        $payrollDeduction->save();
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

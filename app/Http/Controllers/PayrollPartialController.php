<?php

namespace App\Http\Controllers;

use App\Models\PayrollPartial;
use App\Http\Requests\StorePayrollPartialRequest;
use App\Http\Requests\UpdatePayrollPartialRequest;
use App\Models\Employee;
use App\Models\Indicator;
use App\Models\Overtime;
use App\Models\OvertimeDay;
use App\Models\OvertimeMonth;
use App\Models\OvertimeType;
use App\Models\PaymentFrecuency;
use App\Models\Payroll;
use App\Models\PayrollAcrued;
use App\Models\PayrollDeduction;
use App\Models\PayrollPartialAcrued;
use App\Models\PayrollPartialDeduction;
use App\Models\Provision;
use App\Models\ProvisionPartial;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\OvertimeDayCreate;
use App\Traits\OvertimeDateChanges;

class PayrollPartialController extends Controller
{
    use OvertimeDayCreate, OvertimeDateChanges;
    function __construct()
    {
        $this->middleware('permission:payrollPartial.index|payrollPartial.create|payrollPaartial.show|payrollPartial.edit|payrollPartial.destroy', ['only'=>['index']]);
        $this->middleware('permission:payrollPartial.create', ['only'=>['create','store']]);
        $this->middleware('permission:payrollPartial.show', ['only'=>['show']]);
        $this->middleware('permission:payrollPartial.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:payrollPartial.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payrollPartials = PayrollPartial::all();

            return DataTables::of($payrollPartials)
            ->addIndexColumn()
            ->addColumn('employee', function (PayrollPartial $payrollPartial) {
                return $payrollPartial->employee->name;
            })
            ->addColumn('btn', 'admin/payrollPartial/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }

        return view('admin.payrollPartial.index');
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
        return view('admin.payrollPartial.create', compact(
            'employees',
            'paymentFrecuencies',
            'indicators',
            'overtimeTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollPartialRequest $request)
    {
        dd($request->all());
        $yearMonth = $request->month;//tomando año y mes de fecha inicio liquidacion
        $startDate = $request->start_date;//fecha de inicio de liquidacion
        $endDate = $request->end_date;
        $generationDate = $request->generation_date;
        $paymentDate = $request->payment_date;
        $empled = $request->employee_id;
        $emp = explode("_", $empled);
        $employee = Employee::where('id', $emp)->first();
        $fortnight = $request->fortnight;//quincena del periodo

        $salary = $employee->salary;//salario del empleado
        $salaryAcrued = $request->salary_acrued;
        $totalAcrued = $request->total_acrued;//total devengado del periodo
        $transportAssistance = $request->transport_acrued;//auxilio de transporte
        $workedDays = $request->days;//dias trabajados por el empleado

        //request de horas extras
        $overtime_type_id = $request->overtime_type_id;//id del tipo de hora
        $quantity = $request->quantity;//request de la cantidad de horas para este tipo
        $valueHour = $request->value_hour;//valor que corresponde segun el salario
        $overtimeTotal = $request->total;
        //$days = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        //$dia = $days[(date('N', strtotime($startDate))) - 1];

        //request de vacaciones
        $vacations_type = $request->vacation_type;
        $total_vacations = 0;
        if ($vacations_type) {
            $total_vacations = $request->total_vacations;
        }

        $comprobation = PayrollPartial::where('year_month', $yearMonth)
        ->where('employee_id', $employee->id)
        ->where('fortnight', $fortnight)
        ->first();
        if ($comprobation) {
            toast('Nomina ya existe para este colaborador. Es la #' . ' ' . $comprobation->id,'error');
            return redirect("payrollPartial");
        }
        if ($overtime_type_id) {
            for ($i=0; $i < count($overtime_type_id); $i++) {
                $ovtId = $overtime_type_id[$i];
                $subtotal = $quantity[$i] * $valueHour[$i];
                $vhActual = $valueHour[$i];
                //crear o actualizar el total de las horas extras en pesos
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
                $overtimeMonth->quantity = $quantity[$i];
                $overtimeMonth->value_hour = $valueHour[$i];
                $overtimeMonth->subtotal = $subtotal;
                $overtimeMonth->status = 'pendient';
                $overtimeMonth->overtime_type_id = $overtime_type_id[$i];
                $overtimeMonth->overtime_id = $overtime->id;
                $overtimeMonth->employee_id = $employee->id;
                $overtimeMonth->save();

                $quantityHours = $quantity[$i];
                //$startDateT = Carbon::parse($startDate);
                $variableDay = $startDate;
                //$day = date('N', strtotime($variableDay));//tomando el dia de la semana 1 lunes 7 domingo
                $startDateTime = '';
                $endDateTime = '';
                while ($quantityHours > 0) {
                    $hours = 0;
                    $hd = '';
                    if ($quantityHours >= 8) {
                        $hours = 8;
                        $hd = '+' . $hours . ' ' . 'hours';
                        $quantityHours -= $hours;
                    } else {
                        $hours = $quantityHours;
                        $hd = '+' . $hours . ' ' . 'hours';
                        $quantityHours -= $hours;
                    }

                    $dataChange = $this->overtimeDateChanges($variableDay, $hd, $ovtId);

                    $startDateTime = $dataChange[0];
                    $endDateTime = $dataChange[1];
                    $variableDay = $dataChange[2];
                    $ovmId = $overtimeMonth->id;
                    $this->overtimeDayCreate($yearMonth, $startDateTime, $endDateTime, $hours, $vhActual, $subtotal, $ovtId, $ovmId);
                }

            }
        } else {
            $overtimeTotal = 0;
        }

        $payrollExits = Payroll::where('year_month', $yearMonth)->where('employee_id', $emp)->first();

        if ($payrollExits) {
            $payroll = Payroll::findOrFail($payrollExits->id);
            $payroll->end_date = $endDate;//fecha fin de liquidacion
            $payroll->payment_date = $paymentDate;//fecha de pago a empleado
            $payroll->generation_date = $generationDate;//fecha generacion nomina
            $payroll->days += $workedDays;//dias laborados por el empleado
            $payroll->total_acrued += $totalAcrued;//total devengado mes
            $payroll->update();

            $payrollAcrued = PayrollAcrued::where('payroll_id', $payroll->id)->first();
            $payrollAcrued->salary += $salaryAcrued;//salario asignado
            $payrollAcrued->transport_assistance += $transportAssistance;//auxilio de trasporte
            $payrollAcrued->overtime += $overtimeTotal;//horas extras
            $payrollAcrued->vacations += $total_vacations;//vacaciones
            $payrollAcrued->bonus += 0;//prima
            $payrollAcrued->layoffs += 0;//cesantias
            $payrollAcrued->disabilities += 0;//incapacidades
            $payrollAcrued->licenses += 0;//licencias
            $payrollAcrued->bonuses += 0;//bonificaciones
            $payrollAcrued->aids += 0;//ayudas
            $payrollAcrued->commissions += 0;//comisiones
            $payrollAcrued->payment_thirds += 0;//pagos a terceros
            $payrollAcrued->advances += 0;//anticipos
            $payrollAcrued->compensations += 0;//compensaciones
            $payrollAcrued->bonuses_EPCTV += 0;//bonOS EPCTV
            $payrollAcrued->other_concepts += 0;//otros conceptos
            $payrollAcrued->legal_strikes += 0;//huelgas legales
            $payrollAcrued->optionales += 0;//huelgas
            $payrollAcrued->update();

            $payrollDeduction = PayrollDeduction::where('payroll_id', $payroll->id)->first();
            $payrollDeduction->eps += 0;//empres promotora de salud
            $payrollDeduction->pension += 0;//aportes a pension
            $payrollDeduction->fsp += 0;//fondo de solidaridad pensional
            $payrollDeduction->subsistence_fund += 0;//fondo de subsistencia
            $payrollDeduction->unions += 0;//sindicatos
            $payrollDeduction->sanctions += 0;//sanciones
            $payrollDeduction->advances += 0;//anticipos
            $payrollDeduction->payment_thirds += 0;//pagos a terceros
            $payrollDeduction->other_deductions += 0;//otras deducciones
            $payrollDeduction->releases += 0;//libranzas
            $payrollDeduction->optionales += 0;//huelgas legales
            $payrollDeduction->update();

        } else {
            $payroll = new Payroll();
            $payroll->year_month = $yearMonth;
            $payroll->start_date = $startDate;//fecha inicio de Liquidacion
            $payroll->end_date = $endDate;//fecha fin de liquidacion
            $payroll->payment_date = $paymentDate;//fecha de pago a empleado
            $payroll->generation_date = $generationDate;//fecha generacion nomina
            $payroll->days = $request->days;//dias laborados por el empleado
            $payroll->total_acrued = $totalAcrued;//total devengado mes
            $payroll->employee_id = $employee->id;//empleado
            $payroll->save();

            $payrollAcrued = new PayrollAcrued();
            $payrollAcrued->salary = $salaryAcrued;//salario asignado
            $payrollAcrued->transport_assistance = $transportAssistance;//auxilio de trasporte
            $payrollAcrued->overtime = $overtimeTotal;//horas extras
            $payrollAcrued->vacations = $total_vacations;//vacaciones
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
            $payrollAcrued->payroll_id = $payroll->id;
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
            $payrollDeduction->payroll_id = $payroll->id;
            $payrollDeduction->save();
        }

        $payrollPartial = new PayrollPartial();
        $payrollPartial->year_month = $yearMonth;
        $payrollPartial->start_date = $startDate;//fecha inicio de Liquidacion
        $payrollPartial->end_date = $endDate;//fecha fin de liquidacion
        $payrollPartial->payment_date = $paymentDate;//fecha de pago a empleado
        $payrollPartial->generation_date = $generationDate;//fecha generacion nomina
        $payrollPartial->days = $request->days;//dias laborados por el empleado
        $payrollPartial->total_acrued = $totalAcrued;//total devengado
        $payrollPartial->fortnight = $fortnight;//periodo de liquidacion
        $payrollPartial->employee_id = $employee->id;//empleado
        $payrollPartial->payroll_id = $payroll->id;
        $payrollPartial->save();

        $payrollPartialAcrued = new PayrollPartialAcrued();
        $payrollPartialAcrued->salary = $salaryAcrued;//salario asignado
        $payrollPartialAcrued->transport_assistance = $transportAssistance;//auxilio de trasporte
        $payrollPartialAcrued->overtime = $overtimeTotal;//horas extras
        $payrollPartialAcrued->vacations = $total_vacations;//vacaciones
        $payrollPartialAcrued->bonus = 0;//prima
        $payrollPartialAcrued->layoffs = 0;//cesantias
        $payrollPartialAcrued->disabilities = 0;//incapacidades
        $payrollPartialAcrued->licenses = 0;//licencias
        $payrollPartialAcrued->bonuses = 0;//bonificaciones
        $payrollPartialAcrued->aids  = 0;//ayudas
        $payrollPartialAcrued->commissions = 0;//comisiones
        $payrollPartialAcrued->payment_thirds = 0;//pagos a terceros
        $payrollPartialAcrued->advances = 0;//anticipos
        $payrollPartialAcrued->compensations = 0;//compensaciones
        $payrollPartialAcrued->bonuses_EPCTV = 0;//bonOS EPCTV
        $payrollPartialAcrued->other_concepts = 0;//otros conceptos
        $payrollPartialAcrued->legal_strikes = 0;//huelgas legales
        $payrollPartialAcrued->optionales = 0;//huelgas
        $payrollPartialAcrued->payroll_partial_id = $payrollPartial->id;
        $payrollPartialAcrued->save();

        $payrollPartialDeduction = new PayrollPartialDeduction();
        $payrollPartialDeduction->eps = 0;//empres promotora de salud
        $payrollPartialDeduction->pension = 0;//aportes a pension
        $payrollPartialDeduction->fsp = 0;//fondo de solidaridad pensional
        $payrollPartialDeduction->subsistence_fund = 0;//fondo de subsistencia
        $payrollPartialDeduction->unions = 0;//sindicatos
        $payrollPartialDeduction->sanctions = 0;//sanciones
        $payrollPartialDeduction->advances = 0;//anticipos
        $payrollPartialDeduction->payment_thirds = 0;//pagos a terceros
        $payrollPartialDeduction->other_deductions = 0;//otras deducciones
        $payrollPartialDeduction->releases = 0;//libranzas
        $payrollPartialDeduction->optionales = 0;//huelgas legales
        $payrollPartialDeduction->payroll_partial_id = $payrollPartial->id;
        $payrollPartialDeduction->save();

        $provisions = Provision::where('employee_id', $employee->id)->first();

        $calculateVacation = 0;
        $calculateBonusLayoffs = 0;
        $layoffNew = 0;
        $calculateLayoffInterest = 0;

        if ($provisions) {
            //encuentra todas las parciales pendientes
            $pps = ProvisionPartial::where('provision_id', $provisions->id)->where('status', 'pendient')->get();
            $ppq = count($pps) + 1 / 2;
            //intereses que hay provisionado
            $layoffOld = $provisions->layoff;
            $calculateVacation = $salary * $workedDays / 720;
            $calculateBonusLayoffs = ($salary + $transportAssistance) * $workedDays / 360;
            $layoffNew = $layoffOld + $calculateBonusLayoffs;
            $calculateLayoffInterest = $layoffNew * $ppq / 100;

            $provisions->vacations += $calculateVacation;
            $provisions->bonus += $calculateBonusLayoffs;
            $provisions->layoffs += $calculateBonusLayoffs;
            $provisions->layoff_interest += $calculateLayoffInterest;
            $provisions->update();

        } else {
            $ppq = '0.5';
            $calculateVacation = $salary * $workedDays / 720;
            $calculateBonusLayoffs = ($salary + $transportAssistance) * $workedDays / 360;
            $calculateLayoffInterest = $calculateBonusLayoffs * $ppq / 100;

            $provisions = new Provision();
            $provisions->vacations = $calculateVacation;
            $provisions->bonus = $calculateBonusLayoffs;
            $provisions->layoffs = $calculateBonusLayoffs;
            $provisions->layoff_interest = $calculateLayoffInterest;
            $provisions->employee_id = $employee->id;
            $provisions->save();

        }
        $provisionPartials = new ProvisionPartial();
        $provisionPartials->start_period = $startDate;
        $provisionPartials->end_period = $endDate;
        $provisionPartials->vacations = $calculateVacation;
        $provisionPartials->bonus = $calculateBonusLayoffs;
        $provisionPartials->layoffs = $calculateBonusLayoffs;
        $provisionPartials->layoff_interest = $calculateLayoffInterest;
        $provisionPartials->vacation_adjustment = 0;
        $provisionPartials->status = 'pendient';
        $provisionPartials->provision_id = $provisions->id;
        $provisionPartials->payroll_acrued_id = $payrollAcrued->id;
        $provisionPartials->payroll_partial_acrued_id = $payrollPartialAcrued->id;
        $provisionPartials->save();

        if ($vacations_type) {
            for ($i=0; $i < count($vacations_type); $i++) {
                $vacations = new Vacation();
                $vacations->start_period = $request->start_period;
                $vacations->end_period = $request->end_period;
                $vacations->start_vacations = $request->start_vacations[$i];
                $vacations->end_vacations = $request->end_vacations[$i];
                $vacations->vacation_days = $request->vacation_days[$i];
                $vacations->value_day = $request->value_day[$i];
                $vacations->value = $request->value[$i];
                $vacations->pay_mode = $request->pay_mode;
                $vacations->type = $request->type[$i];

                $vacations->payroll_acrued_id = $payrollAcrued->id;
                $vacations->payroll_acrued_id = $payrollPartialAcrued->id;
                $vacations->save();
            }
        }

        toast('Nomina Registrada satisfactoriamente.','success');
        return redirect("payrollPartial");
    }

    /**
     * Display the specified resource.
     */
    public function show(PayrollPartial $payrollPartial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayrollPartial $payrollPartial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollPartialRequest $request, PayrollPartial $payrollPartial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayrollPartial $payrollPartial)
    {
        //
    }

    public function getProvisionEmployee(Request $request)
    {
        if ($request->ajax()) {
            $provisions = Provision::from('provisions as pro')
            ->select('pro.id', 'pro.vacations')
            ->where('pro.employee_id', $request->employee_id)
            ->first();
            if ($provisions) {
                return response()->json($provisions);
            }
        }
    }
}

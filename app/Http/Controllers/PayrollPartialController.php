<?php

namespace App\Http\Controllers;

use App\Models\PayrollPartial;
use App\Http\Requests\StorePayrollPartialRequest;
use App\Http\Requests\UpdatePayrollPartialRequest;
use App\Models\Bonus;
use App\Models\Employee;
use App\Models\EmployeeInvoiceProduct;
use App\Models\Inability;
use App\Models\Indicator;
use App\Models\Layoff;
use App\Models\License;
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

use function PHPUnit\Framework\isNull;

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
        //$employees = Employee::findOrFail(2);
        //dd($employees->provision->id);
        $paymentFrecuencies = PaymentFrecuency::where('code', '>', 3)->get();
        $indicators = Indicator::select('smlv', 'transport_assistance', 'weekly_hours', 'work_labor')->get();
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
        //dd($request->all());
        $yearMonth = $request->month;//tomando año y mes de fecha inicio liquidacion
        $startDate = $request->start_date;//fecha de inicio de liquidacion
        $endDate = $request->end_date;
        $generationDate = $request->generation_date;
        $paymentDate = $request->payment_date;
        $empled = $request->employee_id;
        $emp = explode("_", $empled);
        $employee = Employee::where('id', $emp[0])->first();
        $employee_id = $employee->id;
        $fortnight = $request->fortnight;//quincena del periodo

        $salary = $employee->salary;//salario del empleado
        $salaryAcrued = $request->salary_acrued;
        $totalAcrued = $request->total_acrued;//total devengado del periodo
        $transportAssistance = $request->transport_acrued;//auxilio de transporte
        $workedDays = $request->days;//dias trabajados por el empleado

        //request de horas extras
        $overtime_type_id = $request->overtime_type_id;//id del tipo de hora
        $quantityOvertime = $request->quantity_overtime;//request de la cantidad de horas para este tipo
        $valueHour = $request->value_hour;//valor que corresponde segun el salario
        $totalOvertime = $request->total_overtime;
        //$days = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        //$dia = $days[(date('N', strtotime($startDate))) - 1];

        //request provisions
        $vacationProvisions = $request->vacation_provisions;
        $bonusProvisions = $request->bonus_provisions;
        $layoffProvisions = $request->layoff_provisions;
        $layoffInterest = $request->layoff_interest_pro;
        $vacationAdjustment = $request->vacation_adjustment;
        $vacationDays = $request->vp_days;
        $bonusDays = $request->bp_days;
        $layoffDays = $request->lp_days;

        if ($vacationAdjustment <= 0) {
            $vacationAdjustment = 0;
        }
        //request de vacaciones
        $vacationType = $request->vacation_type;
        $totalVacations = $request->total_vacations;

        //request de primas
        $bonusType = $request->bonus_type;
        $totalBonus = $request->total_bonus;

        //request de cesantias
        $totalLayoffs = $request->total_layoffs;

        //request de incapacidades
        $totalInabilities = $request->total_inabilities;
        $origin = $request->origin_id;

        $totalLicenses = $request->total_licenses;
        $typePay = $request->type_pay;
        $typeLicense = $request->type_license;

        $comprobation = PayrollPartial::where('year_month', $yearMonth)
        ->where('employee_id', $employee->id)
        ->where('fortnight', $fortnight)
        ->first();
        if ($comprobation) {
            toast('Nomina ya existe para este colaborador. Es la #' . ' ' . $comprobation->id,'error');
            return redirect("payrollPartial");
        }

        $payrollExits = Payroll::where('year_month', $yearMonth)->where('employee_id', $employee_id)->first();

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
            $payrollAcrued->overtime += $totalOvertime;//horas extras
            $payrollAcrued->vacations += $totalVacations;//vacaciones
            $payrollAcrued->bonus += $totalBonus;//prima
            $payrollAcrued->layoffs += $totalLayoffs;//cesantias
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
            $payroll->days = $workedDays;//dias laborados por el empleado
            $payroll->total_acrued = $totalAcrued;//total devengado mes
            $payroll->employee_id = $employee->id;//empleado
            $payroll->save();

            $payrollAcrued = new PayrollAcrued();
            $payrollAcrued->salary = $salaryAcrued;//salario asignado
            $payrollAcrued->transport_assistance = $transportAssistance;//auxilio de trasporte
            $payrollAcrued->overtime = $totalOvertime;//horas extras
            $payrollAcrued->vacations = $totalVacations;//vacaciones
            $payrollAcrued->bonus = $totalBonus;//prima
            $payrollAcrued->layoffs = $totalLayoffs;//cesantias
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
        $payrollPartial->days = $workedDays;//dias laborados por el empleado
        $payrollPartial->total_acrued = $totalAcrued;//total devengado
        $payrollPartial->fortnight = $fortnight;//periodo de liquidacion
        $payrollPartial->note = $request->note;
        $payrollPartial->vacation_days = 0;
        $payrollPartial->inability_days = 0;
        $payrollPartial->license_days = 0;
        $payrollPartial->employee_id = $employee->id;//empleado
        $payrollPartial->payroll_id = $payroll->id;
        $payrollPartial->user_id = current_user()->id;
        $payrollPartial->save();

        $payrollPartialAcrued = new PayrollPartialAcrued();
        $payrollPartialAcrued->salary = $salaryAcrued;//salario asignado
        $payrollPartialAcrued->transport_assistance = $transportAssistance;//auxilio de trasporte
        $payrollPartialAcrued->overtime = $totalOvertime;//horas extras
        $payrollPartialAcrued->vacations = $totalVacations;//vacaciones
        $payrollPartialAcrued->bonus = $totalBonus;//prima
        $payrollPartialAcrued->layoffs = $totalLayoffs;//cesantias
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

        if ($overtime_type_id) {

            $overtime = Overtime::where('year_month', $yearMonth)->where('employee_id', $employee_id)->first();
            if ($overtime) {
                $overtime->total += $totalOvertime;
                $overtime->update();
            } else {
                $overtime = new Overtime();
                $overtime->year_month = $yearMonth;
                $overtime->total = $totalOvertime;
                $overtime->employee_id = $employee_id;
                $overtime->payroll_acrued_id = $payrollAcrued->id;
                $overtime->save();
            }

            for ($i=0; $i < count($overtime_type_id); $i++) {
                $ovtId = $overtime_type_id[$i];
                $subtotal = $quantityOvertime[$i] * $valueHour[$i];
                $vhActual = $valueHour[$i];

                $overtimeMonth = new OvertimeMonth();
                $overtimeMonth->year_month = $yearMonth;
                $overtimeMonth->quantity = $quantityOvertime[$i];
                $overtimeMonth->value_hour = $valueHour[$i];
                $overtimeMonth->subtotal = $subtotal;
                $overtimeMonth->status = 'pendient';
                $overtimeMonth->overtime_type_id = $overtime_type_id[$i];
                $overtimeMonth->overtime_id = $overtime->id;
                $overtimeMonth->save();


                $quantityHours = $quantityOvertime[$i];
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
            $totalOvertime = 0;
        }

        $provisions = Provision::where('employee_id', $employee->id)->first();
        //dd($provisions);
        if (empty($provisions)) {
            //Creando la tabla provisiones
            $provisions = new Provision();
            $provisions->start_period_vacations = $startDate;
            $provisions->vacation_days = 0;
            $provisions->vacations = 0;
            $provisions->start_period_bonus = $startDate;
            $provisions->bonus_days = 0;
            $provisions->bonus = 0;
            $provisions->start_period_layoffs = $startDate;
            $provisions->layoff_days = 0;
            $provisions->layoffs = 0;
            $provisions->layoff_interest = 0;
            $provisions->employee_id = $employee->id;
            $provisions->save();
        }

        $provisionPartials = ProvisionPartial::where('year_month', $yearMonth)->where('provision_id', $provisions->id)->first();
        if (empty($provisionPartials)) {
            $provisionPartials = new ProvisionPartial();
            $provisionPartials->year_month = $yearMonth;
            $provisionPartials->start_period = $startDate;
            $provisionPartials->end_period = $endDate;
            $provisionPartials->vacation_days = $vacationDays;
            $provisionPartials->vacations = $vacationProvisions;
            $provisionPartials->bonus_days = $bonusDays;
            $provisionPartials->bonus = $bonusProvisions;
            $provisionPartials->layoff_days = $layoffDays;
            $provisionPartials->layoffs = $layoffProvisions;
            $provisionPartials->layoff_interest = $layoffInterest;
            $provisionPartials->vacation_adjustment = $vacationAdjustment;
            $provisionPartials->status = 'pendient';
            $provisionPartials->provision_id = $provisions->id;
            $provisionPartials->payroll_acrued_id = $payrollAcrued->id;
            $provisionPartials->employee_id = $employee_id;
            $provisionPartials->save();
            if ($fortnight == 'second') {
                $provisions->vacation_days += $vacationDays;
                $provisions->vacations += $vacationProvisions;
                $provisions->bonus_days += $bonusDays;
                $provisions->bonus += $bonusProvisions;
                $provisions->layoff_days += $layoffDays;
                $provisions->layoffs += $layoffProvisions;
                $provisions->layoff_interest = $layoffInterest;
                $provisions->update();

                $provisionPartials->status = 'caused';
                $provisionPartials->update();
            }
        } else {
            $provisionPartials->end_period = $endDate;
            $provisionPartials->vacation_days = $vacationDays;
            $provisionPartials->vacations = $vacationProvisions;
            $provisionPartials->bonus_days = $bonusDays;
            $provisionPartials->bonus = $bonusProvisions;
            $provisionPartials->layoff_days = $layoffDays;
            $provisionPartials->layoffs = $layoffProvisions;
            $provisionPartials->layoff_interest = $layoffInterest;
            $provisionPartials->vacation_adjustment = $vacationAdjustment;
            $provisionPartials->update();
            if ($fortnight == 'second') {
                $provisions->vacation_days += $vacationDays;
                $provisions->vacations += $vacationProvisions;
                $provisions->bonus_days += $bonusDays;
                $provisions->bonus += $bonusProvisions;
                $provisions->layoff_days += $layoffDays;
                $provisions->layoffs += $layoffProvisions;
                $provisions->layoff_interest = $layoffInterest;
                $provisions->update();

                $provisionPartials->status = 'caused';
                $provisionPartials->update();
            }
        }

        if ($totalVacations > 0) {
            for ($i=0; $i < count($vacationType); $i++) {
                $vacationDays = $request->vacation_days[$i];
                $valueDay = $request->value_day[$i];

                $vacations = new Vacation();
                $vacations->year_month = $yearMonth;
                $vacations->start_period = $request->start_period;
                $vacations->end_period = $request->end_period;
                $vacations->start_vacations = $request->start_vacations[$i];
                $vacations->end_vacations = $request->end_vacations[$i];
                $vacations->vacation_days = $vacationDays;
                $vacations->value_day = $valueDay;
                $vacations->vacation_value = $vacationDays * $valueDay;
                $vacations->payment_mode = $request->payment_mode;
                $vacations->type = $request->$vacationType[$i];

                $vacations->payroll_acrued_id = $payrollAcrued->id;
                $vacations->payroll_partial_acrued_id = $payrollPartialAcrued->id;
                $vacations->save();

                if ($vacationType[$i] == 'enjoye') {
                    $payrollPartial->vacation_days += $request->vacationDays[$i];
                    $payrollPartial->update();
                }
            }
        }

        if ($totalBonus > 0) {
            for ($i=0; $i < count($bonusType); $i++) {
                $bonuses = new Bonus();
                $bonuses->start_period = $request->start_bonus[$i];
                $bonuses->end_period = $request->end_bonus[$i];
                $bonuses->bonus_days = $request->bonus_days[$i];
                $bonuses->bonus_value = $request->value_bonus[$i];
                $bonuses->type = $request->bonus_type[$i];

                $bonuses->payroll_acrued_id = $payrollAcrued->id;
                $bonuses->payroll_partial_acrued_id = $payrollPartialAcrued->id;
                $bonuses->save();

                if ($bonusType[$i] == 'salary') {
                    $provisions->bonus_days -= $request->bonus_days[$i];
                    $provisions->bonus -= $request->value_bonus[$i];
                    if ($provisions->bonus < 1) {
                        $date = Carbon::parse($startDate);
                        $date = $date->addDay();
                        $provisions->bonus = 0;
                        $provisions->start_period_bonus = $date;
                    }
                    $provisions->update();
                }
            }
        }

        if ($totalLayoffs > 0) {
            $layoffs = new Layoff();
            $layoffs->start_period = $request->startLayoffs;
            $layoffs->end_period = $request->endLayoffs;
            $layoffs->layoff_days = $request->layoff_days;
            $layoffs->layoff_value = $request->value_layoffs;
            $layoffs->layoff_interest = $request->value_layoffs;
            $layoffs->pay_layoffs = $request->pay_layoffs;

            $layoffs->payroll_acrued_id = $payrollAcrued->id;
            $layoffs->payroll_partial_acrued_id = $payrollPartialAcrued->id;
            $layoffs->save();

        }

        if ($totalInabilities > 0) {
            for ($i=0; $i < count($origin); $i++) {
                $totalInab = $request->inability_days[$i] * $request->value_day_inability[$i];
                $inabilities = new Inability();
                $inabilities->start_inability = $request->start_inability[$i];
                $inabilities->end_inability = $request->end_inability[$i];
                $inabilities->days_inability = $request->inability_days[$i];
                $inabilities->value_day = $request->value_day_inability[$i];
                $inabilities->total_inability = $totalInab;
                $inabilities->origin = $origin[$i];

                $inabilities->payroll_acrued_id = $payrollAcrued->id;
                $inabilities->payroll_partial_acrued_id = $payrollPartialAcrued->id;
                $inabilities->save();

                $payrollPartial->inability_days += $request->inability_days[$i];
                $payrollPartial->update();
            }
        }

        if ($totalLicenses > 0) {
            for ($i=0; $i < count($typeLicense); $i++) {
                $totalLic = $request->license_days[$i] * $request->value_day_license[$i];
                $licenses = new License();
                $licenses->start_license = $request->start_license[$i];
                $licenses->end_license = $request->end_license[$i];
                $licenses->days_license = $request->license_days[$i];
                $licenses->value_day = $request->value_day_license[$i];
                $licenses->total_license = $totalLic;
                $licenses->type_license = $typeLicense[$i];
                $licenses->type_pay = $typePay[$i];
                $licenses->note = $request->note;

                $licenses->payroll_acrued_id = $payrollAcrued->id;
                $licenses->payroll_partial_acrued_id = $payrollPartialAcrued->id;
                $licenses->save();

                $payrollPartial->license_days += $request->license_days[$i];
                $payrollPartial->update();
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
        return view('admin.payrollPartial.show', compact('payrollPartial'));
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
            ->select(
                'pro.id',
                'pro.start_period_vacations',
                'pro.vacation_days',
                'pro.vacations',

                'pro.start_period_bonus',
                'pro.bonus_days',
                'pro.bonus',

                'pro.start_period_layoffs',
                'pro.layoff_days',
                'pro.layoffs',
                'pro.layoff_interest'
            )
            ->where('pro.employee_id', $request->employee_id)
            ->first();
            if ($provisions) {
                return response()->json($provisions);
            }
        }
    }

    public function getProvPartEmp(Request $request)
    {
        if ($request->ajax()) {
            $provisionPartials = ProvisionPartial::from('provision_partials as pp')
            ->join('provisions as pro', 'pp.provision_id', 'pro.id')
            ->select(
                'pp.id',
                'pp.vacations',
                'pp.bonus',
                'pp.layoffs',
                'pp.layoff_interest',

                'pp.vacation_days',
                'pp.bonus_days',
                'pp.layoff_days',

                'pro.id as proId',
                'pro.start_period_vacations',
                'pro.vacation_days as proVacation_days',
                'pro.vacations as proVacations',

                'pro.start_period_bonus',
                'pro.bonus_days as proBonus_days',
                'pro.bonus as proBonus',

                'pro.start_period_layoffs',
                'pro.layoff_days as proLayoff_days',
                'pro.layoffs as proLayoffs',
                'pro.layoff_interest as proLayoff_interest'
            )
            ->where('pp.employee_id', $request->employee)
            ->where('pp.status', 'pendient')
            ->first();
            if ($provisionPartials) {
                return response()->json($provisionPartials);
            }
        }
    }

    public function getPayrollPartial(Request $request)
    {
        if ($request->ajax()) {
            $firstPayrollPartial = PayrollPartial::from('payroll_partials as pp')
            ->select('pp.vacation_days', 'pp.inability_days', 'pp.license_days', 'pp.days')
            ->where('pp.employee_id', $request->employee_id)
            ->where('pp.year_month', $request->yearMonth)
            ->first();

            if ($firstPayrollPartial) {
                return response()->json($firstPayrollPartial);
            }
        }
    }

    public function getCommissions(Request $request)
    {
        if ($request->ajax()) {
            $commissions = EmployeeInvoiceProduct::where('employee_id', $request->employee_id)
            ->where('status', 'pendient')
            ->sum('value_commission');

            if ($commissions) {
                return response()->json($commissions);
            }
        }
    }
}

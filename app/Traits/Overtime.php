<?php
namespace App\Traits;

use App\Models\Employee;
use App\Models\OvertimeDay;
use App\Models\OvertimeMonth;
use Carbon\Carbon;

trait Overtime {
    public function overtime($request){
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
    }
}

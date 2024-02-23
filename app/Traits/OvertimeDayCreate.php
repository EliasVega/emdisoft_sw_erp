<?php
namespace App\Traits;

use App\Models\OvertimeDay;

trait OvertimeDayCreate {
    public function overtimeDayCreate($yearMonth, $startDateTime, $endDateTime, $hours, $vhActual, $subtotal, $ovtId, $ovmId){
        //Actualiza la tabla del OvertimeDay

        $overtimeDay = new OvertimeDay();
        $overtimeDay->year_month = $yearMonth;//año y mes de liquidacion
        $overtimeDay->start_time = $startDateTime;//hora de inicio de labor
        $overtimeDay->end_time = $endDateTime;//hora teminacion de labor
        $overtimeDay->quantity = $hours;//cantidad laborada
        $overtimeDay->value_hour = $vhActual;//valor de hora segun el tipo
        $overtimeDay->subtotal = $subtotal;//cantidad por precio
        $overtimeDay->status = 'pendient';//esado de pendiente o cancelada
        $overtimeDay->overtime_type_id = $ovtId;//horas extras en la que quedo registrad
        $overtimeDay->overtime_month_id = $ovmId;//horas mensuales en la que quedo registrada
        $overtimeDay->save();
    }
}

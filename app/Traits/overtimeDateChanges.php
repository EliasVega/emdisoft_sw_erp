<?php
namespace App\Traits;

use Carbon\Carbon;

trait OvertimeDateChanges {
    public function overtimeDateChanges($variableDay, $hd, $ovtId){
        //Actualiza la fecha para la hora extra diaria
        $dateChange = [];

        if ($ovtId == 1 || $ovtId == 4 || $ovtId == 5) {
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $variableDay . '06:00:00');
        } else {
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $variableDay . '21:00:00');
        }
        $startDate1 = Carbon::parse($startDateTime);//convirtiendo fecha a carbon
        $day = date('N', strtotime($variableDay));
        if ($ovtId < 4) {
            if ($day == 7) {
                $startDateTime = $startDateTime->addDay(2);
                $startDate1 = $startDate1->addDay(2);
            } else if($day == 1){
                $startDateTime = $startDateTime->addDay(1);
                $startDate1 = $startDate1->addDay(1);
            }
        } else {
            if ($day < 7) {
                while ($day < 7) {
                    $startDateTime = $startDateTime->addDay(1);
                    $startDate1 = $startDate1->addDay(1);
                    $day++;
                }
            }
        }

        $startDate1 = $startDate1->modify($hd);
        $dateChange[0] = $startDateTime;

        $endDateTime = $startDate1->format('Y-m-d H:i:s');
        $dateChange[1] = $endDateTime;

        $variableDay = $startDateTime->format('Y-m-d');
        $variableDay = Carbon::parse($variableDay);
        $variableDay = $variableDay->addDay();
        $variableDay = $variableDay->format('Y-m-d');
        $dateChange[2] = $variableDay;
        return $dateChange;
    }
}

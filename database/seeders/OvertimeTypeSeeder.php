<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OvertimeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('overtime_types')->delete();

        DB::table('overtime_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'HED',
                'hour_type' => 'Hora Extra Diurna',
                'apply_time' => 'de 6:00 am a 9:00 pm + 25%',
                'percentage' => '25.00'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'HEN',
                'hour_type' => 'Hora Extra Nocturna',
                'apply_time' => 'de 9:00 pm a 6:00 am + 75%',
                'percentage' => '75.00'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'HRN',
                'hour_type' => 'Hora Recargo Nocturno',
                'apply_time' => 'de 9:00 pm a 6:00 am + 35%',
                'percentage' => '35.00'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'HEDDF',
                'hour_type' => 'Hora Extra Diurna Dominical y Festivos',
                'apply_time' => 'de 6:00 am a 9:00 pm + 100%',
                'percentage' => '100.00'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 'HRDDF',
                'hour_type' => 'Hora Recargo Diurno Dominical y Festivos',
                'apply_time' => 'de 6:00 am a 9:00 pm + 75%',
                'percentage' => '75.00'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'HENDF',
                'hour_type' => 'Hora Extra Nocturna Dominical y Festivos',
                'apply_time' => 'de 9:00 pm a 6:00 am + 150%',
                'percentage' => '150.00'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 'HRNDF',
                'hour_type' => 'Hora Recargo Nocturno Dominical y Festivos',
                'apply_time' => 'de 9:00 pm a 6:00 am + 110%',
                'percentage' => '110.00'
            ),
        ));
    }
}

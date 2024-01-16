<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentFrecuenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_frecuencies')->delete();

        DB::table('payment_frecuencies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '1',
                'name' => 'Semanal',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Decenal',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '3',
                'name' => 'Catorcenal',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '4',
                'name' => 'Quincenal',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '5',
                'name' => 'Mensual',
            ),
            /*
            5 =>
            array (
                'id' => 6,
                'code' => '6',
                'name' => 'otro',
            ),*/
        ));
    }
}

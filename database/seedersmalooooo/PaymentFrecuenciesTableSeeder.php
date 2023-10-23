<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentFrecuenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
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
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Decenal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '3',
                'name' => 'Catorcenal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '4',
                'name' => 'Quincenal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '5',
                'name' => 'Mensual',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*DB::table('arls')->delete();

        DB::table('arls')->insert(array (

        ));*/
        DB::table('account_classes')->delete();

        DB::table('account_classes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 1,
                'name' => 'ACTIVO',
                'total_amount' => 0
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 2,
                'name' => 'PASIVO',
                'total_amount' => 0
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 3,
                'name' => 'PATRIMONIO',
                'total_amount' => 0
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 4,
                'name' => 'INGRESOS',
                'total_amount' => 0
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 5,
                'name' => 'GASTOS',
                'total_amount' => 0
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 6,
                'name' => 'COSTOS DE VENTAS',
                'total_amount' => 0
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 7,
                'name' => 'COSTOS DE PRODUCCION O DE OPERACION',
                'total_amount' => 0
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 8,
                'name' => 'CUENTAS DE ORDEN DEUDORAS',
                'total_amount' => 0
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 9,
                'name' => 'CUENTAS DE ORDEN ACREEDORAS',
                'total_amount' => 0
            ),
        ));
    }
}

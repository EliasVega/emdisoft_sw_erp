<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PensionFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pension_funds')->delete();

        DB::table('pension_funds')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '230201',
                'name' => 'ADMINISTRADORA DE FONDOS DE PENSIONES Y CESANTIA PROTECCION SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '230301',
                'name' => 'SOCIEDAD ADMINISTRADORA DE FONDOS DE PENSIONES Y CESANTIAS PORVENIR SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '230901',
                'name' => 'OLD MUTUAL ADMINISTRADORA DE FONDOS DE PENSIONES Y CESANTIAS SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '230904',
                'name' => 'OLD MUTUAL ALTERNATIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '231001',
                'name' => 'COMPAÑIA COLOMBIANA ADMINISTRADORA DE FONDOS DE PENSIONES Y CESAN-TIAS SA COLFONDOS',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '25-14',
                'name' => 'ADMINISTRADORA COLOMBIANA DE PENSIONES – COLPENSIONES',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '25-2',
                'name' => 'CAJA DE AUXILIOS Y PRESTACIONES DE LA ASOCIACION COLOMBIANA DE AVIADO-RES CIVILES ACDAC CAXDAC',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '25-3',
                'name' => 'FONDO DE PREVISION SOCIAL DEL CONGRESO DE LA REPUBLICA FONPRECON',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '25-7',
                'name' => 'PENSIONES DE ANTIOQUIA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'RES002',
                'name' => 'ECOPETROL',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 'RES004',
                'name' => 'FONDO DE PRESTACIONES SOCIALES DEL MAGISTERIO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
        ));
    }
}

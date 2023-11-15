<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('banks')->delete();

        DB::table('banks')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'No Aplica',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Nequi',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Asopagos',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Banco Agrario',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Banco AV villas',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Banco BBVA',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Banco BCSC',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Banco Citibank',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Banco Coopcentral',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Banco Davivienda',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Banco de Bogota',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Banco de Occidente',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Banco falabella',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Banco Finandina',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Banco GNB Sudameris',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Banco Itau',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Banco Mundo Mujer',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Banco Pichincha',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Banco Popular',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Banco Credifinanciera',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Banco Fogafin',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Baocolombia',
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'otro',
            ),
        ));


    }
}

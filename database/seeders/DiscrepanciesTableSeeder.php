<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscrepanciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('discrepancies')->delete();

        DB::table('discrepancies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 1,
                'type' => 'NC',
                'description' => 'Devolución parcial de los bienes y/o no aceptación parcial del servicio',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 2,
                'type' => 'NC',
                'description' => 'Anulación de factura electrónica',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 3,
                'type' => 'NC',
                'description' => 'Rebaja o descuento parcial o total',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 4,
                'type' => 'NC',
                'description' => 'Ajuste de precio',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 5,
                'type' => 'NC',
                'description' => 'Otros',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 1,
                'type' => 'ND',
                'description' => 'Intereses',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 2,
                'type' => 'ND',
                'description' => 'Gastos por cobrar',
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 3,
                'type' => 'ND',
                'description' => 'Cambio de valor',
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 4,
                'type' => 'ND',
                'description' => 'Otros',
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TriggerMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trigger_methods')->delete();

        DB::table('trigger_methods')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'category',
                'description' => 'CATEGORIAS'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'paymentmethod',
                'description' => 'METODOS DE PAGO'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'companyTax',
                'description' => 'IMPUESTOS'
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'accounts_payable',
                'description' => 'CUENTAS POR PAGAR'
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'accounts_receivable',
                'description' => 'CUENTAS POR COBRAR'
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'discount',
                'description' => 'DESCUENTOS'
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'advances',
                'description' => 'ANTICIPOS'
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'others',
                'description' => 'OTROS'
            ),
        ));
    }
}

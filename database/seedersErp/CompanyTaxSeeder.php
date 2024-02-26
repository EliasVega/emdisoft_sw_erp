<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_taxes')->delete();

        DB::table('company_taxes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'IVA EXCENTO',
                'description' => 'productos sin iva',
                'tax_type_id' => 1,
                'percentage_id' => 44,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'IVA 19%',
                'description' => 'productos con iva del 19 %',
                'tax_type_id' => 1,
                'percentage_id' => 43,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'INC 8%',
                'description' => 'productos con impuesto al consumo',
                'tax_type_id' => 4,
                'percentage_id' => 45,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'RETERENTA 3.50%',
                'description' => 'Retencion 3.50% Compras generales (no declarantes)',
                'tax_type_id' => 6,
                'percentage_id' => 20,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'RETEIVA 15%',
                'description' => 'RETENCION IVA DE 15%',
                'tax_type_id' => 5,
                'percentage_id' => 41,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'RETEICA 0.70%',
                'description' => 'productos con iva del 0.70%',
                'tax_type_id' => 7,
                'percentage_id' => 47,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'SOBRETASA COMBUSTIBLES 0.5%',
                'description' => 'Sobretasa Combustibles 0.5%',
                'tax_type_id' => 14,
                'percentage_id' => 48,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'IC DATOS 2.00%',
                'description' => 'IC datos 2.00%',
                'tax_type_id' => 8,
                'percentage_id' => 49,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'TIBBRE 3.00%',
                'description' => 'TIBBRE 3.00%',
                'tax_type_id' => 10,
                'percentage_id' => 50,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'IC PORCENTUAL 1.70%',
                'description' => 'IC Porcentual 1.70%',
                'tax_type_id' => 16,
                'percentage_id' => 51,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'IVA 10%',
                'description' => 'productos con iva del 10 %',
                'tax_type_id' => 1,
                'percentage_id' => 52,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

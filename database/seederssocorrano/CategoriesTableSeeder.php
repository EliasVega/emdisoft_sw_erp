<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ALMUERZOS',
                'description' => 'ALMUERZOS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'CARNES',
                'description' => 'CARNES',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'DE LA REGION',
                'description' => 'DE LA REGION',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'DESAYUNOS',
                'description' => 'DESAYUNOS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'EMBUTIDOS',
                'description' => 'EMBUTIDOS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'ENTRADAS',
                'description' => 'ENTRADAS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'PASTA',
                'description' => 'PASTA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'PESCADOS',
                'description' => 'PESCADOS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'POLLO',
                'description' => 'POLLO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'PORCIONES',
                'description' => 'PORCIONES',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'TIPICOS',
                'description' => 'TIPICOS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'VERDURAS',
                'description' => 'VERDURAS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'PRODUCTO EXCENTO',
                'description' => 'COMPRA MATERIA PRIMA',
                'utility_rate' => '13.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' =>	'2023-10-20 12:00:00',
                'updated_at' =>	'2023-10-20 12:00:00'
            )
        ));
    }
}

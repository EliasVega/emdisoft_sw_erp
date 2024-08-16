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
            0=>
            array (
                'id' =>	1,
                'name' => 'Especiales',
                'description' => 'Especiales',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            1=>
            array (
                'id' =>	2,
                'name' => 'Tipicos',
                'description' => 'Tipicos',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            2=>
            array (
                'id' =>	3,
                'name' => 'Comidas Rapidas',
                'description' => 'Comidas Rapidas',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            3=>
            array (
                'id' =>	4,
                'name' => 'Otros Productos',
                'description' => 'Otros Productos',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            4=>
            array (
                'id' =>	5,
                'name' => 'Carnes',
                'description' => 'Carnes',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            5=>
            array (
                'id' =>	6,
                'name' => 'Embutidos',
                'description' => 'Embutidos',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 3,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            6=>
            array (
                'id' =>	7,
                'name' => 'Pollo',
                'description' => 'Pollo',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            7=>
            array (
                'id' =>	8,
                'name' => 'Verduras',
                'description' => 'Verduras',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            8=>
            array (
                'id' =>	9,
                'name' => 'Harinas',
                'description' => 'Harinas',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 3,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            9=>
            array (
                'id' =>	10,
                'name' => 'Legumbres',
                'description' => 'Legumbres',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            10=>
            array (
                'id' =>	11,
                'name' => 'Aderezos',
                'description' => 'Aderezos',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 4,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            11=>
            array (
                'id' =>	12,
                'name' => 'Servicios',
                'description' => 'Servicios',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            12=>
            array (
                'id' =>	13,
                'name' => 'Porciones',
                'description' => 'Porciones',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            13=>
            array (
                'id' =>	14,
                'name' => 'Huevos',
                'description' => 'Huevos',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            14=>
            array (
                'id' =>	15,
                'name' => 'Bebidas sin alcohol',
                'description' => 'Bebidas sin alcohol',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
        ));
    }
}

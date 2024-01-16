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
                'id' => 1,
                'name' => 'ASEO',
                'description' => 'ASEO',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            1=>
            array (
                'id' => 2,
                'name' => 'ASEO PERSONAL',
                'description' => 'ASEO PERSONAL',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            2=>
            array (
                'id' => 3,
                'name' => 'Abarrotes',
                'description' => 'Abarrotes',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            3=>
            array (
                'id' => 4,
                'name' => 'Bebidas',
                'description' => 'Bebidas',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            4=>
            array (
                'id' => 5,
                'name' => 'MEDICAMENTOS',
                'description' => 'MEDICAMENTOS',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            5=>
            array (
                'id' => 6,
                'name' => 'Papeleria',
                'description' => 'Papeleria',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            6=>
            array (
                'id' => 7,
                'name' => 'Desechables',
                'description' => 'Desechables',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            7=>
            array (
                'id' => 8,
                'name' => 'Snacks',
                'description' => 'Snacks',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            8=>
            array (
                'id' => 9,
                'name' => 'Lacteos',
                'description' => 'Lacteos',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            9=>
            array (
                'id' => 10,
                'name' => 'Confiteria',
                'description' => 'Confiteria',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            10=>
            array (
                'id' => 11,
                'name' => 'Granos',
                'description' => 'Granos',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            11=>
            array (
                'id' => 12,
                'name' => 'SERVICIOS',
                'description' => 'SERVICIOS',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            12=>
            array (
                'id' => 13,
                'name' => 'CARNES FRIAS',
                'description' => 'CARNES FRIAS',
                'utility_rate' => '20.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
        ));
    }
}

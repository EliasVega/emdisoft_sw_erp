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
                'name' => 'AGUA',
                'description' => 'AGUA',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'BEBIDAS',
                'description' => 'BEBIDAS',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'BISCOCHERIA',
                'description' => 'BISCOCHERIA',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 4,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'CAFETERIA',
                'description' => 'CAFETERIA',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 4,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'CERVEZA',
                'description' => 'CERVEZA',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'EMBUTIDOS',
                'description' => 'EMBUTIDOS',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'HUEVOS',
                'description' => 'HUEVOS',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'LACTEOS',
                'description' => 'LACTEOS',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'LECHE',
                'description' => 'LECHE',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'PAN',
                'description' => 'PAN',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'VARIOS',
                'description' => 'VARIOS',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'VIVERES',
                'description' => 'VIVERES',
                'utility_rate' => 0,
                'status' => 'active',
                'company_tax_id' => 3,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),

        ));


    }
}

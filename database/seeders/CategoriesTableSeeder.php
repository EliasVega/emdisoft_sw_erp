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
                'name' => 'ADITIVOS',
                'description' => 'ADITIVOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            1=>
            array (
                'id' => 2,
                'name' => 'DESENGRASANTES',
                'description' => 'DESENGRASANTES',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            2=>
            array (
                'id' => 3,
                'name' => 'FILTROS',
                'description' => 'FILTROS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            3=>
            array (
                'id' => 4,
                'name' => 'GRASAS',
                'description' => 'GRASA',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            4=>
            array (
                'id' => 5,
                'name' => 'L. FRENOS',
                'description' => 'LIQUIDO DE FRENOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            5=>
            array (
                'id' => 6,
                'name' => 'LUBRICANTES',
                'description' => 'LUBRICANTES',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            6=>
            array (
                'id' => 7,
                'name' => 'SERVICIOS',
                'description' => 'SERVICIOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),
            7=>
            array (
                'id' => 8,
                'name' => 'VARIOS',
                'description' => 'VARIOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-05-17 12:00:00',
                'updated_at' => '2024-05-17 12:00:00'
            ),

        ));


    }
}

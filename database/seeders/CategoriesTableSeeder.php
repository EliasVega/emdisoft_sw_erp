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
                'name' => 'ELECTRICOS',
                'description' => 'productos electricos',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 21:07:43',
                'updated_at' => '2024-07-23 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'FERRETERIA',
                'description' => 'Productos de Ferreteria',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 21:07:43',
                'updated_at' => '2024-07-23 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'GENERALES',
                'description' => 'Productos varios',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 21:07:43',
                'updated_at' => '2024-07-23 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'HERRAMIENTAS',
                'description' => 'Herramientas en general',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 21:07:43',
                'updated_at' => '2024-07-23 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'PINTURAS',
                'description' => 'pinturas',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 21:07:43',
                'updated_at' => '2024-07-23 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Excentos',
                'description' => 'Gastos de la empresa',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Mantenimiento',
                'description' => 'Servicio de Mantnimiento',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Mecanica',
                'description' => 'Servicio de Mecanica',
                'utility_rate' => '40.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            )
        ));


    }
}

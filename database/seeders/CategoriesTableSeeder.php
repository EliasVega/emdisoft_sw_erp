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
                'name' => 'Electricos',
                'description' => 'Todo lo relacionado con insumos electricos',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Ferreteria',
                'description' => 'Todo lo relacionado con Herramientas de Ferreteria',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Computadores',
                'description' => 'Todo lo relacionado con Computacion',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 11,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'tablet',
                'description' => 'Todo lo relacionado con tablets',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Productos gravados con INC',
                'description' => 'Gastos de la empresa',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 3,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
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
        ));


    }
}

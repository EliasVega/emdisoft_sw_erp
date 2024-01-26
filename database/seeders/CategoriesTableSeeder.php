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
                'name' => 'ACEITES',
                'description' => 'Todo lo relacionado ACEITES',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'MANTENIMIENTOS',
                'description' => 'Todo lo relacionado con mantenimientos',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'MECANICA',
                'description' => 'Todo lo relacionado con Mecanica',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 11,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'REPUESTOS',
                'description' => 'Todo lo relacionado con repuestos',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));


    }
}

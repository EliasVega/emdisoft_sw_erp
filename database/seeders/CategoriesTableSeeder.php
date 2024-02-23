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
                'name' => 'PRODUCTOS',
                'description' => 'TODO LO RELACIONADO CON REPUESTOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            1=>
            array (
                'id' => 2,
                'name' => 'SERVICIOS',
                'description' => 'TODO LO RELACIONADO CON SERVICIOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
        ));


    }
}

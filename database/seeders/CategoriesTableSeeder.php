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
                'name' => 'GENERAL EXCENTA',
                'description' => 'General',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            0 =>
            array (
                'id' => 2,
                'name' => 'GENERAL 19%',
                'description' => 'iva 19%',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));


    }
}

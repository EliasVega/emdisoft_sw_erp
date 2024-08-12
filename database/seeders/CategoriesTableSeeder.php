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
                'name' => 'VARIOS1 5% IVA',
                'description' => 'VARIOS 15% UTIL',
                'utility_rate' => 15,
                'status' => 'active',
                'company_tax_id' => 3,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            1=>
            array (
                'id' => 2,
                'name' => 'VARIOS2  19% IVA',
                'description' => 'VARIOS  20% UTIL',
                'utility_rate' => 20,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            2=>
            array (
                'id' => 3,
                'name' => 'VARIOS3 19% IVA',
                'description' => 'VARIOS 18% UTIL',
                'utility_rate' => 18,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            3=>
            array (
                'id' => 4,
                'name' => 'VARIOS4 19% IVA',
                'description' => 'VARIOS 15% UTIL',
                'utility_rate' => 15,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            4=>
            array (
                'id' => 5,
                'name' => 'VARIOS5 19% IVA',
                'description' => 'VARIOS 10% UTIL',
                'utility_rate' => 10,
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            5=>
            array (
                'id' => 6,
                'name' => 'VARIOS6 0% IVA',
                'description' => 'VARIOS',
                'utility_rate' => 15,
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),

        ));


    }
}

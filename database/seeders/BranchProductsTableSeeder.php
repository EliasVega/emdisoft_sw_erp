<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('branch_products')->delete();

        DB::table('branch_products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'stock' => 1000,
                'branch_id' => 1,
                'product_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'stock' => 1000,
                'branch_id' => 1,
                'product_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'stock' => 1000,
                'branch_id' => 1,
                'product_id' => 3,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'stock' => 1000,
                'branch_id' => 1,
                'product_id' => 4,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'stock' => 0,
                'branch_id' => 1,
                'product_id' => 5,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'stock' => 1000,
                'branch_id' => 1,
                'product_id' => 6,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'stock' => 1000,
                'branch_id' => 1,
                'product_id' => 7,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            7 =>
            array (
                'id' => 8,
                'stock' => 0,
                'branch_id' => 1,
                'product_id' => 8,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            8 =>
            array (
                'id' => 9,
                'stock' => 0,
                'branch_id' => 1,
                'product_id' => 9,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));


    }
}

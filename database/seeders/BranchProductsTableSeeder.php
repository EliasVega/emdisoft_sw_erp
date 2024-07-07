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
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 1,
                'created_at' => '2024-05-22 21:07:43',
                'updated_at' => '2024-05-22 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 2,
                'created_at' => '2024-05-22 21:07:43',
                'updated_at' => '2024-05-22 21:07:43',
            ),
        ));


    }
}

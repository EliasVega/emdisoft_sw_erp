<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RawMaterialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('raw_materials')->delete();

        \DB::table('raw_materials')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '231001',
                'name' => 'Cable cal 20',
                'price' => '2500.00',
                'stock' => '1001.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 865,
                'created_at' => '2023-10-16 11:44:58',
                'updated_at' => '2023-10-16 14:33:35',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '231002',
                'name' => 'Puntas',
                'price' => '1200.00',
                'stock' => '500.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-16 11:45:26',
                'updated_at' => '2023-10-16 14:41:11',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '231003',
                'name' => 'Terminales',
                'price' => '2000.00',
                'stock' => '500.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-16 11:46:00',
                'updated_at' => '2023-10-16 14:41:11',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '231004',
                'name' => 'Ensamble',
                'price' => '10000.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 6,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-16 11:46:35',
                'updated_at' => '2023-10-16 11:46:35',
            ),
        ));
    }
}

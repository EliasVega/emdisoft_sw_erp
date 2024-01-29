<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        DB::table('products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '786654',
                'name' => 'CAMBIO DE ACEITE',
                'price' => '0.00',
                'sale_price' => '10000.00',
                'commission' => '50.00',
                'stock' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '52062',
                'name' => 'MANTENIMIENTOD DE FRENOS',
                'price' => '0.00',
                'sale_price' => '50000.00',
                'commission' => '30.00',
                'stock' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '52063',
                'name' => 'REPARACION DE MOTOR',
                'price' => '0.00',
                'sale_price' => '360000.00',
                'commission' => '40.00',
                'stock' => 1000,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '2303',
                'name' => 'KIT PARA MOTOR AKT 150',
                'price' => '350000.00',
                'sale_price' => '495000.00',
                'commission' => '0.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

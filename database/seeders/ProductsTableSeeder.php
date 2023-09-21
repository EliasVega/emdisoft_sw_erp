<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
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
                'code' => '2301',
                'name' => 'CABLE DUPLEX #12',
                'price' => '15000.00',
                'sale_price' => '19500.00',
                'stock' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2302',
                'name' => 'Taladro Electrico MK',
                'price' => '200000.00',
                'sale_price' => '260000.00',
                'stock' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '2303',
                'name' => 'Pulidora SWITH',
                'price' => '150000.00',
                'sale_price' => '195000.00',
                'stock' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '2304',
                'name' => 'Lenovo 360',
                'price' => '1500000.00',
                'sale_price' => '1950000.00',
                'stock' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 3,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '2305',
                'name' => 'ASUS',
                'price' => '1900000.00',
                'sale_price' => '2470000.00',
                'stock' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 3,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '2306',
                'name' => 'SANSUMG',
                'price' => '1500000.00',
                'sale_price' => '1950000.00',
                'stock' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 4,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '2307',
                'name' => 'MANTENIMIENTO DE EQUIPOS DE OFICINA',
                'price' => '150000.00',
                'sale_price' => '195000.00',
                'stock' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'image' => 'noimagen.jpg',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

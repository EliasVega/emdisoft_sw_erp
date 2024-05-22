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
                'code' => '18409',
                'name' => 'CABLE BAJA DENSIDAD #20',
                'price' => '800.00',
                'sale_price' => '1000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '52062',
                'name' => 'CABLE DUPLEX #12',
                'price' => '15000.00',
                'sale_price' => '19500.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '52063',
                'name' => 'Taladro Electrico MK',
                'price' => '200000.00',
                'sale_price' => '260000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '2303',
                'name' => 'Pulidora SWITH',
                'price' => '150000.00',
                'sale_price' => '195000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '2304',
                'name' => 'Lenovo 360',
                'price' => '1500000.00',
                'sale_price' => '1950000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 3,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '2305',
                'name' => 'ASUS',
                'price' => '1900000.00',
                'sale_price' => '2470000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 3,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '2306',
                'name' => 'SANSUMG',
                'price' => '1500000.00',
                'sale_price' => '1950000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 4,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '2307',
                'name' => 'MANTENIMIENTO DE EQUIPOS DE OFICINA',
                'price' => '150000.00',
                'sale_price' => '195000.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '2308',
                'name' => 'REPARACIONES GENERALES',
                'price' => '1000.00',
                'sale_price' => '0.00',
                'commission' => '20.00',
                'stock' => 1000,
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 6,
                'measure_unit_id' => 70,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'METALES',
                'name' => 'ORO PLATA Y PLATINO',
                'price' => '100.00',
                'sale_price' => '0.00',
                'commission' => '0.00',
                'stock' => 1000,
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 7,
                'measure_unit_id' => 677,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

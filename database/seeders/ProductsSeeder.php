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
                'code' => '202401',
                'name' => 'PICADA DE LA CASA',
                'price' => '83800.00',
                'sale_price' => '120000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '202402',
                'name' => 'HAMBURGUESA DE LA CASA',
                'price' => '29500.00',
                'sale_price' => '45000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 3,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '202403',
                'name' => 'BANDEJA PAISA',
                'price' => '23800.00',
                'sale_price' => '35000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '202404',
                'name' => 'CHATAS 500 Grs',
                'price' => '29000.00',
                'sale_price' => '42000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '202405',
                'name' => 'CHURRASCO 500 Grs',
                'price' => '31000.00',
                'sale_price' => '45000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '202406',
                'name' => 'SOBREBARRIGA 500 Grs',
                'price' => '27000.00',
                'sale_price' => '39000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '202407',
                'name' => 'PECHUGA ASADA',
                'price' => '15000.00',
                'sale_price' => '21000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),

            7 =>
            array (
                'id' => 8,
                'code' => '202408',
                'name' => 'PLATO ESPECIAL TRES CARNES',
                'price' => '29250.00',
                'sale_price' => '42000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '202409',
                'name' => 'PLATO DE LA CASA',
                'price' => '20750.00',
                'sale_price' => '30000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'consumer',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '202410',
                'name' => 'GASEOSA',
                'price' => '1800.00',
                'sale_price' => '4000.00',
                'stock' => '0.00',
                'commission' => '0.00',
                'stock_min' => '0.00',
                'type_product' => 'product',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 15,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),

        ));
    }
}

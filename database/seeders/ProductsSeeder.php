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
                'code' => 'SCT',
                'name' => 'SERVICIO CONTABLE TRIMESTRAL',
                'price' => '0.00',
                'sale_price' => '3000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'SCS',
                'name' => 'SERVICIO CONTABLE SEMESTRAL',
                'price' => '0.00',
                'sale_price' => '4000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'INV',
                'name' => 'ARRENDAMIENTO PROGRAMA DE INVENTARIO',
                'price' => '0.00',
                'sale_price' => '1000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '55',
                'name' => 'HONORARIOS POR REVISION CONTABILIDAD COLEGIOS OFICIALES',
                'price' => '0.00',
                'sale_price' => '1000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '22',
                'name' => 'MANTENIMIENTO DE SOFTWARE CONTACOL',
                'price' => '0.00',
                'sale_price' => '1000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'SCG',
                'name' => 'SCG - SERVICIO CONTABLE',
                'price' => '0.00',
                'sale_price' => '1000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'id' => 6,
                'code' => 'SCA',
                'name' => 'SCA - SERVICIO CONTABLE ANUAL',
                'price' => '0.00',
                'sale_price' => '1000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
            7 =>
            array (
                'id' => 8,
                'id' => 6,
                'code' => 'SCC',
                'name' => 'SERVICIO CONTABLE DE UN CUATRIMESTRE',
                'price' => '0.00',
                'sale_price' => '1000000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-06-15 21:07:43',
                'updated_at' => '2024-06-15 21:07:43',
            ),
        ));
    }
}

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
                'name' => 'IMPLEMENTACION API DIAN - ACOMPAÑAMIENTO Y SOPORT',
                'price' => '1000.00',
                'sale_price' => '1000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-22 21:07:43',
                'updated_at' => '2024-05-22 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '202402',
                'name' => 'EMDISOFT Documentos Electrónicos | Factura Electrónica | Nómina Electrónica | Documento soporte',
                'price' => '2000.00',
                'sale_price' => '2000.00',
                'commission' => '0.00',
                'stock' => '0.00',
                'type_product' => 'service',
                'status' => 'active',
                'imageName' => 'noimage.jpg',
                'image' => '/storage/images/products/noimage.jpg',
                'category_id' => 2,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-22 21:07:43',
                'updated_at' => '2024-05-22 21:07:43',
            ),
        ));
    }
}

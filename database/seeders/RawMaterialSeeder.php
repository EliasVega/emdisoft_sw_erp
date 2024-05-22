<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('raw_materials')->delete();

        DB::table('raw_materials')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '23001',
                'name' => 'Chatas 500 Grs',
                'price' => '18000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '23002',
                'name' => 'Sobrebarriga 500 Grs',
                'price' => '16000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '23003',
                'name' => 'Churrasco 500 Grs',
                'price' => '20000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '23004',
                'name' => 'Chatas 250 Grs',
                'price' => '9000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '23005',
                'name' => 'Sobrebarriga 250 Grs',
                'price' => '8500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '23006',
                'name' => 'Churrasco 250 Grs',
                'price' => '10000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '23007',
                'name' => 'carne de hamburgues 200 Grs',
                'price' => '6000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '23008',
                'name' => 'Carne mollida 200 Grs',
                'price' => '6500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 5,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '23009',
                'name' => 'Rellenas unidades',
                'price' => '3000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 6,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '23010',
                'name' => 'Chorizo unidades',
                'price' => '3000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 6,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '23011',
                'name' => 'Jamon de cerdo 100 Grs',
                'price' => '1500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 6,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '23012',
                'name' => 'Pechuga 300 gramos',
                'price' => '4000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 7,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '23013',
                'name' => 'pechuga 150 Grs',
                'price' => '2500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 7,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '23014',
                'name' => 'Cebolla Cabezona 150 Grs',
                'price' => '800.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 8,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '23015',
                'name' => 'Pan Hamburguesa',
                'price' => '700.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 9,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '23016',
                'name' => 'Arepa Paisa unidades',
                'price' => '1000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 9,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '23017',
                'name' => 'Papa Negra 250 Grs',
                'price' => '750.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 10,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '23018',
                'name' => 'Papa Amarilla 250 Grs',
                'price' => '900.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 10,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '23019',
                'name' => 'Yuca 125 Grs',
                'price' => '800.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 10,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'code' => '23020',
                'name' => 'Aderezos unidades',
                'price' => '500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 11,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'code' => '23021',
                'name' => 'salsas sobre',
                'price' => '500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 11,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'code' => '23022',
                'name' => 'servicio preparacion Haburguesa',
                'price' => '2000.00',
                'stock' => '20.00',
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 12,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'code' => '23023',
                'name' => 'servicio preparacion carnes',
                'price' => '3000.00',
                'stock' => '20.00',
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 12,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'code' => '23024',
                'name' => 'Servicio preparacion Platos',
                'price' => '5000.00',
                'stock' => '20.00',
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 12,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'code' => '23025',
                'name' => 'Servicio de mesa',
                'price' => '2000.00',
                'stock' => '20.00',
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 12,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'code' => '23026',
                'name' => 'porcion papa frances 250 Grs',
                'price' => '5000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'code' => '23027',
                'name' => 'Patacones Unidades ',
                'price' => '2500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'code' => '23028',
                'name' => 'Frijol porcion',
                'price' => '2000.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'code' => '23029',
                'name' => 'Huevos',
                'price' => '500.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 14,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'code' => '23030',
                'name' => 'Gaseosa',
                'price' => '1800.00',
                'stock' => '20.00',
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 15,
                'measure_unit_id' => 70,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),

        ));
    }
}

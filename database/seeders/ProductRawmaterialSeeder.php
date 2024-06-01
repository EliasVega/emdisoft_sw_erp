<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductRawmaterialSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_rawmaterials')->delete();

        DB::table('product_rawmaterials')->insert(array (
            0 =>
            array (
                'id' => 1,
                'quantity' => '1.00',
                'consumer_price' => '18000.00',
                'subtotal' => '18000.00',
                'product_id' => 1,
                'raw_material_id' => 1,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'quantity' => '1.00',
                'consumer_price' => '16000.00',
                'subtotal' => '16000.00',
                'product_id' => 1,
                'raw_material_id' => 2,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'quantity' => '1.00',
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 1,
                'raw_material_id' => 3,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'quantity' => '1.00',
                'consumer_price' => '4000.00',
                'subtotal' => '4000.00',
                'product_id' => 1,
                'raw_material_id' => 12,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'quantity' => '2.00',
                'consumer_price' => '900.00',
                'subtotal' => '1800.00',
                'product_id' => 1,
                'raw_material_id' => 18,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'quantity' => '2.00',
                'consumer_price' => '3000.00',
                'subtotal' => '6000.00',
                'product_id' => 1,
                'raw_material_id' => 9,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'quantity' => '4.00',
                'consumer_price' => '3000.00',
                'subtotal' => '12000.00',
                'product_id' => 1,
                'raw_material_id' => 10,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 1,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'quantity' => '1.00',
                'consumer_price' => '3000.00',
                'subtotal' => '3000.00',
                'product_id' => 1,
                'raw_material_id' => 23,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 1,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'quantity' => '2.00',
                'consumer_price' => '6000.00',
                'subtotal' => '12000.00',
                'product_id' => 2,
                'raw_material_id' => 7,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'quantity' => '1.00',
                'consumer_price' => '2500.00',
                'subtotal' => '2500.00',
                'product_id' => 2,
                'raw_material_id' => 13,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'quantity' => '1.00',
                'consumer_price' => '700.00',
                'subtotal' => '700.00',
                'product_id' => 2,
                'raw_material_id' => 15,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'quantity' => '1.00',
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 2,
                'raw_material_id' => 26,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'quantity' => '1.00',
                'consumer_price' => '800.00',
                'subtotal' => '800.00',
                'product_id' => 2,
                'raw_material_id' => 14,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'quantity' => '1.00',
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 2,
                'raw_material_id' => 11,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 2,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'quantity' => '4.00',
                'consumer_price' => '500.00',
                'subtotal' => '2000.00',
                'product_id' => 2,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 2,
                'raw_material_id' => 22,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 2,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'quantity' => '1.00',
                'consumer_price' => '6500.00',
                'subtotal' => '6500.00',
                'product_id' => 3,
                'raw_material_id' => 8,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'quantity' => '2.00',
                'consumer_price' => '3000.00',
                'subtotal' => '6000.00',
                'product_id' => 3,
                'raw_material_id' => 10,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 3,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'quantity' => '1.00',
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 3,
                'raw_material_id' => 24,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 3,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'quantity' => '1.00',
                'consumer_price' => '500.00',
                'subtotal' => '500.00',
                'product_id' => 3,
                'raw_material_id' => 29,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'quantity' => '1.00',
                'consumer_price' => '800.00',
                'subtotal' => '800.00',
                'product_id' => 3,
                'raw_material_id' => 19,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'quantity' => '1.00',
                'consumer_price' => '2500.00',
                'subtotal' => '2500.00',
                'product_id' => 3,
                'raw_material_id' => 27,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'quantity' => '1.00',
                'consumer_price' => '1000.00',
                'subtotal' => '1000.00',
                'product_id' => 3,
                'raw_material_id' => 16,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 3,
                'raw_material_id' => 28,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            30 =>
            array (
                'id' => 31,
                'quantity' => '1.00',
                'consumer_price' => '18000.00',
                'subtotal' => '18000.00',
                'product_id' => 4,
                'raw_material_id' => 1,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            31 =>
            array (
                'id' => 32,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 4,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            32 =>
            array (
                'id' => 33,
                'quantity' => '1.00',
                'consumer_price' => '3000.00',
                'subtotal' => '3000.00',
                'product_id' => 4,
                'raw_material_id' => 23,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            33 =>
            array (
                'id' => 34,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 4,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            34 =>
            array (
                'id' => 35,
                'quantity' => '2.00',
                'consumer_price' => '5000.00',
                'subtotal' => '10000.00',
                'product_id' => 4,
                'raw_material_id' => 26,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            35 =>
            array (
                'id' => 36,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 4,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            36 =>
            array (
                'id' => 37,
                'quantity' => '1.00',
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 5,
                'raw_material_id' => 2,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            37 =>
            array (
                'id' => 38,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 5,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            38 =>
            array (
                'id' => 39,
                'quantity' => '1.00',
                'consumer_price' => '3000.00',
                'subtotal' => '3000.00',
                'product_id' => 5,
                'raw_material_id' => 23,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            39 =>
            array (
                'id' => 40,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 5,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            40 =>
            array (
                'id' => 41,
                'quantity' => '2.00',
                'consumer_price' => '5000.00',
                'subtotal' => '10000.00',
                'product_id' => 5,
                'raw_material_id' => 26,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            41 =>
            array (
                'id' => 42,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 5,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            42 =>
            array (
                'id' => 43,
                'quantity' => '1.00',
                'consumer_price' => '16000.00',
                'subtotal' => '16000.00',
                'product_id' => 6,
                'raw_material_id' => 2,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            43 =>
            array (
                'id' => 44,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 6,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            44 =>
            array (
                'id' => 45,
                'quantity' => '1.00',
                'consumer_price' => '3000.00',
                'subtotal' => '3000.00',
                'product_id' => 6,
                'raw_material_id' => 23,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            45 =>
            array (
                'id' => 46,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 6,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            46 =>
            array (
                'id' => 47,
                'quantity' => '2.00',
                'consumer_price' => '5000.00',
                'subtotal' => '10000.00',
                'product_id' => 6,
                'raw_material_id' => 26,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            47 =>
            array (
                'id' => 48,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 6,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            48 =>
            array (
                'id' => 49,
                'quantity' => '1.00',
                'consumer_price' => '4000.00',
                'subtotal' => '4000.00',
                'product_id' => 7,
                'raw_material_id' => 12,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            49 =>
            array (
                'id' => 50,
                'quantity' => '1.00',
                'consumer_price' => '500.00',
                'subtotal' => '500.00',
                'product_id' => 7,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            50 =>
            array (
                'id' => 51,
                'quantity' => '1.00',
                'consumer_price' => '3000.00',
                'subtotal' => '3000.00',
                'product_id' => 7,
                'raw_material_id' => 23,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            51 =>
            array (
                'id' => 52,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 7,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            52 =>
            array (
                'id' => 53,
                'quantity' => '1.00',
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 7,
                'raw_material_id' => 26,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            53 =>
            array (
                'id' => 54,
                'quantity' => '1.00',
                'consumer_price' => '500.00',
                'subtotal' => '500.00',
                'product_id' => 7,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            54 =>
            array (
                'id' => 55,
                'quantity' => '1.00',
                'consumer_price' => '4000.00',
                'subtotal' => '4000.00',
                'product_id' => 8,
                'raw_material_id' => 12,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            55 =>
            array (
                'id' => 56,
                'quantity' => '1.00',
                'consumer_price' => '8500.00',
                'subtotal' => '8500.00',
                'product_id' => 8,
                'raw_material_id' => 5,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            56 =>
            array (
                'id' => 57,
                'quantity' => '1.00',
                'consumer_price' => '10000.00',
                'subtotal' => '10000.00',
                'product_id' => 8,
                'raw_material_id' => 6,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            57 =>
            array (
                'id' => 58,
                'quantity' => '2.00',
                'consumer_price' => '750.00',
                'subtotal' => '1500.00',
                'product_id' => 8,
                'raw_material_id' => 17,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            58 =>
            array (
                'id' => 59,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 8,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            59 =>
            array (
                'id' => 60,
                'quantity' => '1.00',
                'consumer_price' => '3000.00',
                'subtotal' => '3000.00',
                'product_id' => 8,
                'raw_material_id' => 23,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            60 =>
            array (
                'id' => 61,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 8,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            61 =>
            array (
                'id' => 62,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 8,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            62 =>
            array (
                'id' => 63,
                'quantity' => '1.00',
                'consumer_price' => '10000.00',
                'subtotal' => '10000.00',
                'product_id' => 9,
                'raw_material_id' => 6,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            63 =>
            array (
                'id' => 64,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 9,
                'raw_material_id' => 20,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            64 =>
            array (
                'id' => 65,
                'quantity' => '1.00',
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 9,
                'raw_material_id' => 24,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            65 =>
            array (
                'id' => 66,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 9,
                'raw_material_id' => 25,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            66 =>
            array (
                'id' => 67,
                'quantity' => '2.00',
                'consumer_price' => '500.00',
                'subtotal' => '1000.00',
                'product_id' => 9,
                'raw_material_id' => 21,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            67 =>
            array (
                'id' => 68,
                'quantity' => '2.00',
                'consumer_price' => '750.00',
                'subtotal' => '1500.00',
                'product_id' => 9,
                'raw_material_id' => 17,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),
            68 =>
            array (
                'id' => 69,
                'quantity' => '1.00',
                'consumer_price' => '2000.00',
                'subtotal' => '2000.00',
                'product_id' => 9,
                'raw_material_id' => 28,
                'created_at' => '2024-05-20 12:00:00',
                'updated_at' => '2024-05-20 12:00:00'
            ),

        ));
    }
}

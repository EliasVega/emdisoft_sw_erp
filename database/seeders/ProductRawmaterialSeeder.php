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
                'quantity' => 1,
                'consumer_price' => '4000.00',
                'subtotal' => '4000.00',
                'product_id' => 2,
                'raw_material_id' => 45,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 4,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 5,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 6,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 6,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 7,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 7,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 8,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 9,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 9,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'quantity' => 1,
                'consumer_price' => '5800.00',
                'subtotal' => '5800.00',
                'product_id' => 10,
                'raw_material_id' => 23,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 11,
                'raw_material_id' => 17,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 12,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 13,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 14,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'quantity' => 1,
                'consumer_price' => '8000.00',
                'subtotal' => '8000.00',
                'product_id' => 15,
                'raw_material_id' => 13,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'quantity' => 1,
                'consumer_price' => '10500.00',
                'subtotal' => '10500.00',
                'product_id' => 18,
                'raw_material_id' => 54,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'quantity' => 1,
                'consumer_price' => '17000.00',
                'subtotal' => '17000.00',
                'product_id' => 19,
                'raw_material_id' => 55,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'quantity' => 1,
                'consumer_price' => '10500.00',
                'subtotal' => '10500.00',
                'product_id' => 20,
                'raw_material_id' => 15,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'quantity' => 1,
                'consumer_price' => '17000.00',
                'subtotal' => '17000.00',
                'product_id' => 21,
                'raw_material_id' => 16,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'quantity' => 2,
                'consumer_price' => '5100.00',
                'subtotal' => '10200.00',
                'product_id' => 22,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'quantity' => 2,
                'consumer_price' => '5100.00',
                'subtotal' => '10200.00',
                'product_id' => 23,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 23,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 24,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 25,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 26,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 27,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 28,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'quantity' => 2,
                'consumer_price' => '7600.00',
                'subtotal' => '15200.00',
                'product_id' => 29,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 30,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            30 =>
            array (
                'id' => 31,
                'quantity' => 2,
                'consumer_price' => '8000.00',
                'subtotal' => '16000.00',
                'product_id' => 31,
                'raw_material_id' => 13,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            31 =>
            array (
                'id' => 32,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 32,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            32 =>
            array (
                'id' => 33,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 33,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            33 =>
            array (
                'id' => 34,
                'quantity' => 1,
                'consumer_price' => '22000.00',
                'subtotal' => '22000.00',
                'product_id' => 34,
                'raw_material_id' => 26,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            34 =>
            array (
                'id' => 35,
                'quantity' => 2,
                'consumer_price' => '4800.00',
                'subtotal' => '9600.00',
                'product_id' => 35,
                'raw_material_id' => 25,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            35 =>
            array (
                'id' => 36,
                'quantity' => 2,
                'consumer_price' => '4800.00',
                'subtotal' => '9600.00',
                'product_id' => 36,
                'raw_material_id' => 25,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            36 =>
            array (
                'id' => 37,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 36,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            37 =>
            array (
                'id' => 38,
                'quantity' => 1,
                'consumer_price' => '4800.00',
                'subtotal' => '4800.00',
                'product_id' => 37,
                'raw_material_id' => 25,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            38 =>
            array (
                'id' => 39,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 37,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            39 =>
            array (
                'id' => 40,
                'quantity' => 2,
                'consumer_price' => '5800.00',
                'subtotal' => '11600.00',
                'product_id' => 38,
                'raw_material_id' => 23,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            40 =>
            array (
                'id' => 41,
                'quantity' => 2,
                'consumer_price' => '5800.00',
                'subtotal' => '11600.00',
                'product_id' => 39,
                'raw_material_id' => 23,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            41 =>
            array (
                'id' => 42,
                'quantity' => 2,
                'consumer_price' => '5000.00',
                'subtotal' => '10000.00',
                'product_id' => 40,
                'raw_material_id' => 5,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            42 =>
            array (
                'id' => 43,
                'quantity' => 2,
                'consumer_price' => '10700.00',
                'subtotal' => '21400.00',
                'product_id' => 41,
                'raw_material_id' => 34,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            43 =>
            array (
                'id' => 44,
                'quantity' => 1,
                'consumer_price' => '10700.00',
                'subtotal' => '10700.00',
                'product_id' => 42,
                'raw_material_id' => 34,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            44 =>
            array (
                'id' => 45,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 43,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            45 =>
            array (
                'id' => 46,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 43,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            46 =>
            array (
                'id' => 47,
                'quantity' => 1,
                'consumer_price' => '8000.00',
                'subtotal' => '8000.00',
                'product_id' => 43,
                'raw_material_id' => 13,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            47 =>
            array (
                'id' => 48,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 43,
                'raw_material_id' => 17,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            48 =>
            array (
                'id' => 49,
                'quantity' => 1,
                'consumer_price' => '6500.00',
                'subtotal' => '6500.00',
                'product_id' => 44,
                'raw_material_id' => 14,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            49 =>
            array (
                'id' => 50,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 44,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            50 =>
            array (
                'id' => 51,
                'quantity' => 1,
                'consumer_price' => '8000.00',
                'subtotal' => '8000.00',
                'product_id' => 44,
                'raw_material_id' => 13,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            51 =>
            array (
                'id' => 52,
                'quantity' => 1,
                'consumer_price' => '10700.00',
                'subtotal' => '10700.00',
                'product_id' => 45,
                'raw_material_id' => 34,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            52 =>
            array (
                'id' => 53,
                'quantity' => 1,
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 45,
                'raw_material_id' => 5,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            53 =>
            array (
                'id' => 54,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 46,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            54 =>
            array (
                'id' => 55,
                'quantity' => 1,
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 46,
                'raw_material_id' => 5,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            55 =>
            array (
                'id' => 56,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 46,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            56 =>
            array (
                'id' => 57,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 47,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            57 =>
            array (
                'id' => 58,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 47,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            58 =>
            array (
                'id' => 59,
                'quantity' => 1,
                'consumer_price' => '8000.00',
                'subtotal' => '8000.00',
                'product_id' => 47,
                'raw_material_id' => 13,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            59 =>
            array (
                'id' => 60,
                'quantity' => 1,
                'consumer_price' => '5100.00',
                'subtotal' => '5100.00',
                'product_id' => 48,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            60 =>
            array (
                'id' => 61,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 49,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            61 =>
            array (
                'id' => 62,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 50,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            62 =>
            array (
                'id' => 63,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 51,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            63 =>
            array (
                'id' => 64,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 52,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            64 =>
            array (
                'id' => 65,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 53,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            65 =>
            array (
                'id' => 66,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 54,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            66 =>
            array (
                'id' => 67,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 55,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            67 =>
            array (
                'id' => 68,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 56,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            68 =>
            array (
                'id' => 69,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 57,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            69 =>
            array (
                'id' => 70,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 58,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            70 =>
            array (
                'id' => 71,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 59,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            71 =>
            array (
                'id' => 72,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 60,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            72 =>
            array (
                'id' => 73,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 61,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            73 =>
            array (
                'id' => 74,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 62,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            74 =>
            array (
                'id' => 75,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 63,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            75 =>
            array (
                'id' => 76,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 64,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            76 =>
            array (
                'id' => 77,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 65,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            77 =>
            array (
                'id' => 78,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 66,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            78 =>
            array (
                'id' => 79,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 67,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            79 =>
            array (
                'id' => 80,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 68,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            80 =>
            array (
                'id' => 81,
                'quantity' => 2,
                'consumer_price' => '2800.00',
                'subtotal' => '5600.00',
                'product_id' => 69,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            81 =>
            array (
                'id' => 82,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 70,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            82 =>
            array (
                'id' => 83,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 71,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            83 =>
            array (
                'id' => 84,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 72,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            84 =>
            array (
                'id' => 85,
                'quantity' => 1,
                'consumer_price' => '2800.00',
                'subtotal' => '2800.00',
                'product_id' => 73,
                'raw_material_id' => 37,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            85 =>
            array (
                'id' => 86,
                'quantity' => 2,
                'consumer_price' => '4500.00',
                'subtotal' => '9000.00',
                'product_id' => 74,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            86 =>
            array (
                'id' => 87,
                'quantity' => 2,
                'consumer_price' => '1500.00',
                'subtotal' => '3000.00',
                'product_id' => 74,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            87 =>
            array (
                'id' => 88,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 75,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            88 =>
            array (
                'id' => 89,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 75,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            89 =>
            array (
                'id' => 90,
                'quantity' => 2,
                'consumer_price' => '4500.00',
                'subtotal' => '9000.00',
                'product_id' => 76,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            90 =>
            array (
                'id' => 91,
                'quantity' => 2,
                'consumer_price' => '3900.00',
                'subtotal' => '7800.00',
                'product_id' => 76,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            91 =>
            array (
                'id' => 92,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 77,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            92 =>
            array (
                'id' => 93,
                'quantity' => 2,
                'consumer_price' => '4500.00',
                'subtotal' => '9000.00',
                'product_id' => 77,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            93 =>
            array (
                'id' => 94,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 78,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            94 =>
            array (
                'id' => 95,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 78,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            95 =>
            array (
                'id' => 96,
                'quantity' => 2,
                'consumer_price' => '1500.00',
                'subtotal' => '3000.00',
                'product_id' => 79,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            96 =>
            array (
                'id' => 97,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 79,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            97 =>
            array (
                'id' => 98,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 80,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            98 =>
            array (
                'id' => 99,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 80,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            99 =>
            array (
                'id' => 100,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 80,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            100 =>
            array (
                'id' => 101,
                'quantity' => 2,
                'consumer_price' => '4500.00',
                'subtotal' => '9000.00',
                'product_id' => 81,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            101 =>
            array (
                'id' => 102,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 82,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            102 =>
            array (
                'id' => 103,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 83,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            103 =>
            array (
                'id' => 104,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 83,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            104 =>
            array (
                'id' => 105,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 83,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            105 =>
            array (
                'id' => 106,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 83,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            106 =>
            array (
                'id' => 107,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 83,
                'raw_material_id' => 56,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            107 =>
            array (
                'id' => 108,
                'quantity' => 1,
                'consumer_price' => '5100.00',
                'subtotal' => '5100.00',
                'product_id' => 83,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            108 =>
            array (
                'id' => 109,
                'quantity' => 1,
                'consumer_price' => '10700.00',
                'subtotal' => '10700.00',
                'product_id' => 84,
                'raw_material_id' => 34,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            109 =>
            array (
                'id' => 110,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 84,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            110 =>
            array (
                'id' => 111,
                'quantity' => 3,
                'consumer_price' => '1000.00',
                'subtotal' => '3000.00',
                'product_id' => 84,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            111 =>
            array (
                'id' => 112,
                'quantity' => 2,
                'consumer_price' => '3500.00',
                'subtotal' => '7000.00',
                'product_id' => 84,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            112 =>
            array (
                'id' => 113,
                'quantity' => 3,
                'consumer_price' => '1000.00',
                'subtotal' => '3000.00',
                'product_id' => 84,
                'raw_material_id' => 56,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            113 =>
            array (
                'id' => 114,
                'quantity' => 1,
                'consumer_price' => '5100.00',
                'subtotal' => '5100.00',
                'product_id' => 84,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            114 =>
            array (
                'id' => 115,
                'quantity' => 2,
                'consumer_price' => '10700.00',
                'subtotal' => '21400.00',
                'product_id' => 85,
                'raw_material_id' => 34,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            115 =>
            array (
                'id' => 116,
                'quantity' => 5,
                'consumer_price' => '1000.00',
                'subtotal' => '5000.00',
                'product_id' => 85,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            116 =>
            array (
                'id' => 117,
                'quantity' => 1,
                'consumer_price' => '10500.00',
                'subtotal' => '10500.00',
                'product_id' => 85,
                'raw_material_id' => 15,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            117 =>
            array (
                'id' => 118,
                'quantity' => 2,
                'consumer_price' => '3500.00',
                'subtotal' => '7000.00',
                'product_id' => 85,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            118 =>
            array (
                'id' => 119,
                'quantity' => 4,
                'consumer_price' => '1000.00',
                'subtotal' => '4000.00',
                'product_id' => 85,
                'raw_material_id' => 56,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            119 =>
            array (
                'id' => 120,
                'quantity' => 2,
                'consumer_price' => '5100.00',
                'subtotal' => '10200.00',
                'product_id' => 85,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            120 =>
            array (
                'id' => 121,
                'quantity' => 1,
                'consumer_price' => '5000.00',
                'subtotal' => '5000.00',
                'product_id' => 86,
                'raw_material_id' => 5,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            121 =>
            array (
                'id' => 122,
                'quantity' => 1,
                'consumer_price' => '8200.00',
                'subtotal' => '8200.00',
                'product_id' => 86,
                'raw_material_id' => 33,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            122 =>
            array (
                'id' => 123,
                'quantity' => 1,
                'consumer_price' => '5100.00',
                'subtotal' => '5100.00',
                'product_id' => 86,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            123 =>
            array (
                'id' => 124,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 87,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            124 =>
            array (
                'id' => 125,
                'quantity' => 1,
                'consumer_price' => '1000.00',
                'subtotal' => '1000.00',
                'product_id' => 88,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            125 =>
            array (
                'id' => 126,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 89,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            126 =>
            array (
                'id' => 127,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 91,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            127 =>
            array (
                'id' => 128,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 93,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            128 =>
            array (
                'id' => 129,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 94,
                'raw_material_id' => 36,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            129 =>
            array (
                'id' => 130,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 94,
                'raw_material_id' => 17,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            130 =>
            array (
                'id' => 131,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 94,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            131 =>
            array (
                'id' => 132,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 95,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            132 =>
            array (
                'id' => 133,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 95,
                'raw_material_id' => 17,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            133 =>
            array (
                'id' => 134,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 95,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            134 =>
            array (
                'id' => 135,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 96,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            135 =>
            array (
                'id' => 136,
                'quantity' => 1,
                'consumer_price' => '5100.00',
                'subtotal' => '5100.00',
                'product_id' => 96,
                'raw_material_id' => 60,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            136 =>
            array (
                'id' => 137,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 96,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            137 =>
            array (
                'id' => 138,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 97,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            138 =>
            array (
                'id' => 139,
                'quantity' => 1,
                'consumer_price' => '6500.00',
                'subtotal' => '6500.00',
                'product_id' => 97,
                'raw_material_id' => 14,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            139 =>
            array (
                'id' => 140,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 97,
                'raw_material_id' => 17,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            140 =>
            array (
                'id' => 141,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 98,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            141 =>
            array (
                'id' => 142,
                'quantity' => 2,
                'consumer_price' => '1000.00',
                'subtotal' => '2000.00',
                'product_id' => 98,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            142 =>
            array (
                'id' => 143,
                'quantity' => 1,
                'consumer_price' => '4500.00',
                'subtotal' => '4500.00',
                'product_id' => 98,
                'raw_material_id' => 17,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            143 =>
            array (
                'id' => 144,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 99,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            144 =>
            array (
                'id' => 145,
                'quantity' => 1,
                'consumer_price' => '7000.00',
                'subtotal' => '7000.00',
                'product_id' => 100,
                'raw_material_id' => 22,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            145 =>
            array (
                'id' => 146,
                'quantity' => 1,
                'consumer_price' => '7000.00',
                'subtotal' => '7000.00',
                'product_id' => 101,
                'raw_material_id' => 22,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            146 =>
            array (
                'id' => 147,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 101,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            147 =>
            array (
                'id' => 148,
                'quantity' => 1,
                'consumer_price' => '7000.00',
                'subtotal' => '7000.00',
                'product_id' => 102,
                'raw_material_id' => 22,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            148 =>
            array (
                'id' => 149,
                'quantity' => 1,
                'consumer_price' => '2600.00',
                'subtotal' => '2600.00',
                'product_id' => 102,
                'raw_material_id' => 9,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            149 =>
            array (
                'id' => 150,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 102,
                'raw_material_id' => 18,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            150 =>
            array (
                'id' => 151,
                'quantity' => 1,
                'consumer_price' => '7600.00',
                'subtotal' => '7600.00',
                'product_id' => 103,
                'raw_material_id' => 44,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            151 =>
            array (
                'id' => 152,
                'quantity' => 2,
                'consumer_price' => '7600.00',
                'subtotal' => '15200.00',
                'product_id' => 104,
                'raw_material_id' => 44,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            152 =>
            array (
                'id' => 153,
                'quantity' => 2,
                'consumer_price' => '1500.00',
                'subtotal' => '3000.00',
                'product_id' => 105,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            153 =>
            array (
                'id' => 154,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 105,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            154 =>
            array (
                'id' => 155,
                'quantity' => 2,
                'consumer_price' => '3900.00',
                'subtotal' => '7800.00',
                'product_id' => 106,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            155 =>
            array (
                'id' => 156,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 106,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            156 =>
            array (
                'id' => 157,
                'quantity' => 2,
                'consumer_price' => '1500.00',
                'subtotal' => '3000.00',
                'product_id' => 107,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            157 =>
            array (
                'id' => 158,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 107,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            158 =>
            array (
                'id' => 159,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 107,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            159 =>
            array (
                'id' => 160,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 108,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            160 =>
            array (
                'id' => 161,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 108,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            161 =>
            array (
                'id' => 162,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 109,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            162 =>
            array (
                'id' => 163,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 109,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            163 =>
            array (
                'id' => 164,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 109,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            164 =>
            array (
                'id' => 165,
                'quantity' => 2,
                'consumer_price' => '1500.00',
                'subtotal' => '3000.00',
                'product_id' => 110,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            165 =>
            array (
                'id' => 166,
                'quantity' => 2,
                'consumer_price' => '1500.00',
                'subtotal' => '3000.00',
                'product_id' => 111,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            166 =>
            array (
                'id' => 167,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 111,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            167 =>
            array (
                'id' => 168,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 112,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            168 =>
            array (
                'id' => 169,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 112,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            169 =>
            array (
                'id' => 170,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 113,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            170 =>
            array (
                'id' => 171,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 113,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            171 =>
            array (
                'id' => 172,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 113,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            172 =>
            array (
                'id' => 173,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 114,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            173 =>
            array (
                'id' => 174,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 114,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            174 =>
            array (
                'id' => 175,
                'quantity' => 1,
                'consumer_price' => '1200.00',
                'subtotal' => '1200.00',
                'product_id' => 114,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            175 =>
            array (
                'id' => 176,
                'quantity' => 1,
                'consumer_price' => '1500.00',
                'subtotal' => '1500.00',
                'product_id' => 115,
                'raw_material_id' => 40,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            176 =>
            array (
                'id' => 177,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 115,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            177 =>
            array (
                'id' => 178,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 115,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            178 =>
            array (
                'id' => 179,
                'quantity' => 1,
                'consumer_price' => '2600.00',
                'subtotal' => '2600.00',
                'product_id' => 115,
                'raw_material_id' => 9,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            179 =>
            array (
                'id' => 180,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 115,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            180 =>
            array (
                'id' => 181,
                'quantity' => 1,
                'consumer_price' => '3500.00',
                'subtotal' => '3500.00',
                'product_id' => 116,
                'raw_material_id' => 39,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            181 =>
            array (
                'id' => 182,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 116,
                'raw_material_id' => 8,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            182 =>
            array (
                'id' => 183,
                'quantity' => 1,
                'consumer_price' => '2600.00',
                'subtotal' => '2600.00',
                'product_id' => 116,
                'raw_material_id' => 9,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            183 =>
            array (
                'id' => 184,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 116,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            184 =>
            array (
                'id' => 185,
                'quantity' => 2,
                'consumer_price' => '6000.00',
                'subtotal' => '12000.00',
                'product_id' => 117,
                'raw_material_id' => 27,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            185 =>
            array (
                'id' => 186,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 117,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            186 =>
            array (
                'id' => 187,
                'quantity' => 2,
                'consumer_price' => '700.00',
                'subtotal' => '1400.00',
                'product_id' => 117,
                'raw_material_id' => 28,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            187 =>
            array (
                'id' => 188,
                'quantity' => 2,
                'consumer_price' => '800.00',
                'subtotal' => '1600.00',
                'product_id' => 117,
                'raw_material_id' => 35,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            188 =>
            array (
                'id' => 189,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 117,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            189 =>
            array (
                'id' => 190,
                'quantity' => 2,
                'consumer_price' => '1200.00',
                'subtotal' => '2400.00',
                'product_id' => 118,
                'raw_material_id' => 64,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            190 =>
            array (
                'id' => 191,
                'quantity' => 2,
                'consumer_price' => '3900.00',
                'subtotal' => '7800.00',
                'product_id' => 118,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            191 =>
            array (
                'id' => 192,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 119,
                'raw_material_id' => 4,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            192 =>
            array (
                'id' => 193,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 119,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            193 =>
            array (
                'id' => 194,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 120,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            194 =>
            array (
                'id' => 195,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 121,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            195 =>
            array (
                'id' => 196,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 121,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            196 =>
            array (
                'id' => 197,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 121,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            197 =>
            array (
                'id' => 198,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 122,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            198 =>
            array (
                'id' => 199,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 123,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            199 =>
            array (
                'id' => 200,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 124,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            200 =>
            array (
                'id' => 201,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 125,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            201 =>
            array (
                'id' => 202,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 126,
                'raw_material_id' => 29,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            202 =>
            array (
                'id' => 203,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 127,
                'raw_material_id' => 29,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            203 =>
            array (
                'id' => 204,
                'quantity' => 1,
                'consumer_price' => '17000.00',
                'subtotal' => '17000.00',
                'product_id' => 128,
                'raw_material_id' => 2,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            204 =>
            array (
                'id' => 205,
                'quantity' => 1,
                'consumer_price' => '17000.00',
                'subtotal' => '17000.00',
                'product_id' => 129,
                'raw_material_id' => 2,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            205 =>
            array (
                'id' => 206,
                'quantity' => 1,
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 130,
                'raw_material_id' => 1,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            206 =>
            array (
                'id' => 207,
                'quantity' => 1,
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 131,
                'raw_material_id' => 1,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            207 =>
            array (
                'id' => 208,
                'quantity' => 1,
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 132,
                'raw_material_id' => 1,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            208 =>
            array (
                'id' => 209,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 132,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            209 =>
            array (
                'id' => 210,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 132,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            210 =>
            array (
                'id' => 211,
                'quantity' => 1,
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 133,
                'raw_material_id' => 1,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            211 =>
            array (
                'id' => 212,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 133,
                'raw_material_id' => 4,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            212 =>
            array (
                'id' => 213,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 133,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            213 =>
            array (
                'id' => 214,
                'quantity' => 1,
                'consumer_price' => '13000.00',
                'subtotal' => '13000.00',
                'product_id' => 134,
                'raw_material_id' => 63,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            214 =>
            array (
                'id' => 215,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 135,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            215 =>
            array (
                'id' => 216,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 135,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            216 =>
            array (
                'id' => 217,
                'quantity' => 1,
                'consumer_price' => '13000.00',
                'subtotal' => '13000.00',
                'product_id' => 135,
                'raw_material_id' => 63,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            217 =>
            array (
                'id' => 218,
                'quantity' => 1,
                'consumer_price' => '13000.00',
                'subtotal' => '13000.00',
                'product_id' => 136,
                'raw_material_id' => 63,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            218 =>
            array (
                'id' => 219,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 136,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            219 =>
            array (
                'id' => 220,
                'quantity' => 1,
                'consumer_price' => '13000.00',
                'subtotal' => '13000.00',
                'product_id' => 137,
                'raw_material_id' => 63,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            220 =>
            array (
                'id' => 221,
                'quantity' => 1,
                'consumer_price' => '13000.00',
                'subtotal' => '13000.00',
                'product_id' => 138,
                'raw_material_id' => 63,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            221 =>
            array (
                'id' => 222,
                'quantity' => 1,
                'consumer_price' => '24200.00',
                'subtotal' => '24200.00',
                'product_id' => 139,
                'raw_material_id' => 59,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            222 =>
            array (
                'id' => 223,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 139,
                'raw_material_id' => 4,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            223 =>
            array (
                'id' => 224,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 139,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            224 =>
            array (
                'id' => 225,
                'quantity' => 1,
                'consumer_price' => '24200.00',
                'subtotal' => '24200.00',
                'product_id' => 140,
                'raw_material_id' => 59,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            225 =>
            array (
                'id' => 226,
                'quantity' => 1,
                'consumer_price' => '24200.00',
                'subtotal' => '24200.00',
                'product_id' => 141,
                'raw_material_id' => 59,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            226 =>
            array (
                'id' => 227,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 141,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            227 =>
            array (
                'id' => 228,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 141,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            228 =>
            array (
                'id' => 229,
                'quantity' => 1,
                'consumer_price' => '24200.00',
                'subtotal' => '24200.00',
                'product_id' => 142,
                'raw_material_id' => 59,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            229 =>
            array (
                'id' => 230,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 143,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            230 =>
            array (
                'id' => 231,
                'quantity' => 1,
                'consumer_price' => '11000.00',
                'subtotal' => '11000.00',
                'product_id' => 144,
                'raw_material_id' => 57,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            231 =>
            array (
                'id' => 232,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 144,
                'raw_material_id' => 4,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            232 =>
            array (
                'id' => 233,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 144,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            233 =>
            array (
                'id' => 234,
                'quantity' => 1,
                'consumer_price' => '5200.00',
                'subtotal' => '5200.00',
                'product_id' => 145,
                'raw_material_id' => 58,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            234 =>
            array (
                'id' => 235,
                'quantity' => 3,
                'consumer_price' => '3900.00',
                'subtotal' => '11700.00',
                'product_id' => 146,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            235 =>
            array (
                'id' => 236,
                'quantity' => 3,
                'consumer_price' => '3900.00',
                'subtotal' => '11700.00',
                'product_id' => 147,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            236 =>
            array (
                'id' => 237,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 148,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            237 =>
            array (
                'id' => 238,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 148,
                'raw_material_id' => 4,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            238 =>
            array (
                'id' => 239,
                'quantity' => 1,
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 149,
                'raw_material_id' => 1,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            239 =>
            array (
                'id' => 240,
                'quantity' => 1,
                'consumer_price' => '3900.00',
                'subtotal' => '3900.00',
                'product_id' => 149,
                'raw_material_id' => 3,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            240 =>
            array (
                'id' => 241,
                'quantity' => 1,
                'consumer_price' => '20000.00',
                'subtotal' => '20000.00',
                'product_id' => 150,
                'raw_material_id' => 1,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            241 =>
            array (
                'id' => 242,
                'quantity' => 1,
                'consumer_price' => '4200.00',
                'subtotal' => '4200.00',
                'product_id' => 151,
                'raw_material_id' => 4,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            242 =>
            array (
                'id' => 243,
                'quantity' => 1,
                'consumer_price' => '1950.00',
                'subtotal' => '1950.00',
                'product_id' => 151,
                'raw_material_id' => 7,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            243 =>
            array (
                'id' => 244,
                'quantity' => 5,
                'consumer_price' => '1000.00',
                'subtotal' => '5000.00',
                'product_id' => 152,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            244 =>
            array (
                'id' => 245,
                'quantity' => 3,
                'consumer_price' => '1000.00',
                'subtotal' => '3000.00',
                'product_id' => 153,
                'raw_material_id' => 12,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),


        ));
    }
}

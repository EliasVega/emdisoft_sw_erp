<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('branch_products')->delete();

        DB::table('branch_products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'stock' => '6231.55',
                'branch_id' => 1,
                'product_id' => 1,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'stock' => '107.90',
                'branch_id' => 1,
                'product_id' => 2,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'stock' => '94.10',
                'branch_id' => 1,
                'product_id' => 3,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'stock' => '81.60',
                'branch_id' => 1,
                'product_id' => 4,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'stock' => '45.20',
                'branch_id' => 1,
                'product_id' => 5,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'stock' => '48.00',
                'branch_id' => 1,
                'product_id' => 6,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'stock' => '1104.40',
                'branch_id' => 1,
                'product_id' => 7,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'stock' => '1022.90',
                'branch_id' => 1,
                'product_id' => 8,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'stock' => '1309.10',
                'branch_id' => 1,
                'product_id' => 9,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'stock' => '200.30',
                'branch_id' => 1,
                'product_id' => 10,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'stock' => '13.70',
                'branch_id' => 1,
                'product_id' => 11,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'stock' => '16.90',
                'branch_id' => 1,
                'product_id' => 12,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'stock' => '505.40',
                'branch_id' => 1,
                'product_id' => 13,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'stock' => '1239.90',
                'branch_id' => 1,
                'product_id' => 14,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'stock' => '71.50',
                'branch_id' => 1,
                'product_id' => 15,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 16,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'stock' => '123.00',
                'branch_id' => 1,
                'product_id' => 17,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'stock' => '1106.60',
                'branch_id' => 1,
                'product_id' => 18,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'stock' => '508.00',
                'branch_id' => 1,
                'product_id' => 19,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'stock' => '113.00',
                'branch_id' => 1,
                'product_id' => 20,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'stock' => '4154.60',
                'branch_id' => 1,
                'product_id' => 21,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'stock' => '2.00',
                'branch_id' => 1,
                'product_id' => 22,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'stock' => '1.00',
                'branch_id' => 1,
                'product_id' => 23,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'stock' => '2.00',
                'branch_id' => 1,
                'product_id' => 24,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 25,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'stock' => '1.00',
                'branch_id' => 1,
                'product_id' => 26,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 27,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 28,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'stock' => '45.60',
                'branch_id' => 1,
                'product_id' => 29,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 30,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            30 =>
            array (
                'id' => 31,
                'stock' => '1017.80',
                'branch_id' => 1,
                'product_id' => 31,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            31 =>
            array (
                'id' => 32,
                'stock' => '342.25',
                'branch_id' => 1,
                'product_id' => 32,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            32 =>
            array (
                'id' => 33,
                'stock' => '464.00',
                'branch_id' => 1,
                'product_id' => 33,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            33 =>
            array (
                'id' => 34,
                'stock' => '19.00',
                'branch_id' => 1,
                'product_id' => 34,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            34 =>
            array (
                'id' => 35,
                'stock' => '130.00',
                'branch_id' => 1,
                'product_id' => 35,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            35 =>
            array (
                'id' => 36,
                'stock' => '236.00',
                'branch_id' => 1,
                'product_id' => 36,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            36 =>
            array (
                'id' => 37,
                'stock' => '131.90',
                'branch_id' => 1,
                'product_id' => 37,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            37 =>
            array (
                'id' => 38,
                'stock' => '3.30',
                'branch_id' => 1,
                'product_id' => 38,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            38 =>
            array (
                'id' => 39,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 39,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            39 =>
            array (
                'id' => 40,
                'stock' => '38.50',
                'branch_id' => 1,
                'product_id' => 40,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            40 =>
            array (
                'id' => 41,
                'stock' => '6.30',
                'branch_id' => 1,
                'product_id' => 41,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            41 =>
            array (
                'id' => 42,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 42,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            42 =>
            array (
                'id' => 43,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 43,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            43 =>
            array (
                'id' => 44,
                'stock' => '5712.80',
                'branch_id' => 1,
                'product_id' => 44,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            44 =>
            array (
                'id' => 45,
                'stock' => '959.70',
                'branch_id' => 1,
                'product_id' => 45,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            45 =>
            array (
                'id' => 46,
                'stock' => '34.00',
                'branch_id' => 1,
                'product_id' => 46,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            46 =>
            array (
                'id' => 47,
                'stock' => '1236.05',
                'branch_id' => 1,
                'product_id' => 47,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            47 =>
            array (
                'id' => 48,
                'stock' => '3548.94',
                'branch_id' => 1,
                'product_id' => 48,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            48 =>
            array (
                'id' => 49,
                'stock' => '7404.00',
                'branch_id' => 1,
                'product_id' => 49,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            49 =>
            array (
                'id' => 50,
                'stock' => '7926.80',
                'branch_id' => 1,
                'product_id' => 50,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            50 =>
            array (
                'id' => 51,
                'stock' => '2523.32',
                'branch_id' => 1,
                'product_id' => 51,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            51 =>
            array (
                'id' => 52,
                'stock' => '1410.90',
                'branch_id' => 1,
                'product_id' => 52,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            52 =>
            array (
                'id' => 53,
                'stock' => '615.00',
                'branch_id' => 1,
                'product_id' => 53,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            53 =>
            array (
                'id' => 54,
                'stock' => '50.50',
                'branch_id' => 1,
                'product_id' => 54,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            54 =>
            array (
                'id' => 55,
                'stock' => '460.40',
                'branch_id' => 1,
                'product_id' => 55,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            55 =>
            array (
                'id' => 56,
                'stock' => '229.00',
                'branch_id' => 1,
                'product_id' => 56,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            56 =>
            array (
                'id' => 57,
                'stock' => '428.00',
                'branch_id' => 1,
                'product_id' => 57,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            57 =>
            array (
                'id' => 58,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 58,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            58 =>
            array (
                'id' => 59,
                'stock' => '42.00',
                'branch_id' => 1,
                'product_id' => 59,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            59 =>
            array (
                'id' => 60,
                'stock' => '147.00',
                'branch_id' => 1,
                'product_id' => 60,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            60 =>
            array (
                'id' => 61,
                'stock' => '4.50',
                'branch_id' => 1,
                'product_id' => 61,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            61 =>
            array (
                'id' => 62,
                'stock' => '9.00',
                'branch_id' => 1,
                'product_id' => 62,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            62 =>
            array (
                'id' => 63,
                'stock' => '90.00',
                'branch_id' => 1,
                'product_id' => 63,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            63 =>
            array (
                'id' => 64,
                'stock' => '412.55',
                'branch_id' => 1,
                'product_id' => 64,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            64 =>
            array (
                'id' => 65,
                'stock' => '154.50',
                'branch_id' => 1,
                'product_id' => 65,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            65 =>
            array (
                'id' => 66,
                'stock' => '2232.14',
                'branch_id' => 1,
                'product_id' => 66,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            66 =>
            array (
                'id' => 67,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 67,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            67 =>
            array (
                'id' => 68,
                'stock' => '1063.60',
                'branch_id' => 1,
                'product_id' => 68,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            68 =>
            array (
                'id' => 69,
                'stock' => '143.60',
                'branch_id' => 1,
                'product_id' => 69,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            69 =>
            array (
                'id' => 70,
                'stock' => '821.80',
                'branch_id' => 1,
                'product_id' => 70,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            70 =>
            array (
                'id' => 71,
                'stock' => '199.00',
                'branch_id' => 1,
                'product_id' => 71,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            71 =>
            array (
                'id' => 72,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 72,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            72 =>
            array (
                'id' => 73,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 73,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            73 =>
            array (
                'id' => 74,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 74,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            74 =>
            array (
                'id' => 75,
                'stock' => '37.00',
                'branch_id' => 1,
                'product_id' => 75,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            75 =>
            array (
                'id' => 76,
                'stock' => '30.00',
                'branch_id' => 1,
                'product_id' => 76,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            76 =>
            array (
                'id' => 77,
                'stock' => '40.00',
                'branch_id' => 1,
                'product_id' => 77,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            77 =>
            array (
                'id' => 78,
                'stock' => '995.00',
                'branch_id' => 1,
                'product_id' => 78,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            78 =>
            array (
                'id' => 79,
                'stock' => '69.90',
                'branch_id' => 1,
                'product_id' => 79,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            79 =>
            array (
                'id' => 80,
                'stock' => '31.10',
                'branch_id' => 1,
                'product_id' => 80,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            80 =>
            array (
                'id' => 81,
                'stock' => '5.70',
                'branch_id' => 1,
                'product_id' => 81,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            81 =>
            array (
                'id' => 82,
                'stock' => '6.00',
                'branch_id' => 1,
                'product_id' => 82,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            82 =>
            array (
                'id' => 83,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 83,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            83 =>
            array (
                'id' => 84,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 84,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            84 =>
            array (
                'id' => 85,
                'stock' => '600.00',
                'branch_id' => 1,
                'product_id' => 85,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            85 =>
            array (
                'id' => 86,
                'stock' => '1937.00',
                'branch_id' => 1,
                'product_id' => 86,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            86 =>
            array (
                'id' => 87,
                'stock' => '9.00',
                'branch_id' => 1,
                'product_id' => 87,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            87 =>
            array (
                'id' => 88,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 88,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            88 =>
            array (
                'id' => 89,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 89,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            89 =>
            array (
                'id' => 90,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 90,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            90 =>
            array (
                'id' => 91,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 91,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            91 =>
            array (
                'id' => 92,
                'stock' => '18.00',
                'branch_id' => 1,
                'product_id' => 92,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            92 =>
            array (
                'id' => 93,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 93,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            93 =>
            array (
                'id' => 94,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 94,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            94 =>
            array (
                'id' => 95,
                'stock' => '126.00',
                'branch_id' => 1,
                'product_id' => 95,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            95 =>
            array (
                'id' => 96,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 96,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            96 =>
            array (
                'id' => 97,
                'stock' => '263.00',
                'branch_id' => 1,
                'product_id' => 97,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            97 =>
            array (
                'id' => 98,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 98,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            98 =>
            array (
                'id' => 99,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 99,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            99 =>
            array (
                'id' => 100,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 100,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            100 =>
            array (
                'id' => 101,
                'stock' => '164.00',
                'branch_id' => 1,
                'product_id' => 101,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            101 =>
            array (
                'id' => 102,
                'stock' => '0.80',
                'branch_id' => 1,
                'product_id' => 102,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            102 =>
            array (
                'id' => 103,
                'stock' => '2.30',
                'branch_id' => 1,
                'product_id' => 103,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            103 =>
            array (
                'id' => 104,
                'stock' => '42.50',
                'branch_id' => 1,
                'product_id' => 104,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            104 =>
            array (
                'id' => 105,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 105,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            105 =>
            array (
                'id' => 106,
                'stock' => '200.00',
                'branch_id' => 1,
                'product_id' => 106,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            106 =>
            array (
                'id' => 107,
                'stock' => '92.00',
                'branch_id' => 1,
                'product_id' => 107,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            107 =>
            array (
                'id' => 108,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 108,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            108 =>
            array (
                'id' => 109,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 109,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            109 =>
            array (
                'id' => 110,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 110,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            110 =>
            array (
                'id' => 111,
                'stock' => '5.00',
                'branch_id' => 1,
                'product_id' => 111,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            111 =>
            array (
                'id' => 112,
                'stock' => '57.00',
                'branch_id' => 1,
                'product_id' => 112,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),
            112 =>
            array (
                'id' => 113,
                'stock' => '0.00',
                'branch_id' => 1,
                'product_id' => 113,
                'created_at' => '2024-07-23 12:00:00',
                'updated_at' => '2024-07-23 12:00:00'
            ),

        ));
    }
}

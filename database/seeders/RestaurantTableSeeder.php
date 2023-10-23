<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurant_tables')->delete();

        DB::table('restaurant_tables')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Domicilios',
                'branch_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '1',
                'branch_id' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '2',
                'branch_id' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '3',
                'branch_id' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => '4',
                'branch_id' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '5',
                'branch_id' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => '6',
                'branch_id' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '7',
                'branch_id' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => '8',
                'branch_id' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => '9',
                'branch_id' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => '10',
                'branch_id' => 1,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => '11',
                'branch_id' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => '12',
                'branch_id' => 1,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => '13',
                'branch_id' => 1,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => '14',
                'branch_id' => 1,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => '15',
                'branch_id' => 1,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => '16',
                'branch_id' => 1,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => '17',
                'branch_id' => 1,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => '18',
                'branch_id' => 1,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => '19',
                'branch_id' => 1,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => '20',
                'branch_id' => 1,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => '21',
                'branch_id' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => '22',
                'branch_id' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => '23',
                'branch_id' => 1,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => '24',
                'branch_id' => 1,
            ),
        ));
    }
}

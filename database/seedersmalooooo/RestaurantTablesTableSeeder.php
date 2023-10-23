<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('restaurant_tables')->delete();

        DB::table('restaurant_tables')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Domicilios',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '1',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '2',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '3',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => '4',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '5',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => '6',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '7',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => '8',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => '9',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => '10',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => '11',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => '12',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => '13',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => '14',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => '15',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => '16',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => '17',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => '18',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => '19',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => '20',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => '21',
                'branch_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('cards')->delete();

        DB::table('cards')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'No Aplica',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'VISA',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'MASTER CARD',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'AMERICAN ESPRESS',
            ),
        ));


    }
}

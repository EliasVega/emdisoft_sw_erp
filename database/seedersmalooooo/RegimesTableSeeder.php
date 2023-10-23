<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('regimes')->delete();

        DB::table('regimes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 48,
                'name' => 'Responsable de IVA',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 49,
                'name' => 'No Responsable de IVA',
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LiabilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('liabilities')->delete();

        DB::table('liabilities')->insert(array (
            0 =>
            array (
                'id' => 7,
                'code' => '0-13',
                'name' => 'Gran contribuyente',
            ),
            1 =>
            array (
                'id' => 9,
                'code' => '0-15',
                'name' => 'Autoretenedor',
            ),
            2 =>
            array (
                'id' => 14,
                'code' => '0-23',
                'name' => 'Agente de retencion IVA',
            ),
            3 =>
            array (
                'id' => 112,
                'code' => '0-47',
                'name' => 'Regimen simple de tributacion',
            ),
            4 =>
            array (
                'id' => 117,
                'code' => 'R-99-PN',
                'name' => 'No aplica - Otros',
            ),
        ));
    }
}

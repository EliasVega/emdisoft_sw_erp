<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('organizations')->delete();

        DB::table('organizations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 1,
                'name' => 'Persona Juridica y Asimiladas',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 2,
                'name' => 'Persona Natural y Asimiladas',
            ),
        ));


    }
}

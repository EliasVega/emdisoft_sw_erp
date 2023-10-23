<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChargesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('charges')->delete();

        DB::table('charges')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ADMINISTRADOR',
                'description' => 'Administrador de la empresa',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'ADMINISTRADOR DE SUCURSAL',
                'description' => 'Administrador de sucursales',
                'status' => 'active',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('providers')->delete();

        DB::table('providers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'testing',
                'identification' => '222222222222',
                'dv' => 7,
                'address' => 'direccion testing',
                'phone' => '1234567890',
                'email' => 'testing@gmail.com',
                'contact' => 'TESTING',
                'phone_contact' => '1234567890',
                'postal_code_id' => 2733,
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));


    }
}

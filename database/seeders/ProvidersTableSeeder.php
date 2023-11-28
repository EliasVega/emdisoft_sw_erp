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
                'name' => 'Proveedor pos',
                'identification' => '22222222',
                'dv' => 1,
                'address' => 'Bogota',
                'phone' => '2222222222',
                'email' => 'proveedorpos@gmail.com',
                'contact' => 'pos proveedor',
                'phone_contact' => '5555555555',
                'postal_code_id' => 461,
                'status' => 'active',
                'department_id' => 3,
                'municipality_id' => 149,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 2,
                'regime_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

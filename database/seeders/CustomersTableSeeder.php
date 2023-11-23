<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('customers')->delete();

        DB::table('customers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'CLIENTE POS',
                'identification' => '22222222',
                'dv' => '1',
                'address' => 'direccion pos',
                'phone' => '2222222222',
                'email' => 'clientepos@gmail.com',
                'credit_limit' => '0.00',
                'used' => '0.00',
                'available' => '0.00',
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'liability_id' => 117,
                'organization_id' => 2,
                'regime_id' => 2,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'RAPPI',
                'identification' => '33333333',
                'dv' => '7',
                'address' => 'rappi',
                'phone' => 'rappi',
                'email' => 'rappi@gmail.com',
                'credit_limit' => '0.00',
                'used' => '0.00',
                'available' => '0.00',
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
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

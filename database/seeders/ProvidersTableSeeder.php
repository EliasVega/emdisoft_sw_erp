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
                'name' => 'PROVEEDOR DE PRUEBA 1',
                'identification' => '223456791',
                'dv' => 5,
                'address' => 'Centro empresarial chimita bodega 14',
                'phone' => '6374581',
                'email' => 'nexans@gmail.com',
                'contact' => 'LUIS EMILIO MILLAN',
                'phone_contact' => '3174576982',
                'postal_code_id' => 2733,
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'PROVEEDOR DE PRUEVA 2',
                'identification' => '223456792',
                'dv' => 5,
                'address' => 'Centro empresarial chimita bodega 15',
                'phone' => '6374582',
                'email' => 'blackdecker@gmail.com',
                'contact' => 'LUIS ANTONIO MONROY',
                'phone_contact' => '3174576983',
                'postal_code_id' => 2733,
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'PROVEEDOR DE PRUEBA 3',
                'identification' => '323456793',
                'dv' => 5,
                'address' => 'Centro empresarial chimita bodega 16',
                'phone' => '6371582',
                'email' => 'asus@gmail.com',
                'contact' => 'FABIAN CORRALES',
                'phone_contact' => '3174486983',
                'postal_code_id' => 2733,
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'PROVEEDOR DE PRUEBA 4',
                'identification' => '323456794',
                'dv' => 5,
                'address' => 'Centro empresarial chimita bodega 17',
                'phone' => '6373982',
                'email' => 'lenovo@gmail.com',
                'contact' => 'FANNY OSORIO',
                'phone_contact' => '3174476983',
                'postal_code_id' => 2733,
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

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
                'name' => 'NEXANS COLOMBIA',
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
                'liability_id' => 1,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'BLACK&DECKER',
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
                'liability_id' => 1,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'ASUS IMPORTACIONES',
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
                'liability_id' => 1,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'LENOVO COLOMBIA',
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
                'liability_id' => 1,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'ARNULFO VALDIVIESO',
                'identification' => '91283760',
                'dv' => 4,
                'address' => 'Cr 8 28 43 apto 201 B Girardot',
                'phone' => '6330059',
                'email' => 'discom.is@gmail.com',
                'contact' => 'ELIAS VEGA',
                'phone_contact' => '3174476983',
                'postal_code_id' => 2733,
                'status' => 'active',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'liability_id' => 5,
                'organization_id' => 2,
                'regime_id' => 2,
                'created_at' => '2023-09-30 21:07:43',
                'updated_at' => '2023-09-30 21:07:43',
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('companies')->delete();

        DB::table('companies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'SOCIAL SCANDALO S.A.S.',
                'nit' => '901797137',
                'dv' => '9',
                'address' => 'CARRERA 35 # 48 - 86 BARRIO CABECERA DEL LLANO',
                'phone' => '3172591085',
                'api_token' => '25ac8f5e100fbe49c8c792c0a17512dd1ee10a23fe287d853058073dac825343',
                'email' => 'scandalobga@gmail.com',
                'emailfe' => 'scandalobga@gmail.com',
                'merchant_registration' => '05-665010-16',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 6,
                'liability_id' => 14,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2024-01-12 21:07:42',
                'updated_at' => '2024-01-12 21:07:42',
            ),
        ));


    }
}

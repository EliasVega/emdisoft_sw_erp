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
                'name' => 'VILLAMIZAR BADILLO ELIZABETH',
                'nit' => '28212991',
                'dv' => '6',
                'address' => 'CR 9 11  39 LC 132 CC COMULTRASAN',
                'phone' => '3166180079',
                'api_token' => ' 7d266fd94dcca81d4375bc182971f70c02f82e4d477e8532f0b365764683c52f',
                'email' => 'contadora.lebrija@gmail.com',
                'emailfe' => 'contadora.lebrija@gmail.com',
                'merchant_registration' => '0000.0',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 893,
                'identification_type_id' => 3,
                'liability_id' => 117,
                'organization_id' => 2,
                'regime_id' => 2,
                'created_at' => '2024-01-12 21:07:42',
                'updated_at' => '2024-01-12 21:07:42',
            ),
        ));


    }
}

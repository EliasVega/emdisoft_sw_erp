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
                'name' => 'MEDINA MENDEZ ELIZABETH',
                'nit' => '37549956',
                'dv' => '8',
                'address' => 'AV CENTRAL METROP SEC BUENO PQ TERMINAL LC 3',
                'phone' => '3134669720',
                'api_token' => 'baf65af0f81728c78b4f645fa2a4a0a5a8730e377e7a38b4de20244e251c931b',
                'email' => 'elime_802@hotmail.com',
                'emailfe' => 'elime_802@hotmail.com',
                'merchant_registration' => '000000-00',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'liability_id' => 117,
                'organization_id' => 2,
                'regime_id' => 2,
                'created_at' => '2024-05-17 21:07:42',
                'updated_at' => '2024-05-17 21:07:42',
            ),
        ));
    }
}

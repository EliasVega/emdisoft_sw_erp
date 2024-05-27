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
                'api_token' => 'd2d434be8009f8329a793842c619ee14362301ed3fb3178f899c1f47765745d1',
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

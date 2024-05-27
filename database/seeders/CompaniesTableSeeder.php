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
                'name' => 'DIAZ CASTRO LUZ MARINA',
                'nit' => '28218042',
                'dv' => '9',
                'address' => 'CR 9 11 41 LC 109 CC COMULTRASAN',
                'phone' => '3132710552',
                'api_token' => '9bac5fee2f223577c10fb772ec9c9ba45fec107d34eb456fea19ba0abe8d8da7',
                'email' => 'fmayis@hotmail.com',
                'emailfe' => 'fmayis@hotmail.com',
                'merchant_registration' => '000000-00',
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
                'created_at' => '2024-05-25 21:07:42',
                'updated_at' => '2024-05-25 21:07:42',
            ),
        ));
    }
}

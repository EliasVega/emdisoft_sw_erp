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
                'name' => 'PORRAS RIVERA KAREN TATIANA',
                'nit' => '1099375543',
                'dv' => '0',
                'address' => 'CR 9 9 42 BRR CENTRO',
                'phone' => '3154144460',
                'api_token' => '061506c876c22cbb1541b9e7bc80782aece82b712fc1b04e62b7ca133cbc2a5a',
                'email' => 'tatianaporras116@gmail.com',
                'emailfe' => 'tatianaporras116@gmail.com',
                'merchant_registration' => '000.00',
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

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
                'name' => 'MONTALVO QUINTERO LORENZO',
                'nit' => '1065576587',
                'dv' => '0',
                'address' => 'PUENTE NARIÑO CA 2 BRR BAVARIA II',
                'phone' => '3165387776',
                'api_token' => '0',
                'email' => 'lorenzomontalvo1986@gmail.com',
                'emailfe' => 'lorenzomontalvo1986@gmail.com',
                'merchant_registration' => '398681',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'liability_id' => 117,
                'organization_id' => 2,
                'regime_id' => 1,
                'created_at' => '2024-01-12 21:07:42',
                'updated_at' => '2024-01-12 21:07:42',
            ),
        ));
    }
}

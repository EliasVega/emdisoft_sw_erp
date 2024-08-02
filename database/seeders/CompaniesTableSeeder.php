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
                'name' => 'BRACHA MATZA S.A.S',
                'nit' => '901839939',
                'dv' => '0',
                'address' => 'CALLE 65 # 12W - 78 LOCAL 2 - 3 CONJUNTO TORRES DE MONTE REDONDO 2',
                'phone' => '3224599940',
                'api_token' => '076779f5817d0c2bf2ff4ae235223cc2b048cfae623563386b05919aa55a578e',
                'email' => 'oviedoraul3@gmail.com',
                'emailfe' => 'oviedoraul3@gmail.com',
                'merchant_registration' => '000.00',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2024-01-12 21:07:42',
                'updated_at' => '2024-01-12 21:07:42',
            ),
        ));


    }
}

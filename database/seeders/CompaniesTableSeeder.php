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
                'name' => 'SUB FERRETERIA CIUDAD MUTIS S.A.S. BIC',
                'nit' => '901628379',
                'dv' => '0',
                'address' => 'CALLE 56 # 3W - 04 BARRIO MUTIS',
                'phone' => '6076410927',
                'api_token' => '52d3027c9795778d20284aedb4239cb2fde07cc55b51e38ccb354e9ecf48d5cc',
                'email' => 'ciudadmutisferreteria@gmail.com',
                'emailfe' => 'ciudadmutisferreteria@gmail.com',
                'merchant_registration' => '05-628457-16',
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

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
                'name' => 'ARISMENDI ARDILA MAYA ESPERANZA',
                'nit' => '1095906123',
                'dv' => '6',
                'address' => 'CR 36 51 120 BRR CABECERRA DEL LLANO',
                'phone' => '3008370913',
                'api_token' => 'e33bfff701296fbe5c1182d7169278736f8299b9a0c250b6cffe8e782df3260e',
                'email' => 'guacamayamodaactual@gmail.com',
                'emailfe' => 'guacamayamodaactual@gmail.com',
                'merchant_registration' => '00000.00',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 881,
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

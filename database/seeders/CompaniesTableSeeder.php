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
                'name' => 'ALMEIDA BURGOS YARITZA ALEJANDRA',
                'nit' => '1005346540',
                'dv' => '3',
                'address' => 'CR 6 B PS 4 A 11 TO 5 AP 402 CONJ ALTOS DE CATALUÑA',
                'phone' => '3228834604',
                'api_token' => '41116f119bbb16a80966d114ac4a3f58ebe5a8277f1d5c3d092c4dd1e3068240',
                'email' => 'yaritzaalmeida99@gmail.com',
                'emailfe' => 'yaritzaalmeida99@gmail.com',
                'merchant_registration' => '00000.00',
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

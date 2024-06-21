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
                'name' => 'TOLOZA URIBE HERNAN',
                'nit' => '13537281',
                'dv' => '6',
                'address' => 'FCA VILLA DE LEYVA KM 26 VIA BARRANCA',
                'phone' => '3156274832',
                'api_token' => '44fbe2bb5194b0c7b5b6064c616a9cc0ab358b278e4c1d5dcf277dc6733cad5c',
                'email' => 'hernant21272@hotmail.com',
                'emailfe' => 'hernant21272@hotmail.com',
                'merchant_registration' => '000000.00',
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

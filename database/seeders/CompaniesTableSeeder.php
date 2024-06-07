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
                'name' => 'PEDRAZA GOMEZ ASESORES Y CONSULTORES S.A.S.',
                'nit' => '900812421',
                'dv' => '7',
                'address' => 'CL 6 NORTE 4 200 MZ J CA 6 CONJ JUNIN I I',
                'phone' => '3107971721',
                'api_token' => '9453760c82d5d4dfddcdd729ae5c061d16f3418317666bd2e6b235c9f1ebf1d2 ',
                'email' => 'franciscopedrazaa@gmail.com',
                'emailfe' => 'franciscopedrazaa@gmail.com',
                'merchant_registration' => '05-313639-16',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 906,
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

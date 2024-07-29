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
                'name' => 'ZAMBRANO SANTOS LUIS AURELIO',
                'nit' => '13536529',
                'dv' => '2',
                'address' => 'CL 8 6 B 53 BRR EL PESEBRE',
                'phone' => '3183797228',
                'api_token' => '12345',
                'email' => 'luiszambranosantos@hotmail.com',
                'emailfe' => 'luiszambranosantos@hotmail.com',
                'merchant_registration' => '00.00',
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
                'created_at' => '2024-07-29 21:07:42',
                'updated_at' => '2024-07-29 21:07:42',
            ),
        ));


    }
}

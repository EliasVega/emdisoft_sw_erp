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
                'name' => 'ASOCIACION DE RECUPERADORES AMBIENTALES DE OCAÑA, LA PROVINCIA Y SUR DEL CESAR',
                'nit' => '901292970',
                'dv' => '1',
                'address' => 'CA KDX 217 300',
                'phone' => '3213513501',
                'api_token' => 'db826855f16a9c134e08d07ccbf6284b8b83ec643a123392bd17b3b330b75526',
                'email' => 'asociacionarecuperar@gmail.com',
                'emailfe' => 'asociacionarecuperar@gmail.com',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 18,
                'municipality_id' => 804,
                'identification_type_id' => 6,
                'liability_id' => 117,
                'organization_id' => 1,
                'regime_id' => 1,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42',
            ),
        ));


    }
}

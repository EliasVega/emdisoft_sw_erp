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
                'name' => 'ARISMENDI MENDOZA JOSE MIGUEL',
                'nit' => '19250556',
                'dv' => '4',
                'address' => 'CL 61 17 A 60 BRR LA CEIBA',
                'phone' => '6448594',
                'api_token' => 'efc778d39a5a78b2f6829557f4d2032047148a8e1099504bb44b6cf3e86bb543',
                'email' => 'jomiarme1454@hotmail.com',
                'emailfe' => 'jomiarme1454@hotmail.com',
                'merchant_registration' => '000.00',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 21,
                'municipality_id' => 846,
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

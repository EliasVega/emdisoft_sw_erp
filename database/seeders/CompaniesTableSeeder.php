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
                'name' => 'SUAREZ PEREZ JAIRO ENRIQUE',
                'nit' => '91343991',
                'dv' => '7',
                'address' => 'Cl 59 1w 70 apto 301 mutis',
                'phone' => '3014109204',
                'api_token' => 'b8f76155bf77accadd728428917d3f4bdf8a862a78bfd32ea89f48f1fa9fdd82',
                'email' => 'comercial.ecounts@gmail.com',
                'emailfe' => 'comercial.ecounts@gmail.com',
                'merchant_registration' => '000000-00',
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
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42',
            ),
        ));


    }
}

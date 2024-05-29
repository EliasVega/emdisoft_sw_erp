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
                'name' => 'MANRIQUE GLADYS',
                'nit' => '28211716',
                'dv' => '2',
                'address' => 'CR8 11 41 LC 105 BRR CENTRO',
                'phone' => '3132710552',
                'api_token' => '2698919622848268319dd5a107ee7076766d7a481a260cb10f8d35acc11b7c94',
                'email' => 'papeleriaelite01@hotmail.com',
                'emailfe' => 'papeleriaelite01@hotmail.com',
                'merchant_registration' => '000000-00',
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
                'created_at' => '2024-05-25 21:07:42',
                'updated_at' => '2024-05-25 21:07:42',
            ),
        ));
    }
}

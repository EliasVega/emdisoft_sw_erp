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
                'name' => 'DIAZ RAMIREZ NORBERTO',
                'nit' => '91283796',
                'dv' => '9',
                'address' => 'CL 61 3 W 04 BRR MUTIS',
                'phone' => '6414355',
                'api_token' => '7cba462f1b32bd4e5534fefc264a5d48187493fb1fc71957222c8fe5abceefa4',
                'email' => 'nordiaz08@hotmail.com',
                'emailfe' => 'nordiaz08@hotmail.com',
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

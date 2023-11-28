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
                'name' => 'DANIEL ALBERTO NIÑO PEREZ',
                'nit' => '1095827596',
                'dv' => '4',
                'address' => 'CR 24 19 45',
                'phone' => '3008378625',
                'api_token' => '2ee45f3293d85c6dc2318808765bb573645861be2d4aad5424f0c557c1e4b371',
                'email' => 'daniel.dn96@hotmail.com',
                'emailfe' => 'daniel.dn96@hotmail.com',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
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

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
                'name' => 'CASTELLANOS CACERES KEVIN JULIAN',
                'nit' => '1005107863',
                'dv' => '1',
                'address' => 'CR 12 10 11 BRR VILLABEL',
                'phone' => '3194190584',
                'api_token' => '0',
                'email' => 'kevinsofiaplus@gmail.com',
                'emailfe' => 'kevinsofiaplus@gmail.com',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'department_id' => 21,
                'municipality_id' => 878,
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

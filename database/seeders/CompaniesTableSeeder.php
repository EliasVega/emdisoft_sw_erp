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
                'api_token' => 'b8f76155bf77accadd728428917d3f4bdf8a862a78bfd32ea89f48f1fa9fdd82',
                'email' => 'comercial.ecounts@gmail.com',
                'emailfe' => 'comercial.ecounts@gmail.com',
                'logo' => '/storage/images/logos/WfhqlDRtZi4xOqYprPnrLmb27vgEzV87lueju0ol.jpg',
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'liability_id' => 5,
                'organization_id' => 2,
                'regime_id' => 2,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42',
            ),
        ));


    }
}

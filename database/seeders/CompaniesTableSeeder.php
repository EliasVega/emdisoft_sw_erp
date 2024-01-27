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
                'name' => 'ESPEEDWAY MEMATOS',
                'nit' => '6716379',
                'dv' => '1',
                'address' => 'CR 3 A CL 9 A ESQ BRR EL PROGRESO',
                'phone' => '3104554739',
                'api_token' => '00',
                'email' => 'cajuva0357@hotmail.com',
                'emailfe' => 'cajuva0357@hotmail.com',
                'imageName' => 'noimage.jpg',
                'logo' => '/storage/images/logos/noimage.jpg',
                'pos_invoice' => 'POS',
                'pos_purchase' => 'POS',
                'department_id' => 27,
                'municipality_id' => 1080,
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

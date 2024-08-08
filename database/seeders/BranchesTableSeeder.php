<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->delete();

        DB::table('branches')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Principal',
                'address' => 'Calle 45 # 31-47',
                'phone' => '3008370913',
                'mobile' => '3008370913',
                'email' => 'guacamayamodaactual@gmail.com',
                'manager' => 'ARISMENDI ARDILA MAYA ESPERANZA',
                'department_id' => 21,
                'municipality_id' => 881,
                'postal_code_id' => 2850,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

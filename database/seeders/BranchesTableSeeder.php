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
                'address' => 'CR 21 99 - 27',
                'phone' => '3112689929',
                'mobile' => '3172145789',
                'email' => 'EMDISOFT@gmail.com',
                'manager' => 'ELIAS VEGA DELGADO',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Floridablanca',
                'address' => 'Calle 10 # 12-47',
                'phone' => '6706251',
                'mobile' => '3172145766',
                'email' => 'ecounts.fblanca@gmail.com',
                'manager' => 'Carlos andres perez',
                'department_id' => 21,
                'municipality_id' => 878,
                'postal_code_id' => 2757,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Giron',
                'address' => 'Calle 45 # 31-47',
                'phone' => '6706271',
                'mobile' => '3172166789',
                'email' => 'discom.principal@gmail.com',
                'manager' => 'Adriana santana',
                'department_id' => 21,
                'municipality_id' => 881,
                'postal_code_id' => 3005,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Discom Medellin',
                'address' => 'Calle 60 # 28-47',
                'phone' => '6556250',
                'mobile' => '3172485789',
                'email' => 'discom.medellin@gmail.com',
                'manager' => 'Carlos arturo sierra',
                'department_id' => 1,
                'municipality_id' => 1,
                'postal_code_id' => 1,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Discom Bogota',
                'address' => 'Calle 60 # 28-47',
                'phone' => '6556258',
                'mobile' => '3172485712',
                'email' => 'discom.bogota@gmail.com',
                'manager' => 'Carlos arturo s',
                'department_id' => 3,
                'municipality_id' => 149,
                'postal_code_id' => 461,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

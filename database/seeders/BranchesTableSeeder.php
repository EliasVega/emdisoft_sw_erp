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
                'name' => 'Arecuperar',
                'address' => 'CA KDX 217 300',
                'phone' => '3213513501',
                'mobile' => '3213513501',
                'email' => 'asociacionarecuperar@gmail.com',
                'manager' => 'PEDROZA SEPULVEDA JOSE FABIAN',
                'department_id' => 18,
                'municipality_id' => 804,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

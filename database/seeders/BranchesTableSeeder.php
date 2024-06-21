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
                'address' => 'FCA VILLA DE LEYVA KM 26 VIA BARRANCA',
                'phone' => '3156274832',
                'mobile' => '3156274832',
                'email' => 'hernant21272@hotmail.com',
                'manager' => 'TOLOZA URIBE HERNAN',
                'department_id' => 21,
                'municipality_id' => 893,
                'postal_code_id' => 3012,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

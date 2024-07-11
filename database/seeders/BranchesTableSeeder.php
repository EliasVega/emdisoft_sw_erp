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
                'address' => 'CL 12 7 40',
                'phone' => '3223574030',
                'mobile' => '3223574030',
                'email' => 'alexsaavedra@gmail.com',
                'manager' => 'SAAVEDRA SUAREZ ALEXANDER',
                'department_id' => 21,
                'municipality_id' => 915,
                'postal_code_id' => 2960,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

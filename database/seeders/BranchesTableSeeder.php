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
                'address' => 'CL 62 2 W 58 BRR MUTIS',
                'phone' => '6449174',
                'mobile' => '3178597165',
                'email' => 'libiyiya@gmail.com',
                'manager' => 'SILVA PEREZ LIBIA ELSA',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

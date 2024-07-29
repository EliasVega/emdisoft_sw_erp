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
                'address' => 'CL 8 6 B 53 BRR EL PESEBRE',
                'phone' => '3183797228',
                'mobile' => '3183797228',
                'email' => 'luiszambranosantos@hotmail.com',
                'manager' => 'ZAMBRANO SANTOS LUIS AURELIO',
                'department_id' => 21,
                'municipality_id' => 893,
                'postal_code_id' => 2883,
                'company_id' => 1,
                'created_at' => '2024-07-29 21:07:43',
                'updated_at' => '2024-07-29 21:07:43',
            ),
        ));
    }
}

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
                'name' => 'EMDISOFT',
                'address' => 'CR 21 99 27 BRR FONTANA',
                'phone' => '3168886468',
                'mobile' => '3168886468',
                'email' => 'emdisoft@gmail.com',
                'manager' => 'Elias Vega Delgado',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2024-05-22 21:07:43',
                'updated_at' => '2024-05-22 21:07:43',
            ),
        ));
    }
}

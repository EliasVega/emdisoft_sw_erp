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
                'address' => 'CR8 11 41 LC 105 BRR CENTRO',
                'phone' => '3132710552',
                'mobile' => '3132710552',
                'email' => 'papeleriaelite01@hotmail.com',
                'manager' => 'MANRIQUE GLADYS',
                'department_id' => 21,
                'municipality_id' => 893,
                'postal_code_id' => 3012,
                'company_id' => 1,
                'created_at' => '2024-05-25 21:07:43',
                'updated_at' => '2024-05-25 21:07:43',
            )
        ));
    }
}

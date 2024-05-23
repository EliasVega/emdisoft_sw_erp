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
                'address' => 'AV CENTRAL METROP SEC BUENO PQ TERMINAL LC 3',
                'phone' => '3134669720',
                'mobile' => '3134669720',
                'email' => 'elime_802@hotmail.com',
                'manager' => 'MEDINA MENDEZ ELIZABETH',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2024-05-17 21:07:43',
                'updated_at' => '2024-05-17 21:07:43',
            ),
        ));
    }
}

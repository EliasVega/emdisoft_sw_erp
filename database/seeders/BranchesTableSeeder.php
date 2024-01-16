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
                'name' => 'DELIMARKET KC',
                'address' => 'CR 12 10 11 BRR VILLABEL',
                'phone' => '3194190584',
                'mobile' => '3194190584',
                'email' => 'kevinsofiaplus@gmail.com',
                'manager' => 'CASTELLANOS CACERES KEVIN JULIAN',
                'department_id' => 21,
                'municipality_id' => 878,
                'company_id' => 1,
                'created_at' => '2024-01-12 21:07:43',
                'updated_at' => '2024-01-12 21:07:43',
            ),
        ));
    }
}

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
                'address' => 'CR 9 12 21 BRR CENTRO',
                'phone' => '3162393939',
                'mobile' => '3162393939',
                'email' => 'willibup@hotmail.com',
                'manager' => 'VILLARREAL WILLIAN',
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

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('software')->delete();

        DB::table('software')->insert(array (
            0 =>
            array (
                'id' => 1,
                'company_id' => 1,
                'identifier' =>'2b29c5fc-5034-468a-9f7e-b5196ffc52e5',
                'pin' => '98345',
                'test_set' => '21d4744a-19f9-4fbb-a611-50830d61f580',
                'identifier_payroll' => '5a6e8524-ce6b-4bb4-813e-5e6d5bdcc859',
                'pin_payroll' => '98345',
                'payroll_test_set' => '72739264-177c-4d3d-8424-7ecd282a5b66',
                'identifier_equidoc' => null,
                'pin_equidoc' => null,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

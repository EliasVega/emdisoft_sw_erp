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
                'identifier' => '57df3d38-7855-4185-918e-2fd0fe6d9aa7',
                'pin' => '98345',
                'test_set' => '43f235df-0443-4b15-b584-d3021d5807ca',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => '0',
                'pin_equidoc' => '97345',
                'equidoc_test_set' => '0',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

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
                'identifier' => 'b5780d1e-7c1f-4c8d-8edb-0af46a63df1e',
                'pin' => 98345,
                'test_set' => 'c8eb711d-ac3e-4bc6-828b-372cf2f39a2e',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => null,
                'pin_equidoc' => null,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

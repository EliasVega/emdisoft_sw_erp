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
                'identifier' => '891d4280-8c47-4fad-aaa5-6e0caa8f80ac',
                'pin' => 98345,
                'test_set' => '22ff9d7a-b203-41b3-92f7-cd9ff084e4af',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => null,
                'pin_equidoc' => null,
                'created_at' => '2024-07-01 00:00:00',
                'updated_at' => '2024-07-01 00:00:00'
            ),
        ));
    }
}

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
                'identifier' => '9f7a1bb6-c626-4963-a54f-c61b48603a1d',
                'pin' => '98345',
                'test_set' => 'c44e99ec-3b77-4c6f-9f8b-c38c1c5e96be',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => null,
                'pin_equidoc' => null,
                'equidoc_test_set' => null,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

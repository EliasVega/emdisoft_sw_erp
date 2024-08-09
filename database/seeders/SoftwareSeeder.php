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
                'identifier' => '7438bfa5-1990-4f83-a80f-d412fb3fe427',
                'pin' => '98345',
                'test_set' => '8669e5aa-133e-41b2-9aa3-e5ea7ab32017',
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

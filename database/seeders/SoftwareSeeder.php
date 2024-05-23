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
                'identifier' => '9fab368d-6132-4941-a6ee-73cb681e66f0',
                'pin' => '98345',
                'test_set' => '1ced058a-d57b-45f1-8294-beccfc422c3d',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => null,
                'pin_equidoc' => null,
                'created_at' => '2024-05-17 00:00:00',
                'updated_at' => '2024-01-17 00:00:00'
            ),
        ));
    }
}

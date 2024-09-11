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
                'identifier' => '2b17397b-ec5c-424e-a746-25edde2ce8a7',
                'pin' => '98345',
                'test_set' => '2505f845-53f3-4065-b986-90c400a7b3e4',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => 'a85a8b6c-9aae-40d2-8349-039653a9a8bb',
                'pin_equidoc' => '97345',
                'equidoc_test_set' => 'a0843e8f-281f-4460-94fb-877f54fddd40',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

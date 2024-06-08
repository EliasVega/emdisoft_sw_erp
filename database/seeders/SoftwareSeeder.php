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
                'identifier' => '11a4ee46-5b46-4537-9621-3ca8b3f60978',
                'pin' => '98345',
                'test_set' => '5b2c9bdc-7d5f-4585-a049-fd9b64503bd9',
                'identifier_payroll' => 'f16d25d4-84b6-4908-94f4-aa71a1074b9a',
                'pin_payroll' => '98345',
                'payroll_test_set' => '85808b67-4ba5-40d7-b8c9-9d9a1636e6cb',
                'identifier_equidoc' => '2570c955-56a9-4a73-a51d-ecce8aedd407',
                'pin_equidoc' => '98345',
                'equidoc_test_set' => 'cc480198-1104-4817-afc1-c249cf7f02bc',
                'created_at' => '2024-05-17 00:00:00',
                'updated_at' => '2024-01-17 00:00:00'
            ),
        ));
    }
}

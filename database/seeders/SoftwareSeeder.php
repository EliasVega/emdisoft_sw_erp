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
                'identifier' => '6027c43b-ea03-49f0-8fee-e63debf72110',
                'pin' => '98345',
                'test_set' => '8e873761-b248-4af7-bee0-576d16ee5263',
                'identifier_payroll' => null,
                'pin_payroll' => null,
                'payroll_test_set' => null,
                'identifier_equidoc' => 'a6b76816-eac8-4bb1-a2ee-4a7f41c4961f',
                'pin_equidoc' => '97345',
                'equidoc_test_set' => '934ed921-b514-4a3d-b4b0-e698aa546a8c',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

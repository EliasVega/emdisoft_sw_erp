<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurations')->delete();

        DB::table('configurations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'company_id' => 1,
                'ip' => '144.126.135.31:81',
                'creator_name' => 'ELIAS VEGA DELGADO',
                'company_name' => 'EMDISOFT S.A.S.',
                'software_name' => 'ekounterERP',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ),
        ));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('certificates')->delete();

        DB::table('certificates')->insert(array (
            0 =>
            array (
                'id' => 1,
                'company_id' => 1,
                'file' => null,
                'password' => null,
                'expiration_date' => null,
            ),
        ));
    }
}

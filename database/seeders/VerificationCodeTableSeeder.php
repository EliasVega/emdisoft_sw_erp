<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerificationCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('verification_codes')->delete();

        DB::table('verification_codes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'code' => 'emdisoft2024',
                'created_at' => '2024-01-01 21:07:43',
                'updated_at' => '2023-01-01 21:07:43'
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 2,
                'code' => '901286970',
                'created_at' => '2024-01-12 21:07:43',
                'updated_at' => '2024-01-12 21:07:43'
            ),
        ));
    }
}

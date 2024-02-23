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
                'created_at' => '2024-02-20 21:07:43',
                'updated_at' => '2024-02-20 21:07:43'
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 2,
                'code' => '6716379',
                'created_at' => '2024-02-20 21:07:43',
                'updated_at' => '2024-02-20 21:07:43'
            ),
        ));
    }
}

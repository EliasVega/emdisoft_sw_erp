<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_homes')->delete();

        DB::table('customer_homes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'CLIENTE INDEFINIDO',
                'address' => 'DIRECCION POS',
                'phone' => '31655554488',
            ),
        ));
    }
}

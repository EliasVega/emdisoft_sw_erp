<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('operation_types')->delete();

        DB::table('operation_types')->insert(array (
            //$table->enum('movement', ['trigger', 'inventory', 'cost', 'refund', 'entry'])->default('trigger');
            0 =>
            array (
                'id' => 1,
                'name' => 'multiple',
                'description' => 'MULTIPLES'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'purchases',
                'description' => 'COMPRAS'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'sales',
                'description' => 'VENTAS'
            ),
        ));
    }
}

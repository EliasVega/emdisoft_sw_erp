<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movement_types')->delete();

        DB::table('movement_types')->insert(array (
            //$table->enum('movement', ['trigger', 'inventory', 'cost', 'refund', 'entry'])->default('trigger');
            0 =>
            array (
                'id' => 1,
                'name' => 'trigger',
                'description' => 'TRIGGERS'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'inventory',
                'description' => 'INVENTARIOS'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'cost',
                'description' => 'COSTO DE VENTAS'
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'refund',
                'description' => 'DEVOLUCIONES'
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'entry',
                'description' => 'INGRESOS'
            ),
        ));
    }
}

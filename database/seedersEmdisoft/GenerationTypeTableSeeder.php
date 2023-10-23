<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('generation_types')->delete();

        DB::table('generation_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'Por operación',
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Acumulado semanal',
            ),
        ));
    }
}

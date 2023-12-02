<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contrat_types')->delete();

        DB::table('contrat_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '1',
                'name' => 'Término Fijo',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Término Indefinido',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '3',
                'name' => 'Obra o Labor',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '4',
                'name' => 'Aprendizaje',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '5',
                'name' => 'Prácticas o Pasantías',
            ),
        ));
    }
}

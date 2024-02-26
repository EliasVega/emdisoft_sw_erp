<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('arls')->delete();

        DB::table('arls')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '14-17',
                'name' => 'SEGUROS DE VIDA ALFA SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '14-18',
                'name' => 'LIBERTY SEGUROS DE VIDA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '14-23',
                'name' => 'POSITIVA COMPAÑIA DE SEGUROS',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '14-25',
                'name' => 'RIESGOS PROFESIONALES COLMENA SA COMPAÑIA DE SEGUROS DE VIDA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '14-28',
                'name' => 'ARP SURA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '14-29',
                'name' => 'LA EQUIDAD SEGUROS DE VIDA ORGANISMO COOPERATIVO LA EQUIDAD VIDA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '14-30',
                'name' => 'MAPFRE COLOMBIA VIDA SEGUROS SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '14-4',
                'name' => 'SEGUROS DE VIDA COLPATRIA SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '14-7',
                'name' => 'CIA DE SEGUROS BOLIVAR SA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '14-8',
                'name' => 'COMPAÑIA DE SEGUROS DE VIDA AURORA',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
        ));
    }
}

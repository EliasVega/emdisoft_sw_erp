<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('departments')->delete();

        DB::table('departments')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ANTIOQUIA',
                'dane_code' => '05',
                'iso_code' => 'ANT',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'ATLANTICO',
                'dane_code' => '08',
                'iso_code' => 'ATL',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'BOGOTA',
                'dane_code' => '11',
                'iso_code' => 'DC',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'BOLIVAR',
                'dane_code' => '13',
                'iso_code' => 'BOL',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'BOYACA',
                'dane_code' => '15',
                'iso_code' => 'BOY',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'CALDAS',
                'dane_code' => '17',
                'iso_code' => 'CAL',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'CAQUETA',
                'dane_code' => '18',
                'iso_code' => 'CAQ',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'CAUCA',
                'dane_code' => '19',
                'iso_code' => 'CAU',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'CESAR',
                'dane_code' => '20',
                'iso_code' => 'CES',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'CORDOBA',
                'dane_code' => '23',
                'iso_code' => 'COR',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'CUNDINAMARCA',
                'dane_code' => '25',
                'iso_code' => 'CUN',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'CHOCO',
                'dane_code' => '27',
                'iso_code' => 'CHO',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'HUILA',
                'dane_code' => '41',
                'iso_code' => 'HUI',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'LA GUAJIRA',
                'dane_code' => '44',
                'iso_code' => 'LAG',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'MAGDALENA',
                'dane_code' => '47',
                'iso_code' => 'MAG',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'META',
                'dane_code' => '50',
                'iso_code' => 'MET',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'NARIÑO',
                'dane_code' => '52',
                'iso_code' => 'NAR',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'NORTE DE SANTANDER',
                'dane_code' => '54',
                'iso_code' => 'NSA',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'QUINDIO',
                'dane_code' => '63',
                'iso_code' => 'QUI',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'RISARALDA',
                'dane_code' => '66',
                'iso_code' => 'RIS',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'SANTANDER',
                'dane_code' => '68',
                'iso_code' => 'SAN',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'SUCRE',
                'dane_code' => '70',
                'iso_code' => 'SUC',
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'TOLIMA',
                'dane_code' => '73',
                'iso_code' => 'TOL',
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'VALLE DEL CAUCA',
                'dane_code' => '76',
                'iso_code' => 'CAC',
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'ARAUCA',
                'dane_code' => '81',
                'iso_code' => 'ARA',
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'CASANARE',
                'dane_code' => '85',
                'iso_code' => 'CAS',
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'PUTUMAYO',
                'dane_code' => '86',
                'iso_code' => 'PUT',
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'SAN ANDRES Y PROVIDENCIA',
                'dane_code' => '88',
                'iso_code' => 'SAP',
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'AMAZONAS',
                'dane_code' => '91',
                'iso_code' => 'AMA',
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'GUAINIA',
                'dane_code' => '94',
                'iso_code' => 'GUA',
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'GUAVIARE',
                'dane_code' => '95',
                'iso_code' => 'GUV',
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'VAUPES',
                'dane_code' => '97',
                'iso_code' => 'VAU',
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'VICHADA',
                'dane_code' => '99',
                'iso_code' => 'VID',
            ),
        ));


    }
}

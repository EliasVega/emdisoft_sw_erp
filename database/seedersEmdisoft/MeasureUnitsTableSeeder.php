<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasureUnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('measure_units')->delete();

        DB::table('measure_units')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'spray pequeño',
                'code' => '04',
                'status' => 'inactive',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'levantar',
                'code' => '05',
                'status' => 'inactive',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Lote calor',
                'code' => '08',
                'status' => 'inactive',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'grupo',
                'code' => '10',
                'status' => 'inactive',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'equipar',
                'code' => '11',
                'status' => 'inactive',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'ración',
                'code' => '13',
                'status' => 'inactive',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Disparo',
                'code' => '14',
                'status' => 'inactive',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'palo',
                'code' => '15',
                'status' => 'inactive',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'tambor de ciento quince kg',
                'code' => '16',
                'status' => 'inactive',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'tambor de cien libras',
                'code' => '17',
                'status' => 'inactive',
            ),
            10 =>
            array (
                'id' => 11,
            'name' => 'tambor de cincuenta y cinco galones (US)',
                'code' => '18',
                'status' => 'inactive',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'camión cisterna',
                'code' => '19',
                'status' => 'inactive',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'contenedor de veinte pies',
                'code' => '20',
                'status' => 'inactive',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'contenedor de cuarenta pies',
                'code' => '21',
                'status' => 'inactive',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'decilitro por gramo',
                'code' => '22',
                'status' => 'inactive',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'gramo por centímetro cúbico',
                'code' => '23',
                'status' => 'inactive',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'libra teórica',
                'code' => '24',
                'status' => 'inactive',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'gramo por centímetro cuadrado',
                'code' => '25',
                'status' => 'inactive',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'tonelada real',
                'code' => '26',
                'status' => 'inactive',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'tonelada teórica',
                'code' => '27',
                'status' => 'inactive',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'kilogramo por metro cuadrado',
                'code' => '28',
                'status' => 'inactive',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'libra por mil pies cuadrados',
                'code' => '29',
                'status' => 'inactive',
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Día de potencia del caballo por tonelada métrica seca al aire.',
                'code' => '30',
                'status' => 'inactive',
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'coger peso',
                'code' => '31',
                'status' => 'inactive',
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'kilogramo por aire seco tonelada métrica',
                'code' => '32',
                'status' => 'inactive',
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'kilopascales metros cuadrados por gramo',
                'code' => '33',
                'status' => 'inactive',
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'kilopascales por milímetro',
                'code' => '34',
                'status' => 'inactive',
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'mililitros por centímetro cuadrado segundo',
                'code' => '35',
                'status' => 'inactive',
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'pies cúbicos por minuto por pie cuadrado',
                'code' => '36',
                'status' => 'inactive',
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'onza por pie cuadrado',
                'code' => '37',
                'status' => 'inactive',
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'onzas por pie cuadrado por 0,01 pulgadas',
                'code' => '38',
                'status' => 'inactive',
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'mililitro por segundo',
                'code' => '40',
                'status' => 'inactive',
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'mililitro por minuto',
                'code' => '41',
                'status' => 'inactive',
            ),
            33 =>
            array (
                'id' => 34,
                'name' => 'bolsa súper a granel',
                'code' => '43',
                'status' => 'inactive',
            ),
            34 =>
            array (
                'id' => 35,
                'name' => 'bolsa a granel de quinientos kg',
                'code' => '44',
                'status' => 'inactive',
            ),
            35 =>
            array (
                'id' => 36,
                'name' => 'bolsa a granel de trescientos kg',
                'code' => '45',
                'status' => 'inactive',
            ),
            36 =>
            array (
                'id' => 37,
                'name' => 'bolsa a granel de cincuenta libras',
                'code' => '46',
                'status' => 'inactive',
            ),
            37 =>
            array (
                'id' => 38,
                'name' => 'bolsa de cincuenta libras',
                'code' => '47',
                'status' => 'inactive',
            ),
            38 =>
            array (
                'id' => 39,
                'name' => 'carga de automóviles a granel',
                'code' => '48',
                'status' => 'inactive',
            ),
            39 =>
            array (
                'id' => 40,
                'name' => 'kilogramos teóricos',
                'code' => '53',
                'status' => 'inactive',
            ),
            40 =>
            array (
                'id' => 41,
                'name' => 'tonelada teórica',
                'code' => '54',
                'status' => 'inactive',
            ),
            41 =>
            array (
                'id' => 42,
                'name' => 'sitas',
                'code' => '56',
                'status' => 'inactive',
            ),
            42 =>
            array (
                'id' => 43,
                'name' => 'malla',
                'code' => '57',
                'status' => 'inactive',
            ),
            43 =>
            array (
                'id' => 44,
                'name' => 'kilogramo neto',
                'code' => '58',
                'status' => 'inactive',
            ),
            44 =>
            array (
                'id' => 45,
                'name' => 'parte por millón',
                'code' => '59',
                'status' => 'inactive',
            ),
            45 =>
            array (
                'id' => 46,
                'name' => 'porcentaje de peso',
                'code' => '60',
                'status' => 'inactive',
            ),
            46 =>
            array (
                'id' => 47,
            'name' => 'parte por billón (US)',
                'code' => '61',
                'status' => 'inactive',
            ),
            47 =>
            array (
                'id' => 48,
                'name' => 'porcentaje por 1000 horas',
                'code' => '62',
                'status' => 'inactive',
            ),
            48 =>
            array (
                'id' => 49,
                'name' => 'tasa de fracaso en el tiempo',
                'code' => '63',
                'status' => 'inactive',
            ),
            49 =>
            array (
                'id' => 50,
                'name' => 'libra por pulgada cuadrada calibre',
                'code' => '64',
                'status' => 'inactive',
            ),
            50 =>
            array (
                'id' => 51,
                'name' => 'Oersted',
                'code' => '66',
                'status' => 'inactive',
            ),
            51 =>
            array (
                'id' => 52,
                'name' => 'prueba de escala específica',
                'code' => '69',
                'status' => 'inactive',
            ),
            52 =>
            array (
                'id' => 53,
                'name' => 'voltio amperio por libra',
                'code' => '71',
                'status' => 'inactive',
            ),
            53 =>
            array (
                'id' => 54,
                'name' => 'vatio por libra',
                'code' => '72',
                'status' => 'inactive',
            ),
            54 =>
            array (
                'id' => 55,
                'name' => 'amperio tum por centímetro',
                'code' => '73',
                'status' => 'inactive',
            ),
            55 =>
            array (
                'id' => 56,
                'name' => 'milipascal',
                'code' => '74',
                'status' => 'inactive',
            ),
            56 =>
            array (
                'id' => 57,
                'name' => 'gauss',
                'code' => '76',
                'status' => 'inactive',
            ),
            57 =>
            array (
                'id' => 58,
                'name' => 'mili pulgadas',
                'code' => '77',
                'status' => 'inactive',
            ),
            58 =>
            array (
                'id' => 59,
                'name' => 'kilogauss',
                'code' => '78',
                'status' => 'inactive',
            ),
            59 =>
            array (
                'id' => 60,
                'name' => 'libras por pulgada cuadrada absoluta',
                'code' => '80',
                'status' => 'inactive',
            ),
            60 =>
            array (
                'id' => 61,
                'name' => 'Enrique',
                'code' => '81',
                'status' => 'inactive',
            ),
            61 =>
            array (
                'id' => 62,
                'name' => 'kilopound por pulgada cuadrada',
                'code' => '84',
                'status' => 'inactive',
            ),
            62 =>
            array (
                'id' => 63,
                'name' => 'fuerza libra pie',
                'code' => '85',
                'status' => 'inactive',
            ),
            63 =>
            array (
                'id' => 64,
                'name' => 'libra por pie cúbico',
                'code' => '87',
                'status' => 'inactive',
            ),
            64 =>
            array (
                'id' => 65,
                'name' => 'equilibrio',
                'code' => '89',
                'status' => 'inactive',
            ),
            65 =>
            array (
                'id' => 66,
                'name' => 'Saybold segundo universal',
                'code' => '90',
                'status' => 'inactive',
            ),
            66 =>
            array (
                'id' => 67,
                'name' => 'alimenta',
                'code' => '91',
                'status' => 'inactive',
            ),
            67 =>
            array (
                'id' => 68,
                'name' => 'calorías por centímetro cúbico',
                'code' => '92',
                'status' => 'inactive',
            ),
            68 =>
            array (
                'id' => 69,
                'name' => 'calorías por gramo',
                'code' => '93',
                'status' => 'inactive',
            ),
            69 =>
            array (
                'id' => 70,
                'name' => 'Unidad',
                'code' => '94',
                'status' => 'active',
            ),
            70 =>
            array (
                'id' => 71,
            'name' => 'veinte mil galones (US) de carros',
                'code' => '95',
                'status' => 'inactive',
            ),
            71 =>
            array (
                'id' => 72,
            'name' => 'diez mil galones (US) de carros',
                'code' => '96',
                'status' => 'inactive',
            ),
            72 =>
            array (
                'id' => 73,
                'name' => 'tambor de diez kg',
                'code' => '97',
                'status' => 'inactive',
            ),
            73 =>
            array (
                'id' => 74,
                'name' => 'tambor de quince kg',
                'code' => '98',
                'status' => 'inactive',
            ),
            74 =>
            array (
                'id' => 75,
                'name' => 'milla de coche',
                'code' => '1ª',
                'status' => 'inactive',
            ),
            75 =>
            array (
                'id' => 76,
                'name' => 'recuento de coches',
                'code' => '1B',
                'status' => 'inactive',
            ),
            76 =>
            array (
                'id' => 77,
                'name' => 'recuento de locomotoras',
                'code' => '1C',
                'status' => 'inactive',
            ),
            77 =>
            array (
                'id' => 78,
                'name' => 'recuento de cabos',
                'code' => '1D',
                'status' => 'inactive',
            ),
            78 =>
            array (
                'id' => 79,
                'name' => 'carro vacio',
                'code' => '1E',
                'status' => 'inactive',
            ),
            79 =>
            array (
                'id' => 80,
                'name' => 'millas de tren',
                'code' => '1F',
                'status' => 'inactive',
            ),
            80 =>
            array (
                'id' => 81,
            'name' => 'uso de combustible galón (US)',
                'code' => '1G',
                'status' => 'inactive',
            ),
            81 =>
            array (
                'id' => 82,
                'name' => 'milla del caboose',
                'code' => '1H',
                'status' => 'inactive',
            ),
            82 =>
            array (
                'id' => 83,
                'name' => 'tipo de interés fijo',
                'code' => '1I',
                'status' => 'inactive',
            ),
            83 =>
            array (
                'id' => 84,
                'name' => 'tonelada milla',
                'code' => '1J',
                'status' => 'inactive',
            ),
            84 =>
            array (
                'id' => 85,
                'name' => 'milla locomotora',
                'code' => '1K',
                'status' => 'inactive',
            ),
            85 =>
            array (
                'id' => 86,
                'name' => 'recuento total de coches',
                'code' => '1L',
                'status' => 'inactive',
            ),
            86 =>
            array (
                'id' => 87,
                'name' => 'milla de coche total',
                'code' => '1M',
                'status' => 'inactive',
            ),
            87 =>
            array (
                'id' => 88,
                'name' => 'cuarto de milla',
                'code' => '1X',
                'status' => 'inactive',
            ),
            88 =>
            array (
                'id' => 89,
                'name' => 'radianes por segundo',
                'code' => '2ª',
                'status' => 'inactive',
            ),
            89 =>
            array (
                'id' => 90,
                'name' => 'radianes por segundo al cuadrado',
                'code' => '2B',
                'status' => 'inactive',
            ),
            90 =>
            array (
                'id' => 91,
                'name' => 'Röntgen',
                'code' => '2C',
                'status' => 'inactive',
            ),
            91 =>
            array (
                'id' => 92,
                'name' => 'Unidad térmica británica por hora.',
                'code' => '2I',
                'status' => 'inactive',
            ),
            92 =>
            array (
                'id' => 93,
                'name' => 'centímetro cúbico por segundo',
                'code' => '2J',
                'status' => 'inactive',
            ),
            93 =>
            array (
                'id' => 94,
                'name' => 'pie cúbico por hora',
                'code' => '2K',
                'status' => 'inactive',
            ),
            94 =>
            array (
                'id' => 95,
                'name' => 'pie cúbico por minuto',
                'code' => '2L',
                'status' => 'inactive',
            ),
            95 =>
            array (
                'id' => 96,
                'name' => 'centímetro por segundo',
                'code' => '2M',
                'status' => 'inactive',
            ),
            96 =>
            array (
                'id' => 97,
                'name' => 'decibel',
                'code' => '2N',
                'status' => 'inactive',
            ),
            97 =>
            array (
                'id' => 98,
                'name' => 'kilobyte',
                'code' => '2P',
                'status' => 'inactive',
            ),
            98 =>
            array (
                'id' => 99,
                'name' => 'kilobecquerel',
                'code' => '2Q',
                'status' => 'inactive',
            ),
            99 =>
            array (
                'id' => 100,
                'name' => 'kilocurie',
                'code' => '2R',
                'status' => 'inactive',
            ),
            100 =>
            array (
                'id' => 101,
                'name' => 'megagramo',
                'code' => '2U',
                'status' => 'inactive',
            ),
            101 =>
            array (
                'id' => 102,
                'name' => 'megagramo por hora',
                'code' => '2V',
                'status' => 'inactive',
            ),
            102 =>
            array (
                'id' => 103,
                'name' => 'compartimiento',
                'code' => '2W',
                'status' => 'inactive',
            ),
            103 =>
            array (
                'id' => 104,
                'name' => 'metro por minuto',
                'code' => '2X',
                'status' => 'inactive',
            ),
            104 =>
            array (
                'id' => 105,
                'name' => 'milliröntgen',
                'code' => '2Y',
                'status' => 'inactive',
            ),
            105 =>
            array (
                'id' => 106,
                'name' => 'milivoltios',
                'code' => '2Z',
                'status' => 'inactive',
            ),
            106 =>
            array (
                'id' => 107,
                'name' => 'megajulio',
                'code' => '3B',
                'status' => 'inactive',
            ),
            107 =>
            array (
                'id' => 108,
                'name' => 'manmonth',
                'code' => '3C',
                'status' => 'inactive',
            ),
            108 =>
            array (
                'id' => 109,
                'name' => 'libra por libra de producto',
                'code' => '3E',
                'status' => 'inactive',
            ),
            109 =>
            array (
                'id' => 110,
                'name' => 'libra por pieza de producto',
                'code' => '3G',
                'status' => 'inactive',
            ),
            110 =>
            array (
                'id' => 111,
                'name' => 'kilogramo por kilogramo de producto',
                'code' => '3H',
                'status' => 'inactive',
            ),
            111 =>
            array (
                'id' => 112,
                'name' => 'kilogramo por pieza de producto',
                'code' => '3I',
                'status' => 'inactive',
            ),
            112 =>
            array (
                'id' => 113,
                'name' => 'bobina',
                'code' => '4ª',
                'status' => 'inactive',
            ),
            113 =>
            array (
                'id' => 114,
                'name' => 'gorra',
                'code' => '4B',
                'status' => 'inactive',
            ),
            114 =>
            array (
                'id' => 115,
                'name' => 'centistokes',
                'code' => '4C',
                'status' => 'inactive',
            ),
            115 =>
            array (
                'id' => 116,
                'name' => 'paquete de veinte',
                'code' => '4E',
                'status' => 'inactive',
            ),
            116 =>
            array (
                'id' => 117,
                'name' => 'microlitro',
                'code' => '4G',
                'status' => 'inactive',
            ),
            117 =>
            array (
                'id' => 118,
                'name' => 'micrometro',
                'code' => '4H',
                'status' => 'inactive',
            ),
            118 =>
            array (
                'id' => 119,
                'name' => 'miliamperio',
                'code' => '4K',
                'status' => 'inactive',
            ),
            119 =>
            array (
                'id' => 120,
                'name' => 'megabyte',
                'code' => '4L',
                'status' => 'inactive',
            ),
            120 =>
            array (
                'id' => 121,
                'name' => 'miligramo por hora',
                'code' => '4M',
                'status' => 'inactive',
            ),
            121 =>
            array (
                'id' => 122,
                'name' => 'megabecquerel',
                'code' => '4N',
                'status' => 'inactive',
            ),
            122 =>
            array (
                'id' => 123,
                'name' => 'microfarad',
                'code' => '4º',
                'status' => 'inactive',
            ),
            123 =>
            array (
                'id' => 124,
                'name' => 'newton por metro',
                'code' => '4P',
                'status' => 'inactive',
            ),
            124 =>
            array (
                'id' => 125,
                'name' => 'onza pulgada',
                'code' => '4Q',
                'status' => 'inactive',
            ),
            125 =>
            array (
                'id' => 126,
                'name' => 'pie onza',
                'code' => '4R',
                'status' => 'inactive',
            ),
            126 =>
            array (
                'id' => 127,
                'name' => 'picofarad',
                'code' => '4T',
                'status' => 'inactive',
            ),
            127 =>
            array (
                'id' => 128,
                'name' => 'libra por hora',
                'code' => '4U',
                'status' => 'inactive',
            ),
            128 =>
            array (
                'id' => 129,
            'name' => 'tonelada (US) por hora',
                'code' => '4W',
                'status' => 'inactive',
            ),
            129 =>
            array (
                'id' => 130,
                'name' => 'kilolitro por hora',
                'code' => '4X',
                'status' => 'inactive',
            ),
            130 =>
            array (
                'id' => 131,
                'name' => 'barril por minuto',
                'code' => '5ª',
                'status' => 'inactive',
            ),
            131 =>
            array (
                'id' => 132,
                'name' => 'lote',
                'code' => '5B',
                'status' => 'inactive',
            ),
            132 =>
            array (
                'id' => 133,
            'name' => 'galón (US) por mil',
                'code' => '5C',
                'status' => 'inactive',
            ),
            133 =>
            array (
                'id' => 134,
                'name' => 'MMSCF / día',
                'code' => '5E',
                'status' => 'inactive',
            ),
            134 =>
            array (
                'id' => 135,
                'name' => 'libras por mil',
                'code' => '5F',
                'status' => 'inactive',
            ),
            135 =>
            array (
                'id' => 136,
                'name' => 'bomba',
                'code' => '5G',
                'status' => 'inactive',
            ),
            136 =>
            array (
                'id' => 137,
                'name' => 'escenario',
                'code' => '5H',
                'status' => 'inactive',
            ),
            137 =>
            array (
                'id' => 138,
                'name' => 'pie cúbico estándar',
                'code' => '5I',
                'status' => 'inactive',
            ),
            138 =>
            array (
                'id' => 139,
                'name' => 'potencia hidráulica de caballos',
                'code' => '5J',
                'status' => 'inactive',
            ),
            139 =>
            array (
                'id' => 140,
                'name' => 'contar por minuto',
                'code' => '5K',
                'status' => 'inactive',
            ),
            140 =>
            array (
                'id' => 141,
                'name' => 'nivel sismico',
                'code' => '5P',
                'status' => 'inactive',
            ),
            141 =>
            array (
                'id' => 142,
                'name' => 'nfor sismica',
                'code' => '5Q',
                'status' => 'inactive',
            ),
            142 =>
            array (
                'id' => 143,
                'name' => '15 calorías C',
                'code' => 'A1',
                'status' => 'inactive',
            ),
            143 =>
            array (
                'id' => 144,
                'name' => 'amperio metro cuadrado por joule segundo',
                'code' => 'A10',
                'status' => 'inactive',
            ),
            144 =>
            array (
                'id' => 145,
                'name' => 'Ã ¥ ngström',
                'code' => 'A11',
                'status' => 'inactive',
            ),
            145 =>
            array (
                'id' => 146,
                'name' => 'unidad astronómica',
                'code' => 'A12',
                'status' => 'inactive',
            ),
            146 =>
            array (
                'id' => 147,
                'name' => 'attojoule',
                'code' => 'A13',
                'status' => 'inactive',
            ),
            147 =>
            array (
                'id' => 148,
                'name' => 'granero',
                'code' => 'A14',
                'status' => 'inactive',
            ),
            148 =>
            array (
                'id' => 149,
                'name' => 'granero por electrón voltio',
                'code' => 'A15',
                'status' => 'inactive',
            ),
            149 =>
            array (
                'id' => 150,
                'name' => 'granero por voltio de electrones esteradiano',
                'code' => 'A16',
                'status' => 'inactive',
            ),
            150 =>
            array (
                'id' => 151,
                'name' => 'granero por sterdian',
                'code' => 'A17',
                'status' => 'inactive',
            ),
            151 =>
            array (
                'id' => 152,
                'name' => 'becquerel por kilogramo',
                'code' => 'A18',
                'status' => 'inactive',
            ),
            152 =>
            array (
                'id' => 153,
                'name' => 'becquerel por metro cúbico',
                'code' => 'A19',
                'status' => 'inactive',
            ),
            153 =>
            array (
                'id' => 154,
                'name' => 'amperio por centímetro',
                'code' => 'A2',
                'status' => 'inactive',
            ),
            154 =>
            array (
                'id' => 155,
                'name' => 'Unidad térmica británica por segundo pie cuadrado grado Rankin',
                'code' => 'A20',
                'status' => 'inactive',
            ),
            155 =>
            array (
                'id' => 156,
                'name' => 'Unidad térmica británica por libra grado Rankin',
                'code' => 'A21',
                'status' => 'inactive',
            ),
            156 =>
            array (
                'id' => 157,
                'name' => 'Unidad térmica británica por segundo pie grado Rankin',
                'code' => 'A22',
                'status' => 'inactive',
            ),
            157 =>
            array (
                'id' => 158,
                'name' => 'Unidad térmica británica por hora pie cuadrado grado Rankin',
                'code' => 'A23',
                'status' => 'inactive',
            ),
            158 =>
            array (
                'id' => 159,
                'name' => 'candela por metro cuadrado',
                'code' => 'A24',
                'status' => 'inactive',
            ),
            159 =>
            array (
                'id' => 160,
                'name' => 'cheval vapeur',
                'code' => 'A25',
                'status' => 'inactive',
            ),
            160 =>
            array (
                'id' => 161,
                'name' => 'medidor de culombio',
                'code' => 'A26',
                'status' => 'inactive',
            ),
            161 =>
            array (
                'id' => 162,
                'name' => 'medidor de culombio al cuadrado por voltio',
                'code' => 'A27',
                'status' => 'inactive',
            ),
            162 =>
            array (
                'id' => 163,
                'name' => 'Coulomb por centímetro cúbico',
                'code' => 'A28',
                'status' => 'inactive',
            ),
            163 =>
            array (
                'id' => 164,
                'name' => 'Coulomb por metro cúbico',
                'code' => 'A29',
                'status' => 'inactive',
            ),
            164 =>
            array (
                'id' => 165,
                'name' => 'amperio por milímetro',
                'code' => 'A3',
                'status' => 'inactive',
            ),
            165 =>
            array (
                'id' => 166,
                'name' => 'Coulomb por milímetro cúbico',
                'code' => 'A30',
                'status' => 'inactive',
            ),
            166 =>
            array (
                'id' => 167,
                'name' => 'Coulomb por kilogramo segundo',
                'code' => 'A31',
                'status' => 'inactive',
            ),
            167 =>
            array (
                'id' => 168,
                'name' => 'Coulomb por mol',
                'code' => 'A32',
                'status' => 'inactive',
            ),
            168 =>
            array (
                'id' => 169,
                'name' => 'Coulomb por centímetro cuadrado',
                'code' => 'A33',
                'status' => 'inactive',
            ),
            169 =>
            array (
                'id' => 170,
                'name' => 'Coulomb por metro cuadrado',
                'code' => 'A34',
                'status' => 'inactive',
            ),
            170 =>
            array (
                'id' => 171,
                'name' => 'Coulomb por milímetro cuadrado',
                'code' => 'A35',
                'status' => 'inactive',
            ),
            171 =>
            array (
                'id' => 172,
                'name' => 'centímetro cúbico por mol',
                'code' => 'A36',
                'status' => 'inactive',
            ),
            172 =>
            array (
                'id' => 173,
                'name' => 'nformaci cúbico por mol',
                'code' => 'A37',
                'status' => 'inactive',
            ),
            173 =>
            array (
                'id' => 174,
                'name' => 'metro cúbico por coulomb',
                'code' => 'A38',
                'status' => 'inactive',
            ),
            174 =>
            array (
                'id' => 175,
                'name' => 'metro cúbico por kilogramo',
                'code' => 'A39',
                'status' => 'inactive',
            ),
            175 =>
            array (
                'id' => 176,
                'name' => 'amperio por centímetro cuadrado',
                'code' => 'A4',
                'status' => 'inactive',
            ),
            176 =>
            array (
                'id' => 177,
                'name' => 'metro cúbico por mol',
                'code' => 'A40',
                'status' => 'inactive',
            ),
            177 =>
            array (
                'id' => 178,
                'name' => 'amperio por metro cuadrado',
                'code' => 'A41',
                'status' => 'inactive',
            ),
            178 =>
            array (
                'id' => 179,
                'name' => 'curie por kilogramo',
                'code' => 'A42',
                'status' => 'inactive',
            ),
            179 =>
            array (
                'id' => 180,
                'name' => 'tonelaje de peso muerto',
                'code' => 'A43',
                'status' => 'inactive',
            ),
            180 =>
            array (
                'id' => 181,
                'name' => 'decalitro',
                'code' => 'A44',
                'status' => 'inactive',
            ),
            181 =>
            array (
                'id' => 182,
                'name' => 'decámetro',
                'code' => 'A45',
                'status' => 'inactive',
            ),
            182 =>
            array (
                'id' => 183,
                'name' => 'decitex',
                'code' => 'A47',
                'status' => 'inactive',
            ),
            183 =>
            array (
                'id' => 184,
                'name' => 'grado Rankin',
                'code' => 'A48',
                'status' => 'inactive',
            ),
            184 =>
            array (
                'id' => 185,
                'name' => 'negador',
                'code' => 'A49',
                'status' => 'inactive',
            ),
            185 =>
            array (
                'id' => 186,
                'name' => 'amperio metro cuadrado',
                'code' => 'A5',
                'status' => 'inactive',
            ),
            186 =>
            array (
                'id' => 187,
                'name' => 'dyn segundo por centímetro cúbico',
                'code' => 'A50',
                'status' => 'inactive',
            ),
            187 =>
            array (
                'id' => 188,
                'name' => 'dina segundo por centímetro',
                'code' => 'A51',
                'status' => 'inactive',
            ),
            188 =>
            array (
                'id' => 189,
                'name' => 'dina segundo por centímetro al quinto',
                'code' => 'A52',
                'status' => 'inactive',
            ),
            189 =>
            array (
                'id' => 190,
                'name' => 'electronvolt',
                'code' => 'A53',
                'status' => 'inactive',
            ),
            190 =>
            array (
                'id' => 191,
                'name' => 'electronvoltio por metro',
                'code' => 'A54',
                'status' => 'inactive',
            ),
            191 =>
            array (
                'id' => 192,
                'name' => 'metro electronvolt cuadrado',
                'code' => 'A55',
                'status' => 'inactive',
            ),
            192 =>
            array (
                'id' => 193,
                'name' => 'electronvoltio de metro cuadrado por kilogramo',
                'code' => 'A56',
                'status' => 'inactive',
            ),
            193 =>
            array (
                'id' => 194,
                'name' => 'ergio',
                'code' => 'A57',
                'status' => 'inactive',
            ),
            194 =>
            array (
                'id' => 195,
                'name' => 'erg por centímetro',
                'code' => 'A58',
                'status' => 'inactive',
            ),
            195 =>
            array (
                'id' => 196,
                'name' => 'amperio por metro cuadrado kelvin al cuadrado',
                'code' => 'A6',
                'status' => 'inactive',
            ),
            196 =>
            array (
                'id' => 197,
                'name' => 'erg por centímetro cúbico',
                'code' => 'A60',
                'status' => 'inactive',
            ),
            197 =>
            array (
                'id' => 198,
                'name' => 'erg por gramo',
                'code' => 'A61',
                'status' => 'inactive',
            ),
            198 =>
            array (
                'id' => 199,
                'name' => 'erg por gramo de segundo',
                'code' => 'A62',
                'status' => 'inactive',
            ),
            199 =>
            array (
                'id' => 200,
                'name' => 'erg por segundo',
                'code' => 'A63',
                'status' => 'inactive',
            ),
            200 =>
            array (
                'id' => 201,
                'name' => 'erg por segundo centímetro cuadrado',
                'code' => 'A64',
                'status' => 'inactive',
            ),
            201 =>
            array (
                'id' => 202,
                'name' => 'erg por centímetro cuadrado segundo',
                'code' => 'A65',
                'status' => 'inactive',
            ),
            202 =>
            array (
                'id' => 203,
                'name' => 'erg centímetro cuadrado',
                'code' => 'A66',
                'status' => 'inactive',
            ),
            203 =>
            array (
                'id' => 204,
                'name' => 'ergímetro cuadrado por gramo',
                'code' => 'A67',
                'status' => 'inactive',
            ),
            204 =>
            array (
                'id' => 205,
                'name' => 'exajulio',
                'code' => 'A68',
                'status' => 'inactive',
            ),
            205 =>
            array (
                'id' => 206,
                'name' => 'faradio por metro',
                'code' => 'A69',
                'status' => 'inactive',
            ),
            206 =>
            array (
                'id' => 207,
                'name' => 'amperio por milímetro cuadrado',
                'code' => 'A7',
                'status' => 'inactive',
            ),
            207 =>
            array (
                'id' => 208,
                'name' => 'femtojoule',
                'code' => 'A70',
                'status' => 'inactive',
            ),
            208 =>
            array (
                'id' => 209,
                'name' => 'femtometro',
                'code' => 'A71',
                'status' => 'inactive',
            ),
            209 =>
            array (
                'id' => 210,
                'name' => 'pie por segundo al cuadrado',
                'code' => 'A73',
                'status' => 'inactive',
            ),
            210 =>
            array (
                'id' => 211,
                'name' => 'pie-fuerza de la libra por segundo',
                'code' => 'A74',
                'status' => 'inactive',
            ),
            211 =>
            array (
                'id' => 212,
                'name' => 'tonelada de carga',
                'code' => 'A75',
                'status' => 'inactive',
            ),
            212 =>
            array (
                'id' => 213,
                'name' => 'galón',
                'code' => 'A76',
                'status' => 'inactive',
            ),
            213 =>
            array (
                'id' => 214,
                'name' => 'Unidad de desplazamiento CGS gaussiana',
                'code' => 'A77',
                'status' => 'inactive',
            ),
            214 =>
            array (
                'id' => 215,
                'name' => 'Unidad gaussiana CGS de corriente eléctrica.',
                'code' => 'A78',
                'status' => 'inactive',
            ),
            215 =>
            array (
                'id' => 216,
                'name' => 'Unidad Gaussian CGS de carga eléctrica.',
                'code' => 'A79',
                'status' => 'inactive',
            ),
            216 =>
            array (
                'id' => 217,
                'name' => 'amperio segundo',
                'code' => 'A8',
                'status' => 'inactive',
            ),
            217 =>
            array (
                'id' => 218,
                'name' => 'Unidad Gaussian CGS de intensidad de campo eléctrico.',
                'code' => 'A80',
                'status' => 'inactive',
            ),
            218 =>
            array (
                'id' => 219,
                'name' => 'Unidad Gaussian CGS de polarización eléctrica.',
                'code' => 'A81',
                'status' => 'inactive',
            ),
            219 =>
            array (
                'id' => 220,
                'name' => 'Unidad Gaussian CGS de potencial eléctrico.',
                'code' => 'A82',
                'status' => 'inactive',
            ),
            220 =>
            array (
                'id' => 221,
                'name' => 'Unidad Gaussiana CGS de magnetización.',
                'code' => 'A83',
                'status' => 'inactive',
            ),
            221 =>
            array (
                'id' => 222,
                'name' => 'gigacoulomb por metro cúbico',
                'code' => 'A84',
                'status' => 'inactive',
            ),
            222 =>
            array (
                'id' => 223,
                'name' => 'Gigaelectronvolt',
                'code' => 'A85',
                'status' => 'inactive',
            ),
            223 =>
            array (
                'id' => 224,
                'name' => 'gigahercios',
                'code' => 'A86',
                'status' => 'inactive',
            ),
            224 =>
            array (
                'id' => 225,
                'name' => 'gigaohm',
                'code' => 'A87',
                'status' => 'inactive',
            ),
            225 =>
            array (
                'id' => 226,
                'name' => 'medidor de gigaohm',
                'code' => 'A88',
                'status' => 'inactive',
            ),
            226 =>
            array (
                'id' => 227,
                'name' => 'gigapascal',
                'code' => 'A89',
                'status' => 'inactive',
            ),
            227 =>
            array (
                'id' => 228,
                'name' => 'tarifa',
                'code' => 'A9',
                'status' => 'inactive',
            ),
            228 =>
            array (
                'id' => 229,
                'name' => 'gigavatios',
                'code' => 'A90',
                'status' => 'inactive',
            ),
            229 =>
            array (
                'id' => 230,
                'name' => 'gon',
                'code' => 'A91',
                'status' => 'inactive',
            ),
            230 =>
            array (
                'id' => 231,
                'name' => 'gramo por metro cúbico',
                'code' => 'A93',
                'status' => 'inactive',
            ),
            231 =>
            array (
                'id' => 232,
                'name' => 'gramo por mol',
                'code' => 'A94',
                'status' => 'inactive',
            ),
            232 =>
            array (
                'id' => 233,
                'name' => 'gris',
                'code' => 'A95',
                'status' => 'inactive',
            ),
            233 =>
            array (
                'id' => 234,
                'name' => 'gris por segundo',
                'code' => 'A96',
                'status' => 'inactive',
            ),
            234 =>
            array (
                'id' => 235,
                'name' => 'hectopascal',
                'code' => 'A97',
                'status' => 'inactive',
            ),
            235 =>
            array (
                'id' => 236,
                'name' => 'Henry por metro',
                'code' => 'A98',
                'status' => 'inactive',
            ),
            236 =>
            array (
                'id' => 237,
                'name' => 'bola',
                'code' => 'AA',
                'status' => 'inactive',
            ),
            237 =>
            array (
                'id' => 238,
                'name' => 'paquete a granel',
                'code' => 'AB',
                'status' => 'inactive',
            ),
            238 =>
            array (
                'id' => 239,
                'name' => 'acre',
                'code' => 'ACR',
                'status' => 'inactive',
            ),
            239 =>
            array (
                'id' => 240,
                'name' => 'byte',
                'code' => 'AD',
                'status' => 'inactive',
            ),
            240 =>
            array (
                'id' => 241,
                'name' => 'amperio por metro',
                'code' => 'AE',
                'status' => 'inactive',
            ),
            241 =>
            array (
                'id' => 242,
                'name' => 'minuto adicional',
                'code' => 'AH',
                'status' => 'inactive',
            ),
            242 =>
            array (
                'id' => 243,
                'name' => 'minuto promedio por llamada',
                'code' => 'AI',
                'status' => 'inactive',
            ),
            243 =>
            array (
                'id' => 244,
                'name' => 'policía',
                'code' => 'AJ',
                'status' => 'inactive',
            ),
            244 =>
            array (
                'id' => 245,
                'name' => 'braza',
                'code' => 'AK',
                'status' => 'inactive',
            ),
            245 =>
            array (
                'id' => 246,
                'name' => 'nfor de acceso',
                'code' => 'AL',
                'status' => 'inactive',
            ),
            246 =>
            array (
                'id' => 247,
                'name' => 'ampolla',
                'code' => 'AM',
                'status' => 'inactive',
            ),
            247 =>
            array (
                'id' => 248,
                'name' => 'hora amperio',
                'code' => 'AMH',
                'status' => 'inactive',
            ),
            248 =>
            array (
                'id' => 249,
                'name' => 'amperio',
                'code' => 'AMP',
                'status' => 'inactive',
            ),
            249 =>
            array (
                'id' => 250,
                'name' => 'año',
                'code' => 'ANA',
                'status' => 'inactive',
            ),
            250 =>
            array (
                'id' => 251,
                'name' => 'solo libra de aluminio',
                'code' => 'AP',
                'status' => 'inactive',
            ),
            251 =>
            array (
                'id' => 252,
                'name' => 'onza troy o onza de boticarios',
                'code' => 'APZ',
                'status' => 'inactive',
            ),
            252 =>
            array (
                'id' => 253,
            'name' => 'Unidad de factor antihemofílico (AHF)',
                'code' => 'AQ',
                'status' => 'inactive',
            ),
            253 =>
            array (
                'id' => 254,
                'name' => 'supositorio',
                'code' => 'AR',
                'status' => 'inactive',
            ),
            254 =>
            array (
                'id' => 255,
                'name' => 'son',
                'code' => 'SON',
                'status' => 'inactive',
            ),
            255 =>
            array (
                'id' => 256,
                'name' => 'surtido',
                'code' => 'COMO',
                'status' => 'inactive',
            ),
            256 =>
            array (
                'id' => 257,
                'name' => 'fuerza alcohólica en masa',
                'code' => 'ASM',
                'status' => 'inactive',
            ),
            257 =>
            array (
                'id' => 258,
                'name' => 'fuerza alcohólica por volumen',
                'code' => 'ASU',
                'status' => 'inactive',
            ),
            258 =>
            array (
                'id' => 259,
                'name' => 'ambiente estándar',
                'code' => 'ATM',
                'status' => 'inactive',
            ),
            259 =>
            array (
                'id' => 260,
                'name' => 'ambiente técnico',
                'code' => 'ATT',
                'status' => 'inactive',
            ),
            260 =>
            array (
                'id' => 261,
                'name' => 'cápsula',
                'code' => 'AV',
                'status' => 'inactive',
            ),
            261 =>
            array (
                'id' => 262,
                'name' => 'vial lleno de polvo',
                'code' => 'AW',
                'status' => 'inactive',
            ),
            262 =>
            array (
                'id' => 263,
                'name' => 'montaje',
                'code' => 'SÍ',
                'status' => 'inactive',
            ),
            263 =>
            array (
                'id' => 264,
                'name' => 'Unidad térmica británica por libra',
                'code' => 'AZ',
                'status' => 'inactive',
            ),
            264 =>
            array (
                'id' => 265,
                'name' => 'Btu por pie cúbico',
                'code' => 'B0',
                'status' => 'inactive',
            ),
            265 =>
            array (
                'id' => 266,
            'name' => 'barril (US) por día',
                'code' => 'B1',
                'status' => 'inactive',
            ),
            266 =>
            array (
                'id' => 267,
                'name' => 'julios por kilogramo kelvin',
                'code' => 'B11',
                'status' => 'inactive',
            ),
            267 =>
            array (
                'id' => 268,
                'name' => 'julios por metro',
                'code' => 'B12',
                'status' => 'inactive',
            ),
            268 =>
            array (
                'id' => 269,
                'name' => 'julios por metro cuadrado',
                'code' => 'B13',
                'status' => 'inactive',
            ),
            269 =>
            array (
                'id' => 270,
                'name' => 'julios por metro a la cuarta potencia',
                'code' => 'B14',
                'status' => 'inactive',
            ),
            270 =>
            array (
                'id' => 271,
                'name' => 'julios por mol',
                'code' => 'B15',
                'status' => 'inactive',
            ),
            271 =>
            array (
                'id' => 272,
                'name' => 'julios por mol kelvin',
                'code' => 'B16',
                'status' => 'inactive',
            ),
            272 =>
            array (
                'id' => 273,
                'name' => 'joule segundo',
                'code' => 'B18',
                'status' => 'inactive',
            ),
            273 =>
            array (
                'id' => 274,
                'name' => 'litera',
                'code' => 'B2',
                'status' => 'inactive',
            ),
            274 =>
            array (
                'id' => 275,
                'name' => 'joule metro cuadrado por kilogramo',
                'code' => 'B20',
                'status' => 'inactive',
            ),
            275 =>
            array (
                'id' => 276,
                'name' => 'kelvin por vatio',
                'code' => 'B21',
                'status' => 'inactive',
            ),
            276 =>
            array (
                'id' => 277,
                'name' => 'Kiloampere',
                'code' => 'B22',
                'status' => 'inactive',
            ),
            277 =>
            array (
                'id' => 278,
                'name' => 'kiloampere por metro cuadrado',
                'code' => 'B23',
                'status' => 'inactive',
            ),
            278 =>
            array (
                'id' => 279,
                'name' => 'kiloampere por metro',
                'code' => 'B24',
                'status' => 'inactive',
            ),
            279 =>
            array (
                'id' => 280,
                'name' => 'kilobecquerel por kilogramo',
                'code' => 'B25',
                'status' => 'inactive',
            ),
            280 =>
            array (
                'id' => 281,
                'name' => 'kilocoulomb',
                'code' => 'B26',
                'status' => 'inactive',
            ),
            281 =>
            array (
                'id' => 282,
                'name' => 'kilocoulomb por metro cúbico',
                'code' => 'B27',
                'status' => 'inactive',
            ),
            282 =>
            array (
                'id' => 283,
                'name' => 'kilocoulomb por metro cuadrado',
                'code' => 'B28',
                'status' => 'inactive',
            ),
            283 =>
            array (
                'id' => 284,
                'name' => 'kiloelectronvolt',
                'code' => 'B29',
                'status' => 'inactive',
            ),
            284 =>
            array (
                'id' => 285,
                'name' => 'libra de bateo',
                'code' => 'B3',
                'status' => 'inactive',
            ),
            285 =>
            array (
                'id' => 286,
                'name' => 'kilogramo metro por segundo',
                'code' => 'B31',
                'status' => 'inactive',
            ),
            286 =>
            array (
                'id' => 287,
                'name' => 'kilogramo metro cuadrado',
                'code' => 'B32',
                'status' => 'inactive',
            ),
            287 =>
            array (
                'id' => 288,
                'name' => 'kilogramo metro cuadrado por segundo',
                'code' => 'B33',
                'status' => 'inactive',
            ),
            288 =>
            array (
                'id' => 289,
                'name' => 'kilogramo por decímetro cúbico',
                'code' => 'B34',
                'status' => 'inactive',
            ),
            289 =>
            array (
                'id' => 290,
                'name' => 'kilogramo por litro',
                'code' => 'B35',
                'status' => 'inactive',
            ),
            290 =>
            array (
                'id' => 291,
                'name' => 'caloría termoquímica por gramo',
                'code' => 'B36',
                'status' => 'inactive',
            ),
            291 =>
            array (
                'id' => 292,
                'name' => 'kilogramo de fuerza',
                'code' => 'B37',
                'status' => 'inactive',
            ),
            292 =>
            array (
                'id' => 293,
                'name' => 'metro de fuerza de kilogramo',
                'code' => 'B38',
                'status' => 'inactive',
            ),
            293 =>
            array (
                'id' => 294,
                'name' => 'metro de fuerza de kilogramo por segundo',
                'code' => 'B39',
                'status' => 'inactive',
            ),
            294 =>
            array (
                'id' => 295,
                'name' => 'barril imperial',
                'code' => 'B4',
                'status' => 'inactive',
            ),
            295 =>
            array (
                'id' => 296,
                'name' => 'kilogramo de fuerza por metro cuadrado',
                'code' => 'B40',
                'status' => 'inactive',
            ),
            296 =>
            array (
                'id' => 297,
                'name' => 'kilojoule per kelvin',
                'code' => 'B41',
                'status' => 'inactive',
            ),
            297 =>
            array (
                'id' => 298,
                'name' => 'kilojoule por kilogramo',
                'code' => 'B42',
                'status' => 'inactive',
            ),
            298 =>
            array (
                'id' => 299,
                'name' => 'kilojoule por kilogramo kelvin',
                'code' => 'B43',
                'status' => 'inactive',
            ),
            299 =>
            array (
                'id' => 300,
                'name' => 'kilojoule por mol',
                'code' => 'B44',
                'status' => 'inactive',
            ),
            300 =>
            array (
                'id' => 301,
                'name' => 'kilomol',
                'code' => 'B45',
                'status' => 'inactive',
            ),
            301 =>
            array (
                'id' => 302,
                'name' => 'kilomol por metro cúbico',
                'code' => 'B46',
                'status' => 'inactive',
            ),
            302 =>
            array (
                'id' => 303,
                'name' => 'Kilonewton',
                'code' => 'B47',
                'status' => 'inactive',
            ),
            303 =>
            array (
                'id' => 304,
                'name' => 'medidor de kilonewton',
                'code' => 'B48',
                'status' => 'inactive',
            ),
            304 =>
            array (
                'id' => 305,
                'name' => 'kiloohm',
                'code' => 'B49',
                'status' => 'inactive',
            ),
            305 =>
            array (
                'id' => 306,
                'name' => 'palanquilla',
                'code' => 'B5',
                'status' => 'inactive',
            ),
            306 =>
            array (
                'id' => 307,
                'name' => 'medidor de kiloohm',
                'code' => 'B50',
                'status' => 'inactive',
            ),
            307 =>
            array (
                'id' => 308,
                'name' => 'kilopond',
                'code' => 'B51',
                'status' => 'inactive',
            ),
            308 =>
            array (
                'id' => 309,
                'name' => 'kilosegundo',
                'code' => 'B52',
                'status' => 'inactive',
            ),
            309 =>
            array (
                'id' => 310,
                'name' => 'kilosiemens',
                'code' => 'B53',
                'status' => 'inactive',
            ),
            310 =>
            array (
                'id' => 311,
                'name' => 'kilosiemens por metro',
                'code' => 'B54',
                'status' => 'inactive',
            ),
            311 =>
            array (
                'id' => 312,
                'name' => 'kilovoltios por metro',
                'code' => 'B55',
                'status' => 'inactive',
            ),
            312 =>
            array (
                'id' => 313,
                'name' => 'kiloveber por metro',
                'code' => 'B56',
                'status' => 'inactive',
            ),
            313 =>
            array (
                'id' => 314,
                'name' => 'año luz',
                'code' => 'B57',
                'status' => 'inactive',
            ),
            314 =>
            array (
                'id' => 315,
                'name' => 'litro por mol',
                'code' => 'B58',
                'status' => 'inactive',
            ),
            315 =>
            array (
                'id' => 316,
                'name' => 'hora lumen',
                'code' => 'B59',
                'status' => 'inactive',
            ),
            316 =>
            array (
                'id' => 317,
                'name' => 'bollo',
                'code' => 'B6',
                'status' => 'inactive',
            ),
            317 =>
            array (
                'id' => 318,
                'name' => 'lumen por metro cuadrado',
                'code' => 'B60',
                'status' => 'inactive',
            ),
            318 =>
            array (
                'id' => 319,
                'name' => 'lumen por vatio',
                'code' => 'B61',
                'status' => 'inactive',
            ),
            319 =>
            array (
                'id' => 320,
                'name' => 'lumen segundo',
                'code' => 'B62',
                'status' => 'inactive',
            ),
            320 =>
            array (
                'id' => 321,
                'name' => 'hora de lux',
                'code' => 'B63',
                'status' => 'inactive',
            ),
            321 =>
            array (
                'id' => 322,
                'name' => 'lux segundo',
                'code' => 'B64',
                'status' => 'inactive',
            ),
            322 =>
            array (
                'id' => 323,
                'name' => 'Maxwell',
                'code' => 'B65',
                'status' => 'inactive',
            ),
            323 =>
            array (
                'id' => 324,
                'name' => 'megaamperios por metro cuadrado',
                'code' => 'B66',
                'status' => 'inactive',
            ),
            324 =>
            array (
                'id' => 325,
                'name' => 'megabecquerel por kilogramo',
                'code' => 'B67',
                'status' => 'inactive',
            ),
            325 =>
            array (
                'id' => 326,
                'name' => 'megacoulomb por metro cúbico',
                'code' => 'B69',
                'status' => 'inactive',
            ),
            326 =>
            array (
                'id' => 327,
                'name' => 'ciclo',
                'code' => 'B7',
                'status' => 'inactive',
            ),
            327 =>
            array (
                'id' => 328,
                'name' => 'megacoulomb por metro cuadrado',
                'code' => 'B70',
                'status' => 'inactive',
            ),
            328 =>
            array (
                'id' => 329,
                'name' => 'megaelectronvolt',
                'code' => 'B71',
                'status' => 'inactive',
            ),
            329 =>
            array (
                'id' => 330,
                'name' => 'megagramo por metro cúbico',
                'code' => 'B72',
                'status' => 'inactive',
            ),
            330 =>
            array (
                'id' => 331,
                'name' => 'meganewton',
                'code' => 'B73',
                'status' => 'inactive',
            ),
            331 =>
            array (
                'id' => 332,
                'name' => 'medidor de meganewton',
                'code' => 'B74',
                'status' => 'inactive',
            ),
            332 =>
            array (
                'id' => 333,
                'name' => 'megaohm',
                'code' => 'B75',
                'status' => 'inactive',
            ),
            333 =>
            array (
                'id' => 334,
                'name' => 'metro megaohm',
                'code' => 'B76',
                'status' => 'inactive',
            ),
            334 =>
            array (
                'id' => 335,
                'name' => 'megasiemens por metro',
                'code' => 'B77',
                'status' => 'inactive',
            ),
            335 =>
            array (
                'id' => 336,
                'name' => 'megavoltio',
                'code' => 'B78',
                'status' => 'inactive',
            ),
            336 =>
            array (
                'id' => 337,
                'name' => 'megavolt por metro',
                'code' => 'B79',
                'status' => 'inactive',
            ),
            337 =>
            array (
                'id' => 338,
                'name' => 'julios por metro cúbico',
                'code' => 'B8',
                'status' => 'inactive',
            ),
            338 =>
            array (
                'id' => 339,
                'name' => 'metro recíproco cuadrado recíproco segundo',
                'code' => 'B81',
                'status' => 'inactive',
            ),
            339 =>
            array (
                'id' => 340,
                'name' => 'metro a la cuarta potencia',
                'code' => 'B83',
                'status' => 'inactive',
            ),
            340 =>
            array (
                'id' => 341,
                'name' => 'microamperios',
                'code' => 'B84',
                'status' => 'inactive',
            ),
            341 =>
            array (
                'id' => 342,
                'name' => 'microbar',
                'code' => 'B85',
                'status' => 'inactive',
            ),
            342 =>
            array (
                'id' => 343,
                'name' => 'microcoulomb',
                'code' => 'B86',
                'status' => 'inactive',
            ),
            343 =>
            array (
                'id' => 344,
                'name' => 'microcoulomb por metro cúbico',
                'code' => 'B87',
                'status' => 'inactive',
            ),
            344 =>
            array (
                'id' => 345,
                'name' => 'microcoulomb por metro cuadrado',
                'code' => 'B88',
                'status' => 'inactive',
            ),
            345 =>
            array (
                'id' => 346,
                'name' => 'microfarada por metro',
                'code' => 'B89',
                'status' => 'inactive',
            ),
            346 =>
            array (
                'id' => 347,
                'name' => 'batt',
                'code' => 'B9',
                'status' => 'inactive',
            ),
            347 =>
            array (
                'id' => 348,
                'name' => 'microhenry',
                'code' => 'B90',
                'status' => 'inactive',
            ),
            348 =>
            array (
                'id' => 349,
                'name' => 'microhenry por metro',
                'code' => 'B91',
                'status' => 'inactive',
            ),
            349 =>
            array (
                'id' => 350,
                'name' => 'micronewton',
                'code' => 'B92',
                'status' => 'inactive',
            ),
            350 =>
            array (
                'id' => 351,
                'name' => 'medidor de micronewton',
                'code' => 'B93',
                'status' => 'inactive',
            ),
            351 =>
            array (
                'id' => 352,
                'name' => 'microohm',
                'code' => 'B94',
                'status' => 'inactive',
            ),
            352 =>
            array (
                'id' => 353,
                'name' => 'medidor de microohmios',
                'code' => 'B95',
                'status' => 'inactive',
            ),
            353 =>
            array (
                'id' => 354,
                'name' => 'micropascal',
                'code' => 'B96',
                'status' => 'inactive',
            ),
            354 =>
            array (
                'id' => 355,
                'name' => 'microradiano',
                'code' => 'B97',
                'status' => 'inactive',
            ),
            355 =>
            array (
                'id' => 356,
                'name' => 'microsegundo',
                'code' => 'B98',
                'status' => 'inactive',
            ),
            356 =>
            array (
                'id' => 357,
                'name' => 'microsiemens',
                'code' => 'B99',
                'status' => 'inactive',
            ),
            357 =>
            array (
                'id' => 358,
                'name' => 'bar',
                'code' => 'BAR',
                'status' => 'inactive',
            ),
            358 =>
            array (
                'id' => 359,
                'name' => 'caja base',
                'code' => 'BB',
                'status' => 'inactive',
            ),
            359 =>
            array (
                'id' => 360,
                'name' => 'tablero',
                'code' => 'BD',
                'status' => 'inactive',
            ),
            360 =>
            array (
                'id' => 361,
                'name' => 'haz',
                'code' => 'SER',
                'status' => 'inactive',
            ),
            361 =>
            array (
                'id' => 362,
                'name' => 'pie de tabla',
                'code' => 'BFT',
                'status' => 'inactive',
            ),
            362 =>
            array (
                'id' => 363,
                'name' => 'bolso',
                'code' => 'BG',
                'status' => 'inactive',
            ),
            363 =>
            array (
                'id' => 364,
                'name' => 'cepillo',
                'code' => 'BH',
                'status' => 'inactive',
            ),
            364 =>
            array (
                'id' => 365,
                'name' => 'potencia al freno',
                'code' => 'BHP',
                'status' => 'inactive',
            ),
            365 =>
            array (
                'id' => 366,
                'name' => 'trillón de dólares',
                'code' => 'BIL',
                'status' => 'inactive',
            ),
            366 =>
            array (
                'id' => 367,
                'name' => 'cangilón',
                'code' => 'BJ',
                'status' => 'inactive',
            ),
            367 =>
            array (
                'id' => 368,
                'name' => 'cesta',
                'code' => 'BK',
                'status' => 'inactive',
            ),
            368 =>
            array (
                'id' => 369,
                'name' => 'bala',
                'code' => 'BL',
                'status' => 'inactive',
            ),
            369 =>
            array (
                'id' => 370,
                'name' => 'barril seco',
                'code' => 'BLD',
                'status' => 'inactive',
            ),
            370 =>
            array (
                'id' => 371,
            'name' => 'barril (EE. UU.) (petróleo etc.)',
                'code' => 'BLL',
                'status' => 'inactive',
            ),
            371 =>
            array (
                'id' => 372,
                'name' => 'botella',
                'code' => 'BO',
                'status' => 'inactive',
            ),
            372 =>
            array (
                'id' => 373,
                'name' => 'cien pies de tabla',
                'code' => 'BP',
                'status' => 'inactive',
            ),
            373 =>
            array (
                'id' => 374,
                'name' => 'becquerel',
                'code' => 'BQL',
                'status' => 'inactive',
            ),
            374 =>
            array (
                'id' => 375,
                'name' => 'bar',
                'code' => 'BR',
                'status' => 'inactive',
            ),
            375 =>
            array (
                'id' => 376,
                'name' => 'tornillo',
                'code' => 'BT',
                'status' => 'inactive',
            ),
            376 =>
            array (
                'id' => 377,
                'name' => 'Unidad Térmica Británica',
                'code' => 'BTU',
                'status' => 'inactive',
            ),
            377 =>
            array (
                'id' => 378,
            'name' => 'bushel (EE. UU.)',
                'code' => 'BUA',
                'status' => 'inactive',
            ),
            378 =>
            array (
                'id' => 379,
            'name' => 'bushel (Reino Unido)',
                'code' => 'BUI',
                'status' => 'inactive',
            ),
            379 =>
            array (
                'id' => 380,
                'name' => 'peso base',
                'code' => 'BW',
                'status' => 'inactive',
            ),
            380 =>
            array (
                'id' => 381,
                'name' => 'caja',
                'code' => 'BX',
                'status' => 'active',
            ),
            381 =>
            array (
                'id' => 382,
                'name' => 'millones de BTUs',
                'code' => 'BZ',
                'status' => 'inactive',
            ),
            382 =>
            array (
                'id' => 383,
                'name' => 'llamada',
                'code' => 'C0',
                'status' => 'inactive',
            ),
            383 =>
            array (
                'id' => 384,
            'name' => 'producto compuesto libra (peso total)',
                'code' => 'C1',
                'status' => 'inactive',
            ),
            384 =>
            array (
                'id' => 385,
                'name' => 'millifarad',
                'code' => 'C10',
                'status' => 'inactive',
            ),
            385 =>
            array (
                'id' => 386,
                'name' => 'miligal',
                'code' => 'C11',
                'status' => 'inactive',
            ),
            386 =>
            array (
                'id' => 387,
                'name' => 'miligramo por metro',
                'code' => 'C12',
                'status' => 'inactive',
            ),
            387 =>
            array (
                'id' => 388,
                'name' => 'miligray',
                'code' => 'C13',
                'status' => 'inactive',
            ),
            388 =>
            array (
                'id' => 389,
                'name' => 'milihenry',
                'code' => 'C14',
                'status' => 'inactive',
            ),
            389 =>
            array (
                'id' => 390,
                'name' => 'milijoule',
                'code' => 'C15',
                'status' => 'inactive',
            ),
            390 =>
            array (
                'id' => 391,
                'name' => 'milímetro por segundo',
                'code' => 'C16',
                'status' => 'inactive',
            ),
            391 =>
            array (
                'id' => 392,
                'name' => 'milímetro cuadrado por segundo',
                'code' => 'C17',
                'status' => 'inactive',
            ),
            392 =>
            array (
                'id' => 393,
                'name' => 'milimol',
                'code' => 'C18',
                'status' => 'inactive',
            ),
            393 =>
            array (
                'id' => 394,
                'name' => 'mol por kilogramo',
                'code' => 'C19',
                'status' => 'inactive',
            ),
            394 =>
            array (
                'id' => 395,
                'name' => 'carset',
                'code' => 'C2',
                'status' => 'inactive',
            ),
            395 =>
            array (
                'id' => 396,
                'name' => 'millinewton',
                'code' => 'C20',
                'status' => 'inactive',
            ),
            396 =>
            array (
                'id' => 397,
                'name' => 'millinewton por metro',
                'code' => 'C22',
                'status' => 'inactive',
            ),
            397 =>
            array (
                'id' => 398,
                'name' => 'medidor de miliohm',
                'code' => 'C23',
                'status' => 'inactive',
            ),
            398 =>
            array (
                'id' => 399,
                'name' => 'segundo milipascal',
                'code' => 'C24',
                'status' => 'inactive',
            ),
            399 =>
            array (
                'id' => 400,
                'name' => 'miliradian',
                'code' => 'C25',
                'status' => 'inactive',
            ),
            400 =>
            array (
                'id' => 401,
                'name' => 'milisegundo',
                'code' => 'C26',
                'status' => 'inactive',
            ),
            401 =>
            array (
                'id' => 402,
                'name' => 'milisiemens',
                'code' => 'C27',
                'status' => 'inactive',
            ),
            402 =>
            array (
                'id' => 403,
                'name' => 'milisievert',
                'code' => 'C28',
                'status' => 'inactive',
            ),
            403 =>
            array (
                'id' => 404,
                'name' => 'millitesla',
                'code' => 'C29',
                'status' => 'inactive',
            ),
            404 =>
            array (
                'id' => 405,
                'name' => 'microvoltios por metro',
                'code' => 'C3',
                'status' => 'inactive',
            ),
            405 =>
            array (
                'id' => 406,
                'name' => 'milivoltios por metro',
                'code' => 'C30',
                'status' => 'inactive',
            ),
            406 =>
            array (
                'id' => 407,
                'name' => 'milivatios',
                'code' => 'C31',
                'status' => 'inactive',
            ),
            407 =>
            array (
                'id' => 408,
                'name' => 'milivatios por metro cuadrado',
                'code' => 'C32',
                'status' => 'inactive',
            ),
            408 =>
            array (
                'id' => 409,
                'name' => 'milliweber',
                'code' => 'C33',
                'status' => 'inactive',
            ),
            409 =>
            array (
                'id' => 410,
                'name' => 'Topo',
                'code' => 'C34',
                'status' => 'inactive',
            ),
            410 =>
            array (
                'id' => 411,
                'name' => 'mol por decímetro cúbico',
                'code' => 'C35',
                'status' => 'inactive',
            ),
            411 =>
            array (
                'id' => 412,
                'name' => 'mol por metro cúbico',
                'code' => 'C36',
                'status' => 'inactive',
            ),
            412 =>
            array (
                'id' => 413,
                'name' => 'mol por litro',
                'code' => 'C38',
                'status' => 'inactive',
            ),
            413 =>
            array (
                'id' => 414,
                'name' => 'Nanoampere',
                'code' => 'C39',
                'status' => 'inactive',
            ),
            414 =>
            array (
                'id' => 415,
                'name' => 'partido de carga',
                'code' => 'C4',
                'status' => 'inactive',
            ),
            415 =>
            array (
                'id' => 416,
                'name' => 'nanocoulomb',
                'code' => 'C40',
                'status' => 'inactive',
            ),
            416 =>
            array (
                'id' => 417,
                'name' => 'nanofarad',
                'code' => 'C41',
                'status' => 'inactive',
            ),
            417 =>
            array (
                'id' => 418,
                'name' => 'nanofarad por metro',
                'code' => 'C42',
                'status' => 'inactive',
            ),
            418 =>
            array (
                'id' => 419,
                'name' => 'nanohenry',
                'code' => 'C43',
                'status' => 'inactive',
            ),
            419 =>
            array (
                'id' => 420,
                'name' => 'nanohenry por metro',
                'code' => 'C44',
                'status' => 'inactive',
            ),
            420 =>
            array (
                'id' => 421,
                'name' => 'nanometro',
                'code' => 'C45',
                'status' => 'inactive',
            ),
            421 =>
            array (
                'id' => 422,
                'name' => 'medidor de nanoohm',
                'code' => 'C46',
                'status' => 'inactive',
            ),
            422 =>
            array (
                'id' => 423,
                'name' => 'nanosegundo',
                'code' => 'C47',
                'status' => 'inactive',
            ),
            423 =>
            array (
                'id' => 424,
                'name' => 'nanotesla',
                'code' => 'C48',
                'status' => 'inactive',
            ),
            424 =>
            array (
                'id' => 425,
                'name' => 'nanovatio',
                'code' => 'C49',
                'status' => 'inactive',
            ),
            425 =>
            array (
                'id' => 426,
                'name' => 'costo',
                'code' => 'C5',
                'status' => 'inactive',
            ),
            426 =>
            array (
                'id' => 427,
                'name' => 'neper',
                'code' => 'C50',
                'status' => 'inactive',
            ),
            427 =>
            array (
                'id' => 428,
                'name' => 'neper por segundo',
                'code' => 'C51',
                'status' => 'inactive',
            ),
            428 =>
            array (
                'id' => 429,
                'name' => 'picometro',
                'code' => 'C52',
                'status' => 'inactive',
            ),
            429 =>
            array (
                'id' => 430,
                'name' => 'metro de newton segundo',
                'code' => 'C53',
                'status' => 'inactive',
            ),
            430 =>
            array (
                'id' => 431,
                'name' => 'newton metro cuadrado kilogramo cuadrado',
                'code' => 'C54',
                'status' => 'inactive',
            ),
            431 =>
            array (
                'id' => 432,
                'name' => 'newton por metro cuadrado',
                'code' => 'C55',
                'status' => 'inactive',
            ),
            432 =>
            array (
                'id' => 433,
                'name' => 'newton por milímetro cuadrado',
                'code' => 'C56',
                'status' => 'inactive',
            ),
            433 =>
            array (
                'id' => 434,
                'name' => 'newton segundo',
                'code' => 'C57',
                'status' => 'inactive',
            ),
            434 =>
            array (
                'id' => 435,
                'name' => 'newton segundo por metro',
                'code' => 'C58',
                'status' => 'inactive',
            ),
            435 =>
            array (
                'id' => 436,
                'name' => 'octava',
                'code' => 'C59',
                'status' => 'inactive',
            ),
            436 =>
            array (
                'id' => 437,
                'name' => 'célula',
                'code' => 'C6',
                'status' => 'inactive',
            ),
            437 =>
            array (
                'id' => 438,
                'name' => 'ohm centímetro',
                'code' => 'C60',
                'status' => 'inactive',
            ),
            438 =>
            array (
                'id' => 439,
                'name' => 'ohm metro',
                'code' => 'C61',
                'status' => 'inactive',
            ),
            439 =>
            array (
                'id' => 440,
                'name' => 'uno',
                'code' => 'C62',
                'status' => 'inactive',
            ),
            440 =>
            array (
                'id' => 441,
                'name' => 'parsec',
                'code' => 'C63',
                'status' => 'inactive',
            ),
            441 =>
            array (
                'id' => 442,
                'name' => 'pascal por kelvin',
                'code' => 'C64',
                'status' => 'inactive',
            ),
            442 =>
            array (
                'id' => 443,
                'name' => 'segundo pascal',
                'code' => 'C65',
                'status' => 'inactive',
            ),
            443 =>
            array (
                'id' => 444,
                'name' => 'segundo pascal por metro cúbico',
                'code' => 'C66',
                'status' => 'inactive',
            ),
            444 =>
            array (
                'id' => 445,
                'name' => 'segundo pascal por metro',
                'code' => 'C67',
                'status' => 'inactive',
            ),
            445 =>
            array (
                'id' => 446,
                'name' => 'petajoule',
                'code' => 'C68',
                'status' => 'inactive',
            ),
            446 =>
            array (
                'id' => 447,
                'name' => 'telefono',
                'code' => 'C69',
                'status' => 'inactive',
            ),
            447 =>
            array (
                'id' => 448,
                'name' => 'centipoise',
                'code' => 'C7',
                'status' => 'inactive',
            ),
            448 =>
            array (
                'id' => 449,
                'name' => 'picoampere',
                'code' => 'C70',
                'status' => 'inactive',
            ),
            449 =>
            array (
                'id' => 450,
                'name' => 'picocoulomb',
                'code' => 'C71',
                'status' => 'inactive',
            ),
            450 =>
            array (
                'id' => 451,
                'name' => 'picofarad por metro',
                'code' => 'C72',
                'status' => 'inactive',
            ),
            451 =>
            array (
                'id' => 452,
                'name' => 'picohenry',
                'code' => 'C73',
                'status' => 'inactive',
            ),
            452 =>
            array (
                'id' => 453,
                'name' => 'picowatt',
                'code' => 'C75',
                'status' => 'inactive',
            ),
            453 =>
            array (
                'id' => 454,
                'name' => 'picowatt por metro cuadrado',
                'code' => 'C76',
                'status' => 'inactive',
            ),
            454 =>
            array (
                'id' => 455,
                'name' => 'medidor de libras',
                'code' => 'C77',
                'status' => 'inactive',
            ),
            455 =>
            array (
                'id' => 456,
                'name' => 'fuerza de libra',
                'code' => 'C78',
                'status' => 'inactive',
            ),
            456 =>
            array (
                'id' => 457,
                'name' => 'Millicoulomb por kilogramo',
                'code' => 'C8',
                'status' => 'inactive',
            ),
            457 =>
            array (
                'id' => 458,
                'name' => 'rad',
                'code' => 'C80',
                'status' => 'inactive',
            ),
            458 =>
            array (
                'id' => 459,
                'name' => 'radián',
                'code' => 'C81',
                'status' => 'inactive',
            ),
            459 =>
            array (
                'id' => 460,
                'name' => 'medidor de radianes al cuadrado por mol',
                'code' => 'C82',
                'status' => 'inactive',
            ),
            460 =>
            array (
                'id' => 461,
                'name' => 'medidor de radianes al cuadrado por kilogramo',
                'code' => 'C83',
                'status' => 'inactive',
            ),
            461 =>
            array (
                'id' => 462,
                'name' => 'radian por metro',
                'code' => 'C84',
                'status' => 'inactive',
            ),
            462 =>
            array (
                'id' => 463,
                'name' => 'â € ngstr recíproco “m',
                'code' => 'C85',
                'status' => 'inactive',
            ),
            463 =>
            array (
                'id' => 464,
                'name' => 'metro cúbico recíproco',
                'code' => 'C86',
                'status' => 'inactive',
            ),
            464 =>
            array (
                'id' => 465,
                'name' => 'metro cúbico recíproco por segundo',
                'code' => 'C87',
                'status' => 'inactive',
            ),
            465 =>
            array (
                'id' => 466,
                'name' => 'voltios de electrones recíprocos por metro cúbico',
                'code' => 'C88',
                'status' => 'inactive',
            ),
            466 =>
            array (
                'id' => 467,
                'name' => 'Henry Recíproco',
                'code' => 'C89',
                'status' => 'inactive',
            ),
            467 =>
            array (
                'id' => 468,
                'name' => 'grupo de bobina',
                'code' => 'C9',
                'status' => 'inactive',
            ),
            468 =>
            array (
                'id' => 469,
                'name' => 'Joule recíproco por metro cúbico',
                'code' => 'C90',
                'status' => 'inactive',
            ),
            469 =>
            array (
                'id' => 470,
                'name' => 'kelvin recíproco o kelvin al poder menos uno',
                'code' => 'C91',
                'status' => 'inactive',
            ),
            470 =>
            array (
                'id' => 471,
                'name' => 'medidor recíproco',
                'code' => 'C92',
                'status' => 'inactive',
            ),
            471 =>
            array (
                'id' => 472,
                'name' => 'metro cuadrado recíproco',
                'code' => 'C93',
                'status' => 'inactive',
            ),
            472 =>
            array (
                'id' => 473,
                'name' => 'minuto recíproco',
                'code' => 'C94',
                'status' => 'inactive',
            ),
            473 =>
            array (
                'id' => 474,
                'name' => 'mole recíproco',
                'code' => 'C95',
                'status' => 'inactive',
            ),
            474 =>
            array (
                'id' => 475,
                'name' => 'Pascal recíproco o pascal a la potencia menos uno.',
                'code' => 'C96',
                'status' => 'inactive',
            ),
            475 =>
            array (
                'id' => 476,
                'name' => 'segundo recíproco',
                'code' => 'C97',
                'status' => 'inactive',
            ),
            476 =>
            array (
                'id' => 477,
                'name' => 'segundo recíproco por metro cúbico',
                'code' => 'C98',
                'status' => 'inactive',
            ),
            477 =>
            array (
                'id' => 478,
                'name' => 'segundo recíproco por metro cuadrado',
                'code' => 'C99',
                'status' => 'inactive',
            ),
            478 =>
            array (
                'id' => 479,
                'name' => 'Caja',
                'code' => 'CA',
                'status' => 'inactive',
            ),
            479 =>
            array (
                'id' => 480,
                'name' => 'Capacidad de carga en toneladas métricas.',
                'code' => 'CCT',
                'status' => 'inactive',
            ),
            480 =>
            array (
                'id' => 481,
                'name' => 'candela',
                'code' => 'CDL',
                'status' => 'inactive',
            ),
            481 =>
            array (
                'id' => 482,
                'name' => 'grado Celsius',
                'code' => 'CEL',
                'status' => 'inactive',
            ),
            482 =>
            array (
                'id' => 483,
                'name' => 'cien',
                'code' => 'CEN',
                'status' => 'inactive',
            ),
            483 =>
            array (
                'id' => 484,
                'name' => 'tarjeta',
                'code' => 'CG',
                'status' => 'inactive',
            ),
            484 =>
            array (
                'id' => 485,
                'name' => 'centigramo',
                'code' => 'CGM',
                'status' => 'inactive',
            ),
            485 =>
            array (
                'id' => 486,
                'name' => 'envase',
                'code' => 'CH',
                'status' => 'inactive',
            ),
            486 =>
            array (
                'id' => 487,
                'name' => 'cono',
                'code' => 'CJ',
                'status' => 'inactive',
            ),
            487 =>
            array (
                'id' => 488,
                'name' => 'conector',
                'code' => 'CK',
                'status' => 'inactive',
            ),
            488 =>
            array (
                'id' => 489,
                'name' => 'Coulomb por kilogramo',
                'code' => 'CKG',
                'status' => 'inactive',
            ),
            489 =>
            array (
                'id' => 490,
                'name' => 'bobina',
                'code' => 'CL',
                'status' => 'inactive',
            ),
            490 =>
            array (
                'id' => 491,
                'name' => 'cientos de licencia',
                'code' => 'CLF',
                'status' => 'inactive',
            ),
            491 =>
            array (
                'id' => 492,
                'name' => 'centilitro',
                'code' => 'CLT',
                'status' => 'inactive',
            ),
            492 =>
            array (
                'id' => 493,
                'name' => 'centímetro cuadrado',
                'code' => 'CMK',
                'status' => 'inactive',
            ),
            493 =>
            array (
                'id' => 494,
                'name' => 'centímetro cúbico',
                'code' => 'CMQ',
                'status' => 'inactive',
            ),
            494 =>
            array (
                'id' => 495,
                'name' => 'centímetro',
                'code' => 'CMT',
                'status' => 'inactive',
            ),
            495 =>
            array (
                'id' => 496,
                'name' => 'paquete de cien',
                'code' => 'CNP',
                'status' => 'inactive',
            ),
            496 =>
            array (
                'id' => 497,
            'name' => 'Cental (Reino Unido)',
                'code' => 'CNT',
                'status' => 'inactive',
            ),
            497 =>
            array (
                'id' => 498,
                'name' => 'garrafón',
                'code' => 'CO',
                'status' => 'inactive',
            ),
            498 =>
            array (
                'id' => 499,
                'name' => 'culombio',
                'code' => 'COU',
                'status' => 'inactive',
            ),
            499 =>
            array (
                'id' => 500,
                'name' => 'cartucho',
                'code' => 'CQ',
                'status' => 'inactive',
            ),
        ));
        DB::table('measure_units')->insert(array (
            0 =>
            array (
                'id' => 501,
                'name' => 'caja',
                'code' => 'CR',
                'status' => 'inactive',
            ),
            1 =>
            array (
                'id' => 502,
                'name' => 'caso',
                'code' => 'CS',
                'status' => 'inactive',
            ),
            2 =>
            array (
                'id' => 503,
                'name' => 'caja de cartón',
                'code' => 'CT',
                'status' => 'inactive',
            ),
            3 =>
            array (
                'id' => 504,
                'name' => 'quilate métrico',
                'code' => 'CTM',
                'status' => 'inactive',
            ),
            4 =>
            array (
                'id' => 505,
                'name' => 'vaso',
                'code' => 'CU',
                'status' => 'inactive',
            ),
            5 =>
            array (
                'id' => 506,
                'name' => 'curie',
                'code' => 'CUR',
                'status' => 'inactive',
            ),
            6 =>
            array (
                'id' => 507,
                'name' => 'cubrir',
                'code' => 'CV',
                'status' => 'inactive',
            ),
            7 =>
            array (
                'id' => 508,
            'name' => 'cien libras (quintales) / cien pesos (US)',
                'code' => 'CWA',
                'status' => 'inactive',
            ),
            8 =>
            array (
                'id' => 509,
            'name' => 'cien pesos (Reino Unido)',
                'code' => 'CWI',
                'status' => 'inactive',
            ),
            9 =>
            array (
                'id' => 510,
                'name' => 'cilindro',
                'code' => 'CY',
                'status' => 'inactive',
            ),
            10 =>
            array (
                'id' => 511,
                'name' => 'combo',
                'code' => 'CZ',
                'status' => 'inactive',
            ),
            11 =>
            array (
                'id' => 512,
                'name' => 'segundo recíproco por esteradiano',
                'code' => 'D1',
                'status' => 'inactive',
            ),
            12 =>
            array (
                'id' => 513,
                'name' => 'siemens por metro',
                'code' => 'D10',
                'status' => 'inactive',
            ),
            13 =>
            array (
                'id' => 514,
                'name' => 'siemens metro cuadrado por mol',
                'code' => 'D12',
                'status' => 'inactive',
            ),
            14 =>
            array (
                'id' => 515,
                'name' => 'sievert',
                'code' => 'D13',
                'status' => 'inactive',
            ),
            15 =>
            array (
                'id' => 516,
                'name' => 'mil yardas lineales',
                'code' => 'D14',
                'status' => 'inactive',
            ),
            16 =>
            array (
                'id' => 517,
                'name' => 'sone',
                'code' => 'D15',
                'status' => 'inactive',
            ),
            17 =>
            array (
                'id' => 518,
                'name' => 'centímetro cuadrado por ergio',
                'code' => 'D16',
                'status' => 'inactive',
            ),
            18 =>
            array (
                'id' => 519,
                'name' => 'centímetro cuadrado por erg esterlina',
                'code' => 'D17',
                'status' => 'inactive',
            ),
            19 =>
            array (
                'id' => 520,
                'name' => 'metro kelvin',
                'code' => 'D18',
                'status' => 'inactive',
            ),
            20 =>
            array (
                'id' => 521,
                'name' => 'kelvin metro cuadrado por vatio',
                'code' => 'D19',
                'status' => 'inactive',
            ),
            21 =>
            array (
                'id' => 522,
                'name' => 'segundo recíproco por metros cuadrados esteradianos',
                'code' => 'D2',
                'status' => 'inactive',
            ),
            22 =>
            array (
                'id' => 523,
                'name' => 'metro cuadrado por julio',
                'code' => 'D20',
                'status' => 'inactive',
            ),
            23 =>
            array (
                'id' => 524,
                'name' => 'metro cuadrado por kilogramo',
                'code' => 'D21',
                'status' => 'inactive',
            ),
            24 =>
            array (
                'id' => 525,
                'name' => 'metro cuadrado por mol',
                'code' => 'D22',
                'status' => 'inactive',
            ),
            25 =>
            array (
                'id' => 526,
            'name' => 'pluma gramo (proteína)',
                'code' => 'D23',
                'status' => 'inactive',
            ),
            26 =>
            array (
                'id' => 527,
                'name' => 'metro cuadrado por esterilizador',
                'code' => 'D24',
                'status' => 'inactive',
            ),
            27 =>
            array (
                'id' => 528,
                'name' => 'metro cuadrado por julios esteradianos',
                'code' => 'D25',
                'status' => 'inactive',
            ),
            28 =>
            array (
                'id' => 529,
                'name' => 'metro cuadrado por voltio segundo',
                'code' => 'D26',
                'status' => 'inactive',
            ),
            29 =>
            array (
                'id' => 530,
                'name' => 'esteradiano',
                'code' => 'D27',
                'status' => 'inactive',
            ),
            30 =>
            array (
                'id' => 531,
                'name' => 'sifón',
                'code' => 'D28',
                'status' => 'inactive',
            ),
            31 =>
            array (
                'id' => 532,
                'name' => 'terahercios',
                'code' => 'D29',
                'status' => 'inactive',
            ),
            32 =>
            array (
                'id' => 533,
                'name' => 'terajulio',
                'code' => 'D30',
                'status' => 'inactive',
            ),
            33 =>
            array (
                'id' => 534,
                'name' => 'teravatio',
                'code' => 'D31',
                'status' => 'inactive',
            ),
            34 =>
            array (
                'id' => 535,
                'name' => 'hora de teravatio',
                'code' => 'D32',
                'status' => 'inactive',
            ),
            35 =>
            array (
                'id' => 536,
                'name' => 'tesla',
                'code' => 'D33',
                'status' => 'inactive',
            ),
            36 =>
            array (
                'id' => 537,
                'name' => 'Texas',
                'code' => 'D34',
                'status' => 'inactive',
            ),
            37 =>
            array (
                'id' => 538,
                'name' => 'caloría termoquímica',
                'code' => 'D35',
                'status' => 'inactive',
            ),
            38 =>
            array (
                'id' => 539,
                'name' => 'caloría termoquímica por gramo kelvin',
                'code' => 'D37',
                'status' => 'inactive',
            ),
            39 =>
            array (
                'id' => 540,
                'name' => 'calorías termoquímicas por segundo centímetro kelvin',
                'code' => 'D38',
                'status' => 'inactive',
            ),
            40 =>
            array (
                'id' => 541,
                'name' => 'calorías termoquímicas por segundo centímetro cuadrado kelvin',
                'code' => 'D39',
                'status' => 'inactive',
            ),
            41 =>
            array (
                'id' => 542,
                'name' => 'mil litros',
                'code' => 'D40',
                'status' => 'inactive',
            ),
            42 =>
            array (
                'id' => 543,
                'name' => 'tonelada por metro cúbico',
                'code' => 'D41',
                'status' => 'inactive',
            ),
            43 =>
            array (
                'id' => 544,
                'name' => 'año tropical',
                'code' => 'D42',
                'status' => 'inactive',
            ),
            44 =>
            array (
                'id' => 545,
                'name' => 'unidad de masa atómica unificada',
                'code' => 'D43',
                'status' => 'inactive',
            ),
            45 =>
            array (
                'id' => 546,
                'name' => 'var',
                'code' => 'D44',
                'status' => 'inactive',
            ),
            46 =>
            array (
                'id' => 547,
                'name' => 'voltios al cuadrado por kelvin al cuadrado',
                'code' => 'D45',
                'status' => 'inactive',
            ),
            47 =>
            array (
                'id' => 548,
                'name' => 'voltio – amperio',
                'code' => 'D46',
                'status' => 'inactive',
            ),
            48 =>
            array (
                'id' => 549,
                'name' => 'voltio por centímetro',
                'code' => 'D47',
                'status' => 'inactive',
            ),
            49 =>
            array (
                'id' => 550,
                'name' => 'voltio por kelvin',
                'code' => 'D48',
                'status' => 'inactive',
            ),
            50 =>
            array (
                'id' => 551,
                'name' => 'milivoltios por kelvin',
                'code' => 'D49',
                'status' => 'inactive',
            ),
            51 =>
            array (
                'id' => 552,
                'name' => 'kilogramo por centímetro cuadrado',
                'code' => 'D5',
                'status' => 'inactive',
            ),
            52 =>
            array (
                'id' => 553,
                'name' => 'voltios por metro',
                'code' => 'D50',
                'status' => 'inactive',
            ),
            53 =>
            array (
                'id' => 554,
                'name' => 'voltios por milímetro',
                'code' => 'D51',
                'status' => 'inactive',
            ),
            54 =>
            array (
                'id' => 555,
                'name' => 'vatios por kelvin',
                'code' => 'D52',
                'status' => 'inactive',
            ),
            55 =>
            array (
                'id' => 556,
                'name' => 'vatios por metro kelvin',
                'code' => 'D53',
                'status' => 'inactive',
            ),
            56 =>
            array (
                'id' => 557,
                'name' => 'vatios por metro cuadrado',
                'code' => 'D54',
                'status' => 'inactive',
            ),
            57 =>
            array (
                'id' => 558,
                'name' => 'vatios por metro cuadrado kelvin',
                'code' => 'D55',
                'status' => 'inactive',
            ),
            58 =>
            array (
                'id' => 559,
                'name' => 'vatios por metro cuadrado de kelvin a la cuarta potencia',
                'code' => 'D56',
                'status' => 'inactive',
            ),
            59 =>
            array (
                'id' => 560,
                'name' => 'vatios por steradian',
                'code' => 'D57',
                'status' => 'inactive',
            ),
            60 =>
            array (
                'id' => 561,
                'name' => 'vatios por metro cuadrado esterlino',
                'code' => 'D58',
                'status' => 'inactive',
            ),
            61 =>
            array (
                'id' => 562,
                'name' => 'weber por metro',
                'code' => 'D59',
                'status' => 'inactive',
            ),
            62 =>
            array (
                'id' => 563,
                'name' => 'röntgen por segundo',
                'code' => 'D6',
                'status' => 'inactive',
            ),
            63 =>
            array (
                'id' => 564,
                'name' => 'weber por milímetro',
                'code' => 'D60',
                'status' => 'inactive',
            ),
            64 =>
            array (
                'id' => 565,
                'name' => 'minuto',
                'code' => 'D61',
                'status' => 'inactive',
            ),
            65 =>
            array (
                'id' => 566,
                'name' => 'segundo',
                'code' => 'D62',
                'status' => 'inactive',
            ),
            66 =>
            array (
                'id' => 567,
                'name' => 'libro',
                'code' => 'D63',
                'status' => 'inactive',
            ),
            67 =>
            array (
                'id' => 568,
                'name' => 'bloquear',
                'code' => 'D64',
                'status' => 'inactive',
            ),
            68 =>
            array (
                'id' => 569,
                'name' => 'redondo',
                'code' => 'D65',
                'status' => 'inactive',
            ),
            69 =>
            array (
                'id' => 570,
                'name' => 'casete',
                'code' => 'D66',
                'status' => 'inactive',
            ),
            70 =>
            array (
                'id' => 571,
                'name' => 'dólar por hora',
                'code' => 'D67',
                'status' => 'inactive',
            ),
            71 =>
            array (
                'id' => 572,
                'name' => 'pulgada a la cuarta potencia',
                'code' => 'D69',
                'status' => 'inactive',
            ),
            72 =>
            array (
                'id' => 573,
                'name' => 'Sandwich',
                'code' => 'D7',
                'status' => 'inactive',
            ),
            73 =>
            array (
                'id' => 574,
            'name' => 'Tabla Internacional (IT) caloría',
                'code' => 'D70',
                'status' => 'inactive',
            ),
            74 =>
            array (
                'id' => 575,
            'name' => 'Tabla Internacional (IT) calorías por segundo centímetro kelvin',
                'code' => 'D71',
                'status' => 'inactive',
            ),
            75 =>
            array (
                'id' => 576,
            'name' => 'Tabla Internacional (IT) calorías por segundo centímetro cuadrado kelvin',
                'code' => 'D72',
                'status' => 'inactive',
            ),
            76 =>
            array (
                'id' => 577,
                'name' => 'joule metro cuadrado',
                'code' => 'D73',
                'status' => 'inactive',
            ),
            77 =>
            array (
                'id' => 578,
                'name' => 'kilogramo por mol',
                'code' => 'D74',
                'status' => 'inactive',
            ),
            78 =>
            array (
                'id' => 579,
            'name' => 'Tabla Internacional (IT) calorías por gramo',
                'code' => 'D75',
                'status' => 'inactive',
            ),
            79 =>
            array (
                'id' => 580,
            'name' => 'Tabla Internacional (IT) calorías por gramo kelvin',
                'code' => 'D76',
                'status' => 'inactive',
            ),
            80 =>
            array (
                'id' => 581,
                'name' => 'megacoulomb',
                'code' => 'D77',
                'status' => 'inactive',
            ),
            81 =>
            array (
                'id' => 582,
                'name' => 'haz',
                'code' => 'D79',
                'status' => 'inactive',
            ),
            82 =>
            array (
                'id' => 583,
                'name' => 'puntaje de drenaje',
                'code' => 'D8',
                'status' => 'inactive',
            ),
            83 =>
            array (
                'id' => 584,
                'name' => 'microwatt',
                'code' => 'D80',
                'status' => 'inactive',
            ),
            84 =>
            array (
                'id' => 585,
                'name' => 'microtesla',
                'code' => 'D81',
                'status' => 'inactive',
            ),
            85 =>
            array (
                'id' => 586,
                'name' => 'microvoltio',
                'code' => 'D82',
                'status' => 'inactive',
            ),
            86 =>
            array (
                'id' => 587,
                'name' => 'medidor de millinewton',
                'code' => 'D83',
                'status' => 'inactive',
            ),
            87 =>
            array (
                'id' => 588,
                'name' => 'microwatt por metro cuadrado',
                'code' => 'D85',
                'status' => 'inactive',
            ),
            88 =>
            array (
                'id' => 589,
                'name' => 'Millicoulomb',
                'code' => 'D86',
                'status' => 'inactive',
            ),
            89 =>
            array (
                'id' => 590,
                'name' => 'milimol por kilogramo',
                'code' => 'D87',
                'status' => 'inactive',
            ),
            90 =>
            array (
                'id' => 591,
                'name' => 'millicoulomb por metro cúbico',
                'code' => 'D88',
                'status' => 'inactive',
            ),
            91 =>
            array (
                'id' => 592,
                'name' => 'millicoulomb por metro cuadrado',
                'code' => 'D89',
                'status' => 'inactive',
            ),
            92 =>
            array (
                'id' => 593,
                'name' => 'dina por centímetro cuadrado',
                'code' => 'D9',
                'status' => 'inactive',
            ),
            93 =>
            array (
                'id' => 594,
            'name' => 'metro cúbico (neto)',
                'code' => 'D90',
                'status' => 'inactive',
            ),
            94 =>
            array (
                'id' => 595,
                'name' => 'movimiento rápido del ojo',
                'code' => 'D91',
                'status' => 'inactive',
            ),
            95 =>
            array (
                'id' => 596,
                'name' => 'banda',
                'code' => 'D92',
                'status' => 'inactive',
            ),
            96 =>
            array (
                'id' => 597,
                'name' => 'segundo por metro cúbico',
                'code' => 'D93',
                'status' => 'inactive',
            ),
            97 =>
            array (
                'id' => 598,
                'name' => 'segundo por metro cúbico radianes',
                'code' => 'D94',
                'status' => 'inactive',
            ),
            98 =>
            array (
                'id' => 599,
                'name' => 'julios por gramo',
                'code' => 'D95',
                'status' => 'inactive',
            ),
            99 =>
            array (
                'id' => 600,
                'name' => 'libra bruta',
                'code' => 'D96',
                'status' => 'inactive',
            ),
            100 =>
            array (
                'id' => 601,
                'name' => 'carga de palet / unidad',
                'code' => 'D97',
                'status' => 'inactive',
            ),
            101 =>
            array (
                'id' => 602,
                'name' => 'libra de masa',
                'code' => 'D98',
                'status' => 'inactive',
            ),
            102 =>
            array (
                'id' => 603,
                'name' => 'manga',
                'code' => 'D99',
                'status' => 'inactive',
            ),
            103 =>
            array (
                'id' => 604,
                'name' => 'despreciar',
                'code' => 'DAA',
                'status' => 'inactive',
            ),
            104 =>
            array (
                'id' => 605,
                'name' => 'diez dias',
                'code' => 'DAD',
                'status' => 'inactive',
            ),
            105 =>
            array (
                'id' => 606,
                'name' => 'día',
                'code' => 'DAY',
                'status' => 'inactive',
            ),
            106 =>
            array (
                'id' => 607,
                'name' => 'libra seca',
                'code' => 'DB',
                'status' => 'inactive',
            ),
            107 =>
            array (
                'id' => 608,
                'name' => 'disco',
                'code' => 'DC',
                'status' => 'inactive',
            ),
            108 =>
            array (
                'id' => 609,
                'name' => 'la licenciatura',
                'code' => 'DD',
                'status' => 'inactive',
            ),
            109 =>
            array (
                'id' => 610,
                'name' => 'acuerdo',
                'code' => 'DE',
                'status' => 'inactive',
            ),
            110 =>
            array (
                'id' => 611,
                'name' => 'década',
                'code' => 'DEC',
                'status' => 'inactive',
            ),
            111 =>
            array (
                'id' => 612,
                'name' => 'decigramo',
                'code' => 'DG',
                'status' => 'inactive',
            ),
            112 =>
            array (
                'id' => 613,
                'name' => 'dispensador',
                'code' => 'DI',
                'status' => 'inactive',
            ),
            113 =>
            array (
                'id' => 614,
                'name' => 'decagramo',
                'code' => 'DJ',
                'status' => 'inactive',
            ),
            114 =>
            array (
                'id' => 615,
                'name' => 'decilitro',
                'code' => 'DLT',
                'status' => 'inactive',
            ),
            115 =>
            array (
                'id' => 616,
                'name' => 'nformaci cuadrado',
                'code' => 'DMK',
                'status' => 'inactive',
            ),
            116 =>
            array (
                'id' => 617,
                'name' => 'decímetro cúbico',
                'code' => 'DMQ',
                'status' => 'inactive',
            ),
            117 =>
            array (
                'id' => 618,
                'name' => 'decímetro',
                'code' => 'DMT',
                'status' => 'inactive',
            ),
            118 =>
            array (
                'id' => 619,
                'name' => 'medidor de decinewton',
                'code' => 'DN',
                'status' => 'inactive',
            ),
            119 =>
            array (
                'id' => 620,
                'name' => 'docena pieza',
                'code' => 'DPC',
                'status' => 'inactive',
            ),
            120 =>
            array (
                'id' => 621,
                'name' => 'docena par',
                'code' => 'DPR',
                'status' => 'inactive',
            ),
            121 =>
            array (
                'id' => 622,
                'name' => 'tonelaje de desplazamiento',
                'code' => 'DPT',
                'status' => 'inactive',
            ),
            122 =>
            array (
                'id' => 623,
                'name' => 'registro de datos',
                'code' => 'DQ',
                'status' => 'inactive',
            ),
            123 =>
            array (
                'id' => 624,
                'name' => 'tambor',
                'code' => 'DR',
                'status' => 'inactive',
            ),
            124 =>
            array (
                'id' => 625,
            'name' => 'dram (US)',
                'code' => 'DRA',
                'status' => 'inactive',
            ),
            125 =>
            array (
                'id' => 626,
            'name' => 'dram (Reino Unido)',
                'code' => 'DRI',
                'status' => 'inactive',
            ),
            126 =>
            array (
                'id' => 627,
                'name' => 'docena rollo',
                'code' => 'DRL',
                'status' => 'inactive',
            ),
            127 =>
            array (
                'id' => 628,
            'name' => 'dracma (Reino Unido)',
                'code' => 'DRM',
                'status' => 'inactive',
            ),
            128 =>
            array (
                'id' => 629,
                'name' => 'monitor',
                'code' => 'DS',
                'status' => 'inactive',
            ),
            129 =>
            array (
                'id' => 630,
                'name' => 'tonelada seca',
                'code' => 'DT',
                'status' => 'inactive',
            ),
            130 =>
            array (
                'id' => 631,
                'name' => 'Decitonne',
                'code' => 'DTN',
                'status' => 'inactive',
            ),
            131 =>
            array (
                'id' => 632,
                'name' => 'dina',
                'code' => 'DU',
                'status' => 'inactive',
            ),
            132 =>
            array (
                'id' => 633,
                'name' => 'pennyweight',
                'code' => 'DWT',
                'status' => 'inactive',
            ),
            133 =>
            array (
                'id' => 634,
                'name' => 'dina por centímetro',
                'code' => 'DX',
                'status' => 'inactive',
            ),
            134 =>
            array (
                'id' => 635,
                'name' => 'libro de directorio',
                'code' => 'DY',
                'status' => 'inactive',
            ),
            135 =>
            array (
                'id' => 636,
                'name' => 'docena',
                'code' => 'DZN',
                'status' => 'active',
            ),
            136 =>
            array (
                'id' => 637,
                'name' => 'paquete de doce',
                'code' => 'DZP',
                'status' => 'inactive',
            ),
            137 =>
            array (
                'id' => 638,
                'name' => 'cinturón',
                'code' => 'E2',
                'status' => 'inactive',
            ),
            138 =>
            array (
                'id' => 639,
                'name' => 'remolque',
                'code' => 'E3',
                'status' => 'inactive',
            ),
            139 =>
            array (
                'id' => 640,
                'name' => 'kilogramo bruto',
                'code' => 'E4',
                'status' => 'inactive',
            ),
            140 =>
            array (
                'id' => 641,
                'name' => 'tonelada métrica larga',
                'code' => 'E5',
                'status' => 'inactive',
            ),
            141 =>
            array (
                'id' => 642,
                'name' => 'cada',
                'code' => 'EA',
                'status' => 'inactive',
            ),
            142 =>
            array (
                'id' => 643,
                'name' => 'casilla de correo electrónico',
                'code' => 'EB',
                'status' => 'inactive',
            ),
            143 =>
            array (
                'id' => 644,
                'name' => 'cada uno por mes',
                'code' => 'CE',
                'status' => 'inactive',
            ),
            144 =>
            array (
                'id' => 645,
                'name' => 'paquete de once',
                'code' => 'EP',
                'status' => 'inactive',
            ),
            145 =>
            array (
                'id' => 646,
                'name' => 'galón equivalente',
                'code' => 'EQ',
                'status' => 'inactive',
            ),
            146 =>
            array (
                'id' => 647,
                'name' => 'sobre',
                'code' => 'EV',
                'status' => 'inactive',
            ),
            147 =>
            array (
                'id' => 648,
                'name' => 'mil pies cúbicos por día',
                'code' => 'F1',
                'status' => 'inactive',
            ),
            148 =>
            array (
                'id' => 649,
                'name' => 'Fibra por centímetro cúbico de aire',
                'code' => 'F9',
                'status' => 'inactive',
            ),
            149 =>
            array (
                'id' => 650,
                'name' => 'grado Fahrenheit',
                'code' => 'FAH',
                'status' => 'inactive',
            ),
            150 =>
            array (
                'id' => 651,
                'name' => 'faradio',
                'code' => 'FAR',
                'status' => 'inactive',
            ),
            151 =>
            array (
                'id' => 652,
                'name' => 'campo',
                'code' => 'FB',
                'status' => 'inactive',
            ),
            152 =>
            array (
                'id' => 653,
                'name' => 'mil pies cúbicos',
                'code' => 'FC',
                'status' => 'inactive',
            ),
            153 =>
            array (
                'id' => 654,
                'name' => 'millón de partículas por pie cúbico',
                'code' => 'FD',
                'status' => 'inactive',
            ),
            154 =>
            array (
                'id' => 655,
                'name' => 'pie de pista',
                'code' => 'FE',
                'status' => 'inactive',
            ),
            155 =>
            array (
                'id' => 656,
                'name' => 'cien metros cúbicos',
                'code' => 'FF',
                'status' => 'inactive',
            ),
            156 =>
            array (
                'id' => 657,
                'name' => 'parche transdérmico',
                'code' => 'FG',
                'status' => 'inactive',
            ),
            157 =>
            array (
                'id' => 658,
                'name' => 'micromol',
                'code' => 'FH',
                'status' => 'inactive',
            ),
            158 =>
            array (
                'id' => 659,
                'name' => 'tonelada en escamas',
                'code' => 'FL',
                'status' => 'inactive',
            ),
            159 =>
            array (
                'id' => 660,
                'name' => 'millones de pies cúbicos',
                'code' => 'FM',
                'status' => 'inactive',
            ),
            160 =>
            array (
                'id' => 661,
                'name' => 'pie',
                'code' => 'FOT',
                'status' => 'active',
            ),
            161 =>
            array (
                'id' => 662,
                'name' => 'libra por pie cuadrado',
                'code' => 'FP',
                'status' => 'inactive',
            ),
            162 =>
            array (
                'id' => 663,
                'name' => 'pie por minuto',
                'code' => 'FR',
                'status' => 'inactive',
            ),
            163 =>
            array (
                'id' => 664,
                'name' => 'pie por segundo',
                'code' => 'FS',
                'status' => 'inactive',
            ),
            164 =>
            array (
                'id' => 665,
                'name' => 'pie cuadrado',
                'code' => 'FTK',
                'status' => 'inactive',
            ),
            165 =>
            array (
                'id' => 666,
                'name' => 'pie cubico',
                'code' => 'FTQ',
                'status' => 'inactive',
            ),
            166 =>
            array (
                'id' => 667,
                'name' => 'US galones por minuto',
                'code' => 'G2',
                'status' => 'inactive',
            ),
            167 =>
            array (
                'id' => 668,
                'name' => 'Galon imperial por minuto',
                'code' => 'G3',
                'status' => 'inactive',
            ),
            168 =>
            array (
                'id' => 669,
                'name' => 'hoja de microficha',
                'code' => 'G7',
                'status' => 'inactive',
            ),
            169 =>
            array (
                'id' => 670,
            'name' => 'galón (US) por día',
                'code' => 'GB',
                'status' => 'inactive',
            ),
            170 =>
            array (
                'id' => 671,
                'name' => 'gigabecquerel',
                'code' => 'GBQ',
                'status' => 'inactive',
            ),
            171 =>
            array (
                'id' => 672,
                'name' => 'gramo por 100 gramo',
                'code' => 'GC',
                'status' => 'inactive',
            ),
            172 =>
            array (
                'id' => 673,
                'name' => 'barril bruto',
                'code' => 'GD',
                'status' => 'inactive',
            ),
            173 =>
            array (
                'id' => 674,
            'name' => 'libra por galón (US)',
                'code' => 'GE',
                'status' => 'inactive',
            ),
            174 =>
            array (
                'id' => 675,
            'name' => 'gramo por metro (gramo por 100 centímetros)',
                'code' => 'GF',
                'status' => 'inactive',
            ),
            175 =>
            array (
                'id' => 676,
                'name' => 'gramo de isótopo fisionable',
                'code' => 'GFI',
                'status' => 'inactive',
            ),
            176 =>
            array (
                'id' => 677,
                'name' => 'gramo',
                'code' => 'GGR',
                'status' => 'inactive',
            ),
            177 =>
            array (
                'id' => 678,
            'name' => 'medio galón (EE. UU.)',
                'code' => 'GH',
                'status' => 'inactive',
            ),
            178 =>
            array (
                'id' => 679,
                'name' => 'branquias',
                'code' => 'GIA',
                'status' => 'inactive',
            ),
            179 =>
            array (
                'id' => 680,
            'name' => 'Gill (Reino Unido)',
                'code' => 'GII',
                'status' => 'inactive',
            ),
            180 =>
            array (
                'id' => 681,
                'name' => 'gramo por mililitro',
                'code' => 'GJ',
                'status' => 'inactive',
            ),
            181 =>
            array (
                'id' => 682,
                'name' => 'gramo por kilogramo',
                'code' => 'G K',
                'status' => 'inactive',
            ),
            182 =>
            array (
                'id' => 683,
                'name' => 'gramo por litro',
                'code' => 'GL',
                'status' => 'inactive',
            ),
            183 =>
            array (
                'id' => 684,
            'name' => 'galón seco (EE. UU.)',
                'code' => 'GLD',
                'status' => 'inactive',
            ),
            184 =>
            array (
                'id' => 685,
            'name' => 'galón (Reino Unido)',
                'code' => 'GLI',
                'status' => 'inactive',
            ),
            185 =>
            array (
                'id' => 686,
                'name' => 'galón',
                'code' => 'GLL',
                'status' => 'inactive',
            ),
            186 =>
            array (
                'id' => 687,
                'name' => 'gramo por metro cuadrado',
                'code' => 'GM',
                'status' => 'inactive',
            ),
            187 =>
            array (
                'id' => 688,
                'name' => 'galón bruto',
                'code' => 'GN',
                'status' => 'inactive',
            ),
            188 =>
            array (
                'id' => 689,
                'name' => 'miligramos por metro cuadrado',
                'code' => 'GO',
                'status' => 'inactive',
            ),
            189 =>
            array (
                'id' => 690,
                'name' => 'miligramo por metro cúbico',
                'code' => 'GP',
                'status' => 'inactive',
            ),
            190 =>
            array (
                'id' => 691,
                'name' => 'microgramos por metro cúbico',
                'code' => 'GQ',
                'status' => 'inactive',
            ),
            191 =>
            array (
                'id' => 692,
                'name' => 'gramo',
                'code' => 'GRM',
                'status' => 'active',
            ),
            192 =>
            array (
                'id' => 693,
                'name' => 'grano',
                'code' => 'GRN',
                'status' => 'inactive',
            ),
            193 =>
            array (
                'id' => 694,
                'name' => 'bruto',
                'code' => 'GRO',
                'status' => 'inactive',
            ),
            194 =>
            array (
                'id' => 695,
                'name' => 'tonelada de registro bruto',
                'code' => 'GRT',
                'status' => 'inactive',
            ),
            195 =>
            array (
                'id' => 696,
                'name' => 'tonelada bruta',
                'code' => 'GT',
                'status' => 'inactive',
            ),
            196 =>
            array (
                'id' => 697,
                'name' => 'gigajoule',
                'code' => 'GV',
                'status' => 'inactive',
            ),
            197 =>
            array (
                'id' => 698,
                'name' => 'galón por mil pies cúbicos',
                'code' => 'GW',
                'status' => 'inactive',
            ),
            198 =>
            array (
                'id' => 699,
                'name' => 'hora de gigavatios',
                'code' => 'GWH',
                'status' => 'inactive',
            ),
            199 =>
            array (
                'id' => 700,
                'name' => 'patio bruto',
                'code' => 'GY',
                'status' => 'inactive',
            ),
            200 =>
            array (
                'id' => 701,
                'name' => 'sistema de medición',
                'code' => 'GZ',
                'status' => 'inactive',
            ),
            201 =>
            array (
                'id' => 702,
                'name' => 'media página – electrónica',
                'code' => 'H1',
                'status' => 'inactive',
            ),
            202 =>
            array (
                'id' => 703,
                'name' => 'medio litro',
                'code' => 'H2',
                'status' => 'inactive',
            ),
            203 =>
            array (
                'id' => 704,
                'name' => 'madeja',
                'code' => 'HA',
                'status' => 'inactive',
            ),
            204 =>
            array (
                'id' => 705,
                'name' => 'hectárea',
                'code' => 'HAR',
                'status' => 'inactive',
            ),
            205 =>
            array (
                'id' => 706,
                'name' => 'hectobar',
                'code' => 'HBA',
                'status' => 'inactive',
            ),
            206 =>
            array (
                'id' => 707,
                'name' => 'cien cajas',
                'code' => 'HBX',
                'status' => 'inactive',
            ),
            207 =>
            array (
                'id' => 708,
                'name' => 'cien cuentas',
                'code' => 'HC',
                'status' => 'inactive',
            ),
            208 =>
            array (
                'id' => 709,
                'name' => 'media docena',
                'code' => 'HD',
                'status' => 'inactive',
            ),
            209 =>
            array (
                'id' => 710,
                'name' => 'centésima de quilate',
                'code' => 'ÉL',
                'status' => 'inactive',
            ),
            210 =>
            array (
                'id' => 711,
                'name' => 'cien pies',
                'code' => 'HF',
                'status' => 'inactive',
            ),
            211 =>
            array (
                'id' => 712,
                'name' => 'hectogramo',
                'code' => 'HGM',
                'status' => 'inactive',
            ),
            212 =>
            array (
                'id' => 713,
                'name' => 'cien pies cúbicos',
                'code' => 'HH',
                'status' => 'inactive',
            ),
            213 =>
            array (
                'id' => 714,
                'name' => 'cien hojas',
                'code' => 'HI',
                'status' => 'inactive',
            ),
            214 =>
            array (
                'id' => 715,
                'name' => 'cien unidades internacionales',
                'code' => 'HIU',
                'status' => 'inactive',
            ),
            215 =>
            array (
                'id' => 716,
                'name' => 'caballo métrico',
                'code' => 'HJ',
                'status' => 'inactive',
            ),
            216 =>
            array (
                'id' => 717,
                'name' => 'cien kilogramos',
                'code' => 'HK',
                'status' => 'inactive',
            ),
            217 =>
            array (
                'id' => 718,
            'name' => 'cien pies (lineales)',
                'code' => 'HL',
                'status' => 'inactive',
            ),
            218 =>
            array (
                'id' => 719,
                'name' => 'hectolitro',
                'code' => 'HLT',
                'status' => 'inactive',
            ),
            219 =>
            array (
                'id' => 720,
                'name' => 'milla por hora',
                'code' => 'HM',
                'status' => 'inactive',
            ),
            220 =>
            array (
                'id' => 721,
                'name' => 'millones de metros cúbicos',
                'code' => 'HMQ',
                'status' => 'inactive',
            ),
            221 =>
            array (
                'id' => 722,
                'name' => 'hectómetro',
                'code' => 'HMT',
                'status' => 'inactive',
            ),
            222 =>
            array (
                'id' => 723,
                'name' => 'milímetro convencional de mercurio',
                'code' => 'HN',
                'status' => 'inactive',
            ),
            223 =>
            array (
                'id' => 724,
                'name' => 'cien onzas troy',
                'code' => 'HO',
                'status' => 'inactive',
            ),
            224 =>
            array (
                'id' => 725,
                'name' => 'milímetro convencional de agua',
                'code' => 'HP',
                'status' => 'inactive',
            ),
            225 =>
            array (
                'id' => 726,
                'name' => 'hectolitro de alcohol puro',
                'code' => 'HPA',
                'status' => 'inactive',
            ),
            226 =>
            array (
                'id' => 727,
                'name' => 'cien pies cuadrados',
                'code' => 'HS',
                'status' => 'inactive',
            ),
            227 =>
            array (
                'id' => 728,
                'name' => 'media hora',
                'code' => 'HT',
                'status' => 'inactive',
            ),
            228 =>
            array (
                'id' => 729,
                'name' => 'hertz',
                'code' => 'HTZ',
                'status' => 'inactive',
            ),
            229 =>
            array (
                'id' => 730,
                'name' => 'hora',
                'code' => 'HUR',
                'status' => 'active',
            ),
            230 =>
            array (
                'id' => 731,
                'name' => 'cien yardas',
                'code' => 'HY',
                'status' => 'inactive',
            ),
            231 =>
            array (
                'id' => 732,
                'name' => 'pulgada libra',
                'code' => 'IA',
                'status' => 'inactive',
            ),
            232 =>
            array (
                'id' => 733,
                'name' => 'contar por pulgada',
                'code' => 'IC',
                'status' => 'inactive',
            ),
            233 =>
            array (
                'id' => 734,
                'name' => 'persona',
                'code' => 'IE',
                'status' => 'inactive',
            ),
            234 =>
            array (
                'id' => 735,
                'name' => 'pulgadas de agua',
                'code' => 'IF',
                'status' => 'inactive',
            ),
            235 =>
            array (
                'id' => 736,
                'name' => 'columna pulgada',
                'code' => 'II',
                'status' => 'inactive',
            ),
            236 =>
            array (
                'id' => 737,
                'name' => 'pulgada por minuto',
                'code' => 'IL',
                'status' => 'inactive',
            ),
            237 =>
            array (
                'id' => 738,
                'name' => 'impresión',
                'code' => 'IM',
                'status' => 'inactive',
            ),
            238 =>
            array (
                'id' => 739,
                'name' => 'pulgada',
                'code' => 'INH',
                'status' => 'active',
            ),
            239 =>
            array (
                'id' => 740,
                'name' => 'pulgada cuadrada',
                'code' => 'INK',
                'status' => 'inactive',
            ),
            240 =>
            array (
                'id' => 741,
                'name' => 'pulgada en cubos',
                'code' => 'INQ',
                'status' => 'inactive',
            ),
            241 =>
            array (
                'id' => 742,
                'name' => 'póliza de seguros',
                'code' => 'IP',
                'status' => 'inactive',
            ),
            242 =>
            array (
                'id' => 743,
                'name' => 'conteo por centímetro',
                'code' => 'IT',
                'status' => 'inactive',
            ),
            243 =>
            array (
                'id' => 744,
            'name' => 'pulgada por segundo (velocidad lineal)',
                'code' => 'IU',
                'status' => 'inactive',
            ),
            244 =>
            array (
                'id' => 745,
            'name' => 'pulgada por segundo al cuadrado (aceleración)',
                'code' => 'IV',
                'status' => 'inactive',
            ),
            245 =>
            array (
                'id' => 746,
                'name' => 'julios por kilogramo',
                'code' => 'J2',
                'status' => 'inactive',
            ),
            246 =>
            array (
                'id' => 747,
                'name' => 'jumbo',
                'code' => 'JB',
                'status' => 'inactive',
            ),
            247 =>
            array (
                'id' => 748,
                'name' => 'joule por kelvin',
                'code' => 'JE',
                'status' => 'inactive',
            ),
            248 =>
            array (
                'id' => 749,
                'name' => 'jarra',
                'code' => 'JG',
                'status' => 'inactive',
            ),
            249 =>
            array (
                'id' => 750,
                'name' => 'megajulio por kilogramo',
                'code' => 'JK',
                'status' => 'inactive',
            ),
            250 =>
            array (
                'id' => 751,
                'name' => 'megajulio por metro cúbico',
                'code' => 'JM',
                'status' => 'inactive',
            ),
            251 =>
            array (
                'id' => 752,
                'name' => 'articulación',
                'code' => 'JO',
                'status' => 'inactive',
            ),
            252 =>
            array (
                'id' => 753,
                'name' => 'joule',
                'code' => 'JOU',
                'status' => 'inactive',
            ),
            253 =>
            array (
                'id' => 754,
                'name' => 'tarro',
                'code' => 'JR',
                'status' => 'inactive',
            ),
            254 =>
            array (
                'id' => 755,
                'name' => 'demanda de kilovatios',
                'code' => 'K1',
                'status' => 'inactive',
            ),
            255 =>
            array (
                'id' => 756,
                'name' => 'kilovoltios amperios reactivos de demanda',
                'code' => 'K2',
                'status' => 'inactive',
            ),
            256 =>
            array (
                'id' => 757,
                'name' => 'kilovoltio amperio hora reactiva',
                'code' => 'K3',
                'status' => 'inactive',
            ),
            257 =>
            array (
                'id' => 758,
            'name' => 'amperios kilovoltios (reactivos)',
                'code' => 'K5',
                'status' => 'inactive',
            ),
            258 =>
            array (
                'id' => 759,
                'name' => 'kilolitro',
                'code' => 'K6',
                'status' => 'inactive',
            ),
            259 =>
            array (
                'id' => 760,
                'name' => 'pastel',
                'code' => 'KA',
                'status' => 'inactive',
            ),
            260 =>
            array (
                'id' => 761,
                'name' => 'kilocharacter',
                'code' => 'KB',
                'status' => 'inactive',
            ),
            261 =>
            array (
                'id' => 762,
                'name' => 'kilobar',
                'code' => 'KBA',
                'status' => 'inactive',
            ),
            262 =>
            array (
                'id' => 763,
                'name' => 'kilogramo decimal',
                'code' => 'KD',
                'status' => 'inactive',
            ),
            263 =>
            array (
                'id' => 764,
                'name' => 'kelvin',
                'code' => 'KEL',
                'status' => 'inactive',
            ),
            264 =>
            array (
                'id' => 765,
                'name' => 'kilopacket',
                'code' => 'KF',
                'status' => 'inactive',
            ),
            265 =>
            array (
                'id' => 766,
                'name' => 'barrilete',
                'code' => 'KG',
                'status' => 'inactive',
            ),
            266 =>
            array (
                'id' => 767,
                'name' => 'kilogramo',
                'code' => 'KGM',
                'status' => 'active',
            ),
            267 =>
            array (
                'id' => 768,
                'name' => 'kilogramo por segundo',
                'code' => 'KGS',
                'status' => 'inactive',
            ),
            268 =>
            array (
                'id' => 769,
                'name' => 'kilohercio',
                'code' => 'KHZ',
                'status' => 'inactive',
            ),
            269 =>
            array (
                'id' => 770,
                'name' => 'Kilogramo por milímetro de ancho',
                'code' => 'KI',
                'status' => 'inactive',
            ),
            270 =>
            array (
                'id' => 771,
                'name' => 'kilosegmento',
                'code' => 'KJ',
                'status' => 'inactive',
            ),
            271 =>
            array (
                'id' => 772,
                'name' => 'kilojoule',
                'code' => 'KJO',
                'status' => 'inactive',
            ),
            272 =>
            array (
                'id' => 773,
                'name' => 'kilogramo por metro',
                'code' => 'KL',
                'status' => 'inactive',
            ),
            273 =>
            array (
                'id' => 774,
                'name' => 'kilómetro por hora',
                'code' => 'KMH',
                'status' => 'inactive',
            ),
            274 =>
            array (
                'id' => 775,
                'name' => 'kilometro cuadrado',
                'code' => 'KMK',
                'status' => 'inactive',
            ),
            275 =>
            array (
                'id' => 776,
                'name' => 'kilogramo por metro cúbico',
                'code' => 'KMQ',
                'status' => 'inactive',
            ),
            276 =>
            array (
                'id' => 777,
                'name' => 'kilogramo de nitrógeno',
                'code' => 'KNI',
                'status' => 'inactive',
            ),
            277 =>
            array (
                'id' => 778,
                'name' => 'kilogramo de sustancia nombrada',
                'code' => 'KNS',
                'status' => 'inactive',
            ),
            278 =>
            array (
                'id' => 779,
                'name' => 'nudo',
                'code' => 'KNT',
                'status' => 'inactive',
            ),
            279 =>
            array (
                'id' => 780,
                'name' => 'Milliequivalencia de potasa cáustica por gramo de producto.',
                'code' => 'KO',
                'status' => 'inactive',
            ),
            280 =>
            array (
                'id' => 781,
                'name' => 'kilopascal',
                'code' => 'KPA',
                'status' => 'inactive',
            ),
            281 =>
            array (
                'id' => 782,
            'name' => 'kilogramo de hidróxido de potasio (potasa cáustica)',
                'code' => 'KPH',
                'status' => 'inactive',
            ),
            282 =>
            array (
                'id' => 783,
                'name' => 'kilogramo de óxido de potasio',
                'code' => 'KPO',
                'status' => 'inactive',
            ),
            283 =>
            array (
                'id' => 784,
            'name' => 'kilogramo de pentóxido de fósforo (anhídrido fosfórico)',
                'code' => 'KPP',
                'status' => 'inactive',
            ),
            284 =>
            array (
                'id' => 785,
                'name' => 'KilorÃ¶ntgen',
                'code' => 'KR',
                'status' => 'inactive',
            ),
            285 =>
            array (
                'id' => 786,
                'name' => 'mil libras por pulgada cuadrada',
                'code' => 'KS',
                'status' => 'inactive',
            ),
            286 =>
            array (
                'id' => 787,
                'name' => 'kilogramo de sustancia 90% seca',
                'code' => 'KSD',
                'status' => 'inactive',
            ),
            287 =>
            array (
                'id' => 788,
            'name' => 'kilogramo de hidróxido de sodio (soda cáustica)',
                'code' => 'KSH',
                'status' => 'inactive',
            ),
            288 =>
            array (
                'id' => 789,
                'name' => 'equipo',
                'code' => 'KT',
                'status' => 'inactive',
            ),
            289 =>
            array (
                'id' => 790,
                'name' => 'kilómetro',
                'code' => 'KTM',
                'status' => 'inactive',
            ),
            290 =>
            array (
                'id' => 791,
                'name' => 'kilotonne',
                'code' => 'KTN',
                'status' => 'inactive',
            ),
            291 =>
            array (
                'id' => 792,
                'name' => 'kilogramo de uranio',
                'code' => 'KUR',
                'status' => 'inactive',
            ),
            292 =>
            array (
                'id' => 793,
                'name' => 'kilovoltio – ampere',
                'code' => 'KVA',
                'status' => 'inactive',
            ),
            293 =>
            array (
                'id' => 794,
                'name' => 'kilovar',
                'code' => 'KVR',
                'status' => 'inactive',
            ),
            294 =>
            array (
                'id' => 795,
                'name' => 'kilovoltio',
                'code' => 'KVT',
                'status' => 'inactive',
            ),
            295 =>
            array (
                'id' => 796,
                'name' => 'kilogramos por milímetro',
                'code' => 'KW',
                'status' => 'inactive',
            ),
            296 =>
            array (
                'id' => 797,
                'name' => 'kilovatios hora',
                'code' => 'KWH',
                'status' => 'inactive',
            ),
            297 =>
            array (
                'id' => 798,
                'name' => 'kilovatio',
                'code' => 'KWT',
                'status' => 'inactive',
            ),
            298 =>
            array (
                'id' => 799,
                'name' => 'mililitro por kilogramo',
                'code' => 'KX',
                'status' => 'inactive',
            ),
            299 =>
            array (
                'id' => 800,
                'name' => 'litro por minuto',
                'code' => 'L2',
                'status' => 'inactive',
            ),
            300 =>
            array (
                'id' => 801,
                'name' => 'libra por pulgada cúbica',
                'code' => 'LA',
                'status' => 'inactive',
            ),
            301 =>
            array (
                'id' => 802,
                'name' => 'libra',
                'code' => 'LBR',
                'status' => 'active',
            ),
            302 =>
            array (
                'id' => 803,
                'name' => 'libra troy',
                'code' => 'LBT',
                'status' => 'inactive',
            ),
            303 =>
            array (
                'id' => 804,
                'name' => 'centímetro lineal',
                'code' => 'LC',
                'status' => 'inactive',
            ),
            304 =>
            array (
                'id' => 805,
                'name' => 'litro por día',
                'code' => 'LD',
                'status' => 'inactive',
            ),
            305 =>
            array (
                'id' => 806,
                'name' => 'lite',
                'code' => 'LE',
                'status' => 'inactive',
            ),
            306 =>
            array (
                'id' => 807,
                'name' => 'hoja',
                'code' => 'LEF',
                'status' => 'inactive',
            ),
            307 =>
            array (
                'id' => 808,
                'name' => 'pie lineal',
                'code' => 'LF',
                'status' => 'inactive',
            ),
            308 =>
            array (
                'id' => 809,
                'name' => 'hora de trabajo',
                'code' => 'LH',
                'status' => 'inactive',
            ),
            309 =>
            array (
                'id' => 810,
                'name' => 'pulgada lineal',
                'code' => 'LI',
                'status' => 'inactive',
            ),
            310 =>
            array (
                'id' => 811,
                'name' => 'spray grande',
                'code' => 'LJ',
                'status' => 'inactive',
            ),
            311 =>
            array (
                'id' => 812,
                'name' => 'enlazar',
                'code' => 'LK',
                'status' => 'inactive',
            ),
            312 =>
            array (
                'id' => 813,
                'name' => 'metro lineal',
                'code' => 'LM',
                'status' => 'inactive',
            ),
            313 =>
            array (
                'id' => 814,
                'name' => 'longitud',
                'code' => 'LN',
                'status' => 'inactive',
            ),
            314 =>
            array (
                'id' => 815,
                'name' => 'mucho',
                'code' => 'LO',
                'status' => 'inactive',
            ),
            315 =>
            array (
                'id' => 816,
                'name' => 'libra liquida',
                'code' => 'LP',
                'status' => 'inactive',
            ),
            316 =>
            array (
                'id' => 817,
                'name' => 'litro de alcohol puro',
                'code' => 'LPA',
                'status' => 'inactive',
            ),
            317 =>
            array (
                'id' => 818,
                'name' => 'capa',
                'code' => 'LR',
                'status' => 'inactive',
            ),
            318 =>
            array (
                'id' => 819,
                'name' => 'Suma global',
                'code' => 'LS',
                'status' => 'inactive',
            ),
            319 =>
            array (
                'id' => 820,
            'name' => 'ton (Reino Unido) o longton (EE. UU.)',
                'code' => 'LTN',
                'status' => 'inactive',
            ),
            320 =>
            array (
                'id' => 821,
                'name' => 'litro',
                'code' => 'LTR',
                'status' => 'active',
            ),
            321 =>
            array (
                'id' => 822,
                'name' => 'lumen',
                'code' => 'LUM',
                'status' => 'inactive',
            ),
            322 =>
            array (
                'id' => 823,
                'name' => 'lux',
                'code' => 'LUX',
                'status' => 'inactive',
            ),
            323 =>
            array (
                'id' => 824,
                'name' => 'yarda lineal por libra',
                'code' => 'LX',
                'status' => 'inactive',
            ),
            324 =>
            array (
                'id' => 825,
                'name' => 'yarda lineal',
                'code' => 'LY',
                'status' => 'inactive',
            ),
            325 =>
            array (
                'id' => 826,
                'name' => 'cinta magnética',
                'code' => 'M0',
                'status' => 'inactive',
            ),
            326 =>
            array (
                'id' => 827,
                'name' => 'miligramos por litro',
                'code' => 'M1',
                'status' => 'inactive',
            ),
            327 =>
            array (
                'id' => 828,
                'name' => 'valor monetario',
                'code' => 'M4',
                'status' => 'inactive',
            ),
            328 =>
            array (
                'id' => 829,
                'name' => 'microcurie',
                'code' => 'M5',
                'status' => 'inactive',
            ),
            329 =>
            array (
                'id' => 830,
                'name' => 'micropulgada',
                'code' => 'M7',
                'status' => 'inactive',
            ),
            330 =>
            array (
                'id' => 831,
                'name' => 'millones de Btu por 1000 pies cúbicos',
                'code' => 'M9',
                'status' => 'inactive',
            ),
            331 =>
            array (
                'id' => 832,
                'name' => 'máquina por unidad',
                'code' => 'MA',
                'status' => 'inactive',
            ),
            332 =>
            array (
                'id' => 833,
                'name' => 'mega litro',
                'code' => 'MAL',
                'status' => 'inactive',
            ),
            333 =>
            array (
                'id' => 834,
                'name' => 'megametro',
                'code' => 'MAM',
                'status' => 'inactive',
            ),
            334 =>
            array (
                'id' => 835,
                'name' => 'megavatio',
                'code' => 'MAW',
                'status' => 'inactive',
            ),
            335 =>
            array (
                'id' => 836,
                'name' => 'mil equivalentes de ladrillo estándar',
                'code' => 'MBE',
                'status' => 'inactive',
            ),
            336 =>
            array (
                'id' => 837,
                'name' => 'mil pies de tabla',
                'code' => 'MBF',
                'status' => 'inactive',
            ),
            337 =>
            array (
                'id' => 838,
                'name' => 'milibar',
                'code' => 'MBR',
                'status' => 'inactive',
            ),
            338 =>
            array (
                'id' => 839,
                'name' => 'microgramo',
                'code' => 'MC',
                'status' => 'inactive',
            ),
            339 =>
            array (
                'id' => 840,
                'name' => 'milicurie',
                'code' => 'MCU',
                'status' => 'inactive',
            ),
            340 =>
            array (
                'id' => 841,
                'name' => 'aire seco tonelada métrica',
                'code' => 'MD',
                'status' => 'inactive',
            ),
            341 =>
            array (
                'id' => 842,
                'name' => 'miligramo por pie cuadrado por lado',
                'code' => 'MF',
                'status' => 'inactive',
            ),
            342 =>
            array (
                'id' => 843,
                'name' => 'miligramo',
                'code' => 'MGM',
                'status' => 'inactive',
            ),
            343 =>
            array (
                'id' => 844,
                'name' => 'megahercio',
                'code' => 'MGM',
                'status' => 'inactive',
            ),
            344 =>
            array (
                'id' => 845,
                'name' => 'milla cuadrada',
                'code' => 'MIK',
                'status' => 'inactive',
            ),
            345 =>
            array (
                'id' => 846,
                'name' => 'mil',
                'code' => 'MIL',
                'status' => 'inactive',
            ),
            346 =>
            array (
                'id' => 847,
                'name' => 'minuto',
                'code' => 'MIN',
                'status' => 'inactive',
            ),
            347 =>
            array (
                'id' => 848,
                'name' => 'millón',
                'code' => 'MIO',
                'status' => 'inactive',
            ),
            348 =>
            array (
                'id' => 849,
                'name' => 'millones de unidades internacionales',
                'code' => 'MIU',
                'status' => 'inactive',
            ),
            349 =>
            array (
                'id' => 850,
                'name' => 'miligramo por pulgada cuadrada',
                'code' => 'MK',
                'status' => 'inactive',
            ),
            350 =>
            array (
                'id' => 851,
                'name' => 'mil millones',
                'code' => 'MLD',
                'status' => 'inactive',
            ),
            351 =>
            array (
                'id' => 852,
                'name' => 'mililitro',
                'code' => 'MLT',
                'status' => 'inactive',
            ),
            352 =>
            array (
                'id' => 853,
                'name' => 'milímetro cuadrado',
                'code' => 'MMK',
                'status' => 'inactive',
            ),
            353 =>
            array (
                'id' => 854,
                'name' => 'milímetro cúbico',
                'code' => 'MMQ',
                'status' => 'inactive',
            ),
            354 =>
            array (
                'id' => 855,
                'name' => 'milímetro',
                'code' => 'MMT',
                'status' => 'inactive',
            ),
            355 =>
            array (
                'id' => 856,
                'name' => 'mes',
                'code' => 'LUN',
                'status' => 'inactive',
            ),
            356 =>
            array (
                'id' => 857,
                'name' => 'megapascal',
                'code' => 'MPA',
                'status' => 'inactive',
            ),
            357 =>
            array (
                'id' => 858,
                'name' => 'mil metros',
                'code' => 'MQ',
                'status' => 'inactive',
            ),
            358 =>
            array (
                'id' => 859,
                'name' => 'metro cúbico por hora',
                'code' => 'MQH',
                'status' => 'inactive',
            ),
            359 =>
            array (
                'id' => 860,
                'name' => 'metro cúbico por segundo',
                'code' => 'MQS',
                'status' => 'inactive',
            ),
            360 =>
            array (
                'id' => 861,
                'name' => 'metro por segundo al cuadrado',
                'code' => 'MSK',
                'status' => 'inactive',
            ),
            361 =>
            array (
                'id' => 862,
                'name' => 'estera',
                'code' => 'MT',
                'status' => 'inactive',
            ),
            362 =>
            array (
                'id' => 863,
                'name' => 'metro cuadrado',
                'code' => 'MTK',
                'status' => 'inactive',
            ),
            363 =>
            array (
                'id' => 864,
                'name' => 'Metro cúbico',
                'code' => 'MTQ',
                'status' => 'inactive',
            ),
            364 =>
            array (
                'id' => 865,
                'name' => 'metro',
                'code' => 'MTR',
                'status' => 'active',
            ),
            365 =>
            array (
                'id' => 866,
                'name' => 'metro por segundo',
                'code' => 'MTS',
                'status' => 'inactive',
            ),
            366 =>
            array (
                'id' => 867,
                'name' => 'numero de mults',
                'code' => 'MV',
                'status' => 'inactive',
            ),
            367 =>
            array (
                'id' => 868,
                'name' => 'megavolt – ampere',
                'code' => 'MVA',
                'status' => 'inactive',
            ),
            368 =>
            array (
                'id' => 869,
            'name' => 'megavatios hora (1000 kW.h)',
                'code' => 'MWH',
                'status' => 'inactive',
            ),
            369 =>
            array (
                'id' => 870,
                'name' => 'calorías de la pluma',
                'code' => 'N1',
                'status' => 'inactive',
            ),
            370 =>
            array (
                'id' => 871,
                'name' => 'número de líneas',
                'code' => 'N2',
                'status' => 'inactive',
            ),
            371 =>
            array (
                'id' => 872,
                'name' => 'punto de impresión',
                'code' => 'N3',
                'status' => 'inactive',
            ),
            372 =>
            array (
                'id' => 873,
                'name' => 'miligramo por kilogramo',
                'code' => 'NA',
                'status' => 'inactive',
            ),
            373 =>
            array (
                'id' => 874,
                'name' => 'número de artículos',
                'code' => 'NAR',
                'status' => 'inactive',
            ),
            374 =>
            array (
                'id' => 875,
                'name' => 'barcaza',
                'code' => 'NB',
                'status' => 'inactive',
            ),
            375 =>
            array (
                'id' => 876,
                'name' => 'número de bobinas',
                'code' => 'NBB',
                'status' => 'inactive',
            ),
            376 =>
            array (
                'id' => 877,
                'name' => 'coche',
                'code' => 'NC',
                'status' => 'inactive',
            ),
            377 =>
            array (
                'id' => 878,
                'name' => 'número de celdas',
                'code' => 'NCL',
                'status' => 'inactive',
            ),
            378 =>
            array (
                'id' => 879,
                'name' => 'barril neto',
                'code' => 'ND',
                'status' => 'inactive',
            ),
            379 =>
            array (
                'id' => 880,
                'name' => 'litro neto',
                'code' => 'NE',
                'status' => 'inactive',
            ),
            380 =>
            array (
                'id' => 881,
                'name' => 'newton',
                'code' => 'NEW',
                'status' => 'inactive',
            ),
            381 =>
            array (
                'id' => 882,
                'name' => 'mensaje',
                'code' => 'NF',
                'status' => 'inactive',
            ),
            382 =>
            array (
                'id' => 883,
            'name' => 'galón neto (nosotros)',
                'code' => 'NG',
                'status' => 'inactive',
            ),
            383 =>
            array (
                'id' => 884,
                'name' => 'hora del mensaje',
                'code' => 'NH',
                'status' => 'inactive',
            ),
            384 =>
            array (
                'id' => 885,
                'name' => 'galón imperial neto',
                'code' => 'NI',
                'status' => 'inactive',
            ),
            385 =>
            array (
                'id' => 886,
                'name' => 'número de unidades internacionales',
                'code' => 'NIU',
                'status' => 'inactive',
            ),
            386 =>
            array (
                'id' => 887,
                'name' => 'número de pantallas',
                'code' => 'NJ',
                'status' => 'inactive',
            ),
            387 =>
            array (
                'id' => 888,
                'name' => 'carga',
                'code' => 'NL',
                'status' => 'inactive',
            ),
            388 =>
            array (
                'id' => 889,
                'name' => 'milla nautica',
                'code' => 'MNI',
                'status' => 'inactive',
            ),
            389 =>
            array (
                'id' => 890,
                'name' => 'número de paquetes',
                'code' => 'NMP',
                'status' => 'inactive',
            ),
            390 =>
            array (
                'id' => 891,
                'name' => 'entrenar',
                'code' => 'NN',
                'status' => 'inactive',
            ),
            391 =>
            array (
                'id' => 892,
                'name' => 'número de parcelas',
                'code' => 'NPL',
                'status' => 'inactive',
            ),
            392 =>
            array (
                'id' => 893,
                'name' => 'numero de pares',
                'code' => 'NPR',
                'status' => 'inactive',
            ),
            393 =>
            array (
                'id' => 894,
                'name' => 'numero de partes',
                'code' => 'TNP',
                'status' => 'inactive',
            ),
            394 =>
            array (
                'id' => 895,
                'name' => 'mho',
                'code' => 'NQ',
                'status' => 'inactive',
            ),
            395 =>
            array (
                'id' => 896,
                'name' => 'micromho',
                'code' => 'NR',
                'status' => 'inactive',
            ),
            396 =>
            array (
                'id' => 897,
                'name' => 'número de rollos',
                'code' => 'NRL',
                'status' => 'inactive',
            ),
            397 =>
            array (
                'id' => 898,
                'name' => 'tonelada neta',
                'code' => 'NT',
                'status' => 'inactive',
            ),
            398 =>
            array (
                'id' => 899,
                'name' => 'registro neto de toneladas',
                'code' => 'NTT',
                'status' => 'inactive',
            ),
            399 =>
            array (
                'id' => 900,
                'name' => 'medidor de newton',
                'code' => 'NU',
                'status' => 'inactive',
            ),
            400 =>
            array (
                'id' => 901,
                'name' => 'vehículo',
                'code' => 'NV',
                'status' => 'inactive',
            ),
            401 =>
            array (
                'id' => 902,
                'name' => 'parte por mil',
                'code' => 'NX',
                'status' => 'inactive',
            ),
            402 =>
            array (
                'id' => 903,
                'name' => 'libra por aire seco tonelada métrica',
                'code' => 'NY',
                'status' => 'inactive',
            ),
            403 =>
            array (
                'id' => 904,
                'name' => 'panel',
                'code' => 'OA',
                'status' => 'inactive',
            ),
            404 =>
            array (
                'id' => 905,
                'name' => 'ohm',
                'code' => 'OHM',
                'status' => 'inactive',
            ),
            405 =>
            array (
                'id' => 906,
                'name' => 'onza por yarda cuadrada',
                'code' => 'EN',
                'status' => 'inactive',
            ),
            406 =>
            array (
                'id' => 907,
                'name' => 'onza',
                'code' => 'ONZ',
                'status' => 'inactive',
            ),
            407 =>
            array (
                'id' => 908,
                'name' => 'Dos paquetes',
                'code' => 'OP',
                'status' => 'inactive',
            ),
            408 =>
            array (
                'id' => 909,
                'name' => 'hora extra',
                'code' => 'OT',
                'status' => 'inactive',
            ),
            409 =>
            array (
                'id' => 910,
                'name' => 'onza av',
                'code' => 'ONZ',
                'status' => 'inactive',
            ),
            410 =>
            array (
                'id' => 911,
            'name' => 'onza líquida (US)',
                'code' => 'OZA',
                'status' => 'inactive',
            ),
            411 =>
            array (
                'id' => 912,
            'name' => 'onza líquida (Reino Unido)',
                'code' => 'OZI',
                'status' => 'inactive',
            ),
            412 =>
            array (
                'id' => 913,
                'name' => 'pagina – electronica',
                'code' => 'P0',
                'status' => 'inactive',
            ),
            413 =>
            array (
                'id' => 914,
                'name' => 'por ciento',
                'code' => 'P1',
                'status' => 'inactive',
            ),
            414 =>
            array (
                'id' => 915,
                'name' => 'libra por pie',
                'code' => 'P2',
                'status' => 'inactive',
            ),
            415 =>
            array (
                'id' => 916,
                'name' => 'paquete de tres',
                'code' => 'P3',
                'status' => 'inactive',
            ),
            416 =>
            array (
                'id' => 917,
                'name' => 'paquete de cuatro',
                'code' => 'P4',
                'status' => 'inactive',
            ),
            417 =>
            array (
                'id' => 918,
                'name' => 'paquete de cinco',
                'code' => 'P5',
                'status' => 'inactive',
            ),
            418 =>
            array (
                'id' => 919,
                'name' => 'paquete de seis',
                'code' => 'P6',
                'status' => 'inactive',
            ),
            419 =>
            array (
                'id' => 920,
                'name' => 'paquete de siete',
                'code' => 'P7',
                'status' => 'inactive',
            ),
            420 =>
            array (
                'id' => 921,
                'name' => 'paquete de ocho',
                'code' => 'P8',
                'status' => 'inactive',
            ),
            421 =>
            array (
                'id' => 922,
                'name' => 'paquete de nueve',
                'code' => 'P9',
                'status' => 'inactive',
            ),
            422 =>
            array (
                'id' => 923,
                'name' => 'paquete',
                'code' => 'PA',
                'status' => 'inactive',
            ),
            423 =>
            array (
                'id' => 924,
                'name' => 'pascal',
                'code' => 'PAL',
                'status' => 'inactive',
            ),
            424 =>
            array (
                'id' => 925,
                'name' => 'par de pulgadas',
                'code' => 'PB',
                'status' => 'inactive',
            ),
            425 =>
            array (
                'id' => 926,
                'name' => 'almohadilla',
                'code' => 'PD',
                'status' => 'inactive',
            ),
            426 =>
            array (
                'id' => 927,
                'name' => 'equivalente en libras',
                'code' => 'PE',
                'status' => 'inactive',
            ),
            427 =>
            array (
                'id' => 928,
            'name' => 'palet (ascensor)',
                'code' => 'PF',
                'status' => 'inactive',
            ),
            428 =>
            array (
                'id' => 929,
                'name' => 'plato',
                'code' => 'PG',
                'status' => 'inactive',
            ),
            429 =>
            array (
                'id' => 930,
                'name' => 'galón de prueba',
                'code' => 'PGL',
                'status' => 'inactive',
            ),
            430 =>
            array (
                'id' => 931,
                'name' => 'tono',
                'code' => 'PI',
                'status' => 'inactive',
            ),
            431 =>
            array (
                'id' => 932,
                'name' => 'paquete',
                'code' => 'PK',
                'status' => 'inactive',
            ),
            432 =>
            array (
                'id' => 933,
                'name' => 'cubo',
                'code' => 'PL',
                'status' => 'inactive',
            ),
            433 =>
            array (
                'id' => 934,
                'name' => 'porcentaje de libra',
                'code' => 'PM',
                'status' => 'inactive',
            ),
            434 =>
            array (
                'id' => 935,
                'name' => 'libra neta',
                'code' => 'PN',
                'status' => 'inactive',
            ),
            435 =>
            array (
                'id' => 936,
                'name' => 'libra por pulgada de longitud',
                'code' => 'PO',
                'status' => 'inactive',
            ),
            436 =>
            array (
                'id' => 937,
                'name' => 'página por pulgada',
                'code' => 'PQ',
                'status' => 'inactive',
            ),
            437 =>
            array (
                'id' => 938,
                'name' => 'par',
                'code' => 'PR',
                'status' => 'inactive',
            ),
            438 =>
            array (
                'id' => 939,
                'name' => 'fuerza de libra por pulgada cuadrada',
                'code' => 'PD',
                'status' => 'inactive',
            ),
            439 =>
            array (
                'id' => 940,
                'name' => 'pinta',
                'code' => 'PT',
                'status' => 'inactive',
            ),
            440 =>
            array (
                'id' => 941,
                'name' => 'pinta seca',
                'code' => 'PTD',
                'status' => 'inactive',
            ),
            441 =>
            array (
                'id' => 942,
            'name' => 'pinta (Reino Unido)',
                'code' => 'PTI',
                'status' => 'inactive',
            ),
            442 =>
            array (
                'id' => 943,
            'name' => 'pinta liquida (US)',
                'code' => 'PTL',
                'status' => 'inactive',
            ),
            443 =>
            array (
                'id' => 944,
                'name' => 'bandeja / paquete de bandeja',
                'code' => 'PU',
                'status' => 'inactive',
            ),
            444 =>
            array (
                'id' => 945,
            'name' => 'media pinta (US)',
                'code' => 'PV',
                'status' => 'inactive',
            ),
            445 =>
            array (
                'id' => 946,
                'name' => 'libra por pulgada de ancho',
                'code' => 'PW',
                'status' => 'inactive',
            ),
            446 =>
            array (
                'id' => 947,
            'name' => 'Peck Dry (US)',
                'code' => 'PY',
                'status' => 'inactive',
            ),
            447 =>
            array (
                'id' => 948,
            'name' => 'Peck Dry (Reino Unido)',
                'code' => 'PZ',
                'status' => 'inactive',
            ),
            448 =>
            array (
                'id' => 949,
                'name' => 'comida',
                'code' => 'Q3',
                'status' => 'inactive',
            ),
            449 =>
            array (
                'id' => 950,
                'name' => 'página – facsímil',
                'code' => 'QA',
                'status' => 'inactive',
            ),
            450 =>
            array (
                'id' => 951,
            'name' => 'cuarto (de un año)',
                'code' => 'QAN',
                'status' => 'inactive',
            ),
            451 =>
            array (
                'id' => 952,
                'name' => 'página – copia impresa',
                'code' => 'QB',
                'status' => 'inactive',
            ),
            452 =>
            array (
                'id' => 953,
                'name' => 'cuarto de docena',
                'code' => 'QD',
                'status' => 'inactive',
            ),
            453 =>
            array (
                'id' => 954,
                'name' => 'un cuarto de hora',
                'code' => 'QH',
                'status' => 'inactive',
            ),
            454 =>
            array (
                'id' => 955,
                'name' => 'cuarto de kilogramo',
                'code' => 'QK',
                'status' => 'inactive',
            ),
            455 =>
            array (
                'id' => 956,
                'name' => 'mano de papel',
                'code' => 'QR',
                'status' => 'inactive',
            ),
            456 =>
            array (
                'id' => 957,
            'name' => 'cuarto de galón (US)',
                'code' => 'QT',
                'status' => 'inactive',
            ),
            457 =>
            array (
                'id' => 958,
            'name' => 'cuarto seco (EE. UU.)',
                'code' => 'QTD',
                'status' => 'inactive',
            ),
            458 =>
            array (
                'id' => 959,
            'name' => 'cuarto de galón (Reino Unido)',
                'code' => 'QTI',
                'status' => 'inactive',
            ),
            459 =>
            array (
                'id' => 960,
            'name' => 'cuarto líquido (US)',
                'code' => 'QTL',
                'status' => 'inactive',
            ),
            460 =>
            array (
                'id' => 961,
            'name' => 'cuarto (UK)',
                'code' => 'QTR',
                'status' => 'inactive',
            ),
            461 =>
            array (
                'id' => 962,
                'name' => 'pica',
                'code' => 'R1',
                'status' => 'inactive',
            ),
            462 =>
            array (
                'id' => 963,
                'name' => 'caloría',
                'code' => 'R4',
                'status' => 'inactive',
            ),
            463 =>
            array (
                'id' => 964,
                'name' => 'mil metros cúbicos',
                'code' => 'R9',
                'status' => 'inactive',
            ),
            464 =>
            array (
                'id' => 965,
                'name' => 'estante',
                'code' => 'RA',
                'status' => 'inactive',
            ),
            465 =>
            array (
                'id' => 966,
                'name' => 'barra',
                'code' => 'RD',
                'status' => 'inactive',
            ),
            466 =>
            array (
                'id' => 967,
                'name' => 'anillo',
                'code' => 'RG',
                'status' => 'inactive',
            ),
            467 =>
            array (
                'id' => 968,
                'name' => 'hora de funcionamiento o de funcionamiento',
                'code' => 'RH',
                'status' => 'inactive',
            ),
            468 =>
            array (
                'id' => 969,
                'name' => 'medida métrica rollo',
                'code' => 'RK',
                'status' => 'inactive',
            ),
            469 =>
            array (
                'id' => 970,
                'name' => 'carrete',
                'code' => 'RL',
                'status' => 'inactive',
            ),
            470 =>
            array (
                'id' => 971,
                'name' => 'resma',
                'code' => 'RM',
                'status' => 'inactive',
            ),
            471 =>
            array (
                'id' => 972,
                'name' => 'medida métrica de resma',
                'code' => 'RN',
                'status' => 'inactive',
            ),
            472 =>
            array (
                'id' => 973,
                'name' => 'rodar',
                'code' => 'RO',
                'status' => 'inactive',
            ),
            473 =>
            array (
                'id' => 974,
                'name' => 'libra por resma',
                'code' => 'RP',
                'status' => 'inactive',
            ),
            474 =>
            array (
                'id' => 975,
                'name' => 'revoluciones por minuto',
                'code' => 'RPM',
                'status' => 'inactive',
            ),
            475 =>
            array (
                'id' => 976,
                'name' => 'revoluciones por segundo',
                'code' => 'RPS',
                'status' => 'inactive',
            ),
            476 =>
            array (
                'id' => 977,
                'name' => 'Reiniciar',
                'code' => 'RS',
                'status' => 'inactive',
            ),
            477 =>
            array (
                'id' => 978,
                'name' => 'ingreso tonelada milla',
                'code' => 'RT',
                'status' => 'inactive',
            ),
            478 =>
            array (
                'id' => 979,
                'name' => 'correr',
                'code' => 'RU',
                'status' => 'inactive',
            ),
            479 =>
            array (
                'id' => 980,
                'name' => 'pie cuadrado por segundo',
                'code' => 'S3',
                'status' => 'inactive',
            ),
            480 =>
            array (
                'id' => 981,
                'name' => 'metro cuadrado por segundo',
                'code' => 'S4',
                'status' => 'inactive',
            ),
            481 =>
            array (
                'id' => 982,
                'name' => 'sesenta cuartos de pulgada',
                'code' => 'S5',
                'status' => 'inactive',
            ),
            482 =>
            array (
                'id' => 983,
                'name' => 'sesión',
                'code' => 'S6',
                'status' => 'inactive',
            ),
            483 =>
            array (
                'id' => 984,
                'name' => 'unidad de almacenamiento',
                'code' => 'S7',
                'status' => 'inactive',
            ),
            484 =>
            array (
                'id' => 985,
                'name' => 'unidad de publicidad estándar',
                'code' => 'S8',
                'status' => 'inactive',
            ),
            485 =>
            array (
                'id' => 986,
                'name' => 'saco',
                'code' => 'SA',
                'status' => 'inactive',
            ),
            486 =>
            array (
                'id' => 987,
            'name' => 'medio año (6 meses)',
                'code' => 'SAN',
                'status' => 'inactive',
            ),
            487 =>
            array (
                'id' => 988,
                'name' => 'Puntuación',
                'code' => 'OCS',
                'status' => 'inactive',
            ),
            488 =>
            array (
                'id' => 989,
                'name' => 'escrúpulo',
                'code' => 'SCR',
                'status' => 'inactive',
            ),
            489 =>
            array (
                'id' => 990,
                'name' => 'libra solida',
                'code' => 'SD',
                'status' => 'inactive',
            ),
            490 =>
            array (
                'id' => 991,
                'name' => 'sección',
                'code' => 'SE',
                'status' => 'inactive',
            ),
            491 =>
            array (
                'id' => 992,
                'name' => 'segundo',
                'code' => 'SEC',
                'status' => 'inactive',
            ),
            492 =>
            array (
                'id' => 993,
                'name' => 'conjunto',
                'code' => 'SET',
                'status' => 'inactive',
            ),
            493 =>
            array (
                'id' => 994,
                'name' => 'segmento',
                'code' => 'SG',
                'status' => 'inactive',
            ),
            494 =>
            array (
                'id' => 995,
                'name' => 'tonelada de envío',
                'code' => 'SHT',
                'status' => 'inactive',
            ),
            495 =>
            array (
                'id' => 996,
                'name' => 'siemens',
                'code' => 'SIE',
                'status' => 'inactive',
            ),
            496 =>
            array (
                'id' => 997,
                'name' => 'camión cisterna dividido',
                'code' => 'SK',
                'status' => 'inactive',
            ),
            497 =>
            array (
                'id' => 998,
                'name' => 'hoja de deslizamiento',
                'code' => 'SL',
                'status' => 'inactive',
            ),
            498 =>
            array (
                'id' => 999,
            'name' => 'milla (milla estatutaria)',
                'code' => 'SMI',
                'status' => 'inactive',
            ),
            499 =>
            array (
                'id' => 1000,
                'name' => 'varilla cuadrada',
                'code' => 'SN',
                'status' => 'inactive',
            ),
        ));
        \DB::table('measure_units')->insert(array (
            0 =>
            array (
                'id' => 1001,
                'name' => 'carrete',
                'code' => 'SO',
                'status' => 'inactive',
            ),
            1 =>
            array (
                'id' => 1002,
                'name' => 'paquete de estante',
                'code' => 'SP',
                'status' => 'inactive',
            ),
            2 =>
            array (
                'id' => 1003,
                'name' => 'cuadrado',
                'code' => 'SQ',
                'status' => 'inactive',
            ),
            3 =>
            array (
                'id' => 1004,
                'name' => 'tira',
                'code' => 'SR',
                'status' => 'inactive',
            ),
            4 =>
            array (
                'id' => 1005,
                'name' => 'hoja métrica medida',
                'code' => 'SS',
                'status' => 'inactive',
            ),
            5 =>
            array (
                'id' => 1006,
            'name' => 'corto estándar (7200 partidos)',
                'code' => 'SST',
                'status' => 'inactive',
            ),
            6 =>
            array (
                'id' => 1007,
                'name' => 'hoja',
                'code' => 'ST',
                'status' => 'inactive',
            ),
            7 =>
            array (
                'id' => 1008,
            'name' => 'piedra (Reino Unido)',
                'code' => 'ITS',
                'status' => 'inactive',
            ),
            8 =>
            array (
                'id' => 1009,
            'name' => 'tonelada (US) o tonelada corta (UK / US)',
                'code' => 'STN',
                'status' => 'inactive',
            ),
            9 =>
            array (
                'id' => 1010,
                'name' => 'patinar',
                'code' => 'SV',
                'status' => 'inactive',
            ),
            10 =>
            array (
                'id' => 1011,
                'name' => 'madeja',
                'code' => 'SO',
                'status' => 'inactive',
            ),
            11 =>
            array (
                'id' => 1012,
                'name' => 'envío',
                'code' => 'SX',
                'status' => 'inactive',
            ),
            12 =>
            array (
                'id' => 1013,
                'name' => 'Línea de telecomunicaciones en servicio.',
                'code' => 'T0',
                'status' => 'inactive',
            ),
            13 =>
            array (
                'id' => 1014,
                'name' => 'mil libras brutas',
                'code' => 'T1',
                'status' => 'inactive',
            ),
            14 =>
            array (
                'id' => 1015,
                'name' => 'mil piezas',
                'code' => 'T3',
                'status' => 'inactive',
            ),
            15 =>
            array (
                'id' => 1016,
                'name' => 'bolsa de mil',
                'code' => 'T4',
                'status' => 'inactive',
            ),
            16 =>
            array (
                'id' => 1017,
                'name' => 'caja de mil',
                'code' => 'T5',
                'status' => 'inactive',
            ),
            17 =>
            array (
                'id' => 1018,
            'name' => 'mil galones (US)',
                'code' => 'T6',
                'status' => 'inactive',
            ),
            18 =>
            array (
                'id' => 1019,
                'name' => 'mil impresiones',
                'code' => 'T7',
                'status' => 'inactive',
            ),
            19 =>
            array (
                'id' => 1020,
                'name' => 'mil pulgadas lineales',
                'code' => 'T8',
                'status' => 'inactive',
            ),
            20 =>
            array (
                'id' => 1021,
                'name' => 'décimo pie cúbico',
                'code' => 'TA',
                'status' => 'inactive',
            ),
            21 =>
            array (
                'id' => 1022,
            'name' => 'Kiloampere hora (mil amperios hora)',
                'code' => 'TAH',
                'status' => 'inactive',
            ),
            22 =>
            array (
                'id' => 1023,
                'name' => 'camion',
                'code' => 'TC',
                'status' => 'inactive',
            ),
            23 =>
            array (
                'id' => 1024,
                'name' => 'termia',
                'code' => 'TD',
                'status' => 'inactive',
            ),
            24 =>
            array (
                'id' => 1025,
                'name' => 'totalizador',
                'code' => 'TE',
                'status' => 'inactive',
            ),
            25 =>
            array (
                'id' => 1026,
                'name' => 'diez metros cuadrados',
                'code' => 'TF',
                'status' => 'inactive',
            ),
            26 =>
            array (
                'id' => 1027,
                'name' => 'mil pulgadas cuadradas',
                'code' => 'TI',
                'status' => 'inactive',
            ),
            27 =>
            array (
                'id' => 1028,
                'name' => 'mil centímetros cuadrados',
                'code' => 'TJ',
                'status' => 'inactive',
            ),
            28 =>
            array (
                'id' => 1029,
                'name' => 'tanque rectangular',
                'code' => 'TK',
                'status' => 'inactive',
            ),
            29 =>
            array (
                'id' => 1030,
            'name' => 'mil pies (lineales)',
                'code' => 'TL',
                'status' => 'inactive',
            ),
            30 =>
            array (
                'id' => 1031,
                'name' => 'estaño',
                'code' => 'TN',
                'status' => 'inactive',
            ),
            31 =>
            array (
                'id' => 1032,
            'name' => 'tonelada (tonelada métrica)',
                'code' => 'TNE',
                'status' => 'inactive',
            ),
            32 =>
            array (
                'id' => 1033,
                'name' => 'paquete de diez',
                'code' => 'TP',
                'status' => 'inactive',
            ),
            33 =>
            array (
                'id' => 1034,
                'name' => 'diez pares',
                'code' => 'TPR',
                'status' => 'inactive',
            ),
            34 =>
            array (
                'id' => 1035,
                'name' => 'mil pies',
                'code' => 'TQ',
                'status' => 'inactive',
            ),
            35 =>
            array (
                'id' => 1036,
                'name' => 'mil metros cúbicos por día',
                'code' => 'TQD',
                'status' => 'inactive',
            ),
            36 =>
            array (
                'id' => 1037,
                'name' => 'diez pies cuadrados',
                'code' => 'TR',
                'status' => 'inactive',
            ),
            37 =>
            array (
                'id' => 1038,
            'name' => 'trillón (EUR)',
                'code' => 'TRL',
                'status' => 'inactive',
            ),
            38 =>
            array (
                'id' => 1039,
                'name' => 'mil pies cuadrados',
                'code' => 'TS',
                'status' => 'inactive',
            ),
            39 =>
            array (
                'id' => 1040,
                'name' => 'tonelada de sustancia 90% seca',
                'code' => 'TSD',
                'status' => 'inactive',
            ),
            40 =>
            array (
                'id' => 1041,
                'name' => 'tonelada de vapor por hora',
                'code' => 'TSH',
                'status' => 'inactive',
            ),
            41 =>
            array (
                'id' => 1042,
                'name' => 'mil metros lineales',
                'code' => 'TT',
                'status' => 'inactive',
            ),
            42 =>
            array (
                'id' => 1043,
                'name' => 'tubo',
                'code' => 'TU',
                'status' => 'inactive',
            ),
            43 =>
            array (
                'id' => 1044,
                'name' => 'mil kilogramos',
                'code' => 'TV',
                'status' => 'inactive',
            ),
            44 =>
            array (
                'id' => 1045,
                'name' => 'mil hojas',
                'code' => 'TW',
                'status' => 'inactive',
            ),
            45 =>
            array (
                'id' => 1046,
                'name' => 'tanque cilíndrico',
                'code' => 'TY',
                'status' => 'inactive',
            ),
            46 =>
            array (
                'id' => 1047,
                'name' => 'tratamiento',
                'code' => 'U1',
                'status' => 'inactive',
            ),
            47 =>
            array (
                'id' => 1048,
                'name' => 'tableta',
                'code' => 'U2',
                'status' => 'inactive',
            ),
            48 =>
            array (
                'id' => 1049,
                'name' => 'torr',
                'code' => 'UA',
                'status' => 'inactive',
            ),
            49 =>
            array (
                'id' => 1050,
                'name' => 'Línea de telecomunicaciones en servicio promedio.',
                'code' => 'UB',
                'status' => 'inactive',
            ),
            50 =>
            array (
                'id' => 1051,
                'name' => 'puerto de telecomunicaciones',
                'code' => 'UC',
                'status' => 'inactive',
            ),
            51 =>
            array (
                'id' => 1052,
                'name' => 'décimo minuto',
                'code' => 'UD',
                'status' => 'inactive',
            ),
            52 =>
            array (
                'id' => 1053,
                'name' => 'décima hora',
                'code' => 'UE',
                'status' => 'inactive',
            ),
            53 =>
            array (
                'id' => 1054,
                'name' => 'uso por línea de telecomunicación promedio',
                'code' => 'UF',
                'status' => 'inactive',
            ),
            54 =>
            array (
                'id' => 1055,
                'name' => 'diez mil yardas',
                'code' => 'UH',
                'status' => 'inactive',
            ),
            55 =>
            array (
                'id' => 1056,
                'name' => 'millones de unidades',
                'code' => 'UM',
                'status' => 'inactive',
            ),
            56 =>
            array (
                'id' => 1057,
                'name' => 'voltio amperio por kilogramo',
                'code' => 'VA',
                'status' => 'inactive',
            ),
            57 =>
            array (
                'id' => 1058,
                'name' => 'frasco',
                'code' => 'VI',
                'status' => 'inactive',
            ),
            58 =>
            array (
                'id' => 1059,
                'name' => 'voltio',
                'code' => 'VLT',
                'status' => 'inactive',
            ),
            59 =>
            array (
                'id' => 1060,
                'name' => 'abultar',
                'code' => 'VQ',
                'status' => 'inactive',
            ),
            60 =>
            array (
                'id' => 1061,
                'name' => 'visitar',
                'code' => 'VS',
                'status' => 'inactive',
            ),
            61 =>
            array (
                'id' => 1062,
                'name' => 'kilo mojado',
                'code' => 'W2',
                'status' => 'inactive',
            ),
            62 =>
            array (
                'id' => 1063,
                'name' => 'dos semanas',
                'code' => 'W4',
                'status' => 'inactive',
            ),
            63 =>
            array (
                'id' => 1064,
                'name' => 'vatio por kilogramo',
                'code' => 'WA',
                'status' => 'inactive',
            ),
            64 =>
            array (
                'id' => 1065,
                'name' => 'libra mojada',
                'code' => 'WB',
                'status' => 'inactive',
            ),
            65 =>
            array (
                'id' => 1066,
                'name' => 'cable',
                'code' => 'WCD',
                'status' => 'inactive',
            ),
            66 =>
            array (
                'id' => 1067,
                'name' => 'tonelada mojada',
                'code' => 'WE',
                'status' => 'inactive',
            ),
            67 =>
            array (
                'id' => 1068,
                'name' => 'weber',
                'code' => 'WEB',
                'status' => 'inactive',
            ),
            68 =>
            array (
                'id' => 1069,
                'name' => 'semana',
                'code' => 'WEE',
                'status' => 'inactive',
            ),
            69 =>
            array (
                'id' => 1070,
                'name' => 'galon de vino',
                'code' => 'WG',
                'status' => 'inactive',
            ),
            70 =>
            array (
                'id' => 1071,
                'name' => 'rueda',
                'code' => 'WH',
                'status' => 'inactive',
            ),
            71 =>
            array (
                'id' => 1072,
                'name' => 'vatios hora',
                'code' => 'WHR',
                'status' => 'inactive',
            ),
            72 =>
            array (
                'id' => 1073,
                'name' => 'peso por pulgada cuadrada',
                'code' => 'WI',
                'status' => 'inactive',
            ),
            73 =>
            array (
                'id' => 1074,
                'name' => 'mes de trabajo',
                'code' => 'WM',
                'status' => 'inactive',
            ),
            74 =>
            array (
                'id' => 1075,
                'name' => 'envolver',
                'code' => 'WR',
                'status' => 'inactive',
            ),
            75 =>
            array (
                'id' => 1076,
                'name' => 'estándar',
                'code' => 'WSD',
                'status' => 'inactive',
            ),
            76 =>
            array (
                'id' => 1077,
                'name' => 'vatio',
                'code' => 'WTT',
                'status' => 'inactive',
            ),
            77 =>
            array (
                'id' => 1078,
                'name' => 'mililitro de agua',
                'code' => 'WW',
                'status' => 'inactive',
            ),
            78 =>
            array (
                'id' => 1079,
                'name' => 'cadena',
                'code' => 'X1',
                'status' => 'inactive',
            ),
            79 =>
            array (
                'id' => 1080,
                'name' => 'yarda cuadrada',
                'code' => 'YDK',
                'status' => 'inactive',
            ),
            80 =>
            array (
                'id' => 1081,
                'name' => 'Yarda cúbica',
                'code' => 'YDQ',
                'status' => 'inactive',
            ),
            81 =>
            array (
                'id' => 1082,
                'name' => 'cien yardas lineales',
                'code' => 'YL',
                'status' => 'inactive',
            ),
            82 =>
            array (
                'id' => 1083,
                'name' => 'yarda',
                'code' => 'YRD',
                'status' => 'active',
            ),
            83 =>
            array (
                'id' => 1084,
                'name' => 'diez yardas',
                'code' => 'YT',
                'status' => 'inactive',
            ),
            84 =>
            array (
                'id' => 1085,
                'name' => 'van de elevación',
                'code' => 'Z1',
                'status' => 'inactive',
            ),
            85 =>
            array (
                'id' => 1086,
                'name' => 'pecho',
                'code' => 'Z2',
                'status' => 'inactive',
            ),
            86 =>
            array (
                'id' => 1087,
                'name' => 'barril',
                'code' => 'Z3',
                'status' => 'inactive',
            ),
            87 =>
            array (
                'id' => 1088,
                'name' => 'pipa',
                'code' => 'Z4',
                'status' => 'inactive',
            ),
            88 =>
            array (
                'id' => 1089,
                'name' => 'arrastrar',
                'code' => 'Z5',
                'status' => 'inactive',
            ),
            89 =>
            array (
                'id' => 1090,
                'name' => 'punto de conferencia',
                'code' => 'Z6',
                'status' => 'inactive',
            ),
            90 =>
            array (
                'id' => 1091,
                'name' => 'línea de noticias de ágata',
                'code' => 'Z8',
                'status' => 'inactive',
            ),
            91 =>
            array (
                'id' => 1092,
                'name' => 'página',
                'code' => 'ZP',
                'status' => 'inactive',
            ),
            92 =>
            array (
                'id' => 1093,
                'name' => 'mutuamente definido',
                'code' => 'ZZ',
                'status' => 'inactive',
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('municipalities')->delete();

        DB::table('municipalities')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '05001',
                'name' => 'MEDELLIN',
                'department_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '05002',
                'name' => 'ABEJORRAL',
                'department_id' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '05004',
                'name' => 'ABRIAQUI',
                'department_id' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '05021',
                'name' => 'ALEJANDRIA',
                'department_id' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '05002',
                'name' => 'AMAGA',
                'department_id' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '05031',
                'name' => 'AMALFI',
                'department_id' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '05034',
                'name' => 'ANDES',
                'department_id' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '05036',
                'name' => 'ANGELOPOLIS',
                'department_id' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '05038',
                'name' => 'ANGOSTURA',
                'department_id' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '05040',
                'name' => 'ANORI',
                'department_id' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '05042',
                'name' => 'SANTAFE DE ANTIOQUIA',
                'department_id' => 1,
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '05044',
                'name' => 'ANZA',
                'department_id' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '05045',
                'name' => 'APARTADO',
                'department_id' => 1,
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '05051',
                'name' => 'ARBOLETES',
                'department_id' => 1,
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '05055',
                'name' => 'ARGELIA',
                'department_id' => 1,
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '05059',
                'name' => 'ARMENIA',
                'department_id' => 1,
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '05079',
                'name' => 'BARBOSA',
                'department_id' => 1,
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '05086',
                'name' => 'BELMIRA',
                'department_id' => 1,
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '05088',
                'name' => 'BELLO',
                'department_id' => 1,
            ),
            19 =>
            array (
                'id' => 20,
                'code' => '05091',
                'name' => 'BETANIA',
                'department_id' => 1,
            ),
            20 =>
            array (
                'id' => 21,
                'code' => '05093',
                'name' => 'BETULIA',
                'department_id' => 1,
            ),
            21 =>
            array (
                'id' => 22,
                'code' => '05101',
                'name' => 'CIUDAD BOLIVAR',
                'department_id' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'code' => '05107',
                'name' => 'BRICEÑO',
                'department_id' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'code' => '05113',
                'name' => 'BURITICA',
                'department_id' => 1,
            ),
            24 =>
            array (
                'id' => 25,
                'code' => '05120',
                'name' => 'CACERES',
                'department_id' => 1,
            ),
            25 =>
            array (
                'id' => 26,
                'code' => '05125',
                'name' => 'CAICEDO',
                'department_id' => 1,
            ),
            26 =>
            array (
                'id' => 27,
                'code' => '05129',
                'name' => 'CALDAS',
                'department_id' => 1,
            ),
            27 =>
            array (
                'id' => 28,
                'code' => '05134',
                'name' => 'CAMPAMENTO',
                'department_id' => 1,
            ),
            28 =>
            array (
                'id' => 29,
                'code' => '05138',
                'name' => 'CAÑASGORDAS',
                'department_id' => 1,
            ),
            29 =>
            array (
                'id' => 30,
                'code' => '05142',
                'name' => 'CARACOLI',
                'department_id' => 1,
            ),
            30 =>
            array (
                'id' => 31,
                'code' => '05145',
                'name' => 'CARAMANTA',
                'department_id' => 1,
            ),
            31 =>
            array (
                'id' => 32,
                'code' => '05147',
                'name' => 'CAREPA',
                'department_id' => 1,
            ),
            32 =>
            array (
                'id' => 33,
                'code' => '05148',
                'name' => 'EL CARMEN DE VIVORAL',
                'department_id' => 1,
            ),
            33 =>
            array (
                'id' => 34,
                'code' => '05150',
                'name' => 'CAROLINA',
                'department_id' => 1,
            ),
            34 =>
            array (
                'id' => 35,
                'code' => '05154',
                'name' => 'CAUCASIA',
                'department_id' => 1,
            ),
            35 =>
            array (
                'id' => 36,
                'code' => '05172',
                'name' => 'CHIGORODO',
                'department_id' => 1,
            ),
            36 =>
            array (
                'id' => 37,
                'code' => '05190',
                'name' => 'CISNEROS',
                'department_id' => 1,
            ),
            37 =>
            array (
                'id' => 38,
                'code' => '05197',
                'name' => 'COCORNA',
                'department_id' => 1,
            ),
            38 =>
            array (
                'id' => 39,
                'code' => '05206',
                'name' => 'CONCEPCION',
                'department_id' => 1,
            ),
            39 =>
            array (
                'id' => 40,
                'code' => '05209',
                'name' => 'CONCORDIA',
                'department_id' => 1,
            ),
            40 =>
            array (
                'id' => 41,
                'code' => '05212',
                'name' => 'COPACABANA',
                'department_id' => 1,
            ),
            41 =>
            array (
                'id' => 42,
                'code' => '05234',
                'name' => 'DABEIBA',
                'department_id' => 1,
            ),
            42 =>
            array (
                'id' => 43,
                'code' => '05237',
                'name' => 'DON MATIAS',
                'department_id' => 1,
            ),
            43 =>
            array (
                'id' => 44,
                'code' => '05240',
                'name' => 'ABEJICO',
                'department_id' => 1,
            ),
            44 =>
            array (
                'id' => 45,
                'code' => '05250',
                'name' => 'EL BAGRE',
                'department_id' => 1,
            ),
            45 =>
            array (
                'id' => 46,
                'code' => '05264',
                'name' => 'ENTRERRIOS',
                'department_id' => 1,
            ),
            46 =>
            array (
                'id' => 47,
                'code' => '05266',
                'name' => 'ENVIGADO',
                'department_id' => 1,
            ),
            47 =>
            array (
                'id' => 48,
                'code' => '05282',
                'name' => 'FREDONIA',
                'department_id' => 1,
            ),
            48 =>
            array (
                'id' => 49,
                'code' => '05284',
                'name' => 'FRONTINO',
                'department_id' => 1,
            ),
            49 =>
            array (
                'id' => 50,
                'code' => '05306',
                'name' => 'GIRALDO',
                'department_id' => 1,
            ),
            50 =>
            array (
                'id' => 51,
                'code' => '05308',
                'name' => 'GIRARDOTA',
                'department_id' => 1,
            ),
            51 =>
            array (
                'id' => 52,
                'code' => '05310',
                'name' => 'GOMEZ PLATA',
                'department_id' => 1,
            ),
            52 =>
            array (
                'id' => 53,
                'code' => '05313',
                'name' => 'GRANADA',
                'department_id' => 1,
            ),
            53 =>
            array (
                'id' => 54,
                'code' => '05315',
                'name' => 'GUADALUPE',
                'department_id' => 1,
            ),
            54 =>
            array (
                'id' => 55,
                'code' => '05318',
                'name' => 'GUARNE',
                'department_id' => 1,
            ),
            55 =>
            array (
                'id' => 56,
                'code' => '05321',
                'name' => 'GUATAPE',
                'department_id' => 1,
            ),
            56 =>
            array (
                'id' => 57,
                'code' => '05347',
                'name' => 'HELICONDIA',
                'department_id' => 1,
            ),
            57 =>
            array (
                'id' => 58,
                'code' => '05353',
                'name' => 'HISPANIA',
                'department_id' => 1,
            ),
            58 =>
            array (
                'id' => 59,
                'code' => '05360',
                'name' => 'ITAGUI',
                'department_id' => 1,
            ),
            59 =>
            array (
                'id' => 60,
                'code' => '05361',
                'name' => 'ITUANGO',
                'department_id' => 1,
            ),
            60 =>
            array (
                'id' => 61,
                'code' => '05364',
                'name' => 'JARDIN',
                'department_id' => 1,
            ),
            61 =>
            array (
                'id' => 62,
                'code' => '05368',
                'name' => 'JERICO',
                'department_id' => 1,
            ),
            62 =>
            array (
                'id' => 63,
                'code' => '05376',
                'name' => 'LA CEJA',
                'department_id' => 1,
            ),
            63 =>
            array (
                'id' => 64,
                'code' => '05380',
                'name' => 'LA ESTRELLA',
                'department_id' => 1,
            ),
            64 =>
            array (
                'id' => 65,
                'code' => '05390',
                'name' => 'LA PINTADA',
                'department_id' => 1,
            ),
            65 =>
            array (
                'id' => 66,
                'code' => '05400',
                'name' => 'LA UNION',
                'department_id' => 1,
            ),
            66 =>
            array (
                'id' => 67,
                'code' => '05411',
                'name' => 'LIBORINA',
                'department_id' => 1,
            ),
            67 =>
            array (
                'id' => 68,
                'code' => '05425',
                'name' => 'MACEO',
                'department_id' => 1,
            ),
            68 =>
            array (
                'id' => 69,
                'code' => '05440',
                'name' => 'MARINILLA',
                'department_id' => 1,
            ),
            69 =>
            array (
                'id' => 70,
                'code' => '05467',
                'name' => 'MONTEBELLO',
                'department_id' => 1,
            ),
            70 =>
            array (
                'id' => 71,
                'code' => '05475',
                'name' => 'MURINDO',
                'department_id' => 1,
            ),
            71 =>
            array (
                'id' => 72,
                'code' => '05480',
                'name' => 'MUTATA',
                'department_id' => 1,
            ),
            72 =>
            array (
                'id' => 73,
                'code' => '05483',
                'name' => 'NARIÑO',
                'department_id' => 1,
            ),
            73 =>
            array (
                'id' => 74,
                'code' => '05490',
                'name' => 'NECOCLI',
                'department_id' => 1,
            ),
            74 =>
            array (
                'id' => 75,
                'code' => '05495',
                'name' => 'NECHI',
                'department_id' => 1,
            ),
            75 =>
            array (
                'id' => 76,
                'code' => '05501',
                'name' => 'OLAYA',
                'department_id' => 1,
            ),
            76 =>
            array (
                'id' => 77,
                'code' => '05541',
                'name' => 'PEÑOL',
                'department_id' => 1,
            ),
            77 =>
            array (
                'id' => 78,
                'code' => '05543',
                'name' => 'PEQUE',
                'department_id' => 1,
            ),
            78 =>
            array (
                'id' => 79,
                'code' => '05576',
                'name' => 'PUEBLORRICO',
                'department_id' => 1,
            ),
            79 =>
            array (
                'id' => 80,
                'code' => '05579',
                'name' => 'PUERTO BERRIO',
                'department_id' => 1,
            ),
            80 =>
            array (
                'id' => 81,
                'code' => '05585',
                'name' => 'PUERTO NARE',
                'department_id' => 1,
            ),
            81 =>
            array (
                'id' => 82,
                'code' => '05591',
                'name' => 'PUERTO TRIUNFO',
                'department_id' => 1,
            ),
            82 =>
            array (
                'id' => 83,
                'code' => '05604',
                'name' => 'REMEDIOS',
                'department_id' => 1,
            ),
            83 =>
            array (
                'id' => 84,
                'code' => '05607',
                'name' => 'RETIRO',
                'department_id' => 1,
            ),
            84 =>
            array (
                'id' => 85,
                'code' => '05615',
                'name' => 'RIONEGRO',
                'department_id' => 1,
            ),
            85 =>
            array (
                'id' => 86,
                'code' => '05628',
                'name' => 'SABANALARGA',
                'department_id' => 1,
            ),
            86 =>
            array (
                'id' => 87,
                'code' => '05631',
                'name' => 'SABANETA',
                'department_id' => 1,
            ),
            87 =>
            array (
                'id' => 88,
                'code' => '05642',
                'name' => 'SALGAR',
                'department_id' => 1,
            ),
            88 =>
            array (
                'id' => 89,
                'code' => '05647',
                'name' => 'SAN ANDRES DE CUERQUIA',
                'department_id' => 1,
            ),
            89 =>
            array (
                'id' => 90,
                'code' => '05649',
                'name' => 'SAN CARLOS',
                'department_id' => 1,
            ),
            90 =>
            array (
                'id' => 91,
                'code' => '05652',
                'name' => 'SAN FRANCISCO',
                'department_id' => 1,
            ),
            91 =>
            array (
                'id' => 92,
                'code' => '05656',
                'name' => 'SAN JERONIMO',
                'department_id' => 1,
            ),
            92 =>
            array (
                'id' => 93,
                'code' => '05658',
                'name' => 'SAN JOSE DE LA MONTAÑA',
                'department_id' => 1,
            ),
            93 =>
            array (
                'id' => 94,
                'code' => '05659',
                'name' => 'SAN JUAN DE URABA',
                'department_id' => 1,
            ),
            94 =>
            array (
                'id' => 95,
                'code' => '05660',
                'name' => 'SAN LUIS',
                'department_id' => 1,
            ),
            95 =>
            array (
                'id' => 96,
                'code' => '05664',
                'name' => 'SAN PEDRO DE LOS MILAGROS',
                'department_id' => 1,
            ),
            96 =>
            array (
                'id' => 97,
                'code' => '05665',
                'name' => 'SAN PEDRO DE URABA',
                'department_id' => 1,
            ),
            97 =>
            array (
                'id' => 98,
                'code' => '05667',
                'name' => 'SAN RAFAEL',
                'department_id' => 1,
            ),
            98 =>
            array (
                'id' => 99,
                'code' => '05670',
                'name' => 'SAN ROQUE',
                'department_id' => 1,
            ),
            99 =>
            array (
                'id' => 100,
                'code' => '05674',
                'name' => 'SAN VICENTE FERRER',
                'department_id' => 1,
            ),
            100 =>
            array (
                'id' => 101,
                'code' => '05679',
                'name' => 'SANTA BARBARA',
                'department_id' => 1,
            ),
            101 =>
            array (
                'id' => 102,
                'code' => '05686',
                'name' => 'SANTA ROSA DE OSOS',
                'department_id' => 1,
            ),
            102 =>
            array (
                'id' => 103,
                'code' => '05690',
                'name' => 'SANTO DOMINGO',
                'department_id' => 1,
            ),
            103 =>
            array (
                'id' => 104,
                'code' => '05697',
                'name' => 'EL SANTUARIO',
                'department_id' => 1,
            ),
            104 =>
            array (
                'id' => 105,
                'code' => '05736',
                'name' => 'SEGOVIA',
                'department_id' => 1,
            ),
            105 =>
            array (
                'id' => 106,
                'code' => '05756',
                'name' => 'SONSON',
                'department_id' => 1,
            ),
            106 =>
            array (
                'id' => 107,
                'code' => '05761',
                'name' => 'SOPETRAN',
                'department_id' => 1,
            ),
            107 =>
            array (
                'id' => 108,
                'code' => '05789',
                'name' => 'TAMESIS',
                'department_id' => 1,
            ),
            108 =>
            array (
                'id' => 109,
                'code' => '05790',
                'name' => 'TARAZA',
                'department_id' => 1,
            ),
            109 =>
            array (
                'id' => 110,
                'code' => '05792',
                'name' => 'TARSO',
                'department_id' => 1,
            ),
            110 =>
            array (
                'id' => 111,
                'code' => '05809',
                'name' => 'TITIRIBI',
                'department_id' => 1,
            ),
            111 =>
            array (
                'id' => 112,
                'code' => '05819',
                'name' => 'TOLEDO',
                'department_id' => 1,
            ),
            112 =>
            array (
                'id' => 113,
                'code' => '05837',
                'name' => 'TURBO',
                'department_id' => 1,
            ),
            113 =>
            array (
                'id' => 114,
                'code' => '05842',
                'name' => 'URAMITA',
                'department_id' => 1,
            ),
            114 =>
            array (
                'id' => 115,
                'code' => '05847',
                'name' => 'URRAO',
                'department_id' => 1,
            ),
            115 =>
            array (
                'id' => 116,
                'code' => '05854',
                'name' => 'VALDIVIA',
                'department_id' => 1,
            ),
            116 =>
            array (
                'id' => 117,
                'code' => '05856',
                'name' => 'VALPARAISO',
                'department_id' => 1,
            ),
            117 =>
            array (
                'id' => 118,
                'code' => '05858',
                'name' => 'VEGACHI',
                'department_id' => 1,
            ),
            118 =>
            array (
                'id' => 119,
                'code' => '05861',
                'name' => 'VENECIA',
                'department_id' => 1,
            ),
            119 =>
            array (
                'id' => 120,
                'code' => '05873',
                'name' => 'VIGIA DEL FUERTE',
                'department_id' => 1,
            ),
            120 =>
            array (
                'id' => 121,
                'code' => '05885',
                'name' => 'YALI',
                'department_id' => 1,
            ),
            121 =>
            array (
                'id' => 122,
                'code' => '05887',
                'name' => 'YARUMAL',
                'department_id' => 1,
            ),
            122 =>
            array (
                'id' => 123,
                'code' => '05890',
                'name' => 'YOLOMBO',
                'department_id' => 1,
            ),
            123 =>
            array (
                'id' => 124,
                'code' => '05893',
                'name' => 'YONDO',
                'department_id' => 1,
            ),
            124 =>
            array (
                'id' => 125,
                'code' => '05895',
                'name' => 'ZARAGOSA',
                'department_id' => 1,
            ),
            125 =>
            array (
                'id' => 126,
                'code' => '08001',
                'name' => 'BARRANQUILLA',
                'department_id' => 2,
            ),
            126 =>
            array (
                'id' => 127,
                'code' => '08078',
                'name' => 'BARANOA',
                'department_id' => 2,
            ),
            127 =>
            array (
                'id' => 128,
                'code' => '08137',
                'name' => 'CAMPO DE LA CRUZ',
                'department_id' => 2,
            ),
            128 =>
            array (
                'id' => 129,
                'code' => '08141',
                'name' => 'CANDELARIA',
                'department_id' => 2,
            ),
            129 =>
            array (
                'id' => 130,
                'code' => '08296',
                'name' => 'GALAPA',
                'department_id' => 2,
            ),
            130 =>
            array (
                'id' => 131,
                'code' => '08372',
                'name' => 'JUAN DE ACOSTA',
                'department_id' => 2,
            ),
            131 =>
            array (
                'id' => 132,
                'code' => '08421',
                'name' => 'LURUACO',
                'department_id' => 2,
            ),
            132 =>
            array (
                'id' => 133,
                'code' => '08433',
                'name' => 'MALAMBO',
                'department_id' => 2,
            ),
            133 =>
            array (
                'id' => 134,
                'code' => '08436',
                'name' => 'MANATI',
                'department_id' => 2,
            ),
            134 =>
            array (
                'id' => 135,
                'code' => '08520',
                'name' => 'PALMAR DE VARELA',
                'department_id' => 2,
            ),
            135 =>
            array (
                'id' => 136,
                'code' => '08549',
                'name' => 'PIOJO',
                'department_id' => 2,
            ),
            136 =>
            array (
                'id' => 137,
                'code' => '08558',
                'name' => 'POLO NUEVO',
                'department_id' => 2,
            ),
            137 =>
            array (
                'id' => 138,
                'code' => '08560',
                'name' => 'PONEDERA',
                'department_id' => 2,
            ),
            138 =>
            array (
                'id' => 139,
                'code' => '08573',
                'name' => 'PUERTO COLOMBIA',
                'department_id' => 2,
            ),
            139 =>
            array (
                'id' => 140,
                'code' => '08606',
                'name' => 'REPELON',
                'department_id' => 2,
            ),
            140 =>
            array (
                'id' => 141,
                'code' => '08634',
                'name' => 'SABANAGRANDE',
                'department_id' => 2,
            ),
            141 =>
            array (
                'id' => 142,
                'code' => '08638',
                'name' => 'SABANALARGA',
                'department_id' => 2,
            ),
            142 =>
            array (
                'id' => 143,
                'code' => '08675',
                'name' => 'SANTA LUCIA',
                'department_id' => 2,
            ),
            143 =>
            array (
                'id' => 144,
                'code' => '08685',
                'name' => 'SANTO TOMAS',
                'department_id' => 2,
            ),
            144 =>
            array (
                'id' => 145,
                'code' => '08758',
                'name' => 'SOLEDAD',
                'department_id' => 2,
            ),
            145 =>
            array (
                'id' => 146,
                'code' => '08770',
                'name' => 'SUAN',
                'department_id' => 2,
            ),
            146 =>
            array (
                'id' => 147,
                'code' => '08832',
                'name' => 'TUBARA',
                'department_id' => 2,
            ),
            147 =>
            array (
                'id' => 148,
                'code' => '08849',
                'name' => 'USIACURI',
                'department_id' => 2,
            ),
            148 =>
            array (
                'id' => 149,
                'code' => '11001',
                'name' => 'BOGOTA',
                'department_id' => 3,
            ),
            149 =>
            array (
                'id' => 150,
                'code' => '13001',
                'name' => 'CARTAGENA',
                'department_id' => 4,
            ),
            150 =>
            array (
                'id' => 151,
                'code' => '13006',
                'name' => 'ACHI',
                'department_id' => 4,
            ),
            151 =>
            array (
                'id' => 152,
                'code' => '13030',
                'name' => 'ALTOS DEL ROSARIO',
                'department_id' => 4,
            ),
            152 =>
            array (
                'id' => 153,
                'code' => '13042',
                'name' => 'ARENAL',
                'department_id' => 4,
            ),
            153 =>
            array (
                'id' => 154,
                'code' => '13052',
                'name' => 'ARJONA',
                'department_id' => 4,
            ),
            154 =>
            array (
                'id' => 155,
                'code' => '13062',
                'name' => 'ARROYOHONDO',
                'department_id' => 4,
            ),
            155 =>
            array (
                'id' => 156,
                'code' => '13074',
                'name' => 'BARRANCO DE LOBA',
                'department_id' => 4,
            ),
            156 =>
            array (
                'id' => 157,
                'code' => '13140',
                'name' => 'CALAMAR',
                'department_id' => 4,
            ),
            157 =>
            array (
                'id' => 158,
                'code' => '13160',
                'name' => 'CANTAGALLO',
                'department_id' => 4,
            ),
            158 =>
            array (
                'id' => 159,
                'code' => '13188',
                'name' => 'CICUCO',
                'department_id' => 4,
            ),
            159 =>
            array (
                'id' => 160,
                'code' => '13212',
                'name' => 'CORDOBA',
                'department_id' => 4,
            ),
            160 =>
            array (
                'id' => 161,
                'code' => '13222',
                'name' => 'CLEMENCIA',
                'department_id' => 4,
            ),
            161 =>
            array (
                'id' => 162,
                'code' => '13244',
                'name' => 'EL CARMEN DE BOLIVAR',
                'department_id' => 4,
            ),
            162 =>
            array (
                'id' => 163,
                'code' => '13248',
                'name' => 'EL GUAMO',
                'department_id' => 4,
            ),
            163 =>
            array (
                'id' => 164,
                'code' => '13268',
                'name' => 'EL PEÑON',
                'department_id' => 4,
            ),
            164 =>
            array (
                'id' => 165,
                'code' => '13300',
                'name' => 'HATILLO DE LOBA',
                'department_id' => 4,
            ),
            165 =>
            array (
                'id' => 166,
                'code' => '13430',
                'name' => 'MAGANGUE',
                'department_id' => 4,
            ),
            166 =>
            array (
                'id' => 167,
                'code' => '13433',
                'name' => 'MAHATES',
                'department_id' => 4,
            ),
            167 =>
            array (
                'id' => 168,
                'code' => '13440',
                'name' => 'MARGARITA',
                'department_id' => 4,
            ),
            168 =>
            array (
                'id' => 169,
                'code' => '13442',
                'name' => 'MARIA LA BAJA',
                'department_id' => 4,
            ),
            169 =>
            array (
                'id' => 170,
                'code' => '13458',
                'name' => 'MONTECRISTO',
                'department_id' => 4,
            ),
            170 =>
            array (
                'id' => 171,
                'code' => '13468',
                'name' => 'MOMPOS',
                'department_id' => 4,
            ),
            171 =>
            array (
                'id' => 172,
                'code' => '13473',
                'name' => 'MORALES',
                'department_id' => 4,
            ),
            172 =>
            array (
                'id' => 173,
                'code' => '13490',
                'name' => 'MOROSI',
                'department_id' => 4,
            ),
            173 =>
            array (
                'id' => 174,
                'code' => '13549',
                'name' => 'PINILLOS',
                'department_id' => 4,
            ),
            174 =>
            array (
                'id' => 175,
                'code' => '13580',
                'name' => 'REGIDOR',
                'department_id' => 4,
            ),
            175 =>
            array (
                'id' => 176,
                'code' => '13600',
                'name' => 'RIO VIEJO',
                'department_id' => 4,
            ),
            176 =>
            array (
                'id' => 177,
                'code' => '13620',
                'name' => 'SAN CRISTOBAL',
                'department_id' => 4,
            ),
            177 =>
            array (
                'id' => 178,
                'code' => '13647',
                'name' => 'SAN ESTANISLAO',
                'department_id' => 4,
            ),
            178 =>
            array (
                'id' => 179,
                'code' => '13650',
                'name' => 'SAN FERNANDO',
                'department_id' => 4,
            ),
            179 =>
            array (
                'id' => 180,
                'code' => '13654',
                'name' => 'SAN JACINTO',
                'department_id' => 4,
            ),
            180 =>
            array (
                'id' => 181,
                'code' => '13655',
                'name' => 'SAN JACINTO DEL CAUCA',
                'department_id' => 4,
            ),
            181 =>
            array (
                'id' => 182,
                'code' => '13657',
                'name' => 'SAN JUAN NEPOMUCENO',
                'department_id' => 4,
            ),
            182 =>
            array (
                'id' => 183,
                'code' => '13667',
                'name' => 'SAN MARTIN DE LOBA',
                'department_id' => 4,
            ),
            183 =>
            array (
                'id' => 184,
                'code' => '13670',
                'name' => 'SAN PABLO SUR',
                'department_id' => 4,
            ),
            184 =>
            array (
                'id' => 185,
                'code' => '13673',
                'name' => 'SANTA CATALINA',
                'department_id' => 4,
            ),
            185 =>
            array (
                'id' => 186,
                'code' => '13683',
                'name' => 'SANTA ROSA DE LIMA',
                'department_id' => 4,
            ),
            186 =>
            array (
                'id' => 187,
                'code' => '13688',
                'name' => 'SANTA ROSA DEL SUR',
                'department_id' => 4,
            ),
            187 =>
            array (
                'id' => 188,
                'code' => '13744',
                'name' => 'SIMITI',
                'department_id' => 4,
            ),
            188 =>
            array (
                'id' => 189,
                'code' => '13760',
                'name' => 'SOPLAVIENTO',
                'department_id' => 4,
            ),
            189 =>
            array (
                'id' => 190,
                'code' => '13780',
                'name' => 'TALAIGUA NUEVO',
                'department_id' => 4,
            ),
            190 =>
            array (
                'id' => 191,
                'code' => '13810',
                'name' => 'TIQUISIO',
                'department_id' => 4,
            ),
            191 =>
            array (
                'id' => 192,
                'code' => '13836',
                'name' => 'TURBACO',
                'department_id' => 4,
            ),
            192 =>
            array (
                'id' => 193,
                'code' => '13838',
                'name' => 'TURBANA',
                'department_id' => 4,
            ),
            193 =>
            array (
                'id' => 194,
                'code' => '13873',
                'name' => 'VILLANUEVA',
                'department_id' => 4,
            ),
            194 =>
            array (
                'id' => 195,
                'code' => '13894',
                'name' => 'ZAMBRANO',
                'department_id' => 4,
            ),
            195 =>
            array (
                'id' => 196,
                'code' => '15001',
                'name' => 'TUNJA',
                'department_id' => 5,
            ),
            196 =>
            array (
                'id' => 197,
                'code' => '15022',
                'name' => ' ALMEIDA',
                'department_id' => 5,
            ),
            197 =>
            array (
                'id' => 198,
                'code' => '15047',
                'name' => 'AQUITANIA',
                'department_id' => 5,
            ),
            198 =>
            array (
                'id' => 199,
                'code' => '15051',
                'name' => 'ARCABUCO',
                'department_id' => 5,
            ),
            199 =>
            array (
                'id' => 200,
                'code' => '15087',
                'name' => 'BELEN',
                'department_id' => 5,
            ),
        ));
        DB::table('municipalities')->insert(array (
            0 =>
            array (
                'id' => 201,
                'code' => '15090',
                'name' => 'BERBEO',
                'department_id' => 5,
            ),
            1 =>
            array (
                'id' => 202,
                'code' => '15092',
                'name' => 'BETEITIVA',
                'department_id' => 5,
            ),
            2 =>
            array (
                'id' => 203,
                'code' => '15097',
                'name' => 'BOAVITA',
                'department_id' => 5,
            ),
            3 =>
            array (
                'id' => 204,
                'code' => '15104',
                'name' => 'BOYACA',
                'department_id' => 5,
            ),
            4 =>
            array (
                'id' => 205,
                'code' => '15106',
                'name' => 'BRICEÑO',
                'department_id' => 5,
            ),
            5 =>
            array (
                'id' => 206,
                'code' => '15109',
                'name' => 'BUENAVISTA',
                'department_id' => 5,
            ),
            6 =>
            array (
                'id' => 207,
                'code' => '15114',
                'name' => 'BUSBANZA',
                'department_id' => 5,
            ),
            7 =>
            array (
                'id' => 208,
                'code' => '15131',
                'name' => 'CALDAS',
                'department_id' => 5,
            ),
            8 =>
            array (
                'id' => 209,
                'code' => '15135',
                'name' => 'CAMPOHERMOSO',
                'department_id' => 5,
            ),
            9 =>
            array (
                'id' => 210,
                'code' => '15162',
                'name' => 'CERINZA',
                'department_id' => 5,
            ),
            10 =>
            array (
                'id' => 211,
                'code' => '15172',
                'name' => 'CHINAVITA',
                'department_id' => 5,
            ),
            11 =>
            array (
                'id' => 212,
                'code' => '15176',
                'name' => 'CUIQUINQUIRA',
                'department_id' => 5,
            ),
            12 =>
            array (
                'id' => 213,
                'code' => '15180',
                'name' => 'CHISCAS',
                'department_id' => 5,
            ),
            13 =>
            array (
                'id' => 214,
                'code' => '15183',
                'name' => 'CHITA',
                'department_id' => 5,
            ),
            14 =>
            array (
                'id' => 215,
                'code' => '15185',
                'name' => 'CHITARAQUE',
                'department_id' => 5,
            ),
            15 =>
            array (
                'id' => 216,
                'code' => '15187',
                'name' => 'CHIVATA',
                'department_id' => 5,
            ),
            16 =>
            array (
                'id' => 217,
                'code' => '15189',
                'name' => 'CIENAGA',
                'department_id' => 5,
            ),
            17 =>
            array (
                'id' => 218,
                'code' => '15204',
                'name' => 'COMBITA',
                'department_id' => 5,
            ),
            18 =>
            array (
                'id' => 219,
                'code' => '15212',
                'name' => 'COPER',
                'department_id' => 5,
            ),
            19 =>
            array (
                'id' => 220,
                'code' => '15215',
                'name' => 'CORRALES',
                'department_id' => 5,
            ),
            20 =>
            array (
                'id' => 221,
                'code' => '15218',
                'name' => 'COVARACHICA',
                'department_id' => 5,
            ),
            21 =>
            array (
                'id' => 222,
                'code' => '15223',
                'name' => 'CUBARA',
                'department_id' => 5,
            ),
            22 =>
            array (
                'id' => 223,
                'code' => '15224',
                'name' => 'CUCAITA',
                'department_id' => 5,
            ),
            23 =>
            array (
                'id' => 224,
                'code' => '15226',
                'name' => 'CUITIVA',
                'department_id' => 5,
            ),
            24 =>
            array (
                'id' => 225,
                'code' => '15232',
                'name' => 'CHIQUIZA',
                'department_id' => 5,
            ),
            25 =>
            array (
                'id' => 226,
                'code' => '15236',
                'name' => 'CHIVOR',
                'department_id' => 5,
            ),
            26 =>
            array (
                'id' => 227,
                'code' => '15238',
                'name' => 'DUITAMA',
                'department_id' => 5,
            ),
            27 =>
            array (
                'id' => 228,
                'code' => '15244',
                'name' => 'EL COCUY',
                'department_id' => 5,
            ),
            28 =>
            array (
                'id' => 229,
                'code' => '15248',
                'name' => 'EL ESPINO',
                'department_id' => 5,
            ),
            29 =>
            array (
                'id' => 230,
                'code' => '15272',
                'name' => 'FIRAVITOVA',
                'department_id' => 5,
            ),
            30 =>
            array (
                'id' => 231,
                'code' => '15276',
                'name' => 'FLORESTA',
                'department_id' => 5,
            ),
            31 =>
            array (
                'id' => 232,
                'code' => '15293',
                'name' => 'CACHANTIVA',
                'department_id' => 5,
            ),
            32 =>
            array (
                'id' => 233,
                'code' => '15296',
                'name' => 'GAMEZA',
                'department_id' => 5,
            ),
            33 =>
            array (
                'id' => 234,
                'code' => '15299',
                'name' => 'GARAGOA',
                'department_id' => 5,
            ),
            34 =>
            array (
                'id' => 235,
                'code' => '15317',
                'name' => 'GUACAMAYAS',
                'department_id' => 5,
            ),
            35 =>
            array (
                'id' => 236,
                'code' => '15322',
                'name' => 'GUATEQUE',
                'department_id' => 5,
            ),
            36 =>
            array (
                'id' => 237,
                'code' => '15325',
                'name' => 'GUAYATA',
                'department_id' => 5,
            ),
            37 =>
            array (
                'id' => 238,
                'code' => '15332',
                'name' => 'GUICAN DE LA SIERRA',
                'department_id' => 5,
            ),
            38 =>
            array (
                'id' => 239,
                'code' => '15362',
                'name' => 'IZA',
                'department_id' => 5,
            ),
            39 =>
            array (
                'id' => 240,
                'code' => '15367',
                'name' => 'JENESANO',
                'department_id' => 5,
            ),
            40 =>
            array (
                'id' => 241,
                'code' => '15368',
                'name' => 'JERICO',
                'department_id' => 5,
            ),
            41 =>
            array (
                'id' => 242,
                'code' => '15377',
                'name' => 'LABRANZAGRANDE',
                'department_id' => 5,
            ),
            42 =>
            array (
                'id' => 243,
                'code' => '15380',
                'name' => 'LA CAPILLA',
                'department_id' => 5,
            ),
            43 =>
            array (
                'id' => 244,
                'code' => '15401',
                'name' => 'LA VICTORIA',
                'department_id' => 5,
            ),
            44 =>
            array (
                'id' => 245,
                'code' => '15403',
                'name' => 'LA UVITA',
                'department_id' => 5,
            ),
            45 =>
            array (
                'id' => 246,
                'code' => '15407',
                'name' => 'VILLA DE LEIVA',
                'department_id' => 5,
            ),
            46 =>
            array (
                'id' => 247,
                'code' => '15425',
                'name' => 'MACANAL',
                'department_id' => 5,
            ),
            47 =>
            array (
                'id' => 248,
                'code' => '15442',
                'name' => 'MARIPI',
                'department_id' => 5,
            ),
            48 =>
            array (
                'id' => 249,
                'code' => '15455',
                'name' => 'MIRAFLORES',
                'department_id' => 5,
            ),
            49 =>
            array (
                'id' => 250,
                'code' => '15464',
                'name' => 'MONGUA',
                'department_id' => 5,
            ),
            50 =>
            array (
                'id' => 251,
                'code' => '15466',
                'name' => 'MONGUI',
                'department_id' => 5,
            ),
            51 =>
            array (
                'id' => 252,
                'code' => '15469',
                'name' => 'MONIQUIRA',
                'department_id' => 5,
            ),
            52 =>
            array (
                'id' => 253,
                'code' => '15476',
                'name' => 'MOTAVITA',
                'department_id' => 5,
            ),
            53 =>
            array (
                'id' => 254,
                'code' => '15480',
                'name' => 'MUZO',
                'department_id' => 5,
            ),
            54 =>
            array (
                'id' => 255,
                'code' => '15491',
                'name' => 'NOBSA',
                'department_id' => 5,
            ),
            55 =>
            array (
                'id' => 256,
                'code' => '15494',
                'name' => 'NUEVO COLON',
                'department_id' => 5,
            ),
            56 =>
            array (
                'id' => 257,
                'code' => '15500',
                'name' => 'OICATA',
                'department_id' => 5,
            ),
            57 =>
            array (
                'id' => 258,
                'code' => '15507',
                'name' => 'OTANCHE',
                'department_id' => 5,
            ),
            58 =>
            array (
                'id' => 259,
                'code' => '15511',
                'name' => 'PACHAVITA',
                'department_id' => 5,
            ),
            59 =>
            array (
                'id' => 260,
                'code' => '15514',
                'name' => 'PAEZ',
                'department_id' => 5,
            ),
            60 =>
            array (
                'id' => 261,
                'code' => '15516',
                'name' => 'PAIPA',
                'department_id' => 5,
            ),
            61 =>
            array (
                'id' => 262,
                'code' => '15518',
                'name' => 'PAJARITO',
                'department_id' => 5,
            ),
            62 =>
            array (
                'id' => 263,
                'code' => '15522',
                'name' => 'PANQUEVA',
                'department_id' => 5,
            ),
            63 =>
            array (
                'id' => 264,
                'code' => '15531',
                'name' => 'PAUNA',
                'department_id' => 5,
            ),
            64 =>
            array (
                'id' => 265,
                'code' => '15533',
                'name' => 'PAYA',
                'department_id' => 5,
            ),
            65 =>
            array (
                'id' => 266,
                'code' => '15537',
                'name' => 'PAZ DEL RIO',
                'department_id' => 5,
            ),
            66 =>
            array (
                'id' => 267,
                'code' => '15542',
                'name' => 'PESCA',
                'department_id' => 5,
            ),
            67 =>
            array (
                'id' => 268,
                'code' => '15550',
                'name' => 'PISBA',
                'department_id' => 5,
            ),
            68 =>
            array (
                'id' => 269,
                'code' => '15572',
                'name' => 'PUERTO BOYACA',
                'department_id' => 5,
            ),
            69 =>
            array (
                'id' => 270,
                'code' => '15580',
                'name' => 'QUIPAMA',
                'department_id' => 5,
            ),
            70 =>
            array (
                'id' => 271,
                'code' => '15599',
                'name' => 'RAMIRIQUI',
                'department_id' => 5,
            ),
            71 =>
            array (
                'id' => 272,
                'code' => '15600',
                'name' => 'RAQUIRA',
                'department_id' => 5,
            ),
            72 =>
            array (
                'id' => 273,
                'code' => '15621',
                'name' => 'RONDON',
                'department_id' => 5,
            ),
            73 =>
            array (
                'id' => 274,
                'code' => '15632',
                'name' => 'SABOYA',
                'department_id' => 5,
            ),
            74 =>
            array (
                'id' => 275,
                'code' => '15638',
                'name' => 'SACHICA',
                'department_id' => 5,
            ),
            75 =>
            array (
                'id' => 276,
                'code' => '15646',
                'name' => 'SAMACA',
                'department_id' => 5,
            ),
            76 =>
            array (
                'id' => 277,
                'code' => '15660',
                'name' => 'SAN EDUARDO',
                'department_id' => 5,
            ),
            77 =>
            array (
                'id' => 278,
                'code' => '15664',
                'name' => 'SAN JOSE DE PARE',
                'department_id' => 5,
            ),
            78 =>
            array (
                'id' => 279,
                'code' => '15667',
                'name' => 'SAN LUIS GACENO',
                'department_id' => 5,
            ),
            79 =>
            array (
                'id' => 280,
                'code' => '15673',
                'name' => 'SAN MATEO',
                'department_id' => 5,
            ),
            80 =>
            array (
                'id' => 281,
                'code' => '15676',
                'name' => 'SAN MIGUEL DE SEMA',
                'department_id' => 5,
            ),
            81 =>
            array (
                'id' => 282,
                'code' => '15681',
                'name' => 'SAN PABLO DE BORBUR',
                'department_id' => 5,
            ),
            82 =>
            array (
                'id' => 283,
                'code' => '15686',
                'name' => 'SANTANA',
                'department_id' => 5,
            ),
            83 =>
            array (
                'id' => 284,
                'code' => '15690',
                'name' => 'SANTA MARIA',
                'department_id' => 5,
            ),
            84 =>
            array (
                'id' => 285,
                'code' => '15693',
                'name' => 'SANTA ROSA DE VITERBO',
                'department_id' => 5,
            ),
            85 =>
            array (
                'id' => 286,
                'code' => '15696',
                'name' => 'SANTA SOFIA',
                'department_id' => 5,
            ),
            86 =>
            array (
                'id' => 287,
                'code' => '15720',
                'name' => 'SANTIVANORTE',
                'department_id' => 5,
            ),
            87 =>
            array (
                'id' => 288,
                'code' => '15723',
                'name' => 'SANTIVASUR',
                'department_id' => 5,
            ),
            88 =>
            array (
                'id' => 289,
                'code' => '15740',
                'name' => 'SIACHOQUE',
                'department_id' => 5,
            ),
            89 =>
            array (
                'id' => 290,
                'code' => '15753',
                'name' => 'SOATA',
                'department_id' => 5,
            ),
            90 =>
            array (
                'id' => 291,
                'code' => '15755',
                'name' => 'SOCOTA',
                'department_id' => 5,
            ),
            91 =>
            array (
                'id' => 292,
                'code' => '15757',
                'name' => 'SOCHA',
                'department_id' => 5,
            ),
            92 =>
            array (
                'id' => 293,
                'code' => '15759',
                'name' => 'SOGAMOSO',
                'department_id' => 5,
            ),
            93 =>
            array (
                'id' => 294,
                'code' => '15761',
                'name' => 'SOMONDOCO',
                'department_id' => 5,
            ),
            94 =>
            array (
                'id' => 295,
                'code' => '15762',
                'name' => 'SORA',
                'department_id' => 5,
            ),
            95 =>
            array (
                'id' => 296,
                'code' => '15763',
                'name' => 'SOTAQUIRA',
                'department_id' => 5,
            ),
            96 =>
            array (
                'id' => 297,
                'code' => '15764',
                'name' => 'SORACA',
                'department_id' => 5,
            ),
            97 =>
            array (
                'id' => 298,
                'code' => '15774',
                'name' => 'SUSACON',
                'department_id' => 5,
            ),
            98 =>
            array (
                'id' => 299,
                'code' => '15776',
                'name' => 'SUTAMARCHAN',
                'department_id' => 5,
            ),
            99 =>
            array (
                'id' => 300,
                'code' => '15778',
                'name' => 'SUTATENZA',
                'department_id' => 5,
            ),
            100 =>
            array (
                'id' => 301,
                'code' => '15790',
                'name' => 'TASCO',
                'department_id' => 5,
            ),
            101 =>
            array (
                'id' => 302,
                'code' => '15798',
                'name' => 'TENZA',
                'department_id' => 5,
            ),
            102 =>
            array (
                'id' => 303,
                'code' => '15804',
                'name' => 'TIBANA',
                'department_id' => 5,
            ),
            103 =>
            array (
                'id' => 304,
                'code' => '15806',
                'name' => 'TIBASOSA',
                'department_id' => 5,
            ),
            104 =>
            array (
                'id' => 305,
                'code' => '15808',
                'name' => 'TIMJACA',
                'department_id' => 5,
            ),
            105 =>
            array (
                'id' => 306,
                'code' => '15810',
                'name' => 'TIPACOQUE',
                'department_id' => 5,
            ),
            106 =>
            array (
                'id' => 307,
                'code' => '15814',
                'name' => 'TOCA',
                'department_id' => 5,
            ),
            107 =>
            array (
                'id' => 308,
                'code' => '15816',
                'name' => 'TOGUI',
                'department_id' => 5,
            ),
            108 =>
            array (
                'id' => 309,
                'code' => '15820',
                'name' => 'TOPAGA',
                'department_id' => 5,
            ),
            109 =>
            array (
                'id' => 310,
                'code' => '15822',
                'name' => 'TOTA',
                'department_id' => 5,
            ),
            110 =>
            array (
                'id' => 311,
                'code' => '15832',
                'name' => 'TUNUNGUA',
                'department_id' => 5,
            ),
            111 =>
            array (
                'id' => 312,
                'code' => '15835',
                'name' => 'TURMEQUE',
                'department_id' => 5,
            ),
            112 =>
            array (
                'id' => 313,
                'code' => '15837',
                'name' => 'TUTA',
                'department_id' => 5,
            ),
            113 =>
            array (
                'id' => 314,
                'code' => '15839',
                'name' => 'TUTAZA',
                'department_id' => 5,
            ),
            114 =>
            array (
                'id' => 315,
                'code' => '15842',
                'name' => 'UMBITA',
                'department_id' => 5,
            ),
            115 =>
            array (
                'id' => 316,
                'code' => '15861',
                'name' => 'VENTAQUEMADA',
                'department_id' => 5,
            ),
            116 =>
            array (
                'id' => 317,
                'code' => '15879',
                'name' => 'VIRACACHA',
                'department_id' => 5,
            ),
            117 =>
            array (
                'id' => 318,
                'code' => '15897',
                'name' => 'ZETAQUIRA',
                'department_id' => 5,
            ),
            118 =>
            array (
                'id' => 319,
                'code' => '17001',
                'name' => 'MANIZALES',
                'department_id' => 6,
            ),
            119 =>
            array (
                'id' => 320,
                'code' => '17013',
                'name' => 'AGUADAS',
                'department_id' => 6,
            ),
            120 =>
            array (
                'id' => 321,
                'code' => '17042',
                'name' => 'ANSERMA',
                'department_id' => 6,
            ),
            121 =>
            array (
                'id' => 322,
                'code' => '17050',
                'name' => 'ARANZAZU',
                'department_id' => 6,
            ),
            122 =>
            array (
                'id' => 323,
                'code' => '17088',
                'name' => 'BELALCAZAR',
                'department_id' => 6,
            ),
            123 =>
            array (
                'id' => 324,
                'code' => '17114',
                'name' => 'CHINCHINA',
                'department_id' => 6,
            ),
            124 =>
            array (
                'id' => 325,
                'code' => '17272',
                'name' => 'FILADELFIA',
                'department_id' => 6,
            ),
            125 =>
            array (
                'id' => 326,
                'code' => '17380',
                'name' => 'LA DORADA',
                'department_id' => 6,
            ),
            126 =>
            array (
                'id' => 327,
                'code' => '17388',
                'name' => 'LA MERCED',
                'department_id' => 6,
            ),
            127 =>
            array (
                'id' => 328,
                'code' => '17433',
                'name' => 'MANZANARES',
                'department_id' => 6,
            ),
            128 =>
            array (
                'id' => 329,
                'code' => '17442',
                'name' => 'MARMATO',
                'department_id' => 6,
            ),
            129 =>
            array (
                'id' => 330,
                'code' => '17444',
                'name' => 'MARQUETALIA',
                'department_id' => 6,
            ),
            130 =>
            array (
                'id' => 331,
                'code' => '17446',
                'name' => 'MARULANDA',
                'department_id' => 6,
            ),
            131 =>
            array (
                'id' => 332,
                'code' => '17486',
                'name' => 'NEIRA',
                'department_id' => 6,
            ),
            132 =>
            array (
                'id' => 333,
                'code' => '17495',
                'name' => 'NORCASIA',
                'department_id' => 6,
            ),
            133 =>
            array (
                'id' => 334,
                'code' => '17513',
                'name' => 'PACORA',
                'department_id' => 6,
            ),
            134 =>
            array (
                'id' => 335,
                'code' => '17524',
                'name' => 'PALESTINA',
                'department_id' => 6,
            ),
            135 =>
            array (
                'id' => 336,
                'code' => '17541',
                'name' => 'PENSILVANIA',
                'department_id' => 6,
            ),
            136 =>
            array (
                'id' => 337,
                'code' => '17614',
                'name' => 'RIOSUCIO',
                'department_id' => 6,
            ),
            137 =>
            array (
                'id' => 338,
                'code' => '17616',
                'name' => 'RISARALDA',
                'department_id' => 6,
            ),
            138 =>
            array (
                'id' => 339,
                'code' => '17653',
                'name' => 'SALAMINA',
                'department_id' => 6,
            ),
            139 =>
            array (
                'id' => 340,
                'code' => '17662',
                'name' => 'SAMANA',
                'department_id' => 6,
            ),
            140 =>
            array (
                'id' => 341,
                'code' => '17665',
                'name' => 'SAN JOSE',
                'department_id' => 6,
            ),
            141 =>
            array (
                'id' => 342,
                'code' => '17777',
                'name' => 'SUPIA',
                'department_id' => 6,
            ),
            142 =>
            array (
                'id' => 343,
                'code' => '17867',
                'name' => 'VICTORIA',
                'department_id' => 6,
            ),
            143 =>
            array (
                'id' => 344,
                'code' => '17873',
                'name' => 'VILLAMARIA',
                'department_id' => 6,
            ),
            144 =>
            array (
                'id' => 345,
                'code' => '17877',
                'name' => 'VITERBO',
                'department_id' => 6,
            ),
            145 =>
            array (
                'id' => 346,
                'code' => '18001',
                'name' => 'FLORENCIA',
                'department_id' => 7,
            ),
            146 =>
            array (
                'id' => 347,
                'code' => '18029',
                'name' => 'ALBANZA',
                'department_id' => 7,
            ),
            147 =>
            array (
                'id' => 348,
                'code' => '18094',
                'name' => 'BELEN DE LOS ANDAQUIES',
                'department_id' => 7,
            ),
            148 =>
            array (
                'id' => 349,
                'code' => '18150',
                'name' => 'CARTAGENA DEL CHAIRA',
                'department_id' => 7,
            ),
            149 =>
            array (
                'id' => 350,
                'code' => '18205',
                'name' => 'CURILLO',
                'department_id' => 7,
            ),
            150 =>
            array (
                'id' => 351,
                'code' => '18247',
                'name' => 'EL DONCELLO',
                'department_id' => 7,
            ),
            151 =>
            array (
                'id' => 352,
                'code' => '18256',
                'name' => 'EL PAJUIL',
                'department_id' => 7,
            ),
            152 =>
            array (
                'id' => 353,
                'code' => '18410',
                'name' => 'LA MONTAÑITA',
                'department_id' => 7,
            ),
            153 =>
            array (
                'id' => 354,
                'code' => '18460',
                'name' => 'MILAN',
                'department_id' => 7,
            ),
            154 =>
            array (
                'id' => 355,
                'code' => '18479',
                'name' => 'MORELIA',
                'department_id' => 7,
            ),
            155 =>
            array (
                'id' => 356,
                'code' => '18592',
                'name' => 'PUERTO RICO',
                'department_id' => 7,
            ),
            156 =>
            array (
                'id' => 357,
                'code' => '18610',
                'name' => 'SAN JOSE DEL FRAGUA',
                'department_id' => 7,
            ),
            157 =>
            array (
                'id' => 358,
                'code' => '18753',
                'name' => 'SAN VICENTE DEL CAGUAN',
                'department_id' => 7,
            ),
            158 =>
            array (
                'id' => 359,
                'code' => '18756',
                'name' => 'SOLANO',
                'department_id' => 7,
            ),
            159 =>
            array (
                'id' => 360,
                'code' => '18785',
                'name' => 'SOLITA',
                'department_id' => 7,
            ),
            160 =>
            array (
                'id' => 361,
                'code' => '18860',
                'name' => 'VALPARAISO',
                'department_id' => 7,
            ),
            161 =>
            array (
                'id' => 362,
                'code' => '19001',
                'name' => 'POPAYAN',
                'department_id' => 8,
            ),
            162 =>
            array (
                'id' => 363,
                'code' => '19022',
                'name' => 'ALMAGUER',
                'department_id' => 8,
            ),
            163 =>
            array (
                'id' => 364,
                'code' => '19050',
                'name' => 'ARGELIA',
                'department_id' => 8,
            ),
            164 =>
            array (
                'id' => 365,
                'code' => '19075',
                'name' => 'BALBOA',
                'department_id' => 8,
            ),
            165 =>
            array (
                'id' => 366,
                'code' => '19100',
                'name' => 'BOLIVAR',
                'department_id' => 8,
            ),
            166 =>
            array (
                'id' => 367,
                'code' => '19110',
                'name' => 'BUENOS AIRES',
                'department_id' => 8,
            ),
            167 =>
            array (
                'id' => 368,
                'code' => '19130',
                'name' => 'CAJIBIO',
                'department_id' => 8,
            ),
            168 =>
            array (
                'id' => 369,
                'code' => '19137',
                'name' => 'CALDOMO',
                'department_id' => 8,
            ),
            169 =>
            array (
                'id' => 370,
                'code' => '19142',
                'name' => 'CALOTO',
                'department_id' => 8,
            ),
            170 =>
            array (
                'id' => 371,
                'code' => '19212',
                'name' => 'CORINTO',
                'department_id' => 8,
            ),
            171 =>
            array (
                'id' => 372,
                'code' => '19256',
                'name' => 'EL TAMBO',
                'department_id' => 8,
            ),
            172 =>
            array (
                'id' => 373,
                'code' => '19290',
                'name' => 'FLORENCIA',
                'department_id' => 8,
            ),
            173 =>
            array (
                'id' => 374,
                'code' => '19300',
                'name' => 'GUACHENE',
                'department_id' => 8,
            ),
            174 =>
            array (
                'id' => 375,
                'code' => '19318',
                'name' => 'GUAPI',
                'department_id' => 8,
            ),
            175 =>
            array (
                'id' => 376,
                'code' => '19355',
                'name' => 'INZA',
                'department_id' => 8,
            ),
            176 =>
            array (
                'id' => 377,
                'code' => '19364',
                'name' => 'JAMBALO',
                'department_id' => 8,
            ),
            177 =>
            array (
                'id' => 378,
                'code' => '19392',
                'name' => 'LA SIERRA',
                'department_id' => 8,
            ),
            178 =>
            array (
                'id' => 379,
                'code' => '19397',
                'name' => 'LA VEGA',
                'department_id' => 8,
            ),
            179 =>
            array (
                'id' => 380,
                'code' => '19418',
                'name' => 'LOPEZ DE MICAY',
                'department_id' => 8,
            ),
            180 =>
            array (
                'id' => 381,
                'code' => '19450',
                'name' => 'MERCADERES',
                'department_id' => 8,
            ),
            181 =>
            array (
                'id' => 382,
                'code' => '19455',
                'name' => 'MIRANDA',
                'department_id' => 8,
            ),
            182 =>
            array (
                'id' => 383,
                'code' => '19473',
                'name' => 'MORALES',
                'department_id' => 8,
            ),
            183 =>
            array (
                'id' => 384,
                'code' => '19513',
                'name' => 'PADILLA',
                'department_id' => 8,
            ),
            184 =>
            array (
                'id' => 385,
                'code' => '19517',
                'name' => 'PAEZ - BELALCAZAR',
                'department_id' => 8,
            ),
            185 =>
            array (
                'id' => 386,
                'code' => '19532',
                'name' => 'PATIA - EL BORDO',
                'department_id' => 8,
            ),
            186 =>
            array (
                'id' => 387,
                'code' => '19533',
                'name' => 'PIAMONTE',
                'department_id' => 8,
            ),
            187 =>
            array (
                'id' => 388,
                'code' => '19548',
                'name' => 'PIENDAMO - TUNIA',
                'department_id' => 8,
            ),
            188 =>
            array (
                'id' => 389,
                'code' => '19573',
                'name' => 'PUERTO TEJADA',
                'department_id' => 8,
            ),
            189 =>
            array (
                'id' => 390,
                'code' => '19585',
                'name' => 'PURACE - COCONUCO',
                'department_id' => 8,
            ),
            190 =>
            array (
                'id' => 391,
                'code' => '19622',
                'name' => 'ROSAS',
                'department_id' => 8,
            ),
            191 =>
            array (
                'id' => 392,
                'code' => '19693',
                'name' => 'SAN SEBASTIAN',
                'department_id' => 8,
            ),
            192 =>
            array (
                'id' => 393,
                'code' => '19698',
                'name' => 'SANTANDER DE QUILICHAO',
                'department_id' => 8,
            ),
            193 =>
            array (
                'id' => 394,
                'code' => '19701',
                'name' => 'SANTA ROSA',
                'department_id' => 8,
            ),
            194 =>
            array (
                'id' => 395,
                'code' => '19743',
                'name' => 'SILVIA',
                'department_id' => 8,
            ),
            195 =>
            array (
                'id' => 396,
                'code' => '19760',
                'name' => 'SOTARA',
                'department_id' => 8,
            ),
            196 =>
            array (
                'id' => 397,
                'code' => '19780',
                'name' => 'SUAREZ',
                'department_id' => 8,
            ),
            197 =>
            array (
                'id' => 398,
                'code' => '19785',
                'name' => 'SUCRE',
                'department_id' => 8,
            ),
            198 =>
            array (
                'id' => 399,
                'code' => '19807',
                'name' => 'TIMBIO',
                'department_id' => 8,
            ),
            199 =>
            array (
                'id' => 400,
                'code' => '19809',
                'name' => 'TIMBIQUI',
                'department_id' => 8,
            ),
        ));
        DB::table('municipalities')->insert(array (
            0 =>
            array (
                'id' => 401,
                'code' => '19821',
                'name' => 'TORIBIO',
                'department_id' => 8,
            ),
            1 =>
            array (
                'id' => 402,
                'code' => '19824',
                'name' => 'TOTORO',
                'department_id' => 8,
            ),
            2 =>
            array (
                'id' => 403,
                'code' => '19845',
                'name' => 'VILLA RICA',
                'department_id' => 8,
            ),
            3 =>
            array (
                'id' => 404,
                'code' => '20001',
                'name' => 'VALLEDUPAR',
                'department_id' => 9,
            ),
            4 =>
            array (
                'id' => 405,
                'code' => '20011',
                'name' => 'AGUACHICA',
                'department_id' => 9,
            ),
            5 =>
            array (
                'id' => 406,
                'code' => '20013',
                'name' => 'AGUSTIN CODAZI',
                'department_id' => 9,
            ),
            6 =>
            array (
                'id' => 407,
                'code' => '20032',
                'name' => 'ASTREA',
                'department_id' => 9,
            ),
            7 =>
            array (
                'id' => 408,
                'code' => '20045',
                'name' => 'BECERRIL',
                'department_id' => 9,
            ),
            8 =>
            array (
                'id' => 409,
                'code' => '20060',
                'name' => 'BOSCONIA',
                'department_id' => 9,
            ),
            9 =>
            array (
                'id' => 410,
                'code' => '20175',
                'name' => 'CHIMICHAGUA',
                'department_id' => 9,
            ),
            10 =>
            array (
                'id' => 411,
                'code' => '20178',
                'name' => 'CHIRIGUANA',
                'department_id' => 9,
            ),
            11 =>
            array (
                'id' => 412,
                'code' => '20228',
                'name' => 'CURUMANI',
                'department_id' => 9,
            ),
            12 =>
            array (
                'id' => 413,
                'code' => '20238',
                'name' => 'EL COPEY',
                'department_id' => 9,
            ),
            13 =>
            array (
                'id' => 414,
                'code' => '20250',
                'name' => 'EL PASO',
                'department_id' => 9,
            ),
            14 =>
            array (
                'id' => 415,
                'code' => '20295',
                'name' => 'GAMARRA',
                'department_id' => 9,
            ),
            15 =>
            array (
                'id' => 416,
                'code' => '20310',
                'name' => 'GONZALEZ',
                'department_id' => 9,
            ),
            16 =>
            array (
                'id' => 417,
                'code' => '20383',
                'name' => 'LA GLORIA',
                'department_id' => 9,
            ),
            17 =>
            array (
                'id' => 418,
                'code' => '20400',
                'name' => 'LA JAGUA DE IBIRICO',
                'department_id' => 9,
            ),
            18 =>
            array (
                'id' => 419,
                'code' => '20443',
                'name' => 'MANAURE BALCON DEL CESAR',
                'department_id' => 9,
            ),
            19 =>
            array (
                'id' => 420,
                'code' => '20517',
                'name' => 'PAILITAS',
                'department_id' => 9,
            ),
            20 =>
            array (
                'id' => 421,
                'code' => '20550',
                'name' => 'PELAYA',
                'department_id' => 9,
            ),
            21 =>
            array (
                'id' => 422,
                'code' => '20570',
                'name' => 'PUEBLO BELLO',
                'department_id' => 9,
            ),
            22 =>
            array (
                'id' => 423,
                'code' => '20614',
                'name' => 'RIO DE ORO',
                'department_id' => 9,
            ),
            23 =>
            array (
                'id' => 424,
                'code' => '20621',
                'name' => 'LA PAZ',
                'department_id' => 9,
            ),
            24 =>
            array (
                'id' => 425,
                'code' => '20710',
                'name' => 'SAN ALBERTO',
                'department_id' => 9,
            ),
            25 =>
            array (
                'id' => 426,
                'code' => '20750',
                'name' => 'SAN DIEGO',
                'department_id' => 9,
            ),
            26 =>
            array (
                'id' => 427,
                'code' => '20770',
                'name' => 'SAN MARTIN',
                'department_id' => 9,
            ),
            27 =>
            array (
                'id' => 428,
                'code' => '20787',
                'name' => 'TAMALAMEQUE',
                'department_id' => 9,
            ),
            28 =>
            array (
                'id' => 429,
                'code' => '23001',
                'name' => 'MONTERIA',
                'department_id' => 10,
            ),
            29 =>
            array (
                'id' => 430,
                'code' => '23068',
                'name' => 'AYAPEL',
                'department_id' => 10,
            ),
            30 =>
            array (
                'id' => 431,
                'code' => '23079',
                'name' => 'BUENAVISTA',
                'department_id' => 10,
            ),
            31 =>
            array (
                'id' => 432,
                'code' => '23090',
                'name' => 'CANALETE',
                'department_id' => 10,
            ),
            32 =>
            array (
                'id' => 433,
                'code' => '23162',
                'name' => 'CERETE',
                'department_id' => 10,
            ),
            33 =>
            array (
                'id' => 434,
                'code' => '23168',
                'name' => 'CHIMA',
                'department_id' => 10,
            ),
            34 =>
            array (
                'id' => 435,
                'code' => '23182',
                'name' => 'CHINU',
                'department_id' => 10,
            ),
            35 =>
            array (
                'id' => 436,
                'code' => '23189',
                'name' => 'CIENAGA DE ORO',
                'department_id' => 10,
            ),
            36 =>
            array (
                'id' => 437,
                'code' => '23300',
                'name' => 'COTORRA',
                'department_id' => 10,
            ),
            37 =>
            array (
                'id' => 438,
                'code' => '23350',
                'name' => 'LA APARTADA',
                'department_id' => 10,
            ),
            38 =>
            array (
                'id' => 439,
                'code' => '23417',
                'name' => 'LORICA',
                'department_id' => 10,
            ),
            39 =>
            array (
                'id' => 440,
                'code' => '23419',
                'name' => 'LOS CORDOBAS',
                'department_id' => 10,
            ),
            40 =>
            array (
                'id' => 441,
                'code' => '23464',
                'name' => 'MOMIL',
                'department_id' => 10,
            ),
            41 =>
            array (
                'id' => 442,
                'code' => '23466',
                'name' => 'MONTELIBANO',
                'department_id' => 10,
            ),
            42 =>
            array (
                'id' => 443,
                'code' => '23500',
                'name' => 'MOÑITOS',
                'department_id' => 10,
            ),
            43 =>
            array (
                'id' => 444,
                'code' => '23555',
                'name' => 'PLANETA RICA',
                'department_id' => 10,
            ),
            44 =>
            array (
                'id' => 445,
                'code' => '23570',
                'name' => 'PUEBLO NUEVO',
                'department_id' => 10,
            ),
            45 =>
            array (
                'id' => 446,
                'code' => '23574',
                'name' => 'PUERTO ESCONDIDO',
                'department_id' => 10,
            ),
            46 =>
            array (
                'id' => 447,
                'code' => '23580',
                'name' => 'PUERTO LIBERTADOR',
                'department_id' => 10,
            ),
            47 =>
            array (
                'id' => 448,
                'code' => '23586',
                'name' => 'PURISIMA DE LA CONCEPCION',
                'department_id' => 10,
            ),
            48 =>
            array (
                'id' => 449,
                'code' => '23660',
                'name' => 'SAHAGUN',
                'department_id' => 10,
            ),
            49 =>
            array (
                'id' => 450,
                'code' => '23670',
                'name' => 'SAN ANDRES DE SOTAVENTO',
                'department_id' => 10,
            ),
            50 =>
            array (
                'id' => 451,
                'code' => '23672',
                'name' => 'SAN ANTERO',
                'department_id' => 10,
            ),
            51 =>
            array (
                'id' => 452,
                'code' => '23675',
                'name' => 'SAN BERNARDO DEL VIENTO',
                'department_id' => 10,
            ),
            52 =>
            array (
                'id' => 453,
                'code' => '23678',
                'name' => 'SAN CARLOS',
                'department_id' => 10,
            ),
            53 =>
            array (
                'id' => 454,
                'code' => '23682',
                'name' => 'SAN JOSE DE URE',
                'department_id' => 10,
            ),
            54 =>
            array (
                'id' => 455,
                'code' => '23686',
                'name' => 'SAN PELAYO',
                'department_id' => 10,
            ),
            55 =>
            array (
                'id' => 456,
                'code' => '23807',
                'name' => 'TIERRA ALTA',
                'department_id' => 10,
            ),
            56 =>
            array (
                'id' => 457,
                'code' => '23815',
                'name' => 'TUCHIN',
                'department_id' => 10,
            ),
            57 =>
            array (
                'id' => 458,
                'code' => '23855',
                'name' => 'VALENCIA',
                'department_id' => 10,
            ),
            58 =>
            array (
                'id' => 459,
                'code' => '25001',
                'name' => 'AGUA DE DIOS',
                'department_id' => 11,
            ),
            59 =>
            array (
                'id' => 460,
                'code' => '25019',
                'name' => 'ALBAN',
                'department_id' => 11,
            ),
            60 =>
            array (
                'id' => 461,
                'code' => '25035',
                'name' => 'ANAPOIMA',
                'department_id' => 11,
            ),
            61 =>
            array (
                'id' => 462,
                'code' => '25040',
                'name' => 'ANOLAIMA',
                'department_id' => 11,
            ),
            62 =>
            array (
                'id' => 463,
                'code' => '25053',
                'name' => 'ARBELAEZ',
                'department_id' => 11,
            ),
            63 =>
            array (
                'id' => 464,
                'code' => '25086',
                'name' => 'BELTRAN',
                'department_id' => 11,
            ),
            64 =>
            array (
                'id' => 465,
                'code' => '25095',
                'name' => 'BITUIMA',
                'department_id' => 11,
            ),
            65 =>
            array (
                'id' => 466,
                'code' => '25099',
                'name' => 'BOJACA',
                'department_id' => 11,
            ),
            66 =>
            array (
                'id' => 467,
                'code' => '25120',
                'name' => 'CABRERA',
                'department_id' => 11,
            ),
            67 =>
            array (
                'id' => 468,
                'code' => '25123',
                'name' => 'CACHIPAY',
                'department_id' => 11,
            ),
            68 =>
            array (
                'id' => 469,
                'code' => '25126',
                'name' => 'CAJICA',
                'department_id' => 11,
            ),
            69 =>
            array (
                'id' => 470,
                'code' => '25148',
                'name' => 'CAPARRAPI',
                'department_id' => 11,
            ),
            70 =>
            array (
                'id' => 471,
                'code' => '25151',
                'name' => 'CAQUEZA',
                'department_id' => 11,
            ),
            71 =>
            array (
                'id' => 472,
                'code' => '25154',
                'name' => 'CARMEN DE CARUPA',
                'department_id' => 11,
            ),
            72 =>
            array (
                'id' => 473,
                'code' => '25168',
                'name' => 'CHAGUANI',
                'department_id' => 11,
            ),
            73 =>
            array (
                'id' => 474,
                'code' => '25175',
                'name' => 'CHIA',
                'department_id' => 11,
            ),
            74 =>
            array (
                'id' => 475,
                'code' => '25178',
                'name' => 'CHIPAQUE',
                'department_id' => 11,
            ),
            75 =>
            array (
                'id' => 476,
                'code' => '25181',
                'name' => 'COACHI',
                'department_id' => 11,
            ),
            76 =>
            array (
                'id' => 477,
                'code' => '25183',
                'name' => 'CHOCONTA',
                'department_id' => 11,
            ),
            77 =>
            array (
                'id' => 478,
                'code' => '25200',
                'name' => 'COGUA',
                'department_id' => 11,
            ),
            78 =>
            array (
                'id' => 479,
                'code' => '25214',
                'name' => 'COTA',
                'department_id' => 11,
            ),
            79 =>
            array (
                'id' => 480,
                'code' => '25224',
                'name' => 'CUCUNUBA',
                'department_id' => 11,
            ),
            80 =>
            array (
                'id' => 481,
                'code' => '25245',
                'name' => 'EL COLEGIO',
                'department_id' => 11,
            ),
            81 =>
            array (
                'id' => 482,
                'code' => '25258',
                'name' => 'EL PEÑON',
                'department_id' => 11,
            ),
            82 =>
            array (
                'id' => 483,
                'code' => '25260',
                'name' => 'EL ROSAL',
                'department_id' => 11,
            ),
            83 =>
            array (
                'id' => 484,
                'code' => '25269',
                'name' => 'FACACATIVA',
                'department_id' => 11,
            ),
            84 =>
            array (
                'id' => 485,
                'code' => '25279',
                'name' => 'FOMEQUE',
                'department_id' => 11,
            ),
            85 =>
            array (
                'id' => 486,
                'code' => '25281',
                'name' => 'FOSCA',
                'department_id' => 11,
            ),
            86 =>
            array (
                'id' => 487,
                'code' => '25286',
                'name' => 'FUNZA',
                'department_id' => 11,
            ),
            87 =>
            array (
                'id' => 488,
                'code' => '25288',
                'name' => 'FUQUENE',
                'department_id' => 11,
            ),
            88 =>
            array (
                'id' => 489,
                'code' => '25290',
                'name' => 'FUSAGASUGA',
                'department_id' => 11,
            ),
            89 =>
            array (
                'id' => 490,
                'code' => '25293',
                'name' => 'GACHALA',
                'department_id' => 11,
            ),
            90 =>
            array (
                'id' => 491,
                'code' => '25295',
                'name' => 'GACJANCIPA',
                'department_id' => 11,
            ),
            91 =>
            array (
                'id' => 492,
                'code' => '25297',
                'name' => 'GACHETA',
                'department_id' => 11,
            ),
            92 =>
            array (
                'id' => 493,
                'code' => '25299',
                'name' => 'GAMA',
                'department_id' => 11,
            ),
            93 =>
            array (
                'id' => 494,
                'code' => '25307',
                'name' => 'GIRARDOT',
                'department_id' => 11,
            ),
            94 =>
            array (
                'id' => 495,
                'code' => '25312',
                'name' => 'GRANADA',
                'department_id' => 11,
            ),
            95 =>
            array (
                'id' => 496,
                'code' => '25317',
                'name' => 'GUACHETA',
                'department_id' => 11,
            ),
            96 =>
            array (
                'id' => 497,
                'code' => '25320',
                'name' => 'GUADUAS',
                'department_id' => 11,
            ),
            97 =>
            array (
                'id' => 498,
                'code' => '25322',
                'name' => 'GUASCA',
                'department_id' => 11,
            ),
            98 =>
            array (
                'id' => 499,
                'code' => '25324',
                'name' => 'GUATAQUI',
                'department_id' => 11,
            ),
            99 =>
            array (
                'id' => 500,
                'code' => '25326',
                'name' => 'GUATAVITA',
                'department_id' => 11,
            ),
            100 =>
            array (
                'id' => 501,
                'code' => '25328',
                'name' => 'GUAYABAL DE SIQUIMA',
                'department_id' => 11,
            ),
            101 =>
            array (
                'id' => 502,
                'code' => '25335',
                'name' => 'GUAYABETAL',
                'department_id' => 11,
            ),
            102 =>
            array (
                'id' => 503,
                'code' => '25339',
                'name' => 'GUTIERREZ',
                'department_id' => 11,
            ),
            103 =>
            array (
                'id' => 504,
                'code' => '25368',
                'name' => 'JERUSALEN',
                'department_id' => 11,
            ),
            104 =>
            array (
                'id' => 505,
                'code' => '25372',
                'name' => 'JUNIN',
                'department_id' => 11,
            ),
            105 =>
            array (
                'id' => 506,
                'code' => '25377',
                'name' => 'LA CALERA',
                'department_id' => 11,
            ),
            106 =>
            array (
                'id' => 507,
                'code' => '25386',
                'name' => 'LA MESA',
                'department_id' => 11,
            ),
            107 =>
            array (
                'id' => 508,
                'code' => '25394',
                'name' => 'LA PALMA',
                'department_id' => 11,
            ),
            108 =>
            array (
                'id' => 509,
                'code' => '25398',
                'name' => 'LA PEÑA',
                'department_id' => 11,
            ),
            109 =>
            array (
                'id' => 510,
                'code' => '25402',
                'name' => 'LA VEGA',
                'department_id' => 11,
            ),
            110 =>
            array (
                'id' => 511,
                'code' => '25407',
                'name' => 'LENGUAZAQUE',
                'department_id' => 11,
            ),
            111 =>
            array (
                'id' => 512,
                'code' => '25426',
                'name' => 'MACHETA',
                'department_id' => 11,
            ),
            112 =>
            array (
                'id' => 513,
                'code' => '25430',
                'name' => 'MADRID',
                'department_id' => 11,
            ),
            113 =>
            array (
                'id' => 514,
                'code' => '25436',
                'name' => 'MANTA',
                'department_id' => 11,
            ),
            114 =>
            array (
                'id' => 515,
                'code' => '25438',
                'name' => 'MEDINA',
                'department_id' => 11,
            ),
            115 =>
            array (
                'id' => 516,
                'code' => '25473',
                'name' => 'MOSQUERA',
                'department_id' => 11,
            ),
            116 =>
            array (
                'id' => 517,
                'code' => '25483',
                'name' => 'NARIÑO',
                'department_id' => 11,
            ),
            117 =>
            array (
                'id' => 518,
                'code' => '25486',
                'name' => 'NEMOCON',
                'department_id' => 11,
            ),
            118 =>
            array (
                'id' => 519,
                'code' => '25488',
                'name' => 'NILO',
                'department_id' => 11,
            ),
            119 =>
            array (
                'id' => 520,
                'code' => '25489',
                'name' => 'NIMAIMA',
                'department_id' => 11,
            ),
            120 =>
            array (
                'id' => 521,
                'code' => '25491',
                'name' => 'NOCAIMA',
                'department_id' => 11,
            ),
            121 =>
            array (
                'id' => 522,
                'code' => '25506',
                'name' => 'VENECIA',
                'department_id' => 11,
            ),
            122 =>
            array (
                'id' => 523,
                'code' => '25513',
                'name' => 'PACHO',
                'department_id' => 11,
            ),
            123 =>
            array (
                'id' => 524,
                'code' => '25518',
                'name' => 'PAIME',
                'department_id' => 11,
            ),
            124 =>
            array (
                'id' => 525,
                'code' => '25524',
                'name' => 'PANDI',
                'department_id' => 11,
            ),
            125 =>
            array (
                'id' => 526,
                'code' => '25530',
                'name' => 'PARATEBUENO',
                'department_id' => 11,
            ),
            126 =>
            array (
                'id' => 527,
                'code' => '25535',
                'name' => 'PASCA',
                'department_id' => 11,
            ),
            127 =>
            array (
                'id' => 528,
                'code' => '25572',
                'name' => 'PUERTO SALGAR',
                'department_id' => 11,
            ),
            128 =>
            array (
                'id' => 529,
                'code' => '25580',
                'name' => 'PULI',
                'department_id' => 11,
            ),
            129 =>
            array (
                'id' => 530,
                'code' => '25592',
                'name' => 'QUEBRADANEGRA',
                'department_id' => 11,
            ),
            130 =>
            array (
                'id' => 531,
                'code' => '25594',
                'name' => 'QUETAME',
                'department_id' => 11,
            ),
            131 =>
            array (
                'id' => 532,
                'code' => '25596',
                'name' => 'QUIPELE',
                'department_id' => 11,
            ),
            132 =>
            array (
                'id' => 533,
                'code' => '25599',
                'name' => 'APULO',
                'department_id' => 11,
            ),
            133 =>
            array (
                'id' => 534,
                'code' => '25612',
                'name' => 'RICAURTE',
                'department_id' => 11,
            ),
            134 =>
            array (
                'id' => 535,
                'code' => '25645',
                'name' => 'SAN ANTONIO DEL TEQUENDAMA',
                'department_id' => 11,
            ),
            135 =>
            array (
                'id' => 536,
                'code' => '25649',
                'name' => 'SAN BERNARDO',
                'department_id' => 11,
            ),
            136 =>
            array (
                'id' => 537,
                'code' => '25653',
                'name' => 'SAN CAYETANO',
                'department_id' => 11,
            ),
            137 =>
            array (
                'id' => 538,
                'code' => '25658',
                'name' => 'SAN FRANCISCO',
                'department_id' => 11,
            ),
            138 =>
            array (
                'id' => 539,
                'code' => '25662',
                'name' => 'SAN JUAN DE RIO SECO',
                'department_id' => 11,
            ),
            139 =>
            array (
                'id' => 540,
                'code' => '25718',
                'name' => 'SASAIMA',
                'department_id' => 11,
            ),
            140 =>
            array (
                'id' => 541,
                'code' => '25736',
                'name' => 'SESQUILE',
                'department_id' => 11,
            ),
            141 =>
            array (
                'id' => 542,
                'code' => '25740',
                'name' => 'SIBATE',
                'department_id' => 11,
            ),
            142 =>
            array (
                'id' => 543,
                'code' => '25743',
                'name' => 'SILVANIA',
                'department_id' => 11,
            ),
            143 =>
            array (
                'id' => 544,
                'code' => '25745',
                'name' => 'SIMIJACA',
                'department_id' => 11,
            ),
            144 =>
            array (
                'id' => 545,
                'code' => '25754',
                'name' => 'SOACHA',
                'department_id' => 11,
            ),
            145 =>
            array (
                'id' => 546,
                'code' => '25758',
                'name' => 'SOPO',
                'department_id' => 11,
            ),
            146 =>
            array (
                'id' => 547,
                'code' => '25769',
                'name' => 'SUBACHOQUE',
                'department_id' => 11,
            ),
            147 =>
            array (
                'id' => 548,
                'code' => '25772',
                'name' => 'SUESCA',
                'department_id' => 11,
            ),
            148 =>
            array (
                'id' => 549,
                'code' => '25777',
                'name' => 'SUPATA',
                'department_id' => 11,
            ),
            149 =>
            array (
                'id' => 550,
                'code' => '25779',
                'name' => 'SUSA',
                'department_id' => 11,
            ),
            150 =>
            array (
                'id' => 551,
                'code' => '25781',
                'name' => 'SUTATAISA',
                'department_id' => 11,
            ),
            151 =>
            array (
                'id' => 552,
                'code' => '25785',
                'name' => 'TABIO',
                'department_id' => 11,
            ),
            152 =>
            array (
                'id' => 553,
                'code' => '25793',
                'name' => 'TAUSA',
                'department_id' => 11,
            ),
            153 =>
            array (
                'id' => 554,
                'code' => '25797',
                'name' => 'TENA',
                'department_id' => 11,
            ),
            154 =>
            array (
                'id' => 555,
                'code' => '25799',
                'name' => 'TENJO',
                'department_id' => 11,
            ),
            155 =>
            array (
                'id' => 556,
                'code' => '25805',
                'name' => 'TIBACUY',
                'department_id' => 11,
            ),
            156 =>
            array (
                'id' => 557,
                'code' => '25807',
                'name' => 'TIBIRITA',
                'department_id' => 11,
            ),
            157 =>
            array (
                'id' => 558,
                'code' => '25815',
                'name' => 'TOCAIMA',
                'department_id' => 11,
            ),
            158 =>
            array (
                'id' => 559,
                'code' => '25817',
                'name' => 'TOCANCIPA',
                'department_id' => 11,
            ),
            159 =>
            array (
                'id' => 560,
                'code' => '25823',
                'name' => 'TOPAIPI',
                'department_id' => 11,
            ),
            160 =>
            array (
                'id' => 561,
                'code' => '25839',
                'name' => 'UBALA',
                'department_id' => 11,
            ),
            161 =>
            array (
                'id' => 562,
                'code' => '25841',
                'name' => 'UBAQUE',
                'department_id' => 11,
            ),
            162 =>
            array (
                'id' => 563,
                'code' => '25843',
                'name' => 'VILLA DE SAN DIEGO DE UBATE',
                'department_id' => 11,
            ),
            163 =>
            array (
                'id' => 564,
                'code' => '25845',
                'name' => 'UNE',
                'department_id' => 11,
            ),
            164 =>
            array (
                'id' => 565,
                'code' => '25851',
                'name' => 'UTICA',
                'department_id' => 11,
            ),
            165 =>
            array (
                'id' => 566,
                'code' => '25862',
                'name' => 'VERGARA',
                'department_id' => 11,
            ),
            166 =>
            array (
                'id' => 567,
                'code' => '25867',
                'name' => 'VIANI',
                'department_id' => 11,
            ),
            167 =>
            array (
                'id' => 568,
                'code' => '25871',
                'name' => 'VILLAGOMEZ',
                'department_id' => 11,
            ),
            168 =>
            array (
                'id' => 569,
                'code' => '25873',
                'name' => 'VILLAPINZON',
                'department_id' => 11,
            ),
            169 =>
            array (
                'id' => 570,
                'code' => '25875',
                'name' => 'VILLETA',
                'department_id' => 11,
            ),
            170 =>
            array (
                'id' => 571,
                'code' => '25878',
                'name' => 'VIOTA',
                'department_id' => 11,
            ),
            171 =>
            array (
                'id' => 572,
                'code' => '25885',
                'name' => 'YACOPI',
                'department_id' => 11,
            ),
            172 =>
            array (
                'id' => 573,
                'code' => '25898',
                'name' => 'ZIPACON',
                'department_id' => 11,
            ),
            173 =>
            array (
                'id' => 574,
                'code' => '25899',
                'name' => 'ZIPAQUIRA',
                'department_id' => 11,
            ),
            174 =>
            array (
                'id' => 575,
                'code' => '27001',
                'name' => 'QUIBDO',
                'department_id' => 12,
            ),
            175 =>
            array (
                'id' => 576,
                'code' => '27006',
                'name' => 'ACANDI',
                'department_id' => 12,
            ),
            176 =>
            array (
                'id' => 577,
                'code' => '27025',
                'name' => 'ALTO BAUDO',
                'department_id' => 12,
            ),
            177 =>
            array (
                'id' => 578,
                'code' => '27050',
                'name' => 'ATRATO',
                'department_id' => 12,
            ),
            178 =>
            array (
                'id' => 579,
                'code' => '27073',
                'name' => 'BAGADO',
                'department_id' => 12,
            ),
            179 =>
            array (
                'id' => 580,
                'code' => '27075',
                'name' => 'BAHIA SOLANO',
                'department_id' => 12,
            ),
            180 =>
            array (
                'id' => 581,
                'code' => '27077',
                'name' => 'BAJO BAUDO',
                'department_id' => 12,
            ),
            181 =>
            array (
                'id' => 582,
                'code' => '27099',
                'name' => 'BOJAYA',
                'department_id' => 12,
            ),
            182 =>
            array (
                'id' => 583,
                'code' => '27135',
                'name' => 'EL CANTON DE SAN PABLO',
                'department_id' => 12,
            ),
            183 =>
            array (
                'id' => 584,
                'code' => '27150',
                'name' => 'CARMEN DEL DARIEN',
                'department_id' => 12,
            ),
            184 =>
            array (
                'id' => 585,
                'code' => '27160',
                'name' => 'CERTEGUI',
                'department_id' => 12,
            ),
            185 =>
            array (
                'id' => 586,
                'code' => '27205',
                'name' => 'CONDOTO',
                'department_id' => 12,
            ),
            186 =>
            array (
                'id' => 587,
                'code' => '27245',
                'name' => 'EL CARMEN DE ATRATO',
                'department_id' => 12,
            ),
            187 =>
            array (
                'id' => 588,
                'code' => '27250',
                'name' => 'EL LITORAL DE SAN JUAN',
                'department_id' => 12,
            ),
            188 =>
            array (
                'id' => 589,
                'code' => '27361',
                'name' => 'ISTMINA',
                'department_id' => 12,
            ),
            189 =>
            array (
                'id' => 590,
                'code' => '27372',
                'name' => 'JURADO',
                'department_id' => 12,
            ),
            190 =>
            array (
                'id' => 591,
                'code' => '27413',
                'name' => 'LLORO',
                'department_id' => 12,
            ),
            191 =>
            array (
                'id' => 592,
                'code' => '27425',
                'name' => 'MEDIO ATRATO',
                'department_id' => 12,
            ),
            192 =>
            array (
                'id' => 593,
                'code' => '27430',
                'name' => 'MEDIO BAUDO',
                'department_id' => 12,
            ),
            193 =>
            array (
                'id' => 594,
                'code' => '27450',
                'name' => 'MEDIO SAN JUAN',
                'department_id' => 12,
            ),
            194 =>
            array (
                'id' => 595,
                'code' => '27491',
                'name' => 'NOVITA',
                'department_id' => 12,
            ),
            195 =>
            array (
                'id' => 596,
                'code' => '27495',
                'name' => 'NUQUI',
                'department_id' => 12,
            ),
            196 =>
            array (
                'id' => 597,
                'code' => '27580',
                'name' => 'RIO IRO',
                'department_id' => 12,
            ),
            197 =>
            array (
                'id' => 598,
                'code' => '27600',
                'name' => 'RIO QUITO',
                'department_id' => 12,
            ),
            198 =>
            array (
                'id' => 599,
                'code' => '27615',
                'name' => 'RIO SUCIO',
                'department_id' => 12,
            ),
            199 =>
            array (
                'id' => 600,
                'code' => '27660',
                'name' => 'SAN JOSE DEL PALMAR',
                'department_id' => 12,
            ),
        ));
        DB::table('municipalities')->insert(array (
            0 =>
            array (
                'id' => 601,
                'code' => '27745',
                'name' => 'SIPI',
                'department_id' => 12,
            ),
            1 =>
            array (
                'id' => 602,
                'code' => '27787',
                'name' => 'TADO',
                'department_id' => 12,
            ),
            2 =>
            array (
                'id' => 603,
                'code' => '27800',
                'name' => 'UNGUIA',
                'department_id' => 12,
            ),
            3 =>
            array (
                'id' => 604,
                'code' => '27810',
                'name' => 'UNION PANAMERICANA',
                'department_id' => 12,
            ),
            4 =>
            array (
                'id' => 605,
                'code' => '41001',
                'name' => 'NEIVA',
                'department_id' => 13,
            ),
            5 =>
            array (
                'id' => 606,
                'code' => '41006',
                'name' => 'ACEVEDO',
                'department_id' => 13,
            ),
            6 =>
            array (
                'id' => 607,
                'code' => '41013',
                'name' => 'AGRADO',
                'department_id' => 13,
            ),
            7 =>
            array (
                'id' => 608,
                'code' => '41016',
                'name' => 'AIPE',
                'department_id' => 13,
            ),
            8 =>
            array (
                'id' => 609,
                'code' => '41020',
                'name' => 'ALGECIRAS',
                'department_id' => 13,
            ),
            9 =>
            array (
                'id' => 610,
                'code' => '41026',
                'name' => 'ALTAMIRA',
                'department_id' => 13,
            ),
            10 =>
            array (
                'id' => 611,
                'code' => '41078',
                'name' => 'BARAYA',
                'department_id' => 13,
            ),
            11 =>
            array (
                'id' => 612,
                'code' => '41132',
                'name' => 'ACAMPOALEGRE',
                'department_id' => 13,
            ),
            12 =>
            array (
                'id' => 613,
                'code' => '41206',
                'name' => 'COLOMBIA',
                'department_id' => 13,
            ),
            13 =>
            array (
                'id' => 614,
                'code' => '41244',
                'name' => 'ELIAS',
                'department_id' => 13,
            ),
            14 =>
            array (
                'id' => 615,
                'code' => '41298',
                'name' => 'GARZON',
                'department_id' => 13,
            ),
            15 =>
            array (
                'id' => 616,
                'code' => '41306',
                'name' => 'GIGANTE',
                'department_id' => 13,
            ),
            16 =>
            array (
                'id' => 617,
                'code' => '41319',
                'name' => 'GUADALUPE',
                'department_id' => 13,
            ),
            17 =>
            array (
                'id' => 618,
                'code' => '41349',
                'name' => 'HOBO',
                'department_id' => 13,
            ),
            18 =>
            array (
                'id' => 619,
                'code' => '41357',
                'name' => 'IQUIRA',
                'department_id' => 13,
            ),
            19 =>
            array (
                'id' => 620,
                'code' => '41359',
                'name' => 'ISNOS',
                'department_id' => 13,
            ),
            20 =>
            array (
                'id' => 621,
                'code' => '41378',
                'name' => 'LA ARGENTINA',
                'department_id' => 13,
            ),
            21 =>
            array (
                'id' => 622,
                'code' => '41396',
                'name' => 'LA PLATA',
                'department_id' => 13,
            ),
            22 =>
            array (
                'id' => 623,
                'code' => '41483',
                'name' => 'NATAGA',
                'department_id' => 13,
            ),
            23 =>
            array (
                'id' => 624,
                'code' => '41503',
                'name' => 'OPORAPA',
                'department_id' => 13,
            ),
            24 =>
            array (
                'id' => 625,
                'code' => '41518',
                'name' => 'PAICOL',
                'department_id' => 13,
            ),
            25 =>
            array (
                'id' => 626,
                'code' => '41524',
                'name' => 'PALERMO',
                'department_id' => 13,
            ),
            26 =>
            array (
                'id' => 627,
                'code' => '41530',
                'name' => 'PALESTINA',
                'department_id' => 13,
            ),
            27 =>
            array (
                'id' => 628,
                'code' => '41548',
                'name' => 'PITAL',
                'department_id' => 13,
            ),
            28 =>
            array (
                'id' => 629,
                'code' => '41551',
                'name' => 'PITALITO',
                'department_id' => 13,
            ),
            29 =>
            array (
                'id' => 630,
                'code' => '41615',
                'name' => 'RIVERA',
                'department_id' => 13,
            ),
            30 =>
            array (
                'id' => 631,
                'code' => '41660',
                'name' => 'SALADOBLANCO',
                'department_id' => 13,
            ),
            31 =>
            array (
                'id' => 632,
                'code' => '41668',
                'name' => 'SAN AGUSTIN',
                'department_id' => 13,
            ),
            32 =>
            array (
                'id' => 633,
                'code' => '41676',
                'name' => 'santa maria',
                'department_id' => 13,
            ),
            33 =>
            array (
                'id' => 634,
                'code' => '41770',
                'name' => 'SUAZA',
                'department_id' => 13,
            ),
            34 =>
            array (
                'id' => 635,
                'code' => '41791',
                'name' => 'TARQUI',
                'department_id' => 13,
            ),
            35 =>
            array (
                'id' => 636,
                'code' => '41797',
                'name' => 'TESALIA',
                'department_id' => 13,
            ),
            36 =>
            array (
                'id' => 637,
                'code' => '41799',
                'name' => 'TELLO',
                'department_id' => 13,
            ),
            37 =>
            array (
                'id' => 638,
                'code' => '41801',
                'name' => 'TERUEL',
                'department_id' => 13,
            ),
            38 =>
            array (
                'id' => 639,
                'code' => '41807',
                'name' => 'TIMANA',
                'department_id' => 13,
            ),
            39 =>
            array (
                'id' => 640,
                'code' => '41872',
                'name' => 'VILLAVIEJA',
                'department_id' => 13,
            ),
            40 =>
            array (
                'id' => 641,
                'code' => '41885',
                'name' => 'YAGUARA',
                'department_id' => 13,
            ),
            41 =>
            array (
                'id' => 642,
                'code' => '44001',
                'name' => 'RIOHACHA',
                'department_id' => 14,
            ),
            42 =>
            array (
                'id' => 643,
                'code' => '44035',
                'name' => 'ALBANIA',
                'department_id' => 14,
            ),
            43 =>
            array (
                'id' => 644,
                'code' => '44078',
                'name' => 'BARRANCAS',
                'department_id' => 14,
            ),
            44 =>
            array (
                'id' => 645,
                'code' => '44090',
                'name' => 'DIBULLA',
                'department_id' => 14,
            ),
            45 =>
            array (
                'id' => 646,
                'code' => '44098',
                'name' => 'DISTRACCION',
                'department_id' => 14,
            ),
            46 =>
            array (
                'id' => 647,
                'code' => '44110',
                'name' => 'EL MOLINO',
                'department_id' => 14,
            ),
            47 =>
            array (
                'id' => 648,
                'code' => '44279',
                'name' => 'FONSECA',
                'department_id' => 14,
            ),
            48 =>
            array (
                'id' => 649,
                'code' => '44378',
                'name' => 'HATONUEVO',
                'department_id' => 14,
            ),
            49 =>
            array (
                'id' => 650,
                'code' => '44420',
                'name' => 'LA JAGUA DEL PILAR',
                'department_id' => 14,
            ),
            50 =>
            array (
                'id' => 651,
                'code' => '44430',
                'name' => 'MAICAO',
                'department_id' => 14,
            ),
            51 =>
            array (
                'id' => 652,
                'code' => '44560',
                'name' => 'MANAURE',
                'department_id' => 14,
            ),
            52 =>
            array (
                'id' => 653,
                'code' => '44650',
                'name' => 'SAN JUAN DEL CESAR',
                'department_id' => 14,
            ),
            53 =>
            array (
                'id' => 654,
                'code' => '44847',
                'name' => 'URIBIA',
                'department_id' => 14,
            ),
            54 =>
            array (
                'id' => 655,
                'code' => '44855',
                'name' => 'URUMITA',
                'department_id' => 14,
            ),
            55 =>
            array (
                'id' => 656,
                'code' => '44874',
                'name' => 'VILLANUEVA',
                'department_id' => 14,
            ),
            56 =>
            array (
                'id' => 657,
                'code' => '47001',
                'name' => 'SANTA MARTA',
                'department_id' => 15,
            ),
            57 =>
            array (
                'id' => 658,
                'code' => '47030',
                'name' => 'ALGARROBO',
                'department_id' => 15,
            ),
            58 =>
            array (
                'id' => 659,
                'code' => '47053',
                'name' => 'ARACATACA',
                'department_id' => 15,
            ),
            59 =>
            array (
                'id' => 660,
                'code' => '47058',
                'name' => 'ARIGUANI',
                'department_id' => 15,
            ),
            60 =>
            array (
                'id' => 661,
                'code' => '47161',
                'name' => 'CERRO SAN ANTONIO',
                'department_id' => 15,
            ),
            61 =>
            array (
                'id' => 662,
                'code' => '47170',
                'name' => 'CHIBOLO',
                'department_id' => 15,
            ),
            62 =>
            array (
                'id' => 663,
                'code' => '47189',
                'name' => 'CIENEGA',
                'department_id' => 15,
            ),
            63 =>
            array (
                'id' => 664,
                'code' => '47205',
                'name' => 'CONCORDIA',
                'department_id' => 15,
            ),
            64 =>
            array (
                'id' => 665,
                'code' => '47245',
                'name' => 'EL BANCO',
                'department_id' => 15,
            ),
            65 =>
            array (
                'id' => 666,
                'code' => '47258',
                'name' => 'EL PIÑON',
                'department_id' => 15,
            ),
            66 =>
            array (
                'id' => 667,
                'code' => '47268',
                'name' => 'EL RETEN',
                'department_id' => 15,
            ),
            67 =>
            array (
                'id' => 668,
                'code' => '47288',
                'name' => 'FUNDACION',
                'department_id' => 15,
            ),
            68 =>
            array (
                'id' => 669,
                'code' => '47318',
                'name' => 'GUAMAL',
                'department_id' => 15,
            ),
            69 =>
            array (
                'id' => 670,
                'code' => '47460',
                'name' => 'NUEVA GRANADA',
                'department_id' => 15,
            ),
            70 =>
            array (
                'id' => 671,
                'code' => '47541',
                'name' => 'PEDRAZA',
                'department_id' => 15,
            ),
            71 =>
            array (
                'id' => 672,
                'code' => '47545',
                'name' => 'PIJIÑO DEL CARMEN',
                'department_id' => 15,
            ),
            72 =>
            array (
                'id' => 673,
                'code' => '47551',
                'name' => 'PIVIJAY',
                'department_id' => 15,
            ),
            73 =>
            array (
                'id' => 674,
                'code' => '47555',
                'name' => 'PLATO',
                'department_id' => 15,
            ),
            74 =>
            array (
                'id' => 675,
                'code' => '47570',
                'name' => 'PUEBLOVIEJO',
                'department_id' => 15,
            ),
            75 =>
            array (
                'id' => 676,
                'code' => '47605',
                'name' => 'REMOLINO',
                'department_id' => 15,
            ),
            76 =>
            array (
                'id' => 677,
                'code' => '47660',
                'name' => 'SABANAS DE SAN MIGUEL',
                'department_id' => 15,
            ),
            77 =>
            array (
                'id' => 678,
                'code' => '47675',
                'name' => 'SALAMINA',
                'department_id' => 15,
            ),
            78 =>
            array (
                'id' => 679,
                'code' => '47692',
                'name' => 'SAN SEBASTIAN DE BUENA VISTA',
                'department_id' => 15,
            ),
            79 =>
            array (
                'id' => 680,
                'code' => '47703',
                'name' => 'SAN ZENON',
                'department_id' => 15,
            ),
            80 =>
            array (
                'id' => 681,
                'code' => '47707',
                'name' => 'SANTA ANA',
                'department_id' => 15,
            ),
            81 =>
            array (
                'id' => 682,
                'code' => '47720',
                'name' => 'SANTA BARBARA DE PINTO',
                'department_id' => 15,
            ),
            82 =>
            array (
                'id' => 683,
                'code' => '47745',
                'name' => 'SITIO NUEVO',
                'department_id' => 15,
            ),
            83 =>
            array (
                'id' => 684,
                'code' => '47798',
                'name' => 'TENERIFE',
                'department_id' => 15,
            ),
            84 =>
            array (
                'id' => 685,
                'code' => '47960',
                'name' => 'ZAPAYAN',
                'department_id' => 15,
            ),
            85 =>
            array (
                'id' => 686,
                'code' => '47980',
                'name' => 'ZONA BANANERA',
                'department_id' => 15,
            ),
            86 =>
            array (
                'id' => 687,
                'code' => '50001',
                'name' => 'VILLAVICENCIO',
                'department_id' => 16,
            ),
            87 =>
            array (
                'id' => 688,
                'code' => '50006',
                'name' => 'ACACIAS',
                'department_id' => 16,
            ),
            88 =>
            array (
                'id' => 689,
                'code' => '50110',
                'name' => 'BARRANCA DE UPIA',
                'department_id' => 16,
            ),
            89 =>
            array (
                'id' => 690,
                'code' => '50124',
                'name' => 'CABUYARO',
                'department_id' => 16,
            ),
            90 =>
            array (
                'id' => 691,
                'code' => '50150',
                'name' => 'CASTILLA LA NUEVA',
                'department_id' => 16,
            ),
            91 =>
            array (
                'id' => 692,
                'code' => '50223',
                'name' => 'CUBARRAL',
                'department_id' => 16,
            ),
            92 =>
            array (
                'id' => 693,
                'code' => '50226',
                'name' => 'CUMARAL',
                'department_id' => 16,
            ),
            93 =>
            array (
                'id' => 694,
                'code' => '50245',
                'name' => 'EL CALVARIO',
                'department_id' => 16,
            ),
            94 =>
            array (
                'id' => 695,
                'code' => '50251',
                'name' => 'EL CASTILLO',
                'department_id' => 16,
            ),
            95 =>
            array (
                'id' => 696,
                'code' => '50270',
                'name' => 'EL DORADO',
                'department_id' => 16,
            ),
            96 =>
            array (
                'id' => 697,
                'code' => '50287',
                'name' => 'FUENTE DE ORO',
                'department_id' => 16,
            ),
            97 =>
            array (
                'id' => 698,
                'code' => '50313',
                'name' => 'GRANADA',
                'department_id' => 16,
            ),
            98 =>
            array (
                'id' => 699,
                'code' => '50318',
                'name' => 'GUAMAL',
                'department_id' => 16,
            ),
            99 =>
            array (
                'id' => 700,
                'code' => '50325',
                'name' => 'MAPIRIPAN',
                'department_id' => 16,
            ),
            100 =>
            array (
                'id' => 701,
                'code' => '50330',
                'name' => 'MESETAS',
                'department_id' => 16,
            ),
            101 =>
            array (
                'id' => 702,
                'code' => '50350',
                'name' => 'LA MACARENA',
                'department_id' => 16,
            ),
            102 =>
            array (
                'id' => 703,
                'code' => '50370',
                'name' => 'URIBE',
                'department_id' => 16,
            ),
            103 =>
            array (
                'id' => 704,
                'code' => '50400',
                'name' => 'LEJANIAS',
                'department_id' => 16,
            ),
            104 =>
            array (
                'id' => 705,
                'code' => '50450',
                'name' => 'PUERTO CONCORDIA',
                'department_id' => 16,
            ),
            105 =>
            array (
                'id' => 706,
                'code' => '50568',
                'name' => 'PUERTO GAITAN',
                'department_id' => 16,
            ),
            106 =>
            array (
                'id' => 707,
                'code' => '50573',
                'name' => 'PUERTO LOPEZ',
                'department_id' => 16,
            ),
            107 =>
            array (
                'id' => 708,
                'code' => '50577',
                'name' => 'PUERTO LLERAS',
                'department_id' => 16,
            ),
            108 =>
            array (
                'id' => 709,
                'code' => '50590',
                'name' => 'PUERTO RICO',
                'department_id' => 16,
            ),
            109 =>
            array (
                'id' => 710,
                'code' => '50606',
                'name' => 'RESTREPO',
                'department_id' => 16,
            ),
            110 =>
            array (
                'id' => 711,
                'code' => '50680',
                'name' => 'SAN CARLOS DE GUAROA',
                'department_id' => 16,
            ),
            111 =>
            array (
                'id' => 712,
                'code' => '50683',
                'name' => 'SAN JUAN DE ARAMA',
                'department_id' => 16,
            ),
            112 =>
            array (
                'id' => 713,
                'code' => '50686',
                'name' => 'SAN JUANITO',
                'department_id' => 16,
            ),
            113 =>
            array (
                'id' => 714,
                'code' => '50689',
                'name' => 'SAN MARTIN DE LLANOS',
                'department_id' => 16,
            ),
            114 =>
            array (
                'id' => 715,
                'code' => '50711',
                'name' => 'VISTA HERMOSA',
                'department_id' => 16,
            ),
            115 =>
            array (
                'id' => 716,
                'code' => '52001',
                'name' => 'PASTO',
                'department_id' => 17,
            ),
            116 =>
            array (
                'id' => 717,
                'code' => '52019',
                'name' => 'ALBAN',
                'department_id' => 17,
            ),
            117 =>
            array (
                'id' => 718,
                'code' => '52022',
                'name' => 'ALDANA',
                'department_id' => 17,
            ),
            118 =>
            array (
                'id' => 719,
                'code' => '52036',
                'name' => 'ANCUYA',
                'department_id' => 17,
            ),
            119 =>
            array (
                'id' => 720,
                'code' => '52051',
                'name' => 'ARBOLEDA',
                'department_id' => 17,
            ),
            120 =>
            array (
                'id' => 721,
                'code' => '52079',
                'name' => 'BARBACOAS',
                'department_id' => 17,
            ),
            121 =>
            array (
                'id' => 722,
                'code' => '52083',
                'name' => 'BELEN',
                'department_id' => 17,
            ),
            122 =>
            array (
                'id' => 723,
                'code' => '52110',
                'name' => 'BUESACO',
                'department_id' => 17,
            ),
            123 =>
            array (
                'id' => 724,
                'code' => '52203',
                'name' => 'COLON',
                'department_id' => 17,
            ),
            124 =>
            array (
                'id' => 725,
                'code' => '52207',
                'name' => 'CONNSACA',
                'department_id' => 17,
            ),
            125 =>
            array (
                'id' => 726,
                'code' => '52210',
                'name' => 'CONTADERO',
                'department_id' => 17,
            ),
            126 =>
            array (
                'id' => 727,
                'code' => '52215',
                'name' => 'CORDOBA',
                'department_id' => 17,
            ),
            127 =>
            array (
                'id' => 728,
                'code' => '52224',
                'name' => 'CUASPUD',
                'department_id' => 17,
            ),
            128 =>
            array (
                'id' => 729,
                'code' => '52227',
                'name' => 'CUMBAL',
                'department_id' => 17,
            ),
            129 =>
            array (
                'id' => 730,
                'code' => '52233',
                'name' => 'CUMBITARA',
                'department_id' => 17,
            ),
            130 =>
            array (
                'id' => 731,
                'code' => '52240',
                'name' => 'CHACHAGUI',
                'department_id' => 17,
            ),
            131 =>
            array (
                'id' => 732,
                'code' => '52250',
                'name' => 'EL CHARCO',
                'department_id' => 17,
            ),
            132 =>
            array (
                'id' => 733,
                'code' => '52254',
                'name' => 'EL PEÑOL',
                'department_id' => 17,
            ),
            133 =>
            array (
                'id' => 734,
                'code' => '52256',
                'name' => 'EL ROSARIO',
                'department_id' => 17,
            ),
            134 =>
            array (
                'id' => 735,
                'code' => '52258',
                'name' => 'EL TABLON DE GOMEZ',
                'department_id' => 17,
            ),
            135 =>
            array (
                'id' => 736,
                'code' => '52260',
                'name' => 'EL TAMBO',
                'department_id' => 17,
            ),
            136 =>
            array (
                'id' => 737,
                'code' => '52287',
                'name' => 'FUNES',
                'department_id' => 17,
            ),
            137 =>
            array (
                'id' => 738,
                'code' => '52317',
                'name' => 'GUACHUCAL',
                'department_id' => 17,
            ),
            138 =>
            array (
                'id' => 739,
                'code' => '52320',
                'name' => 'GUAITARILLA',
                'department_id' => 17,
            ),
            139 =>
            array (
                'id' => 740,
                'code' => '52323',
                'name' => 'GUALMATAN',
                'department_id' => 17,
            ),
            140 =>
            array (
                'id' => 741,
                'code' => '52352',
                'name' => 'ILES',
                'department_id' => 17,
            ),
            141 =>
            array (
                'id' => 742,
                'code' => '52354',
                'name' => 'IMUES',
                'department_id' => 17,
            ),
            142 =>
            array (
                'id' => 743,
                'code' => '52356',
                'name' => 'IPIALES',
                'department_id' => 17,
            ),
            143 =>
            array (
                'id' => 744,
                'code' => '52378',
                'name' => 'LA CRUZ',
                'department_id' => 17,
            ),
            144 =>
            array (
                'id' => 745,
                'code' => '52381',
                'name' => 'LA FLORIDA',
                'department_id' => 17,
            ),
            145 =>
            array (
                'id' => 746,
                'code' => '52385',
                'name' => 'LA LLANADA',
                'department_id' => 17,
            ),
            146 =>
            array (
                'id' => 747,
                'code' => '52390',
                'name' => 'LA TOLA',
                'department_id' => 17,
            ),
            147 =>
            array (
                'id' => 748,
                'code' => '52399',
                'name' => 'LA UNION',
                'department_id' => 17,
            ),
            148 =>
            array (
                'id' => 749,
                'code' => '52405',
                'name' => 'LEIVA',
                'department_id' => 17,
            ),
            149 =>
            array (
                'id' => 750,
                'code' => '52411',
                'name' => 'LINARES',
                'department_id' => 17,
            ),
            150 =>
            array (
                'id' => 751,
                'code' => '52418',
                'name' => 'LOS ANDES',
                'department_id' => 17,
            ),
            151 =>
            array (
                'id' => 752,
                'code' => '52427',
                'name' => 'MAGUI',
                'department_id' => 17,
            ),
            152 =>
            array (
                'id' => 753,
                'code' => '52435',
                'name' => 'MALLAMA',
                'department_id' => 17,
            ),
            153 =>
            array (
                'id' => 754,
                'code' => '52473',
                'name' => 'MOSQUERA',
                'department_id' => 17,
            ),
            154 =>
            array (
                'id' => 755,
                'code' => '52480',
                'name' => 'NARIÑO',
                'department_id' => 17,
            ),
            155 =>
            array (
                'id' => 756,
                'code' => '52490',
                'name' => 'OLAYA HERRERA',
                'department_id' => 17,
            ),
            156 =>
            array (
                'id' => 757,
                'code' => '52506',
                'name' => 'OSPINA',
                'department_id' => 17,
            ),
            157 =>
            array (
                'id' => 758,
                'code' => '52520',
                'name' => 'FRANCISCO PIZARRO',
                'department_id' => 17,
            ),
            158 =>
            array (
                'id' => 759,
                'code' => '52540',
                'name' => 'POLICARPA',
                'department_id' => 17,
            ),
            159 =>
            array (
                'id' => 760,
                'code' => '52560',
                'name' => 'POTOSI',
                'department_id' => 17,
            ),
            160 =>
            array (
                'id' => 761,
                'code' => '52565',
                'name' => 'PROVIDENCIA',
                'department_id' => 17,
            ),
            161 =>
            array (
                'id' => 762,
                'code' => '52573',
                'name' => 'PUERRES',
                'department_id' => 17,
            ),
            162 =>
            array (
                'id' => 763,
                'code' => '52585',
                'name' => 'PUPIALES',
                'department_id' => 17,
            ),
            163 =>
            array (
                'id' => 764,
                'code' => '52612',
                'name' => 'RICAURTE',
                'department_id' => 17,
            ),
            164 =>
            array (
                'id' => 765,
                'code' => '52621',
                'name' => 'ROBERTO PAYAN',
                'department_id' => 17,
            ),
            165 =>
            array (
                'id' => 766,
                'code' => '52678',
                'name' => 'SAMANIEGO',
                'department_id' => 17,
            ),
            166 =>
            array (
                'id' => 767,
                'code' => '52683',
                'name' => 'SANDONA',
                'department_id' => 17,
            ),
            167 =>
            array (
                'id' => 768,
                'code' => '52685',
                'name' => 'SAN BERNARDO',
                'department_id' => 17,
            ),
            168 =>
            array (
                'id' => 769,
                'code' => '52687',
                'name' => 'SAN LORENZO',
                'department_id' => 17,
            ),
            169 =>
            array (
                'id' => 770,
                'code' => '52693',
                'name' => 'SAN PABLO',
                'department_id' => 17,
            ),
            170 =>
            array (
                'id' => 771,
                'code' => '52694',
                'name' => 'SAN PEDRO DE CARTAGO',
                'department_id' => 17,
            ),
            171 =>
            array (
                'id' => 772,
                'code' => '52696',
                'name' => 'SANTA BARBARA',
                'department_id' => 17,
            ),
            172 =>
            array (
                'id' => 773,
                'code' => '52699',
                'name' => 'SANTACRUZ',
                'department_id' => 17,
            ),
            173 =>
            array (
                'id' => 774,
                'code' => '52720',
                'name' => 'SAPUYES',
                'department_id' => 17,
            ),
            174 =>
            array (
                'id' => 775,
                'code' => '52786',
                'name' => 'TAMINANGO',
                'department_id' => 17,
            ),
            175 =>
            array (
                'id' => 776,
                'code' => '52788',
                'name' => 'TANGUA',
                'department_id' => 17,
            ),
            176 =>
            array (
                'id' => 777,
                'code' => '52835',
                'name' => 'SAN ANDRES DE TUMACO',
                'department_id' => 17,
            ),
            177 =>
            array (
                'id' => 778,
                'code' => '52838',
                'name' => 'TUQUERRES',
                'department_id' => 17,
            ),
            178 =>
            array (
                'id' => 779,
                'code' => '52885',
                'name' => 'YACUANQUER',
                'department_id' => 17,
            ),
            179 =>
            array (
                'id' => 780,
                'code' => '54001',
                'name' => 'CUCUTA',
                'department_id' => 18,
            ),
            180 =>
            array (
                'id' => 781,
                'code' => '54003',
                'name' => 'ABREGO',
                'department_id' => 18,
            ),
            181 =>
            array (
                'id' => 782,
                'code' => '54051',
                'name' => 'ARBOLEDAS',
                'department_id' => 18,
            ),
            182 =>
            array (
                'id' => 783,
                'code' => '54099',
                'name' => 'BOCHALEMA',
                'department_id' => 18,
            ),
            183 =>
            array (
                'id' => 784,
                'code' => '54109',
                'name' => 'BUCARASICA',
                'department_id' => 18,
            ),
            184 =>
            array (
                'id' => 785,
                'code' => '54125',
                'name' => 'CACOTA DE VELAZCO',
                'department_id' => 18,
            ),
            185 =>
            array (
                'id' => 786,
                'code' => '54128',
                'name' => 'CACHIRA',
                'department_id' => 18,
            ),
            186 =>
            array (
                'id' => 787,
                'code' => '54172',
                'name' => 'CHINACOTA',
                'department_id' => 18,
            ),
            187 =>
            array (
                'id' => 788,
                'code' => '54174',
                'name' => 'CHITAGA',
                'department_id' => 18,
            ),
            188 =>
            array (
                'id' => 789,
                'code' => '54206',
                'name' => 'CONVENCION',
                'department_id' => 18,
            ),
            189 =>
            array (
                'id' => 790,
                'code' => '54223',
                'name' => 'CUCUTILLA',
                'department_id' => 18,
            ),
            190 =>
            array (
                'id' => 791,
                'code' => '54239',
                'name' => 'DURANIA',
                'department_id' => 18,
            ),
            191 =>
            array (
                'id' => 792,
                'code' => '54245',
                'name' => 'EL CARMEN',
                'department_id' => 18,
            ),
            192 =>
            array (
                'id' => 793,
                'code' => '54250',
                'name' => 'EL TARRA',
                'department_id' => 18,
            ),
            193 =>
            array (
                'id' => 794,
                'code' => '54261',
                'name' => 'EL ZULIA',
                'department_id' => 18,
            ),
            194 =>
            array (
                'id' => 795,
                'code' => '54313',
                'name' => 'GRAMALOTE',
                'department_id' => 18,
            ),
            195 =>
            array (
                'id' => 796,
                'code' => '54344',
                'name' => 'HACARI',
                'department_id' => 18,
            ),
            196 =>
            array (
                'id' => 797,
                'code' => '54347',
                'name' => 'HERRAN',
                'department_id' => 18,
            ),
            197 =>
            array (
                'id' => 798,
                'code' => '54377',
                'name' => 'LABATECA',
                'department_id' => 18,
            ),
            198 =>
            array (
                'id' => 799,
                'code' => '54385',
                'name' => 'LA ESPERANZA',
                'department_id' => 18,
            ),
            199 =>
            array (
                'id' => 800,
                'code' => '54398',
                'name' => 'LA PLAYA DE BELEN',
                'department_id' => 18,
            ),
        ));
        DB::table('municipalities')->insert(array (
            0 =>
            array (
                'id' => 801,
                'code' => '54405',
                'name' => 'LOS PATIOS',
                'department_id' => 18,
            ),
            1 =>
            array (
                'id' => 802,
                'code' => '54418',
                'name' => 'LOURDES',
                'department_id' => 18,
            ),
            2 =>
            array (
                'id' => 803,
                'code' => '54480',
                'name' => 'MUTISCUA',
                'department_id' => 18,
            ),
            3 =>
            array (
                'id' => 804,
                'code' => '54498',
                'name' => 'OCAÑA',
                'department_id' => 18,
            ),
            4 =>
            array (
                'id' => 805,
                'code' => '54518',
                'name' => 'PAMPLONA',
                'department_id' => 18,
            ),
            5 =>
            array (
                'id' => 806,
                'code' => '54520',
                'name' => 'PAMPLONITA',
                'department_id' => 18,
            ),
            6 =>
            array (
                'id' => 807,
                'code' => '54553',
                'name' => 'PUERTO SANTANDER',
                'department_id' => 18,
            ),
            7 =>
            array (
                'id' => 808,
                'code' => '54599',
                'name' => 'RAGONVALIA',
                'department_id' => 18,
            ),
            8 =>
            array (
                'id' => 809,
                'code' => '54660',
                'name' => 'SALAZAR DE LAS PALMAS',
                'department_id' => 18,
            ),
            9 =>
            array (
                'id' => 810,
                'code' => '54670',
                'name' => 'SAN CALIXTO',
                'department_id' => 18,
            ),
            10 =>
            array (
                'id' => 811,
                'code' => '54673',
                'name' => 'SAN CAYETANO',
                'department_id' => 18,
            ),
            11 =>
            array (
                'id' => 812,
                'code' => '54680',
                'name' => 'SANTIAGO',
                'department_id' => 18,
            ),
            12 =>
            array (
                'id' => 813,
                'code' => '54720',
                'name' => 'SARDINATA',
                'department_id' => 18,
            ),
            13 =>
            array (
                'id' => 814,
                'code' => '54743',
                'name' => 'SANTO DOMINDO DE SILOS',
                'department_id' => 18,
            ),
            14 =>
            array (
                'id' => 815,
                'code' => '54800',
                'name' => 'TEORAMA',
                'department_id' => 18,
            ),
            15 =>
            array (
                'id' => 816,
                'code' => '54810',
                'name' => 'TIBU',
                'department_id' => 18,
            ),
            16 =>
            array (
                'id' => 817,
                'code' => '54820',
                'name' => 'TOLEDO',
                'department_id' => 18,
            ),
            17 =>
            array (
                'id' => 818,
                'code' => '54871',
                'name' => 'VILLA CARO',
                'department_id' => 18,
            ),
            18 =>
            array (
                'id' => 819,
                'code' => '54874',
                'name' => 'VILLA DEL ROSARIO',
                'department_id' => 18,
            ),
            19 =>
            array (
                'id' => 820,
                'code' => '63001',
                'name' => 'ARMENIA',
                'department_id' => 19,
            ),
            20 =>
            array (
                'id' => 821,
                'code' => '63111',
                'name' => 'BUENAVISTA',
                'department_id' => 19,
            ),
            21 =>
            array (
                'id' => 822,
                'code' => '63130',
                'name' => 'CALARCA',
                'department_id' => 19,
            ),
            22 =>
            array (
                'id' => 823,
                'code' => '63190',
                'name' => 'CIRCASIA',
                'department_id' => 19,
            ),
            23 =>
            array (
                'id' => 824,
                'code' => '63212',
                'name' => 'CORDOBA',
                'department_id' => 19,
            ),
            24 =>
            array (
                'id' => 825,
                'code' => '63272',
                'name' => 'FILANDIA',
                'department_id' => 19,
            ),
            25 =>
            array (
                'id' => 826,
                'code' => '63302',
                'name' => 'GENOVA',
                'department_id' => 19,
            ),
            26 =>
            array (
                'id' => 827,
                'code' => '63401',
                'name' => 'LA TEBAIDA',
                'department_id' => 19,
            ),
            27 =>
            array (
                'id' => 828,
                'code' => '63470',
                'name' => 'MONTENEGRO',
                'department_id' => 19,
            ),
            28 =>
            array (
                'id' => 829,
                'code' => '63548',
                'name' => 'PIJAO',
                'department_id' => 19,
            ),
            29 =>
            array (
                'id' => 830,
                'code' => '63594',
                'name' => 'QUIMBAYA',
                'department_id' => 19,
            ),
            30 =>
            array (
                'id' => 831,
                'code' => '63690',
                'name' => 'SALENTO',
                'department_id' => 19,
            ),
            31 =>
            array (
                'id' => 832,
                'code' => '66001',
                'name' => 'PEREIRA',
                'department_id' => 20,
            ),
            32 =>
            array (
                'id' => 833,
                'code' => '66045',
                'name' => 'APIA',
                'department_id' => 20,
            ),
            33 =>
            array (
                'id' => 834,
                'code' => '66075',
                'name' => 'BALBOA',
                'department_id' => 20,
            ),
            34 =>
            array (
                'id' => 835,
                'code' => '66088',
                'name' => 'BELEN DE UMBRIA',
                'department_id' => 20,
            ),
            35 =>
            array (
                'id' => 836,
                'code' => '66170',
                'name' => 'DOSQUEBRADAS',
                'department_id' => 20,
            ),
            36 =>
            array (
                'id' => 837,
                'code' => '66318',
                'name' => 'GUATICA',
                'department_id' => 20,
            ),
            37 =>
            array (
                'id' => 838,
                'code' => '66383',
                'name' => 'LA CELIA',
                'department_id' => 20,
            ),
            38 =>
            array (
                'id' => 839,
                'code' => '66400',
                'name' => 'LA VIRGINIA',
                'department_id' => 20,
            ),
            39 =>
            array (
                'id' => 840,
                'code' => '66440',
                'name' => 'MARSELLA',
                'department_id' => 20,
            ),
            40 =>
            array (
                'id' => 841,
                'code' => '66456',
                'name' => 'MISTRATO',
                'department_id' => 20,
            ),
            41 =>
            array (
                'id' => 842,
                'code' => '66572',
                'name' => 'PUEBLO RICO',
                'department_id' => 20,
            ),
            42 =>
            array (
                'id' => 843,
                'code' => '66594',
                'name' => 'QUINCHIA',
                'department_id' => 20,
            ),
            43 =>
            array (
                'id' => 844,
                'code' => '66682',
                'name' => 'SANTA ROSA DE CABAL',
                'department_id' => 20,
            ),
            44 =>
            array (
                'id' => 845,
                'code' => '66687',
                'name' => 'SANTUARIO',
                'department_id' => 20,
            ),
            45 =>
            array (
                'id' => 846,
                'code' => '68001',
                'name' => 'BUCARAMANGA',
                'department_id' => 21,
            ),
            46 =>
            array (
                'id' => 847,
                'code' => '68013',
                'name' => 'AGUADA',
                'department_id' => 21,
            ),
            47 =>
            array (
                'id' => 848,
                'code' => '68020',
                'name' => 'ALBANIA',
                'department_id' => 21,
            ),
            48 =>
            array (
                'id' => 849,
                'code' => '68051',
                'name' => 'ARATOCA',
                'department_id' => 21,
            ),
            49 =>
            array (
                'id' => 850,
                'code' => '68077',
                'name' => 'BARBOSA',
                'department_id' => 21,
            ),
            50 =>
            array (
                'id' => 851,
                'code' => '68079',
                'name' => 'BARICHARA',
                'department_id' => 21,
            ),
            51 =>
            array (
                'id' => 852,
                'code' => '68081',
                'name' => 'BARRANCABERMEJA',
                'department_id' => 21,
            ),
            52 =>
            array (
                'id' => 853,
                'code' => '68092',
                'name' => 'BETULIA',
                'department_id' => 21,
            ),
            53 =>
            array (
                'id' => 854,
                'code' => '68101',
                'name' => 'BOLIVAR',
                'department_id' => 21,
            ),
            54 =>
            array (
                'id' => 855,
                'code' => '68121',
                'name' => 'CABRERA',
                'department_id' => 21,
            ),
            55 =>
            array (
                'id' => 856,
                'code' => '68132',
                'name' => 'CALIFORNIA',
                'department_id' => 21,
            ),
            56 =>
            array (
                'id' => 857,
                'code' => '68147',
                'name' => 'CAPITANEJO',
                'department_id' => 21,
            ),
            57 =>
            array (
                'id' => 858,
                'code' => '68152',
                'name' => 'CARCASI',
                'department_id' => 21,
            ),
            58 =>
            array (
                'id' => 859,
                'code' => '68160',
                'name' => 'CEPITA',
                'department_id' => 21,
            ),
            59 =>
            array (
                'id' => 860,
                'code' => '68162',
                'name' => 'CERRITO',
                'department_id' => 21,
            ),
            60 =>
            array (
                'id' => 861,
                'code' => '68167',
                'name' => 'CHARALA',
                'department_id' => 21,
            ),
            61 =>
            array (
                'id' => 862,
                'code' => '68169',
                'name' => 'CHARTA',
                'department_id' => 21,
            ),
            62 =>
            array (
                'id' => 863,
                'code' => '68176',
                'name' => 'CHIMA',
                'department_id' => 21,
            ),
            63 =>
            array (
                'id' => 864,
                'code' => '68179',
                'name' => 'CHIPATA',
                'department_id' => 21,
            ),
            64 =>
            array (
                'id' => 865,
                'code' => '68001',
                'name' => 'CIMITARRA',
                'department_id' => 21,
            ),
            65 =>
            array (
                'id' => 866,
                'code' => '68207',
                'name' => 'CONCEPCION',
                'department_id' => 21,
            ),
            66 =>
            array (
                'id' => 867,
                'code' => '68209',
                'name' => 'CONFINES',
                'department_id' => 21,
            ),
            67 =>
            array (
                'id' => 868,
                'code' => '68211',
                'name' => 'CONTRATACION',
                'department_id' => 21,
            ),
            68 =>
            array (
                'id' => 869,
                'code' => '68217',
                'name' => 'COROMORO',
                'department_id' => 21,
            ),
            69 =>
            array (
                'id' => 870,
                'code' => '68229',
                'name' => 'CURITI',
                'department_id' => 21,
            ),
            70 =>
            array (
                'id' => 871,
                'code' => '68235',
                'name' => 'EL CARMEN DE CHUCURI',
                'department_id' => 21,
            ),
            71 =>
            array (
                'id' => 872,
                'code' => '68245',
                'name' => 'EL GUACAMAYO',
                'department_id' => 21,
            ),
            72 =>
            array (
                'id' => 873,
                'code' => '68250',
                'name' => 'EL PEÑON',
                'department_id' => 21,
            ),
            73 =>
            array (
                'id' => 874,
                'code' => '68255',
                'name' => 'EL PLAYON',
                'department_id' => 21,
            ),
            74 =>
            array (
                'id' => 875,
                'code' => '68264',
                'name' => 'ENCINO',
                'department_id' => 21,
            ),
            75 =>
            array (
                'id' => 876,
                'code' => '68266',
                'name' => 'ENCISO',
                'department_id' => 21,
            ),
            76 =>
            array (
                'id' => 877,
                'code' => '68271',
                'name' => 'FLORIAN',
                'department_id' => 21,
            ),
            77 =>
            array (
                'id' => 878,
                'code' => '68276',
                'name' => 'FLORIDABLANCA',
                'department_id' => 21,
            ),
            78 =>
            array (
                'id' => 879,
                'code' => '68296',
                'name' => 'GALAN',
                'department_id' => 21,
            ),
            79 =>
            array (
                'id' => 880,
                'code' => '68298',
                'name' => 'GAMBITA',
                'department_id' => 21,
            ),
            80 =>
            array (
                'id' => 881,
                'code' => '68307',
                'name' => 'GIRON',
                'department_id' => 21,
            ),
            81 =>
            array (
                'id' => 882,
                'code' => '68318',
                'name' => 'GUACA',
                'department_id' => 21,
            ),
            82 =>
            array (
                'id' => 883,
                'code' => '68320',
                'name' => 'GUADALUPE',
                'department_id' => 21,
            ),
            83 =>
            array (
                'id' => 884,
                'code' => '68322',
                'name' => 'GUAPOTA',
                'department_id' => 21,
            ),
            84 =>
            array (
                'id' => 885,
                'code' => '68324',
                'name' => 'GUAVATA',
                'department_id' => 21,
            ),
            85 =>
            array (
                'id' => 886,
                'code' => '68327',
                'name' => 'GUEPSA',
                'department_id' => 21,
            ),
            86 =>
            array (
                'id' => 887,
                'code' => '68344',
                'name' => 'HATO',
                'department_id' => 21,
            ),
            87 =>
            array (
                'id' => 888,
                'code' => '68368',
                'name' => 'JESUS MARIA',
                'department_id' => 21,
            ),
            88 =>
            array (
                'id' => 889,
                'code' => '68370',
                'name' => 'JORDAN',
                'department_id' => 21,
            ),
            89 =>
            array (
                'id' => 890,
                'code' => '68377',
                'name' => 'LA BELLEZA',
                'department_id' => 21,
            ),
            90 =>
            array (
                'id' => 891,
                'code' => '68385',
                'name' => 'LANDAZURI',
                'department_id' => 21,
            ),
            91 =>
            array (
                'id' => 892,
                'code' => '68397',
                'name' => 'LA PAZ',
                'department_id' => 21,
            ),
            92 =>
            array (
                'id' => 893,
                'code' => '68406',
                'name' => 'LEBRIJA',
                'department_id' => 21,
            ),
            93 =>
            array (
                'id' => 894,
                'code' => '68418',
                'name' => 'LOS SANTOS',
                'department_id' => 21,
            ),
            94 =>
            array (
                'id' => 895,
                'code' => '68425',
                'name' => 'MACARAVITA',
                'department_id' => 21,
            ),
            95 =>
            array (
                'id' => 896,
                'code' => '68432',
                'name' => 'MALAGA',
                'department_id' => 21,
            ),
            96 =>
            array (
                'id' => 897,
                'code' => '68444',
                'name' => 'MATANZA',
                'department_id' => 21,
            ),
            97 =>
            array (
                'id' => 898,
                'code' => '68464',
                'name' => 'MOGOTES',
                'department_id' => 21,
            ),
            98 =>
            array (
                'id' => 899,
                'code' => '68468',
                'name' => 'MOLAGAVITA',
                'department_id' => 21,
            ),
            99 =>
            array (
                'id' => 900,
                'code' => '68498',
                'name' => 'OCAMONTE',
                'department_id' => 21,
            ),
            100 =>
            array (
                'id' => 901,
                'code' => '68500',
                'name' => 'OIBA',
                'department_id' => 21,
            ),
            101 =>
            array (
                'id' => 902,
                'code' => '68502',
                'name' => 'ONZAGA',
                'department_id' => 21,
            ),
            102 =>
            array (
                'id' => 903,
                'code' => '68522',
                'name' => 'PALMAR',
                'department_id' => 21,
            ),
            103 =>
            array (
                'id' => 904,
                'code' => '68524',
                'name' => 'PALMAS DEL SOCORRO',
                'department_id' => 21,
            ),
            104 =>
            array (
                'id' => 905,
                'code' => '68533',
                'name' => 'PARAMO',
                'department_id' => 21,
            ),
            105 =>
            array (
                'id' => 906,
                'code' => '68547',
                'name' => 'PIEDECUESTA',
                'department_id' => 21,
            ),
            106 =>
            array (
                'id' => 907,
                'code' => '68549',
                'name' => 'PINCHOTE',
                'department_id' => 21,
            ),
            107 =>
            array (
                'id' => 908,
                'code' => '68572',
                'name' => 'PUENTE NACIONAL',
                'department_id' => 21,
            ),
            108 =>
            array (
                'id' => 909,
                'code' => '68573',
                'name' => 'PUERTO PARRA',
                'department_id' => 21,
            ),
            109 =>
            array (
                'id' => 910,
                'code' => '68575',
                'name' => 'PUERTO WILCHES',
                'department_id' => 21,
            ),
            110 =>
            array (
                'id' => 911,
                'code' => '68615',
                'name' => 'RIONEGRO',
                'department_id' => 21,
            ),
            111 =>
            array (
                'id' => 912,
                'code' => '68655',
                'name' => 'SABANA DE TORRES',
                'department_id' => 21,
            ),
            112 =>
            array (
                'id' => 913,
                'code' => '68669',
                'name' => 'SAN ANDRES',
                'department_id' => 21,
            ),
            113 =>
            array (
                'id' => 914,
                'code' => '68673',
                'name' => 'SAN BENITO',
                'department_id' => 21,
            ),
            114 =>
            array (
                'id' => 915,
                'code' => '68679',
                'name' => 'SAN GIL',
                'department_id' => 21,
            ),
            115 =>
            array (
                'id' => 916,
                'code' => '68682',
                'name' => 'SAN JOAQUIN',
                'department_id' => 21,
            ),
            116 =>
            array (
                'id' => 917,
                'code' => '68684',
                'name' => 'SAN JOSE DE MIRANDA',
                'department_id' => 21,
            ),
            117 =>
            array (
                'id' => 918,
                'code' => '68686',
                'name' => 'SAN MIGUEL',
                'department_id' => 21,
            ),
            118 =>
            array (
                'id' => 919,
                'code' => '68689',
                'name' => 'SAN VICENTE DE CHUCURI',
                'department_id' => 21,
            ),
            119 =>
            array (
                'id' => 920,
                'code' => '68705',
                'name' => 'SANTA BARBARA',
                'department_id' => 21,
            ),
            120 =>
            array (
                'id' => 921,
                'code' => '68720',
                'name' => 'SANTA HELENA DEL OPON',
                'department_id' => 21,
            ),
            121 =>
            array (
                'id' => 922,
                'code' => '68745',
                'name' => 'SIMACOTA',
                'department_id' => 21,
            ),
            122 =>
            array (
                'id' => 923,
                'code' => '68755',
                'name' => 'SOCORRO',
                'department_id' => 21,
            ),
            123 =>
            array (
                'id' => 924,
                'code' => '68770',
                'name' => 'SUAITA',
                'department_id' => 21,
            ),
            124 =>
            array (
                'id' => 925,
                'code' => '68773',
                'name' => 'SUCRE',
                'department_id' => 21,
            ),
            125 =>
            array (
                'id' => 926,
                'code' => '68780',
                'name' => 'SURATA',
                'department_id' => 21,
            ),
            126 =>
            array (
                'id' => 927,
                'code' => '68820',
                'name' => 'TONA',
                'department_id' => 21,
            ),
            127 =>
            array (
                'id' => 928,
                'code' => '68855',
                'name' => 'VALLE DE SAN JOSE',
                'department_id' => 21,
            ),
            128 =>
            array (
                'id' => 929,
                'code' => '68861',
                'name' => 'VELEZ',
                'department_id' => 21,
            ),
            129 =>
            array (
                'id' => 930,
                'code' => '68867',
                'name' => 'VETAS',
                'department_id' => 21,
            ),
            130 =>
            array (
                'id' => 931,
                'code' => '68872',
                'name' => 'VILLANUEVA',
                'department_id' => 21,
            ),
            131 =>
            array (
                'id' => 932,
                'code' => '68895',
                'name' => 'ZAPATOCA',
                'department_id' => 21,
            ),
            132 =>
            array (
                'id' => 933,
                'code' => '70001',
                'name' => 'SINCELEJO',
                'department_id' => 22,
            ),
            133 =>
            array (
                'id' => 934,
                'code' => '70110',
                'name' => 'BUENAVISTA',
                'department_id' => 22,
            ),
            134 =>
            array (
                'id' => 935,
                'code' => '70124',
                'name' => 'CAIMITO',
                'department_id' => 22,
            ),
            135 =>
            array (
                'id' => 936,
                'code' => '70204',
                'name' => 'COLOSO',
                'department_id' => 22,
            ),
            136 =>
            array (
                'id' => 937,
                'code' => '70215',
                'name' => 'COROZAL',
                'department_id' => 22,
            ),
            137 =>
            array (
                'id' => 938,
                'code' => '70221',
                'name' => 'COVEÑAS',
                'department_id' => 22,
            ),
            138 =>
            array (
                'id' => 939,
                'code' => '70230',
                'name' => 'CHALAN',
                'department_id' => 22,
            ),
            139 =>
            array (
                'id' => 940,
                'code' => '70233',
                'name' => 'EL ROBLE',
                'department_id' => 22,
            ),
            140 =>
            array (
                'id' => 941,
                'code' => '70235',
                'name' => 'GALERAS',
                'department_id' => 22,
            ),
            141 =>
            array (
                'id' => 942,
                'code' => '70265',
                'name' => 'GUARANDA',
                'department_id' => 22,
            ),
            142 =>
            array (
                'id' => 943,
                'code' => '70400',
                'name' => 'LA UNION',
                'department_id' => 22,
            ),
            143 =>
            array (
                'id' => 944,
                'code' => '70418',
                'name' => 'LOS PALMITOS',
                'department_id' => 22,
            ),
            144 =>
            array (
                'id' => 945,
                'code' => '70429',
                'name' => 'MAJAGUAL',
                'department_id' => 22,
            ),
            145 =>
            array (
                'id' => 946,
                'code' => '70473',
                'name' => 'MORROA',
                'department_id' => 22,
            ),
            146 =>
            array (
                'id' => 947,
                'code' => '70508',
                'name' => 'OVEJAS',
                'department_id' => 22,
            ),
            147 =>
            array (
                'id' => 948,
                'code' => '70523',
                'name' => 'PALMITO',
                'department_id' => 22,
            ),
            148 =>
            array (
                'id' => 949,
                'code' => '70670',
                'name' => 'SAMPUES',
                'department_id' => 22,
            ),
            149 =>
            array (
                'id' => 950,
                'code' => '70678',
                'name' => 'SAN BENITO ABAD',
                'department_id' => 22,
            ),
            150 =>
            array (
                'id' => 951,
                'code' => '70702',
                'name' => 'SAN JUAN DE BETULIA',
                'department_id' => 22,
            ),
            151 =>
            array (
                'id' => 952,
                'code' => '70708',
                'name' => 'SAN MARCOS',
                'department_id' => 22,
            ),
            152 =>
            array (
                'id' => 953,
                'code' => '70713',
                'name' => 'SAN ONOFRE',
                'department_id' => 22,
            ),
            153 =>
            array (
                'id' => 954,
                'code' => '70717',
                'name' => 'SAN PEDRO',
                'department_id' => 22,
            ),
            154 =>
            array (
                'id' => 955,
                'code' => '70742',
                'name' => 'SAN LUIS DE SINCE',
                'department_id' => 22,
            ),
            155 =>
            array (
                'id' => 956,
                'code' => '70771',
                'name' => 'SUCRE',
                'department_id' => 22,
            ),
            156 =>
            array (
                'id' => 957,
                'code' => '70820',
                'name' => 'SANTIAGO DE TOLU',
                'department_id' => 22,
            ),
            157 =>
            array (
                'id' => 958,
                'code' => '70823',
                'name' => 'TOLU VIEJO',
                'department_id' => 22,
            ),
            158 =>
            array (
                'id' => 959,
                'code' => '73001',
                'name' => 'IBAGUE',
                'department_id' => 23,
            ),
            159 =>
            array (
                'id' => 960,
                'code' => '73024',
                'name' => 'ALPUJARRA',
                'department_id' => 23,
            ),
            160 =>
            array (
                'id' => 961,
                'code' => '73026',
                'name' => 'ALVARADO',
                'department_id' => 23,
            ),
            161 =>
            array (
                'id' => 962,
                'code' => '73030',
                'name' => 'ALBALEMA',
                'department_id' => 23,
            ),
            162 =>
            array (
                'id' => 963,
                'code' => '73043',
                'name' => 'ANZOATEGUI',
                'department_id' => 23,
            ),
            163 =>
            array (
                'id' => 964,
                'code' => '73055',
                'name' => 'ARMERO',
                'department_id' => 23,
            ),
            164 =>
            array (
                'id' => 965,
                'code' => '73067',
                'name' => 'ATACO',
                'department_id' => 23,
            ),
            165 =>
            array (
                'id' => 966,
                'code' => '73124',
                'name' => 'CAJAMARCA',
                'department_id' => 23,
            ),
            166 =>
            array (
                'id' => 967,
                'code' => '73148',
                'name' => 'CARMEN DE APICALA',
                'department_id' => 23,
            ),
            167 =>
            array (
                'id' => 968,
                'code' => '73152',
                'name' => 'CASABIANCA',
                'department_id' => 23,
            ),
            168 =>
            array (
                'id' => 969,
                'code' => '73168',
                'name' => 'CHAPARRAL',
                'department_id' => 23,
            ),
            169 =>
            array (
                'id' => 970,
                'code' => '73200',
                'name' => 'COELLO',
                'department_id' => 23,
            ),
            170 =>
            array (
                'id' => 971,
                'code' => '73217',
                'name' => 'COYAIMA',
                'department_id' => 23,
            ),
            171 =>
            array (
                'id' => 972,
                'code' => '73226',
                'name' => 'CUNDAY',
                'department_id' => 23,
            ),
            172 =>
            array (
                'id' => 973,
                'code' => '73236',
                'name' => 'DOLORES',
                'department_id' => 23,
            ),
            173 =>
            array (
                'id' => 974,
                'code' => '73268',
                'name' => 'ESPINAL',
                'department_id' => 23,
            ),
            174 =>
            array (
                'id' => 975,
                'code' => '73270',
                'name' => 'FALAN',
                'department_id' => 23,
            ),
            175 =>
            array (
                'id' => 976,
                'code' => '73275',
                'name' => 'FLANDES',
                'department_id' => 23,
            ),
            176 =>
            array (
                'id' => 977,
                'code' => '73283',
                'name' => 'FRESNO',
                'department_id' => 23,
            ),
            177 =>
            array (
                'id' => 978,
                'code' => '73319',
                'name' => 'GUAMO',
                'department_id' => 23,
            ),
            178 =>
            array (
                'id' => 979,
                'code' => '73347',
                'name' => 'HERVEO',
                'department_id' => 23,
            ),
            179 =>
            array (
                'id' => 980,
                'code' => '73349',
                'name' => 'HONDA',
                'department_id' => 23,
            ),
            180 =>
            array (
                'id' => 981,
                'code' => '73352',
                'name' => 'ICONONZO',
                'department_id' => 23,
            ),
            181 =>
            array (
                'id' => 982,
                'code' => '73408',
                'name' => 'LERIDA',
                'department_id' => 23,
            ),
            182 =>
            array (
                'id' => 983,
                'code' => '73411',
                'name' => 'LIBANO',
                'department_id' => 23,
            ),
            183 =>
            array (
                'id' => 984,
                'code' => '73443',
                'name' => 'SAN SEBASTIAN DE MARIQUITA',
                'department_id' => 23,
            ),
            184 =>
            array (
                'id' => 985,
                'code' => '73449',
                'name' => 'MELGAR',
                'department_id' => 23,
            ),
            185 =>
            array (
                'id' => 986,
                'code' => '73461',
                'name' => 'MURILLO',
                'department_id' => 23,
            ),
            186 =>
            array (
                'id' => 987,
                'code' => '73483',
                'name' => 'NATAGAIMA',
                'department_id' => 23,
            ),
            187 =>
            array (
                'id' => 988,
                'code' => '73504',
                'name' => 'ORTEGA',
                'department_id' => 23,
            ),
            188 =>
            array (
                'id' => 989,
                'code' => '73520',
                'name' => 'PALOCABILDO',
                'department_id' => 23,
            ),
            189 =>
            array (
                'id' => 990,
                'code' => '73547',
                'name' => 'PIEDRAS',
                'department_id' => 23,
            ),
            190 =>
            array (
                'id' => 991,
                'code' => '73555',
                'name' => 'PLANADAS',
                'department_id' => 23,
            ),
            191 =>
            array (
                'id' => 992,
                'code' => '73563',
                'name' => 'PRADO',
                'department_id' => 23,
            ),
            192 =>
            array (
                'id' => 993,
                'code' => '73585',
                'name' => 'PURIFICACION',
                'department_id' => 23,
            ),
            193 =>
            array (
                'id' => 994,
                'code' => '73616',
                'name' => 'RIOBLANCO',
                'department_id' => 23,
            ),
            194 =>
            array (
                'id' => 995,
                'code' => '73622',
                'name' => 'RONCESVALLES',
                'department_id' => 23,
            ),
            195 =>
            array (
                'id' => 996,
                'code' => '73624',
                'name' => 'ROBIRA',
                'department_id' => 23,
            ),
            196 =>
            array (
                'id' => 997,
                'code' => '73671',
                'name' => 'SALDAÑA',
                'department_id' => 23,
            ),
            197 =>
            array (
                'id' => 998,
                'code' => '73675',
                'name' => 'SAN ANTONIO',
                'department_id' => 23,
            ),
            198 =>
            array (
                'id' => 999,
                'code' => '73678',
                'name' => 'SAN LUIS',
                'department_id' => 23,
            ),
            199 =>
            array (
                'id' => 1000,
                'code' => '73686',
                'name' => 'SANTA ISABEL',
                'department_id' => 23,
            ),
        ));
        DB::table('municipalities')->insert(array (
            0 =>
            array (
                'id' => 1001,
                'code' => '73770',
                'name' => 'SUAREZ',
                'department_id' => 23,
            ),
            1 =>
            array (
                'id' => 1002,
                'code' => '73854',
                'name' => 'VALLE DE SAN JUAN',
                'department_id' => 23,
            ),
            2 =>
            array (
                'id' => 1003,
                'code' => '73861',
                'name' => 'VENADILLO',
                'department_id' => 23,
            ),
            3 =>
            array (
                'id' => 1004,
                'code' => '73870',
                'name' => 'VILLAHERMOSA',
                'department_id' => 23,
            ),
            4 =>
            array (
                'id' => 1005,
                'code' => '73873',
                'name' => 'VILLARICA',
                'department_id' => 23,
            ),
            5 =>
            array (
                'id' => 1006,
                'code' => '76001',
                'name' => 'CALI',
                'department_id' => 24,
            ),
            6 =>
            array (
                'id' => 1007,
                'code' => '76020',
                'name' => 'ALCALA',
                'department_id' => 24,
            ),
            7 =>
            array (
                'id' => 1008,
                'code' => '76036',
                'name' => 'ANDALUCIA',
                'department_id' => 24,
            ),
            8 =>
            array (
                'id' => 1009,
                'code' => '76041',
                'name' => 'ANSERMANUEVO',
                'department_id' => 24,
            ),
            9 =>
            array (
                'id' => 1010,
                'code' => '76054',
                'name' => 'ARGELIA',
                'department_id' => 24,
            ),
            10 =>
            array (
                'id' => 1011,
                'code' => '76100',
                'name' => 'BOLIVAR',
                'department_id' => 24,
            ),
            11 =>
            array (
                'id' => 1012,
                'code' => '76109',
                'name' => 'BUENAVENTURA',
                'department_id' => 24,
            ),
            12 =>
            array (
                'id' => 1013,
                'code' => '76111',
                'name' => 'GUADALAJARA DE BUGA',
                'department_id' => 24,
            ),
            13 =>
            array (
                'id' => 1014,
                'code' => '76113',
                'name' => 'BUGALAGRANDE',
                'department_id' => 24,
            ),
            14 =>
            array (
                'id' => 1015,
                'code' => '76122',
                'name' => 'CAICEDONIA',
                'department_id' => 24,
            ),
            15 =>
            array (
                'id' => 1016,
                'code' => '76126',
                'name' => 'CALIMA',
                'department_id' => 24,
            ),
            16 =>
            array (
                'id' => 1017,
                'code' => '76130',
                'name' => 'CANDELARIA',
                'department_id' => 24,
            ),
            17 =>
            array (
                'id' => 1018,
                'code' => '76147',
                'name' => 'CARTAGO',
                'department_id' => 24,
            ),
            18 =>
            array (
                'id' => 1019,
                'code' => '76233',
                'name' => 'DAGUA',
                'department_id' => 24,
            ),
            19 =>
            array (
                'id' => 1020,
                'code' => '76243',
                'name' => 'EL AGUILA',
                'department_id' => 24,
            ),
            20 =>
            array (
                'id' => 1021,
                'code' => '76246',
                'name' => 'EL CAIRO',
                'department_id' => 24,
            ),
            21 =>
            array (
                'id' => 1022,
                'code' => '76001',
                'name' => 'EL CERRITO',
                'department_id' => 24,
            ),
            22 =>
            array (
                'id' => 1023,
                'code' => '76250',
                'name' => 'EL DOVIO',
                'department_id' => 24,
            ),
            23 =>
            array (
                'id' => 1024,
                'code' => '76275',
                'name' => 'FLORIDA',
                'department_id' => 24,
            ),
            24 =>
            array (
                'id' => 1025,
                'code' => '76306',
                'name' => 'GINEBRA',
                'department_id' => 24,
            ),
            25 =>
            array (
                'id' => 1026,
                'code' => '76318',
                'name' => 'GUACARI',
                'department_id' => 24,
            ),
            26 =>
            array (
                'id' => 1027,
                'code' => '76364',
                'name' => 'JAMUNDI',
                'department_id' => 24,
            ),
            27 =>
            array (
                'id' => 1028,
                'code' => '76377',
                'name' => 'LA CUMBRE',
                'department_id' => 24,
            ),
            28 =>
            array (
                'id' => 1029,
                'code' => '76400',
                'name' => 'LA UNION',
                'department_id' => 24,
            ),
            29 =>
            array (
                'id' => 1030,
                'code' => '76403',
                'name' => 'LA VICTORIA',
                'department_id' => 24,
            ),
            30 =>
            array (
                'id' => 1031,
                'code' => '76497',
                'name' => 'OBANDO',
                'department_id' => 24,
            ),
            31 =>
            array (
                'id' => 1032,
                'code' => '76520',
                'name' => 'PALMIRA',
                'department_id' => 24,
            ),
            32 =>
            array (
                'id' => 1033,
                'code' => '76563',
                'name' => 'PRADERA',
                'department_id' => 24,
            ),
            33 =>
            array (
                'id' => 1034,
                'code' => '76606',
                'name' => 'RESTREPO',
                'department_id' => 24,
            ),
            34 =>
            array (
                'id' => 1035,
                'code' => '76616',
                'name' => 'RIOFRIO',
                'department_id' => 24,
            ),
            35 =>
            array (
                'id' => 1036,
                'code' => '76622',
                'name' => 'RONDANILLO',
                'department_id' => 24,
            ),
            36 =>
            array (
                'id' => 1037,
                'code' => '76670',
                'name' => 'SAN PEDRO',
                'department_id' => 24,
            ),
            37 =>
            array (
                'id' => 1038,
                'code' => '76736',
                'name' => 'SEVILLA',
                'department_id' => 24,
            ),
            38 =>
            array (
                'id' => 1039,
                'code' => '76823',
                'name' => 'TORO',
                'department_id' => 24,
            ),
            39 =>
            array (
                'id' => 1040,
                'code' => '76828',
                'name' => 'TRUJILLO',
                'department_id' => 24,
            ),
            40 =>
            array (
                'id' => 1041,
                'code' => '76834',
                'name' => 'TULUA',
                'department_id' => 24,
            ),
            41 =>
            array (
                'id' => 1042,
                'code' => '76845',
                'name' => 'ULLOA',
                'department_id' => 24,
            ),
            42 =>
            array (
                'id' => 1043,
                'code' => '76863',
                'name' => 'VERSALLES',
                'department_id' => 24,
            ),
            43 =>
            array (
                'id' => 1044,
                'code' => '76869',
                'name' => 'VIJES',
                'department_id' => 24,
            ),
            44 =>
            array (
                'id' => 1045,
                'code' => '76890',
                'name' => 'YOTOCO',
                'department_id' => 24,
            ),
            45 =>
            array (
                'id' => 1046,
                'code' => '76892',
                'name' => 'YUMBO',
                'department_id' => 24,
            ),
            46 =>
            array (
                'id' => 1047,
                'code' => '76895',
                'name' => 'ZARZAL',
                'department_id' => 24,
            ),
            47 =>
            array (
                'id' => 1048,
                'code' => '81001',
                'name' => 'ARAUCA',
                'department_id' => 25,
            ),
            48 =>
            array (
                'id' => 1049,
                'code' => '81065',
                'name' => 'ARAUQUITA',
                'department_id' => 25,
            ),
            49 =>
            array (
                'id' => 1050,
                'code' => '81220',
                'name' => 'CRAVO NORTE',
                'department_id' => 25,
            ),
            50 =>
            array (
                'id' => 1051,
                'code' => '81300',
                'name' => 'FORTUL',
                'department_id' => 25,
            ),
            51 =>
            array (
                'id' => 1052,
                'code' => '81591',
                'name' => 'PUERTO RONDON',
                'department_id' => 25,
            ),
            52 =>
            array (
                'id' => 1053,
                'code' => '81736',
                'name' => 'SARAVENA',
                'department_id' => 25,
            ),
            53 =>
            array (
                'id' => 1054,
                'code' => '81794',
                'name' => 'TAME',
                'department_id' => 25,
            ),
            54 =>
            array (
                'id' => 1055,
                'code' => '85001',
                'name' => 'YOPAL',
                'department_id' => 26,
            ),
            55 =>
            array (
                'id' => 1056,
                'code' => '85010',
                'name' => 'AGUAZUL',
                'department_id' => 26,
            ),
            56 =>
            array (
                'id' => 1057,
                'code' => '85015',
                'name' => 'CHAMEZA',
                'department_id' => 26,
            ),
            57 =>
            array (
                'id' => 1058,
                'code' => '85125',
                'name' => 'HATO COROZAL',
                'department_id' => 26,
            ),
            58 =>
            array (
                'id' => 1059,
                'code' => '85136',
                'name' => 'LA SALINA',
                'department_id' => 26,
            ),
            59 =>
            array (
                'id' => 1060,
                'code' => '85139',
                'name' => 'MANI',
                'department_id' => 26,
            ),
            60 =>
            array (
                'id' => 1061,
                'code' => '85162',
                'name' => 'MONTERREY',
                'department_id' => 26,
            ),
            61 =>
            array (
                'id' => 1062,
                'code' => '85225',
                'name' => 'NUNCHIA',
                'department_id' => 26,
            ),
            62 =>
            array (
                'id' => 1063,
                'code' => '85230',
                'name' => 'OROCUE',
                'department_id' => 26,
            ),
            63 =>
            array (
                'id' => 1064,
                'code' => '85250',
                'name' => 'PAZ DE ARIPORO',
                'department_id' => 26,
            ),
            64 =>
            array (
                'id' => 1065,
                'code' => '85263',
                'name' => 'PORE',
                'department_id' => 26,
            ),
            65 =>
            array (
                'id' => 1066,
                'code' => '85279',
                'name' => 'RECETOR',
                'department_id' => 26,
            ),
            66 =>
            array (
                'id' => 1067,
                'code' => '85300',
                'name' => 'SABANALARGA',
                'department_id' => 26,
            ),
            67 =>
            array (
                'id' => 1068,
                'code' => '85315',
                'name' => 'SACAMA',
                'department_id' => 26,
            ),
            68 =>
            array (
                'id' => 1069,
                'code' => '85325',
                'name' => 'SAN LUIS DE PALENQUE',
                'department_id' => 26,
            ),
            69 =>
            array (
                'id' => 1070,
                'code' => '85400',
                'name' => 'TAMARA',
                'department_id' => 26,
            ),
            70 =>
            array (
                'id' => 1071,
                'code' => '85410',
                'name' => 'TAURAMENA',
                'department_id' => 26,
            ),
            71 =>
            array (
                'id' => 1072,
                'code' => '85430',
                'name' => 'TRINIDAD',
                'department_id' => 26,
            ),
            72 =>
            array (
                'id' => 1073,
                'code' => '85440',
                'name' => 'VILLANUEVA',
                'department_id' => 26,
            ),
            73 =>
            array (
                'id' => 1074,
                'code' => '86001',
                'name' => 'MOCOA',
                'department_id' => 27,
            ),
            74 =>
            array (
                'id' => 1075,
                'code' => '86219',
                'name' => 'COLON',
                'department_id' => 27,
            ),
            75 =>
            array (
                'id' => 1076,
                'code' => '86320',
                'name' => 'ORITO',
                'department_id' => 27,
            ),
            76 =>
            array (
                'id' => 1077,
                'code' => '86568',
                'name' => 'PUERTO ASIS',
                'department_id' => 27,
            ),
            77 =>
            array (
                'id' => 1078,
                'code' => '86569',
                'name' => 'PUERTO CAICEDO',
                'department_id' => 27,
            ),
            78 =>
            array (
                'id' => 1079,
                'code' => '86571',
                'name' => 'PUERTO GUZMAN',
                'department_id' => 27,
            ),
            79 =>
            array (
                'id' => 1080,
                'code' => '86573',
                'name' => 'LEGUIZAMO',
                'department_id' => 27,
            ),
            80 =>
            array (
                'id' => 1081,
                'code' => '86749',
                'name' => 'SIBUNDOY',
                'department_id' => 27,
            ),
            81 =>
            array (
                'id' => 1082,
                'code' => '86755',
                'name' => 'SAN FRANCISCO',
                'department_id' => 27,
            ),
            82 =>
            array (
                'id' => 1083,
                'code' => '86757',
                'name' => 'SANMIGUEL',
                'department_id' => 27,
            ),
            83 =>
            array (
                'id' => 1084,
                'code' => '86760',
                'name' => 'SANTIAGO',
                'department_id' => 27,
            ),
            84 =>
            array (
                'id' => 1085,
                'code' => '86865',
                'name' => 'VALLE DE GUAMUEZ',
                'department_id' => 27,
            ),
            85 =>
            array (
                'id' => 1086,
                'code' => '86885',
                'name' => 'VILLAGARZON',
                'department_id' => 27,
            ),
            86 =>
            array (
                'id' => 1087,
                'code' => '88001',
                'name' => 'SAN ANDRES',
                'department_id' => 28,
            ),
            87 =>
            array (
                'id' => 1088,
                'code' => '88564',
                'name' => 'PROVIDENCIA',
                'department_id' => 28,
            ),
            88 =>
            array (
                'id' => 1089,
                'code' => '91001',
                'name' => 'LETICIA',
                'department_id' => 29,
            ),
            89 =>
            array (
                'id' => 1090,
                'code' => '91263',
                'name' => 'EL ENCANTO',
                'department_id' => 29,
            ),
            90 =>
            array (
                'id' => 1091,
                'code' => '91405',
                'name' => 'LA CHORRERA',
                'department_id' => 29,
            ),
            91 =>
            array (
                'id' => 1092,
                'code' => '91407',
                'name' => 'LA PEDRERA',
                'department_id' => 29,
            ),
            92 =>
            array (
                'id' => 1093,
                'code' => '91430',
                'name' => 'LA VICTORIA',
                'department_id' => 29,
            ),
            93 =>
            array (
                'id' => 1094,
                'code' => '91460',
                'name' => 'MIRITI - PARANA',
                'department_id' => 29,
            ),
            94 =>
            array (
                'id' => 1095,
                'code' => '91530',
                'name' => 'PUERTO ALEGRIA',
                'department_id' => 29,
            ),
            95 =>
            array (
                'id' => 1096,
                'code' => '91536',
                'name' => 'PUERTO ARICA',
                'department_id' => 29,
            ),
            96 =>
            array (
                'id' => 1097,
                'code' => '91540',
                'name' => 'PUERTO NARIÑO',
                'department_id' => 29,
            ),
            97 =>
            array (
                'id' => 1098,
                'code' => '91669',
                'name' => 'PUERTO SANTANDER',
                'department_id' => 29,
            ),
            98 =>
            array (
                'id' => 1099,
                'code' => '91798',
                'name' => 'TARAPACA',
                'department_id' => 29,
            ),
            99 =>
            array (
                'id' => 1100,
                'code' => '94001',
                'name' => 'INIRIDA',
                'department_id' => 30,
            ),
            100 =>
            array (
                'id' => 1101,
                'code' => '94343',
                'name' => 'BARRANCO MINAS',
                'department_id' => 30,
            ),
            101 =>
            array (
                'id' => 1102,
                'code' => '94663',
                'name' => 'MAPIRIPANA',
                'department_id' => 30,
            ),
            102 =>
            array (
                'id' => 1103,
                'code' => '94883',
                'name' => 'SAN FELIPE',
                'department_id' => 30,
            ),
            103 =>
            array (
                'id' => 1104,
                'code' => '94884',
                'name' => 'PUERTO COLOMBIA',
                'department_id' => 30,
            ),
            104 =>
            array (
                'id' => 1105,
                'code' => '94885',
                'name' => 'LA GUADALUPE',
                'department_id' => 30,
            ),
            105 =>
            array (
                'id' => 1106,
                'code' => '94886',
                'name' => 'CACAHUAL',
                'department_id' => 30,
            ),
            106 =>
            array (
                'id' => 1107,
                'code' => '94887',
                'name' => 'PANA PANA',
                'department_id' => 30,
            ),
            107 =>
            array (
                'id' => 1108,
                'code' => '94888',
                'name' => 'MORICHAL NUEVO',
                'department_id' => 30,
            ),
            108 =>
            array (
                'id' => 1109,
                'code' => '95001',
                'name' => 'SAN JOSE DE GUAVIARE',
                'department_id' => 31,
            ),
            109 =>
            array (
                'id' => 1110,
                'code' => '95015',
                'name' => 'CALAMAR',
                'department_id' => 31,
            ),
            110 =>
            array (
                'id' => 1111,
                'code' => '95025',
                'name' => 'EL RETORNO',
                'department_id' => 31,
            ),
            111 =>
            array (
                'id' => 1112,
                'code' => '95200',
                'name' => 'MIRAFLORES',
                'department_id' => 31,
            ),
            112 =>
            array (
                'id' => 1113,
                'code' => '97001',
                'name' => 'MITU',
                'department_id' => 32,
            ),
            113 =>
            array (
                'id' => 1114,
                'code' => '97161',
                'name' => 'CARURU',
                'department_id' => 32,
            ),
            114 =>
            array (
                'id' => 1115,
                'code' => '97511',
                'name' => 'PACOA',
                'department_id' => 32,
            ),
            115 =>
            array (
                'id' => 1116,
                'code' => '97666',
                'name' => 'TARAIRA',
                'department_id' => 32,
            ),
            116 =>
            array (
                'id' => 1117,
                'code' => '97777',
                'name' => 'PAPUNAUA',
                'department_id' => 32,
            ),
            117 =>
            array (
                'id' => 1118,
                'code' => '97889',
                'name' => 'YAVARETE',
                'department_id' => 32,
            ),
            118 =>
            array (
                'id' => 1119,
                'code' => '99001',
                'name' => 'PUERTO CARREÑO',
                'department_id' => 33,
            ),
            119 =>
            array (
                'id' => 1120,
                'code' => '99524',
                'name' => 'LA PRIMAVERA',
                'department_id' => 33,
            ),
            120 =>
            array (
                'id' => 1121,
                'code' => '99624',
                'name' => 'SANTA ROSALIA',
                'department_id' => 33,
            ),
            121 =>
            array (
                'id' => 1122,
                'code' => '99773',
                'name' => 'CUMARIBO',
                'department_id' => 33,
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->delete();

        DB::table('accounts')->insert(array (
            0 =>
            array(
                'id' => 1,
                'account_group_id' => 1,
                'code' => 1105,
                'name' => 'CAJA',
                'total_amount' => 0
            ),
            1 =>
            array(
                'id' => 2,
                'account_group_id' => 1,
                'code' => 1110,
                'name' => 'BANCOS',
                'total_amount' => 0
            ),
            2 =>
            array(
                'id' => 3,
                'account_group_id' => 1,
                'code' => 1115,
                'name' => 'REMESAS EN TRANSITO',
                'total_amount' => 0
            ),
            3 =>
            array(
                'id' => 4,
                'account_group_id' => 1,
                'code' => 1120,
                'name' => 'CUENTAS DE AHORRO',
                'total_amount' => 0
            ),
            4 =>
            array(
                'id' => 5,
                'account_group_id' => 1,
                'code' => 1125,
                'name' => 'FONDOS',
                'total_amount' => 0
            ),
            5 =>
            array(
                'id' => 6,
                'account_group_id' => 2,
                'code' => 1205,
                'name' => 'ACCIONES',
                'total_amount' => 0
            ),
            6 =>
            array(
                'id' => 7,
                'account_group_id' => 2,
                'code' => 1210,
                'name' => 'CUOTAS O PARTES DE INTERES SOCIAL',
                'total_amount' => 0
            ),
            7 =>
            array(
                'id' => 8,
                'account_group_id' => 2,
                'code' => 1215,
                'name' => 'BONOS',
                'total_amount' => 0
            ),
            8 =>
            array(
                'id' => 9,
                'account_group_id' => 2,
                'code' => 1220,
                'name' => 'CEDULAS',
                'total_amount' => 0
            ),
            9 =>
            array(
                'id' => 10,
                'account_group_id' => 2,
                'code' => 1225,
                'name' => 'CERTIFICADOS',
                'total_amount' => 0
            ),
            10 =>
            array(
                'id' => 11,
                'account_group_id' => 2,
                'code' => 1230,
                'name' => 'PAPELES COMERCIALES',
                'total_amount' => 0
            ),
            11 =>
            array(
                'id' => 12,
                'account_group_id' => 2,
                'code' => 1235,
                'name' => 'TITULOS',
                'total_amount' => 0
            ),
            12 =>
            array(
                'id' => 13,
                'account_group_id' => 2,
                'code' => 1240,
                'name' => 'ACEPTACIONES BANCARIAS O FINANCIERAS',
                'total_amount' => 0
            ),
            13 =>
            array(
                'id' => 14,
                'account_group_id' => 2,
                'code' => 1245,
                'name' => 'DERECHOS FIDUCIARIOS',
                'total_amount' => 0
            ),
            14 =>
            array(
                'id' => 15,
                'account_group_id' => 2,
                'code' => 1250,
                'name' => 'DERECHOS DE RECOMPRA DE INVERSIONES NEGOCIADAS (REPOS)',
                'total_amount' => 0
            ),
            15 =>
            array(
                'id' => 16,
                'account_group_id' => 2,
                'code' => 1255,
                'name' => 'OBLIGATORIAS',
                'total_amount' => 0
            ),
            16 =>
            array(
                'id' => 17,
                'account_group_id' => 2,
                'code' => 1260,
                'name' => 'CUENTAS EN PARTICIPACION',
                'total_amount' => 0
            ),
            17 =>
            array(
                'id' => 18,
                'account_group_id' => 2,
                'code' => 1295,
                'name' => 'OTRAS INVERSIONES',
                'total_amount' => 0
            ),
            18 =>
            array(
                'id' => 19,
                'account_group_id' => 2,
                'code' => 1299,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            19 =>
            array(
                'id' => 20,
                'account_group_id' => 3,
                'code' => 1305,
                'name' => 'CLIENTES',
                'total_amount' => 0
            ),
            20 =>
            array(
                'id' => 21,
                'account_group_id' => 3,
                'code' => 1310,
                'name' => 'CUENTAS CORRIENTES COMERCIALES',
                'total_amount' => 0
            ),
            21 =>
            array(
                'id' => 22,
                'account_group_id' => 3,
                'code' => 1315,
                'name' => 'CUENTAS POR COBRAR A CASA MATRIZ',
                'total_amount' => 0
            ),
            22 =>
            array(
                'id' => 23,
                'account_group_id' => 3,
                'code' => 1320,
                'name' => 'CUENTAS POR COBRAR A VINCULADOS ECONOMICOS',
                'total_amount' => 0
            ),
            23 =>
            array(
                'id' => 24,
                'account_group_id' => 3,
                'code' => 1323,
                'name' => 'CUENTAS POR COBRAR A DIRECTORES',
                'total_amount' => 0
            ),
            24 =>
            array(
                'id' => 25,
                'account_group_id' => 3,
                'code' => 1325,
                'name' => 'CUENTAS POR COBRAR A SOCIOS Y ACCIONISTAS',
                'total_amount' => 0
            ),
            25 =>
            array(
                'id' => 26,
                'account_group_id' => 3,
                'code' => 1328,
                'name' => 'APORTES POR COBRAR',
                'total_amount' => 0
            ),
            26 =>
            array(
                'id' => 27,
                'account_group_id' => 3,
                'code' => 1330,
                'name' => 'ANTICIPOS Y AVANCES',
                'total_amount' => 0
            ),
            27 =>
            array(
                'id' => 28,
                'account_group_id' => 3,
                'code' => 1332,
                'name' => 'CUENTAS DE OPERACION CONJUNTA',
                'total_amount' => 0
            ),
            28 =>
            array(
                'id' => 29,
                'account_group_id' => 3,
                'code' => 1335,
                'name' => 'DEPOSITOS',
                'total_amount' => 0
            ),
            29 =>
            array(
                'id' => 30,
                'account_group_id' => 3,
                'code' => 1340,
                'name' => 'PROMESAS DE COMPRA VENTA',
                'total_amount' => 0
            ),
            30 =>
            array(
                'id' => 31,
                'account_group_id' => 3,
                'code' => 1345,
                'name' => 'INGRESOS POR COBRAR',
                'total_amount' => 0
            ),
            31 =>
            array(
                'id' => 32,
                'account_group_id' => 3,
                'code' => 1350,
                'name' => 'RETENCION SOBRE CONTRATOS',
                'total_amount' => 0
            ),
            32 =>
            array(
                'id' => 33,
                'account_group_id' => 3,
                'code' => 1355,
                'name' => 'ANTICIPO DE IMPUESTOS Y CONTRIBUCIONES O SALDOS A FAVOR',
                'total_amount' => 0
            ),
            33 =>
            array(
                'id' => 34,
                'account_group_id' => 3,
                'code' => 1360,
                'name' => 'RECLAMACIONES',
                'total_amount' => 0
            ),
            34 =>
            array(
                'id' => 35,
                'account_group_id' => 3,
                'code' => 1365,
                'name' => 'CUENTAS POR COBRAR A TRABAJADORES',
                'total_amount' => 0
            ),
            35 =>
            array(
                'id' => 36,
                'account_group_id' => 3,
                'code' => 1370,
                'name' => 'PRESTAMOS A PARTICULARES',
                'total_amount' => 0
            ),
            36 =>
            array(
                'id' => 37,
                'account_group_id' => 3,
                'code' => 1380,
                'name' => 'DEUDORES VARIOS',
                'total_amount' => 0
            ),
            37 =>
            array(
                'id' => 38,
                'account_group_id' => 3,
                'code' => 1385,
                'name' => 'DERECHOS DE RECOMPRA DE CARTERA NEGOCIADA',
                'total_amount' => 0
            ),
            38 =>
            array(
                'id' => 39,
                'account_group_id' => 3,
                'code' => 1390,
                'name' => 'DEUDAS DE DIFICIL COBRO',
                'total_amount' => 0
            ),
            39 =>
            array(
                'id' => 40,
                'account_group_id' => 3,
                'code' => 1399,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            40 =>
            array(
                'id' => 41,
                'account_group_id' => 4,
                'code' => 1405,
                'name' => 'MATERIAS PRIMAS',
                'total_amount' => 0
            ),
            41 =>
            array(
                'id' => 42,
                'account_group_id' => 4,
                'code' => 1410,
                'name' => 'PRODUCTOS EN PROCESO',
                'total_amount' => 0
            ),
            42 =>
            array(
                'id' => 43,
                'account_group_id' => 4,
                'code' => 1415,
                'name' => 'OBRAS DE CONSTRUCCION EN CURSO',
                'total_amount' => 0
            ),
            43 =>
            array(
                'id' => 44,
                'account_group_id' => 4,
                'code' => 1417,
                'name' => 'OBRAS DE URBANISMO',
                'total_amount' => 0
            ),
            44 =>
            array(
                'id' => 45,
                'account_group_id' => 4,
                'code' => 1420,
                'name' => 'CONTRATOS EN EJECUCION',
                'total_amount' => 0
            ),
            45 =>
            array(
                'id' => 46,
                'account_group_id' => 4,
                'code' => 1425,
                'name' => 'CULTIVOS EN DESARROLLO',
                'total_amount' => 0
            ),
            46 =>
            array(
                'id' => 47,
                'account_group_id' => 4,
                'code' => 1430,
                'name' => 'PRODUCTOS TERMINADOS',
                'total_amount' => 0
            ),
            47 =>
            array(
                'id' => 48,
                'account_group_id' => 4,
                'code' => 1435,
                'name' => 'MERCANCIAS NO FABRICADAS POR LA EMPRESA',
                'total_amount' => 0
            ),
            48 =>
            array(
                'id' => 49,
                'account_group_id' => 4,
                'code' => 1440,
                'name' => 'BIENES RAICES PARA LA VENTA',
                'total_amount' => 0
            ),
            49 =>
            array(
                'id' => 50,
                'account_group_id' => 4,
                'code' => 1445,
                'name' => 'SEMOVIENTES',
                'total_amount' => 0
            ),
            50 =>
            array(
                'id' => 51,
                'account_group_id' => 4,
                'code' => 1450,
                'name' => 'TERRENOS',
                'total_amount' => 0
            ),
            51 =>
            array(
                'id' => 52,
                'account_group_id' => 4,
                'code' => 1455,
                'name' => 'MATERIALES, REPUESTOS Y ACCESORIOS',
                'total_amount' => 0
            ),
            52 =>
            array(
                'id' => 53,
                'account_group_id' => 4,
                'code' => 1460,
                'name' => 'ENVASES Y EMPAQUES',
                'total_amount' => 0
            ),
            53 =>
            array(
                'id' => 54,
                'account_group_id' => 4,
                'code' => 1465,
                'name' => 'INVENTARIOS EN TRANSITO',
                'total_amount' => 0
            ),
            54 =>
            array(
                'id' => 55,
                'account_group_id' => 4,
                'code' => 1499,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            55 =>
            array(
                'id' => 56,
                'account_group_id' => 5,
                'code' => 1504,
                'name' => 'TERRENOS',
                'total_amount' => 0
            ),
            56 =>
            array(
                'id' => 57,
                'account_group_id' => 5,
                'code' => 1506,
                'name' => 'MATERIALES PROYECTOS PETROLEROS',
                'total_amount' => 0
            ),
            57 =>
            array(
                'id' => 58,
                'account_group_id' => 5,
                'code' => 1508,
                'name' => 'CONSTRUCCIONES EN CURSO',
                'total_amount' => 0
            ),
            58 =>
            array(
                'id' => 59,
                'account_group_id' => 5,
                'code' => 1512,
                'name' => 'MAQUINARIA Y EQUIPOS EN MONTAJE',
                'total_amount' => 0
            ),
            59 =>
            array(
                'id' => 60,
                'account_group_id' => 5,
                'code' => 1516,
                'name' => 'CONSTRUCCIONES Y EDIFICACIONES',
                'total_amount' => 0
            ),
            60 =>
            array(
                'id' => 61,
                'account_group_id' => 5,
                'code' => 1520,
                'name' => 'MAQUINARIA Y EQUIPO',
                'total_amount' => 0
            ),
            61 =>
            array(
                'id' => 62,
                'account_group_id' => 5,
                'code' => 1524,
                'name' => 'EQUIPO DE OFICINA',
                'total_amount' => 0
            ),
            62 =>
            array(
                'id' => 63,
                'account_group_id' => 5,
                'code' => 1528,
                'name' => 'EQUIPO DE COMPUTACION Y COMUNICACION',
                'total_amount' => 0
            ),
            63 =>
            array(
                'id' => 64,
                'account_group_id' => 5,
                'code' => 1532,
                'name' => 'EQUIPO MEDICO - CIENTIFICO',
                'total_amount' => 0
            ),
            64 =>
            array(
                'id' => 65,
                'account_group_id' => 5,
                'code' => 1536,
                'name' => 'EQUIPO DE HOTELES Y RESTAURANTES',
                'total_amount' => 0
            ),
            65 =>
            array(
                'id' => 66,
                'account_group_id' => 5,
                'code' => 1540,
                'name' => 'FLOTA Y EQUIPO DE TRANSPORTE',
                'total_amount' => 0
            ),
            66 =>
            array(
                'id' => 67,
                'account_group_id' => 5,
                'code' => 1544,
                'name' => 'FLOTA Y EQUIPO FLUVIAL Y/O MARITIMO',
                'total_amount' => 0
            ),
            67 =>
            array(
                'id' => 68,
                'account_group_id' => 5,
                'code' => 1548,
                'name' => 'FLOTA Y EQUIPO AEREO',
                'total_amount' => 0
            ),
            68 =>
            array(
                'id' => 69,
                'account_group_id' => 5,
                'code' => 1552,
                'name' => 'FLOTA Y EQUIPO FERREO',
                'total_amount' => 0
            ),
            69 =>
            array(
                'id' => 70,
                'account_group_id' => 5,
                'code' => 1556,
                'name' => 'ACUEDUCTOS PLANTAS Y REDES',
                'total_amount' => 0
            ),
            70 =>
            array(
                'id' => 71,
                'account_group_id' => 5,
                'code' => 1560,
                'name' => 'ARMAMENTO DE VIGILANCIA',
                'total_amount' => 0
            ),
            71 =>
            array(
                'id' => 72,
                'account_group_id' => 5,
                'code' => 1562,
                'name' => 'ENVASES Y EMPAQUES',
                'total_amount' => 0
            ),
            72 =>
            array(
                'id' => 73,
                'account_group_id' => 5,
                'code' => 1564,
                'name' => 'PLANTACIONES AGRICOLAS Y FORESTALES',
                'total_amount' => 0
            ),
            73 =>
            array(
                'id' => 74,
                'account_group_id' => 5,
                'code' => 1568,
                'name' => 'VIAS DE COMUNICACION',
                'total_amount' => 0
            ),
            74 =>
            array(
                'id' => 75,
                'account_group_id' => 5,
                'code' => 1572,
                'name' => 'MINAS Y CANTERAS',
                'total_amount' => 0
            ),
            75 =>
            array(
                'id' => 76,
                'account_group_id' => 5,
                'code' => 1576,
                'name' => 'POZOS ARTESIANOS',
                'total_amount' => 0
            ),
            76 =>
            array(
                'id' => 77,
                'account_group_id' => 5,
                'code' => 1580,
                'name' => 'YACIMIENTOS',
                'total_amount' => 0
            ),
            77 =>
            array(
                'id' => 78,
                'account_group_id' => 5,
                'code' => 1584,
                'name' => 'SEMOVIENTES',
                'total_amount' => 0
            ),
            78 =>
            array(
                'id' => 79,
                'account_group_id' => 5,
                'code' => 1588,
                'name' => 'PROPIEDADES PLANTA Y EQUIPO EN TRANSITO',
                'total_amount' => 0
            ),
            79 =>
            array(
                'id' => 80,
                'account_group_id' => 5,
                'code' => 1592,
                'name' => 'DEPRECIACION ACUMULADA',
                'total_amount' => 0
            ),
            80 =>
            array(
                'id' => 81,
                'account_group_id' => 5,
                'code' => 1596,
                'name' => 'DEPRECIACION DIFERIDA',
                'total_amount' => 0
            ),
            81 =>
            array(
                'id' => 82,
                'account_group_id' => 5,
                'code' => 1597,
                'name' => 'AMORTIZACION ACUMULADA',
                'total_amount' => 0
            ),
            82 =>
            array(
                'id' => 83,
                'account_group_id' => 5,
                'code' => 1598,
                'name' => 'AGOTAMIENTO ACUMULADO',
                'total_amount' => 0
            ),
            83 =>
            array(
                'id' => 84,
                'account_group_id' => 5,
                'code' => 1599,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            84 =>
            array(
                'id' => 85,
                'account_group_id' => 6,
                'code' => 1605,
                'name' => 'CREDITO MERCANTIL',
                'total_amount' => 0
            ),
            85 =>
            array(
                'id' => 86,
                'account_group_id' => 6,
                'code' => 1610,
                'name' => 'MARCAS',
                'total_amount' => 0
            ),
            86 =>
            array(
                'id' => 87,
                'account_group_id' => 6,
                'code' => 1615,
                'name' => 'PATENTES',
                'total_amount' => 0
            ),
            87 =>
            array(
                'id' => 88,
                'account_group_id' => 6,
                'code' => 1620,
                'name' => 'CONCESIONES Y FRANQUICIAS',
                'total_amount' => 0
            ),
            88 =>
            array(
                'id' => 89,
                'account_group_id' => 6,
                'code' => 1625,
                'name' => 'DERECHOS',
                'total_amount' => 0
            ),
            89 =>
            array(
                'id' => 90,
                'account_group_id' => 6,
                'code' => 1630,
                'name' => 'KNOW HOW',
                'total_amount' => 0
            ),
            90 =>
            array(
                'id' => 91,
                'account_group_id' => 6,
                'code' => 1635,
                'name' => 'LICENCIAS',
                'total_amount' => 0
            ),
            91 =>
            array(
                'id' => 92,
                'account_group_id' => 6,
                'code' => 1698,
                'name' => 'DEPRECIACION Y/O AMORTIZACION ACUMULADA',
                'total_amount' => 0
            ),
            92 =>
            array(
                'id' => 93,
                'account_group_id' => 6,
                'code' => 1699,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            93 =>
            array(
                'id' => 94,
                'account_group_id' => 7,
                'code' => 1705,
                'name' => 'GASTOS PAGADOS POR ANTICIPADO',
                'total_amount' => 0
            ),
            94 =>
            array(
                'id' => 95,
                'account_group_id' => 7,
                'code' => 1710,
                'name' => 'CARGOS DIFERIDOS',
                'total_amount' => 0
            ),
            95 =>
            array(
                'id' => 96,
                'account_group_id' => 7,
                'code' => 1715,
                'name' => 'COSTOS DE EXPLORACION POR AMORTIZAR',
                'total_amount' => 0
            ),
            96 =>
            array(
                'id' => 97,
                'account_group_id' => 7,
                'code' => 1720,
                'name' => 'COSTOS DE EXPLOTACION Y DESARROLLO',
                'total_amount' => 0
            ),
            97 =>
            array(
                'id' => 98,
                'account_group_id' => 7,
                'code' => 1730,
                'name' => 'CARGOS POR CORRECCION MONETARIA DIFERIDA',
                'total_amount' => 0
            ),
            98 =>
            array(
                'id' => 99,
                'account_group_id' => 7,
                'code' => 1798,
                'name' => 'AMORTIZACION ACUMULADA',
                'total_amount' => 0
            ),
            99 =>
            array(
                'id' => 100,
                'account_group_id' => 8,
                'code' => 1805,
                'name' => 'BIENES DE ARTE Y CULTURA',
                'total_amount' => 0
            ),
            100 =>
            array(
                'id' => 101,
                'account_group_id' => 8,
                'code' => 1895,
                'name' => 'DIVERSOS',
                'total_amount' => 0
            ),
            101 =>
            array(
                'id' => 102,
                'account_group_id' => 8,
                'code' => 1899,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            102 =>
            array(
                'id' => 103,
                'account_group_id' => 9,
                'code' => 1905,
                'name' => 'DE INVERSIONES',
                'total_amount' => 0
            ),
            103 =>
            array(
                'id' => 104,
                'account_group_id' => 9,
                'code' => 1910,
                'name' => 'DE PROPIEDADES PLANTA Y EQUIPO',
                'total_amount' => 0
            ),
            104 =>
            array(
                'id' => 105,
                'account_group_id' => 9,
                'code' => 1995,
                'name' => 'DE OTROS ACTIVOS',
                'total_amount' => 0
            ),
            105 =>
            array(
                'id' => 106,
                'account_group_id' => 10,
                'code' => 2105,
                'name' => 'BANCOS NACIONALES',
                'total_amount' => 0
            ),
            106 =>
            array(
                'id' => 107,
                'account_group_id' => 10,
                'code' => 2110,
                'name' => 'BANCOS DEL EXTERIOR',
                'total_amount' => 0
            ),
            107 =>
            array(
                'id' => 108,
                'account_group_id' => 10,
                'code' => 2115,
                'name' => 'CORPORACIONES FINANCIERAS',
                'total_amount' => 0
            ),
            108 =>
            array(
                'id' => 109,
                'account_group_id' => 10,
                'code' => 2120,
                'name' => 'COMPAÑIAS DE FINANCIAMIENTO COMERCIAL',
                'total_amount' => 0
            ),
            109 =>
            array(
                'id' => 110,
                'account_group_id' => 10,
                'code' => 2125,
                'name' => 'CORPORACIONES DE AHORRO Y VIVIENDA',
                'total_amount' => 0
            ),
            110 =>
            array(
                'id' => 111,
                'account_group_id' => 10,
                'code' => 2130,
                'name' => 'ENTIDADES FINANCIERAS DEL EXTERIOR',
                'total_amount' => 0
            ),
            111 =>
            array(
                'id' => 112,
                'account_group_id' => 10,
                'code' => 2135,
                'name' => 'COMPROMISOS DE RECOMPRA DE INVERSIONES NEGOCIADAS',
                'total_amount' => 0
            ),
            112 =>
            array(
                'id' => 113,
                'account_group_id' => 10,
                'code' => 2140,
                'name' => 'COMPROMISOS DE RECOMPRA DE CARTERA NEGOCIADA',
                'total_amount' => 0
            ),
            113 =>
            array(
                'id' => 114,
                'account_group_id' => 10,
                'code' => 2145,
                'name' => 'OBLIGACIONES GUBERNAMENTALES',
                'total_amount' => 0
            ),
            114 =>
            array(
                'id' => 115,
                'account_group_id' => 10,
                'code' => 2195,
                'name' => 'OTRAS OBLIGACIONES',
                'total_amount' => 0
            ),
            115 =>
            array(
                'id' => 116,
                'account_group_id' => 11,
                'code' => 2205,
                'name' => 'NACIONALES',
                'total_amount' => 0
            ),
            116 =>
            array(
                'id' => 117,
                'account_group_id' => 11,
                'code' => 2210,
                'name' => 'DEL EXTERIOR',
                'total_amount' => 0
            ),
            117 =>
            array(
                'id' => 118,
                'account_group_id' => 11,
                'code' => 2215,
                'name' => 'CUENTAS CORRIENTES COMERCIALES',
                'total_amount' => 0
            ),
            118 =>
            array(
                'id' => 119,
                'account_group_id' => 11,
                'code' => 2220,
                'name' => 'CASA MATRIZ',
                'total_amount' => 0
            ),
            119 =>
            array(
                'id' => 120,
                'account_group_id' => 11,
                'code' => 2225,
                'name' => 'COMPAÑIAS VINCULADAS',
                'total_amount' => 0
            ),
            120 =>
            array(
                'id' => 121,
                'account_group_id' => 12,
                'code' => 2305,
                'name' => 'CUENTAS CORRIENTES COMERCIALES',
                'total_amount' => 0
            ),
            121 =>
            array(
                'id' => 122,
                'account_group_id' => 12,
                'code' => 2310,
                'name' => 'A CASA MATRIZ',
                'total_amount' => 0
            ),
            122 =>
            array(
                'id' => 123,
                'account_group_id' => 12,
                'code' => 2315,
                'name' => 'A COMPAÑIAS VINCULADAS',
                'total_amount' => 0
            ),
            123 =>
            array(
                'id' => 124,
                'account_group_id' => 12,
                'code' => 2320,
                'name' => 'A CONTRATISTAS',
                'total_amount' => 0
            ),
            124 =>
            array(
                'id' => 125,
                'account_group_id' => 12,
                'code' => 2330,
                'name' => 'ORDENES DE COMPRA POR UTILIZAR',
                'total_amount' => 0
            ),
            125 =>
            array(
                'id' => 126,
                'account_group_id' => 12,
                'code' => 2335,
                'name' => 'COSTOS Y GASTOS POR  PAGAR',
                'total_amount' => 0
            ),
            126 =>
            array(
                'id' => 127,
                'account_group_id' => 12,
                'code' => 2340,
                'name' => 'INSTALAMENTOS POR PAGAR',
                'total_amount' => 0
            ),
            127 =>
            array(
                'id' => 128,
                'account_group_id' => 12,
                'code' => 2345,
                'name' => 'ACREEDORES OFICIALES',
                'total_amount' => 0
            ),
            128 =>
            array(
                'id' => 129,
                'account_group_id' => 12,
                'code' => 2350,
                'name' => 'REGALIAS POR PAGAR',
                'total_amount' => 0
            ),
            129 =>
            array(
                'id' => 130,
                'account_group_id' => 12,
                'code' => 2355,
                'name' => 'DEUDAS CON ACCIONISTAS O SOCIOS',
                'total_amount' => 0
            ),
            130 =>
            array(
                'id' => 131,
                'account_group_id' => 12,
                'code' => 2357,
                'name' => 'DEUDAS CON DIRECTORES',
                'total_amount' => 0
            ),
            131 =>
            array(
                'id' => 132,
                'account_group_id' => 12,
                'code' => 2360,
                'name' => 'DIVIDENDOS O PARTICIPACIONES POR PAGAR',
                'total_amount' => 0
            ),
            132 =>
            array(
                'id' => 133,
                'account_group_id' => 12,
                'code' => 2365,
                'name' => 'RETENCION EN LA FUENTE',
                'total_amount' => 0
            ),
            133 =>
            array(
                'id' => 134,
                'account_group_id' => 12,
                'code' => 2367,
                'name' => 'IMPUESTO A LAS VENTAS RETENIDO',
                'total_amount' => 0
            ),
            134 =>
            array(
                'id' => 135,
                'account_group_id' => 12,
                'code' => 2368,
                'name' => 'IMPUESTO DE INDUSTRIA Y COMERCIO RETENIDO',
                'total_amount' => 0
            ),
            135 =>
            array(
                'id' => 136,
                'account_group_id' => 12,
                'code' => 2370,
                'name' => 'RETENCIONES Y APORTES DE NOMINA',
                'total_amount' => 0
            ),
            136 =>
            array(
                'id' => 137,
                'account_group_id' => 12,
                'code' => 2375,
                'name' => 'CUOTAS POR DEVOLVER',
                'total_amount' => 0
            ),
            137 =>
            array(
                'id' => 138,
                'account_group_id' => 12,
                'code' => 2380,
                'name' => 'ACREEDORES VARIOS',
                'total_amount' => 0
            ),
            138 =>
            array(
                'id' => 139,
                'account_group_id' => 13,
                'code' => 2404,
                'name' => 'DE RENTA Y COMPLEMENTARIOS',
                'total_amount' => 0
            ),
            139 =>
            array(
                'id' => 140,
                'account_group_id' => 13,
                'code' => 2408,
                'name' => 'IMPUESTO SOBRE LAS VENTAS POR PAGAR',
                'total_amount' => 0
            ),
            140 =>
            array(
                'id' => 141,
                'account_group_id' => 13,
                'code' => 2412,
                'name' => 'DE INDUSTRIA Y COMERCIO',
                'total_amount' => 0
            ),
            141 =>
            array(
                'id' => 142,
                'account_group_id' => 13,
                'code' => 2416,
                'name' => 'A LA PROPIEDAD RAIZ',
                'total_amount' => 0
            ),
            142 =>
            array(
                'id' => 143,
                'account_group_id' => 13,
                'code' => 2420,
                'name' => 'DERECHOS SOBRE INSTRUMENTOS PUBLICOS',
                'total_amount' => 0
            ),
            143 =>
            array(
                'id' => 144,
                'account_group_id' => 13,
                'code' => 2424,
                'name' => 'DE VALORIZACION',
                'total_amount' => 0
            ),
            144 =>
            array(
                'id' => 145,
                'account_group_id' => 13,
                'code' => 2428,
                'name' => 'DE TURISMO',
                'total_amount' => 0
            ),
            145 =>
            array(
                'id' => 146,
                'account_group_id' => 13,
                'code' => 2432,
                'name' => 'TASA POR UTILIZACION DE PUERTOS',
                'total_amount' => 0
            ),
            146 =>
            array(
                'id' => 147,
                'account_group_id' => 13,
                'code' => 2436,
                'name' => 'DE VEHICULOS',
                'total_amount' => 0
            ),
            147 =>
            array(
                'id' => 148,
                'account_group_id' => 13,
                'code' => 2440,
                'name' => 'DE ESPECTACULOS PUBLICOS',
                'total_amount' => 0
            ),
            148 =>
            array(
                'id' => 149,
                'account_group_id' => 13,
                'code' => 2444,
                'name' => 'DE HIDROCARBUROS Y MINAS',
                'total_amount' => 0
            ),
            149 =>
            array(
                'id' => 150,
                'account_group_id' => 13,
                'code' => 2448,
                'name' => 'REGALIAS E IMPUESTOS A LA PEQUEÑA Y MEDIANA MINERIA',
                'total_amount' => 0
            ),
            150 =>
            array(
                'id' => 151,
                'account_group_id' => 13,
                'code' => 2452,
                'name' => 'A LAS EXPORTACIONES CAFETERAS',
                'total_amount' => 0
            ),
            151 =>
            array(
                'id' => 152,
                'account_group_id' => 13,
                'code' => 2456,
                'name' => 'A LAS IMPORTACIONES',
                'total_amount' => 0
            ),
            152 =>
            array(
                'id' => 153,
                'account_group_id' => 13,
                'code' => 2460,
                'name' => 'CUOTAS DE FOMENTO',
                'total_amount' => 0
            ),
            153 =>
            array(
                'id' => 154,
                'account_group_id' => 13,
                'code' => 2464,
                'name' => 'DE LICORES, CERVEZAS Y CIGARRILLOS',
                'total_amount' => 0
            ),
            154 =>
            array(
                'id' => 155,
                'account_group_id' => 13,
                'code' => 2468,
                'name' => 'AL SACRIFICIO DE GANADO',
                'total_amount' => 0
            ),
            155 =>
            array(
                'id' => 156,
                'account_group_id' => 13,
                'code' => 2472,
                'name' => 'AL AZAR Y JUEGOS',
                'total_amount' => 0
            ),
            156 =>
            array(
                'id' => 157,
                'account_group_id' => 13,
                'code' => 2476,
                'name' => 'GRAVAMENES Y REGALIAS POR UTILIZACION DEL SUELO',
                'total_amount' => 0
            ),
            157 =>
            array(
                'id' => 158,
                'account_group_id' => 13,
                'code' => 2495,
                'name' => 'OTROS',
                'total_amount' => 0
            ),
            158 =>
            array(
                'id' => 159,
                'account_group_id' => 14,
                'code' => 2505,
                'name' => 'SALARIOS POR PAGAR',
                'total_amount' => 0
            ),
            159 =>
            array(
                'id' => 160,
                'account_group_id' => 14,
                'code' => 2510,
                'name' => 'CESANTIAS CONSOLIDADAS',
                'total_amount' => 0
            ),
            160 =>
            array(
                'id' => 161,
                'account_group_id' => 14,
                'code' => 2515,
                'name' => 'INTERESES SOBRE CESANTIAS',
                'total_amount' => 0
            ),
            161 =>
            array(
                'id' => 162,
                'account_group_id' => 14,
                'code' => 2520,
                'name' => 'PRIMA DE SERVICIOS',
                'total_amount' => 0
            ),
            162 =>
            array(
                'id' => 163,
                'account_group_id' => 14,
                'code' => 2525,
                'name' => 'VACACIONES CONSOLIDADAS',
                'total_amount' => 0
            ),
            163 =>
            array(
                'id' => 164,
                'account_group_id' => 14,
                'code' => 2530,
                'name' => 'PRESTACIONES EXTRALEGALES',
                'total_amount' => 0
            ),
            164 =>
            array(
                'id' => 165,
                'account_group_id' => 14,
                'code' => 2532,
                'name' => 'PENSIONES POR PAGAR',
                'total_amount' => 0
            ),
            165 =>
            array(
                'id' => 166,
                'account_group_id' => 14,
                'code' => 2535,
                'name' => 'CUOTAS PARTES PENSIONES DE JUBILACION',
                'total_amount' => 0
            ),
            166 =>
            array(
                'id' => 167,
                'account_group_id' => 14,
                'code' => 2540,
                'name' => 'INDEMNIZACIONES LABORALES',
                'total_amount' => 0
            ),
            167 =>
            array(
                'id' => 168,
                'account_group_id' => 15,
                'code' => 2605,
                'name' => 'PARA COSTOS Y GASTOS',
                'total_amount' => 0
            ),
            168 =>
            array(
                'id' => 169,
                'account_group_id' => 15,
                'code' => 2610,
                'name' => 'PARA OBLIGACIONES LABORALES',
                'total_amount' => 0
            ),
            169 =>
            array(
                'id' => 170,
                'account_group_id' => 15,
                'code' => 2615,
                'name' => 'PARA OBLIGACIONES FISCALES',
                'total_amount' => 0
            ),
            170 =>
            array(
                'id' => 171,
                'account_group_id' => 15,
                'code' => 2620,
                'name' => 'PENSIONES DE JUBILACION',
                'total_amount' => 0
            ),
            171 =>
            array(
                'id' => 172,
                'account_group_id' => 15,
                'code' => 2625,
                'name' => 'PARA OBRAS DE URBANISMO',
                'total_amount' => 0
            ),
            172 =>
            array(
                'id' => 173,
                'account_group_id' => 15,
                'code' => 2630,
                'name' => 'PARA MANTENIMIENTO Y REPARACIONES',
                'total_amount' => 0
            ),
            173 =>
            array(
                'id' => 174,
                'account_group_id' => 15,
                'code' => 2635,
                'name' => 'PARA CONTINGENCIAS',
                'total_amount' => 0
            ),
            174 =>
            array(
                'id' => 175,
                'account_group_id' => 15,
                'code' => 2640,
                'name' => 'PARA OBLIGACIONES DE GARANTIAS',
                'total_amount' => 0
            ),
            175 =>
            array(
                'id' => 176,
                'account_group_id' => 15,
                'code' => 2695,
                'name' => 'PROVISIONES DIVERSAS',
                'total_amount' => 0
            ),
            176 =>
            array(
                'id' => 177,
                'account_group_id' => 16,
                'code' => 2705,
                'name' => 'INGRESOS RECIBIDOS POR ANTICIPADO',
                'total_amount' => 0
            ),
            177 =>
            array(
                'id' => 178,
                'account_group_id' => 16,
                'code' => 2710,
                'name' => 'ABONOS DIFERIDOS',
                'total_amount' => 0
            ),
            178 =>
            array(
                'id' => 179,
                'account_group_id' => 16,
                'code' => 2715,
                'name' => 'UTILIDAD DIFERIDA EN VENTAS A PLAZOS',
                'total_amount' => 0
            ),
            179 =>
            array(
                'id' => 180,
                'account_group_id' => 16,
                'code' => 2720,
                'name' => 'CREDITO POR CORRECCION MONETARIA DIFERIDA',
                'total_amount' => 0
            ),
            180 =>
            array(
                'id' => 181,
                'account_group_id' => 16,
                'code' => 2725,
                'name' => 'IMPUESTOS DIFERIDOS',
                'total_amount' => 0
            ),
            181 =>
            array(
                'id' => 182,
                'account_group_id' => 17,
                'code' => 2805,
                'name' => 'ANTICIPOS Y AVANCES RECIBIDOS',
                'total_amount' => 0
            ),
            182 =>
            array(
                'id' => 183,
                'account_group_id' => 17,
                'code' => 2810,
                'name' => 'DEPOSITOS RECIBIDOS',
                'total_amount' => 0
            ),
            183 =>
            array(
                'id' => 184,
                'account_group_id' => 17,
                'code' => 2815,
                'name' => 'INGRESOS RECIBIDOS PARA TERCEROS',
                'total_amount' => 0
            ),
            184 =>
            array(
                'id' => 185,
                'account_group_id' => 17,
                'code' => 2820,
                'name' => 'CUENTAS DE OPERACION CONJUNTA',
                'total_amount' => 0
            ),
            185 =>
            array(
                'id' => 186,
                'account_group_id' => 17,
                'code' => 2825,
                'name' => 'RETENCIONES A TERCEROS SOBRE CONTRATOS',
                'total_amount' => 0
            ),
            186 =>
            array(
                'id' => 187,
                'account_group_id' => 17,
                'code' => 2830,
                'name' => 'EMBARGOS JUDICIALES',
                'total_amount' => 0
            ),
            187 =>
            array(
                'id' => 188,
                'account_group_id' => 17,
                'code' => 2835,
                'name' => 'ACREEDORES DEL SISTEMA',
                'total_amount' => 0
            ),
            188 =>
            array(
                'id' => 189,
                'account_group_id' => 17,
                'code' => 2840,
                'name' => 'CUENTAS EN PARTICIPACION',
                'total_amount' => 0
            ),
            189 =>
            array(
                'id' => 190,
                'account_group_id' => 17,
                'code' => 2895,
                'name' => 'DIVERSOS',
                'total_amount' => 0
            ),
            190 =>
            array(
                'id' => 191,
                'account_group_id' => 18,
                'code' => 2905,
                'name' => 'BONOS EN CIRCULACION',
                'total_amount' => 0
            ),
            191 =>
            array(
                'id' => 192,
                'account_group_id' => 18,
                'code' => 2910,
                'name' => 'BONOS OBLIGATORIAMENTE CONVERTIBLES EN ACCIONES',
                'total_amount' => 0
            ),
            192 =>
            array(
                'id' => 193,
                'account_group_id' => 18,
                'code' => 2915,
                'name' => 'PAPELES COMERCIALES',
                'total_amount' => 0
            ),
            193 =>
            array(
                'id' => 194,
                'account_group_id' => 18,
                'code' => 2920,
                'name' => 'BONOS PENSIONALES',
                'total_amount' => 0
            ),
            194 =>
            array(
                'id' => 195,
                'account_group_id' => 18,
                'code' => 2925,
                'name' => 'TITULOS PENSIONALES',
                'total_amount' => 0
            ),
            195 =>
            array(
                'id' => 196,
                'account_group_id' => 19,
                'code' => 3105,
                'name' => 'CAPITAL SUSCRITO Y PAGADO',
                'total_amount' => 0
            ),
            196 =>
            array(
                'id' => 197,
                'account_group_id' => 19,
                'code' => 3115,
                'name' => 'APORTES SOCIALES',
                'total_amount' => 0
            ),
            197 =>
            array(
                'id' => 198,
                'account_group_id' => 19,
                'code' => 3120,
                'name' => 'CAPITAL ASIGNADO',
                'total_amount' => 0
            ),
            198 =>
            array(
                'id' => 199,
                'account_group_id' => 19,
                'code' => 3125,
                'name' => 'INVERSION SUPLEMENTARIA AL CAPITAL ASIGNADO',
                'total_amount' => 0
            ),
            199 =>
            array(
                'id' => 200,
                'account_group_id' => 19,
                'code' => 3130,
                'name' => 'CAPITAL DE PERSONAS NATURALES',
                'total_amount' => 0
            ),
            200 =>
            array(
                'id' => 201,
                'account_group_id' => 19,
                'code' => 3135,
                'name' => 'APORTES DEL ESTADO',
                'total_amount' => 0
            ),
            201 =>
            array(
                'id' => 202,
                'account_group_id' => 19,
                'code' => 3140,
                'name' => 'FONDO SOCIAL',
                'total_amount' => 0
            ),
            202 =>
            array(
                'id' => 203,
                'account_group_id' => 20,
                'code' => 3205,
                'name' => 'PRIMA EN COLOCACION DE ACCIONES, CUOTAS O PARTES DE INTERES',
                'total_amount' => 0
            ),
            203 =>
            array(
                'id' => 204,
                'account_group_id' => 20,
                'code' => 3210,
                'name' => 'DONACIONES',
                'total_amount' => 0
            ),
            204 =>
            array(
                'id' => 205,
                'account_group_id' => 20,
                'code' => 3215,
                'name' => 'CREDITO MERCANTIL',
                'total_amount' => 0
            ),
            205 =>
            array(
                'id' => 206,
                'account_group_id' => 20,
                'code' => 3220,
                'name' => 'KNOW HOW',
                'total_amount' => 0
            ),
            206 =>
            array(
                'id' => 207,
                'account_group_id' => 20,
                'code' => 3225,
                'name' => 'SUPERAVIT METODO DE PARTICIPACION',
                'total_amount' => 0
            ),
            207 =>
            array(
                'id' => 208,
                'account_group_id' => 21,
                'code' => 3305,
                'name' => 'RESERVAS OBLIGATORIAS',
                'total_amount' => 0
            ),
            208 =>
            array(
                'id' => 209,
                'account_group_id' => 21,
                'code' => 3310,
                'name' => 'RESERVAS ESTATUTARIAS',
                'total_amount' => 0
            ),
            209 =>
            array(
                'id' => 210,
                'account_group_id' => 21,
                'code' => 3315,
                'name' => 'RESERVAS OCASIONALES',
                'total_amount' => 0
            ),
            210 =>
            array(
                'id' => 211,
                'account_group_id' => 22,
                'code' => 3405,
                'name' => 'AJUSTES POR INFLACION',
                'total_amount' => 0
            ),
            211 =>
            array(
                'id' => 212,
                'account_group_id' => 22,
                'code' => 3410,
                'name' => 'SANEAMIENTO FISCAL',
                'total_amount' => 0
            ),
            212 =>
            array(
                'id' => 213,
                'account_group_id' => 22,
                'code' => 3415,
                'name' => 'AJUSTES POR INFLACION DECRETO 3019 DE 1989',
                'total_amount' => 0
            ),
            213 =>
            array(
                'id' => 214,
                'account_group_id' => 23,
                'code' => 3505,
                'name' => 'DIVIDENDOS DECRETADOS EN ACCIONES',
                'total_amount' => 0
            ),
            214 =>
            array(
                'id' => 215,
                'account_group_id' => 23,
                'code' => 3510,
                'name' => 'PARTICIPACIONES DECRETADAS EN CUOTAS O PARTES DE INTERES SOCIAL',
                'total_amount' => 0
            ),
            215 =>
            array(
                'id' => 216,
                'account_group_id' => 24,
                'code' => 3605,
                'name' => 'UTILIDAD DEL EJERCICIO',
                'total_amount' => 0
            ),
            216 =>
            array(
                'id' => 217,
                'account_group_id' => 24,
                'code' => 3610,
                'name' => 'PERDIDA DEL EJERCICIO',
                'total_amount' => 0
            ),
            217 =>
            array(
                'id' => 218,
                'account_group_id' => 25,
                'code' => 3705,
                'name' => 'UTILIDADES ACUMULADOS',
                'total_amount' => 0
            ),
            218 =>
            array(
                'id' => 219,
                'account_group_id' => 25,
                'code' => 3710,
                'name' => 'PERDIDAS ACUMULADAS',
                'total_amount' => 0
            ),
            219 =>
            array(
                'id' => 220,
                'account_group_id' => 26,
                'code' => 3805,
                'name' => 'DE INVERSIONES',
                'total_amount' => 0
            ),
            220 =>
            array(
                'id' => 221,
                'account_group_id' => 26,
                'code' => 3810,
                'name' => 'DE PROPIEDADES PLANTA Y EQUIPO',
                'total_amount' => 0
            ),
            221 =>
            array(
                'id' => 222,
                'account_group_id' => 26,
                'code' => 3895,
                'name' => 'DE OTROS ACTIVOS',
                'total_amount' => 0
            ),
            222 =>
            array(
                'id' => 223,
                'account_group_id' => 27,
                'code' => 4105,
                'name' => 'AGRICULTURA, GANADERIA, CAZA Y SILVICULTURA',
                'total_amount' => 0
            ),
            223 =>
            array(
                'id' => 224,
                'account_group_id' => 27,
                'code' => 4110,
                'name' => 'PESCA',
                'total_amount' => 0
            ),
            224 =>
            array(
                'id' => 225,
                'account_group_id' => 27,
                'code' => 4115,
                'name' => 'EXPLOTACION DE MINAS Y CANTERAS',
                'total_amount' => 0
            ),
            225 =>
            array(
                'id' => 226,
                'account_group_id' => 27,
                'code' => 4120,
                'name' => 'INDUSTRIAS MANUFACTURERAS',
                'total_amount' => 0
            ),
            226 =>
            array(
                'id' => 227,
                'account_group_id' => 27,
                'code' => 4125,
                'name' => 'SUMINISTRO DE ELECTRICIDAD, GAS Y AGUA',
                'total_amount' => 0
            ),
            227 =>
            array(
                'id' => 228,
                'account_group_id' => 27,
                'code' => 4130,
                'name' => 'CONSTRUCCION',
                'total_amount' => 0
            ),
            228 =>
            array(
                'id' => 229,
                'account_group_id' => 27,
                'code' => 4135,
                'name' => 'COMERCIO AL POR MAYOR Y AL POR MENOR',
                'total_amount' => 0
            ),
            229 =>
            array(
                'id' => 230,
                'account_group_id' => 27,
                'code' => 4140,
                'name' => 'HOTELES Y RESTAURANTES',
                'total_amount' => 0
            ),
            230 =>
            array(
                'id' => 231,
                'account_group_id' => 27,
                'code' => 4145,
                'name' => 'TRANSPORTE, ALMACENAMIENTO Y COMUNICACIONES',
                'total_amount' => 0
            ),
            231 =>
            array(
                'id' => 232,
                'account_group_id' => 27,
                'code' => 4150,
                'name' => 'ACTIVIDAD FINANCIERA',
                'total_amount' => 0
            ),
            232 =>
            array(
                'id' => 233,
                'account_group_id' => 27,
                'code' => 4155,
                'name' => 'ACTIVIDADES INMOBILIARIAS, EMPRESARIALES Y DE ALQUILER',
                'total_amount' => 0
            ),
            233 =>
            array(
                'id' => 234,
                'account_group_id' => 27,
                'code' => 4160,
                'name' => 'ENSEÑANZA',
                'total_amount' => 0
            ),
            234 =>
            array(
                'id' => 235,
                'account_group_id' => 27,
                'code' => 4165,
                'name' => 'SERVICIOS SOCIALES Y DE SALUD',
                'total_amount' => 0
            ),
            235 =>
            array(
                'id' => 236,
                'account_group_id' => 27,
                'code' => 4170,
                'name' => 'OTRAS ACTIVIDADES DE SERVICIOS COMUNITARIOS, SOCIALES Y PERSONALES',
                'total_amount' => 0
            ),
            236 =>
            array(
                'id' => 237,
                'account_group_id' => 27,
                'code' => 4175,
                'name' => 'DEVOLUCIONES EN VENTAS (DB)',
                'total_amount' => 0
            ),
            237 =>
            array(
                'id' => 238,
                'account_group_id' => 28,
                'code' => 4205,
                'name' => 'OTRAS VENTAS',
                'total_amount' => 0
            ),
            238 =>
            array(
                'id' => 239,
                'account_group_id' => 28,
                'code' => 4210,
                'name' => 'FINANCIEROS',
                'total_amount' => 0
            ),
            239 =>
            array(
                'id' => 240,
                'account_group_id' => 28,
                'code' => 4215,
                'name' => 'DIVIDENDOS Y PARTICIPACIONES',
                'total_amount' => 0
            ),
            240 =>
            array(
                'id' => 241,
                'account_group_id' => 28,
                'code' => 4218,
                'name' => 'INGRESOS METODO DE PARTICIPACION',
                'total_amount' => 0
            ),
            241 =>
            array(
                'id' => 242,
                'account_group_id' => 28,
                'code' => 4220,
                'name' => 'ARRENDAMIENTOS',
                'total_amount' => 0
            ),
            242 =>
            array(
                'id' => 243,
                'account_group_id' => 28,
                'code' => 4225,
                'name' => 'COMISIONES',
                'total_amount' => 0
            ),
            243 =>
            array(
                'id' => 244,
                'account_group_id' => 28,
                'code' => 4230,
                'name' => 'HONORARIOS',
                'total_amount' => 0
            ),
            244 =>
            array(
                'id' => 245,
                'account_group_id' => 28,
                'code' => 4235,
                'name' => 'SERVICIOS',
                'total_amount' => 0
            ),
            245 =>
            array(
                'id' => 246,
                'account_group_id' => 28,
                'code' => 4240,
                'name' => 'UTILIDAD EN VENTA DE INVERSIONES',
                'total_amount' => 0
            ),
            246 =>
            array(
                'id' => 247,
                'account_group_id' => 28,
                'code' => 4245,
                'name' => 'UTILIDAD EN VENTA DE PROPIEDADES PLANTA Y EQUIPO',
                'total_amount' => 0
            ),
            247 =>
            array(
                'id' => 248,
                'account_group_id' => 28,
                'code' => 4248,
                'name' => 'UTILIDAD EN VENTA DE OTROS BIENES',
                'total_amount' => 0
            ),
            248 =>
            array(
                'id' => 249,
                'account_group_id' => 28,
                'code' => 4250,
                'name' => 'RECUPERACIONES',
                'total_amount' => 0
            ),
            249 =>
            array(
                'id' => 250,
                'account_group_id' => 28,
                'code' => 4255,
                'name' => 'INDEMNIZACIONES',
                'total_amount' => 0
            ),
            250 =>
            array(
                'id' => 251,
                'account_group_id' => 28,
                'code' => 4260,
                'name' => 'PARTICIPACIONES EN CONCESIONES',
                'total_amount' => 0
            ),
            251 =>
            array(
                'id' => 252,
                'account_group_id' => 28,
                'code' => 4265,
                'name' => 'INGRESOS DE EJERCICIOS ANTERIORES',
                'total_amount' => 0
            ),
            252 =>
            array(
                'id' => 253,
                'account_group_id' => 28,
                'code' => 4275,
                'name' => 'DEVOLUCIONES EN OTRAS VENTAS (DB)',
                'total_amount' => 0
            ),
            253 =>
            array(
                'id' => 254,
                'account_group_id' => 28,
                'code' => 4295,
                'name' => 'DIVERSOS',
                'total_amount' => 0
            ),
            254 =>
            array(
                'id' => 255,
                'account_group_id' => 29,
                'code' => 4705,
                'name' => 'CORRECCION MONETARIA',
                'total_amount' => 0
            ),
            255 =>
            array(
                'id' => 256,
                'account_group_id' => 30,
                'code' => 5105,
                'name' => 'GASTOS DE PERSONAL',
                'total_amount' => 0
            ),
            256 =>
            array(
                'id' => 257,
                'account_group_id' => 30,
                'code' => 5110,
                'name' => 'HONORARIOS',
                'total_amount' => 0
            ),
            257 =>
            array(
                'id' => 258,
                'account_group_id' => 30,
                'code' => 5115,
                'name' => 'IMPUESTOS',
                'total_amount' => 0
            ),
            258 =>
            array(
                'id' => 259,
                'account_group_id' => 30,
                'code' => 5120,
                'name' => 'ARRENDAMIENTOS',
                'total_amount' => 0
            ),
            259 =>
            array(
                'id' => 260,
                'account_group_id' => 30,
                'code' => 5125,
                'name' => 'CONTRIBUCIONES Y AFILIACIONES',
                'total_amount' => 0
            ),
            260 =>
            array(
                'id' => 261,
                'account_group_id' => 30,
                'code' => 5130,
                'name' => 'SEGUROS',
                'total_amount' => 0
            ),
            261 =>
            array(
                'id' => 262,
                'account_group_id' => 30,
                'code' => 5135,
                'name' => 'SERVICIOS',
                'total_amount' => 0
            ),
            262 =>
            array(
                'id' => 263,
                'account_group_id' => 30,
                'code' => 5140,
                'name' => 'GASTOS LEGALES',
                'total_amount' => 0
            ),
            263 =>
            array(
                'id' => 264,
                'account_group_id' => 30,
                'code' => 5145,
                'name' => 'MANTENIMIENTO Y REPARACIONES',
                'total_amount' => 0
            ),
            264 =>
            array(
                'id' => 265,
                'account_group_id' => 30,
                'code' => 5150,
                'name' => 'ADECUACION E INSTALACION',
                'total_amount' => 0
            ),
            265 =>
            array(
                'id' => 266,
                'account_group_id' => 30,
                'code' => 5155,
                'name' => 'GASTOS DE VIAJE',
                'total_amount' => 0
            ),
            266 =>
            array(
                'id' => 267,
                'account_group_id' => 30,
                'code' => 5160,
                'name' => 'DEPRECIACIONES',
                'total_amount' => 0
            ),
            267 =>
            array(
                'id' => 268,
                'account_group_id' => 30,
                'code' => 5165,
                'name' => 'AMORTIZACIONES',
                'total_amount' => 0
            ),
            268 =>
            array(
                'id' => 269,
                'account_group_id' => 30,
                'code' => 5195,
                'name' => 'DIVERSOS',
                'total_amount' => 0
            ),
            269 =>
            array(
                'id' => 270,
                'account_group_id' => 30,
                'code' => 5199,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            270 =>
            array(
                'id' => 271,
                'account_group_id' => 31,
                'code' => 5205,
                'name' => 'GASTOS DE PERSONAL',
                'total_amount' => 0
            ),
            271 =>
            array(
                'id' => 272,
                'account_group_id' => 31,
                'code' => 5210,
                'name' => 'HONORARIOS',
                'total_amount' => 0
            ),
            272 =>
            array(
                'id' => 273,
                'account_group_id' => 31,
                'code' => 5215,
                'name' => 'IMPUESTOS',
                'total_amount' => 0
            ),
            273 =>
            array(
                'id' => 274,
                'account_group_id' => 31,
                'code' => 5220,
                'name' => 'ARRENDAMIENTOS',
                'total_amount' => 0
            ),
            274 =>
            array(
                'id' => 275,
                'account_group_id' => 31,
                'code' => 5225,
                'name' => 'CONTRIBUCIONES Y AFILIACIONES',
                'total_amount' => 0
            ),
            275 =>
            array(
                'id' => 276,
                'account_group_id' => 31,
                'code' => 5230,
                'name' => 'SEGUROS',
                'total_amount' => 0
            ),
            276 =>
            array(
                'id' => 277,
                'account_group_id' => 31,
                'code' => 5235,
                'name' => 'SERVICIOS',
                'total_amount' => 0
            ),
            277 =>
            array(
                'id' => 278,
                'account_group_id' => 31,
                'code' => 5240,
                'name' => 'GASTOS LEGALES',
                'total_amount' => 0
            ),
            278 =>
            array(
                'id' => 279,
                'account_group_id' => 31,
                'code' => 5245,
                'name' => 'MANTENIMIENTO Y REPARACIONES',
                'total_amount' => 0
            ),
            279 =>
            array(
                'id' => 280,
                'account_group_id' => 31,
                'code' => 5250,
                'name' => 'ADECUACION E INSTALACION',
                'total_amount' => 0
            ),
            280 =>
            array(
                'id' => 281,
                'account_group_id' => 31,
                'code' => 5255,
                'name' => 'GASTOS DE VIAJE',
                'total_amount' => 0
            ),
            281 =>
            array(
                'id' => 282,
                'account_group_id' => 31,
                'code' => 5260,
                'name' => 'DEPRECIACIONES',
                'total_amount' => 0
            ),
            282 =>
            array(
                'id' => 283,
                'account_group_id' => 31,
                'code' => 5265,
                'name' => 'AMORTIZACIONES',
                'total_amount' => 0
            ),
            283 =>
            array(
                'id' => 284,
                'account_group_id' => 31,
                'code' => 5270,
                'name' => 'FINANCIEROS - REAJUSTE DEL SISTEMA',
                'total_amount' => 0
            ),
            284 =>
            array(
                'id' => 285,
                'account_group_id' => 31,
                'code' => 5275,
                'name' => 'PERDIDAS METODO DE PARTICIPACION',
                'total_amount' => 0
            ),
            285 =>
            array(
                'id' => 286,
                'account_group_id' => 31,
                'code' => 5295,
                'name' => 'DIVERSOS',
                'total_amount' => 0
            ),
            286 =>
            array(
                'id' => 287,
                'account_group_id' => 31,
                'code' => 5299,
                'name' => 'PROVISIONES',
                'total_amount' => 0
            ),
            287 =>
            array(
                'id' => 288,
                'account_group_id' => 32,
                'code' => 5305,
                'name' => 'FINANCIEROS',
                'total_amount' => 0
            ),
            288 =>
            array(
                'id' => 289,
                'account_group_id' => 32,
                'code' => 5310,
                'name' => 'PERDIDA EN VENTA Y RETIRO DE BIENES',
                'total_amount' => 0
            ),
            289 =>
            array(
                'id' => 290,
                'account_group_id' => 32,
                'code' => 5313,
                'name' => 'PERDIDAS METODO DE PARTICIPACION',
                'total_amount' => 0
            ),
            290 =>
            array(
                'id' => 291,
                'account_group_id' => 32,
                'code' => 5315,
                'name' => 'GASTOS EXTRAORDINARIOS',
                'total_amount' => 0
            ),
            291 =>
            array(
                'id' => 292,
                'account_group_id' => 32,
                'code' => 5395,
                'name' => 'GASTOS DIVERSOS',
                'total_amount' => 0
            ),
            292 =>
            array(
                'id' => 293,
                'account_group_id' => 33,
                'code' => 5405,
                'name' => 'IMPUESTO DE RENTA Y COMPLEMENTARIOS',
                'total_amount' => 0
            ),
            293 =>
            array(
                'id' => 294,
                'account_group_id' => 34,
                'code' => 5905,
                'name' => 'GANANCIAS Y PERDIDAS',
                'total_amount' => 0
            ),
            294 =>
            array(
                'id' => 295,
                'account_group_id' => 35,
                'code' => 6105,
                'name' => 'AGRICULTURA, GANADERIA, CAZA Y SILVICULTURA',
                'total_amount' => 0
            ),
            295 =>
            array(
                'id' => 296,
                'account_group_id' => 35,
                'code' => 6110,
                'name' => 'PESCA',
                'total_amount' => 0
            ),
            296 =>
            array(
                'id' => 297,
                'account_group_id' => 35,
                'code' => 6115,
                'name' => 'EXPLOTACION DE MINAS Y CANTERAS',
                'total_amount' => 0
            ),
            297 =>
            array(
                'id' => 298,
                'account_group_id' => 35,
                'code' => 6120,
                'name' => 'INDUSTRIAS MANUFACTURERAS',
                'total_amount' => 0
            ),
            298 =>
            array(
                'id' => 299,
                'account_group_id' => 35,
                'code' => 6125,
                'name' => 'SUMINISTRO DE ELECTRICIDAD, GAS Y AGUA',
                'total_amount' => 0
            ),
            299 =>
            array(
                'id' => 300,
                'account_group_id' => 35,
                'code' => 6130,
                'name' => 'CONSTRUCCION',
                'total_amount' => 0
            ),
            300 =>
            array(
                'id' => 301,
                'account_group_id' => 35,
                'code' => 6135,
                'name' => 'COMERCIO AL POR MAYOR Y AL POR MENOR',
                'total_amount' => 0
            ),
            301 =>
            array(
                'id' => 302,
                'account_group_id' => 35,
                'code' => 6140,
                'name' => 'HOTELES Y RESTAURANTES',
                'total_amount' => 0
            ),
            302 =>
            array(
                'id' => 303,
                'account_group_id' => 35,
                'code' => 6145,
                'name' => 'TRANSPORTE, ALMACENAMIENTO Y COMUNICACIONES',
                'total_amount' => 0
            ),
            303 =>
            array(
                'id' => 304,
                'account_group_id' => 35,
                'code' => 6150,
                'name' => 'ACTIVIDAD FINANCIERA',
                'total_amount' => 0
            ),
            304 =>
            array(
                'id' => 305,
                'account_group_id' => 35,
                'code' => 6155,
                'name' => 'ACTIVIDADES INMOBILIARIAS, EMPRESARIALES Y DE ALQUILER',
                'total_amount' => 0
            ),
            305 =>
            array(
                'id' => 306,
                'account_group_id' => 35,
                'code' => 6160,
                'name' => 'ENSEÑANZA',
                'total_amount' => 0
            ),
            306 =>
            array(
                'id' => 307,
                'account_group_id' => 35,
                'code' => 6165,
                'name' => 'SERVICIOS SOCIALES Y DE SALUD',
                'total_amount' => 0
            ),
            307 =>
            array(
                'id' => 308,
                'account_group_id' => 35,
                'code' => 6170,
                'name' => 'OTRAS ACTIVIDADES DE SERVICIOS COMUNITARIOS, SOCIALES Y PERSONALES',
                'total_amount' => 0
            ),
            308 =>
            array(
                'id' => 309,
                'account_group_id' => 36,
                'code' => 6205,
                'name' => 'DE MERCANCIAS',
                'total_amount' => 0
            ),
            309 =>
            array(
                'id' => 310,
                'account_group_id' => 36,
                'code' => 6210,
                'name' => 'DE MATERIAS PRIMAS',
                'total_amount' => 0
            ),
            310 =>
            array(
                'id' => 311,
                'account_group_id' => 36,
                'code' => 6215,
                'name' => 'DE MATERIALES INDIRECTOS',
                'total_amount' => 0
            ),
            311 =>
            array(
                'id' => 312,
                'account_group_id' => 36,
                'code' => 6220,
                'name' => 'COMPRA DE ENERGIA',
                'total_amount' => 0
            ),
            312 =>
            array(
                'id' => 313,
                'account_group_id' => 36,
                'code' => 6225,
                'name' => 'DEVOLUCIONES  EN COMPRAS (CR)',
                'total_amount' => 0
            ),
            313 =>
            array(
                'id' => 314,
                'account_group_id' => 41,
                'code' => 8105,
                'name' => 'BIENES Y VALORES ENTREGADOS EN CUSTODIA',
                'total_amount' => 0
            ),
            314 =>
            array(
                'id' => 315,
                'account_group_id' => 41,
                'code' => 8110,
                'name' => 'BIENES Y VALORES ENTREGADOS EN GARANTIA',
                'total_amount' => 0
            ),
            315 =>
            array(
                'id' => 316,
                'account_group_id' => 41,
                'code' => 8115,
                'name' => 'BIENES Y VALORES EN PODER DE TERCEROS',
                'total_amount' => 0
            ),
            316 =>
            array(
                'id' => 317,
                'account_group_id' => 41,
                'code' => 8120,
                'name' => 'LITIGIOS Y/O DEMANDAS',
                'total_amount' => 0
            ),
            317 =>
            array(
                'id' => 318,
                'account_group_id' => 41,
                'code' => 8125,
                'name' => 'PROMESAS DE COMPRAVENTA',
                'total_amount' => 0
            ),
            318 =>
            array(
                'id' => 319,
                'account_group_id' => 41,
                'code' => 8195,
                'name' => 'DIVERSAS',
                'total_amount' => 0
            ),
            319 =>
            array(
                'id' => 320,
                'account_group_id' => 43,
                'code' => 8305,
                'name' => 'BIENES RECIBIDOS EN ARRENDAMIENTO FINANCIERO',
                'total_amount' => 0
            ),
            320 =>
            array(
                'id' => 321,
                'account_group_id' => 43,
                'code' => 8310,
                'name' => 'TITULOS DE INVERSION NO COLOCADOS',
                'total_amount' => 0
            ),
            321 =>
            array(
                'id' => 322,
                'account_group_id' => 43,
                'code' => 8315,
                'name' => 'PROPIEDADES PLANTA Y EQUIPO TOTALMENTE DEPRECIADOS, AGOTADOS Y/O AMORTIZADOS',
                'total_amount' => 0
            ),
            322 =>
            array(
                'id' => 323,
                'account_group_id' => 43,
                'code' => 8320,
                'name' => 'CREDITOS A FAVOR NO UTILIZADOS',
                'total_amount' => 0
            ),
            323 =>
            array(
                'id' => 324,
                'account_group_id' => 43,
                'code' => 8325,
                'name' => 'ACTIVOS CASTIGADOS',
                'total_amount' => 0
            ),
            324 =>
            array(
                'id' => 325,
                'account_group_id' => 43,
                'code' => 8330,
                'name' => 'TITULOS DE INVERSION AMORTIZADOS',
                'total_amount' => 0
            ),
            325 =>
            array(
                'id' => 326,
                'account_group_id' => 43,
                'code' => 8335,
                'name' => 'CAPITALIZACION POR REVALORIZACION DE PATRIMONIO',
                'total_amount' => 0
            ),
            326 =>
            array(
                'id' => 327,
                'account_group_id' => 43,
                'code' => 8395,
                'name' => 'OTRAS CUENTAS DEUDORAS DE CONTROL',
                'total_amount' => 0
            ),
            327 =>
            array(
                'id' => 328,
                'account_group_id' => 43,
                'code' => 8399,
                'name' => 'AJUSTES POR INFLACION ACTIVOS',
                'total_amount' => 0
            ),
            328 =>
            array(
                'id' => 329,
                'account_group_id' => 47,
                'code' => 9105,
                'name' => 'BIENES Y VALORES RECIBIDOS EN CUSTODIA',
                'total_amount' => 0
            ),
            329 =>
            array(
                'id' => 330,
                'account_group_id' => 47,
                'code' => 9110,
                'name' => 'BIENES Y VALORES RECIBIDOS EN GARANTIA',
                'total_amount' => 0
            ),
            330 =>
            array(
                'id' => 331,
                'account_group_id' => 47,
                'code' => 9115,
                'name' => 'BIENES Y VALORES RECIBIDOS DE TERCEROS',
                'total_amount' => 0
            ),
            331 =>
            array(
                'id' => 332,
                'account_group_id' => 47,
                'code' => 9120,
                'name' => 'LITIGIOS Y/O DEMANDAS',
                'total_amount' => 0
            ),
            332 =>
            array(
                'id' => 333,
                'account_group_id' => 47,
                'code' => 9125,
                'name' => 'PROMESAS DE COMPRAVENTA',
                'total_amount' => 0
            ),
            333 =>
            array(
                'id' => 334,
                'account_group_id' => 47,
                'code' => 9130,
                'name' => 'CONTRATOS DE ADMINISTRACION DELEGADA',
                'total_amount' => 0
            ),
            334 =>
            array(
                'id' => 335,
                'account_group_id' => 47,
                'code' => 9135,
                'name' => 'CUENTAS EN PARTICIPACION',
                'total_amount' => 0
            ),
            335 =>
            array(
                'id' => 336,
                'account_group_id' => 47,
                'code' => 9195,
                'name' => 'OTRAS RESPONSABILIDADES CONTINGENTES',
                'total_amount' => 0
            ),
            336 =>
            array(
                'id' => 337,
                'account_group_id' => 49,
                'code' => 9305,
                'name' => 'CONTRATOS DE ARRENDAMIENTO FINANCIERO',
                'total_amount' => 0
            ),
            337 =>
            array(
                'id' => 338,
                'account_group_id' => 49,
                'code' => 9395,
                'name' => 'OTRAS CUENTAS DE ORDEN ACREEDORAS DE CONTROL',
                'total_amount' => 0
            ),
            338 =>
            array(
                'id' => 339,
                'account_group_id' => 49,
                'code' => 9399,
                'name' => 'AJUSTES POR INFLACION PATRIMONIO',
                'total_amount' => 0
            ),
        ));
    }
}

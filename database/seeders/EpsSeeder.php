<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eps')->delete();

        DB::table('eps')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'COOSALUD EPS-S',
                'code' => 'ESS024 - EPS042',
                'code_movility' => 'ESSC24 - EPSS42',
                'nit' => '900226715',
                'regime' => 'AMBOS REGÍMENES',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'NUEVA EPS',
                'code' => 'ESS024 - EPS042',
                'code_movility' => 'EPSS37 - EPS041',
                'nit' => '900156264',
                'regime' => 'AMBOS REGÍMENES',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'MUTUAL SER',
                'code' => 'ESS207 - EPS048',
                'code_movility' => 'ESSC07 - EPSS48',
                'nit' => '806008394',
                'regime' => 'AMBOS REGÍMENES',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'ALIANSALUD EPS',
                'code' => 'EPS001',
                'code_movility' => 'EPSS01',
                'nit' => '830113831',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'SALUD TOTAL EPS S.A.',
                'code' => 'EPS002',
                'code_movility' => 'EPSS02',
                'nit' => '800130907',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'EPS SANITAS',
                'code' => 'EPS005',
                'code_movility' => 'EPSS05',
                'nit' => '800251440',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'EPS SURA',
                'code' => 'EPS010',
                'code_movility' => 'EPSS10',
                'nit' => '800088702',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'FAMISANAR',
                'code' => 'EPS017',
                'code_movility' => 'EPSS17',
                'nit' => '830003564',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'SERVICIO OCCIDENTAL DE SALUD EPS SOS',
                'code' => 'EPS018',
                'code_movility' => 'EPSS18',
                'nit' => '805001157',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'SALUD MIA',
                'code' => 'EPS046',
                'code_movility' => 'EPSS46',
                'nit' => '900914254',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'COMFENALCO VALLE',
                'code' => 'EPS012',
                'code_movility' => 'EPSS12',
                'nit' => '890303093',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'COMPENSAR EPS',
                'code' => 'EPS008',
                'code_movility' => 'EPSS08',
                'nit' => '860066942',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'EPM - EMPRESAS PUBLICAS DE MEDELLIN',
                'code' => 'EAS016',
                'code_movility' => 'N/A',
                'nit' => '890904996',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA',
                'code' => 'EAS027',
                'code_movility' => 'N/A',
                'nit' => '800112806',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'CAJACOPI ATLANTICO',
                'code' => 'CCF055',
                'code_movility' => 'CCFC55',
                'nit' => '890102044',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'CAPRESOCA',
                'code' => 'EPS025',
                'code_movility' => 'EPSC25',
                'nit' => '891856000',
                'regime' => 'SUBSIDIADO'
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'COMFACHOCO',
                'code' => 'CCF102',
                'code_movility' => 'CCFC20',
                'nit' => '891600091',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'COMFAORIENTE',
                'code' => 'CCF050',
                'code_movility' => 'CCFC50',
                'nit' => '890500675',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'EPS FAMILIAR DE COLOMBIA',
                'code' => 'CCF033',
                'code_movility' => 'CCFC33',
                'nit' => '901543761',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'ASMET SALUD',
                'code' => 'ESS062',
                'code_movility' => 'ESSC62',
                'nit' => '900935126',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'EMSSANAR E.S.S.',
                'code' => 'ESS118',
                'code_movility' => 'ESSC18',
                'nit' => '901021565',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'CAPITAL SALUD EPS-S',
                'code' => 'EPSS34',
                'code_movility' => 'EPSC34',
                'nit' => '900298372',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'SAVIA SALUD EPS',
                'code' => 'EPSS40',
                'code_movility' => 'EPS040',
                'nit' => '900604350',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'DUSAKAWI EPSI',
                'code' => 'EPSI01',
                'code_movility' => 'EPSIC1',
                'nit' => '824001398',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'ASOCIACION INDIGENA DEL CAUCA EPSI',
                'code' => 'EPSI03',
                'code_movility' => 'EPSIC3',
                'nit' => '817001773',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'ANAS WAYUU EPSI',
                'code' => 'EPSI04',
                'code_movility' => 'EPSIC4',
                'nit' => '839000495',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'MALLAMAS EPSI',
                'code' => 'EPSI05',
                'code_movility' => 'EPSIC5',
                'nit' => '837000084',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'PIJAOS SALUD EPSI',
                'code' => 'EPSI06',
                'code_movility' => 'EPSIC6',
                'nit' => '809008362',
                'regime' => 'SUBSIDIADO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'SALUD BÓLIVAR EPS SAS',
                'code' => 'EPS047',
                'code_movility' => 'EPSS47',
                'nit' => '901438242',
                'regime' => 'CONTRIBUTIVO',
                'created_at' => '2023-10-12 21:07:43',
                'updated_at' => '2023-10-12 21:07:43'
            ),
        ));
    }
}

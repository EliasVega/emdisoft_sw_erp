<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->delete();

        DB::table('document_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '01',
                'name' => 'Factura de Venta Nacional',
                'prefix' => 'FV',
                'cufe_algorithm' => 'CUFE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '02',
                'name' => 'Factura de Exportación',
                'prefix' => 'FV',
                'cufe_algorithm' => 'CUFE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '03',
                'name' => 'Factura de Contingencia',
                'prefix' => 'FV',
                'cufe_algorithm' => 'CUDE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '91',
                'name' => 'Nota Crédito',
                'prefix' => 'NC',
                'cufe_algorithm' => 'CUDE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '92',
                'name' => 'Nota Débito',
                'prefix' => 'ND',
                'cufe_algorithm' => 'CUDE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '',
                'name' => 'ZIP',
                'prefix' => 'z',
                'cufe_algorithm' => '',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '89',
                'name' => 'AttachedDocument',
                'prefix' => 'AT',
                'cufe_algorithm' => '',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '88',
                'name' => 'ApplicationResponse',
                'prefix' => 'AR',
                'cufe_algorithm' => 'CUDE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '1',
                'name' => 'Nomina Individual',
                'prefix' => 'NI',
                'cufe_algorithm' => 'CUNE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '2',
                'name' => 'Nomina Individual de Ajuste',
                'prefix' => 'NA',
                'cufe_algorithm' => 'CUNE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '05',
                'name' => 'Documento Soporte Electrónico',
                'prefix' => 'DSE',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '04',
                'name' => 'Factura electrónica de Venta - tipo 04',
                'prefix' => 'FV',
                'cufe_algorithm' => 'CUFE-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '95',
                'name' => 'Nota de Ajuste al Documento Soporte Electrónico',
                'prefix' => 'NDS',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            13 =>
            array (
                'id' => 25,
                'code' => '991',
                'name' => 'Factura de Compra A obligados a Facturar',
                'prefix' => 'DSE',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            14 =>
            array (
                'id' => 26,
                'code' => '992',
                'name' => 'Nota Credito Factura de compra',
                'prefix' => 'NCFC',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            15 =>
            array (
                'id' => 27,
                'code' => '993',
                'name' => 'Nota Debito Factura de compra',
                'prefix' => 'NDFC',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            16 =>
            array (
                'id' => 28,
                'code' => '994',
                'name' => 'Nota Credito pos',
                'prefix' => 'NCFP',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            17 =>
            array (
                'id' => 29,
                'code' => '995',
                'name' => 'Nota Debito pos',
                'prefix' => 'NDFP',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
        ));
    }
}

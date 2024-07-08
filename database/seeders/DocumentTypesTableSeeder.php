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
                'id' => 14,
                'code' => '96',
                'name' => 'Eventos (ApplicationResponse)',
                'prefix' => '\N',
                'cufe_algorithm' => '\N',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '20',
                'name' => 'Documento equivalente electrónico del tiquete de máquina registradora con sistema P.O.S.',
                'prefix' => 'POS',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '25',
                'name' => 'Boleta de ingreso a cine',
                'prefix' => 'CIN',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '27',
                'name' => 'Boleta de ingreso a espectáculos públicos',
                'prefix' => 'ESP',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '30',
                'name' => 'Documento en juegos localizados y no localizados - relación diaria de control de ventas',
                'prefix' => 'JUE',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '35',
                'name' => 'Tiquete de transporte de pasajeros Terrestre',
                'prefix' => 'TTR',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            19 =>
            array (
                'id' => 20,
                'code' => '40',
                'name' => 'Documento expedido para el cobro de peajes',
                'prefix' => 'PJS',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            20 =>
            array (
                'id' => 21,
                'code' => '45',
                'name' => 'Extracto Expedido por Sociedades Financieras y Fondos',
                'prefix' => 'EXT',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            21 =>
            array (
                'id' => 22,
                'code' => '50',
                'name' => 'Tiquete de Billete de Transporte Aéreo de Pasajeros',
                'prefix' => 'TAE',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            22 =>
            array (
                'id' => 23,
                'code' => '55',
                'name' => 'Documento de Operación de Bolsa de Valores, Agropecuaria y de Otros Comodities',
                'prefix' => 'BLS',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            23 =>
            array (
                'id' => 24,
                'code' => '60',
                'name' => 'Documento Expedido para los Servicios Públicos y Domiciliarios',
                'prefix' => 'SRV',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            24 =>
            array (
                'id' => 25,
                'code' => '60',
                'name' => 'Nota de Ajuste de tipo debito al Documento Equivalente',
                'prefix' => 'NDQ',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            25 =>
            array (
                'id' => 26,
                'code' => '60',
                'name' => 'Nota de Ajuste de tipo crédito al Documento Equivalente',
                'prefix' => 'NCQ',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            26 =>
            array (
                'id' => 101,
                'code' => '101',
                'name' => 'Factura de Compra A obligados a Facturar',
                'prefix' => 'DSE',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            27 =>
            array (
                'id' => 102,
                'code' => '102',
                'name' => 'Nota Credito Factura de compra',
                'prefix' => 'NCFC',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            28 =>
            array (
                'id' => 103,
                'code' => '103',
                'name' => 'Nota Debito Factura de compra',
                'prefix' => 'NDFC',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            29 =>
            array (
                'id' => 104,
                'code' => '104',
                'name' => 'POS No envio dian',
                'prefix' => 'POST',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            30 =>
            array (
                'id' => 105,
                'code' => '104',
                'name' => 'Nota Credito pos Interna',
                'prefix' => 'NCFP',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            31 =>
            array (
                'id' => 106,
                'code' => '105',
                'name' => 'Nota Debito pos Interna',
                'prefix' => 'NDFP',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2023-01-12 21:07:44',
                'updated_at' => '2023-01-12 21:07:44',
            ),
            32 =>
            array (
                'id' => 107,
                'code' => '107',
                'name' => 'Remisiones',
                'prefix' => 'RMIS',
                'cufe_algorithm' => 'CUDS-SHA384',
                'created_at' => '2024-01-12 21:07:44',
                'updated_at' => '2024-01-12 21:07:44',
            ),
        ));
    }
}

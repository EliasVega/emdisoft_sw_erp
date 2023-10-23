<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('voucher_types')->delete();

        DB::table('voucher_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'FVN',
                'name' => 'Factura de Venta Nacional',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'FVP',
                'name' => 'Factura de Venta Post',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'FVE',
                'name' => 'Factura de Exportación',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'FVC',
                'name' => 'Factura de venta Contingencia',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 'NCV',
                'name' => 'Nota Crédito venta',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'NDV',
                'name' => 'Nota debito venta',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 'FCN',
                'name' => 'Factura de compra Nacional',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 'FCE',
                'name' => 'Factura de Importacion',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 'FCC',
                'name' => 'Factura de compra Contingencia',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'NCC',
                'name' => 'Nota Crédito compra',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 'NDC',
                'name' => 'Nota debito compra',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            11 =>
            array (
                'id' => 12,
                'code' => 'DSE',
                'name' => 'Documento Soporte electronico',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            12 =>
            array (
                'id' => 13,
                'code' => 'NDS',
                'name' => 'Nota de ajuste Documento soporte',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            13 =>
            array (
                'id' => 14,
                'code' => 'NIE',
                'name' => 'Nomina Individual electronica',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            14 =>
            array (
                'id' => 15,
                'code' => 'NNI',
                'name' => 'Nota de ajuste Nomina Individual',
                'consecutive' => 1,
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            15 =>
            array (
                'id' => 16,
                'code' => 'RC',
                'name' => 'Recibo de caja',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            16 =>
            array (
                'id' => 17,
                'code' => 'CE',
                'name' => 'Comprobante de egreso',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            17 =>
            array (
                'id' => 18,
                'code' => 'ANT',
                'name' => 'Anticipo a proveedores, clientes, empleados',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            18 =>
            array (
                'id' => 19,
                'code' => 'FCD',
                'name' => 'Facturas de Compra y documento soporte',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            19 =>
            array (
                'id' => 20,
                'code' => 'FCG',
                'name' => 'Factura de compra por Gastos',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            20 =>
            array (
                'id' => 21,
                'code' => 'NCP',
                'name' => 'Nota Credito factura pos',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            21 =>
            array (
                'id' => 22,
                'code' => 'NDP',
                'name' => 'Nota Debito factura pos',
                'consecutive' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));


    }
}

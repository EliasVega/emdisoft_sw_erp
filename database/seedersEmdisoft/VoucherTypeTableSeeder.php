<?php

namespace Database\Seeders;

use App\Models\VoucherType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                'consecutive' => 1,
                'code' => 'FVN',
                'name' => 'Factura de Venta Nacional',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            1 =>
            array (
                'id' => 2,
                'consecutive' => 1,
                'code' => 'FVP',
                'name' => 'Factura de Venta Post',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            2 =>
            array (
                'id' => 3,
                'consecutive' => 1,
                'code' => 'FVE',
                'name' => 'Factura de Exportación',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            3 =>
            array (
                'id' => 4,
                'consecutive' => 1,
                'code' => 'FVC',
                'name' => 'Factura de venta Contingencia',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            4 =>
            array (
                'id' => 5,
                'consecutive' => 1,
                'code' => 'NCV',
                'name' => 'Nota Crédito venta',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            5 =>
            array (
                'id' => 6,
                'consecutive' => 1,
                'code' => 'NDV',
                'name' => 'Nota debito venta',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            6 =>
            array (
                'id' => 7,
                'consecutive' => 1,
                'code' => 'FCN',
                'name' => 'Factura de compra Nacional',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            7 =>
            array (
                'id' => 8,
                'consecutive' => 1,
                'code' => 'FCE',
                'name' => 'Factura de Importacion',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            8 =>
            array (
                'id' => 9,
                'consecutive' => 1,
                'code' => 'FCC',
                'name' => 'Factura de compra Contingencia',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            9 =>
            array (
                'id' => 10,
                'consecutive' => 1,
                'code' => 'NCC',
                'name' => 'Nota Crédito compra',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            10 =>
            array (
                'id' => 11,
                'consecutive' => 1,
                'code' => 'NDC',
                'name' => 'Nota debito compra',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            11 =>
            array (
                'id' => 12,
                'consecutive' => 1,
                'code' => 'DSE',
                'name' => 'Documento Soporte electronico',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            12 =>
            array (
                'id' => 13,
                'consecutive' => 1,
                'code' => 'NDS',
                'name' => 'Nota de ajuste Documento soporte',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            13 =>
            array (
                'id' => 14,
                'consecutive' => 1,
                'code' => 'NIE',
                'name' => 'Nomina Individual electronica',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            14 =>
            array (
                'id' => 15,
                'consecutive' => 1,
                'code' => 'NNI',
                'name' => 'Nota de ajuste Nomina Individual',
                'status' => 'locked',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            15 =>
            array (
                'id' => 16,
                'consecutive' => 1,
                'code' => 'RC',
                'name' => 'Recibo de caja',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            16 =>
            array (
                'id' => 17,
                'consecutive' => 1,
                'code' => 'CE',
                'name' => 'Comprobante de egreso',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            17 =>
            array (
                'id' => 18,
                'consecutive' => 1,
                'code' => 'ANT',
                'name' => 'Anticipo a proveedores, clientes, empleados',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            18 =>
            array (
                'id' => 19,
                'consecutive' => 1,
                'code' => 'FCD',
                'name' => 'Facturas de Compra y documento soporte',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            19 =>
            array (
                'id' => 20,
                'consecutive' => 1,
                'code' => 'FCG',
                'name' => 'Factura de compra por Gastos',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            20 =>
            array (
                'id' => 21,
                'consecutive' => 1,
                'code' => 'NCP',
                'name' => 'Nota Credito factura pos',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
            21 =>
            array (
                'id' => 22,
                'consecutive' => 1,
                'code' => 'NDP',
                'name' => 'Nota Debito factura pos',
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43'
            ),
        ));
    }
}

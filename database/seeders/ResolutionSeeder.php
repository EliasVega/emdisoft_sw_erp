<?php

namespace Database\Seeders;

use App\Models\Resolution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resolutions')->delete();

        DB::table('resolutions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'prefix' => 'FC',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 1000000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'description' => 'Factura compra local',
                'branch_id' => 1,
                'document_type_id' => 101
            ),
            1 =>
            array (
                'id' => 2,
                'prefix' => 'FCNC',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 1000000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'description' => 'NC Factura compra local',
                'branch_id' => 1,
                'document_type_id' => 102
            ),
            2 =>
            array (
                'id' => 3,
                'prefix' => 'FCND',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 1000000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'description' => 'ND Factura compra local',
                'branch_id' => 1,
                'document_type_id' => 103
            ),
            3 =>
            array (
                'id' => 4,
                'prefix' => 'POST',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 1000000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'description' => 'Factura POS local',
                'branch_id' => 1,
                'document_type_id' => 104
            ),
            4 =>
            array (
                'id' => 5,
                'prefix' => 'NCP',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'description' => 'NC POS local',
                'branch_id' => 1,
                'document_type_id' => 105
            ),
            5 =>
            array (
                'id' => 6,
                'prefix' => 'NDP',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'description' => 'ND POS local',
                'branch_id' => 1,
                'document_type_id' => 106
            ),
            6 =>
            array (
                'id' => 7,
                'prefix' => 'SETP',
                'resolution' => '18760000001',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'fc8eac422eba16e22ffd8c6f94b3f40a6e38162c',
                'start_number' => 990000000,
                'end_number' => 995000000,
                'consecutive' => 990000001,
                'start_date' => '2019-01-19',
                'end_date' => '2030-01-19',
                'status' => 'active',
                'description' => 'Set de pruebas Factura de venta',
                'branch_id' => 1,
                'document_type_id' => 1
            ),
            7 =>
            array (
                'id' => 8,
                'prefix' => 'NC',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => null,
                'start_number' => 1,
                'end_number' => 999999,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'active',
                'description' => 'NC Factura de venta',
                'branch_id' => 1,
                'document_type_id' => 4
            ),
            8 =>
            array (
                'id' => 9,
                'prefix' => 'ND',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => '',
                'start_number' => 1,
                'end_number' => 999999,
                'start_date' => null,
                'consecutive' => 1,
                'end_date' => null,
                'status' => 'active',
                'description' => 'ND Factura de venta',
                'branch_id' => 1,
                'document_type_id' => 5
            ),
            9 =>
            array (
                'id' => 10,
                'prefix' => 'EPOS',
                'resolution' => '18760000001',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'fc8eac422eba16e22ffd8c6f94b3f40a6e38162c',
                'start_number' => 1,
                'end_number' => 1000,
                'consecutive' => 1,
                'start_date' => '2019-01-19',
                'end_date' => '2030-01-19',
                'status' => 'active',
                'description' => 'Set de pruebas Pos Electronico',
                'branch_id' => 1,
                'document_type_id' => 15
            ),
            10 =>
            array (
                'id' => 11,
                'prefix' => 'NCEQ',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => null,
                'start_number' => 1,
                'end_number' => 999999,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'active',
                'description' => 'NC Pos Electronico',
                'branch_id' => 1,
                'document_type_id' => 26
            ),
            11 =>
            array (
                'id' => 12,
                'prefix' => 'NDEQ',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => '',
                'start_number' => 1,
                'end_number' => 999999,
                'start_date' => null,
                'consecutive' => 1,
                'end_date' => null,
                'status' => 'active',
                'description' => 'ND Pos Electronico',
                'branch_id' => 1,
                'document_type_id' => 25
            ),
            12 =>
            array (
                'id' => 13,
                'prefix' => 'FLOC',
                'resolution' => '18760000001',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'local',
                'start_number' => 1,
                'end_number' => 99999999,
                'consecutive' => 1,
                'start_date' => '2019-01-19',
                'end_date' => '2040-01-19',
                'status' => 'active',
                'description' => 'Facturacion en local',
                'branch_id' => 1,
                'document_type_id' => 1
            ),
            12 =>
            array (
                'id' => 13,
                'prefix' => 'FLOC',
                'resolution' => '18760000001',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'local',
                'start_number' => 1,
                'end_number' => 99999999,
                'consecutive' => 1,
                'start_date' => '2019-01-19',
                'end_date' => '2040-01-19',
                'status' => 'active',
                'description' => 'Facturacion en local',
                'branch_id' => 1,
                'document_type_id' => 1
            ),
            13 =>
            array (
                'id' => 14,
                'prefix' => 'RMIS',
                'resolution' => '28761',
                'resolution_date' => '2024-05-06',
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => '2024-05-06',
                'end_date' => '2030-05-06',
                'status' => 'inactive',
                'description' => 'Resolucion de remissiones',
                'branch_id' => 1,
                'document_type_id' => 107
            ),
            14 =>
            array (
                'id' => 15,
                'prefix' => 'NADS',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => null,
                'start_number' => 1,
                'end_number' => 1000,
                'consecutive' => 35,
                'start_date' => null,
                'end_date' => null,
                'status' => 'active',
                'description' => 'NADS',
                'branch_id' => 1,
                'document_type_id' => 13
            ),
        ));
    }
}

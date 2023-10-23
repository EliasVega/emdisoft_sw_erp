<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResolutionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
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
                'resolution' => 'No Aplica',
                'resolution_date' => NULL,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 25,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            1 =>
            array (
                'id' => 2,
                'prefix' => 'FCNC',
                'resolution' => 'No Aplica',
                'resolution_date' => NULL,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 26,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            2 =>
            array (
                'id' => 3,
                'prefix' => 'FCND',
                'resolution' => 'No Aplica',
                'resolution_date' => NULL,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 27,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            3 =>
            array (
                'id' => 4,
                'prefix' => 'POST',
                'resolution' => 'No Aplica',
                'resolution_date' => NULL,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 12,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            4 =>
            array (
                'id' => 5,
                'prefix' => 'NCP',
                'resolution' => 'No Aplica',
                'resolution_date' => NULL,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 28,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            5 =>
            array (
                'id' => 6,
                'prefix' => 'NDP',
                'resolution' => 'No Aplica',
                'resolution_date' => NULL,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 29,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
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
                'company_id' => 1,
                'document_type_id' => 1,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            7 =>
            array (
                'id' => 8,
                'prefix' => 'NC',
                'resolution' => NULL,
                'resolution_date' => NULL,
                'technical_key' => NULL,
                'start_number' => 1,
                'end_number' => 999999,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 4,
                'created_at' => '2023-10-21 07:30:42',
                'updated_at' => '2023-10-21 07:30:42',
            ),
            8 =>
            array (
                'id' => 9,
                'prefix' => 'ND',
                'resolution' => NULL,
                'resolution_date' => NULL,
                'technical_key' => '',
                'start_number' => 1,
                'end_number' => 999999,
                'consecutive' => 1,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 5,
                'created_at' => '2023-10-21 07:30:43',
                'updated_at' => '2023-10-21 07:30:43',
            ),
            9 =>
            array (
                'id' => 10,
                'prefix' => 'ECDS',
                'resolution' => '18764055595885',
                'resolution_date' => '2023-09-06',
                'technical_key' => 'null',
                'start_number' => 701,
                'end_number' => 1000,
                'consecutive' => 701,
                'start_date' => '2023-09-06',
                'end_date' => '2024-03-06',
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 11,
                'created_at' => '2023-10-21 07:30:43',
                'updated_at' => '2023-10-21 07:30:43',
            ),
            10 =>
            array (
                'id' => 11,
                'prefix' => 'NDS',
                'resolution' => NULL,
                'resolution_date' => NULL,
                'technical_key' => NULL,
                'start_number' => 1,
                'end_number' => 1000,
                'consecutive' => 35,
                'start_date' => NULL,
                'end_date' => NULL,
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 13,
                'created_at' => '2023-10-21 07:30:43',
                'updated_at' => '2023-10-21 07:30:43',
            ),
            11 =>
            array (
                'id' => 12,
                'prefix' => 'FVEC',
                'resolution' => '18764050702643',
                'resolution_date' => '2023-06-21',
                'technical_key' => 'edd8c8665026708791fa048afda2adb7ec4fc9520b39522d885dfcf0a80b9939',
                'start_number' => 1501,
                'end_number' => 2000,
                'consecutive' => 1501,
                'start_date' => '2023-06-21',
                'end_date' => '2023-12-21',
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 1,
                'created_at' => '2023-10-21 07:30:43',
                'updated_at' => '2023-10-21 07:30:43',
            ),
        ));


    }
}

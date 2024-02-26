<?php

namespace Database\Seeders;

use App\Models\Resolution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resolutions = [
            [
                'prefix' => 'FC',
                'resolution' => 'No Aplica',
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 25
            ],
            [
                'prefix' => 'FCNC',
                'resolution' => 'No Aplica',
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 26
            ],
            [
                'prefix' => 'FCND',
                'resolution' => 'No Aplica',
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 27
            ],
            [
                'prefix' => 'POST',
                'resolution' => 'No Aplica',
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 12
            ],
            [
                'prefix' => 'NCP',
                'resolution' => 'No Aplica',
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 28
            ],
            [
                'prefix' => 'NDP',
                'resolution' => 'No Aplica',
                'resolution_date' => null,
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
                'company_id' => 1,
                'document_type_id' => 29
            ],
            [
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
                'document_type_id' => 1
            ],
            [
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
                'company_id' => 1,
                'document_type_id' => 4
            ],
            [
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
                'company_id' => 1,
                'document_type_id' => 5
            ],
            [
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
                'document_type_id' => 11
            ],
            [
                'prefix' => 'NDS',
                'resolution' => null,
                'resolution_date' => null,
                'technical_key' => null,
                'start_number' => 1,
                'end_number' => 1000,
                'consecutive' => 35,
                'start_date' => null,
                'end_date' => null,
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 13
            ],
            [
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
                'document_type_id' => 1
            ],
        ];

        foreach ($resolutions as $resolution) {
            Resolution::create($resolution);
        }
    }
}

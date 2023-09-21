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
                'prefix' => 'SETP',
                'resolution' => '18760000001',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'fc8eac422eba16e22ffd8c6f94b3f40a6e38162c',
                'start_number' => 990000000,
                'end_number' => 995000000,
                'consecutive' => 9900000001,
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
                'prefix' => 'DS',
                'resolution' => '1234567890',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => '2019-01-19',
                'end_date' => '2030-01-19',
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 11
            ],
            [
                'prefix' => 'NDS',
                'resolution' => '1234567891',
                'resolution_date' => '2019-01-19',
                'technical_key' => 'null',
                'start_number' => 1,
                'end_number' => 10000,
                'consecutive' => 1,
                'start_date' => null,
                'end_date' => null,
                'status' => 'active',
                'company_id' => 1,
                'document_type_id' => 13
            ]
        ];

        foreach ($resolutions as $resolution) {
            Resolution::create($resolution);
        }
    }
}

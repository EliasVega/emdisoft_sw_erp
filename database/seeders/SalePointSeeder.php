<?php

namespace Database\Seeders;

use App\Models\SalePoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalePointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salePoints = [
            [
                'branch_id' => 1,

                'plate_number'=> 'CVBN2132648',
                'location' => 'Carrera 21 # 99-27 Fontana',
                'cash_type' => 'Principal'
            ]
        ];

        foreach ($salePoints as $salePoint) {
            SalePoint::create($salePoint);
        }
    }
}

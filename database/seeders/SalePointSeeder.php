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
                'location' => 'CR8 11 41 LC 105 BRR CENTRO',
                'cash_type' => 'Principal'
            ]
        ];

        foreach ($salePoints as $salePoint) {
            SalePoint::create($salePoint);
        }
    }
}

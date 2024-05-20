<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicators')->delete();

        DB::table('indicators')->insert(array (
            0 =>
            array (
                'id' => 1,
                'smlv' => 1300000,
                'transport_assistance' => 162000,
                'weekly_hours' => 47,
                'uvt' => 47065,
                'plastic_bag_tax' => 66,
                'dian' => 'off',
                'pos' => 'off',
                'payroll' => 'on',
                'work_labor' => 'on',
                'accounting' => 'on',
                'inventory' => 'on',
                'product_price' => 'automatic',
                'raw_material' => 'off',
                'restaurant' => 'off',
                'barcode' => 'off',
                'company_id' => 1,
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ),
        ));
    }
}

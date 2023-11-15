<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_taxes')->delete();

        DB::table('company_taxes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'IVA EXCENTO',
                'description' => 'productos sin iva',
                'tax_type_id' => 1,
                'percentage_id' => 44,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'INC 8%',
                'description' => 'productos con impuesto al consumo',
                'tax_type_id' => 4,
                'percentage_id' => 45,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

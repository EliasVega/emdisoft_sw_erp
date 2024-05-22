<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubauxiliaryAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subauxiliary_accounts')->delete();

        DB::table('subauxiliary_accounts')->insert(array (
            0 =>
            array(
                'id' => 1,
                'auxiliary_account_id' => 1,
                'code' => 1105050501,
                'name' => 'SUB AUXILIAR ACCOUNT 1',
                'total_amount' => 0
            ),
            1 =>
            array(
                'id' => 2,
                'auxiliary_account_id' => 2,
                'code' => 1105101001,
                'name' => 'SUB AUXILIAR ACCOUNT 1',
                'total_amount' => 0
            ),
        ));
    }
}

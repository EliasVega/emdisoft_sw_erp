<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuxiliaryAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('auxiliary_accounts')->delete();

        DB::table('auxiliary_accounts')->insert(array (
            0 =>
            array(
                'id' => 1,
                'subaccount_id' => 1,
                'code' => 11050505,
                'name' => 'AUXILIAR ACCOUNT 1',
                'total_amount' => 0
            ),
            1 =>
            array(
                'id' => 2,
                'subaccount_id' => 2,
                'code' => 11051010,
                'name' => 'AUXILIAR ACCOUNT 1',
                'total_amount' => 0
            ),
        ));
    }
}

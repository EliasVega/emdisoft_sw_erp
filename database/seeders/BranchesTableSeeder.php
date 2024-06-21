<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->delete();

        DB::table('branches')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Principal',
                'address' => 'CALLE 56 # 3W - 04 BARRIO MUTIS',
                'phone' => '6076410927',
                'mobile' => '3013605882',
                'email' => 'ciudadmutisferreteria@gmail.com',
                'manager' => 'CONTRERAS SEGUNDO JAVIER',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

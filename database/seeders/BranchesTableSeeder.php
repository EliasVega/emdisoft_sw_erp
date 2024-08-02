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
                'name' => 'Monteredondo',
                'address' => 'CL 61 3 W 04 BRR MUTIS',
                'phone' => '3224599940',
                'mobile' => '3224599940',
                'email' => 'oviedoraul3@gmail.com',
                'manager' => 'BRACHA MATZA S.A.S',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2024-07-31 21:07:43',
                'updated_at' => '2024-07-31 21:07:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Provenza',
                'address' => 'CL 61 3 W 04 BRR MUTIS',
                'phone' => '6414355',
                'mobile' => '6414355',
                'email' => 'oviedoraul32@gmail.com',
                'manager' => 'BRACHA MATZA S.A.S',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2024-07-31 21:07:43',
                'updated_at' => '2024-07-31 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Real de minas',
                'address' => 'CL 61 3 W 04 BRR MUTIS',
                'phone' => '6414355',
                'mobile' => '6414355',
                'email' => 'oviedoraul33@gmail.com',
                'manager' => 'BRACHA MATZA S.A.S',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2024-07-31 21:07:43',
                'updated_at' => '2024-07-31 21:07:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Cuatro',
                'address' => 'CL 61 3 W 04 BRR MUTIS',
                'phone' => '6414355',
                'mobile' => '6414355',
                'email' => 'oviedoraul34@gmail.com',
                'manager' => 'BRACHA MATZA S.A.S',
                'department_id' => 21,
                'municipality_id' => 846,
                'postal_code_id' => 2733,
                'company_id' => 1,
                'created_at' => '2024-07-31 21:07:43',
                'updated_at' => '2024-07-31 21:07:43',
            ),
        ));
    }
}

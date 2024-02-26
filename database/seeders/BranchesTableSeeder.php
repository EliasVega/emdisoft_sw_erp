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
                'address' => 'CR 3 A CL 9 A ESQ BRR EL PROGRESO',
                'phone' => '3104554739',
                'mobile' => '3104554739',
                'email' => 'cajuva0357@hotmail.com',
                'manager' => 'VALDERRAMA CUELLAR CARLOS JULIO',
                'department_id' => 27,
                'municipality_id' => 1080,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSubtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_subtypes')->delete();

        DB::table('employee_subtypes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '00',
                'name' => 'No Aplica',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '01',
                'name' => 'Dependiente pensionado por vejez activo',
            ),
        ));
    }
}

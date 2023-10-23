<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSubtypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
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
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '01',
                'name' => 'Dependiente pensionado por vejez activo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}

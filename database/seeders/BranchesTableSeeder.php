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
                'address' => 'CL 6 NORTE 4 200 MZ J CA 6 CONJ JUNIN I I',
                'phone' => '3107971721',
                'mobile' => '3107971721',
                'email' => 'franciscopedrazaa@gmail.com',
                'manager' => 'FRANCISCO PEDRAZA GOMEZ',
                'department_id' => 21,
                'municipality_id' => 906,
                'postal_code_id' => 2762,
                'company_id' => 1,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_types')->delete();

        DB::table('employee_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '01',
                'name' => 'Dependiente',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '02',
                'name' => 'Servicio domestico',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '04',
                'name' => 'Madre comunitaria',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '12',
                'name' => 'Aprendices del Sena en etapa lectiva',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '18',
                'name' => 'Funcionarios públicos sin tope máximo de ibc',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '19',
                'name' => 'Aprendices del SENA en etapa productiva',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '21',
                'name' => 'Estudiantes de postgrado en salud',
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '22',
                'name' => 'Profesor de establecimiento particular',
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '23',
                'name' => 'Estudiantes aportes solo riesgos laborales',
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '30',
                'name' => 'Dependiente entidades o universidades públicas con régimen especial en salud',
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '31',
                'name' => 'Cooperados o pre cooperativas de trabajo asociado',
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '47',
                'name' => 'Trabajador dependiente de entidad beneficiaria del sistema general de participaciones - aportes patronales',
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '51',
                'name' => 'Trabajador de tiempo parcial',
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '54',
                'name' => 'Pre pensionado de entidad en liquidación.',
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '56',
                'name' => 'Pre pensionado con aporte voluntario a salud',
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '58',
                'name' => 'Estudiantes de prácticas laborales en el sector público',
            ),
        ));
    }
}

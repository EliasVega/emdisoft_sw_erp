<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->delete();

        DB::table('employees')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ELIAS VEGA DELGADO',
                'identification' => '91260182',
                'address' => 'CR 21 99 27 FONTANA',
                'phone' => '3168886468',
                'email' => 'discom.is@gmail.com',
                'code' => '91260182',
                'salary' => '5000000.00',
                'commission' => 70,
                'admission_date' => '2023-01-12',
                'account_type' => 'ahorros',
                'account_number' => '123456789',
                'status' => 'active',

                'branch_id' => 1,
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'employee_type_id' => 1,
                'employee_subtype_id' => 1,
                'payment_frecuency_id' => 5,
                'contrat_type_id' => 1,
                'charge_id' => 1,
                'payment_method_id' => 47,
                'bank_id' => 5,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),

            1 =>
            array (
                'id' => 2,
                'name' => 'JAIRO ENRIQUE SUAREZ PEREZ',
                'identification' => '91343991',
                'address' => 'CL 59 1W 70 MUTIS',
                'phone' => '3014109204',
                'email' => 'comercial.ecounts@gmail.com',
                'code' => '91343991',
                'salary' => '1300000.00',
                'commission' => 60,
                'admission_date' => '2023-01-12',
                'account_type' => 'ahorros',
                'account_number' => '123456785',
                'status' => 'active',

                'branch_id' => 1,
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'employee_type_id' => 1,
                'employee_subtype_id' => 1,
                'payment_frecuency_id' => 5,
                'contrat_type_id' => 1,
                'charge_id' => 1,
                'payment_method_id' => 47,
                'bank_id' => 5,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'ARNULFO VALDIVIESO REY',
                'identification' => '91283760',
                'address' => 'CR 5 48 13',
                'phone' => '3152689929',
                'email' => 'arnulfov@gmail.com',
                'code' => '91283760',
                'salary' => '1300000.00',
                'commission' => 50,
                'admission_date' => '2023-01-12',
                'account_type' => 'ahorros',
                'account_number' => '123456786',
                'status' => 'active',

                'branch_id' => 1,
                'department_id' => 21,
                'municipality_id' => 846,
                'identification_type_id' => 3,
                'employee_type_id' => 1,
                'employee_subtype_id' => 1,
                'payment_frecuency_id' => 5,
                'contrat_type_id' => 1,
                'charge_id' => 1,
                'payment_method_id' => 47,
                'bank_id' => 5,
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
            ),
        ));
    }
}

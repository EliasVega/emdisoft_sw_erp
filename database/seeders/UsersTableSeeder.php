<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'ELIAS VEGA DELGADO',
            'number' => '91260182',
            'address' => 'Carrera 21 # 99-27 Fontana',
            'phone' => '3168886468',
            'email' => 'discom.is@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('matrix2012'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'position' => 'Administrador Sistema',
            'transfer' => 1,
            'status' => 'active',
            'company_id' => 1,
            'branch_id' => 1,
            'identification_type_id' => 3,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(1);

        User::create([
            'id' => 2,
            'name' => 'EXCEDENTES ECOINDUSTRIALES LA QUINTA S.A.S.',
            'number' => '901286970',
            'address' => 'CL 5 16 22 BRR COMUNEROS',
            'phone' => '3134468537',
            'email' => 'exceecolaquinta@hotmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('901286970'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'position' => 'Administrador Sistema',
            'transfer' => 1,
            'status' => 'active',
            'company_id' => 1,
            'branch_id' => 1,
            'identification_type_id' => 6,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(2);

        User::create([
            'id' => 3,
            'name' => 'EMDISOFT ADMIN',
            'number' => '91260184',
            'address' => 'CR 24 19 45',
            'phone' => '3168666479',
            'email' => 'admin@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('admin'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'position' => 'Supervisor',
            'transfer' => 1,
            'status' => 'active',
            'company_id' => 1,
            'branch_id' => 1,
            'identification_type_id' => 3,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(2);

        User::create([
            'id' => 4,
            'name' => 'EMDISOFT OPERACIONES',
            'number' => '91260185',
            'address' => 'CR 24 19 45',
            'phone' => '316458468',
            'email' => 'operaciones@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('operatings'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'position' => 'Operaciones',
            'transfer' => 0,
            'status' => 'active',
            'company_id' => 1,
            'branch_id' => 1,
            'identification_type_id' => 3,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(3);

        User::create([
            'id' => 5,
            'name' => 'EMDISOFT COMPRAS',
            'number' => '91260186',
            'address' => 'CR 24 19 45',
            'phone' => '3164758468',
            'email' => 'compras@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('compras'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'position' => 'compras',
            'transfer' => 0,
            'status' => 'active',
            'company_id' => 1,
            'branch_id' => 1,
            'identification_type_id' => 3,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(4);

        User::create([
            'id' => 6,
            'name' => 'EMDISOFT VENTAS',
            'number' => '91260187',
            'address' => 'CR 24 19 45',
            'phone' => '3164758468',
            'email' => 'ventas@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('ventas'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'position' => 'Ventas',
            'transfer' => 0,
            'status' => 'active',
            'company_id' => 1,
            'branch_id' => 1,
            'identification_type_id' => 3,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(5);
    }
}

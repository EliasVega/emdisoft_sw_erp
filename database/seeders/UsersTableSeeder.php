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
            'email' => 'emdisoft@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('emdisoft2024'),
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
            'name' => 'SILVA PEREZ LIBIA ELSA',
            'number' => '28334661',
            'address' => 'CL 62 2 W 58 BRR MUTIS',
            'phone' => '6449174',
            'email' => 'libiyiya@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('28334661'),
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

        ])->assignRole(2);
    }
}

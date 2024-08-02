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
            'name' => 'BRACHA MATZA S.A.S',
            'number' => '901839939',
            'address' => 'CALLE 65 # 12W - 78 LOCAL 2 - 3 CONJUNTO TORRES DE MONTE REDONDO 2',
            'phone' => '3224599940',
            'email' => 'oviedoraul3@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('901839939'),
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
            'created_at' => '2024-05-16 21:07:43',
            'updated_at' => '2024-05-16 21:07:43'

        ])->assignRole(2);

        User::create([
            'id' => 3,
            'name' => 'USUARIO UNO',
            'number' => '1234567891',
            'address' => 'DIRECCION UNO',
            'phone' => '3224599940',
            'email' => 'testing@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('matrix'),
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
            'created_at' => '2024-05-16 21:07:43',
            'updated_at' => '2024-05-16 21:07:43'

        ])->assignRole(5);
    }
}

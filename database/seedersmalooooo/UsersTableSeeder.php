<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->delete();

        DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ELIAS VEGA DELGADO',
                'number' => '91260182',
                'address' => 'Carrera 21 # 99-27 Fontana',
                'phone' => '3168886468',
                'email' => 'discom.is@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ItdP9cpWwLRYU8b0OaukOu3y3Nk9A6ESjFlekE3Q1SkZey6VGkCuC',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'position' => 'Administrador Sistema',
                'transfer' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
                'company_id' => 1,
                'branch_id' => 1,
                'identification_type_id' => 3,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Prins dos',
                'number' => '91260183',
                'address' => 'Carrera 33 # 98-27 Bucaramanga',
                'phone' => '3168666468',
                'email' => 'prinsdos@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$3qtz9xZX9vKIm1GNdKBeU.cuwRSxSWi7h4NIekGwvG/sdupRao1Ci',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'position' => 'Administrativo',
                'transfer' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
                'company_id' => 1,
                'branch_id' => 1,
                'identification_type_id' => 3,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Prins tres',
                'number' => '91260184',
                'address' => 'Carrera 45 # 58-47 Bucaramanga',
                'phone' => '3168666479',
                'email' => 'prinstres@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$jCbQALRbTVKGCfpk6j90vOhEFCQSlx25QWkpWiD4qebi0tLZXwvp.',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'position' => 'Supervisor',
                'transfer' => 1,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
                'company_id' => 1,
                'branch_id' => 2,
                'identification_type_id' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Prins cuatro',
                'number' => '91260185',
                'address' => 'Carrera 6 # 12-27 Bucaramanga',
                'phone' => '316458468',
                'email' => 'prinscuatro@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$5YnRTINoyv6BvoKelpTAHun8YUP6x8PXzwW.8A2v2holab6SEcJ.6',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'position' => 'Compras',
                'transfer' => 0,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
                'company_id' => 1,
                'branch_id' => 3,
                'identification_type_id' => 3,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Prins cinco',
                'number' => '91260186',
                'address' => 'Carrera 60 # 22-77 Bucaramanga',
                'phone' => '3164758468',
                'email' => 'prinscinco@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$a8x2dZZR9kolWUR1Xa7l2e2ijZlawmlZa00LaHEbAjkT2MbEiY6E.',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'position' => 'Ventas',
                'transfer' => 0,
                'status' => 'active',
                'created_at' => '2023-01-12 21:07:43',
                'updated_at' => '2023-01-12 21:07:43',
                'company_id' => 1,
                'branch_id' => 4,
                'identification_type_id' => 3,
            ),
        ));


    }
}

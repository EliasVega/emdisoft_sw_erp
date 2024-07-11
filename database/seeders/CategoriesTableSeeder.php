<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'AEROCOLOR',
                'description' => 'AEROCOLOR',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'ARENA Y TRITURADO',
                'description' => 'ARENA Y TRITURADO',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'ASEO',
                'description' => 'ASEO',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'BROCAS Y DISCOS',
                'description' => 'BROCAS Y DISCOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'BROCHAS Y RODILLOS',
                'description' => 'BROCHAS Y RODILLOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'CEMENTO Y YESOS',
                'description' => 'CEMENTO Y YESOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'CORONA-GRIVAL',
                'description' => 'CORONA-GRIVAL',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'DOTACIONES',
                'description' => 'DOTACIONES',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'ELECTRICOS',
                'description' => 'ELECTRICOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'GALVANIZADO',
                'description' => 'GALVANIZADO',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'GAS',
                'description' => 'GAS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'HERRAMIENTA',
                'description' => 'HERRAMIENTA',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'HIERRO',
                'description' => 'HIERRO',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'LADRILLOS',
                'description' => 'LADRILLOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'LAVAPLATOS',
                'description' => 'LAVAPLATOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'LIJAS',
                'description' => 'LIJAS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'MALLAS',
                'description' => 'MALLAS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'PEGAFLEX',
                'description' => 'PEGAFLEX',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'PINTURA',
                'description' => 'PINTURA',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'PUNTILLAS',
                'description' => 'PUNTILLAS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'REJILLAS',
                'description' => 'REJILLAS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'SIKA',
                'description' => 'SIKA',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'SOLDADURA Y LIMPIADOR',
                'description' => 'SOLDADURA Y LIMPIADOR',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'SUPERMASTICK',
                'description' => 'SUPERMASTICK',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'TEJAS',
                'description' => 'TEJAS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'THINER Y VARSOL',
                'description' => 'THINER Y VARSOL',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'TOXEMENT',
                'description' => 'TOXEMENT',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'TUBERIA CONDUIT',
                'description' => 'TUBERIA CONDUIT',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'TUBERIA PRESION',
                'description' => 'TUBERIA PRESION',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'TUBERIA SANITARIA',
                'description' => 'TUBERIA SANITARIA',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'TUBERIA VENTILACION',
                'description' => 'TUBERIA VENTILACION',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'VARIOS',
                'description' => 'VARIOS',
                'utility_rate' => '0.00',
                'status' => 'active',
                'company_tax_id' => 2,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),

        ));


    }
}

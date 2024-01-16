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
                'id' =>	1,
                'name' => 'CHATARRA MIXTA',
                'description' => 'CHATARRA MIXTA',
                'utility_rate' => '30.00',
                'status' => 'inactive',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            1 =>
            array (
                'id' =>	2,
                'name' => 'HIERRO GRIS',
                'description' => 'HIERRO GRIS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            2 =>
            array (
                'id' =>	3,
                'name' => 'CHATARRA ESPECIAL',
                'description' => 'CHATARRA ESPECIAL',
                'utility_rate' => '30.00',
                'status' => 'inactive',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            3 =>
            array (
                'id' =>	4,
                'name' => 'CANASTAS',
                'description' => 'CANASTAS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            4 =>
            array (
                'id' =>	5,
                'name' => 'PLASTICO',
                'description' => 'PLASTICO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            5 =>
            array (
                'id' =>	6,
                'name' => 'ARCHIVO',
                'description' => 'ARCHIVO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            6 =>
            array (
                'id' =>	7,
                'name' => 'CARTON',
                'description' => 'CARTON',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            7 =>
            array (
                'id' =>	8,
                'name' => 'VIDRIO',
                'description' => 'VIDRIO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            8 =>
            array (
                'id' =>	9,
                'name' => 'PERIODICO',
                'description' => 'PERIODICO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            9 =>
            array (
                'id' =>	10,
                'name' => 'ALUMINIO',
                'description' => 'ALUMINIO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            10 =>
            array (
                'id' =>	11,
                'name' => 'COBRE',
                'description' => 'COBRE',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            11 =>
            array (
                'id' =>	12,
                'name' => 'RADIADOR',
                'description' => 'RADIADOR',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            12 =>
            array (
                'id' =>	13,
                'name' => 'UNIDAD NEV',
                'description' => 'UNIDAD NEV',
                'utility_rate' => '30.00',
                'status' => 'inactive',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            13 =>
            array (
                'id' =>	14,
                'name' => 'VIRUTA',
                'description' => 'VIRUTA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            14 =>
            array (
                'id' =>	15,
                'name' => 'BATERIAS',
                'description' => 'BATERIAS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            15 =>
            array (
                'id' =>	16,
                'name' => 'VIRUTA_BR',
                'description' => 'VIRUTA_BR',
                'utility_rate' => '30.00',
                'status' => 'inactive',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            16 =>
            array (
                'id' =>	17,
                'name' => 'ACERO',
                'description' => 'ACERO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            17 =>
            array (
                'id' =>	18,
                'name' => 'PLOMO',
                'description' => 'PLOMO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            18 =>
            array (
                'id' =>	19,
                'name' => 'CHATARRA',
                'description' => 'CHATARRA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            19 =>
            array (
                'id' =>	20,
                'name' => 'ANTIMONIO',
                'description' => 'ANTIMONIO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            20 =>
            array (
                'id' =>	21,
                'name' => 'SALCHICHA',
                'description' => 'SALCHICHA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            21 =>
            array (
                'id' =>	22,
                'name' => 'PLANCHA Y BANDA',
                'description' => 'PLANCHA Y BANDA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            22 =>
            array (
                'id' =>	23,
                'name' => 'PASTA',
                'description' => 'PASTA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            23 =>
            array (
                'id' =>	24,
                'name' => 'PANAM',
                'description' => 'PANAM',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            24 =>
            array (
                'id' =>	25,
                'name' => 'CD LIMPIO',
                'description' => 'CD LIMPIO',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            25 =>
            array (
                'id' =>	26,
                'name' => 'CELULARES',
                'description' => 'CELULARES',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            26 =>
            array (
                'id' =>	27,
                'name' => 'TAPA PLASTICA',
                'description' => 'TAPA PLASTICA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            27 =>
            array (
                'id' =>	28,
                'name' => 'RESISTENCIA',
                'description' => 'RESISTENCIA',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            28 =>
            array (
                'id' =>	29,
                'name' => 'RINES',
                'description' => 'RINES',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            29 =>
            array (
                'id' =>	30,
                'name' => 'UNIDADES NEV',
                'description' => 'UNIDADES NEV',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            30 =>
            array (
                'id' =>	31,
                'name' => 'MATERIAL',
                'description' => 'MATERIAL',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
            31 =>
            array (
                'id' =>	32,
                'name' => 'VARIOS',
                'description' => 'VARIOS',
                'utility_rate' => '30.00',
                'status' => 'active',
                'company_tax_id' => 1,
                'created_at' => '2024-01-14 12:00:00',
                'updated_at' => '2024-01-14 12:00:00'
            ),
        ));


    }
}

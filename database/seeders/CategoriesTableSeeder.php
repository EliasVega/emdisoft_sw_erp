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
            0 => array ( 'id' => 1, 'name' => 'CHATARRA', 'description' => 'RESIDUOS METALICOS', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            1 => array ( 'id' => 2, 'name' => 'COBRES Y BRONCES', 'description' => 'COBRES Y BRONCES', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            2 => array ( 'id' => 3, 'name' => 'RADIADORES', 'description' => 'RADIADORES', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            3 => array ( 'id' => 4, 'name' => 'ALUMINIOS', 'description' => 'ALUMINIO', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            4 => array ( 'id' => 5, 'name' => 'PLOMO', 'description' => 'PLOMO', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            5 => array ( 'id' => 6, 'name' => 'VIRUTAS', 'description' => 'VIRUTAS', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            6 => array ( 'id' => 7, 'name' => 'HIERRO', 'description' => 'HIERRO', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            7 => array ( 'id' => 8, 'name' => 'UNIDADES', 'description' => 'UNIDADES', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            8 => array ( 'id' => 9, 'name' => 'ACERO', 'description' => 'ACERO', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            9 => array ( 'id' => 10, 'name' => 'BATERIAS', 'description' => 'BATERIAS', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            10 => array ( 'id' => 11, 'name' => 'PASTA', 'description' => 'PASTA', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            11 => array ( 'id' => 12, 'name' => 'RINES', 'description' => 'RINES', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            12 => array ( 'id' => 13, 'name' => 'CHATARRA ELECTRONICA', 'description' => 'CHATARRA ELECTRONICA', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            13 => array ( 'id' => 14, 'name' => 'RECICLAJE', 'description' => 'RECICLAJE', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            14 => array ( 'id' => 15, 'name' => 'PET', 'description' => 'ENVASE', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            15 => array ( 'id' => 16, 'name' => 'MATERIAL', 'description' => 'RESIDUOS METALICOS', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            16 => array ( 'id' => 17, 'name' => 'GASTOS', 'description' => 'GASTOS', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            17 => array ( 'id' => 18, 'name' => 'VENTAS', 'description' => 'VENTAS', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),
            18 => array ( 'id' => 19, 'name' => 'MENUDEO', 'description' => 'MENUDEO', 'utility_rate' => 0, 'status' => 'active', 'company_tax_id' => 1, 'created_at' => '2024-07-23 12:00:00', 'updated_at' => '2024-07-23 12:00:00'),

        ));
    }
}

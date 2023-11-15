<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('raw_materials')->delete();

        DB::table('raw_materials')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '23001',
                'name' => 'BAGRE',
                'price' => '20000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '23002',
                'name' => 'BOCACHICO',
                'price' => '17000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '23003',
                'name' => 'BOLSA DE 12 CAMARONES',
                'price' => '3900.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '23004',
                'name' => 'BOLSA DE MARISCO DE 100 GRS',
                'price' => '4200.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '23005',
                'name' => 'CABRO 250 GRS',
                'price' => '5000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '23006',
                'name' => 'CALDO CON HUEVO',
                'price' => '5800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '23007',
                'name' => 'CAMARON 6',
                'price' => '1950.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '23008',
                'name' => 'CARNE ASAR 150 GRS',
                'price' => '4200.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '23009',
                'name' => 'CERDO 100 GRS',
                'price' => '2600.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '23010',
                'name' => 'CHICHARRON CARNUDO GRANDE',
                'price' => '11000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '23011',
                'name' => 'CHICHARRON CARNUDO MEDIANO',
                'price' => '8000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '23012',
                'name' => 'CHORIZO',
                'price' => '1000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '23013',
                'name' => 'CHULETA',
                'price' => '8000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '23014',
                'name' => 'CHUNCHULLA 150 GRS',
                'price' => '6500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '23015',
                'name' => 'CHURRASCO 300 GRS',
                'price' => '10500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '23016',
                'name' => 'CHURRASCO 500 GRS',
                'price' => '17000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '23017',
                'name' => 'CHURRASQUITO 150 GRS',
                'price' => '4500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '23018',
                'name' => 'COSTILLA DE 250 GRS',
                'price' => '7600.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '23019',
                'name' => 'DESAYUNO SOCORRANO CALDO CON HUEVO',
                'price' => '9000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'code' => '23020',
                'name' => 'ENSALADA TRADICIONAL',
                'price' => '6000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'code' => '23021',
                'name' => 'ENSALADA TRADICIONAL PEQUEÑA',
                'price' => '2000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'code' => '23022',
                'name' => 'GALLINA',
                'price' => '7000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'code' => '23023',
                'name' => 'HIGADO 150 GRS',
                'price' => '5800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'code' => '23024',
                'name' => 'HUEVO ADICIONAL',
                'price' => '700.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'code' => '23025',
                'name' => 'LENGUA 100 GRS',
                'price' => '4800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'code' => '23026',
                'name' => 'LOMO',
                'price' => '22000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'code' => '23027',
                'name' => 'MARISCOS 150 GRS',
                'price' => '6000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'code' => '23028',
                'name' => 'MEJILLON',
                'price' => '700.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'code' => '23029',
                'name' => 'MOJARRA',
                'price' => '11000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'code' => '23030',
                'name' => 'MORCILLA',
                'price' => '1000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            30 =>
            array (
                'id' => 31,
                'code' => '23031',
                'name' => 'MUTE',
                'price' => '16000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            31 =>
            array (
                'id' => 32,
                'code' => '23032',
                'name' => 'MUTE MEDIANO',
                'price' => '11000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            32 =>
            array (
                'id' => 33,
                'code' => '23033',
                'name' => 'OREADA 150 GRS',
                'price' => '8200.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            33 =>
            array (
                'id' => 34,
                'code' => '23034',
                'name' => 'OREADA 200 GRS',
                'price' => '10700.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            34 =>
            array (
                'id' => 35,
                'code' => '23035',
                'name' => 'PALMITOS',
                'price' => '800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            35 =>
            array (
                'id' => 36,
                'code' => '23036',
                'name' => 'PASTA 400 GRS',
                'price' => '4500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            36 =>
            array (
                'id' => 37,
                'code' => '23037',
                'name' => 'PECHUGA DE 200 GRS',
                'price' => '2800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            37 =>
            array (
                'id' => 38,
                'code' => '23038',
                'name' => 'PEPITORIA ESPECIAL',
                'price' => '11800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            38 =>
            array (
                'id' => 39,
                'code' => '23039',
                'name' => 'PERNIL DE POLLO',
                'price' => '3500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            39 =>
            array (
                'id' => 40,
                'code' => '23040',
                'name' => 'POLLO 100 GRS',
                'price' => '1500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            40 =>
            array (
                'id' => 41,
                'code' => '23041',
                'name' => 'PORCION AREPA',
                'price' => '1400.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            41 =>
            array (
                'id' => 42,
                'code' => '23042',
                'name' => 'PORCION CEBOLLITAS',
                'price' => '2000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            42 =>
            array (
                'id' => 43,
                'code' => '23043',
                'name' => 'PORCION CHUNCHULLA',
                'price' => '3500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            43 =>
            array (
                'id' => 44,
                'code' => '23044',
                'name' => 'PORCION COLA',
                'price' => '7600.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            44 =>
            array (
                'id' => 45,
                'code' => '23045',
                'name' => 'PORCION COSTILLA',
                'price' => '4000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            45 =>
            array (
                'id' => 46,
                'code' => '23046',
                'name' => 'PORCION FRIJOL',
                'price' => '1800.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            46 =>
            array (
                'id' => 47,
                'code' => '23047',
                'name' => 'PORCION MADURO',
                'price' => '1000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            47 =>
            array (
                'id' => 48,
                'code' => '23048',
                'name' => 'PORCION PAPA CRIOLLA',
                'price' => '1000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            48 =>
            array (
                'id' => 49,
                'code' => '23049',
                'name' => 'PORCION PAPA FRANCESA',
                'price' => '1500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            49 =>
            array (
                'id' => 50,
                'code' => '23050',
                'name' => 'PORCION PAPA O YUCA AL VAPOR',
                'price' => '1000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            50 =>
            array (
                'id' => 51,
                'code' => '23051',
                'name' => 'PORCION PATACON',
                'price' => '1500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            51 =>
            array (
                'id' => 52,
                'code' => '23052',
                'name' => 'PORCION PEPITORIA',
                'price' => '3000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            52 =>
            array (
                'id' => 53,
                'code' => '23053',
                'name' => 'PORCION YUCA FRITA',
                'price' => '2000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            53 =>
            array (
                'id' => 54,
                'code' => '23054',
                'name' => 'PUNTA DE ANCA 300 GRS',
                'price' => '10500.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            54 =>
            array (
                'id' => 55,
                'code' => '23055',
                'name' => 'PUNTA DE ANCA 500 GRS',
                'price' => '17000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            55 =>
            array (
                'id' => 56,
                'code' => '23056',
                'name' => 'RELLENA',
                'price' => '1000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            56 =>
            array (
                'id' => 57,
                'code' => '23057',
                'name' => 'ROBALO',
                'price' => '11000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            57 =>
            array (
                'id' => 58,
                'code' => '23058',
                'name' => 'ROBALO 1/2',
                'price' => '5200.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            58 =>
            array (
                'id' => 59,
                'code' => '23059',
                'name' => 'SALMON',
                'price' => '24200.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            59 =>
            array (
                'id' => 60,
                'code' => '23060',
                'name' => 'SOBREBARRIGA 150 GRS',
                'price' => '5100.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            60 =>
            array (
                'id' => 61,
                'code' => '23061',
                'name' => 'SOPA',
                'price' => '4000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            61 =>
            array (
                'id' => 62,
                'code' => '23062',
                'name' => 'TAZA MUTE',
                'price' => '6000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            62 =>
            array (
                'id' => 63,
                'code' => '23063',
                'name' => 'TRUCHA',
                'price' => '13000.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),
            63 =>
            array (
                'id' => 64,
                'code' => '23064',
                'name' => 'VERDURA 100 GRS',
                'price' => '1200.00',
                'stock' => 100,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 13,
                'measure_unit_id' => 70,
                'created_at' => '2023-10-20 12:00:00',
                'updated_at' => '2023-10-20 12:00:00'
            ),

        ));
    }
}

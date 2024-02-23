<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        DB::table('products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 10001,
                'name' => 'ADAPTADORES DE LUJO PARA LA BOMBA DE FRENO UNIVERSAL',
                'price' => 0,
                'sale_price' => 22000,
                'stock' => 4,
                'stock_min' => 2,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 10002,
                'name' => 'BOMBA DE ACEITE FZ 16',
                'price' => 0,
                'sale_price' => 45000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 10003,
                'name' => 'BOMBA ACEITE DISCOVERY 100',
                'price' => 0,
                'sale_price' => 48000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 10004,
                'name' => 'BOMBA DE ACEITE DT  RX  125',
                'price' => 0,
                'sale_price' => 70000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 10005,
                'name' => 'BOMBA DE ACEITE  bws 125 F  1',
                'price' => 0,
                'sale_price' => 45000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 10006,
                'name' => 'BOMBA DE ACEITE AKT 110',
                'price' => 0,
                'sale_price' => 25000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 10007,
                'name' => 'BOMBA DE ACEITE BWS 125',
                'price' => 0,
                'sale_price' => 30000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 10008,
                'name' => 'BARRA TEESCOPICA SUZUKI VIVA',
                'price' => 0,
                'sale_price' => 40000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 10009,
                'name' => 'BARRA TELESCOPICA ECO DE LUZ ',
                'price' => 0,
                'sale_price' => 65000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 10010,
                'name' => ' BARRA TELESCOPICA XTZ 125 ',
                'price' => 0,
                'sale_price' => 90000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 10011,
                'name' => 'BARRA TELESCOPICA  BWS 1000',
                'price' => 0,
                'sale_price' => 45000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => 10012,
                'name' => ' BARRA TELESCOPICA  CRIPTON 110',
                'price' => 0,
                'sale_price' => 40000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => 10013,
                'name' => 'BARRA TELESCOPICA CBF 150',
                'price' => 0,
                'sale_price' => 150000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => 10014,
                'name' => 'BUJES PORTAPLATOS AKT 110',
                'price' => 0,
                'sale_price' => 10000,
                'stock' => 10,
                'stock_min' => 2,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => 10015,
                'name' => 'BOMBILLOS 1 PATA 12V  CRIPTON 110',
                'price' => 0,
                'sale_price' => 3000,
                'stock' => 268,
                'stock_min' => 10,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => 10016,
                'name' => 'CUBIERTAS VELOCIMETRO YBR 125',
                'price' => 0,
                'sale_price' => 45000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => 10017,
                'name' => 'CAJA VELOCIMETRO  YBR 125 MOD NUEVO',
                'price' => 0,
                'sale_price' => 33000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => 10018,
                'name' => 'JUEGO DE PASTILLAS  DR 200 KLX',
                'price' => 0,
                'sale_price' => 12000,
                'stock' => 18,
                'stock_min' => 5,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            18 =>
            array (
                'id' => 19,
                'code' => 10019,
                'name' => 'JUEGO DE PASTILLAS VARIAS',
                'price' => 0,
                'sale_price' => 14000,
                'stock' => 9,
                'stock_min' => 2,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            19 =>
            array (
                'id' => 20,
                'code' => 10020,
                'name' => 'JUEGO PASTILLA   CBF 150 INVICTA',
                'price' => 0,
                'sale_price' => 14000,
                'stock' => 12,
                'stock_min' => 4,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            20 =>
            array (
                'id' => 21,
                'code' => 10021,
                'name' => 'JUEGO PUNTERAS COLORES',
                'price' => 0,
                'sale_price' => 18000,
                'stock' => 7,
                'stock_min' => 2,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            21 =>
            array (
                'id' => 22,
                'code' => 10022,
                'name' => 'KIT MRDIO DISCOVER 135 ',
                'price' => 0,
                'sale_price' => 10000,
                'stock' => 10,
                'stock_min' => 2,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            22 =>
            array (
                'id' => 23,
                'code' => 10023,
                'name' => 'LENTE VELOCIMETRO PULSAR 180',
                'price' => 0,
                'sale_price' => 25000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            23 =>
            array (
                'id' => 24,
                'code' => 10024,
                'name' => 'LENTE VELOCIMETRO HONDA CB 110',
                'price' => 0,
                'sale_price' => 15000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            24 =>
            array (
                'id' => 25,
                'code' => 10025,
                'name' => 'MEDIDOR DE TANQUE DE GASOLINA PULSAR 180 UG',
                'price' => 0,
                'sale_price' => 58000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            25 =>
            array (
                'id' => 26,
                'code' => 10026,
                'name' => 'MEDIDOR DE TANQUE DE GASOLINA  YAMAHA BWS 100',
                'price' => 0,
                'sale_price' => 75000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            26 =>
            array (
                'id' => 27,
                'code' => 10027,
                'name' => 'MEDIDOR DE TANQUE DE GASOLINA SUZUKI VIVA ORIGIN',
                'price' => 0,
                'sale_price' => 85000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            27 =>
            array (
                'id' => 28,
                'code' => 10028,
                'name' => 'MEDIDOREES DE GASOLINA AKT 110',
                'price' => 0,
                'sale_price' => 26000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            28 =>
            array (
                'id' => 29,
                'code' => 10029,
                'name' => 'PROTECTORES DE VELOCIMETROS',
                'price' => 0,
                'sale_price' => 22000,
                'stock' => 17,
                'stock_min' => 5,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            29 =>
            array (
                'id' => 30,
                'code' => 10030,
                'name' => 'PROTECTOR PISO BWS 100 ALUTEK',
                'price' => 0,
                'sale_price' => 90000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            30 =>
            array (
                'id' => 31,
                'code' => 10031,
                'name' => 'PROTECTOR PISO BWS 125  4 T ALUTEK',
                'price' => 0,
                'sale_price' => 98000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            31 =>
            array (
                'id' => 32,
                'code' => 10032,
                'name' => 'SOPORTE VELOCIMETRO WAVE NEGRA',
                'price' => 0,
                'sale_price' => 65000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            32 =>
            array (
                'id' => 33,
                'code' => 10033,
                'name' => 'SOPORTE VELOCIMETRO JINCHENG',
                'price' => 0,
                'sale_price' => 65000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            33 =>
            array (
                'id' => 34,
                'code' => 10034,
                'name' => 'TACOMETRO YAMAHA DT 125',
                'price' => 0,
                'sale_price' => 50000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            34 =>
            array (
                'id' => 35,
                'code' => 10035,
                'name' => 'TAPAS DE TANQUE HONDA PLATINO',
                'price' => 0,
                'sale_price' => 35000,
                'stock' => 4,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            35 =>
            array (
                'id' => 36,
                'code' => 10036,
                'name' => 'TAPA DE TANQUE PULSAR NS 200',
                'price' => 0,
                'sale_price' => 65000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            36 =>
            array (
                'id' => 37,
                'code' => 10037,
                'name' => 'TAPA DE TANQUE  DT 125 LOCA',
                'price' => 0,
                'sale_price' => 30000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            37 =>
            array (
                'id' => 38,
                'code' => 10038,
                'name' => 'TAPA DE TANQUE GN 125',
                'price' => 0,
                'sale_price' => 22000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            38 =>
            array (
                'id' => 39,
                'code' => 10039,
                'name' => 'VELOCIMETROS YAMAHA NEXT 115',
                'price' => 0,
                'sale_price' => 90000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            39 =>
            array (
                'id' => 40,
                'code' => 10040,
                'name' => 'VELOCIMETRO HONDA ECO DELUXE',
                'price' => 0,
                'sale_price' => 90000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            40 =>
            array (
                'id' => 41,
                'code' => 10041,
                'name' => 'VELOCIMETRO AKT  XM 200 ORIGINAL',
                'price' => 0,
                'sale_price' => 120000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            41 =>
            array (
                'id' => 42,
                'code' => 10042,
                'name' => 'VELOCIMETROS HONDA  BIZZ 125',
                'price' => 0,
                'sale_price' => 90000,
                'stock' => 2,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            42 =>
            array (
                'id' => 43,
                'code' => 10043,
                'name' => 'VELOCIMETRO  YAMAHA DT 125',
                'price' => 0,
                'sale_price' => 50000,
                'stock' => 1,
                'stock_min' => 1,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            43 =>
            array (
                'id' => 44,
                'code' => 10045,
                'name' => 'RIN TRASERO ADVANCE 2DA',
                'price' => 0,
                'sale_price' => 180000,
                'stock' => 2,
                'stock_min' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            44 =>
            array (
                'id' => 45,
                'code' => 10046,
                'name' => 'AGARRADERA TRAZ  DERECHA XTZ  150 2DA',
                'price' => 0,
                'sale_price' => 240000,
                'stock' => 1,
                'stock_min' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            45 =>
            array (
                'id' => 46,
                'code' => 10047,
                'name' => 'JUEGO PROTECTORES  PISO  BWS 100 2DA',
                'price' => 0,
                'sale_price' => 90000,
                'stock' => 1,
                'stock_min' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            46 =>
            array (
                'id' => 47,
                'code' => 10048,
                'name' => 'SOPORTE LLANTA TRAZERA BWS 125 2DA',
                'price' => 0,
                'sale_price' => 0,
                'stock' => 1,
                'stock_min' => 0,
                'type_product' => 'product',
                'status' => 'active',
                'category_id' => 1,
                'measure_unit_id' => 70,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            47 =>
            array (
                'id' => 48,
                'code' => 20001,
                'name' => 'CAMBIO DE ACEITE',
                'price' => 0,
                'sale_price' => 5000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            48 =>
            array (
                'id' => 49,
                'code' => 20002,
                'name' => 'AJUSTE Y LUBRICADA CADENA',
                'price' => 0,
                'sale_price' => 5000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            49 =>
            array (
                'id' => 50,
                'code' => 20003,
                'name' => 'LAVADA, TANQUE Y CARBURADOR',
                'price' => 0,
                'sale_price' => 30000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            50 =>
            array (
                'id' => 51,
                'code' => 20004,
                'name' => 'CARBURADA MOTO ',
                'price' => 0,
                'sale_price' => 20000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            51 =>
            array (
                'id' => 52,
                'code' => 20005,
                'name' => 'MANTENIMIENTO PREVENTIVO',
                'price' => 0,
                'sale_price' => 70000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            52 =>
            array (
                'id' => 53,
                'code' => 20006,
                'name' => 'MANTENIMIENTO GENERAL ',
                'price' => 0,
                'sale_price' => 150000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            53 =>
            array (
                'id' => 54,
                'code' => 20007,
                'name' => 'CAMBIO DE RODAMIENTO ',
                'price' => 0,
                'sale_price' => 25000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            54 =>
            array (
                'id' => 55,
                'code' => 20008,
                'name' => 'CAMBIO DE PASTILLAS DELANTERAS',
                'price' => 0,
                'sale_price' => 10000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            55 =>
            array (
                'id' => 56,
                'code' => 20009,
                'name' => 'INSTALADAS ESPEJOS',
                'price' => 0,
                'sale_price' => 8000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            56 =>
            array (
                'id' => 57,
                'code' => 20010,
                'name' => 'CAMBIO DE CUNAS DIRECCION',
                'price' => 0,
                'sale_price' => 35000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            57 =>
            array (
                'id' => 58,
                'code' => 20011,
                'name' => 'CAMBIO DE ACEITE DE BARRAS',
                'price' => 0,
                'sale_price' => 35000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            58 =>
            array (
                'id' => 59,
                'code' => 20012,
                'name' => 'CAMBIO DE BANDAS CON MANTENIMIENTO',
                'price' => 0,
                'sale_price' => 15000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            59 =>
            array (
                'id' => 60,
                'code' => 20013,
                'name' => 'MANTENIMIENTO TREN TRASERO ',
                'price' => 0,
                'sale_price' => 40000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            60 =>
            array (
                'id' => 61,
                'code' => 20014,
                'name' => 'REPARACION TOTAL MOTOR',
                'price' => 0,
                'sale_price' => 150000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            61 =>
            array (
                'id' => 62,
                'code' => 20015,
                'name' => 'REPARACION CABEZA DE FUERZA',
                'price' => 0,
                'sale_price' => 120000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            62 =>
            array (
                'id' => 63,
                'code' => 20016,
                'name' => 'CAMBIO DE GUAYA CLOTH',
                'price' => 0,
                'sale_price' => 8000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            63 =>
            array (
                'id' => 64,
                'code' => 20017,
                'name' => 'REPARACION SISTEMA ELECTRICO TOTAL',
                'price' => 0,
                'sale_price' => 80000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            64 =>
            array (
                'id' => 65,
                'code' => 20018,
                'name' => 'CAMBIO DE GUAYA ACELERADOR',
                'price' => 0,
                'sale_price' => 10000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            65 =>
            array (
                'id' => 66,
                'code' => 20019,
                'name' => 'CAMBIO DE BALINERAS DELANTERAS ',
                'price' => 0,
                'sale_price' => 15000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            66 =>
            array (
                'id' => 67,
                'code' => 20020,
                'name' => 'CAMBIO DE BALINERAS TRASERAS',
                'price' => 0,
                'sale_price' => 15000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            67 =>
            array (
                'id' => 68,
                'code' => 20021,
                'name' => 'CAMBIO LLANTA DELANTERA MOTO SCOOTER',
                'price' => 0,
                'sale_price' => 15000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            68 =>
            array (
                'id' => 69,
                'code' => 20022,
                'name' => 'CAMBIO LLANTA TRASERA MOTO SCOOTER',
                'price' => 0,
                'sale_price' => 20000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            69 =>
            array (
                'id' => 70,
                'code' => 20023,
                'name' => 'CAMBIO LLANTA NORMAL',
                'price' => 0,
                'sale_price' => 10000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            70 =>
            array (
                'id' => 71,
                'code' => 20024,
                'name' => 'REPARACION CABEZA FUERZA DOS TIEMPOS',
                'price' => 0,
                'sale_price' => 60000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            71 =>
            array (
                'id' => 72,
                'code' => 20025,
                'name' => 'LAVADA  Y POLICHADA',
                'price' => 0,
                'sale_price' => 12000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),
            72 =>
            array (
                'id' => 73,
                'code' => 20026,
                'name' => 'LAVADA GENERAL ',
                'price' => 0,
                'sale_price' => 15000,
                'stock' => 0,
                'stock_min' => 0,
                'type_product' => 'service',
                'status' => 'active',
                'category_id' => 2,
                'measure_unit_id' => 730,
                'created_at' => '2024-02-20 12:00:00',
                'updated_at' => '2024-02-20 12:00:00'
            ),

        ));
    }
}

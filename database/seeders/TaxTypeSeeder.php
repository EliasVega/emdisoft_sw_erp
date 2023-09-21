<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_types')->delete();

        DB::table('tax_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '01',
                'name' => 'IVA',
                'description' => 'Impuesto sobre las ventas',
                'type_tax' => 'tax_item'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '02',
                'name' => 'IC',
                'description' => 'Impuesto al Consumo Departamental Nominal',
                'type_tax' => 'tax_global'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '03',
                'name' => 'ICA',
                'description' => 'Impuesto de Industria, Comercio y Aviso',
                'type_tax' => 'tax_global'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '04',
                'name' => 'INC',
                'description' => 'Impuesto Nacional al Consumo',
                'type_tax' => 'tax_item'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '05',
                'name' => 'RETE_IVA',
                'description' => 'Retención sobre el IVA',
                'type_tax' => 'retention'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '06',
                'name' => 'RETE_RENTA',
                'description' => 'Retención sobre Renta',
                'type_tax' => 'retention'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '07',
                'name' => 'RETE_ICA',
                'description' => 'Retención sobre el ICA',
                'type_tax' => 'retention'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '08',
                'name' => 'IC DATOS',
                'description' => 'Impuesto al consumo de datos',
                'type_tax' => 'tax_global'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '20',
                'name' => 'FTOHORTICULTURA',
                'description' => 'Cuota de Fomento Hortifrutícula',
                'type_tax' => 'tax_global'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '21',
                'name' => 'TIMBRE',
                'description' => 'Impuesto al Timbre',
                'type_tax' => 'tax_global'

            ),
            10 =>
            array (
                'id' => 11,
                'code' => '22',
                'name' => 'INC BOLSAS',
                'description' => 'Impueto nacional al consumo de bolsas plasticas',
                'type_tax' => 'tax_global'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '23',
                'name' => 'INCARBONO',
                'description' => 'Impuesto nacional al Carbono',
                'type_tax' => 'tax_global'

            ),
            12 =>
            array (
                'id' => 13,
                'code' => '24',
                'name' => 'INCOMBUSTIBLES',
                'description' => 'Impuesto nacional a los combustibles',
                'type_tax' => 'tax_global'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '25',
                'name' => 'SOBRETASA COMBUSTIBLES',
                'description' => 'Sobretasa a los combustibles',
                'type_tax' => 'tax_global'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '26',
                'name' => 'SORDICOM',
            'description' => 'Contribucion minoristas (combustibles)',
            'type_tax' => 'tax_global'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '30',
                'name' => 'IC PORCENTUAL',
                'description' => 'Impuesto al consumo Departamental Porcentual',
                'type_tax' => 'tax_global'
            ),
            array (
                'id' => 17,
                'code' => 'ZA',
                'name' => 'IVA e INC',
                'description' => 'IVA e INC',
                'type_tax' => 'tax_item'
            ),
            array (
                'id' => 18,
                'code' => 'ZZ',
                'name' => 'NO APLICA',
                'description' => 'No aplica',
                'type_tax' => 'tax_global'
            ),
        ));
    }
}

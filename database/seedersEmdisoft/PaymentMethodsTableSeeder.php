<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->delete();

        DB::table('payment_methods')->insert(array (

            0 =>
            array (
                'id' => 1,
                'code' => '1',
                'name' => 'Instrumento no definido',
                'status' => 'active'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Crédito ACH',
                'status' => 'inactive'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '3',
                'name' => 'Débito ACH',
                'status' => 'inactive'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '4',
                'name' => 'Reversión débito de demanda ACH',
                'status' => 'inactive'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '5',
                'name' => 'Reversión crédito de demanda ACH',
                'status' => 'inactive'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '6',
                'name' => 'Crédito de demanda ACH',
                'status' => 'inactive'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '7',
                'name' => 'Débito de demanda ACH',
                'status' => 'inactive'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '8',
                'name' => 'Mantener',
                'status' => 'inactive'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '9',
                'name' => 'Clearing Nacional o Regional',
                'status' => 'inactive'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '10',
                'name' => 'Efectivo',
                'status' => 'active'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '11',
                'name' => 'Reversión Crédito Ahorro',
                'status' => 'inactive'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '12',
                'name' => 'Reversión Débito Ahorro',
                'status' => 'inactive'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '13',
                'name' => 'Crédito Ahorro',
                'status' => 'inactive'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '14',
                'name' => 'Débito Ahorro',
                'status' => 'inactive'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '15',
                'name' => 'Bookentry Crédito',
                'status' => 'inactive'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '16',
                'name' => 'Bookentry Débito',
                'status' => 'inactive'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '17',
                'name' => 'Desembolso Crédito (CCD)',
                'status' => 'inactive'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '18',
                'name' => 'Desembolso (CCD) débito',
                'status' => 'inactive'
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '19',
                'name' => 'Crédito Pago negocio corporativo (CTP)',
                'status' => 'inactive'
            ),
            19 =>
            array (
                'id' => 20,
                'code' => '20',
                'name' => 'Cheque',
                'status' => 'inactive'
            ),
            20 =>
            array (
                'id' => 21,
                'code' => '21',
                'name' => 'Poyecto bancario',
                'status' => 'inactive'
            ),
            21 =>
            array (
                'id' => 22,
                'code' => '22',
                'name' => 'Proyecto bancario certificado',
                'status' => 'inactive'
            ),
            22 =>
            array (
                'id' => 23,
                'code' => '23',
                'name' => 'Cheque bancario de gerencia',
                'status' => 'inactive'
            ),
            23 =>
            array (
                'id' => 24,
                'code' => '24',
                'name' => 'Nota cambiaria esperando aceptación',
                'status' => 'inactive'
            ),
            24 =>
            array (
                'id' => 25,
                'code' => '25',
                'name' => 'Cheque certificado',
                'status' => 'inactive'
            ),
            25 =>
            array (
                'id' => 26,
                'code' => '26',
                'name' => 'Cheque Local',
                'status' => 'inactive'
            ),
            26 =>
            array (
                'id' => 27,
                'code' => '27',
                'name' => 'Débito Pago Neogcio Corporativo (CTP)',
                'status' => 'inactive'
            ),
            27 =>
            array (
                'id' => 28,
                'code' => '28',
                'name' => 'Crédito Negocio Intercambio Corporativo (CTX)',
                'status' => 'inactive'
            ),
            28 =>
            array (
                'id' => 29,
                'code' => '29',
                'name' => 'Débito Negocio Intercambio Corporativo (CTX)',
                'status' => 'inactive'
            ),
            29 =>
            array (
                'id' => 30,
                'code' => '30',
                'name' => 'Transferencia Crédito',
                'status' => 'inactive'
            ),
            30 =>
            array (
                'id' => 31,
                'code' => '31',
                'name' => 'Transferencia Débito',
                'status' => 'inactive'
            ),
            31 =>
            array (
                'id' => 32,
                'code' => '32',
                'name' => 'Desembolso Crédito plus (CCD+)',
                'status' => 'inactive'
            ),
            32 =>
            array (
                'id' => 33,
                'code' => '33',
                'name' => 'Desembolso Débito plus (CCD+)',
                'status' => 'inactive'
            ),
            33 =>
            array (
                'id' => 34,
                'code' => '34',
                'name' => 'Pago y depósito pre acordado (PPD)',
                'status' => 'inactive'
            ),
            34 =>
            array (
                'id' => 35,
                'code' => '35',
                'name' => 'Desembolso Crédito (CCD)',
                'status' => 'inactive'
            ),
            35 =>
            array (
                'id' => 36,
                'code' => '36',
                'name' => 'Desembolso Débito (CCD)',
                'status' => 'inactive'
            ),
            36 =>
            array (
                'id' => 37,
                'code' => '37',
                'name' => 'Pago Negocio Corporativo Ahorros Crédito (CTP)',
                'status' => 'inactive'
            ),
            37 =>
            array (
                'id' => 38,
                'code' => '38',
                'name' => 'Pago Negocio Corporativo Ahorros Débito (CTP)',
                'status' => 'inactive'
            ),
            38 =>
            array (
                'id' => 39,
                'code' => '39',
                'name' => 'Crédito Intercambio Corporativo (CTX)',
                'status' => 'inactive'
            ),
            39 =>
            array (
                'id' => 40,
                'code' => '40',
                'name' => 'Débito Intercambio Corporativo (CTX)',
                'status' => 'inactive'
            ),
            40 =>
            array (
                'id' => 41,
                'code' => '41',
                'name' => 'Desembolso Crédito plus (CCD+)',
                'status' => 'inactive'
            ),
            41 =>
            array (
                'id' => 42,
                'code' => '42',
                'name' => 'Consiganción bancaria',
                'status' => 'inactive'
            ),
            42 =>
            array (
                'id' => 43,
                'code' => '43',
                'name' => 'Desembolso Débito plus (CCD+)',
                'status' => 'inactive'
            ),
            43 =>
            array (
                'id' => 44,
                'code' => '44',
                'name' => 'Nota cambiaria',
                'status' => 'inactive'
            ),
            44 =>
            array (
                'id' => 45,
                'code' => '45',
                'name' => 'Transferencia Crédito Bancario',
                'status' => 'inactive'
            ),
            45 =>
            array (
                'id' => 46,
                'code' => '46',
                'name' => 'Transferencia Débito Interbancario',
                'status' => 'inactive'
            ),
            46 =>
            array (
                'id' => 47,
                'code' => '47',
                'name' => 'Transferencia Débito Bancaria',
                'status' => 'active'
            ),
            47 =>
            array (
                'id' => 48,
                'code' => '48',
                'name' => 'Tarjeta Crédito',
                'status' => 'active'
            ),
            48 =>
            array (
                'id' => 49,
                'code' => '49',
                'name' => 'Tarjeta Débito',
                'status' => 'active'
            ),
            49 =>
            array (
                'id' => 50,
                'code' => '50',
                'name' => 'Postgiro',
                'status' => 'inactive'
            ),
            50 =>
            array (
                'id' => 51,
                'code' => '51',
                'name' => 'Telex estándar bancario',
                'status' => 'inactive'
            ),
            51 =>
            array (
                'id' => 52,
                'code' => '52',
                'name' => 'Pago comercial urgente',
                'status' => 'inactive'
            ),
            52 =>
            array (
                'id' => 53,
                'code' => '53',
                'name' => 'Pago Tesorería Urgente',
                'status' => 'inactive'
            ),
            53 =>
            array (
                'id' => 60,
                'code' => '60',
                'name' => 'Nota promisoria',
                'status' => 'inactive'
            ),
            54 =>
            array (
                'id' => 61,
                'code' => '61',
                'name' => 'Nota promisoria firmada por el acreedor',
                'status' => 'inactive'
            ),
            55 =>
            array (
                'id' => 62,
                'code' => '62',
                'name' => 'Nota promisoria firmada por el acreedor, avalada por el banco',
                'status' => 'inactive'
            ),
            56 =>
            array (
                'id' => 63,
                'code' => '63',
                'name' => 'Nota promisoria firmada por el acreedor, avalada por un tercero',
                'status' => 'inactive'
            ),
            57 =>
            array (
                'id' => 64,
                'code' => '64',
                'name' => 'Nota promisoria firmada por el banco',
                'status' => 'inactive'
            ),
            58 =>
            array (
                'id' => 65,
                'code' => '65',
                'name' => 'Nota promisoria firmada por un banco avalada por otro banco',
                'status' => 'inactive'
            ),
            59 =>
            array (
                'id' => 66,
                'code' => '66',
                'name' => 'Nota promisoria firmada',
                'status' => 'inactive'
            ),
            60 =>
            array (
                'id' => 67,
                'code' => '67',
                'name' => 'Nota promisoria firmada por un tercero avalada por otro banco',
                'status' => 'inactive'
            ),
            61 =>
            array (
                'id' => 70,
                'code' => '70',
                'name' => 'Retiro de nota por el por el acreedor',
                'status' => 'inactive'
            ),
            62 =>
            array (
                'id' => 74,
                'code' => '74',
                'name' => 'Retiro de nota por el por el acreedor sobre un banco',
                'status' => 'inactive'
            ),
            63 =>
            array (
                'id' => 75,
                'code' => '75',
                'name' => 'Retiro de nota por el acreedor, avalada por otro banco',
                'status' => 'inactive'
            ),
            64 =>
            array (
                'id' => 76,
                'code' => '76',
                'name' => 'Retiro de nota por el acreedor, sobre un banco avalada por un tercero',
                'status' => 'inactive'
            ),
            65 =>
            array (
                'id' => 77,
                'code' => '77',
                'name' => 'etiro de una nota por el acreedor sobre un tercero',
                'status' => 'inactive'
            ),
            66 =>
            array (
                'id' => 78,
                'code' => '78',
                'name' => 'Retiro de una nota por el acreedor sobre un tercero avalada por un banco',
                'status' => 'inactive'
            ),
            67 =>
            array (
                'id' => 91,
                'code' => '91',
                'name' => 'Nota bancaria transferible',
                'status' => 'inactive'
            ),
            68 =>
            array (
                'id' => 92,
                'code' => '92',
                'name' => 'Cheque local transferible',
                'status' => 'inactive'
            ),
            69 =>
            array (
                'id' => 93,
                'code' => '93',
                'name' => 'Giro referenciado',
                'status' => 'inactive'
            ),
            70 =>
            array (
                'id' => 94,
                'code' => '94',
                'name' => 'Giro urgente',
                'status' => 'inactive'
            ),
            71 =>
            array (
                'id' => 95,
                'code' => '95',
                'name' => 'Giro formato abierto',
                'status' => 'inactive'
            ),
            72 =>
            array (
                'id' => 96,
                'code' => '96',
                'name' => 'Método de pago solicitado no usuado',
                'status' => 'inactive'
            ),
            73 =>
            array (
                'id' => 97,
                'code' => '97',
                'name' => 'Clearing entre partners',
                'status' => 'inactive'
            ),
            74 =>
            array (
                'id' => 99,
                'code' => 'ZZZ',
                'name' => 'Otro*',
                'status' => 'active'
            ),
        ));

    }
}

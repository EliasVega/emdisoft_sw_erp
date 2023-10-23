<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvironmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('environments')->delete();

        DB::table('environments')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '1',
                'name' => 'Production',
                'url' => 'https://vpfe.dian.gov.co/WcfDianCustomerServices.svc',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Testing',
                'url' => 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'CC',
                'name' => 'Company Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'SC',
                'name' => 'Software Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/software',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 'SPC',
                'name' => 'Software Payrrol Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/softwarepayroll',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'SCC',
                'name' => 'Signature Certificate Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/certificate',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 'RC',
                'name' => 'Resolution Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/resolution',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 'ENV',
                'name' => 'Environment',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/environment',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 'NR',
                'name' => 'Numeration Range',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/numbering-range',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'PDF',
                'name' => 'PDF',
                'url' => 'http://144.126.135.31:81/api/invoice/',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 'INV',
                'name' => 'Invoice',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/invoice',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'code' => 'CN',
                'name' => 'Credit Note',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/credit-note',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'code' => 'DN',
                'name' => 'Debit Note',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/debit-note',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'code' => 'P',
                'name' => 'Payroll',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/payroll',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'code' => 'PA',
                'name' => 'Payroll Adjustment',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/payroll-adjust-note',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'code' => 'SD',
                'name' => 'Support Document',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/support-document',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'code' => 'NSD',
                'name' => 'Adjustment Note Support Document',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/sd-credit-note',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'code' => 'SE',
                'name' => 'Send Email',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/send-email',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('environments')->delete();

        DB::table('environments')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '1',
                'name' => 'Production',
                'url' => 'https://vpfe.dian.gov.co/WcfDianCustomerServices.svc'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Testing',
                'url' => 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'CC',
                'name' => 'Company Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'SC',
                'name' => 'Software Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/software'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 'SPC',
                'name' => 'Software Payrrol Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/softwarepayroll'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'SCC',
                'name' => 'Signature Certificate Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/certificate'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 'RC',
                'name' => 'Resolution Configuration',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/resolution'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 'ENV',
                'name' => 'Environment',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/config/environment'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 'NR',
                'name' => 'Numeration Range',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/numbering-range'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'PDF',
                'name' => 'PDF',
                'url' => 'http://144.126.135.31:81/api/invoice/'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 'INV',
                'name' => 'Invoice',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/invoice'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => 'CN',
                'name' => 'Credit Note',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/credit-note'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => 'DN',
                'name' => 'Debit Note',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/debit-note'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => 'P',
                'name' => 'Payroll',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/payroll'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => 'PA',
                'name' => 'Payroll Adjustment',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/payroll-adjust-note'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => 'SD',
                'name' => 'Support Document',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/support-document'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => 'NSD',
                'name' => 'Adjustment Note Support Document',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/sd-credit-note'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => 'SE',
                'name' => 'Send Email',
                'url' => 'http://144.126.135.31:81/api/ubl2.1/send-email'
            ),
        ));
    }
}

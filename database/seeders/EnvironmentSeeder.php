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
                'protocol' => 'http://',
                'url' => 'https://vpfe.dian.gov.co/WcfDianCustomerServices.svc'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '2',
                'name' => 'Testing',
                'protocol' => 'http://',
                'url' => 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'CC',
                'name' => 'Company Configuration',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'SC',
                'name' => 'Software Configuration',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/software'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 'SPC',
                'name' => 'Software Payrrol Configuration',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/softwarepayroll'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'SCC',
                'name' => 'Signature Certificate Configuration',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/certificate'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 'RC',
                'name' => 'Resolution Configuration',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/resolution'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 'ENV',
                'name' => 'Environment',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/environment'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 'NR',
                'name' => 'Numeration Range',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/numbering-range'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'PDF',
                'name' => 'PDF',
                'protocol' => 'http://',
                'url' => '/api/invoice/'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 'INV',
                'name' => 'Invoice',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/invoice'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => 'CN',
                'name' => 'Credit Note',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/credit-note'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => 'DN',
                'name' => 'Debit Note',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/debit-note'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => 'P',
                'name' => 'Payroll',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/payroll'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => 'PA',
                'name' => 'Payroll Adjustment',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/payroll-adjust-note'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => 'SD',
                'name' => 'Support Document',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/support-document'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => 'NSD',
                'name' => 'Adjustment Note Support Document',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/sd-credit-note'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => 'SE',
                'name' => 'Send Email',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/send-email'
            ),
            18 =>
            array (
                'id' => 19,
                'code' => 'LOGO',
                'name' => 'config Logo',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/logo'
            ),
            19 =>
            array (
                'id' => 20,
                'code' => 'SQSP',
                'name' => 'Consulta de estado',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/status/zip/'
            ),
            20 =>
            array (
                'id' => 21,
                'code' => 'EPOS',
                'name' => 'Documento Equivalente pos',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/eqdoc'
            ),
            21 =>
            array (
                'id' => 22,
                'code' => 'SCP',
                'name' => 'Software Configuration pos',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/config/softwareeqdocs'
            ),
            22 =>
            array (
                'id' => 23,
                'code' => 'XML',
                'name' => 'XML',
                'protocol' => 'http://',
                'url' => '/api/ubl2.1/download/'
            ),
        ));
    }
}

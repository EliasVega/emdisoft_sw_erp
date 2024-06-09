<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cash_registers')->delete();

        DB::table('cash_registers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'cash_initial' => 0,
                'in_cash' => 0,
                'out_cash' => 0,
                'in_total' => 0,
                'out_total' => 0,
                'cash_in_total' => 0,
                'cash_out_total' => 0,
                'invoice_order' => 0,
                'restaurant_order' => 0,
                'in_invoice_cash' => 0,
                'in_invoice' => 0,
                'invoice' => 0,
                'in_remission_cash' => 0,
                'in_remission' => 0,
                'remission' => 0,
                'in_advance_cash' => 0,
                'in_advance' => 0,
                'ndinvoice' => 0,
                'ncpurchase' => 0,
                'purchase_order' => 0,
                'out_purchase_cash' => 0,
                'out_purchase' => 0,
                'purchase' => 0,
                'out_expense_cash' => 0,
                'out_expense' => 0,
                'expense' => 0,
                'out_advance_cash' => 0,
                'out_advance' => 0,
                'ndpurchase' => 0,
                'ncinvoice' => 0,
                'verification_code_open' => '28211716',
                'verification_code_close' => null,
                'status' => 'open',
                'start_date' => null,
                'end_date' => null,
                'sale_point_id' => 1,
                'user_id' => 1,
                'user_open_id' => 1,
                'user_close_id' => null,
                'created_at' => '2024-05-25 21:07:42',
                'updated_at' => '2024-05-25 21:07:42'
            ),
        ));
    }
}

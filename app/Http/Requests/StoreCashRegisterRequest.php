<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cash_initial' => '',
            'in_cash' => '',
            'out_cash' => '',
            'in_total' => '',
            'out_total' => '',
            'cash_in_total' => '',
            'cash_out_total' => '',
            'invoice_order' => '',
            'restaurant_order' => '',
            'in_invoice_cash' => '',
            'in_invoice' => '',
            'invoice' => '',
            'in_advance_cash' => '',
            'in_advance' => '',
            'ndinvoice' => '',
            'ndpurchase' => '',
            'ncinvoice' => '',
            'ncpurchase' => '',
            'purchase_order' => '',
            'out_purchase_cash' => '',
            'out_purchase' => '',
            'purchase' => '',
            'out_expense_cash' => '',
            'out_expense' => '',
            'expense' => '',
            'out_advance_cash' => '',
            'out_advance' => '',
            'verification_code_open' => '',
            'verification_code_close' => '',
            'status' => '',
            'branch_id' => '',
            'user_id' => '',
            'user_open' => '',
            'user_close' => ''
        ];
    }
}

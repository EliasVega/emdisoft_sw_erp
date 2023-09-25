<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'document' => 'string|max:20',
            'generation_date'=> '',
            'total' => 'required|numeric',
            'total_tax' => '',
            'total_pay' => '',
            'pay' => '',
            'balance' => 'numeric',
            'grand_total' => 'numeric',
            'branch_id' => 'integer',
            'provider_id' => '',
            'payment_form_id' => 'required|integer',
            'payment_method_id' => 'required',
            'voucher_type_id' => 'integer'
        ];
    }
}

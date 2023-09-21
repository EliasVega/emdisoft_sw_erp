<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrePurchaseRequest extends FormRequest
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
            'total' => 'required|numeric',
            'total_iva' => 'required|numeric',
            'total_pay' => 'required|numeric',
            'balance' => 'numeric',
            'status' => 'in:active,debit_note,credit_note,adjustment_note',
            'branch_id' => 'integer',
            'provider_id' => 'required|integer',
        ];
    }
}

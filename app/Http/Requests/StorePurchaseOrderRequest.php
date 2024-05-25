<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'total' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'total_pay' => 'required|numeric',
            'balance' => 'numeric',
            'status' => 'in:active,generate,canceled',
            'type_product' => 'in:product,raw_material',
            'note' => 'nullable|string',
            'provider_id' => 'required|integer',
            'cash_register_id' => 'nullable'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantOrderRequest extends FormRequest
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
            'status' => 'in:pending,generated,canceled',
            'user_id' => '',
            'restaurant_table_id' => 'integer',
            'invoice_id' => 'nullable'
        ];
    }
}

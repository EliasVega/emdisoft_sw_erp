<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'identification' => 'required|string|unique:customers|max:12',
            'dv' => 'nullable|string|max:1',
            'address' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:12',
            'email' => 'required|email|max:100',
            'merchant_registration' => 'string|max:12',
            'credit_limit' => 'nullable|numeric',
            'used' => 'nullable|numeric',
            'available' => 'nullable|numeric',
            'department_id' => 'nullable|integer',
            'municipality_id' => 'nullable|integer',
            'identification_type_id' => 'integer',
            'liability_id' => 'nullable|integer',
            'organization_id' => 'nullable|integer',
            'regime_id' => 'nullable|integer'
        ];
    }
}

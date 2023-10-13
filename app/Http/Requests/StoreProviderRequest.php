<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            'identification' => 'required|string|unique:providers|max:12',
            'dv' => 'required|string|max:1',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:100',
            'merchant_registration' => 'string|max:12',
            'contact' => 'nullable|string|max:100',
            'phone_contact' => 'nullable|string|max:12',
            'department_id' => 'required|integer',
            'municipality_id' => 'required|integer',
            'postal_code_id' => 'required|integer',
            'identification_type_id' => 'required|integer',
            'liability_id' => 'required|integer',
            'organization_id' => 'required|integer',
            'regime_id' => 'required|integer'
        ];
    }
}

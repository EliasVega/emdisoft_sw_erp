<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            /*
            'name' => 'string|max:65',
            'nit' => 'string|max:20',
            'dv' => 'string|max:1',
            'address' => 'string|max:100',
            'phone' => 'string|max:12',
            'api_token' => 'string|max:100',
            'email' => '',
            'emailfe' => '',
            'merchant_registration' => '',
            'imageName' => '',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pos_invoice' => 'string|max:20',
            'pos_purchase' => 'string|max:20',
            'status' => 'in:activo,inactivo',
            'department_id' => '',
            'municipality_id' => '',
            'identification_type_id' => '',
            'liability_id' => '',
            'organization_id' => '',
            'regime_id' => '',*/
        ];
    }
}

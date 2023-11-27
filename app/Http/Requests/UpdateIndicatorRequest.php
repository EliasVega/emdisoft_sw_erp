<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndicatorRequest extends FormRequest
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
            'smlv' => 'required|numeric',
            'transport_assistance' => 'required|numeric',
            'weekly_hours' => 'required|numeric',
            'uvt' => 'required|numeric',
            'plastic_bag_tax' => 'required',
            'dian' => 'in:on,off',
            'pos' => 'in:on,off',
            'logo' => 'in:on,off',
            'payroll' => 'in:on,off',
            'accounting' => 'in:on,off',
            'inventory' => 'in:on,off',
            'product_price' => 'in:automatic,manual',
            'raw_material' => 'in:on,off',
            'restaurant' => 'in:on,off'
        ];
    }
}

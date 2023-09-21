<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndicatorRequest extends FormRequest
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
            'plastic_bag_tax' => 'required',
            'dian' => 'in:on,off',
            'post' => 'required|in:on,off',
            'payroll' => 'required|in:on,off',
            'accounting' => 'required|in:on,off',
            'inventory' => 'in:on,off',
            'product_price' => 'in:automatic,manual'
        ];
    }
}

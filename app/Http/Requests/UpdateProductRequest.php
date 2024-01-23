<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'code' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'sale_price' => '',
            'commission' => 'nullable',
            'stock' => '',
            'stock_min' => 'nullable',
            'type_product' => 'required|in:product,service,consumer',
            'status' => 'in:active,inactive',
            'category_id' => 'required|integer',
            'measure_unit_id' => 'required|integer'
        ];
    }
}

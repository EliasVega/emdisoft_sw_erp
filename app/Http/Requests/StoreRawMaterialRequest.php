<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRawMaterialRequest extends FormRequest
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
            'code'            => 'required|string|max:20',
            'name'            => 'required|string|max:100',
            'price'           => 'required|numeric',
            'stock'           => '',
            'type_product'    => 'required|in:product,service',
            'status'          => 'in:active,inactive',
            'category_id'     => 'required|integer',
            'measure_unit_id' => 'required|integer'
        ];
    }
}

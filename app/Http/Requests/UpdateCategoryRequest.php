<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name,'.$this->category->id,'|max:45',
            'description' => 'required|string|max:255',
            'utility_rate' => 'required|numeric|between:0,99.99|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            'status' => 'in:active,inactive',
            'company_tax_id' => 'required|numeric'
        ];
    }
}

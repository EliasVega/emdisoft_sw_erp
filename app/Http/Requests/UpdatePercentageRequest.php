<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePercentageRequest extends FormRequest
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
            'name' => 'required|string|max:45',
            'percentage' => 'required|numeric',
            'base' => '',
            'base_uvt' => '',
            'concept' => 'nullable|string|max:255',
            'status' => 'in:active,inactive',
            'tax_type_id' => 'required|numeric'
        ];
    }
}

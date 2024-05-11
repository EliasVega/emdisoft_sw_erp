<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalePointRequest extends FormRequest
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
            'branch_id' => 'required',

            'plate_number' => 'required|string|unique:sale_points,plate_number,'.$this->salePoint->id,'|max:20',
            'location' => 'required|string|max:100',
            'cash_type' => 'required|string|max:100'
        ];
    }
}

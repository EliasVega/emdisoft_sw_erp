<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoftwareRequest extends FormRequest
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
            'company_id' => '',
            'identifier' => 'nullable|string|max:64',
            'pin' => 'nullable|string|max:5',
            'test_set' => 'nullable|string|max:64',
            'identifier_payroll' => 'nullable|string|max:64',
            'pin_payroll' => 'nullable|string|max:5',
            'payroll_test_set' => 'nullable|string|max:64',
            'identifier_equidoc' => 'nullable|string|max:64',
            'pin_equidoc' => 'nullable|string|max:5',
            'equidoc_test_set' => 'nullable|string|max:64',
        ];
    }
}

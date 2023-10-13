<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNdinvoiceResponseRequest extends FormRequest
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
            'document' => 'required|string|max:20',
            'cude' => 'required|string|max:100',
            'message' => 'required|string|max:100',
            'valid' => 'required|string|max:5',
            'code' => 'required|string|max:3',
            'description' => 'required|string|max:100',
            'status_message' => 'required|string|max:100',
            'ndinvoice_id' => 'required|integer'
        ];
    }
}

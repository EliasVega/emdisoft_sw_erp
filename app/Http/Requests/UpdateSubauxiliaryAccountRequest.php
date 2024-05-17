<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubauxiliaryAccountRequest extends FormRequest
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
            'code' =>'required|string|unique:subauxiliary_accounts,code,'.$this->subauxiliaryAccount->id,'|max:10',
            'status'       => 'in:active,inactive,locked',
            'subauxiliary_account_id' => 'required|exists:subauxiliary_accounts,id',
        ];
    }
}

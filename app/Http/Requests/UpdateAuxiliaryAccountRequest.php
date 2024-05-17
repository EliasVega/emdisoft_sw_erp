<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuxiliaryAccountRequest extends FormRequest
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
            'code' =>'required|string|unique:auxiliary_accounts,code,'.$this->auxiliaryAccount->id,'|max:8',
            'status'       => 'in:active,inactive,locked',
            'subaccount_id' => 'required|exists:subaccounts,id',
        ];
    }
}

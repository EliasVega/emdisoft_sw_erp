<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubaccountRequest extends FormRequest
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
            'code' =>'required|string|unique:subaccounts,code,'.$this->subaccount->id,'|max:6',
            'name' => 'required|string|max:100',
            'status'       => 'in:active,inactive,locked',
            'account_id' => 'required|exists:accounts,id'
        ];
    }
}

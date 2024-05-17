<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountGroupRequest extends FormRequest
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
            'code' =>'required|string|unique:account_groups,code,'.$this->accountGroup->id,'|max:2',
            'name' => 'required|string|max:50',
            'account_class_id' => 'required|exists:account_classes,id',
        ];
    }
}

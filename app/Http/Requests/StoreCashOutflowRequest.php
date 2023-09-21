<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashOutflowRequest extends FormRequest
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
            'cash' => 'required',
            'reason' => 'required|string|max:50',
            'cash_register_id' => '',
            'user_id' => '',
            'branch_id' => '',
            'admin_id' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherTypeRequest extends FormRequest
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
            'code' => 'required|unique:voucher_types,code,|string|max:4',
            'name' => 'required|unique:voucher_types,name,|string|max:50',
            'consecutive' => 'required|integer',
            'status' => 'required|in:active,inactive'
        ];
    }
}

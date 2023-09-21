<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepayRequest extends FormRequest
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
            'pay' => 'required',
            'balance' => 'numeric',
            'type' => 'in:purchase,invoice,advance',
            'user_id' => 'integer',
            'branch_id' => 'integer'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayRequest extends FormRequest
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
            'type' => 'in:purchase,invoice,expense,remission,advance,work_labor,payroll',
            'user_id' => 'integer',
            'branch_id' => 'integer'
        ];
    }
}

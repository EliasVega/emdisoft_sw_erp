<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvanceRequest extends FormRequest
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

            'document' => 'string|max:20',
            'origin' => 'string|max:50',
            'destination' => 'nullable|string',
            'pay' => '',
            'balance' => 'numeric',
            'note' => 'nullable|string|max:255',
            'status' => 'in:pending,partial,applied',
            'type_third' =>  'in:customer,provider,employee',
            'user_id' => 'integer',
            'branch_id' => 'integer',
            'voucher_type_id' => 'integer'
        ];
    }
}

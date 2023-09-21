<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNcpurchaseRequest extends FormRequest
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
            'docuemnt' => 'string|max:20',
            'retention' => 'numeric',
            'total' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'total_pay' => 'required',
            'branch_id' => 'integer',
            'purchase_id' => 'integer',
            'product_id' => '',
            'provider_id' => 'integer',
            'resolution_id' => '',
            'discrepancy_id' => 'integer',
            'voucher_type_id' => 'integer'
        ];
    }
}

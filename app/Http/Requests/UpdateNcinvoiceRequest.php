<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNcinvoiceRequest extends FormRequest
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
            'docuemnt' => 'required|string|max:20',
            'retention' => 'numeric',
            'total' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'total_pay' => 'required',
            'branch_id' => 'integer',
            'invoice_id' => 'integer',
            'product_id' => 'integer',
            'customer_id' => 'integer',
            'discrepancy_id' => 'integer',
            'voucher_type_id' => 'integer'
        ];
    }
}

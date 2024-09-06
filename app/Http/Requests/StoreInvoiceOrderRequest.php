<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceOrderRequest extends FormRequest
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
            'generation_date' => 'date',
            'due_date' => 'date',
            'total' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'total_pay' => 'required|numeric',
            'balance' => 'numeric',
            'status' => 'in:active,generate,canceled',
            'type' => 'in:order,pre-invoice,quote',
            'branch_id' => 'integer',
            'customer_id' => 'required|integer',
            'invoice_id' => 'nullable',
            'cash_register_id' => 'nullable'
        ];
    }
}

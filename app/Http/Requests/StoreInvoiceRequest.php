<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'document' => 'string|max:20',
            'generation_date' => 'date',
            'due_date' => 'date',
            'total' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'total_pay' => 'required|numeric',
            'pay' => '',
            'balance' => 'numeric',
            'retention' => 'numeric',
            'grand_total' => 'numeric',
            'status' => 'in:invoice,debit_note,credit_note,complete',
            'note' => 'nullable|string|max:255',

            'user_id' => 'integer',
            'branch_id' => 'integer',
            'customer_id' => 'integer',
            'payment_form_id' => 'required|integer',
            'payment_method_id' => 'required',
            'resolution_id' => '',
            'voucher_type_id' => 'integer',
            'document_type_id' => 'integer'
        ];
    }
}

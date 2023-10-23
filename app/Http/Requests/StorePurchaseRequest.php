<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'invoice_code'=>'string|max:20',
            'generation_date'=> 'required|date',
            'due_date' => 'required|date',
            'retention' => 'numeric',
            'total' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'total_pay' => 'required|numeric',
            'pay' => '',
            'balance' => 'numeric',
            'grand_total' => 'numeric',
            'start_date' => 'date',
            'status' => 'in:purchase,support_document,debit_note,credit_note,adjustment_note,complete',
            'type_product' => 'in:product,raw_material',
            'branch_id' => 'integer',
            'provider_id' => 'required|integer',
            'payment_form_id' => 'required|integer',
            'payment_method_id' => 'required',
            'resolution_id' => 'integer',
            'generation_type_id' => 'nullable|integer',
            'voucher_type_id' => 'integer',
            'document_type_id' => 'required|integer'
        ];
    }
}

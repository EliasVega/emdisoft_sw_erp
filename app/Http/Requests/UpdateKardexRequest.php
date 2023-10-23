<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKardexRequest extends FormRequest
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
            'branch_id' => 'required|integer',
            'voucher_type_id' => 'required|integer',
            'document' => 'required|string|max:20',
            'quantity' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'in:purchase,expense,invoice,ncpurchase,ndpurchase,ncinvoice,ndinvoice',
        ];
    }
}

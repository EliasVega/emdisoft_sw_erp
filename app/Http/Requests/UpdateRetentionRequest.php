<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRetentionRequest extends FormRequest
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
            'retention' => 'required|numeric',
            'type' => 'in:purchase,invoice,ndpurchase,ncpurchase,ncinvoice,ndinvoice',
            'company_tax_id' => 'integer'
        ];
    }
}

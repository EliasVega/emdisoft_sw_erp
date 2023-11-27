<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'identification' => 'required|string|unique:employees,identification,|max:12',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:100',
            'code' => 'required|string|max:20',
            'salary' => 'required|numeric',
            'admission_date' => 'required|date',
            'account_type' => 'required|string|max:20',
            'account_number' => 'required|string|max:20',
            'status'       => 'in:active,inactive',

            'branch_id' => 'required|integer',
            'department_id' => 'required|integer',
            'municipality_id' => 'required|integer',
            'identification_type_id' => 'required|integer',
            'employee_type_id' => 'required|integer',
            'employee_subtype_id' => 'required|integer',
            'payment_frecuency_id' => 'required|integer',
            'contrat_type_id' => 'required|integer',
            'charge_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'bank_id' => 'required|integer',
        ];
    }
}

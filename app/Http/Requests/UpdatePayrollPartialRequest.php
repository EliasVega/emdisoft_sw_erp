<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollPartialRequest extends FormRequest
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
            'year_month' => '',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payment_date' => 'required|date',
            'generation_date' => 'required|date',
            'days' => '',
            'fortnight' => 'required|in:first,second',
            'note' => 'string|nullable',
            'vacation_days' => '',
            'inability_days' => '',
            'license_days' => '',

            'employee_id' => '',
            'payroll_id' => '',
            'user_id' => ''
        ];
    }
}

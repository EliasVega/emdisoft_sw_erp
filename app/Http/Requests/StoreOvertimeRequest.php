<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOvertimeRequest extends FormRequest
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
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'quantiry' => '',
            'hour_value' => '',
            'total' => '',

            'employee_id' => 'required',
            'overtime_type_id' => 'required'
        ];
    }
}

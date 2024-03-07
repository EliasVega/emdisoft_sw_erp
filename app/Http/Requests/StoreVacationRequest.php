<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacationRequest extends FormRequest
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
            'start_vacations' => 'required|date',
            'end_vacations' => 'required|date',
            'vacation_days' => 'required',
            'value_day' => 'required',
            'value' => 'required|numeric',
            'vacation_adjustment' => '',
            'type' => 'in:enjoyed,compensated'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
            'name'            => 'required|max:50',
            'address'         => 'required|max:50',
            'phone'           => 'max:15',
            'mobile'          => 'max:15',
            'email'           => 'required|max:50',
            'manager'         => 'required|max:50',
            'department_id'   => 'required',
            'municipality_id' => 'required',
            'company_id'      => ''
        ];
    }
}

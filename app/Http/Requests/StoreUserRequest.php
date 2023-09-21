<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [

            'name'        => ['required', 'string', 'max:50'],
            'number'      => ['required', 'string', 'max:20'],
            'address'     => ['required', 'string', 'max:100'],
            'phone'       => ['required', 'string', 'max:20'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:6', 'confirmed'],
            'position'    => ['required', 'string', 'max:50'],
            'transfer'    => 'required',
            'status'       => 'in:active,inactive',
            'branch_id'   => 'required|integer',
            'identification_type_id' => 'required|integer',
            'roles'       => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResolutionRequest extends FormRequest
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
            'prefix' => 'required|string|max:4',
            'resolution' => 'nullable|string|max:20',
            'resolution_date' => 'nullable|date',
            'technical_key' => 'nullable|string|max:64',
            'start_number' => 'required|integer',
            'end_number' => 'required|integer',
            'consecutive' => 'required|integer|gte:start_number',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'document_type_id' => 'required|integer'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can add role/permission checks here later if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('state'); // captures ID for update case

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                'unique:states,title,' . $id,
            ],
            'is_active' => ['nullable', 'boolean'],
            'country_id' => [
                'required',
                'exists:countries,id'
            ]
        ];
    }

    /**
     * Custom messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The state title is required.',
            'title.unique' => 'This state title already exists.',
            'country_id.required' => 'The country is required.',
            'country_id.exists' => 'The selected country is invalid.',
        ];
    }
}

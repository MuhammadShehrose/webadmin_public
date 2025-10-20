<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        $id = $this->route('city'); // captures ID for update case

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                'unique:cities,title,' . $id,
            ],
            'is_active' => ['nullable', 'boolean'],
            'state_id' => [
                'required',
                'exists:states,id'
            ]
        ];
    }

    /**
     * Custom messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The City title is required.',
            'title.unique' => 'This City title already exists.',
            'state_id.required' => 'The state is required.',
            'state_id.exists' => 'The selected state is invalid.',
        ];
    }
}

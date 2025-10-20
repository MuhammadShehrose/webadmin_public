<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $id = $this->route('country'); // captures ID for update case

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                'unique:countries,title,' . $id,
            ],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The country title is required.',
            'title.unique' => 'This country title already exists.',
        ];
    }
}

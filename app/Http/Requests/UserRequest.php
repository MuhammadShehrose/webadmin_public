<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user'); // captures ID for update case

        return [
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'is_active' => [
                'nullable',
                'boolean'
            ],
            'email' => [
                'required',
                'unique:users,email,' . $id,
                'email'
            ],
            'role' => [
                'required',
                'string',
                'exists:roles,name'
            ],
            'password' => [
                $id ? 'nullable' : 'required', // only required on create
                'string',
                'min:8',
                'confirmed',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];
    }
}

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
            'roles' => [
                'required',
                'array'
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

    /**
     * Custom messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The user name is required.',
            'email.required' => 'The email address is required.',
            'email.unique' => 'This email address is already registered.',
            'email.email' => 'Please enter a valid email address.',
            'type.required' => 'The user type is required.',
            'type.in' => 'Invalid user type selected.',
            'roles.required' => 'Please assign at least one role to the user.',
            'password.required' => 'The password field is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be of type: jpg, jpeg, png, or webp.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }
}

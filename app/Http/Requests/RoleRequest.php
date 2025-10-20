<?php

namespace App\Http\Requests;

use App\Enums\RoleGroup;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = $this->route('role'); // captures ID for update case

        // get valid enum values dynamically
        $roleGroups = array_keys(RoleGroup::options());

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:roles,name,' . $id,
            ],
            'group' => [
                'required',
                Rule::in($roleGroups),
            ],
            'permissions' => [
                'nullable',
                'array'
            ]
        ];
    }

    /**
     * Custom messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The role name is required.',
            'name.unique' => 'This role name already exists.',
        ];
    }
}

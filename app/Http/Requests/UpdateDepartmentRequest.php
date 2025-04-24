<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $departmentId = $this->route('department')->id;

        return [
            'name' => ['required','string','max:255',
                Rule::unique('departments')->ignore($departmentId)
            ],
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:users,id'
        ];
    }
}

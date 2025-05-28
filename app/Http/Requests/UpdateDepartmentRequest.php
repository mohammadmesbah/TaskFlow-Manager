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
        return $this->user()->can("update", $this->department);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         // Explicitly get the department ID
         $departmentId = $this->route('department')->id;
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('departments')
                    ->ignore($this->department) // Model binding
                   
            ],
            'description' => 'sometimes|nullable|string',
            'manager_id' => 'sometimes|nullable|exists:users,id'
        ];
    }

    // Optional: Custom error messages
    public function messages()
    {
        return [
            'name.unique' => 'This department name already exists.',
        ];
    }
}

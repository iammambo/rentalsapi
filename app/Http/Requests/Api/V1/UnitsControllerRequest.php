<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UnitsControllerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:300',
            'description' => 'nullable|string|max:500',
            'image_url' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom validation messages for the unit request.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'We need the unit name before we proceed.',
            'name.min' => 'The unit name must be at least 2 characters.',
            'name.max' => 'The unit name may not be greater than 300 characters.',
            'description.max' => 'The description may not be greater than 500 characters.',
            'image_url.max' => 'The image URL may not be greater than 255 characters.',
        ];
    }
}

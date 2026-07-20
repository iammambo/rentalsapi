<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false; // You can add authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // User fields
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'other_names' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'profile_photo' => 'nullable|string|max:255',

            // Address fields
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'county' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255|default:Kenya',

            // Property Owner specific fields
            'owner_type' => 'nullable|string|in:individual,company,trust,partnership',
            'national_id' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
            'tax_pin' => 'nullable|string|max:100',
            'business_name' => 'nullable|string|max:255|required_if:owner_type,company,partnership',
            'business_registration_no' => 'nullable|string|max:255',

            // Owner Address
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'owner_city' => 'required|string|max:255',
            'owner_county' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'owner_country' => 'nullable|string|max:255|default:Kenya',

            // Emergency Contact
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',

            // Additional
            'notes' => 'nullable|string',
            'signature' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'The email address is already registered.',
            'phone.unique' => 'The phone number is already registered.',
            'password.min' => 'The password must be at least 8 characters.',
            'business_name.required_if' => 'Business name is required for company or partnership owners.',
            'date_of_birth.before' => 'Date of birth must be a past date.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'country' => $this->input('country', 'Kenya'),
            'owner_country' => $this->input('owner_country', 'Kenya'),
        ]);
    }
}

<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{

    use ApiResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'                => 'required|email|unique:users',
            'password'             => 'required|confirmed',
            'terms_and_conditions' => 'nullable|boolean',
        ];
    }

    /**
     * Define the custom validation error messages.     *
     * @return array The custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'email.required'                => 'Email address is required.',
            'email.email'                   => 'Email address must be a valid email format.',
            'email.unique'                  => 'This email is already taken.',
            'password.required'             => 'Password is required.',
            'password.confirmed'            => 'Passwords do not match.',
        ];
    }

    /**
     * Handles failed validation by formatting the validation errors and throwing a ValidationException.
     */
    protected function failedValidation(Validator $validator): never
    {
        $message = $validator->errors()->first();

        $response = $this->error(422, $message, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}

<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ForgetPasswordResetRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => "required|email|exists:users,email",
            'password' => "required|confirmed",
        ];
    }

    /**
     * Define the custom validation error messages.
     * @return array The custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'email.required'     => 'Email address is required.',
            'email.email'        => 'Email address must be a valid email format.',
            'email.exists'       => 'No user found with this email',
            'password.required'  => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
        ];
    }

    /**
     * Handles failed validation by formatting the validation errors and throwing a ValidationException.
     * @throws ValidationException The exception is thrown to halt further processing and return validation errors.
     */
    protected function failedValidation(Validator $validator): never
    {

        $emailErrors    = $validator->errors()->get('email') ?? null;
        $passwordErrors = $validator->errors()->get('password') ?? null;
        // Determine the error message to return based on which field has validation errors
        if ($emailErrors) {
            $message = $emailErrors[0];
        } else if ($passwordErrors) {
            $message = $passwordErrors[0];
        }

        $response = $this->error(
            422,
            $message,
            $validator->errors(),
        );
        throw new ValidationException($validator, $response);
    }
}

<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PasswordChangeRequest extends FormRequest
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
            'current_password' => 'required|current_password',
            'password'         => 'required|confirmed|min:6',
        ];
    }

    /**
     * Define custom validation messages for the fields.
     *
     * @return array The custom error messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'current_password.required'         => 'Current password is required.',
            'current_password.current_password' => 'The provided password does not match your current password.',
            'password.required'                 => 'New password is required.',
            'password.confirmed'                => 'New password confirmation does not match.',
            'password.min'                      => 'Password must be at least 6 characters.',
        ];
    }

    /**
     * Handles failed validation by formatting the validation errors and throwing a ValidationException.
     * @throws ValidationException The exception is thrown to halt further processing and return validation errors.
     */
    protected function failedValidation(Validator $validator): never
    {
        $currentPasswordErrors = $validator->errors()->get('current_password') ?? null;
        $passwordErrors        = $validator->errors()->get('password') ?? null;


        if ($currentPasswordErrors) {
            $message = $currentPasswordErrors[0];
        } else if ($passwordErrors) {
            $message = $passwordErrors[0];
        } else {
            $message = 'Validation failed.';
        }

        $response = $this->error(
            422,
            $message,
            $validator->errors(),
        );

        throw new ValidationException($validator, $response);
    }
}

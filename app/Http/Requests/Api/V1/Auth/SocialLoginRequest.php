<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SocialLoginRequest extends FormRequest
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
            'token'    => 'required|string',
            'provider' => 'required|in:google,facebook',
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     * @return array The custom error messages for validation failures.
     */
    public function messages(): array
    {
        return [
            'token.required'    => 'Token is required',
            'provider.required' => 'Provider is required',
            'provider.in'       => 'Invalid provider selected. The available options are Google & Facebook.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     * @param Validator $validator The validator instance containing the validation errors.
     * @throws ValidationException Throws a validation exception with the custom error response.
     */
    protected function failedValidation(Validator $validator): never
    {
        $tokenErrors    = $validator->errors()->get('token') ?? null;
        $providerErrors = $validator->errors()->get('provider') ?? null;

        if ($tokenErrors) {
            $message = $tokenErrors[0];
        } else {
            $message = $providerErrors[0];
        }

        $response = $this->error(
            422,
            $message,
            $validator->errors(),
        );

        throw new ValidationException($validator, $response);
    }
}

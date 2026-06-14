<?php

namespace App\Http\Requests\Api\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // User table fields validation rules
            'first_name'                => 'nullable|string|max:255',
            'last_name'                 => 'nullable|string|max:255',
            'email'                     => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()?->id),
            ],
            'phone'                     => 'nullable|string|max:20',
            'handle'                    => 'nullable|string|max:255',
            'avatar'                    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10048',
            'cover_photo'               => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10048',
            'job_title'                 => 'nullable|string|max:255',
            'company_name'              => 'nullable|string|max:255',
            'location'                  => 'nullable|string',
            'bio'                       => 'nullable|string',

            // Contact table fields
            'contact'                   => 'nullable|array',
            'contact.website'           => 'nullable|string|max:255',
            'contact.instagram'         => 'nullable|string|max:255',
            'contact.tiktok'            => 'nullable|string|max:255',
            'contact.linkedin'          => 'nullable|string|max:255',
            'contact.other'             => 'nullable|string|max:255',

            // Business table Card fields
            'business_card'             => 'nullable|array',
            'business_card.front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10048',
            'business_card.back_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10048',
            'business_card.is_active'   => 'nullable|boolean',

            // Payment Link  table fields
            'payment_link'              => 'nullable|array',
            'payment_link.enabled'      => 'nullable|boolean',
            'payment_link.type'         => 'nullable|in:payment,booking',
            'payment_link.button_label' => 'nullable|string|max:100',
            'payment_link.external_url' => 'nullable|string',

            // Theme fields table  fields
            'theme'                     => 'nullable|array',
            'theme.name'                => 'nullable|string|max:255',
            'theme.description'         => 'nullable|string|max:255',
            'theme.primary_color'       => 'nullable|string|max:7',
            'theme.accent_color'        => 'nullable|string|max:7',
        ];
    }
}

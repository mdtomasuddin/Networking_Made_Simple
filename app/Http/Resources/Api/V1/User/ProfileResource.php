<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'first_name'           => $this->first_name,
            'last_name'            => $this->last_name,
            'phone'                => $this->phone,
            'handle'               => $this->handle,
            'email'                => $this->email,
            'email_verified_at'    => $this->email_verified_at,
            'avatar'               => $this->avatar,
            'cover_photo'          => $this->cover_photo,
            'job_title'            => $this->job_title,
            'company_name'         => $this->company_name,
            'location'             => $this->location,
            'bio'                  => $this->bio,
            'role_id'              => $this->role_id,
            'nfc_card_id'          => $this->nfc_card_id,
            'terms_and_conditions' => $this->terms_and_conditions,
            'status'               => $this->status,
            'created_at'           => $this->created_at,
            // Relationships and nested data can be included as needed
            'contact'              => [
                'website'   => $this->contact?->website,
                'instagram' => $this->contact?->instagram,
                'tiktok'    => $this->contact?->tiktok,
                'linkedin'  => $this->contact?->linkedin,
                'other'     => $this->contact?->other,
            ],
            'business_card'        => [
                'front_image' => $this->businessCard?->front_image,
                'back_image'  => $this->businessCard?->back_image,
            ],
            'payment_link'         => [
                'enabled'      => (bool) $this->paymentLink?->enabled,
                'type'         => $this->paymentLink?->type,
                'button_label' => $this->paymentLink?->button_label,
                'external_url' => $this->paymentLink?->external_url,
            ],
            'theme'                => [
                'name'          => $this->theme?->name,
                'description'   => $this->theme?->description,
                'primary_color' => $this->theme?->primary_color,
                'accent_color'  => $this->theme?->accent_color,
            ],
        ];
    }
}

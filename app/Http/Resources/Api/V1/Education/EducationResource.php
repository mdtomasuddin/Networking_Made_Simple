<?php

namespace App\Http\Resources\Api\V1\Education;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'degree'      => $this->degree,
            'institution' => $this->institution,
            'year'        => $this->year,
        ];
    }
}

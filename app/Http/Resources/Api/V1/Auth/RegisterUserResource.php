<?php
namespace App\Http\Resources\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $user = [
            'id'         => $data['user']['id'] ?? null,
            'first_name' => $data['user']['first_name'] ?? null,
            'last_name'  => $data['user']['last_name'] ?? null,
            'handle'     => $data['user']['handle'] ?? null,
            'email'      => $data['user']['email'] ?? null,
            'role'       => $data['user']['role']['name'] ?? null,
        ];
        return [
            'token'  => $data['token'] ?? null,
            'verify' => $data['verify'] ?? null,
            'user'   => $user ?? null,
        ];
    }
}

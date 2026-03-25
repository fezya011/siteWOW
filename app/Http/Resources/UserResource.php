<?php
// app/Http/Resources/UserResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'avatar' => $this->avatar ? asset('storage/avatars/' . $this->avatar) : null,
            'location' => $this->location,
            'occupation' => $this->occupation,
            'education' => $this->education,
            'bio' => $this->bio,
            'website' => $this->website,
            'phone' => $this->phone,
            'social' => [
                'facebook' => $this->facebook,
                'twitter' => $this->twitter,
                'instagram' => $this->instagram,
                'github' => $this->github,
                'linkedin' => $this->linkedin,
            ],
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'sure_name' => $this->sure_name,
            'gender' => $this->gender,
            'work_position' => $this->work_position,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'location' => new LocationResource($this->whenLoaded('location')),
        ];
    }
}


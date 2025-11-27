<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'note' => $this->note,
            'scheduled' => $this->scheduled,
            'is_confirmed' => $this->is_confirmed,
            'services' => ServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}

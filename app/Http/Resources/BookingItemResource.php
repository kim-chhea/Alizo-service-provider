<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'booking_id' => $this->booking_id,
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'note' => $this->note,
            'status' => $this->status,
        ];
    }
}

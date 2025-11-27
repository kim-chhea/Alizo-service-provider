<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'cart_id' => $this->cart_id,
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
        ];
    }
}

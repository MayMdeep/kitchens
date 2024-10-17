<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'transaction_type' => (string)$this->transaction_type,
            'product_id' => (int)$this->product_id,
            'location_id' => (int)$this->location_id,
            'user_id' => (int)$this->user_id,
            'quantity' => (int)$this->quantity,
            'notes' => (string)$this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

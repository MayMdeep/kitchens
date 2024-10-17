<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'id' => (int)$this->id,
            'location_id' => (int)$this->location_id,
            'sub_location_id' => (int)$this->sub_location_id,
            'name' => (string)$this->name,
            'status' => (string)$this->status,
            'qr_code' => (string)$this->qr_code,
            'production_date' => $this->production_date,
            'quantity' => $this->quantity,
            'alert_quantity' => $this->alert_quantity,
            'ingredients' => $this->ingredients,
            'expiry_date' => $this->expiry_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        return $result;
    }
}

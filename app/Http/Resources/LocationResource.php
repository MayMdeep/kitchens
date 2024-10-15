<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'kitchen_id' => (int)$this->kitchen_id,
            'name' => (string)$this->name,
            'status' => (string)$this->status,
            'qr_code' => (string)$this->qr_code,
            'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ];
        return $result;
    }
}

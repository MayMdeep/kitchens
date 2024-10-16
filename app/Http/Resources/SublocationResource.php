<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SublocationResource extends JsonResource
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
            'name' => (string)$this->name,
            'status' => (string)$this->status,
            'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ];
        return $result;
    }
}

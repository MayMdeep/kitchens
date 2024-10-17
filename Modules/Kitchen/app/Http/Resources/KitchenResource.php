<?php

namespace Modules\Kitchen\App\Http\Resources;

use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KitchenResource extends JsonResource
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
            'name' => (string)$this->name,
            'products' => LocationResource::collection($this->locations) ,
            'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ];
        return $result;
    }
}

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
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "type" => $this->type,
            "rarity" => $this->rarity,
            "left" => $this->left,
            "image_url" => $this->image_url ? asset('image/' . $this->image_url) : null,
            "status" => $this->status,
        ];
    }
}

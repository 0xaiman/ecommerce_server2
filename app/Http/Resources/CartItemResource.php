<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = $this->getBuyable();

        return [
            'id' => $this->id,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'thumbnail' => $product->getFirstMediaUrl(), // if using Media Library
            ],
            'quantity' => $this->quantity,
            'total' => $this->total(),
        ];
    }
}

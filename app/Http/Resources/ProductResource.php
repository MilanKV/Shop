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
            'id' => $this->id,
            'product_name' => $this->product_name,
            'product_SKU' => $this->product_SKU,
            'short_description' => $this->short_description,
            'long_descriptions' => $this->long_descriptions,
            'purchase_price' => $this->purchase_price,
            'discount_price' => $this->discount_price,
            'product_color' => $this->product_color,
            'product_size' => $this->product_size,
            'quantity' => $this->quantity,
            'image' => $this->image,
            'weight' => $this->weight,
        ];
    }
}

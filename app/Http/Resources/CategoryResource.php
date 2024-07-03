<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_name' => $this->category_name,
            'slug' => $this->slug,
            'category_image' => $this->category_image,
            'is_parent' => $this->is_parent,
            'parent_id' => $this->parent_id,
            // 'parent_category' => new self($this->whenLoaded('parentCategory')),
            'subcategories' => CategoryResource::collection($this->whenLoaded('subcategories')),
        ];
    }
}

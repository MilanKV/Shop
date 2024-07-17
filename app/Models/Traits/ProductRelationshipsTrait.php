<?php

namespace App\Models\Traits;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Images;

trait ProductRelationshipsTrait
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'product_id', 'id');
    }
}
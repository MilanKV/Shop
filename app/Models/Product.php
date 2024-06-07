<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ProductStatus;
use App\Models\Traits\ProductRelationshipsTrait;
use App\Models\Traits\ProductScopesTrait;

class Product extends Model
{
    use HasFactory, SoftDeletes, ProductRelationshipsTrait, ProductScopesTrait;

    protected $fillable = [
        'product_name',
        'slug',
        'product_SKU',
        'short_description',
        'long_descriptions',
        'purchase_price',
        'discount_price',
        'product_color',
        'product_size',
        'quantity',
        'image',
        'weight',
        'status',
        'brand_id',
        'category_id',
        'subcategory_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => ProductStatus::class,
    ];
}

<?php

namespace App\Models\Traits;

trait ProductScopesTrait
{
    public function scopeOrderBySort($query, $sort)
    {
        switch ($sort) {
            case 'Low to High':
                return $query->orderBy('purchase_price', 'asc');
            case 'High to Low':
                return $query->orderBy('purchase_price', 'desc');
            case 'Latest':
                return $query->orderBy('created_at', 'desc');
            case 'On Sale':
                return $query->whereNotNull('discount_price')->orderBy('discount_price', 'desc');
            default:
                return $query->orderBy('purchase_price', 'asc');
        }
    }
}
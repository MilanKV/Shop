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

    public function scopeApplyFilters($query, $filters)
    {
        if (!empty($filters['brand'])) {
            $query->where('brand_id', $filters['brand']);
        }
        if (!empty($filters['color'])) {
            $query->where('product_color', $filters['color']);
        }
        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }
        if (!empty($filters['subcategory'])) {
            $query->where('subcategory_id', $filters['subcategory']);
        }
        if (!empty($filters['price'])) {
            $this->applyPriceFilter($query, $filters['price']);
        }

        return $query;
    }

    private function applyPriceFilter($query, $priceRange)
    {
        switch ($priceRange) {
            case 'Under $50':
                $query->where('purchase_price', '<=', 50);
                break;
            case '$50 - $100':
                $query->whereBetween('purchase_price', [50, 100]);
                break;
            case '$100 - $200':
                $query->whereBetween('purchase_price', [100, 200]);
                break;
            case 'Above $200':
                $query->where('purchase_price', '>', 200);
                break;
        }
    }
}
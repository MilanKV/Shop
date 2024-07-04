<?php

namespace App\Services;

use App\Models\Product;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getFilteredProducts(array $filters, int $perPage): LengthAwarePaginator
    {
        $query = Product::query()->applyFilters($filters)->orderBySort($filters['sort'] ?? 'Low to High');

        $products = $query->paginate($perPage);

        $products->getCollection()->transform(function ($product) {
            $product->image_url = asset('storage/backend/product/product_images/' . $product->image);
            return $product;
        });

        return $products;
    }

    // Count products by brand, color, price and subcategory 
    public function getProductCounts(array $filters): array
    {
        $brandCounts = Product::select('brand_id', DB::raw('count(*) as count'))
            ->groupBy('brand_id')
            ->pluck('count', 'brand_id');

        $colorCounts = Product::select('product_color', DB::raw('count(*) as count'))
            ->applyFilters($filters)
            ->groupBy('product_color')
            ->pluck('count', 'product_color');

        $priceCounts = [
            'Under $50' => Product::query()->where('purchase_price', '<=', 50)->applyFilters($filters)->count(),
            '$50 - $100' => Product::query()->whereBetween('purchase_price', [50, 100])->applyFilters($filters)->count(),
            '$100 - $200' => Product::query()->whereBetween('purchase_price', [100, 200])->applyFilters($filters)->count(),
            'Above $200' => Product::query()->where('purchase_price', '>', 200)->applyFilters($filters)->count(),
        ];

        $subCategoryCounts = Product::select('subcategory_id', DB::raw('count(*) as count'))
            ->groupBy('subcategory_id')
            ->pluck('count', 'subcategory_id');

        return [
            'brands' => $brandCounts,
            'colors' => $colorCounts,
            'prices' => $priceCounts,
            'subCategorys' => $subCategoryCounts,
        ];
    }
}
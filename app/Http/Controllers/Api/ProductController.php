<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $sort = $request->query('sort', 'Low to High');
        $brand = $request->query('brand', null);
        $color = $request->query('color', null);
        $category = $request->query('category', null);
        $subcategory = $request->query('subcategory', null);
        $priceRange = $request->query('price', null);
        $perPage = $request->input('perPage', 9);

        $query = Product::query();

        if ($brand) {
            $query->where('brand_id', $brand);
        }
        if ($color) {
            $query->where('product_color', $color);
        }
        if ($category) {
            $query->where('category_id', $category);
        }
        if ($subcategory) {
            $query->where('subcategory_id', $subcategory);
        }
        if ($priceRange) {
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

        $query->orderBySort($sort);

        $products = $query->paginate($perPage);

        $products->getCollection()->transform(function ($product) {
            $product->image_url = asset('storage/backend/product/product_images/' . $product->image);
            return $product;
        });

        // Count products by brand, color, and price range
        $brandCounts = Product::select('brand_id', DB::raw('count(*) as count'))
            ->groupBy('brand_id')
            ->pluck('count', 'brand_id');

        $colorCounts = Product::select('product_color', DB::raw('count(*) as count'))
            ->groupBy('product_color')
            ->pluck('count', 'product_color');

        $priceCounts = [
            'Under $50' => Product::where('purchase_price', '<=', 50)->count(),
            '$50 - $100' => Product::whereBetween('purchase_price', [50, 100])->count(),
            '$100 - $200' => Product::whereBetween('purchase_price', [100, 200])->count(),
            'Above $200' => Product::where('purchase_price', '>', 200)->count(),
        ];

        $subCategoryCounts = Product::select('subcategory_id', DB::raw('count(*) as count'))
            ->groupBy('subcategory_id')
            ->pluck('count', 'subcategory_id');

        return response()->json([
            'products' => ProductResource::collection($products),
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
            ],
            'counts' => [
                'brands' => $brandCounts,
                'colors' => $colorCounts,
                'prices' => $priceCounts,
                'subCategorys' => $subCategoryCounts,
            ],
        ]);
    }
}

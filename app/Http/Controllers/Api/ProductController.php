<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        $filters = $request->only(['sort', 'brand', 'color', 'category', 'subcategory', 'price']);
        $perPage = $request->input('perPage', 9);

        $products = $this->productService->getFilteredProducts($filters, $perPage);
        $counts = $this->productService->getProductCounts($filters);

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
            'counts' => $counts,
        ]);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'subcategory', 'images'])->findOrFail($id);

        $product->images->each(function ($image) {
            $image->url = url('storage/' . $image->photo_name);
        });

        return response()->json($product);
    }
}

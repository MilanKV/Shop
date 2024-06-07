<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {

        $sort = $request->query('sort', 'Low to High');

        $products = Product::orderBySort($sort)->get();
        return response()->json(ProductResource::collection($products));
    }
}

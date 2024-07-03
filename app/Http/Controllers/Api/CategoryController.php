<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['parentCategory', 'subcategories'])->where('is_parent', true)->get();

        return response()->json(CategoryResource::collection($categories));
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['parentCategory', 'subcategories'])->where('is_parent', true)->get();

        $categories->map(function ($category) {
            $category->image_url = asset('storage/backend/category/category_images' . $category->category_image);
            return $category;
        });

        return response()->json(CategoryResource::collection($categories));
    }
}
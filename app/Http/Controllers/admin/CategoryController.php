<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);

        $categories = Category::orderBy('created_at', 'desc')->paginate($perPage);
        $categories->appends(['perPage' => $perPage]);
        return view('backend.pages.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_cat = Category::where('is_parent', 1)->get();
        return view('backend.pages.Category.create', compact('parent_cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {   
        // Validation
        $validatedData = $request->validated();

        // Handling file upload for category image
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('public/backend/category/category_images');
            $validatedData['category_image'] = str_replace('public/', '', $imagePath);
        }

        // Generating slug
        $slug = Str::slug($validatedData['category_name']);
        $count = Category::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $validatedData['slug'] = $slug;

        // Creating category
        $category = Category::create($validatedData);

        if ($category) {
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category )
    {
        $parent_cat = Category::where('is_parent', 1)->with('subcategories')->get();
        return view('backend.pages.Category.edit', compact('category', 'parent_cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // Validate the incoming request
        $validatedData = $request->validated();

        // Handling file upload for category image
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('public/backend/category/category_images');
            $validatedData['category_image'] = str_replace('public/', '', $imagePath);
        }
        
        // Generating slug
        $slug = Str::slug($validatedData['category_name']);
        $count = Category::where('slug', $slug)->where('id', '!=', $category->id)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $validatedData['slug'] = $slug;

        // Update category
        $category->update($validatedData);

        if ($category) {
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update category. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $child_cat_id = Category::where('parent_id', $category->id)->pluck('id');
        $category->delete();

        if ($category) {
            if (count($child_cat_id) > 0) {
                Category::whereIn('id', $child_cat_id)->update(['is_parent' => 1]);
            }
            return redirect()->route('category.index')->with('success', 'Category deleted');
        } else {
            return redirect()->back()->with('error', 'Error while deleting category');
        }
    }

    public function getChildByParent(Request $request)
    {
        $category = Category::find($request->id);
        
        if (!$category) {
            return response()->json(['status' => false, 'msg' => 'Category not found', 'data' => null]);
        }

        $childCategories = Category::where('parent_id', $request->id)->orderBy('id', 'ASC')->pluck('title', 'id');
    
        if ($childCategories->isEmpty()) {
            return response()->json(['status' => false, 'msg' => 'No child categories found', 'data' => null]);
        } else {
            return response()->json(['status' => true, 'msg' => 'Child categories found', 'data' => $childCategories]);
        }
    }
}

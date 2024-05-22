<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);

        $search = $request->input('search');
        $query = Category::where('is_parent', 1);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('category_name', 'LIKE', "%{$search}%")
                    ->orWhere('status', '=', $search)
                    ->orWhere('short_description', 'LIKE', "%{$search}%");
            });
        }

        $categories = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $categories->appends(['perPage' => $perPage, 'search' => $search]);
        return view('backend.pages.Category.index', compact('categories', 'search'));
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
    public function store(CategoryStoreRequest $request)
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

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parent_cat = Category::where('is_parent', 1)->with('subcategories')->get();
        return view('backend.pages.Category.edit', compact('category', 'parent_cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
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

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $childCategories = Category::where('parent_id', $category->id)->get('id');

        foreach ($childCategories as $childCategory) {
            $childCategory->delete();
        }

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.s');
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

    public function deactivated(Category $category)
    {
        $categories = Category::onlyTrashed()->whereNull('parent_id')->get();

        return view('backend.pages.Category.deactivated', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id)->restore();

        // Restore soft-deleted subcategories
        $subCategories = Category::onlyTrashed()->where('parent_id', $id)->get();
        foreach ($subCategories as $subCategory) {
            $subCategory->restore();
        }

        return redirect()->back()->with('success', 'Category restored successfully.');
    }

    public function permanentDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        // Delete the category's image from storage if it exists
        if ($category->category_image) {
            Storage::delete('public/' . $category->category_image);
        }

        // Permanent delete subcategories
        $subCategories = Category::onlyTrashed()->where('parent_id', $id)->get();
        foreach ($subCategories as $subCategory) {
            $subCategory->forceDelete();
        }

        $category->forceDelete();

        return redirect()->back()->with('success', 'Category permanently deleted.');
    }
}

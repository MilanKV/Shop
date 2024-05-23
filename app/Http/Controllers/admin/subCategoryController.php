<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\subCategoryStoreRequest;
use App\Http\Requests\subCategoryUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');
        $sortColumn = $request->input('sortColumn', 'created_at');
        $sortDirection = $request->input('sortDirection', 'desc');

        $query = Category::whereNotNull('parent_id');
        if ($search) {
            $query->where('category_name', 'LIKE', "%{$search}%")
                ->orWhere('status', '=', $search)
                ->orWhere('short_description', 'LIKE', "%{$search}%")
                ->orWhereHas('parentCategory', function ($q) use ($search) {
                    $q->where('category_name', 'LIKE', "%{$search}%");
                });
        }

        $categories = $query->orderBy($sortColumn, $sortDirection)->paginate($perPage);
        $categories->appends(['perPage' => $perPage, 'search' => $search, 'sortColumn' => $sortColumn, 'sortDirection' => $sortDirection]);

        return view('backend.pages.subCategory.index', compact('categories', 'search', 'sortColumn', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_cat = Category::where('is_parent', 1)->get();
        return view('backend.pages.subCategory.create', compact('parent_cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(subCategoryStoreRequest $request)
    {
        // Validation
        $validatedData = $request->validated();

        // Handling file upload for subcategory image
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
        $validatedData['is_parent'] = 0;

        // Creating subcategory
        $category = Category::create($validatedData);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parent_cat = Category::where('is_parent', 1)->get();
        return view('backend.pages.subCategory.edit', compact('category', 'parent_cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(subCategoryUpdateRequest $request, Category $category)
    {
        // Validate the incoming request
        $validatedData = $request->validated();

        // Handling file upload for subcategory image
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

        // Update subcategory
        $category->update($validatedData);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('subcategory.index')->with('success', 'SubCategory deleted successfully.');
    }

    public function deactivated()
    {
        $categories = Category::onlyTrashed()->whereNotNull('parent_id')->get();

        return view('backend.pages.subCategory.deactivated', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('subcategory.index')->with('success', 'SubCategory restored successfully.');
    }

    public function permanentDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        // Delete the subcategory's image from storage if it exists
        if ($category->category_image) {
            Storage::delete('public/' . $category->category_image);
        }

        $category->forceDelete();

        return redirect()->route('subcategory.index')->with('success', 'SubCategory permanently deleted.');
    }
}

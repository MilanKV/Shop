<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
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

        $query = Brand::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('brand_name', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%")
                    ->orWhere('status', '=', $search);
            });
        }

        $brands = $query->orderBy($sortColumn, $sortDirection)->paginate($perPage);
        $brands->appends(['perPage' => $perPage, 'search' => $search, 'sortColumn' => $sortColumn, 'sortDirection' => $sortDirection]);
        return view('backend.pages.Brand.index', compact('brands', 'search', 'sortColumn', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.Brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        // Validation
        $validatedData = $request->validated();

        // Handling file upload for brand image
        if ($request->hasFile('brand_image')) {
            $imagePath = $request->file('brand_image')->store('public/backend/brand/brand_images');
            $validatedData['brand_image'] = str_replace('public/', '', $imagePath);
        }

        // Generating slug
        $slug = Str::slug($validatedData['brand_name']);
        $count = Brand::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $validatedData['slug'] = $slug;

        // Creating brand
        $brand = Brand::create($validatedData);

        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
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
    public function edit(Brand $brand)
    {
        return view('backend.pages.Brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        // Validation
        $validatedData = $request->validated();

        // Handling file upload for brand image
        if ($request->hasFile('brand_image')) {
            $imagePath = $request->file('brand_image')->store('public/backend/brand/brand_images');
            $validatedData['brand_image'] = str_replace('public/', '', $imagePath);
        }

        // Generating slug
        $slug = Str::slug($validatedData['brand_name']);
        $count = Brand::where('slug', $slug)->where('id', '!=', $brand->id)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $validatedData['slug'] = $slug;

        // Update brand
        $brand->update($validatedData);

        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $deleted = $brand->delete();

        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully');
    }

    public function deactivated(Brand $brand)
    {
        $brands = Brand::onlyTrashed()->get();

        return view('backend.pages.Brand.deactivated', compact('brands'));
    }

    public function restore($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id)->restore();

        return redirect()->back()->with('success', 'Brand restored successfully.');
    }

    public function permanentDelete($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);

        // Delete the user's image from storage if it exists
        if ($brand->brand_image) {
            Storage::delete('public/' . $brand->brand_image);
        }

        $brand->forceDelete();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);

        $brands = Brand::orderBy('created_at', 'desc')->paginate($perPage);
        $brands->appends(['perPage' => $perPage]);
        return view('backend.pages.Brand.index', compact('brands'));
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

        if ($brand) {
            return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create brand. Please try again.');
        }
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

        if ($brand) {
            return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create brand. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $deleted = $brand->delete();

        if ($deleted) {
            return redirect()->route('brand.index')->with('success', 'Brand deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Error while deleting brand');
        }
    }
}

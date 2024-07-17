<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Images;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
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

        $query = Product::with('images');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'LIKE', "%{$search}%")
                    ->orWhere('product_SKU', 'LIKE', "%{$search}%")
                    ->orWhere('purchase_price', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('status', '=', $search)
                    ->orWhereHas('subcategory', function ($q) use ($search) {
                        $q->where('category_name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $products = $query->orderBy($sortColumn, $sortDirection)->paginate($perPage);
        $products->appends(['perPage' => $perPage, 'search' => $search, 'sortColumn' => $sortColumn, 'sortDirection' => $sortDirection]);
        return view('backend.pages.Product.index', compact('products', 'search', 'sortColumn', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::all();
        return view('backend.pages.Product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request, Product $product)
    {
        // Validate the incoming request
        $validatedData = $request->validated();

        // Generating slug
        $slug = Str::slug($validatedData['product_name']);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $validatedData['slug'] = $slug;
        $validatedData['category_id'] = $request->input('category_id');
        $validatedData['subcategory_id'] = $request->input('subcategory_id');

        // Creating product
        $product = Product::create($validatedData);

        // Handling file upload for product image
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePath = $file->store('public/backend/product/product_images');
                $photoName = str_replace('public/', '', $imagePath);
                $product->images()->create(['photo_name' => $photoName]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
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
    public function edit(Product $product)
    {
        $brands = Brand::get();
        $categories = Category::all();
        return view('backend.pages.Product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        // Validate the incoming request
        $validatedData = $request->validated();

        // Handle removal of all images if requested
        if ($request->input('remove_all_images') == '1') {
            // Delete images from storage
            foreach ($product->images as $image) {
                Storage::delete('public/' . $image->photo_name);
                $image->delete();
            }
        }

        // Handle file upload for new product images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePath = $file->store('public/backend/product/product_images');
                $photoName = str_replace('public/', '', $imagePath);
                $product->images()->create(['photo_name' => $photoName]);
            }
        }

        // Updating product
        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the products images from storage if they exist
        foreach ($product->images as $image) {
            if ($image->photo_name) {
                Storage::delete('public/' . $image->photo_name);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }

    public function deactivated(Product $product)
    {
        $products = Product::onlyTrashed()->get();

        return view('backend.pages.Product.deactivated', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id)->restore();

        return redirect()->back()->with('success', 'Product restored successfully.');
    }

    public function permanentDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        // Delete the product's images from storage if they exist
        foreach ($product->images as $image) {
            if ($image->photo_name) {
                Storage::delete('public/' . $image->photo_name);
            }
            $image->forceDelete();
        }

        $product->forceDelete();

        return redirect()->back();
    }
}
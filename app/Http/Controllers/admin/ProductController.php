<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
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

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'LIKE', "%{$search}%")
                    ->orWhere('product_SKU', 'LIKE', "%{$search}%")
                    ->orWhere('purchase_price', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('status', '=', $search)
                    ->orWhereHas('parentCategory', function ($q) use ($search) {
                        $q->where('category_name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $products = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $products->appends(['perPage' => $perPage, 'search' => $search]);
        return view('backend.pages.Product.index', compact('products', 'search'));
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

        // Handling file upload for product image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/backend/product/product_images');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
        }

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

        // Handling file upload for product image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/backend/product/product_images');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
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
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}


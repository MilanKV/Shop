<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);

        $products = Product::orderBy('created_at', 'desc')->paginate($perPage);
        $products->appends(['perPage' => $perPage]);
        return view('backend.pages.Product.index', compact('products'));
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
    public function store(ProductRequest $request, Product $product)
    {
        // Validate the incoming request
        $validatedData = $request->validated();

        // Handling file upload for category image
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

        if ($product) {
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create product. Please try again.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if ($product) {
            return redirect()->route('product.index')->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Error while deleting product');
        }
    }
}


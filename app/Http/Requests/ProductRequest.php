<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug|max:255',
            'product_SKU' => 'required|numeric|unique:products,product_SKU',
            'short_description' => 'nullable|string|max:500',
            'long_descriptions' => 'nullable|string',
            'purchase_price' => 'nullable|numeric',
            'selling_price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'product_color' => 'nullable|string|max:50',
            'product_size' => 'nullable|string|max:20',
            'product_tags' => 'nullable|string|max:255',
            'product_code' => 'nullable|string|max:50',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'weight' => 'nullable|numeric|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
        ];
    }
}

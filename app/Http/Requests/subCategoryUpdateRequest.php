<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subCategoryUpdateRequest extends FormRequest
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
            'category_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'short_description' => 'nullable|string|max:255',
            'category_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }
}

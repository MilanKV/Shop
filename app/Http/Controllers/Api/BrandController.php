<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request) 
    {
        $query = $request->query('query');

        $brands = Brand::query()
        ->when($query, function ($query, $search) {
            return $query->where('brand_name', 'like', $search . '%');
        })
        ->get();

        return response()->json(BrandResource::collection($brands));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() 
    {
        $brands = Brand::all();
        return response()->json(BrandResource::collection($brands));
    }
}

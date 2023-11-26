<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BrandCollection;
use App\Http\Resources\v1\Tag as BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return new BrandCollection($brands);
    }

    public function show(Brand $brand){
        return new BrandResource($brand);
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductCollection;
use App\Http\Resources\v1\Product as ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){

        $products = Product::query();
        $products = $products->where('parent','=',0)->get();

//        return dd($products);

        return new ProductCollection($products);
    }

    public function search($keyword){
        $products = Product::query();
        $products = $products->where('parent','=',0)->get();
//            ->where('title','Like', '%'.$keyword.'%')->get();

        return new ProductCollection($products);
    }

    public function show(Product $product){
        return new ProductResource($product);
    }


}

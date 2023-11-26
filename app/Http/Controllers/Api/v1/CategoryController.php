<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Category as CategoryResource;
use App\Http\Resources\v1\CategoryCollection;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return new CategoryCollection($categories);
    }

    public function show(Category $category){
        return new CategoryResource($category);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {

        $images = ProductGallery::query();
        $images = $images->where('product_id',$product->id)->paginate();

//        dd($images);
        return view('admin.products.gallery.all', compact('product','images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
//        dd($product);
        return view('admin.products.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}

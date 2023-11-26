<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $brands = Brand::all();
        return view('admin.brands.index' , compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $input = $request->validate([
            'title' => 'required',
            'slug' => 'nullable',
            'description' => 'nullable',
            'url' => 'nullable',
            'parent' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_status' => 'nullable',
            'status' => 'nullable',
            'image' =>'nullable'
        ]);
//        if (isset($request->image)) {
//            $imageName = time() . '.' . $request->image->extension();
//            $request->image->move(public_path('images/brands'), $imageName);
//            $input['image'] = $imageName;
//        }

        Brand::create($input);

        return redirect(route('admin.brands.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $input = $request->validate([
            'title' => 'required',
            'slug' => 'nullable',
            'image' => 'nullable',
            'description' => 'nullable',
            'url' => 'nullable',
            'parent' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_status' => 'nullable',
            'status' => 'nullable',
        ]);

//        if (isset($request->image)) {
//            $imageName = time().'.'.$request->image->extension();
//            $request->image->move(public_path('images/brands'), $imageName);
//            $input['image'] = $imageName;
//        }
//        dd($input);

        $brand->update($input);

        return redirect(route('admin.brands.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('parent' , 0)->latest()->paginate(10);
//        dd($categories);
        return view('admin.categories.all' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if($request->parent) {
            $request->validate([
                'parent' => 'exists:categories,id'
            ]);
        }

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
//            $request->image->move(public_path('images/categories'), $imageName);
//            $input['image'] = $imageName;
//        }
        Category::create($input);

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if($request->parent) {
            $request->validate([
                'parent' => 'exists:categories,id'
            ]);
        }

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
//            $request->image->move(public_path('images/categories'), $imageName);
//            $input['image'] = $imageName;
//        }

        $category->update($input);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}

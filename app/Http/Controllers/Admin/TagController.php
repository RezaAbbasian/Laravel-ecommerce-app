<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tags = Tag::all();
        return view('admin.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
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
//            $request->image->move(public_path('images/tags'), $imageName);
//            $input['image'] = $imageName;
//        }

        Tag::create($input);
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit' , compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
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
//            $request->image->move(public_path('images/tags'), $imageName);
//            $input['image'] = $imageName;
//        }

        $tag->update($input);
        return redirect()->route('admin.tags.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back();
    }
}

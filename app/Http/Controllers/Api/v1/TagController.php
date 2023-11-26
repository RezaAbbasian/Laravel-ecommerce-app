<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Tag as TagResource;
use App\Http\Resources\v1\TagCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return new TagCollection($tags);
    }

    public function show(Tag $tag){
        return new TagResource($tag);
    }
}

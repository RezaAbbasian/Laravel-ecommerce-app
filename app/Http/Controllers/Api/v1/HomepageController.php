<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function sliders(){

    }

    public function tags(){
    $tags = Tag::all();
    return response()->json($tags);
    }

    public function latest(){

    }

    public function girl(){

    }

    public function girltags(){

    }

    public function boy(){

    }

    public function boytags(){

    }

    public function sport(){

    }

    public function sporttags(){

    }

    public function sale(){

    }

    public function brands(){

    }

    public function article(){
        return response()->json();
    }


}

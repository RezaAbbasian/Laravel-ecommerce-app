<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\User as UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){
        //validation data
        $input = $this->validate($request , [
            'mobile' => 'nullable',
            'email' => 'nullable',
            'password' => 'required'
        ]);

//        dd($input);
        //check login user
        if(! Auth::attempt($input)){
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }
            return new UserResource(Auth::user());

        //return response

    }

    public function register(Request $request){
        //validation data
        $input = $this->validate($request , [
            'name' => 'required',
            'email' => 'nullable',
            'mobile' => 'nullable',
            'password' => 'required'
        ]);
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return new UserResource($user);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}

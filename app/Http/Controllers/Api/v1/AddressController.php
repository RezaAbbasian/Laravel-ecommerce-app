<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AddressCollection;
use App\Http\Resources\v1\Address as AddressResource;
use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(){
        $addresses= auth()->user()->addresses()->get();
    return new AddressCollection($addresses);
    }

    public function provinces(){
    $provinces = Province::all();
    return response()->json($provinces);
    }

    public function cities($id){
//  dd($province);
    $cities = City::where('province_id', '=', $id)->get();
    return response()->json($cities);
    }

    public function show(Address $address){
        $address = auth()->user()->addresses()->find($address);
        return new AddressResource($address);
    }

    public function store(Request $request){
        $input = $request->validate([
            'title' => 'required',
            'user_id'=> 'null',
            'province_id'=> 'required',
            'city_id'=> 'required',
            'address'=> 'required',
            'no'=>'required',
            'unit'=>'required',
            'postal_code'=>'required',
            'full_name'=>'required',
            'mobile'=>'required',
            'lat'=>'',
            'long'=>'',
        ]);
        if (!$input){
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }

        $user_id = auth()->user()->addresses()->create($input);
        return response()->json(['message'=>'success']);
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request){
        $input = $request->validate([
            'order_id' => 'required',
            'user_id'=> 'null',
            'resnumber'=> 'required',
            'card_num'=> 'required',
            'amount'=> 'required',
            'date'=>'required',
            'time'=>'required',
            'type'=>'null',
            'status'=>'null',
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

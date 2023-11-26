<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index(){
        $orders = auth()->user()->orders()->get();
        if($orders){

        }
//        dd($orders);
        $shippings = Shipping::all();
        $addresses = auth()->user()->addresses()->get();
        $user_id =  auth()->user()->id;
        $carts = Cart::where('user_id',$user_id)->get();
//        dd($itemes);
//        $itemes->where('user_id', $user_id)->get();
        return view('cart.index', compact('carts','addresses', 'shippings','orders'));
    }

    public function removeItem(Product $product, Request $request){
        $cart = Cart::where('product_id',$product->id)->first();
//        dd($cart->id);
        $cart->delete();
        return redirect()->route('cart.index');
    }

    public function addtocart(Product $product, Request $request){

//        dd($request->product);
        $input = $request->validate([
            'user_id' =>  '',
            'product_id'=> '',
            'quantity'=> '',
        ]);
        $input['user_id'] = auth()->user()->id;
        $input['product_id'] = $product->id;
        $input['quantity'] = $request->quantity;
//        dd($input);


        $existingCartItem = Cart::where([
            'user_id' => $input['user_id'],
            'product_id' => $input['product_id'],
        ])->first();

        if ($existingCartItem) {
            // اگر محصول قبلاً در سبد خرید افزوده شده، تعداد جدید را با تعداد قبلی جمع می‌کنیم
            $existingCartItem->update([
                'quantity' => $existingCartItem->quantity + $input['quantity'],
            ]);
        } else {
            // اگر محصول قبلاً در سبد خرید افزوده نشده، آیتم جدید را ایجاد می‌کنیم
            Cart::create([
                'user_id' => $input['user_id'],
                'product_id' => $input['product_id'],
                'quantity' => $input['quantity'],
            ]);
        }

//        $cart = Cart::updateOrCreate([
//            'product_id' => $input['product_id'],
//            'user_id' => $input['user_id']
//        ],
//            [
//                'quantity' =>  $input['quantity']
//            ]
//        );
//        $cart = Cart::find('user_id', $input['user_id']);
//        $cart->products()->syncWithPivotValues($input);
        return redirect()->route('cart.index');
    }


}

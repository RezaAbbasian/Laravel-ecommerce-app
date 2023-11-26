<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class OrdersController extends Controller
{
    public function index(){

        $orders = auth()->user()->orders()->get();

        dd($orders);

    }

    public function create(Cart $carts ,Request $request){
        $input = $request->validate([
            'status' => 'null',
            'coupon_id' => '',
            'address_id' => 'required',
            'shipping_id' => 'required',
            'shipping_price' => 'null',
            'tax_rate_id' => 'null',
            'subtotal' => 'null',
            'discount' => 'null',
            'subtotal_less_discount' => 'null',
            'tax_rate' => 'null',
            'total_tax_rate' =>'null',
            'total'=> 'null',
            'user_id' => 'null',
            'tracking_code' => 'null',
            'order_num' => 'null',
        ]);

        if($input['coupon_id']){
            $input['coupon_id'] = Coupon::find($input['coupon_id'])->id;
        }else{
            $input['coupon_id'] = null;
        }
        $cartItems = $carts->all();
//        dd($cartItems);
        if ($cartItems->count()){
            $price = $cartItems->sum(function ($cartItems){
                return $cartItems['product']->price * $cartItems['quantity'];
            });
        }

        $orderItems = $cartItems->mapWithKeys(function ($cart){
            return [
                $cart['product']->id => [
                    'quantity' => $cart['quantity'],
                    'title' => $cart['product']->title,
                    'product_num' => $cart['product']->product_num,
                    'unit_price' => $cart['product']->price,
                    'total' => ($cart['product']->price * $cart['quantity'])
                ]];
        });

//        dd(auth()->user()->orders->pluck('shipping_id')->toArray());

            if($input['shipping_id'] == 2 && in_array($input['shipping_id'] , auth()->user()->orders->pluck('shipping_id')->toArray()) && in_array( 'Processing', auth()->user()->orders->pluck('status')->toArray()))
            {

                $shipping_price = 0;

            }elseif($input['shipping_id'] == 3 && in_array($input['shipping_id'] , auth()->user()->orders->pluck('shipping_id')->toArray()) && in_array( 'Processing', auth()->user()->orders->pluck('status')->toArray()))
            {
                $shipping_price = 0;
            }else{
                $shipping_price=Shipping::find($input['shipping_id'])->price;
            }

//            dd($shipping_price);
//        dd(in_array($input['shipping_id'] , auth()->user()->orders->pluck('shipping_id')->toArray()));

//                if($input['shipping_id'] == 3 && in_array($input['shipping_id'] , auth()->user()->orders->pluck('shipping_id')->toArray()) ){
//                    dd(in_array($input['shipping_id'] , auth()->user()->orders->pluck('shipping_id')->toArray()));
//                }
        //        if(Shipping::where('id', $input['shipping_id'])->lists('id')->all())


//        dd($shipping_price);
        $input['shipping_price'] = $shipping_price;
        $input['subtotal'] = $price;
        $input['discount'] = null;
        $input['subtotal_less_discount'] = $price;
        $input['tax_rate'] = 1;
        $input['total_tax_rate'] = 1;
        $input['total'] = $price + $shipping_price;
        $input['order_num'] = "BSO-00".mt_rand(1000000000,9999999999);
        $input['tax_rate_id'] = 1;
        $input['tracking_code'] = null;
        $input['user_id'] = auth()->user()->id;
        $input['status'] = 'Pending Payment';

        $order = auth()->user()->orders()->create($input);

        $order->products()->attach($orderItems);

        return redirect(route('orders.checkout', compact('order')));
    }


    public function checkout(Order $order)
    {
        return view('orders.checkout', compact('order'));
    }

    public function gotobank(Order $order){

//        dd($order->id);
        // Create new invoice.
        $invoice = (new Invoice)->amount($order->total);
        // Purchase and pay the given invoice.
        // You should use return statement to redirect user to the bank page.

        return ShetabitPayment::purchase($invoice, function($driver, $transactionId) use ($order){
            // Store transactionId in database as we need it to verify payment in the future.
            $order->payments()->create(
                [
                    'order_id' => $order->id,
                    'resnumber' => $transactionId
                ]
            );
        })->pay()->render();


    }

    public function paymentCallback(Request $request)
    {
//        dd($request->all());
        try {
            $payment = Payment::where('resnumber',$request->Authority)->firstOrFail();
            $receipt = ShetabitPayment::amount($payment->order->total)->transactionId($request->Authority)->verify();
            // You can show payment referenceId to the user.
            $payment->update([
                'status' => 1
            ]);
            $payment->order()->update([
                'status'=> 'Processing'
            ]);

            echo $receipt->getReferenceId();

        } catch (InvalidPaymentException $exception) {
            /**
            when payment is not verified, it will throw an exception.
            We can catch the exception to handle invalid payments.
            getMessage method, returns a suitable message that can be used in user interface.
             **/
            echo $exception->getMessage();
        }
    }



    public function checkCoupon(Request $request){
        $data = $request->validate([
            'coupon' => '',
        ]);

        $coupon = Coupon::where('title' , $data['coupon'])->first();
        if(is_null($coupon))
            return response(0);

        return response(1);
    }

    public function checkDiscount(Request $request)
    {
        $discountCode = $request->input('discount_code');
        ($discountCode);
        $discount = Coupon::where('code', $discountCode)->first();

        if ($discount) {
            return response()->json([
                'success' => true,
                'coupon_code' => $discount->code,
                'discount_percent' => $discount->percent,
                'discount_amount' => $discount->price,
                'coupon_id' => $discount->id,
                'message' => 'کد تخفیف اعتبار دارد.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'کد تخفیف معتبر نیست.',
            ]);
        }
    }
}

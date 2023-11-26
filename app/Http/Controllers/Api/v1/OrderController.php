<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\OrderCollection;
use \App\Http\Resources\v1\Order as OrderResource;
use App\Http\Resources\v1\Product as ProductResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;

class OrderController extends Controller
{
    //

    public function index(){
    $orders = auth()->user()->orders()->get();
//    dd($orders);
    return new OrderCollection($orders);
    }

    public function show(Request $request, Order $order){
        $order = auth()->user()->orders()->find($order);
//        $products = $order->products()->get();
        return new OrderResource($order);

    }

    public function store(Request $request){

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
            'delivery_time' => 'required',
            'sabad' => ' '
        ]);

    $cartItems = collect($input['sabad']);

    $orderItems = $cartItems->mapWithKeys(function ($cart){
        return
        [
            $cart['id'] => [
                'quantity' => $cart['qty'],
                'title' => Product::find($cart['id'])->title,
                'product_num' => Product::find($cart['id'])->product_num,
                'unit_price' => Product::find($cart['id'])->price,
                'total' => Product::find($cart['id'])->price * $cart['qty']
            ]];
    });


        if ($cartItems->count()){
            $price = $cartItems->sum(function ($cartItems){
                return Product::find($cartItems['id'])->price * $cartItems['qty'];
            });
        }


        $dateStr= $input['delivery_time'];
        $dateString = \Morilog\Jalali\CalendarUtils::convertNumbers($dateStr, true); // 1395-02-19
        $dateToG = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $dateString)->format('Y/m/d'); //2016-05-8

        $input['delivery_time'] = $dateToG;

//        $time = Carbon::now();
//        $input['delivery_time'] = match ($input['delivery_time']) {
//            '' => $time->addDays(3),
//            '' => $time->addDays(15),
//            default => $time,
//        };


        $shipping_price = Shipping::find($input['shipping_id'])->price;
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
//        dd($order);
        return new OrderResource($order);
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

            return redirect('https://babyshikshop.com');
//            echo $receipt->getReferenceId();
//            echo('<br/>');
//            echo('بازگشت به وبسایت');
//            echo('<br/>');
//            echo ('https://babyshikshop.com');

        } catch (InvalidPaymentException $exception) {
            /**
            when payment is not verified, it will throw an exception.
            We can catch the exception to handle invalid payments.
            getMessage method, returns a suitable message that can be used in user interface.
             **/
            echo $exception->getMessage();
        }
    }

    public function gotocard(Order $order, Request $request)
    {
        $input = $request->validate([
            'order_id' => 'null',
            'user_id'=> 'null',
            'image'=> 'nullable',
            'resnumber'=> 'required',
            'card_num'=> 'required',
            'amount'=> 'required',
            'date'=> 'required',
            'time'=> 'required',
            'type'=> 'null',
            'status'=> 'null',
        ]);
//        dd($input);
        if (!$input){
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }

        $checkExpiredOrder = Carbon::parse($order->created_at);
        $checkExpiredOrder = $checkExpiredOrder->addHours(1);

        if(Carbon::now() > $checkExpiredOrder ){
            return response([
                'data' => 'این سفارش لغو شده است',
                'status' => 'expired'
            ],403);
        }

        $input['type'] = "Offline";
        $input['status'] = 1;
        if (isset($input['image'])) {
            $imageName = now()->timestamp . '.' . $request->image->extension();
            $request->image->move(public_path('images/cardtocard'), $imageName);
            $input['image'] = $imageName;
        }
        $payment = $order->payments()->create($input);
        $payment->order()->update([
            'status'=> 'On Hold'
        ]);

//        $user_id = auth()->user()->addresses()->create($input);
        return response()->json(['message'=>'success']);
    }


}

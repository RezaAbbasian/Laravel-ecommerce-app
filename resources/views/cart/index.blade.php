@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table>
            <th>#</th>
            <th>عنوان</th>
            <th>تعداد</th>
            <th>قیمت</th>
            <?php $total= 0 ; $subtotal_less_discount= 0 ; $discount= 0 ; $subtotal= 0; ?>
            @foreach($carts as $cart)
                <tr>
                <td>{{++$loop->index}}</td>
                <td><h5 class="card-title">{{$cart->product->title}}</h5></td>
                <td>
                    <form action="">
                        <input type="number" value="{{$cart->quantity}}">
                    </form>
                </td>
                <td><h5 class="card-title">{{$cart->product->price}}</h5></td>
            <?php
            $subtotal = $subtotal + ($cart->product->price * $cart->quantity) ;
            $subtotal_less_discount= 0 ;
            $discount= 0 ;
            $total= $subtotal - $discount ;
            ?>
                <td>
                    <form action="{{route('cart.remove.item', ['product'=> $cart->product])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">حذف</button>
                    </form>
                </td>
                </tr>
            @endforeach
            <tr>
                <td>
                    <form method="POST" id="discountForm">
                        @csrf
                        <input type="text" name="discount_code" id="discountCode" placeholder="کد تخفیف">
                        <button type="submit">اعمال</button>
                    </form>
                </td>
            </tr>

            <tr>
                <td>subtotal:</td>
                <td>
                {{$subtotal}}
                </td>
            </tr>
            <tr><td>discount</td></tr>
            <tr><td>subtotal_less_discount</td></tr>
            <tr>
                <td>total</td>
                <td>{{$total}}</td>
            </tr>
        </table>
        <br>
        <br>

        <form action="{{route('orders.create', ['carts'=> $carts])}}" method="post">
            @csrf
            <input type="hidden" name="coupon_id" id="coupon_id" value="">
            <div class="row">
                @if($addresses)
                    <label>انتخاب آدرس</label>
                    @foreach($addresses as $address)
                    <label class="card" style="width: 18rem;" for="address_id">
                    <div class="card-body">
                        <input type="radio" id="address_id" name="address_id" value="{{$address->id}}">
                        <h5 class="card-title">{{$address->title}}</h5>
                        <p class="card-text">{{$address->state_id}}, {{$address->city_id}}, {{$address->address}}</p>
                    </div>
                </label>
                    @endforeach
                    <label class="card" style="width: 18rem;" for="address_id">
                        <a href="#" class="btn btn-primary">ثبت آدرس جدید</a>
                    </label>
                @else
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                @endif
            </div>

            <div class="row">
                    <label>انتخاب نحوه ارسال</label>
                @if($orders)
                    @foreach($shippings as $shipping)
                        <label class="card" style="width: 18rem;" for="shipping_id">
                            <div class="card-body">
                                <input type="radio" id="shipping_id" name="shipping_id" value="{{$shipping->id}}">
                                <h5 class="card-title">{{$shipping->title}}</h5>
                            </div>
                        </label>
                    @endforeach
                        <label class="card" style="width: 18rem;" for="shipping_id">

                        <input type="radio" id="shipping_id" name="shipping_id" value="{{$shipping->id}}">
                        <h5 class="card-title">ارسال رایگان با سفارش قبلی</h5>
                        </label>

                @endif

            </div>
            <button class="btn btn-primary">ثب سفارش و پرداخت</button>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script>
        // public/js/discount.js
        $(document).ready(function () {
            $('#discountForm').submit(function (event) {
                event.preventDefault();

                var discountCode = $('#discountCode').val();

                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type' : 'application/json'
                    }
                })

                $.ajax({
                    type: 'GET',
                    url: '{{route('orders.check-discount')}}',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        discount_code: discountCode,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $('#coupon_id').val(response.coupon_id);
                            $('#discountCode').val(response.discount_amount);
                            $('#discountCode').prop('disabled', true);
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (error) {
                        alert('خطا در ارتباط با سرور.');
                    }
                });
            });
        });
    </script>
@endpush

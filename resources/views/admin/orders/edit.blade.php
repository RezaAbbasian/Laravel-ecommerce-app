@extends('admin.master')

@section('content')
    <!-- Main row -->
    <div class="row">
        <section class="col col-lg-12">
                <div class="container">
                    <div class="row">
                        <div class="pl-5">
                            <div>
                                شماره سفارش
                            </div>
                            <div>
                                {{$order->order_num}}
                            </div>
                        </div>
                        <div class="pl-5">
                            <div>
                                نام کاربر
                            </div>
                            <div>
                                {{$order->user->name .' '. $order->user->lastname}}
                            </div>
                        </div>
                        <div class="pl-5">
                            <div>
                                شماره تماس
                            </div>
                            <div>
                                {{$order->user->mobile}}
                            </div>
                        </div>
                        <div class="pl-5">
                            <div>
                                آدرس
                            </div>
                            <div>
                                {{$order->user->address}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h3>کالای سفارش داده شده</h3>
    <table class="table table-bordered">
        <th>
            ردیف
        </th>
        <th>
            عنوان کالا
        </th>
        <th>
            کد کالا
        </th>
        <th>
            تعداد
        </th>
        <th>
           قیمت
        </th>
        <th>
            قیمت نهایی
        </th>
        <tbody>
        @php($sum = 0)
        @foreach($order->products as $product)
        <tr>
            <td>{{$loop->index}}</td>
            <td><a href="{{route('admin.products.edit', ['product'=>$product])}}">{{$product->pivot->title}}</a></td>
            <td>{{$product->pivot->product_num}}</td>
            <td>{{$product->pivot->quantity}}</td>
            <td>{{$product->pivot->unit_price}}</td>
            <td>{{$product->pivot->total}}</td>
            @php($sum += $product->pivot->total)
        </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-left">جمع کل:</td>
            <td>{{$sum}}</td>
        </tr>
        </tbody>

    </table>
                        <form action="{{ route('admin.orders.update', ['order'=>$order]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="pl-5">
                                    <div>
                                        وضعیت سفارش
                                    </div>
                                    <div>
                                        <select name="status">
                                            <option {{ $order->status == 'Cancelled' ? 'selected': '' }} value="Canceled">لغو شده</option>
                                            <option {{ $order->status == 'Completed' ? 'selected': '' }} value="Completed">تکمیل شده</option>
                                            <option {{ $order->status == 'Failed' ? 'selected': '' }} value="Failed">ناموفق</option>
                                            <option {{ $order->status == 'On Hold' ? 'selected': '' }} value="On Hold">در انتظار بررسی</option>
                                            <option {{ $order->status == 'Pending Payment' ? 'selected': '' }} value="Pending Payment">در انتظار پرداخت</option>
                                            <option {{ $order->status == 'Processing' ? 'selected': '' }} value="Processing">در حال انجام</option>
                                            <option {{ $order->status == 'Refunded' ? 'selected': '' }} value="Refunded">مسترد شده</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pl-5">
                                    <div>
                                        نوع پرداخت
                                    </div>
                                    <div>
                                        درگاه انلاین
                                    </div>
                                </div>
                                <div class="pl-5">
                                    <div>
                                        نوع ارسال
                                    </div>
                                    <div>
                                        {{$order->shipping->title}}
                                    </div>
                                </div>
                                <div class="pl-5">
                                    <div>
                                        شماره کارت
                                    </div>
                                    <div>
                                        {{$order->user->mobile}}
                                    </div>
                                </div>
                                <div class="pl-5">
                                    <div>
                                        رسید پرداخت
                                    </div>
                                    <div>
                                        {{$order->user->address}}
                                    </div>
                                </div>
                                <div class="pl-5">
                                    <div>
                                        کد رهگیری
                                    </div>
                                    <div>
                                        <input type="text" name="tracking_code" value="{{$order->tracking_code}}">
                                    </div>
                                </div>
                                <div class="pl-5">
                                    <div class=""><p></p>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary">بروزرسانی سفارش</button>
                                    </div>
                                </div>
                            </div>
                        </form>

        </div> </div>

        </section>
    </div>
    <!-- /.row (main row) -->

@endsection

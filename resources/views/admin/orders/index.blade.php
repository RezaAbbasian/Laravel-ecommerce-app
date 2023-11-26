@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.products.index')}}" method="">
{{--            @csrf--}}
        <input type="text" class="form-control" value="{{request('search')}}" name="search">
            <button>ارسال</button>
        </form>
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>شماره سفارش</th>
                <th>کد رهگیری</th>
                <th>هزینه کل</th>
                <th>کاربر</th>
                <th>آدرس</th>
                <th>تاریخ ایجاد</th>
                <th>تاریخ ویرایش</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($orders as $order)
            <tr>
                <td>{{++$count }}</td>
                <td><a href="{{route('admin.orders.edit', ['order'=>$order])}}">
                    {{$order->order_num}}
                </a></td>
                <td>{{$order->tracking_code ?? 'وارد نشده'}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->user_id}}</td>
                <td> تهران </td>
                <td>{{jdate($order->updated_at)}}</td>
                <td>{{jdate($order->created_at)}}</td>
                <td>{{$order->status}}</td>
                <td>
                    <a href="{{route('admin.orders.edit', ['order'=>$order])}}"><button class="btn btn-info" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
{{--                    <form action="{{route('admin.orders.destroy', ['order'=>$order])}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button class="btn btn-danger" title="حذف">  <i class="fa-solid fa-xmark"></i></button>--}}
{{--                    </form>--}}
                </td>
            </tr>
            @endforeach
            <tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

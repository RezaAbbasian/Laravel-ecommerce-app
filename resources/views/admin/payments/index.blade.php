@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
{{--        <form action="{{route('admin.products.index')}}" method="">--}}
{{--            @csrf--}}
{{--        <input type="text" class="form-control" value="{{request('search')}}" name="search">--}}
{{--            <button>ارسال</button>--}}
{{--        </form>--}}
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>شناسه پرداخت</th>
                <th>کد سفارش</th>
                <th>هزینه کل</th>
                <th>کاربر</th>
                <th>تاریخ ایجاد</th>
                <th>تاریخ ویرایش</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($payments as $payment)
            <tr>
                <td>{{++$count }}</td>
                <td><a href="{{route('admin.payments.edit', ['payment'=>$payment])}}">
                        {{$payment->resnumber}}
                </a></td>

                <td>{{$payment->order()->first()->order_num?? ''}}</td>
                <td>{{$payment->order()->first()->total??''}}</td>
                <td>{{$payment->order->user()->first()->name??''}}</td>
                <td>{{jdate($payment->updated_at)}}</td>
                <td>{{jdate($payment->created_at)}}</td>
                <td>{{$payment->status== 1 ? 'پرداخت شده':'پرداخت نشده'}}</td>
                <td>
                    <a href="{{route('admin.payments.edit', ['payment'=>$payment])}}"><button class="btn btn-info" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
{{--                    <form action="{{route('admin.payments.destroy', ['payment'=>$payment])}}" method="POST">--}}
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

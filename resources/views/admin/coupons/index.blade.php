@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.coupons.index')}}" method="">
{{--            @csrf--}}
        <input type="text" class="form-control" value="{{request('search')}}" name="search">
            <button>ارسال</button>
        </form>
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>برچسب</th>
                <th>تخفیف</th>
                <th>تاریخ ایجاد</th>
                <th>تاریخ ویرایش</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach(\App\Models\Coupon::all() as $coupon)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    <a href="{{route('admin.coupons.show', ['coupon'=>$coupon])}}">
                    {{$coupon->title}}
                    </a>
                </td>
                <td>{{$coupon->price ?? $coupon->percent}}</td>
                <td>{{jdate($coupon->updated_at)}}</td>
                <td>{{jdate($coupon->created_at)}}</td>
                <td>{{$coupon->status == 1 ? 'فعال' : 'غیرفعال'}}</td>
                <td>
                    <a href="{{route('admin.coupons.edit', ['coupon'=>$coupon])}}"><button class="btn btn-info" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                    <form action="{{route('admin.coupons.destroy', ['coupon'=>$coupon])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" title="حذف">  <i class="fa-solid fa-xmark"></i></button>
                    </form>

                </td>
            </tr>
            @endforeach
            <tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

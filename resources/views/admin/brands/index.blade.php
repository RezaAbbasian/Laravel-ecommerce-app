@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
{{--        <form action="{{route('admin.brands.index')}}" method="">--}}
{{--            @csrf--}}
{{--        <input type="text" class="form-control" value="{{request('search')}}" name="search">--}}
{{--            <button>ارسال</button>--}}
{{--        </form>--}}
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th><span class="small">برند</span></th>
                <th><span class="small">محصولات</span></th>
                <th><span class="small">کاربر</span></th>
                <th><span class="small">تاریخ ایجاد</span></th>
{{--                <th>تاریخ ویرایش</th>--}}
                <th><span class="small">وضعیت</span></th>
{{--                <th>عملیات</th>--}}
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($brands as $brand)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    <div>
                        <a href="{{route('admin.brands.show', ['brand'=>$brand])}}">
                            <img class="img-thumbnail img-size-64" src="{{$brand->image}}" alt="">
                            <span class="small">{{$brand->title}}</span>
                        </a>
                    </div>

                    <div class="btn-group">
                        <a href="{{route('admin.brands.edit', ['brand'=>$brand])}}"><button class="btn btn-info btn-sm" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                        <form action="{{route('admin.brands.destroy', ['brand'=>$brand])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="حذف"> <i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </div>
                </td>
                <td>{{$brand->brand_id}}</td>
                <td>{{$brand->products()->count()}}</td>
{{--                <td>{{$brand->user_id}}</td>--}}
{{--                <td>{{jdate($brand->updated_at)}}</td>--}}
                <td><span class="small">{{jdate($brand->created_at)}}</span></td>
                <td><span class="small">{{$brand->status}}</span></td>
{{--                <td>--}}
{{--                </td>--}}
            </tr>
            @endforeach
            <tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

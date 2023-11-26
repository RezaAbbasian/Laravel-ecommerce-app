@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.shipping.index')}}" method="">
{{--            @csrf--}}
        <input type="text" class="form-control" value="{{request('search')}}" name="search">
            <button>ارسال</button>
        </form>
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>زمان ارسال</th>
                <th>شهر</th>
                <th>هزینه ارسال</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($shippings as $shipping)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    <a href="{{route('admin.shipping.show', ['shipping'=>$shipping])}}">
                    {{$shipping->title}}
                    </a>
                </td>
                <td>
روز
                </td>
                <td>کل ایران</td>
                <td>{{$shipping->price}}</td>
                <td>{{$shipping->status == 1 ? 'فعال': 'غیر فعال'}}</td>
                <td>
                    <a href="{{route('admin.shipping.show', ['shipping'=>$shipping])}}"><button class="btn btn-primary" title="مشاهده"><i class="fa-solid fa-eye"></i></button> </a>
                    <a href="{{route('admin.shipping.edit', ['shipping'=>$shipping])}}"><button class="btn btn-info" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                    <form action="{{route('admin.shipping.destroy', ['shipping'=>$shipping])}}" method="POST">
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

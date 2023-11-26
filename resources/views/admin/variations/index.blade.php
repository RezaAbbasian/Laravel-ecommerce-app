@extends('admin.master')
@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-lg-6">
            <a href="{{route('admin.products.variations.create', ['product'=> $product])}}"><button class="btn btn-info" title="">  <i class="fa-solid fa-pen-to-square"></i> ایجاد تنوع جدید</button></a>
        </div>

{{--        <div class="col-lg-6">--}}
{{--            <form action="{{route('admin.products.variations.index')}}" method="">--}}
{{--                --}}{{--            @csrf--}}
{{--                <input type="text" class="form-control" value="{{request('search')}}" name="search">--}}
{{--                <button class="btn form-control">ارسال</button>--}}
{{--            </form>--}}
{{--        </div>--}}

    <section class="col col-lg-12">


        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>تنوع</th>
                <th>تعداد</th>
                <th>قیمت</th>
                <th>تاریخ ایجاد</th>
                <th>تاریخ ویرایش</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($variations as $variation)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    <a href="{{ route('admin.products.variations.edit', ['variation'=>$variation, 'product'=> $variation->parent] ) }}">
                    <img class="img-thumbnail img-size-64" src="/dist/img/AdminLTELogo.png" alt="">
                        {{$product->title}} ->
                        @foreach($variation->attributes as $attribute)
                        {{$attribute->pivot->value->value}}
                        @endforeach
                    </a>
                    <br>
                    کد تنوع:    {{$variation->title}}
                </td>
                <td>{{$variation->inventory}}</td>
                <td>{{$variation->price}}</td>
                <td>{{jdate($variation->updated_at)}}</td>
                <td>{{jdate($variation->created_at)}}</td>
                <td>{{$variation->status == 1 ? 'فعال': 'غیرفعال'}}</td>
                <td>
                    <a href="{{route('admin.products.variations.edit', ['variation'=>$variation,'product'=> $variation->parent])}}"><button class="btn btn-info" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                    <form action="{{route('admin.products.variations.destroy', ['variation'=>$variation,'product'=> $variation->parent])}}" method="POST">
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

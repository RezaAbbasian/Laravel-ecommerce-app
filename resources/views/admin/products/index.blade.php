@extends('admin.master')
@section('content')
    <!-- Main row -->
    <div class="row">
{{--        <div class="col-lg-6">--}}
{{--                <a href="{{route('admin.products.create')}}"><button class="btn btn-primary">ایجاد محصول جدید</button></a>--}}
{{--        </div>--}}

{{--        <div class="col-lg-6">--}}
{{--            <form action="{{route('admin.products.index')}}" method="">--}}
{{--                --}}{{--            @csrf--}}
{{--                <div class=" d-flex flex-row">--}}
{{--                    <input type="text" size="100" class="form-control" value="{{request('search')}}" name="search">--}}
{{--                    <button class="btn btn-info">ارسال</button>--}}
{{--                </div>--}}

{{--            </form>--}}
{{--        </div>--}}
    <section class="col col-12">
        <table class="table">
        <thead>
            <tr>
{{--                <th scope="col">#</th>--}}
                <th scope="col"><span class="small">
                    محصول
                    </span></th>
                <th scope="col">
                    <span class="small">
                        دسته
                    </span></th>
{{--                <th class=""><span class="small">برند</span>--}}
                </th>
{{--                <th>کاربر</th>--}}
{{--                <th>زمان ویرایش</th>--}}
                <th><span class="small">
                    زمان ایجاد
                    </span>
                </th>
                <th><span class="small">
                    وضعیت
                    </span></th>
{{--                <th>عملیات</th>--}}

            </tr>
        </thead>
        <tbody>
        <?php $count =0; ?>
        @foreach($products as $product)
            <tr>
{{--                <td scope="col">{{++$count }}</td>--}}
                <td scope="col">
                    <div>
                        <a href="{{route('admin.products.edit', ['product'=>$product])}}">
                            <img class="img-thumbnail" src="{{($product->image ?? 'noimage.jpg')}}"
                                 alt="" width="50px">
                            <span class="small">{{$product->title}}</span>
                        </a>
                    </div>
                    <div class="btn-group btn-group-sm pt-2">
                        <a href="{{route('admin.products.edit', ['product'=>$product])}}"><button class="btn btn-info btn-sm" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                        <a href="{{route('admin.products.variations.index', ['product'=>$product])}}"><button class="btn btn-info btn-sm" title="تنوع محصول">  <i class="fa-solid fa-layer-group"></i> </button></a>
                        <a href="{{route('admin.products.gallery.index', ['product'=>$product->id])}}"><button class="btn btn-info btn-sm" title="'گالری تصاویر">  <i class="fa-solid fa-images"></i> </button></a>
                        <form action="{{route('admin.products.destroy', ['product'=>$product])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="حذف"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                        <form action="{{route('admin.products.clone', ['product'=>$product])}}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-sm" title="تکثیر"><i class="fa-solid fa-copy"></i></button>
                        </form>
                    </div>
                </td>
                <td scope="col">
                    @foreach($product->categories() as $category)
                        {{ $category->id??'' }}
                    @endforeach
                </td>
{{--                <td>{{$product->brand()->title ?? '' }}</td>--}}
{{--                <td>{{$product->user_id}}</td>--}}
{{--                <td>{{jdate($product->updated_at)}}</td>--}}
                <td scope="col"><span class="small">{{jdate($product->created_at)}}</span></td>
                <td scope="col"><span class="small">{{$product->status == 1 ? 'فعال' : 'غیرفعال'}}</span></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

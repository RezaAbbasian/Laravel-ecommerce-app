@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
{{--        <form action="{{route('admin.tags.index')}}" method="">--}}
{{--            @csrf--}}
{{--        <input type="text" class="form-control" value="{{request('search')}}" name="search">--}}
{{--            <button>ارسال</button>--}}
{{--        </form>--}}
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th><span class="small">برچسب</span></th>
                <th><span class="small">محصولات</span></th>
                <th><span class="small">تاریخ ایجاد</span></th>
{{--                <th><span class="small">تاریخ ویرایش</span></th>--}}
                <th><span class="small">وضعیت</span></th>
{{--                <th>عملیات</th>--}}
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach(\App\Models\Tag::all() as $tag)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    <div>
                        <a href="{{route('admin.tags.show', ['tag'=>$tag])}}">
                            <img class="img-thumbnail img-size-64" src="{{$tag->image}}" alt="">
                            <span class="small">{{$tag->title}}</span>
                        </a>
                    </div>
                    <div class="btn-group btn-group-sm pt-2">
                        <a href="{{route('admin.tags.edit', ['tag'=>$tag])}}"><button class="btn btn-info btn-sm" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                        <form action="{{route('admin.tags.destroy', ['tag'=>$tag])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="حذف"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </div>
                </td>
                <td><span class="small">{{$tag->products()->count()}}</span></td>
{{--                <td>{{jdate($tag->updated_at)}}</td>--}}
                <td><span class="small">{{jdate($tag->created_at)}}</span></th>
                <td><span class="small">{{$tag->status==1 ? 'فعال':'غیرفعال'}}</span></td>
            </tr>
            @endforeach
            <tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

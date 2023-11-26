@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>موبایل</th>
                <th>تاریخ عضویت</th>
                <th>عملیات</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($users as $user)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    <a href="{{route('admin.users.show', ['user'=>$user])}}">{{$user->name}}</a>
                </td>
                <td>{{$user->mobile}}</td>
                <td>{{jdate($user->created_at)}}</td>
                <td>
                    <a href="{{route('admin.users.show', ['user'=>$user])}}"><button class="btn btn-primary" title="مشاهده"><i class="fa-solid fa-eye"></i></button> </a>
                    <a href="{{route('admin.users.edit', ['user'=>$user])}}"><button class="btn btn-info" title="ویرایش">  <i class="fa-solid fa-pen-to-square"></i> </button></a>
                    <button class="btn btn-danger" title="حذف">  <i class="fa-solid fa-xmark"></i></button>
                </td>
            </tr>
            @endforeach
            <tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

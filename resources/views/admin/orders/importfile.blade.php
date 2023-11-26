@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-12">
        <form action="{{route('admin.ordersimport')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label for="file" class="form-label required">فایل را بارگذاری کنید</label>
                <input type="file" name="file" id="file">
            </div>
            <div class="col-6">
                <button class="btn btn-primary">ارسال</button>
            </div>
        </form>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

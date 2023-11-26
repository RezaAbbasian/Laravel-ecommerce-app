@extends('admin.master')
@section('content')

    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.usersimport')}}" method="post" enctype="multipart/form-data">
@csrf
            <label for="file" class="form-label required">file</label>
            <div class="col form-check">
            <input type="file" name="file" id="name">
            </div>

            <button class="btn btn-primary">ثبت نام</button>
        </form>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

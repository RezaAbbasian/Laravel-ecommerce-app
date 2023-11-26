@extends('admin.master')
@section('content')

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>تعداد کاربران</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>تعداد کاربران</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>تعداد کاربران</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>تعداد کاربران</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.users.update', ['user'=>$user])}}" method="post">
@csrf
@method('PUT')
            <label for="name" class="form-label required">نام</label>
            <div class="col form-check">
            <input type="text" name="name" id="name" value="{{$user->name}}">
            </div>

            <label for="lastname" class="form-label required">نام خانوادگی</label>
            <div class="form-check">
            <input type="text" name="lastname" id="lastname" value="{{$user->lastname}}">
            </div>

            <label for="mobile" class="form-label required">شماره موبایل</label>
            <div class="form-check">
            <input type="number" name="mobile" id="mobile" value="{{$user->mobile}}">
            </div>

            <label for="password" class="form-label required">رمزعبور</label>
            <div class="form-check">
            <input type="password" name="password" id="password" value="">
            </div>

            <label for="email" class="form-label required">ایمیل</label>
            <div class="form-check">
            <input type="email" name="email" id="email" value="{{$user->email}}">
            </div>

            <label for="type" class="form-label required">نوع کاربر</label>
            <div id="type" class="form-check">
                <input {{ $user->is_staff == '1' ? 'checked' :''}} class="form-check-input mt-0" type="checkbox" id="is_staff" name="is_staff" value="1">
                <label for="freelancer" class="form-check-label freelancer">
                    کارمند
                </label>

                <input {{ $user->is_admin == '1' ? 'checked' :''}} class="form-check-input mt-0" type="checkbox" id="is_admin" name="is_admin" value="1">
                <label for="freelancer" class="form-check-label freelancer">
                    مدیر
                </label>
            </div>
            <button class="btn btn-primary">ذخیره</button>
        </form>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

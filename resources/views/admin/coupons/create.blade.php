@component('admin.layouts.content' , ['title' => 'ایجاد دسته'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">لیست دسته بندی ها</a></li>
        <li class="breadcrumb-item active">ایجاد دسته</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد کد تخفیف</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">عنوان</label>
                            <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="نام تخفیف را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="limit_price" class="col-sm-2 control-label">سقف تخفیف</label>
                            <input type="number" name="limit_price" class="form-control" id="limit_price" placeholder="سقف تخفیف">
                        </div>
                        <div class="form-group">
                            <label for="code" class="col-sm-2 control-label">کد تخفیف</label>
                            <input type="text" name="code" class="form-control" id="code" placeholder="کد تخفیف">
                        </div>
                        <div class="form-group">
                            <label for="percent" class="col-sm-2 control-label">درصد تخفیف</label>
                            <input type="number" name="percent" class="form-control" id="percent" min="0" max="100" placeholder="درصد تخفیف">
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">مبلغ تخفیف</label>
                            <input type="number" name="price" class="form-control" id="price" placeholder="مبلغ تخفیف">
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">وضعیت</label>
                            <input type="radio" name="status" class="form-control" id="status" value="0">
                            <input type="radio" name="status" class="form-control" id="status" value="1">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت برچسب</button>
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent

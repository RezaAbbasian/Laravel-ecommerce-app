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
        <div class="row">
        <div class="col col-lg-6">
            <b>عنوان محصول</b>
            <p>{{$product->title}}</p>
            <b>توضیحات</b>
            <p>{{$product->description}}</p>
                <b>برند</b>
                <p>{{$product->brand_id}}</p>
                <b>کاربر</b>
                <p>{{$product->user_id}}</p>
                <b>تاریخ ایجاد</b>
                <p>{{$product->created_at}}</p>
                <b>دسته بندی</b>
                <p>{{$product->category_id}}</p>
        </div>
        <div class="col col-lg-6">
            <table class="table">
                    <tr>
                    <th>#</th>
                    <th>عنوان آدرس</th>
                    <th>شهر</th>
                    <th>استان</th>
                    <th>آدرس</th>
                    <th>کدپستی</th>
                    </tr>
                <tr>
                    <td>1</td>
                    <td>محل کار</td>
                    <td>تهران</td>
                    <td>تهران</td>
                    <td>پونک سردارجنگل خ 12 پلاک9 واحد 14</td>
                    <td>1457851245</td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-12">
            <table class="table">
<tr>
    <th>ردیف</th>
    <th>شماره سفارش</th>
    <th>تاریخ سفارش</th>
    <th>آدرس سفارش</th>
    <th>نحوه ارسال</th>
    <th>کد رهگیری سفارش</th>
    <th>وضعیت سفارش</th>
</tr>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>bs-3564548451</td>
                    <td>1402-2-12</td>
                    <td>محل کار</td>
                    <td>پست پیشتاز</td>
                    <td>142546117821</td>
                    <td>ارسال شده</td>
                </tr>
                </tbody>

            </table>
        </div>

    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

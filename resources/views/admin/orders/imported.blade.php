@extends('admin.master')
@section('content')

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>اطلاعات زیر با موفقیت وارد شد</h4>
                    <p>تعداد کاربران ۲ عدد</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <table class="table table-striped table-hover table-sm">
                <thead>
            <tr>
                <th>#</th>
                <th>کاربر</th>
                <th>شماره موبایل</th>
                <th>کد رهگیری</th>
                <th>آدرس</th>
            </tr>
                </thead>
                <tbody>
        <?php $count =0; ?>
        @foreach($import as $item)
            <tr>
                <td>{{++$count }}</td>
                <td>
                    {{$item['name']}}
                </td>
                <td>
                    {{$item['mobile']}}
                </td>
                <td>{{$item['tracking_code']}}</td>
                <td>تهران</td>
            </tr>
            @endforeach
            <tbody>
        </table>
    </section>
    </div>
    <!-- /.row (main row) -->

@endsection

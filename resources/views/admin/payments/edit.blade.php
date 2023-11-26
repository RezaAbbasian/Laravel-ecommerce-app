@extends('admin.master')

@section('content')
    <!-- Main row -->
    <div class="row">
        <section class="col col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="col-4">
                                    <b>شماره سفارش</b>
                                    {{$payment->order()->first()->order_num}}
                                </div>
                                <div class="col-4"><b>شناسه تراکنش</b>
                                    {{$payment->resnumber}}</div>
                                <div class="col-4"><b>مبلغ تراکنش</b>
                                    {{$payment->order()->first()->total}} تومان</div>
                                <form action="{{route('admin.payments.update', compact('payment'))}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-4">
                                        <select name="status" id="">
                                            <option {{$payment->status == 1 ? 'selected':''}} value="1">پرداخت شده</option>
                                            <option {{$payment->status == 0 ? 'selected':''}} value="0">پرداخت نشده</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-primary">بروزرسانی</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-6">
                                <div class="col-4">
                                    <b>تصویر فیش واریزی</b>
                                    <a href="{{ env('APP_URL')."/images/cardtocard/".$payment->image }}">
                                        <img src={{ env('APP_URL')."/images/cardtocard/".$payment->image }}  width="300px" />

                                    </a>
                                </div>
                            </div>
                        </div>


                        </div>
        </section>
    </div>
    <!-- /.row (main row) -->

@endsection

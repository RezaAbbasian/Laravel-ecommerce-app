@extends('admin.master')
@push('script')

@endpush
@section('content')
    <!-- Main row -->
    <div class="row">
        <section class="col col-lg-12">
            <form action="{{route('admin.shipping.update',['shipping'=>$shipping])}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="user_id" class="form-label required">عنوان</label>
                                <div class="col form-check">
                                    <input type="text" name="title" value="{{$shipping->title}}">
                                </div>
                            </div>

                            <div class="form-group col">
                                <label for="days" class="form-label required">زمان ارسال</label>
                                <div class="form-check">
                                    <input type="number" name="days"  value="{{$shipping->days}}">
                                </div>
                            </div>

                            <div class="form-group col">
                                <label for="price" class="form-label required">هزینه</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="number"  value="{{$shipping->price}}" name="price" id="price" size="11" class="form-control" min="0" max="10000000000">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">تومان</div>
                                    </div>
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    قیمت به تومان و از 1.000 تومان تا 10.000.000 تومان مجاز می باشد                        </small>
                            </div>

                            <div class="form-group col">
                                <label for="price" class="form-label required">توضیحات</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <textarea name="description" id="" cols="30" rows="10">{{$shipping->description}}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4">
{{--                        <div class="form-group col">--}}
{{--                            <label for="parent" class="form-label required">والد</label>--}}
{{--                            <div class="form-check">--}}
{{--                                <select id="parent" name="parent" class="select-basic-single form-control">--}}
{{--                                    @foreach(\App\Models\Shipping::all() as $ship)--}}
{{--                                        <option {{$ship->id == $shipping->parent ? 'selected' :'' }} value="{{$ship->id}}">{{$ship->title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group col">
                            <label for="cities" class="form-label required">شهر</label>
                            <div class="form-check">
                                <select id="cities" name="cities[]" multiple class="select-basic-multiple form-control">
                                    @foreach(\App\Models\City::all() as $city)
                                        <option {{ in_array($city->id , $shipping->cities->pluck('id')->toArray()) ? 'selected' : '' }} value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col">

                            <label for="status" class="form-label required">وضعیت حمل و نقل</label>
                            <div id="status" class="form-check form-check-inline">
                                <input {{ old('status', $shipping->status) == 1 ? 'checked' : ''}} class="form-check-input" type="radio" id="publish" name="status" value="1">
                                <label for="publish" class="form-check-label">
                                    فعال
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ old('status', $shipping->status) == 0 ? 'checked' : ''}} class="form-check-input" type="radio" id="unpublish" name="status" value="0">
                                <label for="unpublish" class="form-check-label">
                                    غیر فعال
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <button class="btn btn-primary">ایجاد حمل و نقل</button>
                            </div>
                        </div>
                        <div class="form-row">


                        </div>
                    </div></div>
            </form>
        </section>
    </div>
    <!-- /.row (main row) -->
@endsection


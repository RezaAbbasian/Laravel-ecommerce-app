@extends('admin.master')
@push('script')

@endpush
@section('content')
    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.orders.storeImport')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-row">

                        <div class="form-group col">
                        <label for="days" class="form-label required">فایل  کد رهگیری پست</label>
                        <div class="form-check">
                            <input type="file" name="days">
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group col">
{{--                        <label for="status" class="form-label required">وضعیت حمل و نقل</label>--}}
{{--                        <div id="status" class="form-check form-check-inline">--}}
{{--                            <input {{ old('status') == '1' ? 'publish' :''}} class="form-check-input" type="radio" id="publish" name="status" value="1">--}}
{{--                            <label for="publish" class="form-check-label">--}}
{{--                                فعال--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input {{ old('status') == 'unpublish' ? 'checked' :''}} class="form-check-input" type="radio" id="unpublish" name="status" value="0">--}}
{{--                            <label for="unpublish" class="form-check-label">--}}
{{--                                غیر فعال--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <div class="form-check form-check-inline">
                            <button class="btn btn-primary">ورود اطلاعات رهگیری</button>
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


@extends('admin.master')
@push('script')

@endpush
@section('content')
    <!-- Main row -->
    <div class="row">
    <section class="col col-lg-12">
        <form action="{{route('admin.products.store')}}" method="post" class="dropzone" id="myDropzone">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="user_id" class="form-label required">کاربر</label>
                            <div class="col form-check">
                                <select name="user_id" id="user_id" class="form-control select-basic-single"  >
                                    @foreach(\App\Models\User::all() as $user)
                                    <option value="value="{{$user->id }}""> {{ $user->name . ' ' . $user->lastname }} - {{$user->mobile}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="shipping_id" class="form-label required">نامک</label>
                            <div class="form-check">
                                <select name="shipping_id" id="shipping_id" class="form-control select-basic-single"  >
{{--                                    @foreach(\App\Models\Shipping::all() as $shipping)--}}
{{--                                        <option value="{{$shipping->id}}"> {{ $shipping->title }} </option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group col">
                        <label for="products" class="form-label required">محصول</label>
                        <div class="form-check">
                            <select name="products[]" id="products" class="select-basic-multiple form-control" multiple>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{$product->id}}">{{$product->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="form-group col">
                            <label for="price" class="form-label required">قیمت</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="number" value="{{old('price')}}" name="price" id="price" size="11" class="form-control" min="1000" max="10000000000">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">تومان</div>
                                </div>
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                قیمت به تومان و از 1.000 تومان تا 10.000.000 تومان مجاز می باشد                        </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label required">توضیحات</label>
                        <div class="form-check">
                            <textarea name="description" id="description" cols="200" rows="30" class="form-control">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group">
                            <h6>ویژگی محصول</h6>
                            <hr>
                            <div id="attribute_section">
                            </div>
                            <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">ویژگی جدید</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="seo_title" class="form-label required">عنوان سئو</label>
                            <div class="col form-check">
                                <input type="text" name="seo_title" id="seo_title" class="form-control"  value="{{old('seo_title')}}">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="url" class="form-label required">آدرس کوتاه</label>
                            <div class="col form-check">
                                <input type="url" name="url" id="url" class="form-control" value="{{old('url')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo_description" class="form-label required">توضیحات سئو</label>
                            <div class="form-check">
                                <textarea name="seo_description" id="seo_description" cols="200" rows="3" class="form-control">{{old('seo_description')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group col">


                            <label for="status" class="form-label required">وضعیت نمایش در موتور جستجو</label>
                            <div id="status" class="form-check form-check-inline">
                                <input {{ old('status') == '1' ? 'publish' :''}} class="form-check-input" type="radio" id="publish" name="status" value="publish">
                                <label for="publish" class="form-check-label">
                                    Index, follow
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ old('status') == 'private' ? 'checked' :''}} class="form-check-input" type="radio" id="private" name="status" value="private">
                                <label for="private" class="form-check-label">
                                    No Index, no follow
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ old('status') == 'unpublish' ? 'checked' :''}} class="form-check-input" type="radio" id="unpublish" name="status" value="unpublish">
                                <label for="unpublish" class="form-check-label">
                                    Default
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <script>
                        // Note that the name "myDropzone" is the camelized
                        // id of the form.
                        Dropzone.options.myDropzone = {
                            // Configuration options go here
                        };
                    </script>
                    <div class="form-group col">
                        <label for="image" class="form-label required">تصویر محصول</label>
                        <div class="form-check">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"  value="{{old('')}}" />
                                <label class="custom-file-label" for="customFile">انتخاب عکس</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="brand_id" class="form-label required">برند</label>
                        <div class="form-check">
                            <select name="brand_id" id="brand_id" class="select-basic-single form-control">
                                @foreach(\App\Models\Brand::all() as $brand)
                                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="tags" class="form-label required">برچسب</label>
                        <div class="form-check">
                            <select name="tags[]" id="tags" class="select-basic-multiple form-control" multiple="multiple">
                                @foreach(\App\Models\Tag::all() as $tag)
                                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="categories" class="form-label required">دسته بندی</label>
                        <div class="form-check">
                            <select id="categories" name="categories[]" multiple class="select-basic-multiple form-control">
                               @foreach(\App\Models\Category::all() as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col">

                        <label for="status" class="form-label required">وضعیت محصول</label>
                        <div id="status" class="form-check form-check-inline">
                            <input {{ old('status') == '1' ? 'publish' :''}} class="form-check-input" type="radio" id="publish" name="status" value="publish">
                            <label for="publish" class="form-check-label">
                                فعال
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input {{ old('status') == 'private' ? 'checked' :''}} class="form-check-input" type="radio" id="private" name="status" value="private">
                            <label for="private" class="form-check-label">
                                مخفی
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input {{ old('status') == 'unpublish' ? 'checked' :''}} class="form-check-input" type="radio" id="unpublish" name="status" value="unpublish">
                            <label for="unpublish" class="form-check-label">
                                غیر فعال
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <button class="btn btn-primary">ایجاد محصول</button>
                        </div>
                    </div>
                    <div class="form-row">


                </div>
            </div>
        </form>
    </section>
    </div>
    <!-- /.row (main row) -->
@endsection


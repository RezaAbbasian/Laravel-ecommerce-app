@component('admin.layouts.content' , ['title' => 'ویرایش دسته'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">لیست دسته بندی ها</a></li>
        <li class="breadcrumb-item active">ویرایش دسته</li>
    @endslot
    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.getElementById('button-image').addEventListener('click', (event) => {
                    event.preventDefault();

                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                });
            });

            // set file link
            function fmSetLink($url) {
                document.getElementById('image_label').value = $url;
                document.getElementById("image").src = $url;
            }
        </script>
    @endpush
    <div class="container">
        @include('admin.layouts.errors')
                <form class="form-horizontal" action="{{ route('admin.categories.update' , $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">نام دسته</label>
                            <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="نام دسته را وارد کنید" value="{{ old('title' , $category->title) }}">
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">دسته مرتبط</label>
                            <select class="form-control" name="parent" id="permissions">
                                <option value="0">دسته اصلی</option>
                            @foreach(\App\Models\Category::all() as $cate)
                                    <option value="{{ $cate->id }}" {{ $cate->id === $category->parent ? 'selected' : '' }}>{{ $cate->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="slug" class="form-label required">نامک</label>
                            <div class="form-check">
                                <input type="text" name="slug" id="slug" class="form-control"  value="{{ old('slug' , $category->slug) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label required">توضیحات</label>
                            <div class="form-check">
                                <textarea name="description" id="description" cols="200" rows="30" class="form-control">
                                    {{ old('description' , $category->description) }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col">
                                <label for="seo_title" class="form-label required">عنوان سئو</label>
                                <div class="col form-check">
                                    <input type="text" name="seo_title" id="seo_title" class="form-control"  value="{{ old('seo_title' , $category->seo_title) }}">
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="url" class="form-label required">آدرس کوتاه</label>
                                <div class="col form-check">
                                    <input type="url" name="url" id="url" class="form-control" value="{{ old('url' , $category->url) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="seo_description" class="form-label required">توضیحات سئو</label>
                                <div class="form-check">
                                    <textarea name="seo_description" id="seo_description" cols="200" rows="3" class="form-control">{{ old('seo_description' , $category->seo_description) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col">

                                <label for="seo_status" class="form-label required">وضعیت نمایش در موتور جستجو</label>
                                <div id="seo_status" class="form-check form-check-inline">
                                    <input {{ old('seo_status', $category->seo_status) == 'Index' ? 'checked' :''}} class="form-check-input" type="radio" id="Index" name="seo_status" value="Index">
                                    <label for="Index" class="form-check-label">
                                        Index, follow
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input {{ old('seo_status', $category->seo_status) == 'NoIndex' ? 'checked' :''}} class="form-check-input" type="radio" id="NoIndex" name="seo_status" value="NoIndex">
                                    <label for="NoIndex" class="form-check-label">
                                        No Index, no follow
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input {{ old('seo_status', $category->seo_status) == 'Default' ? 'checked' :''}} class="form-check-input" type="radio" id="Default" name="seo_status" value="Default">
                                    <label for="Default" class="form-check-label">
                                        Default
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group col">
                            <label for="image" class="form-label required">تصویر دسته بندی</label>
                            <img src="{{$category->image?? ''}}" width="100%" alt="" id="image">
                            <div class="input-group">
                                <input type="text" id="image_label" class="form-control" name="image"
                                       aria-label="Image" aria-describedby="button-image" value="{{$category->image}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-image">انتخاب تصویر</button>
                                </div>
                            </div>

                            {{--                            <label for="image" class="form-label required">تصویر محصول</label>--}}
                            {{--                            <div class="form-check">--}}
                            {{--                                <img src="{{'/images/products/'.$product->image}}" width="300" alt="">--}}
                            {{--                                <div class="custom-file">--}}
                            {{--                                    <input type="file" name="image" class="custom-file-input" id="customFile" />--}}
                            {{--                                    <label class="custom-file-label" for="customFile">انتخاب عکس</label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="form-group col">

                            <label for="status" class="form-label required">وضعیت نمایش</label>
                            <div id="status" class="form-check form-check-inline">
                                <input {{ old('status', $category->status) == 1 ? 'checked' :''}} class="form-check-input" type="radio" id="Public" name="status" value="1">
                                <label for="Public" class="form-check-label">
                                    فعال
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ old('status', $category->status) == 0 ? 'checked' :''}} class="form-check-input" type="radio" id="Draft" name="status" value="0">
                                <label for="Draft" class="form-check-label">
                                    غیرفعال
                                </label>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-info">ویرایش دسته</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-default float-left">لغو</a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>

@endcomponent

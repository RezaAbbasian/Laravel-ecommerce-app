@extends('admin.master')
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




        $('#categories').select2({
            'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
        })

        let changeAttributeValues = (event , id) => {
            let valueBox = $(`select[name='attributes[${id}][value]']`);

            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type' : 'application/json'
                }
            })

            $.ajax({
                type : 'POST',
                url : '/admin/attribute/values',
                data : JSON.stringify({
                    title : event.target.value
                }),
                success : function(res) {
                    valueBox.html(`
                            <option value="" selected>انتخاب کنید</option>
                            ${
                        res.data.map(function (item) {
                            return `<option value="${item}">${item}</option>`
                        })
                    }
                        `);
                }
            });
        }

        let createNewAttr = ({ attributes , id }) => {


            return `
                    <div class="row" id="attribute-${id}">
                        <div class="col-5">
                            <div class="form-group">
                                 <label>عنوان ویژگی</label>
                                 <select name="attributes[${id}][title]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                                    <option value="">انتخاب کنید</option>
                                    ${
                attributes.map(function(item) {
                    return `<option value="${item}">${item}</option>`
                })
            }
                                 </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                 <label>مقدار ویژگی</label>
                                 <select name="attributes[${id}][value]" class="attribute-select form-control">
                                        <option value="">انتخاب کنید</option>
                                 </select>
                            </div>
                        </div>
                         <div class="col-2">
                            <label >اقدامات</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">حذف</button>
                            </div>
                        </div>
                    </div>
                `
        }

        $('#add_product_attribute').click(function() {
            let attributesSection = $('#attribute_section');
            let id = attributesSection.children().length;

            let attributes = $('#attributes').data('attributes');
            // console.log(attributes);
            attributesSection.append(
                createNewAttr({
                    attributes,
                    id
                })
            );

            $('.attribute-select').select2({ tags : true });
        });

        $('.attribute-select').select2({ tags : true });


    </script>
@endpush
@section('content')
    <!-- Main row -->
    <div class="row">
        <section class="col col-lg-12">
            <div id="attributes" data-attributes="{{ json_encode(\App\Models\Attribute::all()->pluck('title')) }}"></div>
            <form action="{{ route('admin.products.update', ['product'=>$product]) }}" method="post"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-8">

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="title" class="form-label required">عنوان محصول</label>
                                <div class="col form-check">
                                    <input type="text" name="title" id="title" class="form-control" value="{{$product->title}}">
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="slug" class="form-label required">نامک</label>
                                <div class="form-check">
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{$product->slug}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col">
                                <label for="price" class="form-label required">قیمت</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="number" name="price" id="price" size="11" class="form-control" min="1000" max="10000000000" value="{{$product->price}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">تومان</div>
                                    </div>
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    قیمت به تومان و از 1.000 تومان تا 10.000.000 تومان مجاز می باشد</small>
                            </div>

                        <div class="form-group col">
                            <label for="type" class="form-label required">نوع محصول</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="form-check">
                                    <select name="type" id="type">
                                        <option value="simple">محصول ساده</option>
                                        <option value="variable">محصول متغییر</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label required">توضیحات</label>
                            <div class="form-check">
                                <textarea name="description" id="description" cols="200" rows="30" class="form-control">{{$product->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <h6>ویژگی محصول</h6>
                                <hr>
                                <div id="attribute_section">
                                    @foreach($product->attributes as $attribute)
                                        <div class="row" id="attribute-{{ $loop->index }}">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label>عنوان ویژگی</label>
                                                    <select name="attributes[{{ $loop->index }}][title]" onchange="changeAttributeValues(event, {{ $loop->index }});" class="attribute-select form-control">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach(\App\Models\Attribute::all() as $attr)
                                                            <option value="{{ $attr->title }}" {{ $attr->title ==  $attribute->title ? 'selected' : '' }}>{{ $attr->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label>مقدار ویژگی</label>
                                                    <select name="attributes[{{ $loop->index }}][value]" class="attribute-select form-control">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($attribute->values as $value)
                                                            <option value="{{ $value->value }}" {{ $value->id  === $attribute->pivot->value_id ? 'selected' : '' }}>{{ $value->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <label >اقدامات</label>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-{{ $loop->index }}').remove()">حذف</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">ویژگی جدید</button>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="seo_title" class="form-label required">عنوان سئو</label>
                                <div class="col form-check">
                                    <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{$product->seo_title}}">
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="url" class="form-label required">آدرس کوتاه</label>
                                <div class="col form-check">
                                    <input type="url" name="url" id="url" class="form-control" value="{{$product->url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="seo_description" class="form-label required">توضیحات سئو</label>
                                <div class="form-check">
                                    <textarea name="seo_description" id="seo_description" cols="200" rows="3" class="form-control">{{$product->seo_description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col">

                                <label for="status" class="form-label required">وضعیت نمایش در موتور جستجو</label>
                                <div id="status" class="form-check form-check-inline">
                                    <input {{ $product->status == 'Index' ? 'checked' :''}} class="form-check-input" type="radio" id="publish" name="status" value="Index">
                                    <label for="publish" class="form-check-label">
                                        Index, follow
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input {{ old('status') == 'No Index' ? 'checked' :''}} class="form-check-input" type="radio" id="private" name="status" value="private">
                                    <label for="private" class="form-check-label">
                                        No Index, no follow
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input {{ old('status') == 'Default' ? 'checked' :''}} class="form-check-input" type="radio" id="unpublish" name="status" value="unpublish">
                                    <label for="unpublish" class="form-check-label">
                                        Default
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group col">
                            <label for="image" class="form-label required">تصویر محصول</label>
                                <img src="{{$product->image}}" width="100%" alt="" id="image">
                            <div class="input-group">
                            <input type="text" id="image_label" class="form-control" name="image"
                                       aria-label="Image" aria-describedby="button-image" value="{{$product->image}}">
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
                            <label for="brand_id" class="form-label required">برند</label>
                            <div class="form-check">
                                <select name="brand_id" id="brand_id" class="select-basic-single form-control">
                                        <option value="">انتخاب کنید</option>
                                    @foreach(\App\Models\Brand::all() as $brand)
                                        <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected':''}}>{{$brand->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="tags" class="form-label required">برچسب</label>
                            <div class="form-check">
                                <select name="tags[]" id="tags" class="select-basic-multiple form-control" multiple="multiple">
                                    @foreach(\App\Models\Tag::all() as $tag)
                                        <option value="{{$tag->id}}" {{ in_array($tag->id , $product->tags->pluck('id')->toArray()) ? 'selected' : '' }} > {{ $tag->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="category" class="form-label required">دسته بندی</label>
                            <div class="form-check">
                                <select id="categories" name="categories[]" multiple="multiple" class="select-basic-multiple form-control">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id , $product->categories->pluck('id')->toArray()) ? 'selected' : '' }} > {{ $category->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="status" class="form-label required">وضعیت محصول</label>
                            <div id="status" class="form-check form-check-inline">
                                <input {{ old('1', $product->status) == '1' ? 'checked' : ''}} class="form-check-input" type="radio" id="on" name="status" value="1">
                                <label for="on" class="form-check-label">
                                    فعال
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ old('0', $product->status) == '0' ? 'checked' : ''}} class="form-check-input" type="radio" id="off" name="status" value="0">
                                <label for="off" class="form-check-label">
                                    غیر فعال
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <button class="btn btn-primary">ویرایش محصول</button>
                            </div>
                        </div>
                        <div class="form-row">


                        </div>
                    </div>
                </div>

            </form>

        </section>
    </div>
    <!-- /.row (main row) -->

@endsection

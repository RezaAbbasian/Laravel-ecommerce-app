@extends('admin.master')
@push('script')
    <script>
        $('#categories').select2({
            'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
        })


        let changeAttributeValues = (event , id) => {
            let valueBox = $(`select[name='attributes[${id}][value]']`);
// console.log(event.target.value);


            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type' : 'application/json'
                }
            })

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         'Content-Type' : 'application/json'
            //     }
            // });
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
    </script>
@endpush
@section('content')
    <!-- Main row -->
    <div class="row">
        <section class="col col-lg-12">
            <div id="attributes" data-attributes="{{ json_encode(\App\Models\Attribute::all()->pluck('title')) }}"></div>
            <form action="{{route('admin.products.variations.store', ['product'=> $product] )}}" method="post" class="dropzone" id="myDropzone">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="image" class="form-label required">تصویر محصول</label>
                            <div class="form-check">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile"  value="{{old('')}}" />
                                    <label class="custom-file-label" for="customFile">انتخاب عکس</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label required">قیمت</label>
                            <div class="form-check">
                                <input type="number" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label required">موجودی</label>
                            <div class="form-check">
                                <input type="number" name="inventory">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label required">حداکثر سفارش</label>
                            <div class="form-check">
                                <input type="number" name="max_order">
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

                        <div class="form-group">
                            <label for="status" class="form-label required">وضعیت محصول</label>
                            <div id="status" class="form-check form-check-inline">
                                <input {{ old('status') == 1 ? 'checked' :''}} class="form-check-input" type="radio" id="on" name="status" value="1">
                                <label for="on" class="form-check-label">
                                    فعال
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ old('status') == 0 ? 'checked' :''}} class="form-check-input" type="radio" id="off" name="status" value="0">
                                <label for="off" class="form-check-label">
                                    غیرفعال
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <button class="btn btn-primary">ایجاد تنوع</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- /.row (main row) -->
@endsection

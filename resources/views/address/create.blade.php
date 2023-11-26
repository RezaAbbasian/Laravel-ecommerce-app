<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Document</title>
</head>
<body>
<form action="{{route('address.store')}}" method="post">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
    <input type="text" name="title" placeholder="عنوان آدرس" class="form-control  m-3 p-2">
            <div class="row">
                <select name="state_id" class="form-control col-6">
                    <option>--</option>
                </select>
                <select name="city_id" class="form-control col-6">
                    <option>--</option>
                </select>
            </div>
    <input type="text" name="address" placeholder="آدرس مانند خیابان کوچه" class="form-control  m-3 p-2">
            <div class="row">
                <div class="form-group">
                    <input type="text" name="no" placeholder="پلاک" class="form-control  col-6">
                </div>

                <div class="form-group">
                <input type="text" name="unit" placeholder="واحد" class="form-control  col-6">

                </div>
            </div>
    <input type="text" name="postal_code" placeholder="کدپستی" class="form-control  m-3 p-2">
    <input type="text" name="full_name" placeholder="نام گیرنده" class="form-control  m-3 p-2">
    <input type="text" name="mobile" placeholder="موبایل" class="form-control  m-3 p-2">
    <input type="hidden" name="lat" placeholder="" class="form-control  m-3 p-2">
    <input type="hidden" name="long" placeholder="" class="form-control  m-3 p-2">
    <button class="btn btn-primary">ثبت آدرس</button>
        </div></div>
</form>
</body>
</html>

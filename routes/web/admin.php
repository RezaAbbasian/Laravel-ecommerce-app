<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('admin.layouts.index');
});

Route::resource('users', UserController::class);
Route::resource('address', AddressController::class);
Route::resource('products', ProductController::class);
Route::resource('products.variations', VariationController::class);
Route::resource('products.gallery', ProductGalleryController::class);
Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);
Route::resource('tags', TagController::class);
Route::resource('coupons', CouponController::class);
Route::resource('orders', OrderController::class);
Route::resource('payments', PaymentController::class);
Route::resource('shipping', ShippingController::class);

//Route::controller(OrderController::class)->group(function () {
//    Route::get('import', 'import')->name('orders.import');
//    Route::post('import/store', 'storeImport')->name('orders.storeImport');
//});

//Route::post('/attribute/values','getValues@AttributeController');

Route::controller(AttributeController::class)->group(function () {
    Route::post('/attribute/values', 'getValues')->name('attribute.values');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('products/clone/{product}', 'duplicate')->name('products.clone');
});


Route::controller(UserController::class)->group(function () {
    Route::get('usersexport/', 'export')->name('usersexport');
    Route::get('usersimportfile/', 'importfile')->name('usersimportfile');
    Route::post('usersimport/', 'import')->name('usersimport');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('ordersexport/', 'export')->name('ordersexport');

    Route::get('ordersimportfile/', 'importfile')->name('ordersimportfile');
    Route::post('ordersimport/', 'import')->name('ordersimport');
});

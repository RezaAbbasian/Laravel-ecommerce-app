<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrdersController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

Route::get('/products', function () {
    return view('products');
})->name('homepage');


//Route::get('/', function () {
//    redirect()->route('login');
//})->name('homepage');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('cart', function(){
////    Cart::get('2');
//    dd(Cart::get(2));
//});

Route::controller(CartsController::class)
    ->name('cart.')
    ->prefix('cart')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::delete('cart/{product}', 'removeItem')->name('remove.item');
    Route::post('cart/{product}', 'addtocart')->name('add.item');
});

Route::controller(OrdersController::class)
    ->name('orders.')
    ->prefix('orders')
    ->group(function () {
    Route::get('/', 'index')->name('index');
        Route::get('checkout/{order}', 'checkout')->name('checkout');
        Route::post('create', 'create')->name('create');
        Route::post('gotobank/{order}', 'gotobank')->name('gotobank');
        Route::get('paymentCallback', 'paymentCallback')->name('paymentCallback');

    Route::get('coupon', 'checkCoupon')->name('coupon');
    Route::get('check-discount', 'checkDiscount')->name('check-discount');
    });

Route::resource('address',AddressController::class);
Route::get('/date', function (){
    $dateString = \Morilog\Jalali\CalendarUtils::convertNumbers('1402/08/10', true); // 1395-02-19
    $date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $dateString)->format('Y/m/d'); //2016-05-8
//    $jdate = jdate('۱۴۰۲/۸/۲۲');
//    echo $jdate;
    $date = \Carbon\Carbon::now();
    echo $date;
} );
// routes/web.php


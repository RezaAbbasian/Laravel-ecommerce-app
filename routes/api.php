<?php


use App\Http\Controllers\Api\v1\HomepageController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ShippingController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\AddressController;
use App\Http\Controllers\Api\v1\BrandController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/articles', function (){
        return 'done';
    });
});

Route::prefix('v1')->group(function (){
    Route::controller(HomepageController::class)->group(function () {
        Route::get('home', 'index');
        Route::get('products/{product}', 'show');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index');
        Route::get('search/{keyword}', 'search');
        Route::get('products/{product}', 'show');
    });

    Route::controller(BrandController::class)->group(function () {
        Route::get('brands', 'index');
        Route::get('brands/{brand}', 'show');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index');
        Route::get('categories/{category}', 'show');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get('tags', 'index');
        Route::get('tags/{tag}', 'show');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('gotobank/{order}', 'gotobank')->name('gotobank');
        Route::post('orders/{order}/gotocard/', 'gotocard')->name('gotocard');
    });

    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/user', function (){
            return response()->json(auth()->user(),200 );
        });
        Route::get('/tokenverify', function (){
            return response()->json('ok',200);
        });
        Route::controller(AddressController::class)->group(function () {
            Route::get('addresses', 'index');
            Route::get('addresses/provinces/', 'provinces');
            Route::get('addresses/provinces/{id}/cities/', 'cities');
            Route::get('addresses/{address}', 'show');
            Route::post('addresses/store', 'store');
        });
        Route::controller(ShippingController::class)->group(function () {
            Route::get('shipping', 'index')->name('shipping.index');
        });
        Route::controller(OrderController::class)->group(function () {

            Route::get('orders', 'index');
            Route::get('orders/{order}', 'show');
            Route::post('orders/store', 'store');
        });
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('paymentCallback', 'paymentCallback')->name('paymentCallback');
    });

    });

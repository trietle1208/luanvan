<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\TypeProductController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AccountNCC;
use App\Http\Controllers\NCC\ProductController;
use App\Http\Controllers\NCC\DiscountController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.layout');
})->middleware('auth');

Route::get('/trang-chu-admin', function () {
    return view('admin.manager.admin-dashbroad');
})->name('admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//verify email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/taonhacungcap', function () {
    return view('admin.nhacungcap.create');
});
Route::post('/taonhacungcap', [App\Http\Controllers\Admin\AccountNCC::class, 'store'])->name('taonhacungcap');
Route::middleware(['auth','verified'])->group(function () {
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
//account
            Route::prefix('taikhoan')->group(function (){
                Route::get('/taikhoan', [
                    'as' => 'account.list',
                    'uses' => 'App\Http\Controllers\Admin\AccountController@index'
                ]);
                Route::get('/ajax', [
                    'as' => 'account.ajax',
                    'uses' => 'App\Http\Controllers\Admin\AccountController@changeStatus'
                ]);
            });
//category
            Route::prefix('danhmuc')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'cate.list',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@index'
                ]);
                Route::get('/them', [
                    'as' => 'cate.create',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'cate.store',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'cate.edit',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'cate.update',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'cate.delete',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'cate.hasdelete',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@hasDelete'
                ]);
            });

//brand
            Route::prefix('thuonghieu')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'brand.list',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@index'
                ]);
                Route::get('/them', [
                    'as' => 'brand.create',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'brand.store',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'brand.edit',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'brand.update',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'brand.delete',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'brand.hasdelete',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@hasDelete'
                ]);
            });
//slide
            Route::prefix('slide')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'slide.list',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@index'
                ]);
                Route::get('/them', [
                    'as' => 'slide.create',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'slide.store',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'slide.edit',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'slide.update',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'slide.delete',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'slide.hasdelete',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@hasDelete'
                ]);
            });
//type
            Route::prefix('loaisanpham')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'type.list',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@index'
                ]);
                Route::get('/them', [
                    'as' => 'type.create',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'type.store',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'type.edit',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'type.update',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'type.delete',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'type.hasdelete',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@hasDelete'
                ]);
            });
//parameter
            Route::prefix('thongso')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'para.list',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@index'
                ]);
                Route::get('/them', [
                    'as' => 'para.create',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'para.store',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'para.edit',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'para.update',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'para.delete',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'para.hasdelete',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@hasDelete'
                ]);
            });
        });
});

Route::middleware(['auth','verified'])->group(function () {
    Route::prefix('sup')
        ->name('sup.')
        ->group(function () {
            Route::prefix('sanpham')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'product.list',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@index'
                ]);
                Route::get('/them', [
                    'as' => 'product.create',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'product.store',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'product.edit',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'product.update',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'product.delete',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'product.hasdelete',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@hasDelete'
                ]);
                Route::get('/ajax', [
                    'as' => 'product.ajax',
                    'uses' => 'App\Http\Controllers\NCC\ProductController@getPara'
                ]);
            });

            Route::prefix('khuyenmai')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'discount.list',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@index'
                ]);
                Route::get('/them', [
                    'as' => 'discount.create',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'discount.store',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'discount.edit',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'discount.update',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'discount.delete',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'discount.hasdelete',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@hasDelete'
                ]);

            });
        });
});

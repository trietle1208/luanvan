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
use App\Http\Controllers\NCC\ReceiptController;
//use App\Http\Controllers\NCC\AccountController;
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
                Route::get('/check', [
                    'as' => 'cate.check',
                    'uses' => 'App\Http\Controllers\Admin\CategoryController@checkName'
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
                Route::get('/check', [
                    'as' => 'brand.check',
                    'uses' => 'App\Http\Controllers\Admin\BrandController@checkName'
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
                Route::get('/check', [
                    'as' => 'slide.check',
                    'uses' => 'App\Http\Controllers\Admin\SlideController@checkName'
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
                Route::get('/check', [
                    'as' => 'type.check',
                    'uses' => 'App\Http\Controllers\Admin\TypeProductController@checkName'
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
                Route::get('/ajax', [
                    'as' => 'para.modal',
                    'uses' => 'App\Http\Controllers\Admin\ParameterController@modalAjax'
                ]);
            });
            Route::prefix('phieunhap')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'receipt.list',
                    'uses' => 'App\Http\Controllers\Admin\ReceiptController@index'
                ]);
                Route::get('/thaydoi', [
                    'as' => 'receipt.change',
                    'uses' => 'App\Http\Controllers\Admin\ReceiptController@changeStatus'
                ]);
            });
            Route::prefix('hinhthucgiaohang')->group(function (){
                Route::get('/danhsach', [
                    'as' => 'ship.list',
                    'uses' => 'App\Http\Controllers\Admin\ShippingController@index'
                ]);
                Route::get('/them', [
                    'as' => 'ship.create',
                    'uses' => 'App\Http\Controllers\Admin\ShippingController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'ship.store',
                    'uses' => 'App\Http\Controllers\Admin\ShippingController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'ship.edit',
                    'uses' => 'App\Http\Controllers\Admin\ShippingController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'ship.update',
                    'uses' => 'App\Http\Controllers\Admin\ShippingController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'ship.delete',
                    'uses' => 'App\Http\Controllers\Admin\ShippingController@delete'
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
                Route::get('/modal', [
                    'as' => 'discount.modal',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@modalAjax'
                ]);
                Route::get('/addProduct', [
                    'as' => 'discount.addProduct',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@addProduct'
                ]);
                Route::get('/deleteProduct', [
                    'as' => 'discount.deleteProduct',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@deleteProduct'
                ]);
                Route::get('/changeStatus', [
                    'as' => 'discount.changeStatus',
                    'uses' => 'App\Http\Controllers\NCC\DiscountController@changeStatus'
                ]);
            });

            Route::prefix('phieunhaphang')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'receipt.list',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@index'
                ]);
                Route::get('/them', [
                    'as' => 'receipt.create',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'receipt.store',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'receipt.edit',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'receipt.update',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'receipt.delete',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'receipt.hasdelete',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@hasDelete'
                ]);
                Route::get('/ajax/{param}', [
                    'as' => 'receipt.selectCate',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@selectCate'
                ]);
                Route::get('/addProduct', [
                    'as' => 'receipt.addProduct',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@addProduct'
                ]);
                Route::get('/checkQuantity', [
                    'as' => 'receipt.checkQuantity',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@checkQuantity'
                ]);
                Route::get('/modal', [
                    'as' => 'receipt.modal',
                    'uses' => 'App\Http\Controllers\NCC\ReceiptController@modalAjax'
                ]);
            });

            Route::prefix('giamgia')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'voucher.list',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@index'
                ]);
                Route::get('/them', [
                    'as' => 'voucher.create',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'voucher.store',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'voucher.edit',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'voucher.update',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'voucher.delete',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@delete'
                ]);
                Route::get('/daxoa', [
                    'as' => 'voucher.hasdelete',
                    'uses' => 'App\Http\Controllers\NCC\VoucherController@hasDelete'
                ]);
            });
            Route::get('/thongtincanhan',[
                'as' => 'account.index',
                'uses' => 'App\Http\Controllers\NCC\AccountController@index',
            ]);
            Route::post('/luuthongtin',[
                'as' => 'account.store_info',
                'uses' => 'App\Http\Controllers\NCC\AccountController@store',
            ]);
            Route::post('/luuthongtinncc',[
                'as' => 'account.store_ncc',
                'uses' => 'App\Http\Controllers\NCC\AccountController@store_ncc',
            ]);

            Route::prefix('donhang')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'order.list',
                    'uses' => 'App\Http\Controllers\NCC\OrderController@index'
                ]);
                Route::get('/chitiet', [
                    'as' => 'order.detail',
                    'uses' => 'App\Http\Controllers\NCC\OrderController@detail'
                ]);
                Route::get('/changeStatus', [
                    'as' => 'order.changeStatus',
                    'uses' => 'App\Http\Controllers\NCC\OrderController@changeStatus'
                ]);
            });

            Route::prefix('vaitro')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'role.list',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@index'
                ]);
                Route::get('/them', [
                    'as' => 'role.create',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'role.store',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'role.edit',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'role.update',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@update',
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'role.delete',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@delete'
                ]);
                Route::get('/ganquyen/{id}', [
                    'as' => 'role.addPermission',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@addPermission'
                ]);

                Route::post('/ganquyen/{id}', [
                    'as' => 'role.storePermission',
                    'uses' => 'App\Http\Controllers\NCC\RoleController@storePermission'
                ]);
            });

            Route::prefix('phanquyen')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'permission.list',
                    'uses' => 'App\Http\Controllers\NCC\PermissionController@index'
                ]);
                Route::get('/them', [
                    'as' => 'permission.create',
                    'uses' => 'App\Http\Controllers\NCC\PermissionController@create'
                ]);
                Route::post('/luu', [
                    'as' => 'permission.store',
                    'uses' => 'App\Http\Controllers\NCC\PermissionController@store'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'permission.edit',
                    'uses' => 'App\Http\Controllers\NCC\PermissionController@edit'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'permission.update',
                    'uses' => 'App\Http\Controllers\NCC\PermissionController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'permission.delete',
                    'uses' => 'App\Http\Controllers\NCC\PermissionController@delete'
                ]);
            });

            Route::prefix('taikhoan')->group(function () {
                Route::get('/danhsach', [
                    'as' => 'account.list',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@index_account'
                ]);
                Route::get('/them', [
                    'as' => 'account.create',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@create_account'
                ]);
                Route::post('/luu', [
                    'as' => 'account.store',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@store_account'
                ]);
                Route::get('/chinhsua/{id}', [
                    'as' => 'account.edit',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@edit_account'
                ]);
                Route::post('/luuchinhsua/{id}', [
                    'as' => 'account.update',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@update'
                ]);
                Route::get('/xoa/{id}', [
                    'as' => 'account.delete',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@delete'
                ]);
                Route::get('/ganvaitro/{id}', [
                    'as' => 'account.addRole',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@addRole'
                ]);

                Route::post('/ganvaitro/{id}', [
                    'as' => 'account.storeRole',
                    'uses' => 'App\Http\Controllers\NCC\AccountController@storeRole'
                ]);
            });
        });
});

Route::get('/trangchu', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('trangchu');

Route::get('/thuonghieu/{slug}/{id}', [
    'as' => 'brand.product',
    'uses' => 'App\Http\Controllers\Home\BrandController@index'
]);

Route::get('/loaisanpham/{slug}/{id}', [
    'as' => 'type.product',
    'uses' => 'App\Http\Controllers\Home\TypeController@index'
]);

Route::get('/chitiet/{ncc}/{slug}', [
    'as' => 'product.detail',
    'uses' => 'App\Http\Controllers\Home\ProductController@detail'
]);

Route::get('/ajaxQty', [
    'as' => 'product.ajaxQty',
    'uses' => 'App\Http\Controllers\Home\ProductController@ajaxQty'
]);

Route::get('/giohang', [
    'as' => 'product.showCart',
    'uses' => 'App\Http\Controllers\Home\ProductController@showCart'
]);

Route::get('/addCart', [
    'as' => 'product.addCart',
    'uses' => 'App\Http\Controllers\Home\ProductController@addCart'
]);

Route::get('/updateCart', [
    'as' => 'product.updateCart',
    'uses' => 'App\Http\Controllers\Home\ProductController@updateCart'
]);

Route::get('/deleteCart/{rowId}', [
    'as' => 'product.deleteCart',
    'uses' => 'App\Http\Controllers\Home\ProductController@deleteCart'
]);

Route::get('/addVoucher', [
    'as' => 'product.addVoucher',
    'uses' => 'App\Http\Controllers\Home\ProductController@addVoucher'
]);

Route::get('/deletedVoucher', [
    'as' => 'product.deletedVoucher',
    'uses' => 'App\Http\Controllers\Home\ProductController@deletedVoucher'
]);

Route::get('/tai-khoan', [
    'as' => 'customer.index',
    'uses' => 'App\Http\Controllers\Home\CustomerController@index'
]);

Route::post('/dangki', [
    'as' => 'customer.register',
    'uses' => 'App\Http\Controllers\Home\CustomerController@register'
]);

Route::post('/dangnhap', [
    'as' => 'customer.login',
    'uses' => 'App\Http\Controllers\Home\CustomerController@login'
]);

Route::get('/dangxuat', [
    'as' => 'customer.logout',
    'uses' => 'App\Http\Controllers\Home\CustomerController@logout'
]);

Route::get('/thongtincanhan', [
    'as' => 'customer.profile',
    'uses' => 'App\Http\Controllers\Home\CustomerController@profile'
]);

Route::get('/thanhtoan', [
    'as' => 'checkout.index',
    'uses' => 'App\Http\Controllers\Home\CheckoutController@index'
]);

Route::get('/locthanhpho', [
    'as' => 'checkout.selectAdd',
    'uses' => 'App\Http\Controllers\Home\CheckoutController@selectAdd'
]);

Route::post('/luudiachi', [
    'as' => 'checkout.saveAdd',
    'uses' => 'App\Http\Controllers\Home\CheckoutController@saveAdd'
]);

Route::get('/tinhphi', [
    'as' => 'checkout.addShip',
    'uses' => 'App\Http\Controllers\Home\CheckoutController@addShip'
]);

Route::post('/xacnhanthanhtoan', [
    'as' => 'checkout.payment',
    'uses' => 'App\Http\Controllers\Home\CheckoutController@payment'
]);

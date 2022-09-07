<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\CategotyProduct;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Size;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('client.index');
});

//
//tai khoan
Route::middleware('admin')->prefix('/users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('list');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::post('/updateStatus/{user}', [UserController::class, 'updateStatus'])->name('updateStatus');
});

// san pham 

Route::prefix('/products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('list');
    Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
});

// giao dien khach hang

Route::name('client.')->group(function () {
    Route::get('/home', [ClientController::class, 'index'])->name('index');
    // Contact
    Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
    Route::post('/storeContact', [ClientController::class, 'storeContact'])->name('storeContact');
    //list product
    Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
    //cart
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
    Route::middleware('CheckClient')->post('/storeCart', [ClientController::class, 'storeCart'])->name('storeCart');
    Route::delete('/deleteCart/{products}', [ClientController::class, 'deleteCart'])->name('deleteCart');
    Route::get('/updateCart/{id}', [ClientController::class, 'updateCart'])->name('updateCart');
    //about- new
    Route::get('/about', [ClientController::class, 'about'])->name('about');
    Route::get('/new', [ClientController::class, 'new'])->name('new');
    //detail-product
    Route::get('/single/{id}', [ClientController::class, 'single'])->name('single');
    // comment
    Route::post('/storeComment', [ClientController::class, 'storeComment'])->name('storeComment');
    Route::delete('/deleteComment/{product}', [ClientController::class, 'deleteComment'])->name('deleteComment');
    // checkout -> order
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::post('/createOrder', [ClientController::class, 'createOrder'])->name('createOrder');
    Route::post('/storeOrder', [ClientController::class, 'storeOrder'])->name('storeOrder');
    Route::get('/showOrder', [OrderController::class, 'showOrder'])->name('showOrder');
    Route::get('/detail/{order}', [OrderDetailController::class, 'detail'])->name('detail');
    Route::post('/updateStatusOrder/{order}', [OrderDetailController::class, 'updateStatusOrder'])->name('updateStatusOrder');
    //profile
    Route::get('/profile/{user}', [ClientController::class, 'profile'])->name('profile');
    Route::get('/editProfile/{id}', [ClientController::class, 'editProfile'])->name('editProfile');
    Route::post('/updateProfile/{user}', [ClientController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/report/{user}', [ClientController::class, 'report'])->name('report');
});
//giao dien danh muc san pham
Route::prefix('/catepr')->name('catepr.')->group(function () {
    Route::get('/', [CategoryProductController::class, 'index'])->name('list');
    Route::delete('/delete/{cate}', [CategoryProductController::class, 'delete'])->name('delete');
    Route::get('/create', [CategoryProductController::class, 'create'])->name('create');
    Route::post('/store', [CategoryProductController::class, 'store'])->name('store');
    Route::get('/edit/{cate}', [CategoryProductController::class, 'edit'])->name('edit');
    Route::put('/update/{cate}', [CategoryProductController::class, 'update'])->name('update');
    Route::post('/updateStatus/{cate}', [CategoryProductController::class, 'updateStatus'])->name('updateStatus');
});
// admin/
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::prefix('/contacts')->name('contacts.')->group(function () {
        Route::get('/list', [ContactController::class, 'index'])->name('list');
        Route::delete('/delete/{contacts}', [ContactController::class, 'delete'])->name('delete');
        Route::post('/updateAction/{contacts}', [ContactController::class, 'updateAction'])->name('updateAction');
    });
    //admin-> Gio hang
    Route::prefix('/carts')->name('carts.')->group(function () {
        Route::get('/list', [CartController::class, 'index'])->name('list');
        Route::delete('/delete/{user}', [CartController::class, 'delete'])->name('delete');
        Route::get('/create', [CartController::class, 'create'])->name('create');
        Route::post('/store', [CartController::class, 'store'])->name('store');
        Route::get('/edit/{cate}', [CartController::class, 'edit'])->name('edit');
        Route::put('/update/{cate}', [CartController::class, 'update'])->name('update');
    });
    //admin -> kich thuoc
    Route::prefix('/sizes')->name('sizes.')->group(function () {
        Route::get('/list', [SizeController::class, 'index'])->name('list');
        Route::delete('/delete/{size}', [SizeController::class, 'delete'])->name('delete');
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/store', [SizeController::class, 'store'])->name('store');
        Route::get('/edit/{size}', [SizeController::class, 'edit'])->name('edit');
        Route::put('/update/{size}', [SizeController::class, 'update'])->name('update');
        Route::post('/updateStatus/{cate}', [SizeController::class, 'updateStatus'])->name('updateStatus');
    });
    //admin -> dat hang
    Route::prefix('/orders')->name('orders.')->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('list');
        Route::get('/detail/{order}', [OrderDetailController::class, 'index'])->name('detail');
        Route::put('/updateStatusOrder/{order}', [OrderController::class, 'updateStatusOrder'])->name('updateStatusOrder');
    });
});
//Auth
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/getdangki', [AuthController::class, 'getdangki'])->name('getdangki');
    Route::post('/store', [UserController::class, 'store'])->name('store');
});
Route::middleware('auth')->get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

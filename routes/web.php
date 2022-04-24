<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\ImageController;
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

Route::get('/', [IndexController::class, 'index'])->name("frontend.index");
Route::post('/signin', [ProfileController::class, 'signin'])->name("frontend.signin");
Route::post('/login', [ProfileController::class, 'login'])->name("frontend.login");
Route::get('/logout', [ProfileController::class, 'logout'])->name("frontend.logout");
Route::get('/forgetpassword/{id}', [ProfileController::class, 'forgetpassword'])->name("frontend.forgetpassword");
Route::post('/forgetpassword/', [ProfileController::class, 'forgetpasswordpost'])->name("frontend.forgetpasswordpost");
Route::get('/iletisim',[IndexController::class, 'contact'] )->name("frontend.contact");

Route::prefix("profile")->group(function () {
    Route::post('/update', [ProfileController::class, 'updateprofile'])->name("frontend.updateprofile");
    Route::prefix("address")->group(function () {
        Route::post('/add', [ProfileController::class, 'addaddress'])->name("frontend.addaddress");
        Route::get('/delete/{id?}', [ProfileController::class, 'deleteaddress'])->name("frontend.deleteaddress");
    });
});
Route::prefix("magaza")->group(function () {
    Route::get('/', [ShopController::class, 'shop'])->name("frontend.shop");
    Route::get('/kategori/{m?}/{s?}', [ShopController::class, 'getcategory'])->name("frontend.getcategory");
    Route::get('/urun/{id}', [ShopController::class, 'detailproduct'])->name("frontend.product");
    Route::prefix("sepet")->group(function () {
        Route::get('/', [CartController::class, 'cart'])->name("frontend.cart");
        Route::get('/add/{id?}', [CartController::class, 'addToCart'])->name("frontend.addcart");
        Route::post('/addorupdate', [CartController::class, 'addOrUpdateCart'])->name("frontend.addupdatecart");
        Route::get('/update/{id?}/{miktar?}', [CartController::class, 'updateToCart'])->name("frontend.updatecart");
        Route::get('/delete/{id}', [CartController::class, 'deleteToCart'])->name("frontend.deletecart");
    });
    Route::post('/siparis/add', [CartController::class, 'addOrder'])->name("frontend.addorder");
});


Route::prefix("admin")->group(function () {
    Route::get('/', [AdminController::class, 'login'])->name("backend.login");
    Route::get('/auth', [AdminController::class, 'auth'])->name("backend.auth");
});

Route::prefix("admin")->middleware("adminverified")->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name("backend.index");
    Route::get('/profile', [AdminController::class, 'profile'])->name("backend.profile");
    Route::post('/profile/update', [AdminController::class, 'updateprofile'])->name("backend.updateprofile");
    Route::get('/setting', [SettingController::class, 'setting'])->name("backend.setting");
    Route::post('/setting/update', [SettingController::class, 'updatesetting'])->name("backend.updatesetting");
    Route::get('/logout', [AdminController::class, 'logout'])->name("backend.logout");

    Route::prefix("product")->group(function () {
        Route::get('/', [ProductController::class, 'product'])->name("backend.product");
        Route::get('/{id}', [ProductController::class, 'detailproduct'])->name("backend.productdetail");
        Route::post('/add', [ProductController::class, 'addproduct'])->name("backend.addproduct");
        Route::post('/update/{id}', [ProductController::class, 'updateproduct'])->name("backend.updateproduct");
        Route::get('/delete/{id}', [ProductController::class, 'deleteproduct'])->name("backend.deleteproduct");
        Route::prefix("image")->group(function () {
            Route::post('/add/{id}', [ProductImageController::class, 'addproductimage'])->name("backend.addproductimage");
            Route::post('/update', [ProductImageController::class, 'updateproductimage'])->name("backend.updateproductimage");
            Route::get('/delete/{id}', [ProductImageController::class, 'deleteproductimage'])->name("backend.deleteproductimage");
        });
        Route::prefix("category")->group(function () {
            Route::post('/add', [CategoryController::class, 'addcategory'])->name("backend.addcategory");
            Route::prefix("subcategory")->group(function () {
                Route::post('/list', [CategoryController::class, 'listsubcategory'])->name("backend.listsubcategory");
                Route::post('/add', [CategoryController::class, 'addsubcategory'])->name("backend.addsubcategory");

            });
        });
    });
    Route::prefix("order")->group(function () {
        Route::get('/', [OrderController::class, 'order'])->name("backend.order");
        Route::post('/{id}', [OrderController::class, 'orderupdate'])->name("backend.orderupdate");
    });
    Route::prefix("customer")->group(function () {
        Route::get('/', [CustomerController::class, 'customer'])->name("backend.customer");
        Route::get('/{id}', [CustomerController::class, 'customerdetail'])->name("backend.customerdetail");
        Route::post('/update/{id}', [CustomerController::class, 'updatecustomer'])->name("backend.updatecustomer");
        Route::post('/delete/{id}', [CustomerController::class, 'deletecustomer'])->name("backend.deletecustomer");
    });
    Route::get('/setting', [SettingController::class, 'setting'])->name("backend.setting");
});

Route::get('/image', [ImageController::class, 'displayImage']);

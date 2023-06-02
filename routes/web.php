<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
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
    return view('frontend.index');
});
//admin section
Route::middleware(['auth','Role:admin'])->group(function () {
    Route::get("/admin/dashboard",[AdminController::class,'admin'])->name("admin.dashboard");
    Route::get("/admin/logout",[AdminController::class,'adminLogout'])->name("admin.logout");
    Route::get("/admin/profile",[AdminController::class,'adminProfile'])->name("admin.profile");
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
    });

    //vendor section
    Route::middleware(['auth','Role:vendor'])->group(function () {
    Route::get("/vendor/dashboard",[VendorController::class,'vendor'])->name("vendor.dashboard");
    Route::get("/vendor/profile",[VendorController::class,'vendorProfile'])->name("vendor.profile");
    Route::post('/vendor/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');

    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
    Route::get("/vendor/logout",[VendorController::class,'vendorLogout'])->name("vendor.logout");

    });

    //login section
    Route::get("/vendor/login",[VendorController::class,'vendorLogin'])->name("vendor.login");
    Route::get("/admin/login",[AdminController::class,'adminLogin'])->name("admin.login");



     //brand section
    //tanya role admin btwanet am routana bneret
    Route::middleware(['auth','Role:admin'])->group(function () {
    //bo brandcontroller am routana bakar det am Routa la laravel 9 zyad krawa
    Route::controller(BrandController::class)->group(function(){
    Route::get('/all/brand','AllBrand')->name('all.brand');
    Route::get('/add/brand','AddBrand')->name('add.brand');
    Route::post('/store/brand','StoreBrand')->name('store.brand');
    Route::post('/update/brand','UpdateBrand')->name('update.brand');
    Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
    Route::get('/delete/brand/{id}' , 'DeleteBrand')->name('delete.brand');
    }); //End route Controller
    }); //End Middleware
     //Category section
     Route::middleware(['auth','Role:admin'])->group(function () {
        Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/catgory','StoreCategory')->name('store.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::get('/delete/category/{id}' , 'DeleteCategory')->name('delete.category');
        }); //End route Controller

    }); //End Middleware

    //user section
Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    }); // Gorup Milldeware End
require __DIR__.'/auth.php';
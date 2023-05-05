<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware(['auth','Role:admin'])->group(function () {
Route::get("/admin/dashboard",[AdminController::class,'admin'])->name("admin.dashboard");
Route::get("/admin/logout",[AdminController::class,'adminLogout'])->name("admin.logout");
Route::get("/admin/profile",[AdminController::class,'adminProfile'])->name("admin.profile");
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});
Route::middleware(['auth','Role:vendor'])->group(function () {
Route::get("/vendor/dashboard",[VendorController::class,'vendor'])->name("vendor.dashboard");
Route::get("/vendor/profile",[VendorController::class,'vendorProfile'])->name("vendor.profile");
Route::post('/vendor/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');
Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');

Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
Route::get("/vendor/logout",[VendorController::class,'vendorLogout'])->name("vendor.logout");
});
Route::get("/admin/login",[AdminController::class,'adminLogin'])->name("admin.login");
Route::get("/vendor/login",[VendorController::class,'vendorLogin'])->name("vendor.login");
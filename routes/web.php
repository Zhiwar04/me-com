<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,VendorController,UserController};
use App\Http\Controllers\backend\{BrandController,CategoryController,SubCategoryController,ProductController,VendorProductController,SliderController,BannerController};
use App\Http\Middleware\RedirectIfAuthenticated;
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
Route::prefix('admin')->middleware(['auth', 'Role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'admin'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});

    //vendor section
Route::prefix('vendor')->middleware(['auth', 'Role:vendor'])->group(function () {
    Route::get('/dashboard', [VendorController::class, 'vendor'])->name('vendor.dashboard');
    Route::get('/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');
    Route::get('/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
    Route::get('/logout', [VendorController::class, 'vendorLogout'])->name('vendor.logout');
    //product section
    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/all/product','VendorAllProduct')->name('vendor.all.product');
        Route::get('/add/product','VendorAddProduct')->name('vendor.add.product');
        Route::post('/store/product','VendorStoreProduct')->name('vendor.store.product');
        Route::get('/edit/product/{id}','VendorEditProduct')->name('vendor.edit.product');
        Route::post('/update/product','VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/update/product/thambnail' , 'VendorUpdateProductThambnail')->name('vendor.update.product.thambnail');
        Route::post('/update/product/multiimage' , 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}' , 'VendorMultiImageDelete')->name('vendor.product.multiimg.delete');
        Route::get('/product/inactive/{id}' , 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/product/active/{id}' , 'VendorProductActive')->name('vendor.product.active');
        Route::get('/delete/product/{id}' , 'VendorProductDelete')->name('vendor.delete.product');
        Route::get('/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');
        }); //End route Controller
});

    //login section
    Route::get("/vendor/login",[VendorController::class,'vendorLogin'])->name("vendor.login")->middleware(RedirectIfAuthenticated::class);
    Route::get("become/vendor",[VendorController::class,'becomeVendor'])->name("become.vendor");
    Route::post("register/vendor",[VendorController::class,'RegisterVendor'])->name("register.vendor");
    Route::get("/admin/login",[AdminController::class,'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);



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

         //SubCategory section
         Route::middleware(['auth','Role:admin'])->group(function () {
            Route::controller(SubCategoryController::class)->group(function(){
            Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
            Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
            Route::post('/store/subcatgory','StoreSubCategory')->name('store.subcategory');
            Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
            Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
            Route::get('/delete/subcategory/{id}' , 'DeleteSubCategory')->name('delete.subcategory');
            Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
            }); //End route Controller

            Route::controller(AdminController::class)->group(function(){
                Route::get('/inactive/vendor','InActiveVendor')->name('inactive.vendor');
                Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
                Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails')->name('inactive.vendor.details');
                Route::get('/active/vendor/details/{id}' , 'activeVendorDetails')->name('active.vendor.details');
                Route::post('/active/vendor/approve','ActiveVendorApprove')->name('active.vendor.approve');
                Route::post('/inactive/vendor/approve','InActiveVendorApprove')->name('inactive.vendor.approve');


                });  //End route Controller

                //product
                Route::controller(ProductController::class)->group(function(){
                    Route::get('/all/product' , 'AllProduct')->name('all.product');
                    Route::get('/add/product' , 'AddProduct')->name('add.product');
                    Route::post('/store/product' , 'StoreProduct')->name('store.product');
                    Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
                    Route::post('/update/product' , 'UpdateProduct')->name('update.product');
                    Route::post('/update/product/thambnail' , 'UpdateProductThambnail')->name('update.product.thambnail');
                    Route::post('/update/product/multiimage' , 'UpdateProductMultiimage')->name('update.product.multiimage');
                    Route::get('/product/multiimg/delete/{id}' , 'MultiImageDelete')->name('product.multiimg.delete');
                    Route::get('/product/inactive/{id}' , 'ProductInactive')->name('product.inactive');
                    Route::get('/product/active/{id}' , 'ProductActive')->name('product.active');
                    Route::get('/delete/product/{id}' , 'ProductDelete')->name('delete.product');

                });
                            }); //End Middleware
         //Slider section
         Route::middleware(['auth','Role:admin'])->group(function () {
            Route::controller(SliderController::class)->group(function(){
            Route::get('/all/slider','AllSlider')->name('all.slider');
            Route::get('/add/slider','AddSlider')->name('add.slider');
            Route::post('/store/slider','StoreSlider')->name('store.slider');
            Route::post('/update/slider','UpdateSlider')->name('update.slider');
            Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
            Route::get('/delete/slider/{id}' , 'DeleteSlider')->name('delete.slider');
            }); //End route Controller
             // Banner All Route
              Route::controller(BannerController::class)->group(function(){
              Route::get('/all/banner' , 'AllBanner')->name('all.banner');
              Route::get('/add/banner' , 'AddBanner')->name('add.banner');
              Route::post('/store/banner' , 'StoreBanner')->name('store.banner');
              Route::get('/edit/banner/{id}' , 'EditBanner')->name('edit.banner');
              Route::post('/update/banner' , 'UpdateBanner')->name('update.banner');
              Route::get('/delete/banner/{id}' , 'DeleteBanner')->name('delete.banner');

});
        }); //End Middleware

    //user section
Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    }); // Gorup Milldeware End
require __DIR__.'/auth.php';
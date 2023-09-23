<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Auth\logoutController;
use App\Http\Controllers\Api\v1\Auth\registerController;
use App\Http\Controllers\{AdminController, VendorController, UserController};
use App\Http\Controllers\backend\{
    BrandController,CategoryController,
    SubCategoryController,ProductController,VendorProductController,SliderController,BannerController,CouponController,
    ShippingAreaController,OrderController,VendorOrderController,ReturnController,ReportController,ActiveUserController,
    SiteSettingController,RoleController,PermissionController,RolePermissionController,MultiAdminController
};
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\frontend\{IndexController, CartController, ShopController};
use App\Http\Controllers\User\{WishlistController, CompareController, CheckoutController, StripeController, ReviewController,};
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::get('/getuser', [LogoutController::class, 'getUser']);
                        // review All Route
Route::controller(ReviewController::class)->group(function () {
    Route::post('/store/review', 'StoreReview')->name('store.review');
    });


});
Route::post('/register',[registerController::class,'register']);
Route::post('/become/vendor',[registerController::class,'becomeVendor']);



Route::middleware(['auth:api','Role:vendor'])->group(function () {
//vendor section
    Route::get('/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');
    Route::post('/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
    //product section
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::post('/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/update/product/thambnail', 'VendorUpdateProductThambnail')->name('vendor.update.product.thambnail');
        Route::post('/update/product/multiimage', 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'VendorMultiImageDelete')->name('vendor.product.multiimg.delete');
        Route::get('/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
        Route::get('/delete/product/{id}', 'VendorProductDelete')->name('vendor.delete.product');
        Route::get('/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
    }); //End route Controller
    // vendor order section
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/order', 'VendorOrder')->name('vendor.order');
        Route::get('/vendor/return/order', 'VendorReturnOrder')->name('vendor.return.order');
        Route::get('/vendor/complete/return/order', 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
        Route::get('/vendor/order/details/{order_id}', 'VendorOrderDetails')->name('vendor.order.details');
    });
    /// vendor Review all route
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/vendor/all/review', 'VendorAllReview')->name('vendor.all.review');
    });
});






Route::middleware(['auth:api'])->group(function () {
    Route::resource('sliders', SliderController::class)->except('show', 'create');
    Route::resource('brands', BrandController::class)->except('show', 'create');
    Route::resource('categories', CategoryController::class)->except('show', 'create');
    Route::resource('subcategories', SubCategoryController::class);
    //bashtrin rega bo relationakan dway agaremawa bo subcategory
    Route::resource('banners', BannerController::class)->except('show', 'create');
    Route::resource('coupons', CouponController::class)->except('show', 'create');
    Route::resource('divisions', ShippingAreaController::class)->except('show', 'create');
    Route::resource('roles', RoleController::class)->except('show', 'create');
    Route::resource('permissions', PermissionController::class)->except('show', 'create');
    Route::resource('rolePermissions', RolePermissionController::class)->except('show', 'create');
    Route::resource('admins', MultiAdminController::class)->except('show', 'create');
       //product
       Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        // Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');
        Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'MultiImageDelete')->name('product.multiimg.delete');
        Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'ProductDelete')->name('delete.product');
        //product stock
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/profile', 'adminProfile')->name('admin.profile');
    Route::post('/profile/store', 'AdminProfileStore')->name('admin.profile.store');
    Route::post('/update/password', 'AdminUpdatePassword')->name('update.password');
    Route::get('/inactive/vendor', 'InActiveVendor')->name('inactive.vendor');
    Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
    Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
    Route::get('/active/vendor/details/{id}', 'activeVendorDetails')->name('active.vendor.details');
    Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');
    Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');
}); //End route Controller
    // Admin Order All Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/pending/order', 'PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')->name('admin.confirmed.order');
        Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');
        Route::get('/pending/confirm/{order_id}', 'PendingToConfirm')->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}', 'ConfirmToProcessing')->name('confirm-processing');
        Route::get('/processing/delivered/{order_id}', 'ProcessingToDelivered')->name('processing-delivered');
        Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');
    });
    /// return order all route

    Route::controller(ReturnController::class)->group(function () {
        Route::get('/return/request', 'ReturnRequest')->name('return.request');
        Route::get('/return/request/approved/{order_id}', 'ReturnRequestApproved')->name('return.request.approved');
        Route::get('/complete/return/request', 'CompleteReturnRequest')->name('complete.return.request');
    }); //End route Controller
    /// Report  all route
    Route::controller(ReportController::class)->group(function () {
        Route::post('/search/by/date', 'SearchByDate')->name('search-by-date');
        Route::post('/search/by/month', 'SearchByMonth')->name('search-by-month');
        Route::post('/search/by/year', 'SearchByYear')->name('search-by-year');
        Route::get('/order/by/user', 'OrderByUser')->name('order.by.user');
        Route::post('/search/by/user', 'SearchByUser')->name('search-by-user');
    }); //End route Controller

    /// active user and vendor all route
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/all/vendor', 'AllVendor')->name('all.vendor');
    }); //End route Controller

    /// admin review all route
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/pending/review', 'PendingReveiw')->name('pending.review');
        Route::get('/review/approve/{id}', 'ReviewApprove')->name('review.approve');
        Route::get('/review/publish', 'ReviewPublish')->name('review.publish');
        Route::get('/review/delete/{id}', 'ReviewDelete')->name('review.delete');
    }); //End route Controller
    ///Site Sitting all route
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/setting/update', 'SiteSettingUpdate')->name('site.setting.update');
        Route::get('/seo/setting', 'SeoSetting')->name('seo.setting');
        Route::post('/seo/setting/update', 'SeoSettingUpdate')->name('seo.setting.update');
    }); //End route Controller
});

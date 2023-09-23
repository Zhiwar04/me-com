<?php
use Illuminate\Support\Facades\Route;
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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
require __DIR__ . '/auth.php';




Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
                    //       routes             //
                   //routes for frontend
 Route::group([], function () {
                    /// frontend product details all route
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct'])->name('category.product');
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);
Route::get('/product/brand/{id}/{slug}', [IndexController::class, 'BrandWiseProduct'])->name("brand.details");
Route::get('/product/view/modal/{id}', [IndexController::class, 'modalProduct']);
Route::get('/', [IndexController::class, 'index'])->name('index');

              // Search All Route
Route::controller(IndexController::class)->group(function () {
Route::post('/search', 'ProductSearch')->name('product.search');
Route::post('/search-product', 'SearchProduct');
Route::post('/search-product', 'SearchProduct');
});
            // Shop Page All Route
Route::prefix('shop')->controller(ShopController::class)->group(function () {
Route::get('/', 'ShopPage')->name('shop.page');
Route::post('/filter', 'ShopFilter')->name('shop.filter');
});
 });




















//                 login & register route          //
route::group([], function () {

Route::get("/vendor/login", [VendorController::class, 'vendorLogin'])->name("vendor.login")->middleware(RedirectIfAuthenticated::class);
Route::get("become/vendor", [VendorController::class, 'becomeVendor'])->name("become.vendor");
Route::post("register/vendor", [VendorController::class, 'RegisterVendor'])->name("register.vendor");
Route::get("/admin/login", [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
});



















//user section
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::get('/user/order_details/{id}', [UserController::class, 'UserOrderDetails']);
    Route::get('/user/invoice_download/{order_id}', [UserController::class, 'UserOrderInvoice']);
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/return/order/{order_id}', [UserController::class, 'ReturnOrder'])->name('return_order');
    Route::post('/track/order', [UserController::class, 'TrackOrder'])->name('track.order');
                    // review All Route
Route::controller(ReviewController::class)->group(function () {
    Route::post('/store/review', 'StoreReview')->name('store.review');
    });

}); // Gorup Milldeware End





















/// User All Route
Route::middleware(['auth', 'Role:user'])->group(function () {

    // Wishlist All Route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProduct');
        Route::get('/remove-wishlist/{id}', 'WishlistRemove');
    });
    // Compare All Route
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-compare-product', 'GetCompareProduct');
        Route::get('/compare-remove/{id}', 'CompareRemove');
    });
    // Cart All Route
    Route::controller(CartController::class)->group(function () {
        Route::get('/mycart', 'MyCart')->name('mycart');
        Route::get('/get-cart-product', 'GetCartProduct');
        Route::get('/cart-remove/{rowId}', 'CartRemove');
        Route::get('/cart-decrement/{id}', 'CartDecrement');
        Route::get('/cart-increment/{id}', 'CartIncrement');
    });
        /// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);
//checkout section
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::controller(CheckoutController::class)->group(function () {
    Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
});
// Stripe All Route
Route::controller(StripeController::class)->group(function () {
    Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
    Route::post('/cash/order', 'CashOrder')->name('cash.order');
});
//shopping cart
Route::post("/cart/store/{id}", [CartController::class, 'storeToCart']);
Route::post("/mini/cart/detail/{id}", [CartController::class, 'storeInDetailCart']);
Route::get("/mini/cart", [CartController::class, 'AddToCart']);
Route::get("/cart/product/remove/{id}", [CartController::class, 'RemoveCartItem']);
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
}); // end group middleware






























//vendor section
Route::prefix('vendor')->middleware(['auth', 'Role:vendor'])->group(function () {
    Route::get('/dashboard', [VendorController::class, 'vendor'])->name('vendor.dashboard');
    Route::get('/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');
    Route::get('/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
    Route::get('/logout', [VendorController::class, 'vendorLogout'])->name('vendor.logout');
    //product section
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/add/product', 'VendorAddProduct')->name('vendor.add.product');
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






















//admin section
Route::prefix('admin')->middleware(['auth', 'Role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'admin'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
    //bo brandcontroller am routana bakar det am Routa la laravel 9 zyad krawa
    Route::resource('sliders', SliderController::class)->except('show');
    Route::resource('brands', BrandController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('banners', BannerController::class)->except('show');
    Route::resource('coupons', CouponController::class)->except('show');
    Route::resource('divisions', ShippingAreaController::class)->except('show');
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('rolePermissions', RolePermissionController::class)->except('show');
    Route::resource('admins', MultiAdminController::class)->except('show');
    //product
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
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
    }); //End route Controller
    Route::controller(AdminController::class)->group(function () {
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
        Route::get('/report/view', 'ReportView')->name('report.view');
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



});
// translate route
<?php

namespace App\Providers;
use App\Models\{Category, SubCategory, Brand, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['auth.*','frontend.product.*','frontend.vendor.*','frontend.wishlist.*','frontend.compare.*','frontend.mycart.*'], function ($view) {
            $categories =  Category::orderBy('category_name','ASC')->get();
            $subcategories = SubCategory::orderBy('subcategory_name','ASC')->get();
            $vendors = User::orderBy('id','DESC')->where('role','vendor')->get();
            $brands = Brand::orderBy('id','DESC')->limit(10)->get();
            $view->with('categories', $categories);
            $view->with('subcategories', $subcategories);
            $view->with('vendors', $vendors);
            $view->with('brands', $brands);
        });
    }
}
<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SubCategory;
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
        View::composer(['auth.*','frontend.product.*','frontend.vendor.*'], function ($view) {
            $categories =  Category::orderBy('category_name','ASC')->get();
            $subcategories = SubCategory::orderBy('subcategory_name','ASC')->get();
            $view->with('categories', $categories);
            $view->with('subcategories', $subcategories);
        });
    }
}
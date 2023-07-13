<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =  Category::orderBy('category_name','ASC')->get()->limit(6);
        $products = Product::where('status',1)->orderBy('product_name','ASC')->get();
        $new_products = Product::where('status',1)->orderBy('id','ASC')->limit(10)->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $banners = Banner::orderBy('id','DESC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name','ASC')->get();
        $users = User::all();
        return view('frontend.index',compact('categories','products','new_products','brands','banners','subcategories','sliders','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

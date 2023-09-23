<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
class ShopController extends Controller
{
    public function ShopPage(){

 // Initialize the products query
 $productsQuery = Product::query();

 // Apply category filter if it's set
 if (!empty($_GET['category'])) {
     $categorySlugs = explode(',', $_GET['category']);
     $categoryIds = Category::whereIn('category_slug', $categorySlugs)->pluck('id');
     $productsQuery->whereIn('category_id', $categoryIds);
 }

 // Apply brand filter if it's set
 if (!empty($_GET['brand'])) {
     $brandSlugs = explode(',', $_GET['brand']);
     $brandIds = Brand::whereIn('brand_slug', $brandSlugs)->pluck('id');
     $productsQuery->whereIn('brand_id', $brandIds);
 }

 // Fetch the filtered products
 $products = $productsQuery->get();

 // If no filters are applied, you can fetch all products by default
 if (empty($_GET['category']) && empty($_GET['brand'])) {
     $products = Product::all();
 }

        // Price Range

         if(!empty($_GET['price'])){
            $price = explode('-',$_GET['price']);
            $products = $products->whereBetween('selling_price',$price);
         }


      $categories = Category::orderBy('category_name','ASC')->get();
      $brands = Brand::orderBy('brand_name','ASC')->get();
      $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

      return view('frontend.product.shop_page',compact('products','categories','newProduct','brands'));

    } // End Method


    public function ShopFilter(Request $request){

        $data = $request->all();

        /// Filter For Category

        $catUrl = "";
        if (!empty($data['category'])) {
            foreach($data['category'] as $category){
                if (empty($catUrl)) {
                    $catUrl .= '&category='.$category;
                }else{
                    $catUrl .= ','.$category;
                }
            }
        }


        /// Filter For Brand

        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach($data['brand'] as $brand){
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand='.$brand;
                }else{
                    $brandUrl .= ','.$brand;
                }
            }
        }

        /// Filter For Price Range

        $priceRangeUrl = "";
        if (!empty($data['price_range'])) {
           $priceRangeUrl .= '&price='.$data['price_range'];
        }



        return redirect()->route('shop.page',$catUrl.$brandUrl.$priceRangeUrl);

    }// End Method

}
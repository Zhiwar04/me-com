<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, SubCategory, Brand, Product, MultiImg, User, Slider, Banner};



class IndexController extends Controller
{
    public function index()
    {
        $categories =  Category::orderBy('category_name','ASC')->limit(6)->get();
        $products = Product::where('status',1)->orderBy('product_name','ASC')->get();
        $banners = Banner::orderBy('id','DESC')->get();

        $sliders = Slider::orderBy('id','DESC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name','ASC')->get();
        $users = User::all();
        $category = Category::skip(0)->first();
        $product = Product::where('status',1)->where('category_id',$category->id)->orderBy('id', 'DESC')->limit(8)->get();
        $category2 = Category::skip(1)->first();
        $product2 = Product::where('status',1)->where('category_id',$category2->id)->orderBy('id', 'DESC')->limit(8)->get();
        $category4 = Category::skip(3)->first();
        $product4 = Product::where('status',1)->where('category_id',$category4->id)->orderBy('id', 'DESC')->limit(8)->get();
        $news = Product::where('status',1)->where('discount_price',null)->orderBy('id', 'DESC')->limit(3)->get();
        $special_offers=Product::where('status',1)->where('special_offer',1)->orderBy('id', 'DESC')->limit(3)->get();
        $hot_deals=Product::where('discount_price','!=',null)->where('hot_deals',1)->orderBy('id', 'DESC')->limit(3)->get();
        $special_deals=Product::where('discount_price','!=',null)->where('special_deals',1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.index', compact('category','categories', 'category2', 'product2',
        'category4','product4', 'product','products', 'sliders', 'banners', 'subcategories', 'users','news','special_offers','hot_deals','special_deals'));
    }
    public function VendorDetails($id){
        $vendor = User::findOrFail($id);
        $vproduct = Product::where('vendor_id',$id)->get();

        return view('frontend.vendor.vendor_details',compact('vendor','vproduct'));
    }

    public function ProductDetails($id, $slug)
    {
$product = Product::findOrFail($id);

$color = $product->product_color;
$product_color = explode(',', $color);

$size = $product->product_size;
$product_size = explode(',', $size);

$multiImage = MultiImg::where('product_id',$id)->get();
$cat_id = $product->category_id;
$relatedProduct= Product::where('category_id',$cat_id)->
where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();




return view('frontend.product.product_details',
compact('product','product_color','product_size','multiImage','relatedProduct'));

    } // end method
    public function VendorAll(){

        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','DESC')->get();
        return view('frontend.vendor.vendor_all',compact('vendors'));

     } // End Method
     public function CatWiseProduct(Request $request,$id,$slug){
        $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();

        $breadcat = Category::where('id',$id)->first();

        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.product_category',compact('products','categories','breadcat','newProduct'));

       }// End Method
       public function SubCatWiseProduct(Request $request,$id,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();

        $breadsubcat = SubCategory::where('id',$id)->first();

        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.product_subcategory',compact('products','categories','breadsubcat','newProduct'));

       }// End Method
       public function modalProduct($id){
        $product = Product::with("category","brand","subcategory")->findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

          $size = $product->product_size;
          $product_size = explode(',', $size);
          return response()->json(array(
            'product'=>$product,
            'color'=>$product_color,
            'size'=>$product_size,

          ));
       }
}
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\{Category, SubCategory, Brand, Product, MultiImg, User, Slider, Banner};
use App\Models\Order;


class IndexController extends Controller
{
    public function index()
    {
        $categories =  Category::orderBy('category_name','ASC')->get();
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
        $vendors = User::where("Role","vendor")->get();
        $brands = Brand::limit(10)->get();
        return view('frontend.index', compact('category','categories', 'category2', 'product2',
        'category4','product4', 'product','products', 'sliders', 'banners', 'subcategories', 'users','news','special_offers','hot_deals','special_deals','vendors','brands'));
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
       public function BrandWiseProduct(Request $request , $id , $slug){
        $products = Product::where('status',1)->where('brand_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();

        $breadbrand= Brand::where('id',$id)->first();

        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.product_brand',compact('products','categories','breadbrand','newProduct'));
       }
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
       public function ProductSearch(Request $request){

        $request->validate(['search' => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name','ASC')->get();
        $products = Product::where('product_name','LIKE',"%$item%")->get();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.search',compact('products','item','categories','newProduct'));

    }// End Method
    public function SearchProduct(Request $request){



         $item = $request->search;
         $products = Product::where('product_name','LIKE',"%$item%")->select('product_name','product_slug','product_thambnail','selling_price','id')->limit(6)->get();

         return view('frontend.product.search_product',compact('products'));

      }// End Method
}
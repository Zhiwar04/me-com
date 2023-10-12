<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, SubCategory, Brand, Product, MultiImg, User};
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->get();
        if(request()->wantsJson()){
            return response()->json($products);
        }
        return view('backend.product.product_all', compact('products'));
    } //end method AllProduct

    public function AddProduct()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::with('subcategories')->latest()->get();
        if(request()->wantsJson()){
            return response()->json(
                [
                    'brands' => $brands,
                    'categories' => $categories,
                    'activeVendor' => $activeVendor,
                ]
            );
        }
        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendor'));
    }
    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        if(request()->wantsJson()){
            return response()->json($subcat);
        };
        return json_encode($subcat);

    }
    public function StoreProduct(Request $request)
    {

        $image = $request->file('product_thambnail');
        //naweki nwey le nrawa bam shewaya 20282.png
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        //ba package image intervation size rasmaka kam krawataa
        Image::make($image)->resize(800, 800)->save('upload/products/thambnail/' . $name_gen);
        //rasmaka lam shwena save krawa
        $save_url = 'upload/products/thambnail/' . $name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thambnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        //// multiple image upload from here

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            //naweki nwey le nrawa bam shewaya 20282.png
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            //ba package image intervation size rasmaka kam krawataa
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;
            MultiImg::create([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);

        } /// end foreach
        // end multi image

       if(request()->wantsJson()){
            return response()->json([
                'message' => 'Product Added successfully',
                'alert-type' => 'success'
            ]);
        }
        $notification = array(
            'message' => 'Product Added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }
    public function EditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->where('id', 'category_id')->get();
        $products = Product::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json(
                [
                    'products' => $products,
                    'multiImgs' => $multiImgs,

                ]
            );
        }
        return view('backend.product.product_edit', compact('brands', 'categories', 'activeVendor', 'products', 'subcategory', 'multiImgs'));
    } /// end method


    public function UpdateProduct($id,Request $request)
    {
        $product_id = $id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        if(request()->wantsJson()){
            return response()->json([
              'msg' => 'Product Updated Without Image successfully',
            ]);
        }
        $notification = array(
            'message' => 'Product Updated Without Image successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    } /// end method

    public function UpdateProductThambnail($id,Request $request)
    {
        $pro_id = $id;
        $oldImage = $request->old_img;
        $image = $request->file('product_thambnail');
        //naweki nwey le nrawa bam shewaya 20282.png
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        //ba package image intervation size rasmaka kam krawataa
        Image::make($image)->resize(800, 800)->save('upload/products/thambnail/' . $name_gen);
        //rasmaka lam shwena save krawa
        $save_url = 'upload/products/thambnail/' . $name_gen;
        // if (file_exists($oldImage)) {
        //     unlink($oldImage);
        // }
        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),

        ]);
        if(request()->wantsJson()){
            return response()->json([
              'msg' => 'Product Image Thambnail Updated successfully',
            ]);
        }
        $notification = array(
            'message' => 'Product Image Thambnail Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } /// end method

    public function UpdateProductMultiimage(Request $request,$id  )
    {

        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            //ba package image intervation size rasmaka kam krawataa
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);

            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
            if(request()->wantsJson()){
                return response()->json([
                  'msg' => 'Product Multi Image Updated successfully',


                ]);
            }
        } // end foreach

        $notification = array(
            'message' => 'Product Multi Image Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method



    public function MultiImageDelete($id)
    {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImg::findOrfail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
              'msg' => 'Product Multi Image Deleted successfully',
            ]);
        }

        $notification = array(
            'message' => 'Product Multi Image Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } ///end method


    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        if(request()->wantsJson()){
            return response()->json([
              'msg' => 'Product Inactive',
            ]);
        }
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method


    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        if(request()->wantsJson()){
            return response()->json([
              'msg' => 'Product Active',
            ]);
        }
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method


    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();
        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
            if(request()->wantsJson()){
                return response()->json([
                  'msg' => 'Product Deleted Successfuly',
                ]);
            }
            $notification = array(
                'message' => 'Product Deleted Successfuly',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } //end foreach
    } //end method

    public function ProductStock()
    {
        $products = Product::latest()->get();
        if(request()->wantsJson()){
            return response()->json([
              'products' => $products,
            ]);
        }
        return view('backend.product.product_stock', compact('products'));
    }
}
<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        if(request()->wantsJson()){

            return response()->json($brands);
        }
        return view('backend.brand.brand_all',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.brand_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //rasmaka wargirawatawa

       $image = $request->file('brand_image');
       //naweki nwey le nrawa bam shewaya 20282.png
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       //ba package image intervation size rasmaka kam krawataa
       Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
       //rasmaka lam shwena save krawa
       $save_url = 'upload/brand/'.$name_gen;
       $brand = Brand::create([
           'brand_name'=>$request->brand_name,
           'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
           'brand_image'=>$save_url,
       ]);
       //inserti datakan krawa bo naw databasaka

       if(request()->wantsJson()){
           return response()->json([
               'msg'=>'Brand Added successfully'
           ]);
       }
       $notification = array(
           'message' =>'Brand Added successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('brands.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Brand = Brand::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json([
                'Brand'=>$Brand,
            ]);
        }
        return view('backend.brand.brand_edit',compact('Brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

       $Brand= Brand::findOrFail($id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url,
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Brand Updated successfully',
                'status'=>201,
                'data'=>$Brand,
            ]);
        }

       $notification = array(
            'message' => 'Brand Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('brands.index')->with($notification);

        } else {

           $Brand =   Brand::findOrFail($id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Brand Updated successfully',
                'status'=>201,
                'data'=>$Brand,
            ]);
        }
       $notification = array(
            'message' => 'Brand Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('brands.index')->with($notification);

        } // end else
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

            $brand = Brand::findOrFail($id);
            $img = $brand->brand_image;
            unlink($img);

            $brand->delete();
           if(request()->wantsJson()){
               return response()->json([
                   'msg'=>'Brand Deleted successfully',

               ]);
              }
            $notification = array(
                'message' => 'Brand Deleted Successfully',
                'alert-type' => 'success'
            );
        // Redirect to a relevant page, such as a brand list page.
        return redirect()->back()->with($notification);
    }

}
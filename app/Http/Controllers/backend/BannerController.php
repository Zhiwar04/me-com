<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Image;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $banner = Banner::latest()->get();
        if(request()->wantsJson()){

            return response()->json($banner);
        }
        return view('backend.banner.banner_all',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.banner_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $image = $request->file('banner_image');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
    $save_url = 'upload/banner/'.$name_gen;

   $banner =  Banner::insert([
        'banner_title' => $request->banner_title,
        'banner_url' => $request->banner_url,
        'banner_image' => $save_url,
    ]);
   if(request()->wantsJson()){
    return response()->json([
        'msg'=>'Banner Added successfully',
      
    ]);
   }
   $notification = array(
        'message' => 'Banner Inserted Successfully',
        'alert-type' => 'info'
    );

    return redirect()->route('banners.index')->with($notification);
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
        $banner = Banner::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($banner);
        }
        return view('backend.banner.banner_edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $old_img = $request->old_image;

        if ($request->file('banner_image')) {

        $image = $request->file('banner_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

      $banner =   Banner::findOrFail($id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);
         if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Banner Updated successfully',
                'status'=>201,
                'data'=>$banner,
            ]);
         }
       $notification = array(
            'message' => 'Banner Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('banners.index')->with($notification);

        } else {

         $banner =    Banner::findOrFail($id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
        ]);
            if(request()->wantsJson()){
                return response()->json([
                    'msg'=>'Banner Updated successfully',
                    'status'=>201,
                    'data'=>$banner,
                ]);
            }

       $notification = array(
            'message' => 'Banner Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('banners.index')->with($notification);

        } // end else
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        if(file_exists($img)){
        unlink($img );
        }
        Banner::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Banner Deleted successfully',
                'status'=>201,
                'data'=>$banner,
            ]);
        }

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        if(request()->wantsJson()){

            return response()->json($sliders);
        }
        return view('backend.slider.slider_all',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.slider_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(request()->wantsJson()){
            $request->validate([
                'slider_title' => 'required',
                'short_title' => 'required',
                'slider_image' => 'required',
            ]);
            $slider = Slider::create($request->all());
            return response()->json([
                'msg'=>'Slider Added successfully',
                'status'=>201,
                'data'=>$slider,
            ]);
        }
         //rasmaka wargirawatawa
         $image = $request->file('slider_image');
         //naweki nwey le nrawa bam shewaya 20282.png
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         //ba package image intervation size rasmaka kam krawataa
         Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
         //rasmaka lam shwena save krawa
         $save_url = 'upload/slider/'.$name_gen;
         //inserti datakan krawa bo naw databasaka
         Slider::insert([
             'slider_title'=>$request->slider_title,
             'short_title'=>$request->short_title,
             'slider_image'=>$save_url,
         ]);
         $notification = array(
             'message' =>'Slider Added successfully',
             'alert-type' => 'success'
         );
         return redirect()->route('sliders.index')->with($notification);
    }

    public function edit(string $id)
    {


        $Slider = Slider::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json([
                'data'=>$Slider,
            ]);
        }
        return view('backend.slider.slider_edit',compact('Slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $old_image = $request->old_image;
        $image = $request->file('slider_image');
        if($image){
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;
            // am if a agar filaka saqatt bwbw awa har updatakaman bo akat
            //todo gar berm nachwawa abe bo gsht imagakan am marga zyad bkam😁
            if(file_exists($old_image)){
                unlink($old_image);
            }
            Slider::findOrFail($id)->update([
                'slider_title'=>$request->slider_title,
                'short_title'=>$request->short_title,
                'slider_image'=>$save_url,
            ]);
            if(request()->wantsJson()){
                return response()->json([
                    'msg'=>'Slider Updated successfully',
                    'status'=>201,
                ]);
            }
            $notification = array(
                'message' =>'Slider Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('sliders.index')->with($notification);
        }else{
            Slider::findOrFail($id)->update([
                'slider_title'=>$request->slider_title,
                'short_title'=>$request->short_title,
            ]);
            $notification = array(
                'message' =>'Slider Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('sliders.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Slider::findOrFail($id);
        if(request()->wantsJson()){
            $image->delete();
            return response()->json([
                'msg'=>'Slider Deleted successfully',
                'status'=>201,
            ]);
        }
        $old_image = $image->slider_image;
        if(file_exists($old_image)){
        unlink($old_image);
        }
        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Slider Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('sliders.index')->with($notification);
    }
}
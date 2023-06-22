<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
class SliderController extends Controller
{
    public function AllSlider(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all',compact('sliders'));
    }
    public function AddSlider(){
        return view('backend.slider.slider_add');
    }
    public function StoreSlider(Request $request){
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
        return redirect()->route('all.slider')->with($notification);
       }
       public function EditSlider($id){

        $Slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('Slider'));
       }
       public function UpdateSlider(Request $request){
        $id = $request->id;
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
            $notification = array(
                'message' =>'Slider Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        }else{
            Slider::findOrFail($id)->update([
                'slider_title'=>$request->slider_title,
                'short_title'=>$request->short_title,
            ]);
            $notification = array(
                'message' =>'Slider Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        }
       }
       public function DeleteSlider($id){
        $image = Slider::findOrFail($id);
        $old_image = $image->slider_image;
        if(file_exists($old_image)){
        unlink($old_image);
        }
        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Slider Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);
       }
}
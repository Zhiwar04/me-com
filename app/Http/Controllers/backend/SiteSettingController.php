<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Seo;
use Image;

class SiteSettingController extends Controller
{
    public function SiteSetting()
    {
        //
        $setting = SiteSetting::find(1);
        if(request()->wantsJson()){
            return response()->json($setting);
        }
        return view('backend.setting.setting_update', compact('setting'));
    } //end method
    public function SiteSettingUpdate(Request $request)
    {

        $setting_id = $request->id;
        if ($request->file('logo')) {

            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(180, 56)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;
            SiteSetting::findOrFail($setting_id)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
                'logo' => $save_url,
            ]);
            if(request()->wantsJson()){
                return response()->json([
                    'msg'=>'Site Setting Updated with image Successfully',
                    'status'=>201,
                ]);
            }

            $notification = array(
                'message' => 'Site Setting Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            SiteSetting::findOrFail($setting_id)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
            ]);
            if(request()->wantsJson()){
                return response()->json([
                    'msg'=>'Site Setting Updated without image Successfully',
                    'status'=>201,
                ]);
            }
            $notification = array(
                'message' => 'Site Setting Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } // end else

    } // End Method


    /// Seo setting
    public function SeoSetting()
    {
        $seo = Seo::find(1);
        if(request()->wantsJson()){
            return response()->json($seo);
        }
        return view('backend.seo.seo_update', compact('seo'));
    } //end method

    public function SeoSettingUpdate(Request $request)
    {
        $seo_id = $request->id;
        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,

        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Seo Setting Updated Successfully',
                'status'=>201,
            ]);
        }


        $notification = array(
            'message' => 'Seo Setting Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupon = Coupon::latest()->get();
        if(request()->wantsJson()){
            return response()->json($coupon);
        }
        return view('backend.coupon.coupon_all', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.coupon.coupon_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $coupon =  Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Coupon Added successfully',
                'status'=>201,
                'data'=>$coupon,
            ]);
        };
        $notification = array(
            'message' => 'Coupon Added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('coupons.index')->with($notification);
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
        $coupon = Coupon::findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($coupon);
        }
        return view('backend.coupon.edit_coupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


       $coupon =  Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('coupons.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $coupon =  Coupon::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'Coupon Deleted successfully',

            ]);
        };
        $notification = array(
            'message' =>'Coupon Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
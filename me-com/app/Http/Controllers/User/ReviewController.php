<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Carbon\Carbon;
use Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {

        $product = $request->product_id;
        $vendor = $request->hvendor_id;

        $request->validate([
            'comment' => 'required',
        ]);

      $review =   Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id'  => $vendor,
            'created_at' => Carbon::now(),
        ]);
     if(request()->wantsJson()){
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Review Added Successfully',
                ]

            );
        }

        $notification = array(
            'message' => 'Review Will Approve By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method

    public function PendingReveiw()
    {
        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($review);
        }
        return view('backend.review.pending_review', compact('review'));
    } //end method
    public function ReviewApprove($id)
    {
        Review::where('id', $id)->update(['status' => 1]);
        if(request()->wantsJson()){
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Review Approved Successfully',
                ]

            );
        }

        $notification = array(
            'message' => 'Review Approve Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
    public function ReviewPublish()
    {

        $review = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($review);
        }
        return view('backend.review.publish_review', compact('review'));
    } //end method

    public function ReviewDelete($id)
    {
        Review::findOrFail($id)->delete();
        if(request()->wantsJson()){
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Review Deleted Successfully',
                ]

            );
        }
        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method

    public function VendorAllReview()
    {
        $id = Auth::user()->id;
        $review = Review::where('vendor_id', $id)->where('status', 1)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($review);
        }
        return view('vendor.backend.review.approve_review', compact('review'));
    } // end method
}
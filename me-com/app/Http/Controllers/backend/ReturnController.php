<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReturnController extends Controller
{
    public function ReturnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orders);
        }
        return view('backend.return_order.return_request', compact('orders'));
    } // end method

    public function ReturnRequestApproved($order_id)
    {
        Order::where('id', $order_id)->update(['return_order' => 2]);
        if(request()->wantsJson()){
            return response()->json([
                'message'=>'Return Order successfully'
            ]);
        }
        $notification = array(
            'message' => 'Return Order successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method

    public function CompleteReturnRequest()
    {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orders);
        }
        return view('backend.return_order.complete_return_request', compact('orders'));
    } // end method
}
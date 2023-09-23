<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\{Order, OrderItem};
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function VendorOrder()
    {

        $id = Auth::user()->id;
        $orderitem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orderitem);
        }
        return view('vendor.backend.orders.pending_orders', compact('orderitem'));
    } // End Method

    public function VendorReturnOrder()
    {
        $id = Auth::user()->id;
        $orderitem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orderitem);
        }
        return view('vendor.backend.orders.return_order', compact('orderitem'));
    } // end method

    public function VendorCompleteReturnOrder()
    {
        $id = Auth::user()->id;
        $orderitem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orderitem);
        }
        return view('vendor.backend.orders.complete_return_order', compact('orderitem'));
    } // end method

    public function VendorOrderDetails($order_id)
    {
        $order = Order::with('division', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orderItem);
        }
        return view('vendor.backend.orders.vendor_order_details', compact('order', 'orderItem'));
    } // End Method
}
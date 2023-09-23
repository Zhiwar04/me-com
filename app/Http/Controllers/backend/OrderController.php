<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, OrderItem, Product};
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class OrderController extends Controller
{

    public function PendingOrder()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orders);
        }
        return view('backend.orders.pending_orders', compact('orders'));
    } // End Method

    public function AdminOrderDetails($order_id)
    {

        $order = Order::with('division', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json([
                'order'=>$order,
                'orderItem'=>$orderItem
            ]);

        }

        return view('backend.orders.admin_order_details', compact('order', 'orderItem'));
    } // End Method
    public function AdminConfirmedOrder()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orders);
        }
        return view('backend.orders.confirmed_orders', compact('orders'));
    } // End Method
    public function AdminProcessingOrder()
    {
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orders);
        }
        return view('backend.orders.processing_orders', compact('orders'));
    } // End Method

    public function AdminDeliveredOrder()
    {
        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json($orders);
        }
        return view('backend.orders.delivered_orders', compact('orders'));
    } // End Method

    public function PendingToConfirm($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'confirm']);
        if(request()->wantsJson()){
            return response()->json([
                'message'=>'Order Confirm Successfully',
                'status'=>200
            ]);
        }
        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirmed.order')->with($notification);
    } //end method


    public function ConfirmToProcessing($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'processing']);
        if(request()->wantsJson()){
            return response()->json([
                'message'=>'Order Processing Successfully',
                'status'=>200
            ]);
        }
        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );
        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.processing.order')->with($notification);
    } ///end method

    public function ProcessingToDelivered($order_id)
    {
        $product = OrderItem::where('order_id', $order_id)->get();
        if(request()->wantsJson()){
            return response()->json([
                'product'=>$product
            ]);
        }
        foreach ($product as $item) {
            // db raw query for update product qty substract from order item qty
            Product::where('id', $item->product_id)->update(['product_qty' => \Illuminate\Support\Facades\DB::raw('product_qty-' . $item->qty)]);
        }
      $order =  Order::findOrFail($order_id)->update(['status' => 'delivered']);
        if(request()->wantsJson()){
            return response()->json([
                'message'=>'Order Delivered Successfully',
                'status'=>200
            ]);
        }
        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.delivered.order')->with($notification);
    } //end method

    public function AdminInvoiceDownload($order_id)
    {

        $order = Order::with('user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        if(request()->wantsJson()){
            return response()->json([
                'order'=>$order,
                'orderItem'=>$orderItem
            ]);

        }

        $pdf = Pdf::loadView('backend.orders.admin_order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // End Method

}
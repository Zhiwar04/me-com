<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Models\{OrderItem,Order};
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use App\Models\User;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){
        //set your secret key: remember to change this to your live secret key in production
        \Stripe\Stripe::setApiKey('sk_test_51NbcSoJZlDKXJD9l6M2bm9eKNYQo6ziPulop3KhoqgwiPBQRQNimHyta66CGHBhuICzabv4PcaxmjoNDmFWGmdHS00dk92tRNv');


        $token = $_POST['stripeToken'];

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = \Cart::getTotal();
        }
        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
          'currency' => 'usd',
          'description' => ' Zhiwar Store',
          'source' => $token,
          'metadata' => ['order_id' => uniqid()],
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            // 'district_id' => $request->district_id,
            // 'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            // 'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'mv'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),


        ]);
          // Start Send Email

          $invoice = Order::findOrFail($order_id);

          $data = [

              'invoice_no' => $invoice->invoice_no,
              'amount' => $total_amount,
              'name' => $invoice->name,
              'email' => $invoice->email,

          ];
    Mail::to($request->email)->send(new OrderMail($data));
          // End Send Email
        $carts =  \Cart::getContent();
        foreach($carts as $cart){

            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->attributes->vendor,
                'color' => $cart->attributes->color,
                'size' => $cart->attributes->size,
                'qty' => $cart->quantity,
                'price' => $cart->price,
                'created_at' =>Carbon::now(),

            ]);

        } // End Foreach

        if (Session::has('coupon')) {
           Session::forget('coupon');
        }

        \Cart::clear();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
        // dd($charge);
    }
    public function CashOrder(Request $request){
        $user = User::where('role','admin')->get();
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = \Cart::getTotal();
        }
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            // 'district_id' => $request->district_id,
            // 'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            // 'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => "Cash On Delivery",
            'payment_method' => "Cash On Delivery",

            'currency' => "IQD",
            'amount' => $total_amount,

            'invoice_no' => 'ord'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);
               // Start Send Email

               $invoice = Order::findOrFail($order_id);

               $data = [

                   'invoice_no' => $invoice->invoice_no,
                   'amount' => $total_amount,
                   'name' => $invoice->name,
                   'email' => $invoice->email,

               ];
               Mail::to($data['email'])->send(new OrderMail($data));
                            // End Send Email
        $carts =  \Cart::getContent();

        foreach($carts as $cart){

            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->attributes->vendor,
                'color' => $cart->attributes->color,
                'size' => $cart->attributes->size,
                'qty' => $cart->quantity,
                'price' => $cart->price,
                'created_at' =>Carbon::now(),

            ]);

        } // End Foreach

        if (Session::has('coupon')) {
           Session::forget('coupon');
        }

        \Cart::clear();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );
        Notification::send($user, new OrderComplete($request->name));
        return redirect()->route('dashboard')->with($notification);
        // dd($charge);
    }
}
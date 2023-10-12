<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Coupon,Product,ShipDivision};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{



    public function CheckoutStore(Request $request){
        $data =array(
            "shipping_name" => $request->shipping_name,
            "shipping_email" => $request->shipping_email,
            "shipping_phone" => $request->shipping_phone,
            "shipping_address" => $request->shipping_address,
            "division_id" => $request->division_id,

            "notes" => $request->notes,
        );
        $cartTotal = \Cart::getTotal();
        if ($request->payment_option == 'stripe') {
            return view('frontend.payment.stripe',compact('data','cartTotal'));
         }elseif ($request->payment_option == 'cash'){
             return view('frontend.payment.cash',compact('data','cartTotal'));
            }else{
             return 'Card Page';
         }


     }// End Method
    }
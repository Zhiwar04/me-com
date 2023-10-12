<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\{Coupon,Product,ShipDivision};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function storeToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        if(Auth::check()){
            \Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'user_id' => Auth::id(),
                'price' => $price,
                'quantity' => $request->quantity,
                'attributes' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'product_thumbnail' => $product->product_thambnail,
                    'vendor' => $request->vendor,

                ],
            ]);

            return response()->json(["success" => "The product has been added to your cart"]);
        }else{
            return response()->json(["error" => "Please Login First"]);
        }


    }
    public function storeInDetailCart(Request $request, $id)
    {        if(Session::has('coupon')){
        Session::forget('coupon');
    }


        $product = Product::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;
        if(Auth::check()){
            \Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'user_id' => Auth::id(),
                'price' => $price,
                'quantity' => $request->quantity,
                'attributes' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'product_thumbnail' => $product->product_thambnail,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(["success" => "The product has been added to your cart"]);
        }else{
            return response()->json(["error" => "Please Login First"]);
        }

    }
    public function AddToCart()
    {
        $cartCollection = \Cart::getContent();
        $total = \Cart::getTotal();
        $quantity = $cartCollection->count();



        return response()->json([
            'cartCollection' => $cartCollection,
            'total' => $total,
            'quantity' => $quantity, // Return the quantity per item

        ]);
    }//end of add to cart


    public function RemoveCartItem($id)
    {
        \Cart::remove($id);
        return response()->json(["success" => "The product has been removed from your cart"]);
    }//end of remove cart item
    public function MyCart(){

        return view('frontend.mycart.view_mycart');

    }// End Method
    public function GetCartProduct(){
        $cartCollection = \Cart::getContent();
        $cartTotal = $cartCollection->count();
        $total = \Cart::getTotal();


        return response()->json([
            'cartCollection' => $cartCollection,
            'cartQty' => $total,
            'cartTotal' => $cartTotal, // Return the quantity per item


        ]);
    }

    public function CartRemove($rowId){

        \Cart::remove($rowId);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((\Cart::getTotal() * $coupon->coupon_discount) / 100),
                'total_amount' => round(\Cart::getTotal() - (\Cart::getTotal() * $coupon->coupon_discount) / 100)]);
        }
        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method
    public function CartDecrement($id){
        \Cart::update($id, array(
            'quantity' => -1,
        ));
        if (Session::has('coupon')) {
            $coupon = Coupon::where('coupon_name', session()->get('coupon')['coupon_name'])
                ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                ->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((\Cart::getTotal() * $coupon->coupon_discount) / 100),
                'total_amount' => round(\Cart::getTotal() - (\Cart::getTotal() * $coupon->coupon_discount) / 100)]);
        }else{
            return response()->json(array(
                'total' => \Cart::getTotal(),
            ));
        }
        return response()->json('Decrement');

    }// End Method
    public function CartIncrement($id){

        \Cart::update($id, array(
            'quantity' => +1,
        ));
        if (Session::has('coupon')) {
            $coupon = Coupon::where('coupon_name', session()->get('coupon')['coupon_name'])
                ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                ->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((\Cart::getTotal() * $coupon->coupon_discount) / 100),
                'total_amount' => round(\Cart::getTotal() - (\Cart::getTotal() * $coupon->coupon_discount) / 100)]);
        }else{
            return response()->json(array(
                'total' => \Cart::getTotal(),
            ));
        }
        return response()->json('Increment');
    }// End Method
    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();

        if ($coupon) {
            if (Session::has('coupon') && Session::get('coupon')['coupon_name'] == $coupon->coupon_name) {
                return response()->json(['error' => 'Coupon Already Applied']);
            } else {
                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round((\Cart::getTotal() * $coupon->coupon_discount) / 100),
                    'total_amount' => round(\Cart::getTotal() - (\Cart::getTotal() * $coupon->coupon_discount) / 100)
                ]);

                return response()->json([
                    'validity' => true,
                    'success' => 'Coupon Applied Successfully'
                ]);
            }
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function CouponCalculation(){

        if (Session::has('coupon')) {

            return response()->json(array(
             'subtotal' => \Cart::getTotal(),
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => \Cart::getTotal(),
            ));
        }
    }// End Method
    public function CouponRemove(){

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    }// End Method
    public function CheckoutCreate(){

        if (Auth::check()) {

            if (\Cart::getTotal() > 0) {
        $carts =  \Cart::getContent();
        $cartQty = $carts->count();
        $cartTotal = \Cart::getTotal();
        $divisions = ShipDivision::orderBy('division_name')->get();
        return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));


            }
        }else{

             $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
        );

        return redirect()->route('login')->with($notification);
        }
    }// End Method
}
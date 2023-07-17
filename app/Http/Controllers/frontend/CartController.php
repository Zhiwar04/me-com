<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
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
                ],
            ]);

            return response()->json(["success" => "The product has been added to your cart"]);
        }else{
            return response()->json(["success" => "Please Login First"]);
        }


    }
    public function storeInDetailCart(Request $request, $id)
    {
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
                ],
            ]);

            return response()->json(["success" => "The product has been added to your cart"]);
        }else{
            return response()->json(["success" => "Please Login First"]);
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
        $total = \Cart::getTotal();
        $cartTotal = $cartCollection->count();

        return response()->json([
            'cartCollection' => $cartCollection,
            'cartQty' => $total,
            'cartTotal' => $cartTotal, // Return the quantity per item


        ]);
    }

    public function CartRemove($rowId){
        \Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method
    public function CartDecrement($id){
        \Cart::update($id, array(
            'quantity' => -1,
        ));

        return response()->json('Decrement');

    }// End Method
    public function CartIncrement($id){

        \Cart::update($id, array(
            'quantity' => +1,
        ));

        return response()->json('Increment');

    }// End Method
}

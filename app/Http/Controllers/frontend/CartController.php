<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $user_id;

    public function __construct()
    {
        $this->user_id = 1;
        \Cart::session($this->user_id);
    }

    public function storeToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;

        \Cart::add([
            'id' => $id,
            'name' => $request->product_name,
            'user_id' => $this->user_id,
            'price' => $price,
            'quantity' => $request->quantity,
            'attributes' => [
                'size' => $request->size,
                'color' => $request->color,
                'product_thumbnail' => $product->product_thambnail,
            ],
        ]);

        return response()->json(["success" => "The product has been added to your cart"]);
    }
    public function storeInDetailCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;

        \Cart::add([
            'id' => $id,
            'name' => $request->product_name,
            'user_id' => $this->user_id,
            'price' => $price,
            'quantity' => $request->quantity,
            'attributes' => [
                'size' => $request->size,
                'color' => $request->color,
                'product_thumbnail' => $product->product_thambnail,
            ],
        ]);

        return response()->json(["success" => "The product has been added to your cart"]);
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
}
<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add to Cart
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Product not found!');
        }

        $cartItem = Cart::where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id'    => $product->id,
                'product_name'  => $product->name,
                'product_image' => $product->image,
                'quantity'      => 1,
                'price'         => $product->price,
            ]);
        }

        return redirect()->route('cart.view')
            ->with('success', 'Product added to cart!');
    }

    // View Cart
    public function viewCart()
    {
        $cartItems = Cart::all();
        return view('website.cart', compact('cartItems'));
    }

    // Remove Item
    public function removeItem($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('cart.view')->with('success', 'Item removed!');
    }
}

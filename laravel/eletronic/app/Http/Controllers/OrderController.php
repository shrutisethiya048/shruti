<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{

    // Checkout page
    public function checkout()
    {
        $cartItems = Cart::all();
        return view('website.checkout', compact('cartItems'));
    }
    public function index()
{
    $orders = Order::latest()->get();
    return view('admin.order', compact('orders'));
}
    // Place Order
    public function store(Request $request)
    {

        $cartItems = Cart::all();

        if($cartItems->count() == 0){
            return back()->with('error','Cart is empty');
        }

        foreach($cartItems as $item){

            Order::create([
                'customer_name'  => $request->first_name.' '.$request->last_name,
                'customer_email' => $request->email,
                'customer_phone' => $request->mobile,
                'products'       => $item->product_name,
                'quantity'       => $item->quantity,
                'status'         => 'Pending',
                'payment_status' => 'Unpaid'
            ]);

        }

        // cart empty
        Cart::truncate();

        return redirect()->route('order.success');
    }

    // Change order status
    public function changeStatus($id, $status)
    {
        $order = Order::findOrFail($id);

        $order->status = $status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated');
    }

    // Delete order
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Order deleted');
    }
}
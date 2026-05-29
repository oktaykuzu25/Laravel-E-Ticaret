<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('details')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->name = $request->name;
        $order->surname = $request->surname;
        $order->address = $request->address;
        $order->message = $request->message;
        $order->total_price = ShoppingCart::totalPrice();
        $order->payment_method = 'paytr';
        $order->save();

        $items = ShoppingCart::all();
        foreach ($items as $item) {
            $orderdetail = new OrderDetail();
            $orderdetail->order_id = $order->id;
            $orderdetail->product_id = $item->id;
            $orderdetail->per_price = $item->price;
            $orderdetail->qty = $item->qty;
            $orderdetail->subtotal = $item->price * $item->qty;
            $orderdetail->save();
        }

        ShoppingCart::destroy();
        return redirect()->back();
    }
}

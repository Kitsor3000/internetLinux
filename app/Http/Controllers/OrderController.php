<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return back()->with('error', 'Кошик порожній');

        $total = array_sum(array_map(fn($i) =>
            $i['price'] * $i['quantity'], $cart
        ));

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'  => 'required',
            'customer_email' => 'required|email',
        ]);

        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) =>
            $i['price'] * $i['quantity'], $cart
        ));

        $order = Order::create([
            ...$data,
            'total' => $total,
            'status' => 'new'
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $productId,
                'quantity'  => $item['quantity'],
                'price'     => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Замовлення створено');
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
}
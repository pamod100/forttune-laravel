<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.cart');
    }

    /**
     * Cart items are sent from the JS cart (localStorage) as JSON
     * when the customer clicks "Place Order".
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'delivery_method' => 'required|in:delivery,pickup',
            'delivery_address' => 'required_if:delivery_method,delivery|nullable|string',
            'payment_method' => 'required|in:payhere,webxpay,cod',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $order = DB::transaction(function () use ($validated) {
            $total = collect($validated['items'])->sum(fn($i) => $i['price'] * $i['qty']);

            $order = Order::create([
                'order_number' => 'FT-' . strtoupper(Str::random(8)),
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'delivery_method' => $validated['delivery_method'],
                'delivery_address' => $validated['delivery_address'] ?? null,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'total' => $total,
            ]);

            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                ]);
            }

            return $order;
        });

        return response()->json([
            'success' => true,
            'order_number' => $order->order_number,
        ]);
    }
}

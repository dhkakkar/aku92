<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'     => 'required|string|max:150',
            'customer_email'    => 'required|email|max:150',
            'customer_phone'    => 'required|string|max:20',
            'shipping_address'  => 'required|string|max:500',
            'city'              => 'required|string|max:100',
            'state'             => 'required|string|max:100',
            'pincode'           => 'required|string|max:10',
            'payment_method'    => 'required|in:cod,online',
            'notes'             => 'nullable|string|max:1000',
            'items'             => 'required|array|min:1',
            'items.*.id'        => 'required',
            'items.*.name'      => 'required|string|max:255',
            'items.*.price'     => 'required|numeric|min:0',
            'items.*.qty'       => 'required|integer|min:1',
        ]);

        if ($data['payment_method'] === 'online') {
            return response()->json([
                'success' => false,
                'message' => 'Online payments are not enabled yet. Please choose Cash on Delivery.',
            ], 422);
        }

        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += (float) $item['price'] * (int) $item['qty'];
        }
        $shipping = $subtotal >= 500 ? 0 : 40;
        $total    = $subtotal + $shipping;

        $order = DB::transaction(function () use ($data, $subtotal, $shipping, $total) {
            $order = Order::create([
                'customer_name'    => $data['customer_name'],
                'customer_email'   => $data['customer_email'],
                'customer_phone'   => $data['customer_phone'],
                'shipping_address' => $data['shipping_address'],
                'city'             => $data['city'],
                'state'            => $data['state'],
                'pincode'          => $data['pincode'],
                'payment_method'   => $data['payment_method'],
                'subtotal'         => $subtotal,
                'shipping'         => $shipping,
                'total'            => $total,
                'status'           => 'pending',
                'notes'            => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                $productId = is_numeric($item['id']) ? (int) $item['id'] : null;
                $qty = (int) $item['qty'];
                $price = (float) $item['price'];

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $productId,
                    'product_name' => $item['name'],
                    'quantity'     => $qty,
                    'price'        => $price,
                    'total'        => $price * $qty,
                ]);

                if ($productId) {
                    Product::where('id', $productId)->where('stock', '>', 0)->decrement('stock', $qty);
                }
            }

            return $order;
        });

        return response()->json([
            'success'      => true,
            'message'      => 'Order placed successfully.',
            'order_number' => $order->order_number,
            'redirect'     => url('/shop/order/' . $order->order_number),
        ]);
    }

    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('shop.order-success', compact('order'));
    }
}

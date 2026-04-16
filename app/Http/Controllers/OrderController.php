<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $orderNumber = 'AKU-' . strtoupper(uniqid());
        $now = now();

        $orderId = DB::table('orders')->insertGetId([
            'user_id'          => Auth::id(),
            'order_number'     => $orderNumber,
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
            'created_at'       => $now,
            'updated_at'       => $now,
        ]);

        $rows = [];
        foreach ($data['items'] as $item) {
            $productId = is_numeric($item['id']) ? (int) $item['id'] : null;
            $qty = (int) $item['qty'];
            $price = (float) $item['price'];

            $rows[] = [
                'order_id'     => $orderId,
                'product_id'   => $productId,
                'product_name' => $item['name'],
                'quantity'     => $qty,
                'price'        => $price,
                'total'        => $price * $qty,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];

            if ($productId) {
                try {
                    Product::where('id', $productId)->where('stock', '>', 0)->decrement('stock', $qty);
                } catch (\Throwable $e) {
                    Log::warning('Stock decrement failed for product ' . $productId . ': ' . $e->getMessage());
                }
            }
        }

        DB::table('order_items')->insert($rows);

        // Sync shipping address back to the logged-in user's profile for future auto-fill.
        if ($userId = Auth::id()) {
            DB::table('users')->where('id', $userId)->update([
                'phone'      => $data['customer_phone'],
                'address'    => $data['shipping_address'],
                'city'       => $data['city'],
                'state'      => $data['state'],
                'pincode'    => $data['pincode'],
                'updated_at' => $now,
            ]);
        }

        return response()->json([
            'success'      => true,
            'message'      => 'Order placed successfully.',
            'order_number' => $orderNumber,
            'redirect'     => url('/shop/order/' . $orderNumber),
        ]);
    }

    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('shop.order-success', compact('order'));
    }
}

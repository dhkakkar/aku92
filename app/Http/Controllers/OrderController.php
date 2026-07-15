<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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

        // Cash on Delivery is disabled — every order is paid online via Razorpay.
        if ($data['payment_method'] !== 'online') {
            return response()->json([
                'success' => false,
                'message' => 'Cash on Delivery is currently unavailable. Please pay online to place your order.',
            ], 422);
        }

        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += (float) $item['price'] * (int) $item['qty'];
        }
        $shipping = 0; // Free shipping on all orders.
        $total    = $subtotal + $shipping;
        $amountPaise = (int) round($total * 100);

        $key    = config('services.razorpay.key');
        $secret = config('services.razorpay.secret');

        if (! $key || ! $secret) {
            return response()->json([
                'success' => false,
                'message' => 'Online payment is not configured yet. Please try again later.',
            ], 500);
        }

        $orderNumber = 'AKU-' . strtoupper(uniqid());
        $now = now();

        // Create the Razorpay order first — never persist an order we cannot collect payment for.
        try {
            $rzp = Http::withBasicAuth($key, $secret)
                ->asForm()
                ->post('https://api.razorpay.com/v1/orders', [
                    'amount'          => $amountPaise,
                    'currency'        => 'INR',
                    'receipt'         => $orderNumber,
                    'payment_capture' => 1,
                ]);
        } catch (\Throwable $e) {
            Log::error('Razorpay order create failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Could not reach the payment gateway. Please try again.'], 502);
        }

        $rzpOrderId = $rzp->json('id');
        if (! $rzp->successful() || ! $rzpOrderId) {
            Log::error('Razorpay order error: ' . $rzp->body());
            return response()->json(['success' => false, 'message' => 'Payment gateway error. Please try again.'], 502);
        }

        $orderId = DB::table('orders')->insertGetId([
            'user_id'           => Auth::id(),
            'order_number'      => $orderNumber,
            'customer_name'     => $data['customer_name'],
            'customer_email'    => $data['customer_email'],
            'customer_phone'    => $data['customer_phone'],
            'shipping_address'  => $data['shipping_address'],
            'city'              => $data['city'],
            'state'             => $data['state'],
            'pincode'           => $data['pincode'],
            'payment_method'    => 'online',
            'payment_status'    => 'pending',
            'razorpay_order_id' => $rzpOrderId,
            'subtotal'          => $subtotal,
            'shipping'          => $shipping,
            'total'             => $total,
            'status'            => 'pending',
            'notes'             => $data['notes'] ?? null,
            'created_at'        => $now,
            'updated_at'        => $now,
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
        }
        DB::table('order_items')->insert($rows);

        return response()->json([
            'success'  => true,
            'razorpay' => [
                'key'          => $key,
                'order_id'     => $rzpOrderId,
                'amount'       => $amountPaise,
                'currency'     => 'INR',
                'name'         => 'AKU 92',
                'description'  => 'Order ' . $orderNumber,
                'order_number' => $orderNumber,
                'verify_url'   => url('/api/orders/verify'),
                'prefill'      => [
                    'name'    => $data['customer_name'],
                    'email'   => $data['customer_email'],
                    'contact' => $data['customer_phone'],
                ],
            ],
        ]);
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'order_number'        => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature'  => 'required|string',
        ]);

        $order = Order::where('order_number', $data['order_number'])
            ->where('razorpay_order_id', $data['razorpay_order_id'])
            ->first();

        if (! $order) {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }

        $secret   = config('services.razorpay.secret');
        $expected = hash_hmac('sha256', $data['razorpay_order_id'] . '|' . $data['razorpay_payment_id'], (string) $secret);

        if (! hash_equals($expected, $data['razorpay_signature'])) {
            DB::table('orders')->where('id', $order->id)->update([
                'payment_status' => 'failed',
                'updated_at'     => now(),
            ]);
            return response()->json(['success' => false, 'message' => 'Payment could not be verified. If money was deducted it will be refunded.'], 422);
        }

        // Signature valid — mark paid (once) and reduce stock.
        if ($order->payment_status !== 'paid') {
            $now = now();
            DB::table('orders')->where('id', $order->id)->update([
                'payment_status'      => 'paid',
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'status'              => 'processing',
                'updated_at'          => $now,
            ]);

            foreach (DB::table('order_items')->where('order_id', $order->id)->get() as $item) {
                if ($item->product_id) {
                    try {
                        Product::where('id', $item->product_id)
                            ->where('stock', '>=', $item->quantity)
                            ->decrement('stock', $item->quantity);
                    } catch (\Throwable $e) {
                        Log::warning('Stock decrement failed for product ' . $item->product_id . ': ' . $e->getMessage());
                    }
                }
            }

            // Keep the logged-in customer's saved address in sync for future checkouts.
            if ($order->user_id) {
                DB::table('users')->where('id', $order->user_id)->update([
                    'phone'      => $order->customer_phone,
                    'address'    => $order->shipping_address,
                    'city'       => $order->city,
                    'state'      => $order->state,
                    'pincode'    => $order->pincode,
                    'updated_at' => $now,
                ]);
            }
        }

        return response()->json([
            'success'  => true,
            'redirect' => url('/shop/order/' . $order->order_number),
        ]);
    }

    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('shop.order-success', compact('order'));
    }
}

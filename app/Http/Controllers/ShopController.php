<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index', [
            'products' => Product::where('is_active', true)->get(),
        ]);
    }

    public function show(string $slug)
    {
        $product = is_numeric($slug)
            ? Product::findOrFail((int) $slug)
            : Product::where('slug', $slug)->firstOrFail();

        return view('shop.product', compact('product'));
    }

    public function cart()
    {
        return view('shop.cart');
    }

    public function checkout()
    {
        $prefill = [
            'customer_name'    => '',
            'customer_email'   => '',
            'customer_phone'   => '',
            'shipping_address' => '',
            'city'             => '',
            'state'            => '',
            'pincode'          => '',
        ];

        if ($user = Auth::user()) {
            $prefill['customer_name']  = $user->name ?? '';
            $prefill['customer_email'] = $user->email ?? '';
            $prefill['customer_phone'] = $user->phone ?? '';
            $prefill['shipping_address'] = $user->address ?? '';
            $prefill['city']    = $user->city ?? '';
            $prefill['state']   = $user->state ?? '';
            $prefill['pincode'] = $user->pincode ?? '';

            // Fallback: pull missing address fields from the user's most recent order.
            $needsAddress = $prefill['shipping_address'] === '' || $prefill['city'] === '' || $prefill['pincode'] === '';
            if ($needsAddress) {
                $lastOrder = Order::where('user_id', $user->id)->orderByDesc('created_at')->first();
                if ($lastOrder) {
                    $prefill['customer_name']    = $prefill['customer_name']    ?: $lastOrder->customer_name;
                    $prefill['customer_phone']   = $prefill['customer_phone']   ?: $lastOrder->customer_phone;
                    $prefill['shipping_address'] = $prefill['shipping_address'] ?: $lastOrder->shipping_address;
                    $prefill['city']             = $prefill['city']             ?: $lastOrder->city;
                    $prefill['state']            = $prefill['state']            ?: $lastOrder->state;
                    $prefill['pincode']          = $prefill['pincode']          ?: $lastOrder->pincode;
                }
            }
        }

        return view('shop.checkout', compact('prefill'));
    }
}

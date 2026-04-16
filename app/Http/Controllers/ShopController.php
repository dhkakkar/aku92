<?php

namespace App\Http\Controllers;

use App\Models\Product;

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
        return view('shop.checkout');
    }
}

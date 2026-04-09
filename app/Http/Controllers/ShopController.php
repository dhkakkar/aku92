<?php

namespace App\Http\Controllers;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index', [
            'products' => config('site.products'),
        ]);
    }

    public function show($id)
    {
        $products = config('site.products');
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) {
            abort(404);
        }

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

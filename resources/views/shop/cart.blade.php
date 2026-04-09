@extends('layouts.shop')

@section('title', 'Shopping Cart')

@section('content')

<div class="shop-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/aku92/shop') }}">Shop</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section shop-cart">
    <div class="container">
        <h2 class="mb-4">Shopping Cart</h2>

        <!-- Empty Cart Message -->
        <div id="emptyCart" class="text-center py-5 d-none">
            <i class="fas fa-shopping-cart fa-4x mb-3" style="color: var(--mid);"></i>
            <h4 style="color: var(--gray);">Your cart is empty</h4>
            <p style="color: var(--mid);">Add some products to get started.</p>
            <a href="{{ url('/aku92/shop') }}" class="btn btn-primary mt-2"><i class="fas fa-arrow-left"></i> Browse Products</a>
        </div>

        <div class="row">
            <!-- Cart Items (rendered by JS) -->
            <div class="col-lg-8 mb-4">
                <div class="shop-cart-table" id="cartItems">
                    <div class="text-center py-4" style="color: var(--mid);">
                        <i class="fas fa-spinner fa-spin"></i> Loading cart...
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mb-4" id="cartSummary">
                <div class="shop-cart-summary">
                    <h4>Order Summary</h4>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal (<span id="cartItemCount">0 items</span>)</span>
                        <span id="cartSubtotal">₹0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span id="cartShipping">₹40</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-success fs-5" id="cartTotal">₹0</strong>
                    </div>
                    <a href="{{ url('/aku92/shop/checkout') }}" class="btn btn-success btn-lg w-100 mb-2">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </a>
                    <a href="{{ url('/aku92/shop') }}" class="btn btn-outline-dark w-100">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

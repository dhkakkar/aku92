@extends('layouts.shop')

@section('title', 'Shopping Cart')

@section('content')

<div class="shop-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}">Shop</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section shop-cart">
    <div class="container">
        <h2 class="mb-4">Shopping Cart</h2>

        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8 mb-4">
                <div class="shop-cart-table" id="cartItems">
                    <!-- Sample static cart item -->
                    <div class="shop-cart-item">
                        <div class="shop-cart-img">
                            <img src="{{ asset('images/products/paper-carry-bags.jpg') }}" alt="Product">
                        </div>
                        <div class="shop-cart-details">
                            <h5>MNKPRR Paper Carry Bags</h5>
                            <p class="text-muted small">Medical Supplies</p>
                        </div>
                        <div class="shop-cart-qty">
                            <div class="qty-selector">
                                <button class="qty-btn">-</button>
                                <input type="number" class="qty-input" value="2" min="1">
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <div class="shop-cart-price">
                            <span>&#8377;80</span>
                        </div>
                        <div class="shop-cart-total">
                            <strong>&#8377;160</strong>
                        </div>
                        <button class="shop-cart-remove"><i class="fas fa-times"></i></button>
                    </div>

                    <div class="shop-cart-item">
                        <div class="shop-cart-img">
                            <img src="{{ asset('images/products/surgical-mask.jpg') }}" alt="Product">
                        </div>
                        <div class="shop-cart-details">
                            <h5>Surgical Mask Astrwch</h5>
                            <p class="text-muted small">Medical Supplies</p>
                        </div>
                        <div class="shop-cart-qty">
                            <div class="qty-selector">
                                <button class="qty-btn">-</button>
                                <input type="number" class="qty-input" value="5" min="1">
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <div class="shop-cart-price">
                            <span>&#8377;4</span>
                        </div>
                        <div class="shop-cart-total">
                            <strong>&#8377;20</strong>
                        </div>
                        <button class="shop-cart-remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mb-4">
                <div class="shop-cart-summary">
                    <h4>Order Summary</h4>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal (7 items)</span>
                        <span>&#8377;180</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>&#8377;40</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-success fs-5">&#8377;220</strong>
                    </div>
                    <a href="{{ url('/shop/checkout') }}" class="btn btn-success btn-lg w-100 mb-2">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </a>
                    <a href="{{ url('/shop') }}" class="btn btn-outline-dark w-100">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

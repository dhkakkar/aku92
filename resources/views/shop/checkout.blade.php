@extends('layouts.shop')

@section('title', 'Checkout')

@section('content')

<div class="shop-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}">Shop</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shop/cart') }}">Cart</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section shop-checkout">
    <div class="container">
        <h2 class="mb-4">Checkout</h2>

        <div class="row">
            <!-- Shipping Form -->
            <div class="col-lg-7 mb-4">
                <div class="shop-checkout-form">
                    <h4 class="mb-3"><i class="fas fa-shipping-fast"></i> Shipping Details</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone *</label>
                                <input type="tel" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address *</label>
                            <textarea class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">City *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">State *</label>
                                <select class="form-select" required>
                                    <option value="">Select State</option>
                                    <option>Haryana</option>
                                    <option>Punjab</option>
                                    <option>Uttar Pradesh</option>
                                    <option>Delhi</option>
                                    <option>Rajasthan</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pincode *</label>
                                <input type="text" class="form-control" maxlength="6" required>
                            </div>
                        </div>

                        <h4 class="mb-3 mt-4"><i class="fas fa-credit-card"></i> Payment Method</h4>
                        <div class="shop-payment-options">
                            <div class="form-check shop-payment-option mb-3">
                                <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    <i class="fas fa-money-bill-wave text-success me-2"></i>
                                    <strong>Cash on Delivery (COD)</strong>
                                    <span class="d-block small text-muted">Pay when you receive the order</span>
                                </label>
                            </div>
                            <div class="form-check shop-payment-option">
                                <input class="form-check-input" type="radio" name="payment" id="online" value="online">
                                <label class="form-check-label" for="online">
                                    <i class="fas fa-mobile-alt text-primary me-2"></i>
                                    <strong>Online Payment (UPI/Card)</strong>
                                    <span class="d-block small text-muted">Pay securely via Razorpay — coming soon</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5 mb-4">
                <div class="shop-cart-summary">
                    <h4>Order Summary</h4>
                    <hr>

                    <div class="shop-checkout-item d-flex gap-3 mb-3">
                        <img src="{{ asset('images/products/paper-carry-bags.jpg') }}" width="55" height="55" class="rounded" style="object-fit: cover;">
                        <div class="flex-grow-1">
                            <p class="mb-0 fw-semibold small">MNKPRR Paper Carry Bags</p>
                            <p class="mb-0 text-muted small">Qty: 2</p>
                        </div>
                        <strong>&#8377;160</strong>
                    </div>

                    <div class="shop-checkout-item d-flex gap-3 mb-3">
                        <img src="{{ asset('images/products/surgical-mask.jpg') }}" width="55" height="55" class="rounded" style="object-fit: cover;">
                        <div class="flex-grow-1">
                            <p class="mb-0 fw-semibold small">Surgical Mask Astrwch</p>
                            <p class="mb-0 text-muted small">Qty: 5</p>
                        </div>
                        <strong>&#8377;20</strong>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span><span>&#8377;180</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span><span>&#8377;40</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-success fs-5">&#8377;220</strong>
                    </div>

                    <button class="btn btn-success btn-lg w-100">
                        <i class="fas fa-lock"></i> Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

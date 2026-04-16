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

        <div id="checkoutEmpty" class="text-center py-5 d-none">
            <i class="fas fa-shopping-cart fa-4x mb-3" style="color: var(--mid);"></i>
            <h4 style="color: var(--gray);">Your cart is empty</h4>
            <p style="color: var(--mid);">Add products before proceeding to checkout.</p>
            <a href="{{ url('/shop') }}" class="btn btn-primary mt-2"><i class="fas fa-arrow-left"></i> Browse Products</a>
        </div>

        <div id="checkoutAlert" class="alert d-none"></div>

        <form id="checkoutForm" action="{{ url('/api/orders') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Shipping Form -->
                <div class="col-lg-7 mb-4">
                    <div class="shop-checkout-form">
                        <h4 class="mb-3"><i class="fas fa-shipping-fast"></i> Shipping Details</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone *</label>
                                <input type="tel" name="customer_phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="customer_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address *</label>
                            <textarea name="shipping_address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">State *</label>
                                <select name="state" class="form-select" required>
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
                                <input type="text" name="pincode" class="form-control" maxlength="6" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Order Notes (optional)</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions for delivery..."></textarea>
                        </div>

                        <h4 class="mb-3 mt-4"><i class="fas fa-credit-card"></i> Payment Method</h4>
                        <div class="shop-payment-options">
                            <div class="form-check shop-payment-option mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    <i class="fas fa-money-bill-wave text-success me-2"></i>
                                    <strong>Cash on Delivery (COD)</strong>
                                    <span class="d-block small text-muted">Pay when you receive the order</span>
                                </label>
                            </div>
                            <div class="form-check shop-payment-option">
                                <input class="form-check-input" type="radio" name="payment_method" id="online" value="online" disabled>
                                <label class="form-check-label text-muted" for="online">
                                    <i class="fas fa-mobile-alt me-2"></i>
                                    <strong>Online Payment (UPI/Card)</strong>
                                    <span class="d-block small">Coming soon</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5 mb-4">
                    <div class="shop-cart-summary">
                        <h4>Order Summary</h4>
                        <hr>

                        <div id="checkoutItems">
                            <div class="text-center py-3" style="color: var(--mid);">
                                <i class="fas fa-spinner fa-spin"></i> Loading cart...
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (<span id="checkoutItemCount">0 items</span>)</span>
                            <span id="checkoutSubtotal">₹0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span id="checkoutShipping">₹40</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong class="text-success fs-5" id="checkoutTotal">₹0</strong>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100" id="placeOrderBtn">
                            <i class="fas fa-lock"></i> Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

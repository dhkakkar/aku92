@extends('layouts.shop')

@section('title', 'Order Placed')

@section('content')

<section class="section shop-order-success">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="shop-cart-summary text-center">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-4x text-success"></i>
                    </div>
                    <h2 class="mb-2">Thank you, {{ $order->customer_name }}!</h2>
                    <p class="text-muted mb-4">Your order has been placed successfully. We'll contact you soon on <strong>{{ $order->customer_phone }}</strong>.</p>

                    <div class="shop-payment-option text-start mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-2"><strong>Order Number:</strong><br>{{ $order->order_number }}</div>
                            <div class="col-md-6 mb-2"><strong>Status:</strong><br><span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></div>
                            <div class="col-md-6 mb-2"><strong>Payment:</strong><br>{{ strtoupper($order->payment_method) }}</div>
                            <div class="col-md-6 mb-2"><strong>Placed On:</strong><br>{{ $order->created_at->format('d M Y, h:i A') }}</div>
                        </div>
                    </div>

                    <h5 class="text-start mb-3">Items</h5>
                    <div class="text-start mb-4">
                        @foreach($order->items as $item)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <strong>{{ $item->product_name }}</strong>
                                    <span class="text-muted small d-block">Qty: {{ $item->quantity }} &times; &#8377;{{ number_format($item->price) }}</span>
                                </div>
                                <strong>&#8377;{{ number_format($item->total) }}</strong>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-start">
                        <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span>&#8377;{{ number_format($order->subtotal) }}</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Shipping</span><span>{{ $order->shipping > 0 ? '&#8377;' . number_format($order->shipping) : 'Free' }}</span></div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3"><strong>Total</strong><strong class="text-success fs-5">&#8377;{{ number_format($order->total) }}</strong></div>
                    </div>

                    <h5 class="text-start mb-2 mt-4">Shipping To</h5>
                    <p class="text-start text-muted mb-4">
                        {{ $order->shipping_address }}<br>
                        {{ $order->city }}, {{ $order->state }} &mdash; {{ $order->pincode }}<br>
                        <i class="fas fa-envelope"></i> {{ $order->customer_email }}
                    </p>

                    <a href="{{ url('/shop') }}" class="btn btn-dark btn-lg">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

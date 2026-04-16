@extends('layouts.shop')

@section('title', 'Order ' . $order->order_number)

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">@include('account._sidebar')</div>
            <div class="col-lg-9">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

                <div class="shop-cart-summary mb-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <h3 class="mb-1">Order {{ $order->order_number }}</h3>
                            <p class="text-muted mb-0 small">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        @php
                            $badges = [
                                'pending' => 'warning', 'confirmed' => 'info', 'shipped' => 'primary',
                                'delivered' => 'success', 'cancelled' => 'danger', 'return_requested' => 'warning', 'returned' => 'dark',
                            ];
                            $c = $badges[$order->status] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $c }} text-capitalize fs-6">{{ str_replace('_', ' ', $order->status) }}</span>
                    </div>
                </div>

                <div class="shop-cart-summary mb-4">
                    <h5 class="mb-3">Items</h5>
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                <strong>{{ $item->product_name }}</strong>
                                <span class="text-muted small d-block">Qty: {{ $item->quantity }} &times; &#8377;{{ number_format($item->price) }}</span>
                            </div>
                            <strong>&#8377;{{ number_format($item->total) }}</strong>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between mt-3 mb-2"><span>Subtotal</span><span>&#8377;{{ number_format($order->subtotal) }}</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Shipping</span><span>{{ $order->shipping > 0 ? '₹' . number_format($order->shipping) : 'Free' }}</span></div>
                    <hr>
                    <div class="d-flex justify-content-between"><strong>Total</strong><strong class="text-success fs-5">&#8377;{{ number_format($order->total) }}</strong></div>
                </div>

                <div class="shop-cart-summary mb-4">
                    <h5 class="mb-3">Shipping To</h5>
                    <p class="text-muted mb-1"><strong>{{ $order->customer_name }}</strong></p>
                    <p class="text-muted mb-1">{{ $order->shipping_address }}</p>
                    <p class="text-muted mb-1">{{ $order->city }}, {{ $order->state }} &mdash; {{ $order->pincode }}</p>
                    <p class="text-muted mb-0"><i class="fas fa-phone"></i> {{ $order->customer_phone }} &bull; <i class="fas fa-envelope"></i> {{ $order->customer_email }}</p>
                </div>

                @if($order->status === 'cancelled' && $order->cancel_reason)
                    <div class="alert alert-secondary"><strong>Cancellation reason:</strong> {{ $order->cancel_reason }}</div>
                @endif
                @if(in_array($order->status, ['return_requested', 'returned'], true) && $order->return_reason)
                    <div class="alert alert-secondary"><strong>Return reason:</strong> {{ $order->return_reason }}</div>
                @endif

                @if($order->isCancellable())
                    <div class="shop-cart-summary">
                        <h5 class="mb-3 text-danger">Cancel this order</h5>
                        <form method="POST" action="{{ route('account.order.cancel', $order->order_number) }}" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                            @csrf
                            <textarea name="cancel_reason" class="form-control mb-3" rows="2" placeholder="Reason (optional)"></textarea>
                            <button class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancel Order</button>
                        </form>
                    </div>
                @elseif($order->isReturnable())
                    <div class="shop-cart-summary">
                        <h5 class="mb-3">Request a return</h5>
                        <form method="POST" action="{{ route('account.order.return', $order->order_number) }}">
                            @csrf
                            <textarea name="return_reason" class="form-control mb-3" rows="3" placeholder="Reason for return *" required></textarea>
                            <button class="btn btn-outline-warning"><i class="fas fa-undo"></i> Request Return</button>
                        </form>
                    </div>
                @elseif($order->status === 'shipped')
                    <div class="alert alert-info mb-0">Your order has shipped. It can no longer be cancelled online — please contact support if needed.</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

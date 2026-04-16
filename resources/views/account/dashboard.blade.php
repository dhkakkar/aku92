@extends('layouts.shop')

@section('title', 'My Account')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">@include('account._sidebar')</div>
            <div class="col-lg-9">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

                <div class="shop-cart-summary mb-4">
                    <h3>Welcome, {{ $user->name }}</h3>
                    <p class="text-muted mb-0">Here's a snapshot of your recent activity.</p>
                </div>

                <div class="shop-cart-summary">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Recent Orders</h5>
                        <a href="{{ route('account.orders') }}" class="small">View all &rarr;</a>
                    </div>
                    @if($orders->isEmpty())
                        <p class="text-muted mb-0">You haven't placed any orders yet. <a href="{{ url('/shop') }}">Browse products</a>.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead><tr><th>Order #</th><th>Placed</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr></thead>
                                <tbody>
                                @foreach($orders as $o)
                                    <tr>
                                        <td><strong>{{ $o->order_number }}</strong></td>
                                        <td class="small">{{ $o->created_at->format('d M Y') }}</td>
                                        <td>{{ $o->items()->count() }}</td>
                                        <td>&#8377;{{ number_format($o->total) }}</td>
                                        <td><span class="badge bg-secondary text-capitalize">{{ str_replace('_', ' ', $o->status) }}</span></td>
                                        <td><a href="{{ route('account.order.detail', $o->order_number) }}" class="btn btn-sm btn-outline-dark">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@php
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp
<aside class="shop-cart-summary mb-4">
    <h5 class="mb-3">My Account</h5>
    <p class="small text-muted mb-3">Hi, <strong>{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong></p>

    <ul class="list-unstyled mb-0">
        <li class="mb-2"><a href="{{ route('account.dashboard') }}" class="{{ $currentRoute === 'account.dashboard' ? 'fw-bold' : 'text-muted' }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
        <li class="mb-2"><a href="{{ route('account.orders') }}" class="{{ str_starts_with($currentRoute, 'account.order') ? 'fw-bold' : 'text-muted' }}"><i class="fas fa-shopping-bag me-2"></i> My Orders</a></li>
        <li class="mb-2"><a href="{{ route('account.profile') }}" class="{{ $currentRoute === 'account.profile' ? 'fw-bold' : 'text-muted' }}"><i class="fas fa-user me-2"></i> Profile &amp; Password</a></li>
        <li class="mt-3 pt-3 border-top">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-dark btn-sm w-100" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </li>
    </ul>
</aside>

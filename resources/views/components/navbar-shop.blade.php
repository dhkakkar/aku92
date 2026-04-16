<nav class="navbar navbar-expand-lg navbar-dark shop-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}" height="38" style="border-radius: 50%; background: #fff; padding: 3px;">
            <span style="font-family: var(--serif); color: var(--gold); font-size: 1rem; margin-left: 8px;">AKU 92</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#shopNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="shopNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="{{ url('/shop') }}"><i class="fas fa-store me-1"></i> Shop</a></li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-user-circle me-1"></i> {{ \Illuminate\Support\Str::limit(auth()->user()->name, 14) }}</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('account.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.orders') }}"><i class="fas fa-shopping-bag me-2"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.profile') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ url('/admin') }}"><i class="fas fa-shield-alt me-2"></i> Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Register</a></li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link cart-icon" href="{{ url('/shop/cart') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cartCount">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

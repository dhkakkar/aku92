<nav class="navbar navbar-expand-lg navbar-dark shop-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('site.name') }}" height="38" style="border-radius: 50%; background: #fff; padding: 3px;">
            <span style="font-family: var(--serif); color: var(--gold); font-size: 1rem; margin-left: 8px;">AKU 92</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#shopNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="shopNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="{{ url('/shop') }}"><i class="fas fa-store me-1"></i> Shop</a></li>
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

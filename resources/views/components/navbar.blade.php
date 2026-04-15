<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="top-bar-contact">
            <span><i class="fas fa-phone-alt"></i> {{ ($site->get('phone_display', '+91 94169 87250')) }}</span>
            <span class="ms-3"><i class="fas fa-envelope"></i> {{ ($site->get('email', 'aku92delhi@gmail.com')) }}</span>
        </div>
        <div class="top-bar-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}" class="logo">
            <span>AKU 92</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                @foreach(config('site.nav') as $item)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is(ltrim($item['url'], '/') ?: '/') ? 'active' : '' }}" href="{{ url($item['url']) }}">
                        {{ $item['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

@php
$aku92Nav = [
    ['title' => 'AKU92 Home', 'url' => '/aku92', 'icon' => 'fas fa-home'],
    ['title' => 'Clinics', 'url' => '/aku92/clinics', 'icon' => 'fas fa-clinic-medical'],
    ['title' => 'Jain Medicines', 'url' => '/aku92/jain-medicines', 'icon' => 'fas fa-pills'],
    ['title' => 'Physiotherapy', 'url' => '/aku92/physiotherapy', 'icon' => 'fas fa-hand-holding-medical'],
    ['title' => 'Aku Review', 'url' => '/aku92/review', 'icon' => 'fas fa-book-medical'],
    ['title' => 'OPD Form', 'url' => '/aku92/opd-form', 'icon' => 'fas fa-file-medical'],
];
@endphp

<nav class="navbar navbar-expand-lg navbar-dark aku92-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('site.name') }}" height="38" style="border-radius: 50%; background: #fff; padding: 3px;">
            <span style="font-family: var(--serif); color: var(--gold); font-size: 1rem; margin-left: 8px;">AKU 92</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#aku92Nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="aku92Nav">
            <ul class="navbar-nav ms-auto">
                @foreach($aku92Nav as $item)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is(ltrim($item['url'], '/')) ? 'active' : '' }}" href="{{ url($item['url']) }}">
                        <i class="{{ $item['icon'] }} me-1"></i> {{ $item['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

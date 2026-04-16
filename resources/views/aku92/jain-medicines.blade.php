@extends('layouts.aku92')

@section('title', \App\Models\Section::getContent('jain.hero_title', 'Jain Medicines'))

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/jain-medicines.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>{!! \App\Models\Section::getContent('jain.hero_title', 'Jain Medicines') !!}</h1>
            <p>{!! \App\Models\Section::getContent('jain.hero_sub', 'Quality medicines at affordable prices since 1987') !!}</p>
        </div>
    </div>
</section>

<!-- About -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/firms/jain-medicines.jpg') }}" alt="Jain Medicines" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 mb-4">
                <h2>{!! \App\Models\Section::getContent('jain.about_title', 'About Jain Medicines') !!}</h2>
                <div class="aku92-divider"></div>
                <div>{!! \App\Models\Section::getContent('jain.about_content', '') !!}</div>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => \App\Models\Section::getContent('jain.services_title', 'Our Services')])
        <div class="row">
            @foreach(\App\Models\Section::meta('jain.services_list', 'items', []) as $svc)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="aku92-service-card">
                        <i class="{{ $svc['icon'] ?? 'fas fa-prescription' }} fa-2x mb-3"></i>
                        <h5>{{ $svc['title'] ?? '' }}</h5>
                        <p>{{ $svc['description'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3>{!! \App\Models\Section::getContent('jain.contact_title', 'Visit Us') !!}</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> {!! \App\Models\Section::getContent('jain.contact_address', '') !!}</p>
                @php $phone = \App\Models\Section::getContent('jain.contact_phone', ''); @endphp
                @if($phone)
                    <p><i class="fas fa-phone-alt text-primary"></i> <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></p>
                @endif
                <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-shopping-cart"></i> Order Medicines Online
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

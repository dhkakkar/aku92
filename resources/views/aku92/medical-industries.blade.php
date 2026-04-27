@extends('layouts.aku92')

@section('title', \App\Models\Section::getContent('industries.hero_title', 'Aku92 Medical Industries'))

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/aku-review.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>{!! \App\Models\Section::getContent('industries.hero_title', 'Aku92 Medical Industries') !!}</h1>
            <p>{!! \App\Models\Section::getContent('industries.hero_sub', 'Manufacturers of medical publications & supplies') !!}</p>
        </div>
    </div>
</section>

<!-- About -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/firms/aku-review.jpg') }}" alt="Aku92 Medical Industries" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 mb-4">
                <h2>{!! \App\Models\Section::getContent('industries.about_title', 'About Aku92 Medical Industries') !!}</h2>
                <div class="aku92-divider"></div>
                <div>{!! \App\Models\Section::getContent('industries.about_content', '') !!}</div>
            </div>
        </div>
    </div>
</section>

<!-- Manufacturing -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => \App\Models\Section::getContent('industries.products_title', 'What We Manufacture')])
        <div class="row">
            @foreach(\App\Models\Section::meta('industries.products_list', 'items', []) as $p)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="aku92-service-card">
                        <i class="{{ $p['icon'] ?? 'fas fa-industry' }} fa-2x mb-3"></i>
                        <h5>{{ $p['title'] ?? '' }}</h5>
                        <p>{{ $p['description'] ?? '' }}</p>
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
                <h3>{!! \App\Models\Section::getContent('industries.contact_title', 'Contact Us') !!}</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> {!! \App\Models\Section::getContent('industries.contact_address', '') !!}</p>
                @php $phone = \App\Models\Section::getContent('industries.contact_phone', ''); @endphp
                @if($phone)
                    <p><i class="fas fa-phone-alt text-primary"></i> {{ $phone }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

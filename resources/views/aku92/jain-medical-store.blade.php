@extends('layouts.aku92')

@section('title', \App\Models\Section::getContent('jms.hero_title', 'Jain Medical Store — Products'))

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/jain-medical-store.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>{!! \App\Models\Section::getContent('jms.hero_title', 'Jain Medical Store — Products') !!}</h1>
            <p>{!! \App\Models\Section::getContent('jms.hero_sub', 'Our complete range of medical products') !!}</p>
        </div>
    </div>
</section>

<!-- Products image -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                @php $img = \App\Models\Section::getContent('jms.products_image', 'images/firms/products.jpeg'); @endphp
                <a href="{{ asset($img) }}" target="_blank" rel="noopener">
                    <img src="{{ asset($img) }}" alt="Jain Medical Store — Products" class="img-fluid rounded shadow">
                </a>
                <p class="text-muted small mt-3">Click the image to view full size.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact -->
<section class="section section-alt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3>{!! \App\Models\Section::getContent('jms.contact_title', 'Visit Us') !!}</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> {!! \App\Models\Section::getContent('jms.contact_address', 'D.A.V. Market, Holkar Chowk, Yamunanagar') !!}</p>
                @php $phone = \App\Models\Section::getContent('jms.contact_phone', ''); @endphp
                @if($phone)
                    <p><i class="fas fa-phone-alt text-primary"></i> {{ $phone }}</p>
                @endif
                <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-shopping-cart"></i> Order Online
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

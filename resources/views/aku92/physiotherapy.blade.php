@extends('layouts.aku92')

@section('title', \App\Models\Section::getContent('physio.hero_title', 'Aku Physiotherapy'))

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/aku-physiotherapy.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>{!! \App\Models\Section::getContent('physio.hero_title', 'Aku Physiotherapy') !!}</h1>
            <p>{!! \App\Models\Section::getContent('physio.hero_sub', 'Expert physiotherapy for pain relief & rehabilitation') !!}</p>
        </div>
    </div>
</section>

<!-- About -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/firms/aku-physiotherapy.jpg') }}" alt="Aku Physiotherapy" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 mb-4">
                <h2>{!! \App\Models\Section::getContent('physio.about_title', 'About Aku Physiotherapy') !!}</h2>
                <div class="aku92-divider"></div>
                <div>{!! \App\Models\Section::getContent('physio.about_content', '') !!}</div>
            </div>
        </div>
    </div>
</section>

<!-- Treatments -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => \App\Models\Section::getContent('physio.treatments_title', 'Our Treatments')])
        <div class="row">
            @foreach(\App\Models\Section::meta('physio.treatments_list', 'items', []) as $t)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="aku92-service-card">
                        <i class="{{ $t['icon'] ?? 'fas fa-bone' }} fa-2x mb-3"></i>
                        <h5>{{ $t['title'] ?? '' }}</h5>
                        <p>{{ $t['description'] ?? '' }}</p>
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
                <h3>{!! \App\Models\Section::getContent('physio.contact_title', 'Book a Session') !!}</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> {!! \App\Models\Section::getContent('physio.contact_address', '') !!}</p>
                @php $phone = \App\Models\Section::getContent('physio.contact_phone', ''); @endphp
                @if($phone)
                    <p><i class="fas fa-phone-alt text-primary"></i> <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></p>
                @endif
                <a href="{{ url('/healthcare/opd-form') }}" class="btn btn-success btn-lg mt-3">
                    <i class="fas fa-calendar-check"></i> Book Appointment
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

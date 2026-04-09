@extends('layouts.aku92')

@section('title', 'Aku Physiotherapy')

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/aku-physiotherapy.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>Aku Physiotherapy</h1>
            <p>Expert physiotherapy for pain relief & rehabilitation</p>
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
                <h2>About Aku Physiotherapy</h2>
                <div class="aku92-divider"></div>
                <p>Located at 62, Shivaji Park Chowk, Yamunanagar, Aku Physiotherapy provides expert rehabilitation and pain management services. Our team of qualified physiotherapists uses modern equipment and evidence-based techniques to help patients recover faster and live pain-free.</p>
                <p>Whether you're recovering from surgery, managing chronic pain, or rehabilitating from a sports injury, we create personalized treatment plans tailored to your needs.</p>
            </div>
        </div>
    </div>
</section>

<!-- Treatments -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Treatments'])
        <div class="row">
            @php
            $treatments = [
                ['icon' => 'fas fa-bone', 'title' => 'Joint Pain Relief', 'desc' => 'Treatment for knee, shoulder, back, and neck pain using advanced techniques.'],
                ['icon' => 'fas fa-walking', 'title' => 'Post-Surgery Rehab', 'desc' => 'Rehabilitation programs after orthopedic and neurological surgeries.'],
                ['icon' => 'fas fa-running', 'title' => 'Sports Injury', 'desc' => 'Specialized treatment for sports-related injuries and performance recovery.'],
                ['icon' => 'fas fa-wheelchair', 'title' => 'Neuro Rehab', 'desc' => 'Physiotherapy for stroke, paralysis, and neurological conditions.'],
                ['icon' => 'fas fa-spa', 'title' => 'Pain Management', 'desc' => 'Electrotherapy, ultrasound, and manual therapy for chronic pain conditions.'],
                ['icon' => 'fas fa-child', 'title' => 'Pediatric Physio', 'desc' => 'Physiotherapy for children with developmental and movement disorders.'],
            ];
            @endphp
            @foreach($treatments as $t)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="{{ $t['icon'] }} fa-2x mb-3"></i>
                    <h5>{{ $t['title'] }}</h5>
                    <p>{{ $t['desc'] }}</p>
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
                <h3>Book a Session</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> 62, Shivaji Park Chowk, Yamunanagar</p>
                <p><i class="fas fa-phone-alt text-primary"></i> <a href="tel:0173220062">0173 220062</a></p>
                <a href="{{ url('/healthcare/opd-form') }}" class="btn btn-success btn-lg mt-3">
                    <i class="fas fa-calendar-check"></i> Book Appointment
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

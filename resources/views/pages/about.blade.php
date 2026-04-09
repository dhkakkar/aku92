@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<!-- About Section -->
<section class="section about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="about-image">
                    <img src="{{ asset('images/about/about-main.jpg') }}" alt="About AKU 92" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="about-content">
                    <h2>About <span class="text-primary">AKU 92</span></h2>
                    <div class="about-divider"></div>
                    <p class="lead">Established on February 15, 1987</p>
                    <p>AKU 92 was founded with the objective to offer medications at reasonable costs while maintaining the highest quality standards. After over 36 years of operation, the brand AKU 92 now serves customers across India with excellence in medical care and produces medical devices internationally.</p>
                    <p>We are a group of companies dedicated to excellence in medical care, focused on improving quality of life through pharmacy services, journalism, and medical specialization nationwide and globally.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section stats-section section-alt">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h3 class="stat-number">36+</h3>
                    <p>Years of Service</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="stat-number">10 Lac+</h3>
                    <p>Happy Customers</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-building fa-3x mb-3"></i>
                    <h3 class="stat-number">6</h3>
                    <p>Operational Firms</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-clock fa-3x mb-3"></i>
                    <h3 class="stat-number">24/7</h3>
                    <p>Healthcare Support</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="section mission-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="mission-card">
                    <div class="mission-icon"><i class="fas fa-bullseye"></i></div>
                    <h4>Our Mission</h4>
                    <p>To provide quality healthcare and affordable medicines to every individual, ensuring better health and well-being for all.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="mission-card">
                    <div class="mission-icon"><i class="fas fa-eye"></i></div>
                    <h4>Our Vision</h4>
                    <p>To be the most trusted healthcare brand in India, delivering world-class medical services and products.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="mission-card">
                    <div class="mission-icon"><i class="fas fa-heart"></i></div>
                    <h4>Our Values</h4>
                    <p>Quality, integrity, affordability, and customer satisfaction are the pillars of everything we do.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section testimonials-section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'What Our Customers Say'])
        <div class="swiper testimonialSwiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    @include("components.testimonial-card", ["testimonial" => $testimonial])
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endsection

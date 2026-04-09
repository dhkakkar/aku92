@extends('layouts.aku92')

@section('title', 'Aku Review')

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/aku-review.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>Aku Review</h1>
            <p>Medical publications & educational resources</p>
        </div>
    </div>
</section>

<!-- About -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/firms/aku-review.jpg') }}" alt="Aku Review" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 mb-4">
                <h2>About Aku Review</h2>
                <div class="aku92-divider"></div>
                <p>Aku Review is the publishing arm of AKU 92, dedicated to creating high-quality medical review materials and educational publications for healthcare professionals and students.</p>
                <p>Our publications include MCQ books for competitive medical exams, clinical review journals, and educational material covering a wide range of medical specializations. Based at 196, Shastri Colony, Yamunanagar, we continue to contribute to medical education across India.</p>
            </div>
        </div>
    </div>
</section>

<!-- Publications -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Publications'])
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-pub-card">
                    <img src="{{ asset('images/products/mcq-cardiology.jpg') }}" alt="MCQs in Cardiology" class="img-fluid">
                    <div class="aku92-pub-body">
                        <h5>MCQ's in Cardiology</h5>
                        <p>Comprehensive multiple-choice questions covering cardiology for competitive exam preparation.</p>
                        <span class="aku92-pub-price">&#8377;796 <del>&#8377;995</del></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-pub-card">
                    <img src="{{ asset('images/products/aku-review.jpg') }}" alt="Aku Review Journal" class="img-fluid">
                    <div class="aku92-pub-body">
                        <h5>Aku Review Journal</h5>
                        <p>Medical review journal with clinical insights and case studies for healthcare professionals.</p>
                        <span class="aku92-pub-price">&#8377;450 <del>&#8377;500</del></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3>Contact Us</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> 196, Shastri Colony, Yamunanagar</p>
                <p><i class="fas fa-phone-alt text-primary"></i> <a href="tel:0173230196">0173 230196</a></p>
            </div>
        </div>
    </div>
</section>
@endsection

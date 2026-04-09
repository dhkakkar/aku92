@extends('layouts.aku92')

@section('title', 'Jain Medicines')

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/jain-medicines.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>Jain Medicines</h1>
            <p>Quality medicines at affordable prices since 1987</p>
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
                <h2>About Jain Medicines</h2>
                <div class="aku92-divider"></div>
                <p>Established in 1987, Jain Medicines has been the cornerstone of the AKU 92 healthcare group. For over 36 years, we have been providing quality medicines at affordable prices to the people of Yamunanagar and surrounding areas.</p>
                <p>Located inside Santosh Hospital at Gobindpuri, we offer a wide range of prescription medicines, OTC drugs, surgical supplies, and healthcare products. Our trained pharmacists ensure accurate dispensing and helpful guidance for every customer.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Services'])
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="fas fa-prescription fa-2x mb-3"></i>
                    <h5>Prescription Filling</h5>
                    <p>Accurate and timely prescription dispensing by trained pharmacists.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="fas fa-tablets fa-2x mb-3"></i>
                    <h5>OTC Medicines</h5>
                    <p>Wide range of over-the-counter medicines for common ailments.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="fas fa-syringe fa-2x mb-3"></i>
                    <h5>Surgical Supplies</h5>
                    <p>Medical equipment, surgical items, and healthcare accessories.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="fas fa-truck fa-2x mb-3"></i>
                    <h5>Home Delivery</h5>
                    <p>Medicine delivery to your doorstep within Yamunanagar.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="fas fa-user-nurse fa-2x mb-3"></i>
                    <h5>Expert Guidance</h5>
                    <p>Professional pharmacist advice on medication and dosage.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-service-card">
                    <i class="fas fa-tags fa-2x mb-3"></i>
                    <h5>Affordable Pricing</h5>
                    <p>Competitive prices and discounts on a wide range of medicines.</p>
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
                <h3>Visit Us</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> Inside Santosh Hospital, Gobindpuri, Kanhaya Chowk, Yamunanagar</p>
                <p><i class="fas fa-phone-alt text-primary"></i> <a href="tel:01732269016">0173 2269016</a></p>
                <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-shopping-cart"></i> Order Medicines Online
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

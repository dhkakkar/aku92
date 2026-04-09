@extends('layouts.aku92')

@section('title', 'Aku92 Clinics')

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/aku92-clinics.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>Aku92 Clinics</h1>
            <p>Multi-specialty outpatient care inside Santosh Hospital</p>
        </div>
    </div>
</section>

<!-- About -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/firms/aku92-clinics.jpg') }}" alt="Aku92 Clinics" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 mb-4">
                <h2>About Our Clinics</h2>
                <div class="aku92-divider"></div>
                <p>Aku92 Clinics, located inside Santosh Hospital at Gobindpuri, Kanhaya Chowk, Yamunanagar, provides multi-specialty outpatient services. Our experienced doctors and modern facilities ensure that every patient receives the best possible care.</p>
                <p>We specialize in general medicine, cardiology consultations, physiotherapy referrals, and preventive health checkups. With over 36 years of healthcare experience behind us, patients trust Aku92 for reliable and affordable treatment.</p>
            </div>
        </div>
    </div>
</section>

<!-- Doctors -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Doctors', 'subtitle' => 'Experienced medical professionals at your service'])
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-doctor-card">
                    <div class="aku92-doctor-photo">
                        <i class="fas fa-user-md fa-4x"></i>
                    </div>
                    <h5>Dr. Akash Jain</h5>
                    <p class="text-muted">General Medicine</p>
                    <p class="small">Founder of AKU 92 with 36+ years of experience in medical practice.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="aku92-doctor-card">
                    <div class="aku92-doctor-photo">
                        <i class="fas fa-user-md fa-4x"></i>
                    </div>
                    <h5>Consulting Specialists</h5>
                    <p class="text-muted">Various Specializations</p>
                    <p class="small">Visiting specialists for cardiology, orthopedics, and more.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OPD Timings -->
<section class="section">
    <div class="container">
        @include('components.section-header', ['title' => 'OPD Timings'])
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="aku92-timings-table">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr><th>Day</th><th>Morning</th><th>Evening</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Monday – Saturday</td><td>9:00 AM – 1:00 PM</td><td>5:00 PM – 8:00 PM</td></tr>
                            <tr><td>Sunday</td><td>10:00 AM – 12:00 PM</td><td>Closed</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Location'])
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="aku92-location-info">
                    <p><i class="fas fa-map-marker-alt text-danger"></i> <strong>Address:</strong> Inside Santosh Hospital, Gobindpuri, Kanhaya Chowk, Yamunanagar, 135001, Haryana</p>
                    <p><i class="fas fa-phone-alt text-primary"></i> <strong>Phone:</strong> <a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a></p>
                </div>
                <a href="{{ url('/aku92/opd-form') }}" class="btn btn-success btn-lg mt-3">
                    <i class="fas fa-calendar-check"></i> Book Appointment (OPD Form)
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="aku92-map-placeholder">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3444.5!2d77.28!3d30.13!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDA3JzQ4LjAiTiA3N8KwMTYnNDguMCJF!5e0!3m2!1sen!2sin!4v1" width="100%" height="300" style="border:0; border-radius: 10px;" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

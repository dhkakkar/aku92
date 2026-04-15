@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

<!-- Contact Info -->
<section class="section contact-section">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-7 mb-4">
                <div class="contact-form-wrapper">
                    <h3>Drop Us A Line</h3>
                    <p class="text-muted mb-4">Keep in touch with us.</p>
                    <form id="contactForm" action="{{ url('/api/contact.php') }}" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Details -->
            <div class="col-lg-5 mb-4">
                <div class="contact-info-wrapper">
                    <h3>Contact Information</h3>
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h6>Address</h6>
                            <p>{{ ($site->get('address', 'Yamunanagar, Haryana')) }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h6>Phone</h6>
                            <p><a href="tel:{{ ($site->get('phone', '+919416987250')) }}">{{ ($site->get('phone_display', '+91 94169 87250')) }}</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h6>Email</h6>
                            <p><a href="mailto:{{ ($site->get('email', 'aku92delhi@gmail.com')) }}">{{ ($site->get('email', 'aku92delhi@gmail.com')) }}</a></p>
                        </div>
                    </div>

                    <div class="social-links mt-4">
                        <h6>Follow Us</h6>
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Firms Contact -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Firms', 'subtitle' => 'Contact details for all our branches'])
        <div class="row">
            @foreach($firms as $firm)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="firm-contact-card">
                    <h5>{{ $firm->name }}</h5>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $firm->address }}</p>
                    @if(!empty($firm->phone))
                    <p><i class="fas fa-phone-alt"></i> {{ $firm->phone }}</p>
                    @endif
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

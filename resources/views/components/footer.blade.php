<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('site.name') }}" class="footer-logo mb-3">
                    <p>Established in 1987, AKU 92 is dedicated to excellence in medical care, providing quality medicines and healthcare services across India.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/product') }}">Product</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-title">Policies</h5>
                <ul class="footer-links">
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Return & Refund Policy</a></li>
                    <li><a href="#">Shipping & Delivery</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="footer-title">Contact Us</h5>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i> {{ config('site.address') }}</li>
                    <li><i class="fas fa-phone-alt"></i> <a href="tel:{{ config('site.phone') }}">{{ config('site.phone_display') }}</a></li>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                </ul>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center">
            <p class="mb-0">&copy; {{ date('Y') }} {{ config('site.name') }}. All Rights Reserved.</p>
            <p class="mb-0">Designed by <a href="https://syscodetechnology.com" target="_blank">Syscode Technology Pvt. Ltd.</a></p>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>

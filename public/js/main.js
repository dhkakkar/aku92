/**
 * AKU 92 - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // Hero Slider (Swiper)
    // ==========================================
    if (document.querySelector('.heroSwiper')) {
        new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.heroSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.heroSwiper .swiper-button-next',
                prevEl: '.heroSwiper .swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
        });
    }

    // ==========================================
    // Testimonial Slider
    // ==========================================
    if (document.querySelector('.testimonialSwiper')) {
        new Swiper('.testimonialSwiper', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.testimonialSwiper .swiper-pagination',
                clickable: true,
            },
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }

    // ==========================================
    // Back to Top Button
    // ==========================================
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ==========================================
    // Gallery Modal
    // ==========================================
    document.querySelectorAll('.gallery-item').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            var imgSrc = this.getAttribute('data-img');
            var modalImg = document.getElementById('galleryModalImg');
            if (modalImg) {
                modalImg.src = imgSrc;
            }
        });
    });

    // ==========================================
    // Add to Cart
    // ==========================================
    document.querySelectorAll('.btn-add-cart').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var productId = this.getAttribute('data-id');
            var cartCount = document.querySelector('.cart-count');
            // Placeholder: In Laravel, this will be an AJAX call to the cart controller
            if (cartCount) {
                var count = parseInt(cartCount.textContent) || 0;
                cartCount.textContent = count + 1;
            }
            // Visual feedback
            this.innerHTML = '<i class="fas fa-check"></i> Added!';
            this.classList.remove('btn-primary');
            this.classList.add('btn-success');
            var self = this;
            setTimeout(function () {
                self.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
                self.classList.remove('btn-success');
                self.classList.add('btn-primary');
            }, 1500);
        });
    });

    // ==========================================
    // Contact Form (AJAX)
    // ==========================================
    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var btn = this.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                btn.disabled = false;
                btn.innerHTML = 'Send Message';
                if (data.success) {
                    alert('Message sent successfully!');
                    contactForm.reset();
                } else {
                    alert(data.message || 'Something went wrong. Please try again.');
                }
            })
            .catch(function () {
                btn.disabled = false;
                btn.innerHTML = 'Send Message';
                alert('Something went wrong. Please try again.');
            });
        });
    }

    // ==========================================
    // OPD Form (AJAX)
    // ==========================================
    var opdForm = document.getElementById('opdForm');
    if (opdForm) {
        opdForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var btn = this.querySelector('button[type="submit"]');
            var alertDiv = document.getElementById('opdFormAlert');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit';
                if (alertDiv) {
                    alertDiv.classList.remove('d-none', 'alert-danger', 'alert-success');
                    alertDiv.classList.add(data.success ? 'alert-success' : 'alert-danger');
                    alertDiv.textContent = data.message || (data.success ? 'Form submitted successfully!' : 'Something went wrong.');
                }
                if (data.success) {
                    opdForm.reset();
                }
            })
            .catch(function () {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit';
                if (alertDiv) {
                    alertDiv.classList.remove('d-none', 'alert-success');
                    alertDiv.classList.add('alert-danger');
                    alertDiv.textContent = 'Something went wrong. Please try again.';
                }
            });
        });
    }

    // ==========================================
    // Navbar scroll effect
    // ==========================================
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('.navbar');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    });
});

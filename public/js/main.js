/**
 * AKU 92 - Main JavaScript
 */

// ==========================================
// Cart (localStorage)
// ==========================================
var Cart = {
    key: 'aku92_cart',

    getItems: function () {
        try { return JSON.parse(localStorage.getItem(this.key)) || []; }
        catch (e) { return []; }
    },

    save: function (items) {
        localStorage.setItem(this.key, JSON.stringify(items));
        this.updateCount();
    },

    add: function (product) {
        var items = this.getItems();
        var existing = items.find(function (i) { return i.id == product.id; });
        if (existing) {
            existing.qty += 1;
        } else {
            items.push({ id: product.id, name: product.name, price: Number(product.price), image: product.image, qty: 1 });
        }
        this.save(items);
    },

    remove: function (id) {
        var items = this.getItems().filter(function (i) { return i.id != id; });
        this.save(items);
    },

    updateQty: function (id, qty) {
        var items = this.getItems();
        var item = items.find(function (i) { return i.id == id; });
        if (item) {
            item.qty = Math.max(1, qty);
            this.save(items);
        }
    },

    getCount: function () {
        return this.getItems().reduce(function (sum, i) { return sum + i.qty; }, 0);
    },

    getTotal: function () {
        return this.getItems().reduce(function (sum, i) { return sum + (i.price * i.qty); }, 0);
    },

    clear: function () {
        localStorage.removeItem(this.key);
        this.updateCount();
    },

    updateCount: function () {
        document.querySelectorAll('.cart-count, #cartCount').forEach(function (el) {
            el.textContent = Cart.getCount();
        });
    }
};

document.addEventListener('DOMContentLoaded', function () {

    // Update cart count on page load
    Cart.updateCount();

    // ==========================================
    // Swiper: Hero
    // ==========================================
    if (document.querySelector('.heroSwiper')) {
        new Swiper('.heroSwiper', {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.heroSwiper .swiper-pagination', clickable: true },
            navigation: { nextEl: '.heroSwiper .swiper-button-next', prevEl: '.heroSwiper .swiper-button-prev' },
            effect: 'fade',
            fadeEffect: { crossFade: true },
        });
    }

    // ==========================================
    // Swiper: Testimonials
    // ==========================================
    if (document.querySelector('.testimonialSwiper')) {
        new Swiper('.testimonialSwiper', {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.testimonialSwiper .swiper-pagination', clickable: true },
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } },
        });
    }

    // ==========================================
    // Back to Top
    // ==========================================
    var backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            backToTop.classList.toggle('show', window.scrollY > 300);
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
            var modalImg = document.getElementById('galleryModalImg');
            if (modalImg) modalImg.src = this.getAttribute('data-img');
        });
    });

    // ==========================================
    // Add to Cart — all button types
    // ==========================================
    function handleAddToCart(btn) {
        var product = {
            id: btn.getAttribute('data-id'),
            name: btn.getAttribute('data-name') || btn.closest('.product-card, .shop-product-card')?.querySelector('.product-name, .shop-product-name')?.textContent?.trim() || 'Product',
            price: btn.getAttribute('data-price') || 0,
            image: btn.getAttribute('data-image') || ''
        };
        Cart.add(product);

        // Visual feedback
        var origHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
        btn.style.opacity = '0.7';
        setTimeout(function () {
            btn.innerHTML = origHTML;
            btn.style.opacity = '1';
        }, 1200);
    }

    // .btn-add-cart (general product cards)
    document.querySelectorAll('.btn-add-cart').forEach(function (btn) {
        btn.addEventListener('click', function () { handleAddToCart(this); });
    });

    // .btn-shop-cart (shop product cards)
    document.querySelectorAll('.btn-shop-cart').forEach(function (btn) {
        btn.addEventListener('click', function () { handleAddToCart(this); });
    });

    // .btn-shop-add (product detail page)
    document.querySelectorAll('.btn-shop-add').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var qtyInput = document.getElementById('qtyInput');
            var qty = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
            var product = {
                id: this.getAttribute('data-id'),
                name: this.getAttribute('data-name'),
                price: this.getAttribute('data-price'),
                image: this.getAttribute('data-image')
            };
            var items = Cart.getItems();
            var existing = items.find(function (i) { return i.id == product.id; });
            if (existing) {
                existing.qty += qty;
            } else {
                items.push({ id: product.id, name: product.name, price: Number(product.price), image: product.image, qty: qty });
            }
            Cart.save(items);
            var origHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Added to Cart!';
            var self = this;
            setTimeout(function () { self.innerHTML = origHTML; }, 1500);
        });
    });

    // ==========================================
    // Qty selectors (product detail + cart)
    // ==========================================
    document.getElementById('qtyPlus')?.addEventListener('click', function () {
        var input = document.getElementById('qtyInput');
        input.value = Math.min(99, parseInt(input.value) + 1);
    });
    document.getElementById('qtyMinus')?.addEventListener('click', function () {
        var input = document.getElementById('qtyInput');
        input.value = Math.max(1, parseInt(input.value) - 1);
    });

    // ==========================================
    // Cart Page — Dynamic rendering
    // ==========================================
    var cartContainer = document.getElementById('cartItems');
    var cartSummary = document.getElementById('cartSummary');
    var emptyCart = document.getElementById('emptyCart');

    if (cartContainer) {
        renderCart();
    }

    function renderCart() {
        var items = Cart.getItems();

        if (items.length === 0) {
            cartContainer.innerHTML = '';
            if (emptyCart) emptyCart.classList.remove('d-none');
            if (cartSummary) cartSummary.classList.add('d-none');
            return;
        }

        if (emptyCart) emptyCart.classList.add('d-none');
        if (cartSummary) cartSummary.classList.remove('d-none');

        var html = '';
        items.forEach(function (item) {
            html += '<div class="shop-cart-item" data-id="' + item.id + '">' +
                '<div class="shop-cart-img"><img src="' + item.image + '" alt="' + item.name + '"></div>' +
                '<div class="shop-cart-details"><h5>' + item.name + '</h5></div>' +
                '<div class="shop-cart-qty">' +
                    '<div class="qty-selector">' +
                        '<button class="qty-btn cart-qty-minus">-</button>' +
                        '<input type="number" class="qty-input cart-qty-input" value="' + item.qty + '" min="1">' +
                        '<button class="qty-btn cart-qty-plus">+</button>' +
                    '</div>' +
                '</div>' +
                '<div class="shop-cart-price"><span>&#8377;' + item.price.toLocaleString('en-IN') + '</span></div>' +
                '<div class="shop-cart-total"><strong>&#8377;' + (item.price * item.qty).toLocaleString('en-IN') + '</strong></div>' +
                '<button class="shop-cart-remove"><i class="fas fa-times"></i></button>' +
            '</div>';
        });
        cartContainer.innerHTML = html;

        // Update summary
        updateCartSummary(items);

        // Bind events
        cartContainer.querySelectorAll('.cart-qty-plus').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var row = this.closest('.shop-cart-item');
                var id = row.getAttribute('data-id');
                var input = row.querySelector('.cart-qty-input');
                var newQty = parseInt(input.value) + 1;
                input.value = newQty;
                Cart.updateQty(id, newQty);
                renderCart();
            });
        });

        cartContainer.querySelectorAll('.cart-qty-minus').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var row = this.closest('.shop-cart-item');
                var id = row.getAttribute('data-id');
                var input = row.querySelector('.cart-qty-input');
                var newQty = Math.max(1, parseInt(input.value) - 1);
                input.value = newQty;
                Cart.updateQty(id, newQty);
                renderCart();
            });
        });

        cartContainer.querySelectorAll('.cart-qty-input').forEach(function (input) {
            input.addEventListener('change', function () {
                var row = this.closest('.shop-cart-item');
                var id = row.getAttribute('data-id');
                Cart.updateQty(id, Math.max(1, parseInt(this.value) || 1));
                renderCart();
            });
        });

        cartContainer.querySelectorAll('.shop-cart-remove').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var row = this.closest('.shop-cart-item');
                var id = row.getAttribute('data-id');
                Cart.remove(id);
                renderCart();
            });
        });
    }

    function updateCartSummary(items) {
        var subtotal = items.reduce(function (sum, i) { return sum + (i.price * i.qty); }, 0);
        var totalQty = items.reduce(function (sum, i) { return sum + i.qty; }, 0);
        var shipping = subtotal >= 500 ? 0 : 40;
        var total = subtotal + shipping;

        var subtotalEl = document.getElementById('cartSubtotal');
        var shippingEl = document.getElementById('cartShipping');
        var totalEl = document.getElementById('cartTotal');
        var itemCountEl = document.getElementById('cartItemCount');

        if (subtotalEl) subtotalEl.textContent = '₹' + subtotal.toLocaleString('en-IN');
        if (shippingEl) shippingEl.textContent = shipping === 0 ? 'Free' : '₹' + shipping;
        if (totalEl) totalEl.textContent = '₹' + total.toLocaleString('en-IN');
        if (itemCountEl) itemCountEl.textContent = totalQty + ' item' + (totalQty !== 1 ? 's' : '');
    }

    // ==========================================
    // Checkout page — render cart items + submit
    // ==========================================
    var checkoutForm = document.getElementById('checkoutForm');
    var checkoutItemsEl = document.getElementById('checkoutItems');

    if (checkoutItemsEl) {
        renderCheckout();
    }

    function renderCheckout() {
        var items = Cart.getItems();
        var emptyEl = document.getElementById('checkoutEmpty');

        if (!items.length) {
            checkoutItemsEl.innerHTML = '';
            if (emptyEl) emptyEl.classList.remove('d-none');
            if (checkoutForm) checkoutForm.classList.add('d-none');
            return;
        }

        if (emptyEl) emptyEl.classList.add('d-none');
        if (checkoutForm) checkoutForm.classList.remove('d-none');

        var html = '';
        items.forEach(function (item) {
            html += '<div class="shop-checkout-item d-flex gap-3 mb-3">' +
                '<img src="' + item.image + '" width="55" height="55" class="rounded" style="object-fit: cover;" alt="">' +
                '<div class="flex-grow-1">' +
                    '<p class="mb-0 fw-semibold small">' + item.name + '</p>' +
                    '<p class="mb-0 text-muted small">Qty: ' + item.qty + '</p>' +
                '</div>' +
                '<strong>&#8377;' + (item.price * item.qty).toLocaleString('en-IN') + '</strong>' +
            '</div>';
        });
        checkoutItemsEl.innerHTML = html;

        var subtotal = items.reduce(function (sum, i) { return sum + (i.price * i.qty); }, 0);
        var totalQty = items.reduce(function (sum, i) { return sum + i.qty; }, 0);
        var shipping = subtotal >= 500 ? 0 : 40;
        var total = subtotal + shipping;

        var subEl = document.getElementById('checkoutSubtotal');
        var shipEl = document.getElementById('checkoutShipping');
        var totalEl = document.getElementById('checkoutTotal');
        var itemCountEl = document.getElementById('checkoutItemCount');
        if (subEl) subEl.textContent = '₹' + subtotal.toLocaleString('en-IN');
        if (shipEl) shipEl.textContent = shipping === 0 ? 'Free' : '₹' + shipping;
        if (totalEl) totalEl.textContent = '₹' + total.toLocaleString('en-IN');
        if (itemCountEl) itemCountEl.textContent = totalQty + ' item' + (totalQty !== 1 ? 's' : '');
    }

    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var items = Cart.getItems();
            if (!items.length) {
                alert('Your cart is empty.');
                return;
            }

            var alertDiv = document.getElementById('checkoutAlert');
            var btn = document.getElementById('placeOrderBtn');
            var origHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Placing order...';
            if (alertDiv) alertDiv.classList.add('d-none');

            var formData = new FormData(this);
            items.forEach(function (item, idx) {
                formData.append('items[' + idx + '][id]', item.id);
                formData.append('items[' + idx + '][name]', item.name);
                formData.append('items[' + idx + '][price]', item.price);
                formData.append('items[' + idx + '][qty]', item.qty);
            });

            var csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
            })
            .then(function (res) { return res.json().then(function (body) { return { status: res.status, body: body }; }); })
            .then(function (response) {
                if (response.body.success) {
                    Cart.clear();
                    window.location.href = response.body.redirect;
                    return;
                }
                btn.disabled = false;
                btn.innerHTML = origHtml;
                var msg = response.body.message || 'Something went wrong. Please check the form and try again.';
                if (response.body.errors) {
                    var errors = Object.values(response.body.errors).flat();
                    msg = errors.join(' ');
                }
                if (alertDiv) {
                    alertDiv.classList.remove('d-none', 'alert-success');
                    alertDiv.classList.add('alert-danger');
                    alertDiv.textContent = msg;
                } else {
                    alert(msg);
                }
            })
            .catch(function () {
                btn.disabled = false;
                btn.innerHTML = origHtml;
                if (alertDiv) {
                    alertDiv.classList.remove('d-none', 'alert-success');
                    alertDiv.classList.add('alert-danger');
                    alertDiv.textContent = 'Network error. Please try again.';
                } else {
                    alert('Network error. Please try again.');
                }
            });
        });
    }

    // ==========================================
    // Contact Form (AJAX with CSRF)
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
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                btn.disabled = false;
                btn.innerHTML = 'Send Message';
                if (data.success) {
                    alert('Message sent successfully!');
                    contactForm.reset();
                } else {
                    alert(data.message || 'Something went wrong.');
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
    // OPD Form (AJAX with CSRF)
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
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit';
                if (alertDiv) {
                    alertDiv.classList.remove('d-none', 'alert-danger', 'alert-success');
                    alertDiv.classList.add(data.success ? 'alert-success' : 'alert-danger');
                    alertDiv.textContent = data.message || (data.success ? 'Submitted!' : 'Error.');
                }
                if (data.success) opdForm.reset();
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
    // Navbar scroll
    // ==========================================
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('.navbar');
        if (navbar) {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        }
    });
});

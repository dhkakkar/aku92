@extends('layouts.shop')

@section('title', 'Product Detail')

@section('content')

// Get product by ID
$productId = (int)($_GET['id'] ?? 1);
$product = null;
foreach ($products as $p) {
    if ($p['id'] === $productId) { $product = $p; break; }
}
if (!$product) { $product = $products[0]; }
$discount = round((($product['original_price'] - $product['sale_price']) / $product['original_price']) * 100);

<!-- Breadcrumb -->
<div class="shop-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/shop') }}">Shop</a></li>
                <li class="breadcrumb-item active">{{ $product['name'] }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Product Detail -->
<section class="section shop-detail">
    <div class="container">
        <div class="row">
            <!-- Image -->
            <div class="col-lg-5 mb-4">
                <div class="shop-detail-img">
                    <span class="shop-badge">-{{ $discount }}%</span>
                    <img src="{{ $product['image']) ?>" alt="<?= sanitize($product['name'] }}" class="img-fluid" id="mainProductImg">
                </div>
            </div>

            <!-- Info -->
            <div class="col-lg-7 mb-4">
                <div class="shop-detail-info">
                    <h1 class="shop-detail-name">{{ $product['name'] }}</h1>

                    <div class="shop-detail-rating mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        <span class="text-muted ms-2">(4.5 stars &bull; 24 reviews)</span>
                    </div>

                    <div class="shop-detail-price mb-4">
                        <span class="shop-detail-sale">&#8377;{{ number_format($product['sale_price']) }}</span>
                        <span class="shop-detail-original">&#8377;{{ number_format($product['original_price']) }}</span>
                        <span class="shop-detail-discount">Save {{ $discount }}%</span>
                    </div>

                    <p class="shop-detail-desc mb-4">High-quality medical product from AKU 92. Trusted by healthcare professionals and patients alike. All our products are 100% genuine and sourced directly from manufacturers.</p>

                    <div class="shop-detail-qty mb-4">
                        <label class="form-label fw-semibold">Quantity</label>
                        <div class="qty-selector">
                            <button class="qty-btn" id="qtyMinus">-</button>
                            <input type="number" class="qty-input" id="qtyInput" value="1" min="1" max="99">
                            <button class="qty-btn" id="qtyPlus">+</button>
                        </div>
                    </div>

                    <div class="shop-detail-actions">
                        <button class="btn btn-lg btn-dark btn-shop-add" data-id="{{ $product['id'] ?>" data-name="{{ $product['name']) ?>" data-price="<?= $product['sale_price'] }}" data-image="<?= sanitize($product['image'] }}">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-lg btn-success btn-shop-buy" data-id="{{ $product['id'] }}">
                            <i class="fas fa-bolt"></i> Buy Now
                        </button>
                    </div>

                    <div class="shop-detail-features mt-4">
                        <div class="d-flex gap-4 flex-wrap">
                            <span><i class="fas fa-truck text-success"></i> Free delivery above &#8377;500</span>
                            <span><i class="fas fa-shield-alt text-primary"></i> Genuine product</span>
                            <span><i class="fas fa-undo text-warning"></i> 7-day returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs: Description / Reviews -->
        <div class="shop-detail-tabs mt-5">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#descTab">Description</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#reviewsTab">Reviews (24)</a></li>
            </ul>
            <div class="tab-content p-4">
                <div class="tab-pane fade show active" id="descTab">
                    <p>This is a premium product from AKU 92's curated medical supply line. It meets all quality standards and is sourced directly from certified manufacturers.</p>
                    <ul>
                        <li>100% genuine and certified</li>
                        <li>Manufactured under strict quality controls</li>
                        <li>Suitable for clinical and personal use</li>
                        <li>Recommended by healthcare professionals</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="reviewsTab">
                    
                    <div class="shop-review mb-3 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <strong>{{ $t['name'] }}</strong>
                            <span class="text-warning">{{ renderStars($t['rating']) }}</span>
                        </div>
                        <p class="mb-0 text-muted">"{{ $t['text'] }}"</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-5">
            @include('components.section-header', ['title' => 'Related Products'])
            <div class="row">
                
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="shop-product-card">
                        <a href="{{ url('/shop/product/' . $rp['id']) }}" class="shop-product-link">
                            <div class="shop-product-img">
                                <img src="{{ $rp['image']) ?>" alt="<?= sanitize($rp['name'] }}">
                                <span class="shop-badge">-{{ $rd }}%</span>
                            </div>
                            <div class="shop-product-info">
                                <h5 class="shop-product-name">{{ $rp['name'] }}</h5>
                                <div class="shop-product-price">
                                    <span class="shop-sale">&#8377;{{ number_format($rp['sale_price']) }}</span>
                                    <span class="shop-original">&#8377;{{ number_format($rp['original_price']) }}</span>
                                </div>
                            </div>
                        </a>
                        <button class="btn-shop-cart" data-id="{{ $rp['id'] ?>" data-name="{{ $rp['name']) ?>" data-price="<?= $rp['sale_price'] }}" data-image="<?= sanitize($rp['image'] }}">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.shop')

@section('title', 'Shop')

@section('content')

<!-- Shop Hero -->
<section class="shop-hero">
    <div class="container">
        <h1>{!! \App\Models\Section::getContent('shop.hero_title', 'Our Products') !!}</h1>
        <p>{!! \App\Models\Section::getContent('shop.hero_sub', 'Quality medical products & supplies at affordable prices') !!}</p>
    </div>
</section>

<!-- Filters -->
<section class="shop-filters">
    <div class="container">
        <form class="shop-filter-bar" method="GET">
            <div class="row align-items-end g-3">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label small fw-semibold">Search</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="{{ \App\Models\Section::getContent('shop.search_placeholder', 'Search products...') }}" value="{{ request('search', '') }}">
                        <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small fw-semibold">Category</label>
                    <select class="form-select" name="category">
                        <option value="">{{ \App\Models\Section::getContent('shop.category_all', 'All Categories') }}</option>
                        @foreach(\App\Models\Section::meta('shop.categories', 'items', []) as $cat)
                            <option value="{{ $cat['value'] ?? '' }}" @selected(request('category') === ($cat['value'] ?? ''))>{{ $cat['label'] ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small fw-semibold">Sort By</label>
                    <select class="form-select" name="sort">
                        <option value="newest">Newest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name A–Z</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <button class="btn btn-dark w-100" type="submit">{{ \App\Models\Section::getContent('shop.apply_label', 'Apply') }}</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Product Grid -->
<section class="section shop-products">
    <div class="container">
        <div class="row">
            @foreach($products as $product)
            @php $discount = round((($product->original_price - $product->sale_price) / $product->original_price) * 100); @endphp
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="shop-product-card">
                    <a href="{{ url('/shop/product/' . $product->id) }}" class="shop-product-link">
                        <div class="shop-product-img">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                            <span class="shop-badge">-{{ $discount }}%</span>
                        </div>
                        <div class="shop-product-info">
                            <h5 class="shop-product-name">{{ $product->name }}</h5>
                            <div class="shop-product-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                <span class="small text-muted">(4.5)</span>
                            </div>
                            <div class="shop-product-price">
                                <span class="shop-sale">&#8377;{{ number_format($product->sale_price) }}</span>
                                <span class="shop-original">&#8377;{{ number_format($product->original_price) }}</span>
                            </div>
                        </div>
                    </a>
                    <button class="btn-shop-cart" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->sale_price }}" data-image="{{ asset('images/' . $product->image) }}">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Info Banner -->
<section class="shop-info-banner">
    <div class="container">
        <div class="row text-center">
            @foreach(\App\Models\Section::meta('shop.info_banner', 'items', []) as $feat)
                <div class="col-md-3 col-6 mb-3">
                    <i class="{{ $feat['icon'] ?? 'fas fa-check-circle' }} fa-2x mb-2"></i>
                    <h6>{{ $feat['title'] ?? '' }}</h6>
                    <p class="small text-muted mb-0">{!! $feat['description'] ?? '' !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

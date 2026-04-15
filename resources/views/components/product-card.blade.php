@php
    $p = is_array($product) ? (object)$product : $product;
    $discount = $p->original_price > 0 ? round((($p->original_price - $p->sale_price) / $p->original_price) * 100) : 0;
    $imgSrc = str_starts_with($p->image ?? '', 'http') ? $p->image : asset('images/' . ($p->image ?? ''));
@endphp
<div class="col-lg-4 col-md-6 mb-4">
    <div class="product-card">
        <div class="product-image">
            <img src="{{ $imgSrc }}" alt="{{ $p->name }}">
            <span class="discount-badge">-{{ $discount }}%</span>
        </div>
        <div class="product-info">
            <h5 class="product-name">{{ $p->name }}</h5>
            <div class="product-price">
                <span class="sale-price">&#8377;{{ number_format($p->sale_price) }}</span>
                <span class="original-price">&#8377;{{ number_format($p->original_price) }}</span>
            </div>
            <button class="btn btn-primary btn-add-cart" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->sale_price }}" data-image="{{ $imgSrc }}">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </div>
    </div>
</div>

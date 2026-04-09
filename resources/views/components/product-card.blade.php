@php $discount = round((($product['original_price'] - $product['sale_price']) / $product['original_price']) * 100); @endphp
<div class="col-lg-4 col-md-6 mb-4">
    <div class="product-card">
        <div class="product-image">
            <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}">
            <span class="discount-badge">-{{ $discount }}%</span>
        </div>
        <div class="product-info">
            <h5 class="product-name">{{ $product['name'] }}</h5>
            <div class="product-price">
                <span class="sale-price">&#8377;{{ number_format($product['sale_price']) }}</span>
                <span class="original-price">&#8377;{{ number_format($product['original_price']) }}</span>
            </div>
            <button class="btn btn-primary btn-add-cart" data-id="{{ $product['id'] }}">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </div>
    </div>
</div>

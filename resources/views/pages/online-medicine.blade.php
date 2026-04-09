@extends('layouts.app')

@section('title', 'Online Medicine')

@section('content')

<section class="section online-medicine-section">
    <div class="container">
        @include('components.section-header', ['title' => 'Online Medicine Store', 'subtitle' => 'Order medicines online from the comfort of your home'])

        <!-- Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <div class="medicine-search">
                    <form action="" method="GET">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" name="search" placeholder="Search medicines..." value="{{ request('search', '') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            @foreach($products as $product)
                @include("components.product-card", ["product" => $product])
            @endforeach
        </div>

        <!-- Info Banner -->
        <div class="medicine-info-banner mt-5">
            <div class="row align-items-center">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-truck fa-2x text-primary mb-2"></i>
                    <h6>Free Delivery</h6>
                    <p class="small text-muted mb-0">On orders above &#8377;500</p>
                </div>
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                    <h6>Genuine Products</h6>
                    <p class="small text-muted mb-0">100% authentic medicines</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-headset fa-2x text-primary mb-2"></i>
                    <h6>24/7 Support</h6>
                    <p class="small text-muted mb-0">Call us anytime</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

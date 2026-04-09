@extends('layouts.app')

@section('title', 'Products')

@section('content')

<section class="section products-section">
    <div class="container">
        @include('components.section-header', ['title' => 'Our Products', 'subtitle' => 'Quality medical products and supplies at affordable prices'])
        <div class="row">
            @foreach($products as $product)
                @include("components.product-card", ["product" => $product])
            @endforeach
        </div>
    </div>
</section>
@endsection

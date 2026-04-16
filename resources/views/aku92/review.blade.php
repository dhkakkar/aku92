@extends('layouts.aku92')

@section('title', \App\Models\Section::getContent('review.hero_title', 'Aku Review'))

@section('content')

<!-- Hero -->
<section class="aku92-page-hero" style="background-image: url('{{ asset('images/firms/aku-review.jpg') }}');">
    <div class="aku92-page-hero-overlay">
        <div class="container">
            <h1>{!! \App\Models\Section::getContent('review.hero_title', 'Aku Review') !!}</h1>
            <p>{!! \App\Models\Section::getContent('review.hero_sub', 'Medical publications & educational resources') !!}</p>
        </div>
    </div>
</section>

<!-- About -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/firms/aku-review.jpg') }}" alt="Aku Review" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 mb-4">
                <h2>{!! \App\Models\Section::getContent('review.about_title', 'About Aku Review') !!}</h2>
                <div class="aku92-divider"></div>
                <div>{!! \App\Models\Section::getContent('review.about_content', '') !!}</div>
            </div>
        </div>
    </div>
</section>

<!-- Publications -->
<section class="section section-alt">
    <div class="container">
        @include('components.section-header', ['title' => \App\Models\Section::getContent('review.publications_title', 'Our Publications')])
        <div class="row justify-content-center">
            @foreach(\App\Models\Section::meta('review.publications_list', 'items', []) as $pub)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="aku92-pub-card">
                        @if(!empty($pub['image']))
                            <img src="{{ asset($pub['image']) }}" alt="{{ $pub['title'] ?? '' }}" class="img-fluid">
                        @endif
                        <div class="aku92-pub-body">
                            <h5>{{ $pub['title'] ?? '' }}</h5>
                            <p>{{ $pub['description'] ?? '' }}</p>
                            @if(!empty($pub['price']))
                                <span class="aku92-pub-price">
                                    &#8377;{{ $pub['price'] }}
                                    @if(!empty($pub['original_price']))
                                        <del>&#8377;{{ $pub['original_price'] }}</del>
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3>{!! \App\Models\Section::getContent('review.contact_title', 'Contact Us') !!}</h3>
                <div class="aku92-divider mx-auto"></div>
                <p><i class="fas fa-map-marker-alt text-danger"></i> {!! \App\Models\Section::getContent('review.contact_address', '') !!}</p>
                @php $phone = \App\Models\Section::getContent('review.contact_phone', ''); @endphp
                @if($phone)
                    <p><i class="fas fa-phone-alt text-primary"></i> <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

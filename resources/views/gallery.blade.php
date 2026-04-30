<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | {{ $site->get('site_name', 'AKU 92') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @verbatim
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0c0c0e;
            --card: #141416;
            --border: rgba(191,161,74,0.12);
            --border-subtle: rgba(255,255,255,0.05);
            --gold: #BFA14A;
            --gold-light: #d4b85c;
            --gold-soft: rgba(191,161,74,0.08);
            --white: #FAFAF8;
            --gray: #8A8A90;
            --mid: #5a5a62;
            --serif: 'Cormorant Garamond', Georgia, serif;
            --sans: 'Outfit', system-ui, sans-serif;
        }
        body { font-family: var(--sans); background: var(--bg); color: var(--white); line-height: 1.6; }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }

        .gallery-nav {
            position: sticky; top: 0; z-index: 100;
            padding: 16px 5%;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(12,12,14,0.92); backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-subtle);
        }
        .gallery-logo { display: flex; align-items: center; gap: 10px; }
        .gallery-logo img { height: 34px; border-radius: 50%; background: #fff; padding: 3px; }
        .gallery-logo span { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--gold); }

        .gallery-hero {
            text-align: center; padding: 80px 5% 40px;
            border-bottom: 1px solid var(--border-subtle);
        }
        .gallery-hero-label {
            display: inline-flex; align-items: center; gap: 12px; margin-bottom: 14px;
        }
        .gallery-hero-label .line { width: 36px; height: 1px; background: var(--gold); }
        .gallery-hero-label span { font-size: 0.7rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); font-weight: 500; }
        .gallery-hero h1 { font-family: var(--serif); font-size: 3rem; font-weight: 400; margin-bottom: 8px; }
        .gallery-hero p { font-size: 1rem; font-weight: 300; color: var(--gray); max-width: 640px; margin: 0 auto; }

        .gallery-tabs {
            display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;
            padding: 30px 5%;
            border-bottom: 1px solid var(--border-subtle);
        }
        .tab-btn {
            background: transparent; border: 1px solid var(--border-subtle);
            color: var(--gray); padding: 9px 22px; border-radius: 999px;
            font-size: 0.78rem; font-weight: 500; letter-spacing: 1.2px; text-transform: uppercase;
            cursor: pointer; transition: all 0.3s ease;
        }
        .tab-btn:hover { color: var(--white); border-color: var(--border); }
        .tab-btn.active { background: var(--gold); color: var(--bg); border-color: var(--gold); }

        .gallery-grid {
            padding: 50px 5%;
            display: grid; gap: 4px;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        }
        .gallery-item {
            position: relative; overflow: hidden; cursor: zoom-in;
            background: var(--card);
            aspect-ratio: 1 / 1;
        }
        .gallery-item img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);
        }
        .gallery-item:hover img { transform: scale(1.05); }
        .gallery-item-overlay {
            position: absolute; inset: 0;
            display: flex; align-items: flex-end; padding: 20px;
            background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(0,0,0,0.85) 100%);
            opacity: 0; transition: opacity 0.4s ease;
        }
        .gallery-item:hover .gallery-item-overlay { opacity: 1; }
        .gallery-item-overlay-text { color: var(--white); }
        .gallery-item-overlay-text strong { display: block; font-size: 1rem; font-weight: 500; margin-bottom: 2px; }
        .gallery-item-overlay-text span { font-size: 0.7rem; color: var(--gold); letter-spacing: 2px; text-transform: uppercase; }

        .gallery-empty {
            grid-column: 1 / -1;
            text-align: center; padding: 80px 0; color: var(--mid);
        }
        .gallery-empty i { font-size: 3rem; margin-bottom: 14px; color: var(--gold); opacity: 0.4; }

        /* Lightbox */
        .lightbox {
            position: fixed; inset: 0; z-index: 1100;
            background: rgba(0,0,0,0.9);
            display: none; align-items: center; justify-content: center; padding: 5%;
        }
        .lightbox.open { display: flex; }
        .lightbox img { max-width: 100%; max-height: 90vh; object-fit: contain; border: 1px solid var(--border); }
        .lightbox-close {
            position: absolute; top: 24px; right: 28px;
            width: 42px; height: 42px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.06); color: var(--white);
            cursor: pointer; transition: all 0.3s ease; border: 1px solid var(--border-subtle);
        }
        .lightbox-close:hover { background: var(--gold); color: var(--bg); border-color: var(--gold); }
        .lightbox-caption {
            position: absolute; bottom: 24px; left: 50%; transform: translateX(-50%);
            color: var(--gray); font-size: 0.85rem; letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .gallery-hero { padding: 60px 5% 30px; }
            .gallery-hero h1 { font-size: 2rem; }
            .gallery-tabs { padding: 20px 5%; }
            .tab-btn { padding: 7px 16px; font-size: 0.7rem; }
            .gallery-grid { padding: 30px 5%; grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    @endverbatim
</head>
<body>

@include('components.landing-sidebar')

<nav class="gallery-nav">
    <a href="{{ url('/') }}" class="gallery-logo">
        <img src="{{ asset('images/logo.png') }}" alt="{{ $site->get('site_name', 'AKU 92') }}">
        <span>{{ $site->get('site_name', 'AKU 92') }}</span>
    </a>
    <a href="{{ url('/') }}" style="color: var(--gray); font-size: 0.78rem; letter-spacing: 2px; text-transform: uppercase;"><i class="fas fa-arrow-left"></i> Back</a>
</nav>

<section class="gallery-hero">
    <div class="gallery-hero-label"><span class="line"></span><span>Moments</span><span class="line"></span></div>
    <h1>Our Gallery</h1>
    <p>A glimpse of clinics, events, publications and the people behind AKU 92.</p>
</section>

<div class="gallery-tabs" id="galleryTabs">
    <button class="tab-btn active" data-filter="all">All</button>
    @foreach($categories as $cat)
        <button class="tab-btn" data-filter="{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</button>
    @endforeach
</div>

<div class="gallery-grid" id="galleryGrid">
    @forelse($images as $img)
        @php $catSlug = \Illuminate\Support\Str::slug($img->category ?? ''); @endphp
        <div class="gallery-item" data-category="{{ $catSlug }}" data-src="{{ asset('storage/' . $img->image) }}" data-title="{{ $img->title }}" data-cat="{{ $img->category }}">
            <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title ?: $img->category }}" loading="lazy">
            @if($img->title || $img->category)
                <div class="gallery-item-overlay">
                    <div class="gallery-item-overlay-text">
                        @if($img->title)<strong>{{ $img->title }}</strong>@endif
                        @if($img->category)<span>{{ $img->category }}</span>@endif
                    </div>
                </div>
            @endif
        </div>
    @empty
        <div class="gallery-empty">
            <i class="fas fa-images"></i>
            <p>No gallery images uploaded yet.</p>
        </div>
    @endforelse
</div>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <div class="lightbox-close" id="lightboxClose"><i class="fas fa-times"></i></div>
    <img src="" alt="" id="lightboxImg">
    <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tab filtering
        var tabs = document.querySelectorAll('#galleryTabs .tab-btn');
        var items = document.querySelectorAll('#galleryGrid .gallery-item');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                this.classList.add('active');
                var filter = this.getAttribute('data-filter');
                items.forEach(function (it) {
                    var cat = it.getAttribute('data-category');
                    it.style.display = (filter === 'all' || cat === filter) ? '' : 'none';
                });
            });
        });

        // Lightbox
        var lightbox = document.getElementById('lightbox');
        var lightboxImg = document.getElementById('lightboxImg');
        var lightboxCaption = document.getElementById('lightboxCaption');
        var lightboxClose = document.getElementById('lightboxClose');

        items.forEach(function (it) {
            it.addEventListener('click', function () {
                lightboxImg.src = this.getAttribute('data-src');
                var title = this.getAttribute('data-title') || '';
                var cat = this.getAttribute('data-cat') || '';
                lightboxCaption.textContent = title && cat ? (title + ' — ' + cat) : (title || cat);
                lightbox.classList.add('open');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeLightbox() {
            lightbox.classList.remove('open');
            lightboxImg.src = '';
            document.body.style.overflow = '';
        }
        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeLightbox();
        });
    });
</script>
</body>
</html>

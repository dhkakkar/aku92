<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ownerLabel }} — Articles | {{ ($site->get('site_name', 'AKU 92')) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0c0c0e; --card: #141416;
            --border: rgba(191,161,74,0.12); --border-subtle: rgba(255,255,255,0.05);
            --gold: #BFA14A; --gold-light: #d4b85c;
            --white: #FAFAF8; --gray: #8A8A90; --mid: #5a5a62;
            --serif: 'Cormorant Garamond', Georgia, serif;
            --sans: 'Outfit', system-ui, sans-serif;
        }
        body { font-family: var(--sans); background: var(--bg); color: var(--white); line-height: 1.75; }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }

        .nav {
            position: fixed; top: 0; left: 64px; right: 0; z-index: 100;
            padding: 16px 5%; display: flex; align-items: center; justify-content: space-between;
            background: rgba(12,12,14,0.85); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-subtle);
        }
        @media (max-width: 768px) { .nav { left: 0; } }
        .nav-logo { display: flex; align-items: center; gap: 10px; }
        .nav-logo img { height: 34px; border-radius: 50%; background: #fff; padding: 3px; }
        .nav-logo span { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--gold); }
        .nav-back { font-size: 0.78rem; color: var(--gray); letter-spacing: 1.5px; text-transform: uppercase; transition: color 0.3s; }
        .nav-back:hover { color: var(--gold); }

        .page-hero { padding: 140px 5% 50px; text-align: center; border-bottom: 1px solid var(--border-subtle); }
        .page-hero .label { font-size: 0.7rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 12px; }
        .page-hero h1 { font-family: var(--serif); font-size: 3rem; font-weight: 600; color: var(--white); margin-bottom: 10px; }
        .page-hero p { font-size: 1rem; color: var(--gray); font-weight: 300; }

        .blog-wrap { padding: 70px 5%; max-width: 1200px; margin: 0 auto; }
        .blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
        .blog-card { display: flex; flex-direction: column; border: 1px solid var(--border-subtle); background: rgba(255,255,255,0.01); transition: all 0.3s; overflow: hidden; }
        .blog-card:hover { border-color: var(--gold); transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.25); }
        .blog-card-img { aspect-ratio: 16/10; overflow: hidden; background: var(--card); }
        .blog-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .blog-card:hover .blog-card-img img { transform: scale(1.05); }
        .blog-card-img.placeholder { display: flex; align-items: center; justify-content: center; color: var(--gold); opacity: 0.4; font-size: 2rem; }
        .blog-card-body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
        .blog-card-cat { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 10px; }
        .blog-card-title { font-family: var(--serif); font-size: 1.25rem; font-weight: 600; color: var(--white); line-height: 1.35; margin-bottom: 10px; }
        .blog-card-excerpt { font-size: 0.88rem; color: var(--gray); font-weight: 300; line-height: 1.7; flex: 1; margin-bottom: 14px; }
        .blog-card-meta { display: flex; align-items: center; justify-content: space-between; padding-top: 14px; border-top: 1px solid var(--border-subtle); font-size: 0.75rem; color: var(--mid); }
        .blog-card-meta .read-more { color: var(--gold); font-weight: 500; letter-spacing: 1px; text-transform: uppercase; }

        .empty { text-align: center; padding: 60px 20px; color: var(--mid); font-style: italic; font-weight: 200; font-size: 1.05rem; }

        .pagination-wrap { display: flex; justify-content: center; gap: 8px; margin-top: 50px; }
        .pagination-wrap a, .pagination-wrap span { display: inline-flex; align-items: center; justify-content: center; min-width: 38px; height: 38px; padding: 0 12px; border: 1px solid var(--border-subtle); color: var(--gray); font-size: 0.85rem; transition: all 0.3s; }
        .pagination-wrap a:hover { border-color: var(--gold); color: var(--gold); }
        .pagination-wrap .active { background: var(--gold); color: var(--bg); border-color: var(--gold); }

        .foot { padding: 28px 5%; text-align: center; border-top: 1px solid var(--border-subtle); font-size: 0.75rem; color: var(--mid); }
        .foot a { color: var(--gold); }

        @media (max-width: 768px) {
            .page-hero { padding: 110px 5% 40px; }
            .page-hero h1 { font-size: 2.1rem; }
            .blog-grid { grid-template-columns: 1fr; gap: 18px; }
        }
    </style>
</head>
<body>

@include('components.landing-sidebar')

<nav class="nav">
    <a href="{{ url('/') }}" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}"><span>AKU 92</span></a>
    @php
        $backRoute = match($owner) {
            'dr-akash-jain' => url('/dr-akash-jain'),
            'dr-prashuka-jain' => url('/dr-prashuka-jain'),
            default => url('/'),
        };
    @endphp
    <a href="{{ $backRoute }}" class="nav-back"><i class="fas fa-arrow-left"></i> Back</a>
</nav>

<header class="page-hero">
    <div class="label">Insights</div>
    <h1>Articles by {{ $ownerLabel }}</h1>
    <p>{{ $posts->total() }} {{ \Illuminate\Support\Str::plural('article', $posts->total()) }}</p>
</header>

<div class="blog-wrap">
    @if($posts->count())
        <div class="blog-grid">
            @foreach($posts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-card">
                    @if($post->featured_image)
                        <div class="blog-card-img"><img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"></div>
                    @else
                        <div class="blog-card-img placeholder"><i class="fas fa-newspaper"></i></div>
                    @endif
                    <div class="blog-card-body">
                        @if($post->category)<div class="blog-card-cat">{{ $post->category }}</div>@endif
                        <h3 class="blog-card-title">{{ $post->title }}</h3>
                        @if($post->excerpt)<p class="blog-card-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 130) }}</p>@endif
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> {{ $post->published_at?->format('d M Y') }}</span>
                            <span class="read-more">Read &rarr;</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="pagination-wrap">{{ $posts->links() }}</div>
    @else
        <p class="empty">No articles published yet for {{ $ownerLabel }}. Check back soon.</p>
    @endif
</div>

<footer class="foot">
    <p>&copy; {{ date('Y') }} {{ ($site->get('site_name', 'AKU 92')) }}.</p>
    <p>Designed by <a href="https://syscodetechnology.com" target="_blank">Syscode Technology</a></p>
</footer>

</body>
</html>

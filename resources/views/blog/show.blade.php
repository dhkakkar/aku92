<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} — {{ ($site->get('site_name', 'AKU 92')) }}</title>
    @if($post->excerpt)<meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt), 160) }}">@endif
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0c0c0e; --card: #141416;
            --border: rgba(191,161,74,0.12); --border-subtle: rgba(255,255,255,0.05);
            --gold: #BFA14A; --gold-light: #d4b85c; --gold-soft: rgba(191,161,74,0.08);
            --white: #FAFAF8; --gray: #8A8A90; --mid: #5a5a62;
            --serif: 'Cormorant Garamond', Georgia, serif;
            --sans: 'Outfit', system-ui, sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--sans); background: var(--bg); color: var(--white); line-height: 1.8; font-size: 1.02rem; }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }

        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 16px 5%; display: flex; align-items: center; justify-content: space-between;
            background: rgba(12,12,14,0.85); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-subtle);
        }
        .nav-logo { display: flex; align-items: center; gap: 10px; }
        .nav-logo img { height: 34px; border-radius: 50%; background: #fff; padding: 3px; }
        .nav-logo span { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--gold); }
        .nav-back { font-size: 0.78rem; color: var(--gray); letter-spacing: 1.5px; text-transform: uppercase; transition: color 0.3s; }
        .nav-back:hover { color: var(--gold); }

        .article-hero { padding: 140px 5% 60px; max-width: 880px; margin: 0 auto; text-align: center; }
        .article-meta-top { display: flex; justify-content: center; align-items: center; gap: 14px; margin-bottom: 22px; flex-wrap: wrap; font-size: 0.78rem; color: var(--mid); }
        .article-meta-top .cat { color: var(--gold); letter-spacing: 2px; text-transform: uppercase; font-weight: 500; }
        .article-meta-top .dot { color: var(--mid); }
        .article-title { font-family: var(--serif); font-size: 3.2rem; font-weight: 600; line-height: 1.15; color: var(--white); margin-bottom: 18px; }
        .article-excerpt { font-size: 1.1rem; font-weight: 300; color: var(--gray); max-width: 700px; margin: 0 auto 26px; }
        .article-author { font-size: 0.85rem; color: var(--mid); }
        .article-author strong { color: var(--gold); font-weight: 500; }

        .article-image { max-width: 1000px; margin: 0 auto 60px; padding: 0 5%; }
        .article-image img { width: 100%; max-height: 520px; object-fit: cover; border: 1px solid var(--border-subtle); }

        .article-body {
            max-width: 760px; margin: 0 auto; padding: 0 5% 80px;
            font-size: 1.05rem; color: var(--gray); font-weight: 300; line-height: 1.95;
        }
        .article-body h1, .article-body h2, .article-body h3, .article-body h4 {
            font-family: var(--serif); color: var(--white); margin: 36px 0 14px; font-weight: 600;
        }
        .article-body h2 { font-size: 1.9rem; }
        .article-body h3 { font-size: 1.5rem; }
        .article-body p { margin-bottom: 18px; }
        .article-body a { color: var(--gold); border-bottom: 1px solid var(--border); }
        .article-body strong { color: var(--white); font-weight: 500; }
        .article-body ul, .article-body ol { margin: 0 0 18px 22px; }
        .article-body li { margin-bottom: 8px; }
        .article-body blockquote {
            border-left: 3px solid var(--gold); padding: 14px 22px; margin: 24px 0;
            font-style: italic; color: var(--white); background: rgba(191,161,74,0.04);
        }
        .article-body img { margin: 24px auto; border: 1px solid var(--border-subtle); }

        .related { padding: 70px 5%; border-top: 1px solid var(--border-subtle); background: var(--card); }
        .related-header { text-align: center; margin-bottom: 40px; }
        .related-header .label { font-size: 0.7rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 8px; }
        .related-header h3 { font-family: var(--serif); font-size: 2rem; font-weight: 400; color: var(--white); }
        .related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; max-width: 1100px; margin: 0 auto; }
        .related-card { display: flex; flex-direction: column; border: 1px solid var(--border-subtle); transition: all 0.3s; overflow: hidden; }
        .related-card:hover { border-color: var(--gold); transform: translateY(-3px); }
        .related-card-img { aspect-ratio: 16/10; overflow: hidden; background: var(--bg); }
        .related-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .related-card-img.placeholder { display: flex; align-items: center; justify-content: center; color: var(--gold); opacity: 0.4; font-size: 1.6rem; }
        .related-card-body { padding: 18px; }
        .related-card-cat { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); margin-bottom: 8px; font-weight: 500; }
        .related-card-title { font-family: var(--serif); font-size: 1.1rem; color: var(--white); font-weight: 600; line-height: 1.4; }

        .foot { padding: 28px 5%; text-align: center; border-top: 1px solid var(--border-subtle); font-size: 0.75rem; color: var(--mid); }
        .foot a { color: var(--gold); }

        @media (max-width: 768px) {
            .article-hero { padding: 110px 5% 40px; }
            .article-title { font-size: 2.1rem; }
            .article-excerpt { font-size: 1rem; }
            .article-body { font-size: 1rem; padding: 0 5% 60px; }
            .related-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<nav class="nav">
    <a href="{{ url('/') }}" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}"><span>AKU 92</span></a>
    <a href="{{ route('blog.owner', $post->owner) }}" class="nav-back"><i class="fas fa-arrow-left"></i> All Articles</a>
</nav>

<header class="article-hero">
    <div class="article-meta-top">
        @if($post->category)<span class="cat">{{ $post->category }}</span><span class="dot">•</span>@endif
        <span><i class="far fa-calendar"></i> {{ $post->published_at?->format('d M Y') }}</span>
        <span class="dot">•</span>
        <span><a href="{{ route('blog.owner', $post->owner) }}" style="color:var(--gold);">{{ $post->ownerLabel() }}</a></span>
    </div>
    <h1 class="article-title">{{ $post->title }}</h1>
    @if($post->excerpt)<p class="article-excerpt">{{ $post->excerpt }}</p>@endif
    @if($post->author)<p class="article-author">By <strong>{{ $post->author }}</strong></p>@endif
</header>

@if($post->featured_image)
    <div class="article-image"><img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"></div>
@endif

<article class="article-body">
    {!! $post->body !!}
</article>

@if($related->count())
<section class="related">
    <div class="related-header">
        <div class="label">More from {{ $post->ownerLabel() }}</div>
        <h3>Related Articles</h3>
    </div>
    <div class="related-grid">
        @foreach($related as $r)
            <a href="{{ route('blog.show', $r->slug) }}" class="related-card">
                @if($r->featured_image)
                    <div class="related-card-img"><img src="{{ asset('storage/' . $r->featured_image) }}" alt="{{ $r->title }}"></div>
                @else
                    <div class="related-card-img placeholder"><i class="fas fa-newspaper"></i></div>
                @endif
                <div class="related-card-body">
                    @if($r->category)<div class="related-card-cat">{{ $r->category }}</div>@endif
                    <h4 class="related-card-title">{{ $r->title }}</h4>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

<footer class="foot">
    <p>&copy; {{ date('Y') }} {{ ($site->get('site_name', 'AKU 92')) }}.</p>
    <p>Designed by <a href="https://syscodetechnology.com" target="_blank">Syscode Technology</a></p>
</footer>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Prashuka Jain — Healthcare Professional | {{ ($site->get('site_name', 'AKU 92')) }}</title>
    <meta name="description" content="Dr. Prashuka Jain - Healthcare Professional. Co-Director, Aku92 Clinics. Pharmacy management, patient care, digital health & community wellness in Yamunanagar.">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
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
        html { scroll-behavior: smooth; }
        body { font-family: var(--sans); background: var(--bg); color: var(--white); line-height: 1.75; font-size: 1.02rem; }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }

        /* ── Nav ── */
        .nav {
            position: fixed; top: 0; left: 64px; right: 0; z-index: 100;
            padding: 16px 5%; display: flex; align-items: center; justify-content: space-between;
            background: rgba(12,12,14,0.8); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-subtle);
        }
        @media (max-width: 768px) { .nav { left: 0; } }
        .nav-logo { display: flex; align-items: center; gap: 10px; }
        .nav-logo img { height: 34px; border-radius: 50%; background: #fff; padding: 3px; }
        .nav-logo span { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--gold); }
        .nav-links { display: flex; gap: 28px; }
        .nav-links a { font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gray); transition: color 0.3s; font-weight: 400; }
        .nav-links a:hover { color: var(--gold); }
        .nav-toggle { display: none; background: none; border: none; color: var(--gold); font-size: 1.3rem; cursor: pointer; }

        /* ── Hero ── */
        .hero {
            min-height: 100vh; display: flex; align-items: center;
            padding: 100px 5% 60px; position: relative;
            border-bottom: 1px solid var(--border-subtle);
        }
        .hero::before {
            content: ''; position: absolute; top: 0; right: 0; width: 50%; height: 100%;
            background: radial-gradient(ellipse at 80% 50%, rgba(191,161,74,0.04) 0%, transparent 70%);
        }
        .hero-inner {
            display: grid; grid-template-columns: 0.65fr 0.35fr; gap: 60px;
            align-items: center; max-width: 1200px; margin: 0 auto; width: 100%;
        }
        .hero-label { display: inline-flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .hero-label .line { width: 48px; height: 1px; background: var(--gold); }
        .hero-label span { font-size: 0.7rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); font-weight: 500; }
        .hero-name { font-family: var(--serif); font-size: 4rem; font-weight: 400; color: var(--white); line-height: 1.05; margin-bottom: 12px; }
        .hero-title { font-size: 1.1rem; color: var(--gold); font-weight: 300; margin-bottom: 4px; }
        .hero-org { font-size: 0.95rem; color: var(--gray); font-weight: 200; margin-bottom: 20px; }
        .hero-meta { display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap; }
        .hero-meta-item { display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: var(--mid); }
        .hero-meta-item i { color: var(--gold); font-size: 0.7rem; }
        .hero-bio { font-size: 1.05rem; font-weight: 200; color: var(--gray); max-width: 540px; line-height: 1.85; margin-bottom: 28px; }
        .hero-stats {
            display: flex; gap: 40px; margin-bottom: 32px;
            padding: 22px 0; border-top: 1px solid var(--border-subtle); border-bottom: 1px solid var(--border-subtle);
        }
        .hero-stat-num { font-family: var(--serif); font-size: 2.4rem; font-weight: 600; color: var(--gold); }
        .hero-stat-label { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--mid); font-weight: 400; }
        .hero-actions { display: flex; gap: 14px; }
        .btn-gold {
            display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px;
            background: var(--gold); color: var(--bg); font-size: 0.8rem; font-weight: 600;
            letter-spacing: 1.5px; text-transform: uppercase; transition: all 0.3s;
        }
        .btn-gold:hover { background: var(--gold-light); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(191,161,74,0.25); }
        .btn-gold-outline {
            display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px;
            border: 1px solid var(--border); color: var(--gray); font-size: 0.8rem; font-weight: 400;
            letter-spacing: 1.5px; text-transform: uppercase; transition: all 0.3s;
        }
        .btn-gold-outline:hover { border-color: var(--gold); color: var(--gold); }
        .hero-photo { display: flex; justify-content: center; position: relative; }
        .hero-photo-frame {
            width: 280px; height: 360px; overflow: hidden; position: relative;
            border: 1px solid var(--border); box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .hero-photo-frame img { width: 100%; height: 100%; object-fit: cover; }
        .hero-photo-accent { position: absolute; bottom: -10px; right: -10px; width: 80px; height: 80px; border: 1px solid rgba(191,161,74,0.2); }

        /* ── Sections ── */
        .section { padding: 90px 5%; border-bottom: 1px solid var(--border-subtle); }
        .section-alt { background: var(--card); }
        .section-header { text-align: center; margin-bottom: 50px; }
        .section-label { font-size: 0.7rem; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 10px; }
        .section-title { font-family: var(--serif); font-size: 2.8rem; font-weight: 400; color: var(--white); margin-bottom: 6px; }
        .section-sub { font-size: 1rem; font-weight: 200; color: var(--mid); max-width: 500px; margin: 0 auto; }
        .container { max-width: 1100px; margin: 0 auto; }

        /* ── About ── */
        .about-text { font-size: 1.05rem; color: var(--gray); font-weight: 200; line-height: 2; max-width: 800px; margin: 0 auto; text-align: center; }

        /* ── Education ── */
        .edu-list { display: flex; flex-direction: column; gap: 0; max-width: 800px; margin: 0 auto; }
        .edu-item { display: flex; gap: 20px; padding: 24px 0; border-bottom: 1px solid var(--border-subtle); align-items: start; }
        .edu-item:last-child { border-bottom: none; }
        .edu-icon { width: 44px; height: 44px; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1rem; flex-shrink: 0; }
        .edu-item h4 { font-family: var(--serif); font-size: 1.3rem; font-weight: 600; color: var(--white); margin-bottom: 2px; }
        .edu-item .inst { font-size: 0.92rem; color: var(--gray); font-weight: 300; }
        .edu-item .loc { font-size: 0.82rem; color: var(--mid); font-weight: 200; }

        /* ── Expertise ── */
        .exp-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 1000px; margin: 0 auto; }
        .exp-card {
            padding: 28px 22px; border: 1px solid var(--border-subtle);
            transition: all 0.3s; text-align: center;
        }
        .exp-card:hover { border-color: var(--border); transform: translateY(-3px); }
        .exp-card-icon { width: 50px; height: 50px; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1.1rem; margin: 0 auto 16px; }
        .exp-card h4 { font-family: var(--serif); font-size: 1.15rem; font-weight: 600; color: var(--white); margin-bottom: 8px; }
        .exp-card p { font-size: 0.85rem; color: var(--mid); font-weight: 200; line-height: 1.6; }

        /* ── Timeline ── */
        .timeline { position: relative; padding-left: 50px; max-width: 700px; margin: 0 auto; }
        .timeline::before { content: ''; position: absolute; left: 18px; top: 0; bottom: 0; width: 1px; background: linear-gradient(to bottom, var(--gold), rgba(191,161,74,0.1)); }
        .tl-item { position: relative; margin-bottom: 35px; }
        .tl-dot { position: absolute; left: -41px; top: 5px; width: 14px; height: 14px; border-radius: 50%; background: var(--gold); border: 3px solid var(--bg); box-shadow: 0 0 0 1px var(--gold); }
        .tl-year { font-size: 0.82rem; font-weight: 700; color: var(--gold); margin-bottom: 4px; letter-spacing: 1px; }
        .tl-text { color: var(--gray); font-size: 0.95rem; line-height: 1.6; font-weight: 300; }

        /* ── Firms ── */
        .firms-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 1000px; margin: 0 auto; }
        .firm-card-v3 { padding: 24px; border: 1px solid var(--border-subtle); transition: all 0.3s; }
        .firm-card-v3:hover { border-color: var(--border); }
        .firm-card-v3 h4 { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--white); margin-bottom: 4px; }
        .firm-card-v3 p { font-size: 0.85rem; color: var(--mid); font-weight: 200; margin-bottom: 6px; }
        .firm-card-v3 .firm-role { font-size: 0.72rem; color: var(--gold); letter-spacing: 1px; text-transform: uppercase; font-weight: 500; margin-bottom: 8px; }

        /* ── Publications / Books ── */
        .pubs-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; max-width: 900px; margin: 0 auto; }
        .pub-book-card { padding: 24px; border: 1px solid var(--border-subtle); transition: all 0.3s; }
        .pub-book-card:hover { border-color: var(--border); }
        .pub-book-badge { display: inline-block; padding: 3px 10px; font-size: 0.6rem; font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 10px; }
        .pub-book-badge.author { background: var(--gold-soft); color: var(--gold); border: 1px solid var(--border); }
        .pub-book-badge.chapter { background: rgba(255,255,255,0.02); color: var(--mid); border: 1px solid var(--border-subtle); }
        .pub-book-card h4 { font-family: var(--serif); font-size: 1.15rem; font-weight: 600; color: var(--white); margin-bottom: 6px; line-height: 1.4; }
        .pub-book-card p { font-size: 0.85rem; color: var(--mid); font-weight: 200; line-height: 1.6; }

        /* ── Contact ── */
        .contact-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 900px; margin: 0 auto; }
        .contact-card { text-align: center; padding: 32px 20px; border: 1px solid var(--border-subtle); transition: all 0.3s; }
        .contact-card:hover { border-color: var(--border); }
        .contact-card i { font-size: 1.3rem; color: var(--gold); margin-bottom: 14px; }
        .contact-card h5 { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--white); margin-bottom: 4px; }
        .contact-card p { font-size: 0.9rem; color: var(--mid); font-weight: 200; }
        .contact-card a { color: var(--gold); }

        /* ── Blog ── */
        .blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 1100px; margin: 0 auto; }
        .blog-card { display: flex; flex-direction: column; border: 1px solid var(--border-subtle); background: rgba(255,255,255,0.01); transition: all 0.3s; overflow: hidden; }
        .blog-card:hover { border-color: var(--gold); transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.25); }
        .blog-card-img { width: 100%; aspect-ratio: 16/10; overflow: hidden; background: var(--card); }
        .blog-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .blog-card:hover .blog-card-img img { transform: scale(1.05); }
        .blog-card-img.placeholder { display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 2rem; opacity: 0.4; }
        .blog-card-body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
        .blog-card-cat { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 10px; }
        .blog-card-title { font-family: var(--serif); font-size: 1.25rem; font-weight: 600; color: var(--white); margin-bottom: 10px; line-height: 1.35; }
        .blog-card-excerpt { font-size: 0.88rem; color: var(--gray); font-weight: 300; line-height: 1.7; flex: 1; margin-bottom: 14px; }
        .blog-card-meta { display: flex; align-items: center; justify-content: space-between; padding-top: 14px; border-top: 1px solid var(--border-subtle); font-size: 0.75rem; color: var(--mid); }
        .blog-card-meta .read-more { color: var(--gold); font-weight: 500; letter-spacing: 1px; text-transform: uppercase; }
        .blog-empty { text-align: center; padding: 40px 20px; color: var(--mid); font-style: italic; font-weight: 200; }
        .blog-view-all { display: block; margin: 36px auto 0; width: fit-content; }

        /* ── Footer ── */
        .foot { padding: 28px 5%; text-align: center; border-top: 1px solid var(--border-subtle); font-size: 0.75rem; color: var(--mid); }
        .foot a { color: var(--gold); }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .nav-links { display: none; position: absolute; top: 100%; left: 0; right: 0; background: rgba(12,12,14,0.97); flex-direction: column; padding: 16px 5%; gap: 14px; }
            .nav-links.open { display: flex; }
            .nav-toggle { display: block; }
            .hero { padding: 90px 5% 50px; }
            .hero-inner { grid-template-columns: 1fr; gap: 32px; }
            .hero-photo { order: -1; }
            .hero-photo-frame { width: 200px; height: 260px; margin: 0 auto; }
            .hero-name { font-size: 2.8rem; text-align: center; }
            .hero-text { text-align: center; }
            .hero-bio { margin: 0 auto 24px; }
            .hero-stats { justify-content: center; gap: 28px; flex-wrap: wrap; }
            .hero-actions { justify-content: center; }
            .hero-label { justify-content: center; }
            .hero-meta { justify-content: center; }
            .section { padding: 60px 5%; }
            .exp-grid { grid-template-columns: 1fr; }
            .firms-grid { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .section-title { font-size: 2.2rem; }
            .blog-grid { grid-template-columns: 1fr; gap: 18px; }
            .pubs-grid { grid-template-columns: 1fr; }
        }
    </style>
    @endverbatim
</head>
<body>

@include('components.landing-sidebar')

<nav class="nav">
    <a href="{{ url('/') }}" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}"><span>AKU 92</span></a>
    <div class="nav-links" id="navLinks">
        <a href="{{ url('/') }}">Home</a><a href="#about">About</a><a href="#education">Education</a><a href="#experience">Experience</a><a href="#expertise">Expertise</a><a href="#publications">Publications</a><a href="#blog">Blog</a><a href="#contact">Contact</a>
    </div>
    <button class="nav-toggle" onclick="document.getElementById('navLinks').classList.toggle('open')"><i class="fas fa-bars"></i></button>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <div class="hero-label"><span class="line"></span><span>{!! \App\Models\Section::getContent('prashuka.hero_label', 'Clinical Cardiology Physician') !!}</span></div>
            <h1 class="hero-name">{!! \App\Models\Section::getContent('prashuka.hero_name', 'Dr. Prashuka Jain') !!}</h1>
            <p class="hero-title">{!! \App\Models\Section::getContent('prashuka.hero_title', 'Director, Aku92 Clinics') !!}</p>
            <p class="hero-org">{!! \App\Models\Section::getContent('prashuka.hero_org', 'Shivaji Park Chowk, Yamunanagar, Haryana, India') !!}</p>
            <div class="hero-meta">
                <span class="hero-meta-item"><i class="fas fa-id-card"></i> {!! \App\Models\Section::getContent('prashuka.hero_registration', 'HN 28044') !!}</span>
                <span class="hero-meta-item"><i class="fas fa-envelope"></i> {!! \App\Models\Section::getContent('prashuka.hero_email', 'jainprashuka@gmail.com') !!}</span>
            </div>
            <p class="hero-bio">{!! \App\Models\Section::getContent('prashuka.hero_bio', 'Clinical Cardiology Physician with a fellowship from St Johns Medical College Hospital.') !!}</p>
            <div class="hero-stats">
                @php
                    $p1 = \App\Models\Section::get('prashuka.stat_fellowship');
                    $p2 = \App\Models\Section::get('prashuka.stat_publications');
                    $p3 = \App\Models\Section::get('prashuka.stat_years');
                @endphp
                <div><div class="hero-stat-num">{{ $p1->content ?? '2yr' }}</div><div class="hero-stat-label">{{ data_get($p1?->meta, 'label', 'Cardiology Fellowship') }}</div></div>
                <div><div class="hero-stat-num">{{ $p2->content ?? '2' }}</div><div class="hero-stat-label">{{ data_get($p2?->meta, 'label', 'Publications') }}</div></div>
                <div><div class="hero-stat-num">{{ $p3->content ?? '8+' }}</div><div class="hero-stat-label">{{ data_get($p3?->meta, 'label', 'Years Experience') }}</div></div>
            </div>
            <div class="hero-actions">
                <a href="#contact" class="btn-gold">Get in Touch <i class="fas fa-arrow-right"></i></a>
                <a href="#expertise" class="btn-gold-outline">View Expertise</a>
            </div>
        </div>
        <div class="hero-photo">
            <div class="hero-photo-frame"><img src="{{ asset('images/persons/prashuka-jain.png') }}" alt="Dr. Prashuka Jain"></div>
            <div class="hero-photo-accent"></div>
        </div>
    </div>
</section>

<!-- About -->
<section class="section" id="about">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.about_label', 'About') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.about_title', 'About Dr. Prashuka Jain') !!}</h2></div>
        <p class="about-text">{!! \App\Models\Section::getContent('prashuka.about_text', '') !!}</p>
    </div>
</section>

<!-- Education -->
<section class="section section-alt" id="education">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.education_label', 'Education') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.education_title', 'Academic Background') !!}</h2></div>
        <div class="edu-list">
            @foreach(\App\Models\Section::meta('prashuka.education_list', 'items', []) as $edu)
                <div class="edu-item">
                    <div class="edu-icon"><i class="{{ $edu['icon'] ?? 'fas fa-graduation-cap' }}"></i></div>
                    <div>
                        <h4>{{ $edu['title'] ?? '' }}</h4>
                        <div class="inst">{{ $edu['institution'] ?? '' }}</div>
                        <div class="loc"><i class="fas fa-map-marker-alt"></i> {{ $edu['location'] ?? '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Experience -->
<section class="section" id="experience">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.experience_label', 'Experience') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.experience_title', 'Clinical Experience') !!}</h2></div>
        <div class="edu-list">
            @foreach(\App\Models\Section::meta('prashuka.experience_list', 'items', []) as $exp)
                <div class="edu-item">
                    <div class="edu-icon"><i class="{{ $exp['icon'] ?? 'fas fa-stethoscope' }}"></i></div>
                    <div>
                        <h4>{{ $exp['title'] ?? '' }}</h4>
                        <div class="inst">{{ $exp['institution'] ?? '' }}</div>
                        <div class="loc">{!! $exp['location'] ?? '' !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Expertise -->
<section class="section section-alt" id="expertise">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.expertise_label', 'What I Do') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.expertise_title', 'Areas of Practice') !!}</h2></div>
        <div class="exp-grid">
            @foreach(\App\Models\Section::meta('prashuka.expertise_cards', 'items', []) as $card)
                <div class="exp-card">
                    <div class="exp-card-icon"><i class="{{ $card['icon'] ?? 'fas fa-heart-pulse' }}"></i></div>
                    <h4>{{ $card['title'] ?? '' }}</h4>
                    <p>{{ $card['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Journey -->
<!-- Publications -->
<section class="section" id="publications">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.publications_label', 'Author') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.publications_title', 'Books &amp; Publications') !!}</h2><p class="section-sub">{!! \App\Models\Section::getContent('prashuka.publications_sub', 'Co-authored cardiology titles published by Jaypee Brothers Medical Publishers.') !!}</p></div>
        <div class="pubs-grid">
            @foreach(\App\Models\Section::meta('prashuka.publications_list', 'items', []) as $pub)
                @php $badgeClass = strtolower($pub['badge'] ?? '') === 'chapter' ? 'chapter' : 'author'; @endphp
                <div class="pub-book-card">
                    @if(!empty($pub['badge']))
                        <span class="pub-book-badge {{ $badgeClass }}">{{ $pub['badge'] }}</span>
                    @endif
                    <h4>{{ $pub['title'] ?? '' }}</h4>
                    <p>{!! $pub['body'] ?? '' !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-alt" id="journey">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.journey_label', 'Journey') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.journey_title', 'Key Milestones') !!}</h2></div>
        <div class="timeline">
            @foreach(\App\Models\Section::meta('prashuka.journey_list', 'items', []) as $tl)
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-year">{{ $tl['year'] ?? '' }}</div>
                    <p class="tl-text">{!! $tl['text'] ?? '' !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Blog -->
<section class="section section-alt" id="blog">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.blog_label', 'Insights') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.blog_title', 'Latest Articles') !!}</h2><p class="section-sub">{!! \App\Models\Section::getContent('prashuka.blog_sub', 'Health tips, community outreach updates, and writings from Dr. Prashuka Jain.') !!}</p></div>
        @if(isset($blogPosts) && $blogPosts->count())
            <div class="blog-grid">
                @foreach($blogPosts as $post)
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
            <a href="{{ route('blog.owner', 'dr-prashuka-jain') }}" class="btn-gold-outline blog-view-all">View All Articles <i class="fas fa-arrow-right"></i></a>
        @else
            <p class="blog-empty">Articles coming soon. Check back later for the latest insights from Dr. Prashuka Jain.</p>
        @endif
    </div>
</section>

<!-- Contact -->
<section class="section" id="contact">
    <div class="container">
        <div class="section-header"><div class="section-label">{!! \App\Models\Section::getContent('prashuka.contact_label', 'Contact') !!}</div><h2 class="section-title">{!! \App\Models\Section::getContent('prashuka.contact_title', 'Get in Touch') !!}</h2></div>
        <div class="contact-grid">
            @foreach(\App\Models\Section::meta('prashuka.contact_cards', 'items', []) as $card)
                <div class="contact-card">
                    <i class="{{ $card['icon'] ?? 'fas fa-envelope' }}"></i>
                    <h5>{{ $card['title'] ?? '' }}</h5>
                    <p>{!! $card['body'] ?? '' !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="foot"><p>&copy; {{ date('Y') }} Dr. Prashuka Jain — {{ ($site->get('site_name', 'AKU 92')) }}.</p><p>Designed by <a href="https://syscodetechnology.com" target="_blank">Syscode Technology</a></p></footer>

<script>
window.addEventListener('scroll', () => {
    const n = document.querySelector('.nav');
    n.style.background = window.scrollY > 60 ? 'rgba(12,12,14,0.95)' : 'rgba(12,12,14,0.8)';
});
</script>
</body>
</html>

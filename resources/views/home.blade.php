<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($site->get('site_name', 'AKU 92')) }} — Excellence in Medical Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @verbatim
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #0a0a0f;
            height: 100vh;
            overflow: hidden;
            color: #fff;
        }

        .home-v3 {
            display: flex;
            height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 300px;
            background: #0e0e14;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            border-right: 1px solid rgba(255,255,255,0.04);
        }

        .sidebar-brand {
            padding: 32px 28px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .sidebar-logo img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            padding: 4px;
            object-fit: contain;
        }

        .sidebar-logo h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .sidebar-tagline {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            opacity: 0.25;
            font-weight: 500;
        }

        /* Sidebar nav */
        .sidebar-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 28px;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.03);
            border-left-color: var(--accent);
        }

        .sidebar-link-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover .sidebar-link-icon {
            color: #fff;
        }

        .sidebar-link-text span {
            display: block;
            font-size: 0.65rem;
            opacity: 0.4;
            font-weight: 400;
            margin-top: 2px;
        }

        .sidebar-link-arrow {
            margin-left: auto;
            opacity: 0;
            transform: translateX(-6px);
            transition: all 0.3s ease;
            font-size: 0.7rem;
        }

        .sidebar-link:hover .sidebar-link-arrow {
            opacity: 0.5;
            transform: translateX(0);
        }

        /* Sidebar link colors */
        .sidebar-link--akash { --accent: #3b82f6; }
        .sidebar-link--akash .sidebar-link-icon { background: rgba(59,130,246,0.1); color: #3b82f6; border: 1px solid rgba(59,130,246,0.15); }

        .sidebar-link--prashuka { --accent: #a855f7; }
        .sidebar-link--prashuka .sidebar-link-icon { background: rgba(168,85,247,0.1); color: #a855f7; border: 1px solid rgba(168,85,247,0.15); }

        .sidebar-link--aku92 { --accent: #10b981; }
        .sidebar-link--aku92 .sidebar-link-icon { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.15); }

        .sidebar-link--shop { --accent: #f59e0b; }
        .sidebar-link--shop .sidebar-link-icon { background: rgba(245,158,11,0.1); color: #f59e0b; border: 1px solid rgba(245,158,11,0.15); }

        .sidebar-footer {
            padding: 18px 28px;
            border-top: 1px solid rgba(255,255,255,0.04);
            font-size: 0.65rem;
            opacity: 0.2;
        }

        /* ── Main Grid ── */
        .main-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 1px;
            background: rgba(255,255,255,0.03);
        }

        .card-v3 {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: background 0.5s ease;
        }

        .card-v3--akash { background: #0c1a2e; }
        .card-v3--prashuka { background: #1e0c28; }
        .card-v3--aku92 { background: #081c14; }
        .card-v3--shop { background: #1c1408; }

        .card-v3--akash:hover { background: #102440; }
        .card-v3--prashuka:hover { background: #281035; }
        .card-v3--aku92:hover { background: #0c2a1c; }
        .card-v3--shop:hover { background: #281e0e; }

        /* Accent line bottom */
        .card-v3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            z-index: 3;
            transition: width 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-v3:hover::after { width: 100%; }
        .card-v3--akash::after { background: #3b82f6; }
        .card-v3--prashuka::after { background: #a855f7; }
        .card-v3--aku92::after { background: #10b981; }
        .card-v3--shop::after { background: #f59e0b; }

        .card-v3-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        .card-v3-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 24px;
            transition: transform 0.4s;
        }
        .card-v3:hover .card-v3-icon { transform: translateY(-3px); }

        .card-v3--akash .card-v3-icon { background: rgba(59,130,246,0.1); color: #3b82f6; border: 1px solid rgba(59,130,246,0.15); }
        .card-v3--prashuka .card-v3-icon { background: rgba(168,85,247,0.1); color: #a855f7; border: 1px solid rgba(168,85,247,0.15); }
        .card-v3--aku92 .card-v3-icon { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.15); }
        .card-v3--shop .card-v3-icon { background: rgba(245,158,11,0.1); color: #f59e0b; border: 1px solid rgba(245,158,11,0.15); }

        .card-v3-number {
            position: absolute;
            top: 24px;
            right: 28px;
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: rgba(255,255,255,0.02);
            line-height: 1;
        }

        .card-v3-badge {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 12px;
            opacity: 0.35;
            transition: opacity 0.4s;
        }
        .card-v3:hover .card-v3-badge { opacity: 0.6; }
        .card-v3--akash .card-v3-badge { color: #93bbfc; }
        .card-v3--prashuka .card-v3-badge { color: #d4a8f7; }
        .card-v3--aku92 .card-v3-badge { color: #6ee7b7; }
        .card-v3--shop .card-v3-badge { color: #fbbf24; }

        .card-v3-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.15;
            transition: transform 0.4s ease;
        }
        .card-v3:hover .card-v3-title { transform: translateY(-2px); }

        .card-v3-desc {
            font-size: 0.85rem;
            opacity: 0.35;
            font-weight: 300;
            max-width: 280px;
            line-height: 1.6;
            margin-bottom: 20px;
            transition: opacity 0.4s;
        }
        .card-v3:hover .card-v3-desc { opacity: 0.55; }

        .card-v3-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0;
            transform: translateY(8px);
            transition: all 0.4s ease 0.1s;
        }
        .card-v3:hover .card-v3-cta { opacity: 0.7; transform: translateY(0); }

        .card-v3-cta .cta-line {
            width: 24px;
            height: 1px;
            transition: width 0.4s;
        }
        .card-v3:hover .card-v3-cta .cta-line { width: 36px; }
        .card-v3--akash .card-v3-cta .cta-line { background: #3b82f6; }
        .card-v3--prashuka .card-v3-cta .cta-line { background: #a855f7; }
        .card-v3--aku92 .card-v3-cta .cta-line { background: #10b981; }
        .card-v3--shop .card-v3-cta .cta-line { background: #f59e0b; }

        .card-v3-cta i {
            font-size: 0.65rem;
            transition: transform 0.3s;
        }
        .card-v3:hover .card-v3-cta i { transform: translateX(3px); }

        .card-v3 a {
            position: absolute;
            inset: 0;
            z-index: 5;
        }

        /* ── Mobile ── */
        @media (max-width: 1024px) {
            .sidebar { width: 240px; }
        }

        @media (max-width: 768px) {
            body { overflow-y: auto; }
            .home-v3 { flex-direction: column; height: auto; }
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(255,255,255,0.04);
            }
            .sidebar-brand {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .sidebar-nav {
                flex-direction: row;
                overflow-x: auto;
                padding: 0;
            }
            .sidebar-link {
                padding: 14px 18px;
                border-left: none;
                border-bottom: 3px solid transparent;
                white-space: nowrap;
            }
            .sidebar-link:hover { border-bottom-color: var(--accent); border-left-color: transparent; }
            .sidebar-link-text span { display: none; }
            .sidebar-link-arrow { display: none; }
            .sidebar-footer { display: none; }
            .main-grid {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(4, 70vh);
            }
            .card-v3-cta { opacity: 0.5; transform: translateY(0); }
        }
    </style>
    @endverbatim
</head>
<body>

<div class="home-v3">

    <aside class="sidebar">
        <div class="sidebar-brand">
            <div>
                <div class="sidebar-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}">
                    <h1>AKU92</h1>
                </div>
                <div class="sidebar-tagline">{!! \App\Models\Section::getContent('home.sidebar_tagline', 'Media & Healthcare Group') !!}</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ url('/dr-akash-jain') }}" class="sidebar-link sidebar-link--akash">
                <div class="sidebar-link-icon"><i class="fas fa-user-md"></i></div>
                <div class="sidebar-link-text">{!! \App\Models\Section::getContent('home.akash_title', 'Dr. Akash Jain') !!}<span>{!! \App\Models\Section::getContent('home.akash_sidebar_sub', 'Interventional Cardiologist') !!}</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/dr-prashuka-jain') }}" class="sidebar-link sidebar-link--prashuka">
                <div class="sidebar-link-icon"><i class="fas fa-heartbeat"></i></div>
                <div class="sidebar-link-text">{!! \App\Models\Section::getContent('home.prashuka_title', 'Dr. Prashuka Jain') !!}<span>{!! \App\Models\Section::getContent('home.prashuka_sidebar_sub', 'Director • Clinical Cardiology Physician') !!}</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/healthcare') }}" class="sidebar-link sidebar-link--aku92">
                <div class="sidebar-link-icon"><i class="fas fa-hospital"></i></div>
                <div class="sidebar-link-text">{!! \App\Models\Section::getContent('home.aku92_title', 'AKU 92') !!}<span>{!! \App\Models\Section::getContent('home.aku92_sidebar_sub', 'Media & Healthcare Group') !!}</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/shop') }}" class="sidebar-link sidebar-link--shop">
                <div class="sidebar-link-icon"><i class="fas fa-shopping-bag"></i></div>
                <div class="sidebar-link-text">{!! \App\Models\Section::getContent('home.shop_title', 'Our Products') !!}<span>{!! \App\Models\Section::getContent('home.shop_sidebar_sub', 'Medical supplies & books') !!}</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </nav>

        <div class="sidebar-footer">{!! \App\Models\Section::getContent('home.sidebar_footer', '&copy; ' . date('Y') . ' AKU 92 &bull; Yamunanagar, Haryana') !!}</div>
    </aside>

    <div class="main-grid">
        <div class="card-v3 card-v3--akash">
            <div class="card-v3-number">01</div>
            <div class="card-v3-content">
                <div class="card-v3-icon"><i class="fas fa-user-md"></i></div>
                <div class="card-v3-badge">{!! \App\Models\Section::getContent('home.akash_badge', 'Interventional Cardiologist') !!}</div>
                <h2 class="card-v3-title">{!! \App\Models\Section::getContent('home.akash_title', 'Dr. Akash Jain') !!}</h2>
                <p class="card-v3-desc">{!! \App\Models\Section::getContent('home.akash_desc', 'Interventional Cardiologist specializing in structural heart interventions & complex coronary procedures.') !!}</p>
                <div class="card-v3-cta"><span class="cta-line"></span> View Profile <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/dr-akash-jain') }}"></a>
        </div>

        <div class="card-v3 card-v3--prashuka">
            <div class="card-v3-number">02</div>
            <div class="card-v3-content">
                <div class="card-v3-icon"><i class="fas fa-heartbeat"></i></div>
                <div class="card-v3-badge">{!! \App\Models\Section::getContent('home.prashuka_badge', 'Director') !!}</div>
                <h2 class="card-v3-title">{!! \App\Models\Section::getContent('home.prashuka_title', 'Dr. Prashuka Jain') !!}</h2>
                <p class="card-v3-desc">{!! \App\Models\Section::getContent('home.prashuka_desc', 'Director, Aku92 Medical Industries Pvt. Ltd. Clinical Cardiology Physician.') !!}</p>
                <div class="card-v3-cta"><span class="cta-line"></span> View Profile <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/dr-prashuka-jain') }}"></a>
        </div>

        <div class="card-v3 card-v3--aku92">
            <div class="card-v3-number">03</div>
            <div class="card-v3-content">
                <div class="card-v3-icon"><i class="fas fa-hospital"></i></div>
                <div class="card-v3-badge">{!! \App\Models\Section::getContent('home.aku92_badge', 'Media & Healthcare Group') !!}</div>
                <h2 class="card-v3-title">{!! \App\Models\Section::getContent('home.aku92_title', 'AKU 92') !!}</h2>
                <p class="card-v3-desc">{!! \App\Models\Section::getContent('home.aku92_desc', 'Publications, Clinics, Cardiology, Physiotherapy, Medical Supplies & Healthcare.') !!}</p>
                <div class="card-v3-cta"><span class="cta-line"></span> Explore <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/healthcare') }}"></a>
        </div>

        <div class="card-v3 card-v3--shop">
            <div class="card-v3-number">04</div>
            <div class="card-v3-content">
                <div class="card-v3-icon"><i class="fas fa-shopping-bag"></i></div>
                <div class="card-v3-badge">{!! \App\Models\Section::getContent('home.shop_badge', 'Medical Products') !!}</div>
                <h2 class="card-v3-title">{!! \App\Models\Section::getContent('home.shop_title', 'Our Products') !!}</h2>
                <p class="card-v3-desc">{!! \App\Models\Section::getContent('home.shop_desc', 'Quality medicines, supplies & books at affordable prices.') !!}</p>
                <div class="card-v3-cta"><span class="cta-line"></span> Shop Now <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/shop') }}"></a>
        </div>
    </div>

</div>

</body>
</html>

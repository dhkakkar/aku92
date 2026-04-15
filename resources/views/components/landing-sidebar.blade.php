{{-- Persistent landing sidebar: shown on every landing page.
     Collapsed icon rail by default; expands on hover. --}}
@php
    $currentPath = '/' . trim(request()->path(), '/');
@endphp

<style>
    .aku-landing-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 64px;
        background: #0e0e14;
        border-right: 1px solid rgba(255,255,255,0.06);
        display: flex;
        flex-direction: column;
        z-index: 1050;
        overflow: hidden;
        transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        font-family: 'Outfit', system-ui, -apple-system, sans-serif;
    }
    .aku-landing-sidebar:hover { width: 280px; }

    .aku-ls-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px 14px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        min-height: 72px;
    }
    .aku-ls-brand img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #fff;
        padding: 3px;
        object-fit: contain;
        flex-shrink: 0;
    }
    .aku-ls-brand-text {
        opacity: 0;
        transform: translateX(-8px);
        transition: all 0.3s ease 0.05s;
        white-space: nowrap;
    }
    .aku-landing-sidebar:hover .aku-ls-brand-text { opacity: 1; transform: translateX(0); }
    .aku-ls-brand-text h1 {
        font-family: 'Playfair Display', 'Cormorant Garamond', Georgia, serif;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 2px;
        color: #fff;
        margin: 0;
        line-height: 1;
    }
    .aku-ls-brand-text span {
        display: block;
        font-size: 0.58rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255,255,255,0.35);
        margin-top: 4px;
    }

    .aku-ls-nav {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 14px 0;
    }
    .aku-ls-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 14px;
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
        position: relative;
    }
    .aku-ls-link:hover,
    .aku-ls-link.is-active {
        color: #fff;
        background: rgba(255,255,255,0.035);
        border-left-color: var(--accent);
    }
    .aku-ls-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .aku-ls-text {
        opacity: 0;
        transform: translateX(-6px);
        transition: all 0.3s ease 0.05s;
        white-space: nowrap;
        overflow: hidden;
    }
    .aku-landing-sidebar:hover .aku-ls-text { opacity: 1; transform: translateX(0); }
    .aku-ls-text strong {
        display: block;
        font-weight: 600;
        font-size: 0.85rem;
        line-height: 1.2;
    }
    .aku-ls-text span {
        display: block;
        font-size: 0.62rem;
        opacity: 0.5;
        margin-top: 3px;
        font-weight: 400;
    }

    .aku-ls-link--akash { --accent: #3b82f6; }
    .aku-ls-link--akash .aku-ls-icon { background: rgba(59,130,246,0.12); color: #3b82f6; border: 1px solid rgba(59,130,246,0.2); }
    .aku-ls-link--prashuka { --accent: #a855f7; }
    .aku-ls-link--prashuka .aku-ls-icon { background: rgba(168,85,247,0.12); color: #a855f7; border: 1px solid rgba(168,85,247,0.2); }
    .aku-ls-link--aku92 { --accent: #10b981; }
    .aku-ls-link--aku92 .aku-ls-icon { background: rgba(16,185,129,0.12); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
    .aku-ls-link--shop { --accent: #f59e0b; }
    .aku-ls-link--shop .aku-ls-icon { background: rgba(245,158,11,0.12); color: #f59e0b; border: 1px solid rgba(245,158,11,0.2); }

    .aku-ls-home {
        padding: 12px 14px;
        border-top: 1px solid rgba(255,255,255,0.05);
        display: flex;
        align-items: center;
        gap: 14px;
        color: rgba(255,255,255,0.4);
        font-size: 0.75rem;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .aku-ls-home:hover { color: #fff; }
    .aku-ls-home i { width: 36px; text-align: center; font-size: 0.9rem; }
    .aku-ls-home-text {
        opacity: 0;
        transition: opacity 0.3s ease 0.05s;
        white-space: nowrap;
    }
    .aku-landing-sidebar:hover .aku-ls-home-text { opacity: 1; }

    /* Push page content right so sidebar doesn't overlap */
    body { padding-left: 64px; }

    @media (max-width: 768px) {
        .aku-landing-sidebar {
            width: 100%;
            height: 56px;
            top: auto;
            bottom: 0;
            flex-direction: row;
            border-right: none;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .aku-landing-sidebar:hover { width: 100%; }
        .aku-ls-brand, .aku-ls-home { display: none; }
        .aku-ls-nav {
            flex-direction: row;
            padding: 0;
            width: 100%;
            justify-content: space-around;
        }
        .aku-ls-link {
            flex-direction: column;
            gap: 2px;
            padding: 6px 4px;
            border-left: none;
            border-top: 3px solid transparent;
            flex: 1;
            min-width: 0;
        }
        .aku-ls-link:hover, .aku-ls-link.is-active {
            border-left-color: transparent;
            border-top-color: var(--accent);
        }
        .aku-ls-icon { width: 26px; height: 26px; min-width: 26px; font-size: 0.75rem; border-radius: 7px; }
        .aku-ls-text { opacity: 1; transform: none; }
        .aku-ls-text strong { font-size: 0.58rem; letter-spacing: 0.2px; }
        .aku-ls-text span { display: none; }
        body { padding-left: 0; padding-bottom: 56px; }
    }
</style>

<aside class="aku-landing-sidebar" aria-label="AKU92 navigation">
    <a href="{{ url('/') }}" class="aku-ls-brand">
        <img src="{{ asset('images/logo.png') }}" alt="AKU 92">
        <div class="aku-ls-brand-text">
            <h1>AKU92</h1>
            <span>Media &amp; Healthcare</span>
        </div>
    </a>

    <nav class="aku-ls-nav">
        <a href="{{ url('/dr-akash-jain') }}"
           class="aku-ls-link aku-ls-link--akash {{ $currentPath === '/dr-akash-jain' ? 'is-active' : '' }}">
            <div class="aku-ls-icon"><i class="fas fa-user-md"></i></div>
            <div class="aku-ls-text">
                <strong>Dr. Akash Jain</strong>
                <span>Interventional Cardiologist</span>
            </div>
        </a>
        <a href="{{ url('/dr-prashuka-jain') }}"
           class="aku-ls-link aku-ls-link--prashuka {{ $currentPath === '/dr-prashuka-jain' ? 'is-active' : '' }}">
            <div class="aku-ls-icon"><i class="fas fa-heartbeat"></i></div>
            <div class="aku-ls-text">
                <strong>Dr. Prashuka Jain</strong>
                <span>Clinical Cardiology Physician</span>
            </div>
        </a>
        <a href="{{ url('/healthcare') }}"
           class="aku-ls-link aku-ls-link--aku92 {{ str_starts_with($currentPath, '/healthcare') ? 'is-active' : '' }}">
            <div class="aku-ls-icon"><i class="fas fa-hospital"></i></div>
            <div class="aku-ls-text">
                <strong>AKU92</strong>
                <span>Media &amp; Healthcare</span>
            </div>
        </a>
        <a href="{{ url('/shop') }}"
           class="aku-ls-link aku-ls-link--shop {{ str_starts_with($currentPath, '/shop') ? 'is-active' : '' }}">
            <div class="aku-ls-icon"><i class="fas fa-shopping-bag"></i></div>
            <div class="aku-ls-text">
                <strong>Our Products</strong>
                <span>Medical supplies &amp; books</span>
            </div>
        </a>
    </nav>

    <a href="{{ url('/') }}" class="aku-ls-home">
        <i class="fas fa-home"></i>
        <span class="aku-ls-home-text">Home</span>
    </a>
</aside>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AKU92 — Excellence in Medical Care | {{ ($site->get('site_name', 'AKU 92')) }}</title>
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
        body { font-family: var(--sans); background: var(--bg); color: var(--white); overflow: hidden; height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* ── Layout ── */
        .hub { display: flex; height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: 300px;
            background: var(--card);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            border-right: 1px solid var(--border-subtle);
        }

        .sidebar-brand {
            padding: 32px 28px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .sidebar-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .sidebar-logo img { width: 44px; height: 44px; border-radius: 50%; background: #fff; padding: 4px; object-fit: contain; }
        .sidebar-logo h1 { font-family: var(--serif); font-size: 1.4rem; font-weight: 700; color: var(--gold); letter-spacing: 1px; }

        .sidebar-tagline {
            font-size: 0.68rem; text-transform: uppercase; letter-spacing: 2.5px;
            color: var(--mid); font-weight: 400;
        }

        .sidebar-nav { flex: 1; display: flex; flex-direction: column; padding: 20px 0; }

        .sidebar-link {
            display: flex; align-items: center; gap: 14px;
            padding: 16px 28px; color: var(--gray);
            font-size: 0.9rem; font-weight: 400;
            transition: all 0.3s; border-left: 2px solid transparent;
        }

        .sidebar-link:hover {
            color: var(--white); background: rgba(255,255,255,0.02);
            border-left-color: var(--gold);
        }

        .sidebar-link-icon {
            width: 36px; height: 36px;
            border: 1px solid var(--border-subtle);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; color: var(--gold);
            flex-shrink: 0; transition: all 0.3s;
        }

        .sidebar-link:hover .sidebar-link-icon {
            background: var(--gold-soft); border-color: var(--border);
        }

        .sidebar-link-text span {
            display: block; font-size: 0.68rem; color: var(--mid);
            font-weight: 300; margin-top: 2px;
        }

        .sidebar-link-arrow {
            margin-left: auto; opacity: 0; transform: translateX(-6px);
            transition: all 0.3s; font-size: 0.7rem; color: var(--gold);
        }

        .sidebar-link:hover .sidebar-link-arrow { opacity: 1; transform: translateX(0); }

        .sidebar-footer {
            padding: 18px 28px; border-top: 1px solid var(--border-subtle);
            font-size: 0.68rem; color: var(--mid);
        }

        /* ── Main Grid — 2x3 ── */
        .main-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 3px;
            padding: 3px;
            background: rgba(255,255,255,0.02);
        }

        .card-hub {
            position: relative; overflow: hidden; cursor: pointer;
        }

        .card-hub-bg {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            transition: transform 0.7s cubic-bezier(0.25,0.46,0.45,0.94);
        }

        .card-hub:hover .card-hub-bg { transform: scale(1.08); }

        .card-hub-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(160deg, rgba(191,161,74,0.06) 0%, rgba(0,0,0,0.8) 100%);
            transition: all 0.4s;
        }

        .card-hub:hover .card-hub-overlay {
            background: linear-gradient(160deg, rgba(191,161,74,0.12) 0%, rgba(0,0,0,0.65) 100%);
        }

        .card-hub-content {
            position: relative; z-index: 2;
            height: 100%; display: flex; flex-direction: column;
            justify-content: flex-end; padding: 28px;
            color: var(--white);
        }

        .card-hub-icon {
            width: 42px; height: 42px;
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: var(--gold);
            margin-bottom: 14px; background: rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        }

        .card-hub-badge {
            font-size: 0.6rem; font-weight: 500; letter-spacing: 2px;
            text-transform: uppercase; color: var(--gold);
            margin-bottom: 8px;
        }

        .card-hub-title {
            font-family: var(--serif); font-size: 1.6rem;
            font-weight: 600; margin-bottom: 6px; line-height: 1.2;
        }

        .card-hub-desc {
            font-size: 0.82rem; color: var(--gray); font-weight: 300;
            line-height: 1.5; max-width: 280px;
        }

        .card-hub-cta {
            display: inline-flex; align-items: center; gap: 8px;
            margin-top: 14px; font-size: 0.7rem; font-weight: 500;
            letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--gold);
            opacity: 0; transform: translateY(6px);
            transition: all 0.4s;
        }

        .card-hub-cta .cta-line { width: 24px; height: 1px; background: var(--gold); }

        .card-hub:hover .card-hub-cta { opacity: 1; transform: translateY(0); }

        .card-hub a { position: absolute; inset: 0; z-index: 5; }

        /* ── OPD CTA card ── */
        .card-hub--cta {
            background: var(--card);
            border: 1px dashed var(--border);
            display: flex; align-items: center; justify-content: center;
        }

        .card-hub--cta .card-hub-content {
            justify-content: center; align-items: center; text-align: center;
        }

        .card-hub--cta .card-hub-icon {
            background: var(--gold-soft); border-color: var(--border);
            width: 56px; height: 56px; font-size: 1.3rem;
        }

        .card-hub--cta .card-hub-cta { opacity: 1; transform: translateY(0); }

        /* ── Mobile ── */
        @media (max-width: 1024px) {
            .sidebar { width: 240px; }
            .card-hub-title { font-size: 1.3rem; }
        }

        @media (max-width: 768px) {
            body { overflow-y: auto; }
            .hub { flex-direction: column; height: auto; }
            .sidebar {
                width: 100%; flex-direction: row; flex-wrap: wrap;
                align-items: center; border-right: none;
                border-bottom: 1px solid var(--border-subtle);
            }
            .sidebar-brand {
                width: 100%; padding: 16px 20px;
                display: flex; align-items: center; justify-content: space-between;
            }
            .sidebar-nav {
                width: 100%; flex-direction: row; padding: 0;
                overflow-x: auto;
            }
            .sidebar-link {
                padding: 12px 16px; border-left: none;
                border-bottom: 2px solid transparent; white-space: nowrap;
            }
            .sidebar-link:hover { border-bottom-color: var(--gold); border-left-color: transparent; }
            .sidebar-link-text span { display: none; }
            .sidebar-link-arrow { display: none; }
            .sidebar-footer { display: none; }
            .main-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: repeat(3, 45vh);
            }
            .card-hub-cta { opacity: 0.8; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .main-grid {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(6, 40vh);
            }
        }
    </style>
    @endverbatim
</head>
<body>

@include('components.landing-sidebar')

<div class="hub">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div>
                <div class="sidebar-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ ($site->get('site_name', 'AKU 92')) }}">
                    <h1>{!! \App\Models\Section::getContent('aku92.sidebar_brand', 'AKU92') !!}</h1>
                </div>
                <div class="sidebar-tagline">{!! \App\Models\Section::getContent('aku92.sidebar_tagline', 'Media & Healthcare Group') !!}</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ url('/healthcare/review') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-book-medical"></i></div>
                <div class="sidebar-link-text">Aku Review<span>Medico-Legal Publication</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/shop/product/1') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-heart-pulse"></i></div>
                <div class="sidebar-link-text">MCQs in Cardiology<span>Book for MD & DM Students</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="https://youtube.com/@aku92cardio" target="_blank" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fab fa-youtube"></i></div>
                <div class="sidebar-link-text">Aku92cardio<span>YouTube Channel</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/healthcare/clinics') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-clinic-medical"></i></div>
                <div class="sidebar-link-text">Aku92 Clinics<span>Cardiology, Shivaji Park</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/healthcare/physiotherapy') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-hand-holding-medical"></i></div>
                <div class="sidebar-link-text">Aku Physiotherapy<span>Pain relief & rehab</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/healthcare/jain-medicines') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-store"></i></div>
                <div class="sidebar-link-text">Jain Medical Store<span>D.A.V. Market</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/healthcare/jain-medicines') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-pills"></i></div>
                <div class="sidebar-link-text">Jain Medicines<span>Santosh Hospital</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/healthcare/opd-form') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="sidebar-link-text">Book Appointment<span>OPD Registration</span></div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="{{ url('/') }}" class="sidebar-link">
                <div class="sidebar-link-icon"><i class="fas fa-arrow-left"></i></div>
                <div class="sidebar-link-text">Back to Home</div>
                <div class="sidebar-link-arrow"><i class="fas fa-arrow-right"></i></div>
            </a>
        </nav>

        <div class="sidebar-footer">{!! \App\Models\Section::getContent('aku92.sidebar_footer', '&copy; ' . date('Y') . ' AKU 92 &bull; Yamunanagar, Haryana') !!}</div>
    </aside>

    <!-- Main Grid -->
    <div class="main-grid">

        <div class="card-hub">
            <div class="card-hub-bg" style="background-image: url('{{ asset('images/firms/aku-review.jpg') }}');"></div>
            <div class="card-hub-overlay"></div>
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-book-medical"></i></div>
                <div class="card-hub-badge">Medico-Legal Publication</div>
                <h2 class="card-hub-title">Aku Review</h2>
                <p class="card-hub-desc">An English annual — Medico-Legal Special publication.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Explore <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/healthcare/review') }}"></a>
        </div>

        <div class="card-hub">
            <div class="card-hub-bg" style="background-image: url('{{ asset('images/products/mcq-cardiology.jpg') }}');"></div>
            <div class="card-hub-overlay"></div>
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-heart-pulse"></i></div>
                <div class="card-hub-badge">Book &bull; Available on Amazon</div>
                <h2 class="card-hub-title">MCQs in Cardiology</h2>
                <p class="card-hub-desc">For MD and DM Students. By Akash Jain & Prashuka Jain.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> View <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/shop/product/1') }}"></a>
        </div>

        <div class="card-hub" style="background: var(--card);">
            <div class="card-hub-content" style="justify-content: center; align-items: center; text-align: center;">
                <div class="card-hub-icon" style="background: rgba(255,0,0,0.1); color: #ff0000; border-color: rgba(255,0,0,0.2);"><i class="fab fa-youtube"></i></div>
                <div class="card-hub-badge">YouTube Channel</div>
                <h2 class="card-hub-title">Aku92cardio</h2>
                <p class="card-hub-desc" style="text-align: center;">Cardiology education, case discussions & healthcare videos.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Subscribe <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="https://youtube.com/@aku92cardio" target="_blank"></a>
        </div>

        <div class="card-hub">
            <div class="card-hub-bg" style="background-image: url('{{ asset('images/firms/aku92-clinics.jpg') }}');"></div>
            <div class="card-hub-overlay"></div>
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-clinic-medical"></i></div>
                <div class="card-hub-badge">Cardiology Care</div>
                <h2 class="card-hub-title">Aku92 Clinics</h2>
                <p class="card-hub-desc">Consultation in Cardiology at Shivaji Park Chowk, Yamunanagar.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Explore <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/healthcare/clinics') }}"></a>
        </div>

        <div class="card-hub">
            <div class="card-hub-bg" style="background-image: url('{{ asset('images/firms/aku-physiotherapy.jpg') }}');"></div>
            <div class="card-hub-overlay"></div>
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-hand-holding-medical"></i></div>
                <div class="card-hub-badge">Rehabilitation</div>
                <h2 class="card-hub-title">Aku Physiotherapy</h2>
                <p class="card-hub-desc">Expert pain relief & rehabilitation at Shivaji Park Chowk.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Explore <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/healthcare/physiotherapy') }}"></a>
        </div>

        <div class="card-hub">
            <div class="card-hub-bg" style="background-image: url('{{ asset('images/firms/jain-medical-store.jpg') }}');"></div>
            <div class="card-hub-overlay"></div>
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-store"></i></div>
                <div class="card-hub-badge">Medical Supplies</div>
                <h2 class="card-hub-title">Jain Medical Store</h2>
                <p class="card-hub-desc">D.A.V. Market, Holkar Chowk, Yamunanagar.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Explore <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/shop') }}"></a>
        </div>

        <div class="card-hub">
            <div class="card-hub-bg" style="background-image: url('{{ asset('images/firms/jain-medicines.jpg') }}');"></div>
            <div class="card-hub-overlay"></div>
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-pills"></i></div>
                <div class="card-hub-badge">Pharmacy &bull; Ambulance</div>
                <h2 class="card-hub-title">Jain Medicines</h2>
                <p class="card-hub-desc">Pharmacy, Aku Physiotherapy & Ambulance at Santosh Hospital.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Explore <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/healthcare/jain-medicines') }}"></a>
        </div>

        <div class="card-hub card-hub--cta">
            <div class="card-hub-content">
                <div class="card-hub-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="card-hub-badge">Book Appointment</div>
                <h2 class="card-hub-title">OPD Form</h2>
                <p class="card-hub-desc">Register for outpatient services online.</p>
                <div class="card-hub-cta"><span class="cta-line"></span> Fill Form <i class="fas fa-arrow-right"></i></div>
            </div>
            <a href="{{ url('/healthcare/opd-form') }}"></a>
        </div>

    </div>

</div>

</body>
</html>

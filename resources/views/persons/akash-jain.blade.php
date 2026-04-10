?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Akash Jain — Interventional Cardiologist | {{ config('site.name') }}</title>
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
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 16px 5%; display: flex; align-items: center; justify-content: space-between;
            background: rgba(12,12,14,0.8); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-subtle);
        }
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

        /* ── Education ── */
        .edu-list { display: flex; flex-direction: column; gap: 0; max-width: 800px; margin: 0 auto; }
        .edu-item { display: flex; gap: 20px; padding: 24px 0; border-bottom: 1px solid var(--border-subtle); align-items: start; }
        .edu-item:last-child { border-bottom: none; }
        .edu-icon { width: 44px; height: 44px; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1rem; flex-shrink: 0; }
        .edu-item h4 { font-family: var(--serif); font-size: 1.3rem; font-weight: 600; color: var(--white); margin-bottom: 2px; }
        .edu-item .inst { font-size: 0.92rem; color: var(--gray); font-weight: 300; }
        .edu-item .loc { font-size: 0.82rem; color: var(--mid); font-weight: 200; }

        /* ── Expertise ── */
        .exp-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; max-width: 900px; margin: 0 auto; }
        .exp-block h3 { font-family: var(--serif); font-size: 1.4rem; font-weight: 600; color: var(--gold); margin-bottom: 16px; }
        .exp-list { list-style: none; }
        .exp-list li {
            display: flex; align-items: center; gap: 10px; font-size: 0.95rem; color: var(--gray);
            padding: 12px 0; border-bottom: 1px solid var(--border-subtle); font-weight: 300;
            transition: color 0.3s;
        }
        .exp-list li:last-child { border-bottom: none; }
        .exp-list li:hover { color: var(--white); }
        .exp-list li i { color: var(--gold); font-size: 0.5rem; flex-shrink: 0; }

        /* ── Publications ── */
        .pub-list { display: flex; flex-direction: column; gap: 12px; max-width: 900px; margin: 0 auto; }
        .pub-item {
            padding: 18px 20px 18px 48px; border: 1px solid var(--border-subtle);
            background: rgba(255,255,255,0.01); position: relative; transition: all 0.3s;
        }
        .pub-item:hover { border-color: var(--border); }
        .pub-num { position: absolute; left: 16px; top: 20px; font-family: var(--serif); font-size: 0.9rem; color: var(--gold); }
        .pub-item p { font-size: 0.92rem; color: var(--gray); font-weight: 300; line-height: 1.7; }
        .pub-item p strong { color: var(--white); font-weight: 500; }
        .pub-item p em { color: var(--gold); font-style: italic; }
        .pub-toggle {
            display: block; margin: 20px auto 0; padding: 10px 28px; background: none;
            border: 1px solid var(--border-subtle); color: var(--gray); font-size: 0.78rem;
            font-weight: 400; letter-spacing: 1px; cursor: pointer; transition: all 0.3s;
        }
        .pub-toggle:hover { border-color: var(--gold); color: var(--gold); }
        .pub-hidden { display: none; max-width: 900px; margin: 0 auto; }
        .pub-hidden.show { display: flex; flex-direction: column; gap: 12px; margin-top: 12px; }

        /* ── Books ── */
        .books-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; max-width: 900px; margin: 0 auto; }
        .book-card { padding: 22px; border: 1px solid var(--border-subtle); transition: all 0.3s; }
        .book-card:hover { border-color: var(--border); }
        .book-badge { display: inline-block; padding: 3px 10px; font-size: 0.6rem; font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px; }
        .book-badge.author { background: var(--gold-soft); color: var(--gold); border: 1px solid var(--border); }
        .book-badge.chapter { background: rgba(255,255,255,0.02); color: var(--mid); border: 1px solid var(--border-subtle); }
        .book-card h4 { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--white); margin-bottom: 4px; }
        .book-card p { font-size: 0.85rem; color: var(--mid); font-weight: 200; }

        /* ── Contact ── */
        .contact-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 900px; margin: 0 auto; }
        .contact-card { text-align: center; padding: 32px 20px; border: 1px solid var(--border-subtle); transition: all 0.3s; }
        .contact-card:hover { border-color: var(--border); }
        .contact-card i { font-size: 1.3rem; color: var(--gold); margin-bottom: 14px; }
        .contact-card h5 { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--white); margin-bottom: 4px; }
        .contact-card p { font-size: 0.9rem; color: var(--mid); font-weight: 200; }
        .contact-card a { color: var(--gold); transition: color 0.3s; }

        /* ── Extra ── */
        .extra-list { display: flex; flex-direction: column; gap: 10px; max-width: 700px; margin: 0 auto; }
        .extra-item { display: flex; align-items: start; gap: 12px; padding: 14px 0; border-bottom: 1px solid var(--border-subtle); font-size: 0.95rem; color: var(--gray); font-weight: 300; }
        .extra-item:last-child { border-bottom: none; }
        .extra-item i { color: var(--gold); margin-top: 5px; font-size: 0.6rem; flex-shrink: 0; }

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
            .books-grid { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .section-title { font-size: 2.2rem; }
            .blog-grid { grid-template-columns: 1fr; gap: 18px; }
        }
    </style>
    @endverbatim
</head>
<body>

<nav class="nav">
    <a href="{{ url('/') }}" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="{{ config('site.name') }}"><span>AKU 92</span></a>
    <div class="nav-links" id="navLinks">
        <a href="#education">Education</a><a href="#expertise">Expertise</a><a href="#publications">Research</a><a href="#books">Books</a><a href="#blog">Blog</a><a href="#contact">Contact</a>
    </div>
    <button class="nav-toggle" onclick="document.getElementById('navLinks').classList.toggle('open')"><i class="fas fa-bars"></i></button>
</nav>

<section class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <div class="hero-label"><span class="line"></span><span>Interventional Cardiologist</span></div>
            <h1 class="hero-name">Dr. Akash Jain</h1>
            <p class="hero-title">Director, Aku92 Clinics (unit of Aku92 Medical Industries Pvt Ltd)</p>
            <p class="hero-org">Shivaji Park Chowk, Yamunanagar, Haryana, India</p>
            <div class="hero-meta">
                <span class="hero-meta-item"><i class="fas fa-id-card"></i> DMC/R/14483</span>
                <span class="hero-meta-item"><i class="fas fa-envelope"></i> drakashjain92@gmail.com</span>
            </div>
            <p class="hero-bio">Interventional Cardiologist trained in Spain and India. Specializing in structural heart interventions and complex coronary procedures with 35+ international publications in top journals.</p>
            <div class="hero-stats">
                <div><div class="hero-stat-num">35+</div><div class="hero-stat-label">Publications</div></div>
                <div><div class="hero-stat-num">6</div><div class="hero-stat-label">Book Chapters</div></div>
                <div><div class="hero-stat-num">3</div><div class="hero-stat-label">Countries</div></div>
            </div>
            <div class="hero-actions">
                <a href="#contact" class="btn-gold">Get in Touch <i class="fas fa-arrow-right"></i></a>
                <a href="#publications" class="btn-gold-outline">Publications</a>
            </div>
        </div>
        <div class="hero-photo">
            <div class="hero-photo-frame"><img src="{{ asset('images/persons/akash-jain.png') }}" alt="Dr. Akash Jain"></div>
            <div class="hero-photo-accent"></div>
        </div>
    </div>
</section>

<section class="section" id="education">
    <div class="container">
        <div class="section-header"><div class="section-label">Education</div><h2 class="section-title">Academic Background</h2></div>
        <div class="edu-list">
            <div class="edu-item"><div class="edu-icon"><i class="fas fa-heart-pulse"></i></div><div><h4>Hemodynamics & Interventional Cardiology</h4><div class="inst">Hospital Clinico Universitario de Valladolid</div><div class="loc">Valladolid, Spain</div></div></div>
            <div class="edu-item"><div class="edu-icon"><i class="fas fa-award"></i></div><div><h4>DM (Fellowship), Cardiology</h4><div class="inst">Sri Jayadeva Institute of Cardiovascular Science and Research</div><div class="loc">Bangalore, India</div></div></div>
            <div class="edu-item"><div class="edu-icon"><i class="fas fa-stethoscope"></i></div><div><h4>MD (Residency), Internal Medicine</h4><div class="inst">Vardhman Mahavir Medical College & Safdarjung Hospital</div><div class="loc">Delhi, India</div></div></div>
            <div class="edu-item"><div class="edu-icon"><i class="fas fa-user-graduate"></i></div><div><h4>MBBS</h4><div class="inst">Vardhman Mahavir Medical College & Safdarjung Hospital</div><div class="loc">Delhi, India</div></div></div>
        </div>
    </div>
</section>

<section class="section section-alt" id="expertise">
    <div class="container">
        <div class="section-header"><div class="section-label">Specialization</div><h2 class="section-title">Areas of Expertise</h2></div>
        <div class="exp-grid">
            <div class="exp-block"><h3>Structural Interventions</h3><ul class="exp-list"><li><i class="fas fa-circle"></i>TAVI (Transcatheter Aortic Valve Implantation)</li><li><i class="fas fa-circle"></i>M-TEER (Mitral Transcatheter Edge to Edge Repair)</li><li><i class="fas fa-circle"></i>T-TEER (Tricuspid Transcatheter Edge to Edge Repair)</li><li><i class="fas fa-circle"></i>LAAC (Left Atrial Appendage Closure)</li></ul></div>
            <div class="exp-block"><h3>Complex Coronary Interventions</h3><ul class="exp-list"><li><i class="fas fa-circle"></i>Rotational Atherectomy</li><li><i class="fas fa-circle"></i>Orbital Atherectomy</li><li><i class="fas fa-circle"></i>Chronic Total Occlusion (CTO)</li><li><i class="fas fa-circle"></i>Intravascular Imaging (IVUS/OCT)</li></ul></div>
        </div>
    </div>
</section>

<section class="section" id="publications">
    <div class="container">
        <div class="section-header"><div class="section-label">Research</div><h2 class="section-title">Publications</h2><p class="section-sub">Selected peer-reviewed publications in international cardiology journals.</p></div>
        <div class="pub-list">
            <div class="pub-item"><span class="pub-num">1</span><p><strong>Jain A</strong>, Montorfano M, Freeman P, Jose J, Da Costa Mj M, Abdurashid M, Gunasekaran S, Nissen H, Martin P, Seth A, et al. Four-year multicentre experience with the Myval transcatheter heart valve in Mitral, Tricuspid, and Pulmonary positions: durability and hemodynamic outcomes. <em>Asia Intervention</em>, 2026.</p></div>
            <div class="pub-item"><span class="pub-num">2</span><p>Amat-Santos IJ, Real C, Galán-Arriola C, Diz-Díaz J, Párraga R, Pérez-Camargo D, Stepanenko A, Lujan-Rodríguez F, García-Gómez M, Filgueiras-Rama D, Pereda D, Fernández-Jiménez R, García-Álvarez A, <strong>Jain A</strong>, Pensotti F, San Román JA, Ibanez B. Transcatheter aortic valve-in-mechanical valve replacement: a first-in-human study. <em>Eur Heart J</em>. 2026 Jan 30:ehag019. PMID: 41614684.</p></div>
            <div class="pub-item"><span class="pub-num">3</span><p>Pensotti F, <strong>Jain A</strong>, Ruiz J, García Gómez M, Sztejfman M, Wang Y, Campo Prieto A, Serrador Frutos A, Amat Santos IJ. Initial Use of Vitaflow for Single-Operator TAVR: A First Look. <em>J Am Coll Cardiol Intv</em>. 2026 Mar, 19 (5_Suppl) S68.</p></div>
            <div class="pub-item"><span class="pub-num">4</span><p><strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Stambuk K, Gunasekaran S, Mussayev A, García-Gómez M, Fernandez-Cordón C, Campo A, Rodriguez M, Carrasco-Moraleja M, Román AS, Amat-Santos IJ. Comparison of Self-Expandable Acurate Neo-2 and Balloon-Expandable Myval Transcatheter Heart Valves at 4-Year Follow-Up. <em>Catheter Cardiovasc Interv</em>. 2025 Jul 23. PMID: 40702771.</p></div>
            <div class="pub-item"><span class="pub-num">5</span><p><strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Stambuk K, Sengottuvelu G, Abdurashid M, García-Gómez M, Fernandez-Cordón C, Rodriguez M, Carrasco-Moraleja M, San Román A, Amat-Santos IJ. Four-year durability of the Myval balloon-expandable transcatheter aortic valve. <em>EuroIntervention</em>. 2025 Jul 7;21(13):e758-e765. PMID: 40627005.</p></div>
        </div>
        <div class="pub-hidden" id="morePubs">
            <div class="pub-item"><span class="pub-num">6</span><p>Jain S, Reddy TS, Patil RS, <strong>Jain A</strong> (corresponding author). Clinical profile and gender variances among premature coronary artery disease cases undergoing percutaneous coronary intervention: A retrospective analysis. <em>J Indian Coll Cardiol</em>. January 2026. DOI: 10.4103/jicc.jicc_2_25.</p></div>
            <div class="pub-item"><span class="pub-num">7</span><p>Pensotti F, Garnacho LJ, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Zuñiga M, Sandín-Fuentes M, Campo A, Cortés-Villar C, Blasco S, Llamas-Fernández L, Campillo S, San Román AJ, Amat-Santos IJ. Device console programming in patients undergoing TAVI with preexisting cardiac implantable electronic devices: a practical guide. <em>REC Interv Cardiol</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">8</span><p>Pensotti F, Garcia-Gomez M, <strong>Jain A</strong>, Rodriguez M, Zuniga M, Jorge C, Sanz-Sanchez J, Regueiro A, Occhipinti G, San Roman A, Amat Santos I. Leaflet Modification for TAVR at high risk of coronary obstruction: A Minimalist Approach. <em>PCR London Valves</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">9</span><p>García Gómez M, Assaf S, Lelasi A, De Brahi JP, Pan Ossorio M, Serra García V, Van Royen N, Bhaskaran J, Sengottuvelu G, Sândoli De Brito F, Martín P, Dager A, Sarnago Cebada F, Pensotti F, <strong>Jain A</strong>, San Roman A, Amat Santos IJ. Outcomes of a balloon-expandable transcatheter heart valve for the treatment of aortic regurgitation. <em>PCR London Valves</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">10</span><p>Pensotti F, Wang Y, Sztejfman M, Garcia-Gomez M, <strong>Jain A</strong>, Rodriguez M, Zuniga-Luna M, Serrador A, San Roman A, Ruiz Ruiz J, Gomez I, Campillo S, Vallinas Hernandez S, Amat-Santos I. Single-Operator TAVI with an Automatic Release Device: Early Multicenter Experience. <em>PCR London Valves</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">11</span><p>Amat-Santos IJ, Real C, <strong>Jain A</strong>, Galan Arriola C, Diz-Diaz J, Perez-Camargo D, Stepanenko A, Pereda D, García-Alvarez A, Pensotti F, García-Gomez M, San Román JA, Ibanez B. Transcatheter aortic valve-in-mechanical valve replacement: A preclinical and first-in-human study. <em>PCR London Valves</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">12</span><p>Amat-Santos I, Gómez M, Pensotti F, <strong>Jain A</strong>, Rodriguez M, Chavarria J, Rocha Almeida A, Piñel S, Serrador AM, Gomez-Salvador I, San Roman JA. TCT-730 Leaflet Modification Without General Anesthesia or TEE in High-Risk TAVR: A Conscious Sedation Approach Using BASILICA and UNICORN. <em>JACC</em>. 2025 Oct, 86 (17_Suppl) B318–B319.</p></div>
            <div class="pub-item"><span class="pub-num">13</span><p>Pensotti F, Rodriguez M, <strong>Jain A</strong>, Garcia Gomez M, Amat Santos IJ. TCT-6 Initial Use of VitaFlow for Single-Operator TAVR: A First Look. <em>JACC</em>. 2025 Oct, 86 (17_Suppl) B7.</p></div>
            <div class="pub-item"><span class="pub-num">14</span><p>Amat Santos IJ, García Gómez M, Pan Álvarez-Osorio M, Peral Disdier V, Serruys PW, Baumbach A, <strong>Jain A</strong>, Martin P, Fernández Cordón C, Pensotti F, Rodriguez M, Baladrón Zorita C. Randomized non-inferiority comparison of one-year outcomes of the Myval transcatheter heart valve series with contemporary valves (Sapien and Evolut series) in symptomatic severe native aortic stenosis: the LANDMARK study. <em>SEC Spain</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">15</span><p><strong>Jain A</strong>, Martín Lorenzo P, Pensotti F, García-Gómez M, Rodriguez M, Ruiz Ruiz J, Campo A, Alañon A, Serrador Frutos, Blasco Turrión S, Gomez I, Carrasco Moraleja M, San Román AJ, Amat Santos IJ. Four-year durability of transcatheter implantation of a new aortic valve prosthesis in mitral, tricuspid, and pulmonary locations. <em>SEC Spain</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">16</span><p>Llamas Fernandez L, Pinilla Garcia D, Sevilla Ruiz T, Sierra Pallares J, Vallinas Hernandez S, Campillo de Blas S, Garcia Gomez M, <strong>Jain A</strong>, Criado Martín J, Varas Marcos I, San Román AJ, Amat Santos IJ, Baladrón Zorita C. Impact of transcatheter aortic valve implantation height on hemodynamic flow: a computational fluid dynamics study. <em>SEC</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">17</span><p><strong>Jain A</strong>, García-Gómez M, Rodríguez M, Verstraeten L, Vogelaar J, Amat-Santos IJ. Usability and accuracy of a cloud-based sizing software for left atrial appendage closure. <em>REC Interv Cardiol</em>. 2025. DOI: 10.24875/RECICE.M25000536.</p></div>
            <div class="pub-item"><span class="pub-num">18</span><p>Fernández-Cordón C, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Serrador Frutos AM, Campo Prieto A, Gutiérrez H, Cortés Villar C, Blasco Turrión S, San Román A, Amat-Santos IJ. Transcatheter aortic valve-in-valve implantation inside a degenerated sutureless bioprosthesis. <em>EuroIntervention Images</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">19</span><p>Fernández-Cordón C, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Serrador Frutos AM, Campo Prieto A, Cortés C, Blasco-Turrión S, San Román JA, Amat-Santos IJ. Left Ventricle Wire Loss During TAVR: How to Solve it Through Antegrade and Retrograde Approach. <em>JACC Case Rep</em>. 2025 Jun 18;30(15):103758. PMID: 40541354.</p></div>
            <div class="pub-item"><span class="pub-num">20</span><p>García-Gómez M, Martin P, Moreno R, Nombela-Franco L, Bedogni F, Montorfano M, Egred M, Teles R, Fernandez-Cordon C, <strong>Jain A</strong>, Rodriguez M, Amat-Santos I. Matched comparison between Sapien-3 Ultra Resilia and Myval Octacor balloon-expandable valves. <em>EuroPCR</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">21</span><p>Rodriguez M, Fernandez-Cordon C, García-Gómez M, <strong>Jain A</strong>, Campo A, Serrador A, Cortes Villar C, San Roman A, Gomez I, Amat-Santos IJ. Initial Experience with the VitaFlow Valve as a single-operator procedure. <em>EuroPCR</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">22</span><p><strong>Jain A</strong>, Montorfan M, Jose J, Montenegro M, Abdurashid M, Gunasekaran S, Nissen H, Martin P, Seth A, Stambuk K, García-Gómez M, Fernandez-Cordón C, Rodriguez M, Campo A, Amat-Santos I. Four-years durability of a novel balloon-expandable transcatheter valve in extra-aortic positions. <em>EuroPCR</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">23</span><p>Ruiz Ruiz J, <strong>Jain A</strong>, García-Gómez M, Fernandez-Cordón C, Rodriguez M, Real C, Cortés Villar C, Carnicero D, Carrasco Moraleja M, San Román A, Ibañez B, Amat-Santos I. Exploring the need of transcatheter valve replacement within mechanical aortic prostheses. <em>EuroPCR</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">24</span><p>Llamas-Fernández L, Pinilla-García D, Sevilla-Ruiz T, Sierra-Pallares J, Vallinas-Hernández S, Campillo S, García-Gómez M, <strong>Jain A</strong>, San-Román JA, Amat-Santos IJ, Baladrón-Zorita C. Impact of transcatheter aortic valve implant height on haemodynamic flow. <em>EuroPCR</em> 2025.</p></div>
            <div class="pub-item"><span class="pub-num">25</span><p>Fernández-Cordón C, Brilakis ES, García-Gómez M, <strong>Jain A</strong>, Rodríguez M, Cortés-Villar C, Campo-Prieto A, Serrador A, Gutiérrez H, Blasco-Turrión S, Scorpiglione L, Llamas-Fernández L, San Roman JA, Amat Santos IJ. Calcified nodules in the coronary arteries: systematic review on incidence and percutaneous coronary intervention outcomes. <em>Revista Española de Cardiología (English ed)</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">26</span><p>Amat-Santos IJ, <strong>Jain A</strong>. Gone long, not wrong: BioMime Morph and a tale of coronary ambition. <em>AsiaIntervention</em>. 2025 Mar 20;11(1):10-11. PMID: 40114733; PMCID: PMC11905109.</p></div>
            <div class="pub-item"><span class="pub-num">27</span><p>García Gómez M, Fernández Cordón C, <strong>Jain A</strong>, Serrador Frutos A, Gutiérrez García H, Campo Prieto A, Cortés Villar C, Blasco Turrión S, San Román JA, Amat Santos IJ. Four-year durability of a novel balloon expandable TAVI system (late-breaking trial). <em>PCR London Valves</em> 2024.</p></div>
            <div class="pub-item"><span class="pub-num">28</span><p>García Gómez M, Fernández Cordón C, <strong>Jain A</strong>, et al. Novel balloon expandable valve: systematic review of aortic, mitral, tricuspid and pulmonary uses. <em>PCR London Valves</em> 2024.</p></div>
            <div class="pub-item"><span class="pub-num">29</span><p><strong>Jain A</strong>, García-Gomez M, Gutiérrez H, Fernandez-Cordon C, Rodriguez M, Revilla A, Gomez I, Verstraeten L, Vogelaar J, Amat-Santos IJ. Accuracy of two different softwares for sizing LAA closure devices. <em>PCR London Valves</em> 2024.</p></div>
            <div class="pub-item"><span class="pub-num">30</span><p><strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Stambuk K, Sengottuvelu G, Abdurashid M, García-Gómez M, Fernandez-Cordón C, Rodriguez M, San Román JA, Gomez I, Amat-Santos IJ. Comparison of a self-expandable and a novel balloon expandable device at long-term. <em>PCR London Valves</em> 2024.</p></div>
            <div class="pub-item"><span class="pub-num">31</span><p><strong>Jain A</strong>, Jose J, Montorfano M, Nissen H, Martin P, Seth A, Garcia-Gomez M, Fernandez Cordon C, Campo Prieto A, Amat-Santos I. TCT-928 Comparison of the Self-Expandable Acurate Neo 2 and the New Balloon-Expandable Myval Series Transcatheter Heart Valve at 4-Year Follow-Up. <em>JACC</em>. 2024 Oct, 84 (18_Suppl) B391–B392.</p></div>
            <div class="pub-item"><span class="pub-num">32</span><p>Cordon C, Garcia-Gomez M, <strong>Jain A</strong>, Blasco-Turrion S, Campo Prieto A, Cortes Villar C, Amat-Santos I. TCT-374 Calcified Nodules in the Coronary Arteries: Systematic Review on Incidence and Percutaneous Coronary Intervention Outcomes. <em>JACC</em>. 2024 Oct, 84 (18_Suppl) B101.</p></div>
            <div class="pub-item"><span class="pub-num">33</span><p>García-Gómez M, Fernández-Cordón C, González-Gutiérrez JC, Serrador A, Campo A, Cortés Villar C, Blasco Turrión S, Aristizábal C, Peral Oliveira J, Stepanenko A, González Arribas M, Scorpiglione L, <strong>Jain A</strong>, Carnicero Martínez D, San Román JA, Amat-Santos IJ. The novel balloon-expandable Myval transcatheter heart valve: systematic review of aortic, mitral, tricuspid and pulmonary indications. <em>Rev Esp Cardiol (Engl Ed)</em>. 2024 Oct. PMID: 39395599.</p></div>
            <div class="pub-item"><span class="pub-num">34</span><p><strong>Jain A</strong>, Kharge J, Manjunath CN, Shrimanth YS. Case Report: Quadricuspid Aortic Valve. <em>J Invasive Cardiol</em>. 2023 Aug 28.</p></div>
            <div class="pub-item"><span class="pub-num">35</span><p><strong>Jain A</strong>, Marimuthu V, Alur N. The Mechanical Prosthetic Valve Thrombosis after ChAdOx1-nCoV-19 Vaccination: A Case Report. <em>Indian Heart Journal</em>. 2022.</p></div>
            <div class="pub-item"><span class="pub-num">36</span><p><strong>Jain A</strong>, Tripathi BK. A Study of Hyperhomocysteinemia as a Risk Factor for Acute Myocardial Infarction. <em>Journal of the Association of Physicians of India (JAPI)</em>.</p></div>
            <div class="pub-item"><span class="pub-num">37</span><p>Kumar R, Umashankar U, Punia VPC, Kabi BC, Singh BG, Khosla H, <strong>Jain A</strong>. Vitamin-D Status in metabolic syndrome and its correlation with different parameters of metabolic syndrome. <em>JMSCR</em>. 2018.</p></div>
            <div class="pub-item"><span class="pub-num">38</span><p>Arya R, Rajvanshi P, Ngullie B, Das D, Arora R, <strong>Jain A</strong>. A Case of Acute Motor-Sensory Axonal Neuropathy after Enteric Fever. <em>JMSCR</em>. 2018.</p></div>
        </div>
        <button class="pub-toggle" onclick="document.getElementById('morePubs').classList.toggle('show'); this.textContent = this.textContent.includes('More') ? 'Show Less' : 'Show More Publications'">Show More Publications</button>
    </div>
</section>

<section class="section section-alt" id="books">
    <div class="container">
        <div class="section-header"><div class="section-label">Author</div><h2 class="section-title">Books & Chapters</h2></div>
        <div class="books-grid">
            <div class="book-card"><span class="book-badge author">Author</span><h4>MCQs in Cardiology for MD/DM Students</h4><p>Jaypee Brothers, 2023.</p></div>
            <div class="book-card"><span class="book-badge chapter">Chapter</span><h4>RV Deterioration in HFpEF</h4><p>Ch. 64, Advances in HFpEF. Jaypee, 2025.</p></div>
            <div class="book-card"><span class="book-badge chapter">Chapter</span><h4>Challenging TAVI Cases</h4><p>Russian National Handbook, 2nd Ed. 2024.</p></div>
            <div class="book-card"><span class="book-badge chapter">Chapter</span><h4>Braunwald 11th Ed Update</h4><p>Ch. 86, Essential Revision Guide. 2024.</p></div>
            <div class="book-card"><span class="book-badge chapter">Chapter</span><h4>RV Thrombosis Evaluation</h4><p>Ch. 39, Advances in CLOT Treatment. 2023.</p></div>
            <div class="book-card"><span class="book-badge chapter">Chapter</span><h4>Acute Febrile Illness</h4><p>Ch. 135, Medicine Update Vol 29. 2019.</p></div>
        </div>
    </div>
</section>

<section class="section" id="extra">
    <div class="container">
        <div class="section-header"><div class="section-label">Beyond Medicine</div><h2 class="section-title">Extracurricular</h2></div>
        <div class="extra-list">
            <div class="extra-item"><i class="fas fa-circle"></i><span><strong>Spokesperson</strong>, Resident Doctor's Association, Safdarjung Hospital, Delhi. 2017-18</span></div>
            <div class="extra-item"><i class="fas fa-circle"></i><span>Routinely writing <strong>articles in daily Indian newspapers</strong> on healthcare issues.</span></div>
            <div class="extra-item"><i class="fas fa-circle"></i><span><strong>Medical Editor</strong>: Aku Review (HARENG/2014/61876)</span></div>
        </div>
    </div>
</section>

<section class="section" id="blog">
    <div class="container">
        <div class="section-header"><div class="section-label">Insights</div><h2 class="section-title">Latest Articles</h2><p class="section-sub">Recent writings, healthcare insights, and updates from Dr. Akash Jain.</p></div>
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
            <a href="{{ route('blog.owner', 'dr-akash-jain') }}" class="btn-gold-outline blog-view-all">View All Articles <i class="fas fa-arrow-right"></i></a>
        @else
            <p class="blog-empty">Articles coming soon. Check back later for the latest insights from Dr. Akash Jain.</p>
        @endif
    </div>
</section>

<section class="section section-alt" id="contact">
    <div class="container">
        <div class="section-header"><div class="section-label">Contact</div><h2 class="section-title">Get in Touch</h2></div>
        <div class="contact-grid">
            <div class="contact-card"><i class="fas fa-envelope"></i><h5>Email</h5><p><a href="mailto:drakashjain92@gmail.com">drakashjain92@gmail.com</a></p></div>
            <div class="contact-card"><i class="fas fa-map-marker-alt"></i><h5>Clinic</h5><p>Aku92 Clinics, Shivaji Park Chowk, Yamunanagar, Haryana</p></div>
            <div class="contact-card"><i class="fas fa-id-badge"></i><h5>Registration</h5><p>DMC/R/14483<br>Delhi Medical Council</p></div>
        </div>
    </div>
</section>

<footer class="foot"><p>&copy; {{ date('Y') }} Dr. Akash Jain — {{ config('site.name') }}.</p><p>Designed by <a href="https://syscodetechnology.com" target="_blank">Syscode Technology</a></p></footer>

<script>
window.addEventListener('scroll', () => {
    const n = document.querySelector('.nav');
    n.style.background = window.scrollY > 60 ? 'rgba(12,12,14,0.95)' : 'rgba(12,12,14,0.8)';
});
</script>
</body>
</html>

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
        .pub-hidden { display: none; }
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
        }
    </style>
    @endverbatim
</head>
<body>

<nav class="nav">
    <a href="{{ url('/') }}" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="{{ config('site.name') }}"><span>AKU 92</span></a>
    <div class="nav-links" id="navLinks">
        <a href="#education">Education</a><a href="#expertise">Expertise</a><a href="#publications">Research</a><a href="#books">Books</a><a href="#contact">Contact</a>
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
            <p class="hero-bio">Interventional Cardiologist trained in Spain and India. Specializing in structural heart interventions and complex coronary procedures with 25+ international publications in top journals.</p>
            <div class="hero-stats">
                <div><div class="hero-stat-num">25+</div><div class="hero-stat-label">Publications</div></div>
                <div><div class="hero-stat-num">6</div><div class="hero-stat-label">Book Chapters</div></div>
                <div><div class="hero-stat-num">3</div><div class="hero-stat-label">Countries</div></div>
            </div>
            <div class="hero-actions">
                <a href="#contact" class="btn-gold">Get in Touch <i class="fas fa-arrow-right"></i></a>
                <a href="#publications" class="btn-gold-outline">Publications</a>
            </div>
        </div>
        <div class="hero-photo">
            <div class="hero-photo-frame"><img src="{{ asset('images/persons/akash-jain.jpg') }}" alt="Dr. Akash Jain"></div>
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
            <div class="pub-item"><span class="pub-num">1</span><p><strong>Jain A</strong>, Montorfano M, et al. Four-year multicentre experience with Myval THV in Mitral, Tricuspid, and Pulmonary positions. <em>Asia Intervention</em>, 2026.</p></div>
            <div class="pub-item"><span class="pub-num">2</span><p>Amat-Santos IJ, et al., <strong>Jain A</strong>. Transcatheter aortic valve-in-mechanical valve replacement: first-in-human study. <em>Eur Heart J</em>. 2026.</p></div>
            <div class="pub-item"><span class="pub-num">3</span><p><strong>Jain A</strong>, Jose J, et al. Comparison of Acurate Neo-2 and Myval THV at 4-Year Follow-Up. <em>Catheter Cardiovasc Interv</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">4</span><p><strong>Jain A</strong>, Jose J, et al. Four-year durability of the Myval balloon-expandable transcatheter aortic valve. <em>EuroIntervention</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">5</span><p>Amat-Santos IJ, <strong>Jain A</strong>. Gone long, not wrong: BioMime Morph and a tale of coronary ambition. <em>AsiaIntervention</em>. 2025.</p></div>
        </div>
        <div class="pub-hidden" id="morePubs">
            <div class="pub-item"><span class="pub-num">6</span><p>Jain S, et al., <strong>Jain A</strong> (corresponding). Clinical profile and gender variances among premature CAD cases. <em>J Indian Coll Cardiol</em>. 2026.</p></div>
            <div class="pub-item"><span class="pub-num">7</span><p><strong>Jain A</strong>, García-Gómez M, et al. Cloud-based sizing software for LAAC. <em>REC Interv Cardiol</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">8</span><p>Fernández-Cordón C, et al., <strong>Jain A</strong>. Calcified nodules in coronary arteries: systematic review. <em>Rev Esp Cardiol</em>. 2025.</p></div>
            <div class="pub-item"><span class="pub-num">9</span><p><strong>Jain A</strong>, Kharge J, et al. Quadricuspid Aortic Valve. <em>J Invasive Cardiol</em> 2023.</p></div>
            <div class="pub-item"><span class="pub-num">10</span><p><strong>Jain A</strong>, Marimuthu V. Mechanical Prosthetic Valve Thrombosis after COVID Vaccination. <em>Indian Heart J</em>. 2022.</p></div>
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

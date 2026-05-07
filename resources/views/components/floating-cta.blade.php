{{-- Persistent floating "Book Online Consultancy" button — bottom right on every page. --}}
<style>
    .aku-fab {
        position: fixed;
        right: 22px;
        bottom: 22px;
        z-index: 1060;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px 12px 14px;
        border-radius: 999px;
        background: linear-gradient(135deg, #BFA14A 0%, #d4b85c 100%);
        color: #0c0c0e;
        font-family: 'Outfit', system-ui, -apple-system, sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.4px;
        text-decoration: none;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.45), 0 0 0 4px rgba(191, 161, 74, 0.18);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        line-height: 1;
    }
    .aku-fab:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.55), 0 0 0 6px rgba(191, 161, 74, 0.25);
        color: #0c0c0e;
        text-decoration: none;
    }
    .aku-fab-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(12, 12, 14, 0.88);
        color: #d4b85c;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .aku-fab-pulse {
        position: absolute;
        right: 6px; top: 6px;
        width: 10px; height: 10px;
        border-radius: 50%;
        background: #ef4444;
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6);
        animation: aku-fab-pulse 1.6s ease-out infinite;
    }
    @keyframes aku-fab-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6); }
        70%  { box-shadow: 0 0 0 12px rgba(239, 68, 68, 0); }
        100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    @media (max-width: 768px) {
        .aku-fab {
            right: 14px;
            bottom: 70px; /* clear the mobile bottom nav from landing-sidebar */
            padding: 10px 16px 10px 10px;
            font-size: 0.78rem;
        }
        .aku-fab-icon { width: 30px; height: 30px; font-size: 0.85rem; }
        .aku-fab-text-sub { display: none; }
    }
    @media (max-width: 480px) {
        .aku-fab-text { display: none; }
        .aku-fab { padding: 12px; }
        .aku-fab-icon { margin: 0; }
    }

    .aku-fab-text { display: flex; flex-direction: column; gap: 2px; }
    .aku-fab-text-main { font-weight: 700; font-size: 0.88rem; }
    .aku-fab-text-sub { font-size: 0.66rem; opacity: 0.75; letter-spacing: 1px; text-transform: uppercase; font-weight: 500; }
</style>

<a href="{{ url('/healthcare/opd-form') }}" class="aku-fab" aria-label="Book online consultancy">
    <span class="aku-fab-icon" style="position: relative;">
        <i class="fas fa-stethoscope"></i>
        <span class="aku-fab-pulse"></span>
    </span>
    <span class="aku-fab-text">
        <span class="aku-fab-text-main">Online Consultancy</span>
        <span class="aku-fab-text-sub">Book OPD</span>
    </span>
</a>

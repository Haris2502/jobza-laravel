<div class="rg-root">

    {{-- ══════════════════════════════════════════
         LEFT PANEL — Form
    ══════════════════════════════════════════ --}}
    <div class="rg-left">
        <div class="rg-form-wrap">

            {{-- Logo --}}
            <a href="/" class="rg-logo">
                <div class="rg-logo__icon">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="rg-logo__text">
                    <span class="rg-logo__brand">Job<em>za</em></span>
                    <span class="rg-logo__tagline">The Talent Hub</span>
                </div>
            </a>

            {{-- Heading --}}
            <div class="rg-heading">
                <h1 class="rg-heading__title">Buat Akun <span class="rg-heading__gradient">Profesional</span></h1>
                <p class="rg-heading__sub">Satu langkah lagi menuju karir impian Anda.</p>
            </div>

            {{-- Form --}}
            <form wire:submit.prevent="register" class="rg-form" autocomplete="off">

                {{-- Username --}}
                <div class="rg-field">
                    <label class="rg-label">Username</label>
                    <div class="rg-input-wrap">
                        <i class="bi bi-at rg-input-icon"></i>
                        <input type="text" wire:model="username"
                            class="rg-input @error('username') rg-input--error @enderror"
                            placeholder="budi_career">
                    </div>
                    @error('username')
                        <span class="rg-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="rg-field">
                    <label class="rg-label">Email Perusahaan / Pribadi</label>
                    <div class="rg-input-wrap">
                        <i class="bi bi-envelope rg-input-icon"></i>
                        <input type="email" wire:model="email"
                            class="rg-input @error('email') rg-input--error @enderror"
                            placeholder="name@example.com">
                    </div>
                    @error('email')
                        <span class="rg-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password row --}}
                <div class="rg-field-row">
                    <div class="rg-field">
                        <label class="rg-label">Kata Sandi</label>
                        <div class="rg-input-wrap" x-data="{ show: false }">
                            <i class="bi bi-shield-lock rg-input-icon"></i>
                            <input :type="show ? 'text' : 'password'" wire:model="password"
                                class="rg-input @error('password') rg-input--error @enderror"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="rg-pw-toggle">
                                <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <div class="rg-field">
                        <label class="rg-label">Konfirmasi</label>
                        <div class="rg-input-wrap" x-data="{ show: false }">
                            <i class="bi bi-check2-circle rg-input-icon"></i>
                            <input :type="show ? 'text' : 'password'" wire:model="password_confirmation"
                                class="rg-input"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="rg-pw-toggle">
                                <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @error('password')
                    <span class="rg-error" style="margin-top:-10px"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                @enderror

                {{-- Submit --}}
                <button type="submit" class="rg-submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        Gabung Sekarang
                        <i class="bi bi-arrow-right rg-submit__arrow"></i>
                    </span>
                    <span wire:loading>
                        <span class="rg-spinner"></span>
                        Memproses...
                    </span>
                </button>

            </form>

            {{-- Login link --}}
            <p class="rg-login-link">
                Sudah memiliki akun?
                <a href="{{ route('login') }}">Masuk sekarang</a>
            </p>

            {{-- Trust badges --}}
            <div class="rg-trust">
                <span class="rg-trust__item"><i class="bi bi-shield-fill-check"></i> SSL Secured</span>
                <span class="rg-trust__sep">·</span>
                <span class="rg-trust__item"><i class="bi bi-lock-fill"></i> Data Terenkripsi</span>
                <span class="rg-trust__sep">·</span>
                <span class="rg-trust__item"><i class="bi bi-patch-check-fill"></i> Terverifikasi</span>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════
         RIGHT PANEL — Visual
    ══════════════════════════════════════════ --}}
    <div class="rg-right">

        {{-- Animated background blobs --}}
        <div class="rg-blob rg-blob--1"></div>
        <div class="rg-blob rg-blob--2"></div>
        <div class="rg-blob rg-blob--3"></div>

        {{-- Floating grid dots --}}
        <div class="rg-grid-overlay"></div>

        {{-- Main content --}}
        <div class="rg-right__content">

            {{-- Floating stat cards --}}
            <div class="rg-float-card rg-float-card--tl">
                <div class="rg-float-card__icon rg-float-card__icon--green">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <p class="rg-float-card__num">12.4K+</p>
                    <p class="rg-float-card__label">Pencari Aktif</p>
                </div>
            </div>

            <div class="rg-float-card rg-float-card--br">
                <div class="rg-float-card__icon rg-float-card__icon--blue">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <div>
                    <p class="rg-float-card__num">3.8K+</p>
                    <p class="rg-float-card__label">Lowongan Aktif</p>
                </div>
            </div>

            {{-- Center hero text --}}
            <div class="rg-hero">
                <div class="rg-hero__badge">
                    <span class="rg-hero__badge-dot"></span>
                    Platform #1 Lowongan Indonesia
                </div>
                <h2 class="rg-hero__title">
                    The Future of<br>
                    <span class="rg-hero__title-grad">Work is Here.</span>
                </h2>
                <p class="rg-hero__sub">
                    Platform terintegrasi untuk Lowongan Full-time dan Proyek Freelance yang dikurasi secara ketat.
                </p>

                {{-- Feature pills --}}
                <div class="rg-pills">
                    <span class="rg-pill">
                        <i class="bi bi-check2-circle rg-pill__icon rg-pill__icon--blue"></i>
                        Verified Jobs
                    </span>
                    <span class="rg-pill">
                        <i class="bi bi-lightning-charge-fill rg-pill__icon rg-pill__icon--amber"></i>
                        Instant Apply
                    </span>
                    <span class="rg-pill">
                        <i class="bi bi-shield-fill-check rg-pill__icon rg-pill__icon--green"></i>
                        Safe &amp; Trusted
                    </span>
                </div>

                {{-- Company trust row --}}
                <div class="rg-trust-row">
                    <span class="rg-trust-row__label">Dipercaya 500+ Perusahaan</span>
                    <div class="rg-trust-row__avatars">
                        <span class="rg-trust-avatar" style="background:#3b82f6">G</span>
                        <span class="rg-trust-avatar" style="background:#10b981">T</span>
                        <span class="rg-trust-avatar" style="background:#f59e0b">S</span>
                        <span class="rg-trust-avatar" style="background:#ef4444">B</span>
                        <span class="rg-trust-avatar rg-trust-avatar--more">+</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

{{-- ══════════════════════════════════════════ STYLES ══════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap');

:root {
    --rg-accent:        #4f63f8;
    --rg-accent-dark:   #3447e0;
    --rg-accent-light:  #eef0ff;
    --rg-accent-glow:   rgba(79,99,248,.28);

    --rg-bg-left:       #fafbff;
    --rg-bg-right:      #06081a;
    --rg-white:         #ffffff;
    --rg-border:        #e4e7f8;
    --rg-border-focus:  #4f63f8;

    --rg-red:           #ef4444;
    --rg-red-light:     #fef2f2;
    --rg-green:         #10b981;
    --rg-amber:         #f59e0b;

    --rg-text-h:  #0c0e1a;
    --rg-text-b:  #2e3249;
    --rg-text-m:  #64748b;
    --rg-text-l:  #94a3b8;

    --rg-shadow-sm:     0 1px 4px rgba(0,0,0,.06);
    --rg-shadow-md:     0 4px 24px rgba(0,0,0,.08);
    --rg-shadow-lg:     0 16px 48px rgba(0,0,0,.14);
    --rg-shadow-accent: 0 10px 32px rgba(79,99,248,.38);

    --rg-r-sm: 10px;
    --rg-r-md: 14px;
    --rg-r-lg: 20px;
    --rg-r-xl: 28px;

    --font-h: 'Sora', sans-serif;
    --font-b: 'Inter', sans-serif;
}

/* ─── ROOT / LAYOUT ──────────────────────── */
.rg-root {
    display: flex;
    min-height: 100vh;
    font-family: var(--font-b);
}

/* ─── LEFT PANEL ─────────────────────────── */
.rg-left {
    flex: 0 0 480px;
    background: var(--rg-bg-left);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 24px;
    position: relative;
    z-index: 2;
    border-right: 1px solid var(--rg-border);
}
@media (max-width: 960px) {
    .rg-root { flex-direction: column; }
    .rg-left { flex: none; width: 100%; border-right: none; border-bottom: 1px solid var(--rg-border); }
    .rg-right { min-height: 400px; }
}

.rg-form-wrap {
    width: 100%;
    max-width: 400px;
    animation: rg-fadein .7s ease both;
}
@keyframes rg-fadein {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ─── LOGO ───────────────────────────────── */
.rg-logo {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    margin-bottom: 40px;
}
.rg-logo__icon {
    width: 44px; height: 44px;
    border-radius: 13px;
    background: linear-gradient(135deg, var(--rg-accent), var(--rg-accent-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    box-shadow: var(--rg-shadow-accent);
    transition: transform .3s cubic-bezier(.175,.885,.32,1.275);
}
.rg-logo:hover .rg-logo__icon { transform: rotate(-8deg) scale(1.1); }
.rg-logo__text { display: flex; flex-direction: column; gap: 1px; }
.rg-logo__brand {
    font-family: var(--font-h);
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--rg-text-h);
    letter-spacing: -0.04em;
    line-height: 1;
}
.rg-logo__brand em {
    font-style: normal;
    color: var(--rg-accent);
}
.rg-logo__tagline {
    font-size: 0.55rem;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--rg-text-l);
}

/* ─── HEADING ────────────────────────────── */
.rg-heading { margin-bottom: 32px; }
.rg-heading__title {
    font-family: var(--font-h);
    font-size: 1.9rem;
    font-weight: 800;
    color: var(--rg-text-h);
    letter-spacing: -0.04em;
    line-height: 1.1;
    margin: 0 0 8px;
}
.rg-heading__gradient {
    background: linear-gradient(120deg, var(--rg-accent), #a855f7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.rg-heading__sub {
    font-size: 0.88rem;
    color: var(--rg-text-m);
    margin: 0;
}

/* ─── FORM ───────────────────────────────── */
.rg-form { display: flex; flex-direction: column; gap: 18px; }
.rg-field { display: flex; flex-direction: column; gap: 7px; }
.rg-field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}
@media (max-width: 480px) {
    .rg-field-row { grid-template-columns: 1fr; }
}

.rg-label {
    font-family: var(--font-h);
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--rg-text-b);
    letter-spacing: 0.01em;
}
.rg-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.rg-input-icon {
    position: absolute;
    left: 14px;
    color: var(--rg-text-l);
    font-size: 0.9rem;
    pointer-events: none;
    z-index: 1;
    transition: color .2s;
}
.rg-input {
    width: 100%;
    padding: 12px 16px 12px 40px;
    border: 1.5px solid var(--rg-border);
    border-radius: var(--rg-r-md);
    font-family: var(--font-b);
    font-size: 0.875rem;
    color: var(--rg-text-h);
    background: var(--rg-white);
    transition: border-color .2s, box-shadow .2s, background .2s;
    outline: none;
    font-weight: 500;
}
.rg-input:focus {
    border-color: var(--rg-accent);
    box-shadow: 0 0 0 3px var(--rg-accent-glow);
    background: var(--rg-accent-light);
}
.rg-input:focus ~ .rg-input-icon,
.rg-input-wrap:focus-within .rg-input-icon {
    color: var(--rg-accent);
}
.rg-input::placeholder { color: var(--rg-text-l); font-weight: 400; }
.rg-input--error {
    border-color: var(--rg-red) !important;
    background: var(--rg-red-light) !important;
}
.rg-error {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--rg-red);
}

/* ─── PASSWORD TOGGLE ────────────────────── */
.rg-pw-toggle {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: var(--rg-text-l);
    font-size: 1.05rem;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    transition: color .2s;
}
.rg-pw-toggle:hover { color: var(--rg-accent); }
.rg-input-wrap .rg-input {
    padding-right: 42px;
}

/* ─── SUBMIT BUTTON ──────────────────────── */
.rg-submit {
    margin-top: 6px;
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, var(--rg-accent) 0%, var(--rg-accent-dark) 100%);
    color: white;
    border: none;
    border-radius: var(--rg-r-lg);
    font-family: var(--font-h);
    font-size: 0.9rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: var(--rg-shadow-accent);
    transition: all .25s cubic-bezier(.4,0,.2,1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}
.rg-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,.12) 50%, transparent 100%);
    transform: translateX(-100%);
    transition: transform .5s ease;
}
.rg-submit:hover::before { transform: translateX(100%); }
.rg-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 40px rgba(79,99,248,.45);
}
.rg-submit:active { transform: translateY(-1px); }
.rg-submit:disabled { opacity: .7; cursor: not-allowed; transform: none; }
.rg-submit__arrow {
    transition: transform .2s;
    font-size: 1.1rem;
}
.rg-submit:hover .rg-submit__arrow { transform: translateX(4px); }

/* Spinner */
.rg-spinner {
    display: inline-block;
    width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: white;
    border-radius: 50%;
    animation: rg-spin .65s linear infinite;
}
@keyframes rg-spin { to { transform: rotate(360deg); } }

/* ─── LOGIN LINK ─────────────────────────── */
.rg-login-link {
    text-align: center;
    font-size: 0.82rem;
    color: var(--rg-text-m);
    margin-top: 20px;
    margin-bottom: 0;
}
.rg-login-link a {
    color: var(--rg-accent);
    font-weight: 700;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: border-color .2s;
}
.rg-login-link a:hover { border-color: var(--rg-accent); }

/* ─── TRUST STRIP ────────────────────────── */
.rg-trust {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--rg-border);
}
.rg-trust__item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.66rem;
    font-weight: 600;
    color: var(--rg-text-l);
    letter-spacing: 0.03em;
}
.rg-trust__item .bi { color: var(--rg-accent); }
.rg-trust__sep { color: var(--rg-border); font-size: 0.9rem; }

/* ─── RIGHT PANEL ────────────────────────── */
.rg-right {
    flex: 1;
    background: var(--rg-bg-right);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Blobs */
.rg-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}
.rg-blob--1 {
    width: 560px; height: 560px;
    top: -120px; right: -80px;
    background: radial-gradient(circle, rgba(79,99,248,.25) 0%, transparent 70%);
    animation: rg-drift 8s ease-in-out infinite;
}
.rg-blob--2 {
    width: 400px; height: 400px;
    bottom: -60px; left: -60px;
    background: radial-gradient(circle, rgba(168,85,247,.18) 0%, transparent 70%);
    animation: rg-drift 11s ease-in-out infinite reverse;
}
.rg-blob--3 {
    width: 300px; height: 300px;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    background: radial-gradient(circle, rgba(16,185,129,.08) 0%, transparent 70%);
    animation: rg-drift 14s ease-in-out infinite;
}
@keyframes rg-drift {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33%       { transform: translate(20px, -15px) scale(1.04); }
    66%       { transform: translate(-10px, 10px) scale(.97); }
}

/* Grid overlay */
.rg-grid-overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
}

/* Right content */
.rg-right__content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 48px 40px;
    max-width: 540px;
    width: 100%;
}

/* Float cards */
.rg-float-card {
    position: absolute;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: var(--rg-r-lg);
    backdrop-filter: blur(12px);
    z-index: 3;
    animation: rg-float 6s ease-in-out infinite;
}
.rg-float-card--tl { top: 48px; left: 32px; animation-delay: 0s; }
.rg-float-card--br { bottom: 64px; right: 28px; animation-delay: -3s; }
@keyframes rg-float {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-10px); }
}
.rg-float-card__icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}
.rg-float-card__icon--green { background: rgba(16,185,129,.2); color: #34d399; }
.rg-float-card__icon--blue  { background: rgba(79,99,248,.2);  color: #818cf8; }
.rg-float-card__num {
    font-family: var(--font-h);
    font-size: 1rem;
    font-weight: 800;
    color: white;
    margin: 0;
    line-height: 1;
}
.rg-float-card__label {
    font-size: 0.68rem;
    color: rgba(255,255,255,.5);
    margin: 2px 0 0;
    font-weight: 500;
}

/* Hero text */
.rg-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: rgba(79,99,248,.15);
    border: 1px solid rgba(79,99,248,.3);
    border-radius: 100px;
    font-size: 0.7rem;
    font-weight: 700;
    color: #818cf8;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 20px;
}
.rg-hero__badge-dot {
    width: 7px; height: 7px;
    background: #818cf8;
    border-radius: 50%;
    animation: rg-pulse-dot 2s ease-in-out infinite;
}
@keyframes rg-pulse-dot {
    0%, 100% { box-shadow: 0 0 0 0 rgba(129,140,248,.6); }
    50%       { box-shadow: 0 0 0 6px rgba(129,140,248,0); }
}
.rg-hero__title {
    font-family: var(--font-h);
    font-size: 2.8rem;
    font-weight: 800;
    color: white;
    letter-spacing: -0.05em;
    line-height: 1.05;
    margin: 0 0 16px;
}
.rg-hero__title-grad {
    background: linear-gradient(120deg, #818cf8 0%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.rg-hero__sub {
    font-size: 0.9rem;
    color: rgba(255,255,255,.5);
    max-width: 380px;
    margin: 0 auto 28px;
    line-height: 1.65;
}

/* Pills */
.rg-pills {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-bottom: 36px;
}
.rg-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 16px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 600;
    color: rgba(255,255,255,.8);
    transition: background .2s, border-color .2s;
    cursor: default;
}
.rg-pill:hover {
    background: rgba(255,255,255,.1);
    border-color: rgba(255,255,255,.2);
}
.rg-pill__icon { font-size: 0.8rem; }
.rg-pill__icon--blue  { color: #60a5fa; }
.rg-pill__icon--amber { color: #fbbf24; }
.rg-pill__icon--green { color: #34d399; }

/* Trust row */
.rg-trust-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
}
.rg-trust-row__label {
    font-size: 0.72rem;
    font-weight: 600;
    color: rgba(255,255,255,.35);
    letter-spacing: 0.06em;
    text-transform: uppercase;
}
.rg-trust-row__avatars { display: flex; }
.rg-trust-avatar {
    width: 30px; height: 30px;
    border-radius: 50%;
    border: 2px solid var(--rg-bg-right);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-h);
    font-size: 0.65rem;
    font-weight: 800;
    color: white;
    margin-left: -8px;
    transition: transform .2s;
}
.rg-trust-avatar:first-child { margin-left: 0; }
.rg-trust-avatar:hover { transform: translateY(-3px) scale(1.1); z-index: 1; }
.rg-trust-avatar--more {
    background: rgba(255,255,255,.15);
    font-size: 0.7rem;
}
</style>
</div>

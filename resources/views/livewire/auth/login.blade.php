<div class="al-root">

    {{-- ══════════════════════════════════════════
         LEFT PANEL — Login Form
    ══════════════════════════════════════════ --}}
    <div class="al-left">
        <div class="al-form-wrap">

            {{-- Logo --}}
            <a href="/" class="al-logo">
                <div class="al-logo__icon">
                    <i class="bi bi-briefcase-fill"></i>
                    <span class="al-logo__ring"></span>
                </div>
                <div class="al-logo__text">
                    <span class="al-logo__brand">Job<em>za</em> <span class="al-logo__admin">Admin</span></span>
                    <span class="al-logo__tagline">Internal System · Secured Access</span>
                </div>
            </a>

            {{-- Heading --}}
            <div class="al-heading">
                <div class="al-heading__eyebrow">
                    <span class="al-eyebrow-dot"></span>
                    Portal Admin
                </div>
                <h1 class="al-heading__title">Selamat Datang<br><span class="al-heading__grad">Kembali</span></h1>
                <p class="al-heading__sub">Kelola lowongan, lamaran, dan proyek freelance dari satu dashboard.</p>
            </div>

            {{-- Form --}}
            <form wire:submit.prevent="login" class="al-form" autocomplete="off">

                {{-- Email --}}
                <div class="al-field">
                    <label class="al-label">Alamat Email</label>
                    <div class="al-input-wrap">
                        <i class="bi bi-envelope al-input-icon"></i>
                        <input type="email" wire:model="email"
                            class="al-input @error('email') al-input--error @enderror"
                            placeholder="admin@jobza.com">
                    </div>
                    @error('email')
                        <span class="al-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="al-field">
                    <div class="al-field__header">
                        <label class="al-label">Kata Sandi</label>
                        <a href="#" class="al-forgot">Lupa Sandi?</a>
                    </div>
                    <div class="al-input-wrap" x-data="{ show: false }">
                        <i class="bi bi-shield-lock al-input-icon"></i>
                        <input :type="show ? 'text' : 'password'" wire:model="password"
                            class="al-input @error('password') al-input--error @enderror"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="al-pw-toggle">
                            <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="al-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="al-remember">
                    <label class="al-checkbox" for="rememberMe">
                        <input type="checkbox" wire:model="remember" id="rememberMe" class="al-checkbox__input">
                        <span class="al-checkbox__box"><i class="bi bi-check2"></i></span>
                        <span class="al-checkbox__label">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="al-submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <i class="bi bi-box-arrow-in-right al-submit__icon"></i>
                        Masuk ke Dashboard
                        <i class="bi bi-arrow-right al-submit__arrow"></i>
                    </span>
                    <span wire:loading class="al-submit__loading">
                        <span class="al-spinner"></span>
                        Memverifikasi akses...
                    </span>
                </button>

            </form>

            {{-- Divider --}}
            <div class="al-divider">
                <span></span>
                <p>atau</p>
                <span></span>
            </div>

            {{-- WhatsApp support --}}
            <a href="https://wa.me/628989212699?text=Halo%20Superadmin%20Jobza%2C%20saya%20membutuhkan%20akses%20ke%20halaman%20panel%20admin%20Jobza.%20Mohon%20bantuannya%20untuk%20proses%20verifikasi%20dan%20aktivasi%20akun%20saya.%20Terima%20kasih!" target="_blank" class="al-wa-card">
    <div class="al-wa-card__icon">
        <i class="bi bi-whatsapp"></i>
    </div>
    <div class="al-wa-card__body">
        <p class="al-wa-card__title">Butuh akses admin?</p>
        <p class="al-wa-card__sub">Hubungi Superadmin via WhatsApp</p>
    </div>
    <i class="bi bi-chevron-right al-wa-card__arrow"></i>
</a>

            {{-- Register link --}}
            <p class="al-register-link">
                Belum terdaftar sebagai tim?
                <a href="{{ route('register') }}">Daftar sebagai Admin</a>
            </p>

            {{-- Footer --}}
            <p class="al-footer-copy">© 2026 Jobza Inc. Hak cipta dilindungi.</p>

        </div>
    </div>

    {{-- ══════════════════════════════════════════
         RIGHT PANEL — Visual
    ══════════════════════════════════════════ --}}
    <div class="al-right">

        {{-- Background blobs --}}
        <div class="al-blob al-blob--1"></div>
        <div class="al-blob al-blob--2"></div>
        <div class="al-blob al-blob--3"></div>
        <div class="al-grid-dots"></div>

        {{-- Floating cards --}}
        <div class="al-float al-float--tl">
            <div class="al-float__icon al-float__icon--indigo"><i class="bi bi-shield-fill-check"></i></div>
            <div>
                <p class="al-float__num">100%</p>
                <p class="al-float__label">Terenkripsi</p>
            </div>
        </div>

        <div class="al-float al-float--br">
            <div class="al-float__icon al-float__icon--emerald"><i class="bi bi-graph-up-arrow"></i></div>
            <div>
                <p class="al-float__num">500+</p>
                <p class="al-float__label">Perusahaan Aktif</p>
            </div>
        </div>

        {{-- Main hero --}}
        <div class="al-right__content">

            {{-- Admin badge --}}
            <div class="al-admin-badge">
                <div class="al-admin-badge__dot"></div>
                <span>Akses Admin Panel · Aman &amp; Terproteksi</span>
            </div>

            {{-- Main title --}}
            <h2 class="al-right__title">
                Gerbang Menuju<br>
                <span class="al-right__title-grad">Karir Profesional.</span>
            </h2>
            <p class="al-right__sub">
                Platform terintegrasi untuk mengelola lowongan kerja, freelance, dan video reels dalam satu sistem admin yang powerful.
            </p>

            {{-- Testimonial card --}}
            <div class="al-testimonial">
                <div class="al-testimonial__quote"><i class="bi bi-quote"></i></div>
                <p class="al-testimonial__text">
                    "Jobza membantu saya menemukan transisi dari pekerjaan tetap ke proyek freelance dengan sangat mulus dan profesional."
                </p>
                <div class="al-testimonial__author">
                    <div class="al-testimonial__avatar">BK</div>
                    <div>
                        <p class="al-testimonial__name">Budi Kurniawan</p>
                        <p class="al-testimonial__role">Senior Developer · Jakarta</p>
                    </div>
                    <div class="al-testimonial__stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
                <div class="al-testimonial__rating">
                    <span class="al-rating-score">4.9</span>
                    <span class="al-rating-label">/ 5 dari 20K Pengguna</span>
                </div>
            </div>

            {{-- Feature pills --}}
            <div class="al-pills">
                <span class="al-pill"><i class="bi bi-check2-circle al-pill__icon al-pill__icon--blue"></i>Verified Jobs</span>
                <span class="al-pill"><i class="bi bi-lightning-charge-fill al-pill__icon al-pill__icon--amber"></i>Instant Apply</span>
                <span class="al-pill"><i class="bi bi-lock-fill al-pill__icon al-pill__icon--green"></i>Secure System</span>
            </div>

        </div>
    </div>

{{-- ══════════════════════════════════════════ STYLES ══════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap');

:root {
    --al-accent:        #4361ee;
    --al-accent-dark:   #2b45c8;
    --al-accent-light:  #eef1ff;
    --al-accent-glow:   rgba(67,97,238,.25);

    --al-bg-left:       #f9faff;
    --al-bg-right:      #05071a;
    --al-white:         #ffffff;
    --al-border:        #e3e8f8;
    --al-border-focus:  #4361ee;

    --al-red:           #ef4444;
    --al-red-light:     #fef2f2;
    --al-green:         #10b981;
    --al-green-light:   #ecfdf5;
    --al-amber:         #f59e0b;
    --al-indigo:        #6366f1;
    --al-emerald:       #10b981;

    --al-text-h:  #080d2a;
    --al-text-b:  #28304e;
    --al-text-m:  #60697e;
    --al-text-l:  #98a3bc;

    --al-shadow-sm:     0 1px 4px rgba(0,0,0,.06);
    --al-shadow-md:     0 4px 24px rgba(0,0,0,.08);
    --al-shadow-lg:     0 16px 50px rgba(0,0,0,.13);
    --al-shadow-accent: 0 10px 32px rgba(67,97,238,.38);

    --al-r-sm: 10px;
    --al-r-md: 14px;
    --al-r-lg: 20px;
    --al-r-xl: 26px;

    --font-h: 'Plus Jakarta Sans', sans-serif;
    --font-b: 'DM Sans', sans-serif;
}

/* ─── ROOT ───────────────────────────────── */
.al-root {
    display: flex;
    min-height: 100vh;
    font-family: var(--font-b);
}

/* ─── LEFT PANEL ─────────────────────────── */
.al-left {
    flex: 0 0 460px;
    background: var(--al-bg-left);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 28px;
    border-right: 1px solid var(--al-border);
    position: relative;
    z-index: 2;
}
@media (max-width: 960px) {
    .al-root  { flex-direction: column; }
    .al-left  { flex: none; width: 100%; border-right: none; border-bottom: 1px solid var(--al-border); }
    .al-right { min-height: 420px; }
}

.al-form-wrap {
    width: 100%;
    max-width: 380px;
    animation: al-fadein .7s ease both;
}
@keyframes al-fadein {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ─── LOGO ───────────────────────────────── */
.al-logo {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    margin-bottom: 40px;
}
.al-logo__icon {
    position: relative;
    width: 46px; height: 46px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--al-accent), var(--al-accent-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.15rem;
    box-shadow: var(--al-shadow-accent);
    flex-shrink: 0;
    transition: transform .3s cubic-bezier(.175,.885,.32,1.275);
}
.al-logo:hover .al-logo__icon { transform: rotate(-8deg) scale(1.1); }
.al-logo__ring {
    position: absolute;
    inset: -3px;
    border-radius: 17px;
    border: 2px dashed rgba(67,97,238,.3);
    animation: al-ring-spin 8s linear infinite;
}
@keyframes al-ring-spin { to { transform: rotate(360deg); } }
.al-logo__text { display: flex; flex-direction: column; gap: 2px; }
.al-logo__brand {
    font-family: var(--font-h);
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--al-text-h);
    letter-spacing: -0.04em;
    line-height: 1;
}
.al-logo__brand em { font-style: normal; color: var(--al-accent); }
.al-logo__admin {
    font-size: 0.75em;
    font-weight: 700;
    color: var(--al-text-m);
    background: var(--al-accent-light);
    padding: 1px 6px;
    border-radius: 5px;
    vertical-align: middle;
    margin-left: 4px;
}
.al-logo__tagline {
    font-size: 0.55rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--al-text-l);
}

/* ─── HEADING ────────────────────────────── */
.al-heading { margin-bottom: 32px; }
.al-heading__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-family: var(--font-h);
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--al-accent);
    margin-bottom: 12px;
}
.al-eyebrow-dot {
    width: 7px; height: 7px;
    background: var(--al-accent);
    border-radius: 50%;
    animation: al-pulse-dot 2s ease-in-out infinite;
}
@keyframes al-pulse-dot {
    0%, 100% { box-shadow: 0 0 0 0 var(--al-accent-glow); }
    50%       { box-shadow: 0 0 0 7px transparent; }
}
.al-heading__title {
    font-family: var(--font-h);
    font-size: 2rem;
    font-weight: 800;
    color: var(--al-text-h);
    letter-spacing: -0.04em;
    line-height: 1.1;
    margin: 0 0 10px;
}
.al-heading__grad {
    background: linear-gradient(120deg, var(--al-accent), #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.al-heading__sub {
    font-size: 0.875rem;
    color: var(--al-text-m);
    margin: 0;
    line-height: 1.6;
}

/* ─── FORM ───────────────────────────────── */
.al-form { display: flex; flex-direction: column; gap: 18px; }

.al-field { display: flex; flex-direction: column; gap: 7px; }
.al-field__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.al-label {
    font-family: var(--font-h);
    font-size: 0.73rem;
    font-weight: 600;
    color: var(--al-text-b);
}
.al-forgot {
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--al-accent);
    text-decoration: none;
    transition: opacity .2s;
}
.al-forgot:hover { opacity: .7; }

.al-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.al-input-icon {
    position: absolute;
    left: 14px;
    color: var(--al-text-l);
    font-size: 0.9rem;
    pointer-events: none;
    z-index: 1;
    transition: color .2s;
}
.al-input {
    width: 100%;
    padding: 12px 16px 12px 41px;
    border: 1.5px solid var(--al-border);
    border-radius: var(--al-r-md);
    font-family: var(--font-b);
    font-size: 0.875rem;
    color: var(--al-text-h);
    background: var(--al-white);
    transition: border-color .2s, box-shadow .2s, background .2s;
    outline: none;
    font-weight: 500;
}
.al-input:focus {
    border-color: var(--al-border-focus);
    box-shadow: 0 0 0 3px var(--al-accent-glow);
    background: var(--al-accent-light);
}
.al-input-wrap:focus-within .al-input-icon { color: var(--al-accent); }
.al-input::placeholder { color: var(--al-text-l); font-weight: 400; }
.al-input--error {
    border-color: var(--al-red) !important;
    background: var(--al-red-light) !important;
}
.al-error {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--al-red);
}

/* ─── REMEMBER CHECKBOX ──────────────────── */
.al-remember { margin-top: -4px; }
.al-checkbox {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
}
.al-checkbox__input { display: none; }
.al-checkbox__box {
    width: 20px; height: 20px;
    border-radius: 6px;
    border: 1.5px solid var(--al-border);
    background: var(--al-white);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all .2s;
    color: white;
    font-size: 0.75rem;
}
.al-checkbox__box i { opacity: 0; transform: scale(.5); transition: all .2s; }
.al-checkbox__input:checked ~ .al-checkbox__box {
    background: var(--al-accent);
    border-color: var(--al-accent);
    box-shadow: 0 3px 10px var(--al-accent-glow);
}
.al-checkbox__input:checked ~ .al-checkbox__box i { opacity: 1; transform: scale(1); }
.al-checkbox__label {
    font-size: 0.8rem;
    color: var(--al-text-m);
    font-weight: 500;
}

/* ─── SUBMIT ─────────────────────────────── */
.al-submit {
    width: 100%;
    padding: 14px 20px;
    background: linear-gradient(135deg, var(--al-accent) 0%, var(--al-accent-dark) 100%);
    color: white;
    border: none;
    border-radius: var(--al-r-lg);
    font-family: var(--font-h);
    font-size: 0.875rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: var(--al-shadow-accent);
    transition: all .25s cubic-bezier(.4,0,.2,1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}
.al-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,.13) 50%, transparent 100%);
    transform: translateX(-100%);
    transition: transform .55s ease;
}
.al-submit:hover::before { transform: translateX(100%); }
.al-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 44px rgba(67,97,238,.45);
}
.al-submit:active  { transform: translateY(0); }
.al-submit:disabled { opacity: .7; cursor: not-allowed; transform: none; }
.al-submit__icon  { font-size: 1rem; }
.al-submit__arrow { transition: transform .2s; font-size: 1rem; }
.al-submit:hover .al-submit__arrow { transform: translateX(5px); }
.al-submit__loading {
    display: flex;
    align-items: center;
    gap: 10px;
}
.al-spinner {
    display: inline-block;
    width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: white;
    border-radius: 50%;
    animation: al-spin .6s linear infinite;
}
@keyframes al-spin { to { transform: rotate(360deg); } }

/* ─── PASSWORD TOGGLE ────────────────────── */
.al-pw-toggle {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: var(--al-text-l);
    font-size: 1.05rem;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    transition: color .2s;
}
.al-pw-toggle:hover { color: var(--al-accent); }
.al-input-wrap .al-input {
    padding-right: 42px;
}

/* ─── DIVIDER ────────────────────────────── */
.al-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 8px 0;
}
.al-divider span {
    flex: 1;
    height: 1px;
    background: var(--al-border);
}
.al-divider p {
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--al-text-l);
    margin: 0;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

/* ─── WHATSAPP CARD ──────────────────────── */
.al-wa-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: var(--al-green-light);
    border: 1.5px solid rgba(16,185,129,.2);
    border-radius: var(--al-r-lg);
    text-decoration: none;
    transition: all .2s;
}
.al-wa-card:hover {
    background: #d1fae5;
    border-color: rgba(16,185,129,.4);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(16,185,129,.15);
}
.al-wa-card__icon {
    width: 40px; height: 40px;
    border-radius: 12px;
    background: #22c55e;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.15rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(34,197,94,.3);
}
.al-wa-card__body { flex: 1; }
.al-wa-card__title {
    font-family: var(--font-h);
    font-size: 0.8rem;
    font-weight: 700;
    color: #065f46;
    margin: 0 0 2px;
}
.al-wa-card__sub {
    font-size: 0.7rem;
    color: #059669;
    margin: 0;
}
.al-wa-card__arrow {
    color: #10b981;
    font-size: 0.75rem;
    transition: transform .2s;
}
.al-wa-card:hover .al-wa-card__arrow { transform: translateX(3px); }

/* ─── LINKS & FOOTER ─────────────────────── */
.al-register-link {
    text-align: center;
    font-size: 0.8rem;
    color: var(--al-text-m);
    margin-top: 16px;
    margin-bottom: 0;
}
.al-register-link a {
    color: var(--al-accent);
    font-weight: 700;
    text-decoration: none;
    border-bottom: 1.5px solid transparent;
    transition: border-color .2s;
}
.al-register-link a:hover { border-color: var(--al-accent); }
.al-footer-copy {
    text-align: center;
    font-size: 0.65rem;
    color: var(--al-text-l);
    margin-top: 24px;
    margin-bottom: 0;
    letter-spacing: 0.03em;
}

/* ─── RIGHT PANEL ────────────────────────── */
.al-right {
    flex: 1;
    background: var(--al-bg-right);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Blobs */
.al-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
    pointer-events: none;
}
.al-blob--1 {
    width: 600px; height: 600px;
    top: -140px; right: -100px;
    background: radial-gradient(circle, rgba(67,97,238,.22) 0%, transparent 70%);
    animation: al-drift 9s ease-in-out infinite;
}
.al-blob--2 {
    width: 420px; height: 420px;
    bottom: -80px; left: -80px;
    background: radial-gradient(circle, rgba(129,140,248,.16) 0%, transparent 70%);
    animation: al-drift 12s ease-in-out infinite reverse;
}
.al-blob--3 {
    width: 320px; height: 320px;
    top: 55%; left: 45%;
    transform: translate(-50%, -50%);
    background: radial-gradient(circle, rgba(16,185,129,.08) 0%, transparent 70%);
    animation: al-drift 15s ease-in-out infinite;
}
@keyframes al-drift {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33%       { transform: translate(22px, -18px) scale(1.04); }
    66%       { transform: translate(-12px, 12px) scale(.97); }
}

.al-grid-dots {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle, rgba(255,255,255,.07) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
}

/* Floating cards */
.al-float {
    position: absolute;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: var(--al-r-lg);
    backdrop-filter: blur(14px);
    z-index: 3;
}
.al-float--tl {
    top: 52px; left: 36px;
    animation: al-float-anim 6s ease-in-out infinite;
}
.al-float--br {
    bottom: 68px; right: 32px;
    animation: al-float-anim 7s ease-in-out infinite;
    animation-delay: -3s;
}
@keyframes al-float-anim {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-10px); }
}
.al-float__icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}
.al-float__icon--indigo  { background: rgba(99,102,241,.2);  color: #a5b4fc; }
.al-float__icon--emerald { background: rgba(16,185,129,.2); color: #6ee7b7; }
.al-float__num {
    font-family: var(--font-h);
    font-size: 1rem;
    font-weight: 800;
    color: white;
    margin: 0;
    line-height: 1;
}
.al-float__label {
    font-size: 0.67rem;
    color: rgba(255,255,255,.5);
    margin: 2px 0 0;
    font-weight: 500;
}

/* Right content */
.al-right__content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 48px 36px;
    max-width: 520px;
    width: 100%;
}

/* Admin badge */
.al-admin-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: rgba(67,97,238,.15);
    border: 1px solid rgba(67,97,238,.3);
    border-radius: 100px;
    font-size: 0.68rem;
    font-weight: 700;
    color: #818cf8;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    margin-bottom: 22px;
}
.al-admin-badge__dot {
    width: 7px; height: 7px;
    background: #818cf8;
    border-radius: 50%;
    animation: al-pulse-dot 2s ease-in-out infinite;
}
@keyframes al-pulse-dot {
    0%, 100% { box-shadow: 0 0 0 0 rgba(129,140,248,.6); }
    50%       { box-shadow: 0 0 0 6px rgba(129,140,248,0); }
}

/* Hero title */
.al-right__title {
    font-family: var(--font-h);
    font-size: 2.7rem;
    font-weight: 800;
    color: white;
    letter-spacing: -0.05em;
    line-height: 1.08;
    margin: 0 0 16px;
}
.al-right__title-grad {
    background: linear-gradient(120deg, #818cf8 0%, #67e8f9 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.al-right__sub {
    font-size: 0.88rem;
    color: rgba(255,255,255,.48);
    max-width: 380px;
    margin: 0 auto 28px;
    line-height: 1.68;
}

/* Testimonial */
.al-testimonial {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: var(--al-r-xl);
    padding: 24px;
    backdrop-filter: blur(12px);
    margin-bottom: 24px;
    text-align: left;
}
.al-testimonial__quote {
    font-size: 1.5rem;
    color: var(--al-accent);
    opacity: .7;
    line-height: 1;
    margin-bottom: 10px;
}
.al-testimonial__text {
    font-size: 0.85rem;
    color: rgba(255,255,255,.75);
    line-height: 1.65;
    margin: 0 0 18px;
    font-style: italic;
}
.al-testimonial__author {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}
.al-testimonial__avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--al-accent), #818cf8);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-h);
    font-size: 0.7rem;
    font-weight: 800;
    color: white;
    flex-shrink: 0;
}
.al-testimonial__name {
    font-family: var(--font-h);
    font-size: 0.82rem;
    font-weight: 700;
    color: white;
    margin: 0 0 2px;
}
.al-testimonial__role {
    font-size: 0.68rem;
    color: rgba(255,255,255,.45);
    margin: 0;
}
.al-testimonial__stars {
    margin-left: auto;
    color: var(--al-amber);
    font-size: 0.65rem;
    display: flex;
    gap: 2px;
}
.al-testimonial__rating {
    padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,.08);
    display: flex;
    align-items: baseline;
    gap: 6px;
}
.al-rating-score {
    font-family: var(--font-h);
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
    letter-spacing: -0.04em;
}
.al-rating-label {
    font-size: 0.72rem;
    color: rgba(255,255,255,.4);
}

/* Pills */
.al-pills {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}
.al-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 16px;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 100px;
    font-size: 0.74rem;
    font-weight: 600;
    color: rgba(255,255,255,.75);
    transition: all .2s;
    cursor: default;
}
.al-pill:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.2); }
.al-pill__icon { font-size: 0.78rem; }
.al-pill__icon--blue  { color: #60a5fa; }
.al-pill__icon--amber { color: #fbbf24; }
.al-pill__icon--green { color: #34d399; }
</style>
</div>

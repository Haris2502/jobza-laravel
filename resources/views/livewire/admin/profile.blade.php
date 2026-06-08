<div class="profile-settings-wrapper">

    {{-- Header --}}
    <div class="ps-header mb-5">
        <div class="ps-header__eyebrow">
            <span class="ps-eyebrow-dot"></span>
            <span>Pengaturan Akun</span>
        </div>
        <h1 class="ps-header__title">Profil & Perusahaan</h1>
        <p class="ps-header__subtitle">Kelola identitas akun admin, berkas logo, dan informasi detail perusahaan penyedia loker.</p>
    </div>

    {{-- Flash Messages --}}
    @if (session()->has('profile_warning'))
        <div class="ps-alert ps-alert--warning mb-4" role="alert">
            <div class="ps-alert__icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="ps-alert__body">
                <span class="ps-alert__label">Perhatian</span>
                <p class="ps-alert__text">{{ session('profile_warning') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('profile_message'))
        <div class="ps-alert ps-alert--success mb-4" role="alert">
            <div class="ps-alert__icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="ps-alert__body">
                <span class="ps-alert__label">Berhasil</span>
                <p class="ps-alert__text">{{ session('profile_message') }}</p>
            </div>
        </div>
    @endif

    <div class="ps-grid">

        {{-- ==================== MAIN FORM CARD ==================== --}}
        <div class="ps-main-col">
            <div class="ps-card ps-card--main">

                {{-- Company Identity Header --}}
                <div class="ps-identity">
                    <div class="ps-identity__logo-wrap">
                        @if ($company_logo)
                            <img src="{{ $company_logo->temporaryUrl() }}" class="ps-identity__logo" alt="Logo Preview">
                        @elseif ($existing_company_logo)
                            <img src="{{ asset('storage/' . $existing_company_logo) }}" class="ps-identity__logo" alt="Logo Perusahaan">
                        @else
                            <div class="ps-identity__avatar">
                                {{ substr($company_name ?? $name, 0, 2) }}
                            </div>
                        @endif
                        <div class="ps-identity__logo-badge">
                            <i class="bi bi-building-fill"></i>
                        </div>
                    </div>
                    <div class="ps-identity__info">
                        <h2 class="ps-identity__company">{{ $company_name ?? 'Nama Perusahaan Belum Diatur' }}</h2>
                        <p class="ps-identity__admin">
                            <span class="ps-badge-admin">
                                <i class="bi bi-shield-fill-check me-1"></i> Super Admin
                            </span>
                            {{ $name }}
                        </p>
                    </div>
                </div>

                <form wire:submit.prevent="updateProfile">

                    {{-- Section A --}}
                    <div class="ps-section">
                        <div class="ps-section__label">
                            <span class="ps-section__num">A</span>
                            <span>Informasi Login Admin</span>
                        </div>
                        <div class="ps-form-grid">
                            <div class="ps-field">
                                <label class="ps-label">Nama Lengkap Admin</label>
                                <div class="ps-input-wrap">
                                    <i class="bi bi-person ps-input-icon"></i>
                                    <input type="text" wire:model="name"
                                        class="ps-input @error('name') ps-input--error @enderror"
                                        placeholder="Nama lengkap Anda">
                                </div>
                                @error('name')
                                    <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="ps-field">
                                <label class="ps-label">Email Utama</label>
                                <div class="ps-input-wrap">
                                    <i class="bi bi-envelope ps-input-icon"></i>
                                    <input type="email" wire:model="email"
                                        class="ps-input @error('email') ps-input--error @enderror"
                                        placeholder="email@perusahaan.com">
                                </div>
                                @error('email')
                                    <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section B --}}
                    <div class="ps-section">
                        <div class="ps-section__label">
                            <span class="ps-section__num">B</span>
                            <span>Legalitas & Profil Perusahaan</span>
                        </div>
                        <div class="ps-form-grid">
                            <div class="ps-field">
                                <label class="ps-label">Nama Perusahaan</label>
                                <div class="ps-input-wrap">
                                    <i class="bi bi-building ps-input-icon"></i>
                                    <input type="text" wire:model="company_name"
                                        class="ps-input @error('company_name') ps-input--error @enderror"
                                        placeholder="PT Perusahaan Anda">
                                </div>
                                @error('company_name')
                                    <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="ps-field">
                                <label class="ps-label">Jenis Industri</label>
                                <div class="ps-input-wrap">
                                    <i class="bi bi-tags ps-input-icon"></i>
                                    <input type="text" wire:model="industry_type"
                                        class="ps-input @error('industry_type') ps-input--error @enderror"
                                        placeholder="Teknologi, Finansial, Edukasi">
                                </div>
                                @error('industry_type')
                                    <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="ps-field mt-3">
                            <label class="ps-label">Website Perusahaan</label>
                            <div class="ps-input-wrap ps-input-wrap--addon">
                                <span class="ps-input-addon">https://</span>
                                <input type="text" wire:model="company_website"
                                    class="ps-input ps-input--with-addon @error('company_website') ps-input--error @enderror"
                                    placeholder="www.perusahaananda.com">
                                <i class="bi bi-globe ps-input-icon-right"></i>
                            </div>
                            @error('company_website')
                                <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ps-field mt-3">
                            <label class="ps-label">Logo Perusahaan</label>
                            <label class="ps-upload" for="uploadLogo">
                                <div class="ps-upload__icon">
                                    <i class="bi bi-cloud-arrow-up-fill"></i>
                                </div>
                                <div class="ps-upload__text">
                                    <span class="ps-upload__cta">Klik untuk unggah logo</span>
                                    <span class="ps-upload__hint">PNG, JPG, JPEG — maksimal 2 MB</span>
                                </div>
                                <input type="file" wire:model="company_logo" id="uploadLogo"
                                    class="ps-upload__input @error('company_logo') ps-input--error @enderror">
                            </label>
                            <div wire:loading wire:target="company_logo" class="ps-upload-progress">
                                <div class="ps-upload-progress__bar"></div>
                                <span>Mengunggah logo...</span>
                            </div>
                            @error('company_logo')
                                <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ps-field mt-3">
                            <label class="ps-label">Deskripsi Perusahaan</label>
                            <textarea wire:model="company_description" rows="4"
                                class="ps-input ps-textarea @error('company_description') ps-input--error @enderror"
                                placeholder="Tuliskan visi, misi, atau ringkasan profil perusahaan secara detail..."></textarea>
                            @error('company_description')
                                <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ps-field mt-3">
                            <label class="ps-label">Alamat Kantor Utama</label>
                            <div class="ps-input-wrap">
                                <i class="bi bi-geo-alt ps-input-icon ps-input-icon--top"></i>
                                <textarea wire:model="office_address" rows="2"
                                    class="ps-input ps-textarea ps-textarea--padded @error('office_address') ps-input--error @enderror"
                                    placeholder="Jl. Jenderal Sudirman No. 10, Jakarta Selatan"></textarea>
                            </div>
                            @error('office_address')
                                <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="ps-form-footer">
                        <p class="ps-form-footer__note">
                            <i class="bi bi-info-circle me-1"></i>
                            Semua perubahan akan disimpan secara permanen.
                        </p>
                        <button type="submit" class="ps-btn ps-btn--primary">
                            <span wire:loading.remove wire:target="updateProfile, company_logo">
                                <i class="bi bi-save2 me-2"></i>Simpan Perubahan
                            </span>
                            <span wire:loading wire:target="updateProfile">
                                <span class="ps-spinner me-2"></span> Menyimpan...
                            </span>
                            <span wire:loading wire:target="company_logo">
                                <span class="ps-spinner me-2"></span> Mengunggah Logo...
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- ==================== SIDEBAR CARD ==================== --}}
        <div class="ps-side-col">

            {{-- Password Card --}}
            <div class="ps-card ps-card--danger">
                <div class="ps-card__danger-strip"></div>

                <div class="ps-security-header">
                    <div class="ps-security-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <div>
                        <h3 class="ps-card__title">Keamanan Kata Sandi</h3>
                        <p class="ps-card__subtitle">Perbarui sandi secara rutin untuk menjaga keamanan aset data.</p>
                    </div>
                </div>

                @if (session()->has('password_message'))
                    <div class="ps-alert ps-alert--success ps-alert--sm mb-4" role="alert">
                        <i class="bi bi-shield-check"></i>
                        <span>{{ session('password_message') }}</span>
                    </div>
                @endif

                <form wire:submit.prevent="updatePassword">
                    <div class="ps-field mb-3">
                        <label class="ps-label">Password Saat Ini</label>
                        <div class="ps-input-wrap">
                            <i class="bi bi-lock ps-input-icon"></i>
                            <input type="password" wire:model="current_password"
                                class="ps-input @error('current_password') ps-input--error @enderror"
                                placeholder="••••••••">
                        </div>
                        @error('current_password')
                            <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ps-field mb-3">
                        <label class="ps-label">Password Baru</label>
                        <div class="ps-input-wrap">
                            <i class="bi bi-key ps-input-icon"></i>
                            <input type="password" wire:model="new_password"
                                class="ps-input @error('new_password') ps-input--error @enderror"
                                placeholder="Minimal 8 karakter">
                        </div>
                        @error('new_password')
                            <span class="ps-error"><i class="bi bi-x-circle me-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ps-field mb-4">
                        <label class="ps-label">Konfirmasi Password Baru</label>
                        <div class="ps-input-wrap">
                            <i class="bi bi-key-fill ps-input-icon"></i>
                            <input type="password" wire:model="new_password_confirmation"
                                class="ps-input"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <button type="submit" class="ps-btn ps-btn--danger w-100">
                        <span wire:loading.remove wire:target="updatePassword">
                            <i class="bi bi-arrow-repeat me-2"></i>Perbarui Password
                        </span>
                        <span wire:loading wire:target="updatePassword">
                            <span class="ps-spinner me-2"></span> Memproses...
                        </span>
                    </button>
                </form>

                {{-- Security Tips --}}
                <div class="ps-security-tips mt-4">
                    <p class="ps-security-tips__title"><i class="bi bi-lightbulb-fill me-1"></i> Tips Keamanan</p>
                    <ul class="ps-security-tips__list">
                        <li>Gunakan minimal 8 karakter</li>
                        <li>Kombinasikan huruf besar & angka</li>
                        <li>Hindari kata yang mudah ditebak</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

{{-- ==================== STYLES ==================== --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap');

    :root {
        --ps-bg: #f4f6fb;
        --ps-white: #ffffff;
        --ps-border: #e8ecf4;
        --ps-border-focus: #3f6ef2;

        --ps-blue-50:  #eff3ff;
        --ps-blue-100: #dce5fd;
        --ps-blue-500: #3f6ef2;
        --ps-blue-600: #2f5cd4;
        --ps-blue-700: #1e40af;

        --ps-red-50:  #fff1f2;
        --ps-red-100: #ffe0e2;
        --ps-red-500: #ef4444;
        --ps-red-600: #dc2626;

        --ps-green-50:  #f0fdf4;
        --ps-green-500: #22c55e;

        --ps-amber-50:  #fffbeb;
        --ps-amber-500: #f59e0b;

        --ps-text-heading: #111827;
        --ps-text-body:    #374151;
        --ps-text-muted:   #6b7280;
        --ps-text-light:   #9ca3af;

        --ps-radius-sm:  8px;
        --ps-radius-md:  14px;
        --ps-radius-lg:  20px;
        --ps-radius-xl:  28px;

        --ps-shadow-sm:  0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        --ps-shadow-md:  0 4px 16px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
        --ps-shadow-lg:  0 12px 40px rgba(0,0,0,.10), 0 4px 12px rgba(0,0,0,.05);

        --font-heading: 'Plus Jakarta Sans', sans-serif;
        --font-body:    'DM Sans', sans-serif;
    }

    .profile-settings-wrapper {
        font-family: var(--font-body);
        color: var(--ps-text-body);
    }

    /* ─── HEADER ─────────────────────────────── */
    .ps-header {
        position: relative;
    }
    .ps-header__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-heading);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--ps-blue-500);
        margin-bottom: 10px;
    }
    .ps-eyebrow-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--ps-blue-500);
        display: inline-block;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 0 0 rgba(63,110,242,.5); }
        50%       { box-shadow: 0 0 0 6px rgba(63,110,242,0); }
    }
    .ps-header__title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 800;
        color: var(--ps-text-heading);
        line-height: 1.15;
        margin: 0 0 8px;
        letter-spacing: -0.03em;
    }
    .ps-header__subtitle {
        font-size: 0.875rem;
        color: var(--ps-text-muted);
        margin: 0;
        max-width: 520px;
    }

    /* ─── GRID ───────────────────────────────── */
    .ps-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 1100px) {
        .ps-grid { grid-template-columns: 1fr; }
        .ps-header__title { font-size: 1.5rem; }
    }

    /* ─── CARDS ──────────────────────────────── */
    .ps-card {
        background: var(--ps-white);
        border-radius: var(--ps-radius-xl);
        box-shadow: var(--ps-shadow-md);
        border: 1px solid var(--ps-border);
        overflow: hidden;
        padding: 32px;
        transition: box-shadow .3s ease;
    }
    .ps-card:hover { box-shadow: var(--ps-shadow-lg); }
    .ps-card--main { padding: 36px; }
    .ps-card--danger { position: relative; padding-top: 36px; }
    .ps-card__danger-strip {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--ps-red-500), #f97316);
    }

    /* ─── COMPANY IDENTITY ───────────────────── */
    .ps-identity {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 28px;
        margin-bottom: 28px;
        border-bottom: 1px solid var(--ps-border);
    }
    .ps-identity__logo-wrap {
        position: relative;
        flex-shrink: 0;
    }
    .ps-identity__logo,
    .ps-identity__avatar {
        width: 80px; height: 80px;
        border-radius: var(--ps-radius-md);
        display: block;
        object-fit: cover;
    }
    .ps-identity__avatar {
        background: linear-gradient(135deg, var(--ps-blue-500) 0%, var(--ps-blue-700) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-heading);
        font-size: 1.7rem;
        font-weight: 800;
        color: white;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        box-shadow: 0 8px 24px rgba(63,110,242,.3);
    }
    .ps-identity__logo-badge {
        position: absolute;
        bottom: -4px; right: -4px;
        width: 24px; height: 24px;
        border-radius: 50%;
        background: var(--ps-blue-500);
        border: 2px solid var(--ps-white);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.6rem;
    }
    .ps-identity__company {
        font-family: var(--font-heading);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--ps-text-heading);
        margin: 0 0 6px;
        letter-spacing: -0.01em;
    }
    .ps-identity__admin {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        color: var(--ps-text-muted);
        margin: 0;
    }
    .ps-badge-admin {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 100px;
        background: var(--ps-blue-50);
        color: var(--ps-blue-600);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    /* ─── SECTIONS ───────────────────────────── */
    .ps-section {
        margin-bottom: 8px;
    }
    .ps-section__label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-heading);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ps-text-muted);
        margin-bottom: 18px;
        padding: 6px 12px;
        background: var(--ps-bg);
        border-radius: 100px;
        border: 1px solid var(--ps-border);
    }
    .ps-section__num {
        width: 20px; height: 20px;
        border-radius: 50%;
        background: var(--ps-blue-500);
        color: white;
        font-size: 0.65rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ─── FORM GRID ──────────────────────────── */
    .ps-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 640px) {
        .ps-form-grid { grid-template-columns: 1fr; }
    }

    /* ─── FIELDS ─────────────────────────────── */
    .ps-field { display: flex; flex-direction: column; }
    .ps-label {
        font-family: var(--font-heading);
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--ps-text-body);
        margin-bottom: 7px;
        letter-spacing: 0.01em;
    }
    .ps-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .ps-input-wrap--addon {
        /* handled below */
    }
    .ps-input-icon {
        position: absolute;
        left: 14px;
        color: var(--ps-text-light);
        font-size: 0.9rem;
        pointer-events: none;
        z-index: 1;
    }
    .ps-input-icon--top {
        top: 13px;
        align-self: flex-start;
    }
    .ps-input-icon-right {
        position: absolute;
        right: 14px;
        color: var(--ps-text-light);
        font-size: 0.9rem;
        pointer-events: none;
    }
    .ps-input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1.5px solid var(--ps-border);
        border-radius: var(--ps-radius-sm);
        font-family: var(--font-body);
        font-size: 0.875rem;
        color: var(--ps-text-heading);
        background: var(--ps-white);
        transition: border-color .2s, box-shadow .2s, background .2s;
        outline: none;
        appearance: none;
    }
    .ps-input:focus {
        border-color: var(--ps-blue-500);
        box-shadow: 0 0 0 3px rgba(63,110,242,.12);
        background: var(--ps-blue-50);
    }
    .ps-input::placeholder { color: var(--ps-text-light); }
    .ps-input--error {
        border-color: var(--ps-red-500) !important;
        background: var(--ps-red-50) !important;
    }
    .ps-input--error:focus {
        box-shadow: 0 0 0 3px rgba(239,68,68,.12) !important;
    }
    .ps-textarea {
        padding: 12px 14px;
        resize: vertical;
        min-height: 80px;
    }
    .ps-textarea--padded { padding-left: 38px; }

    /* Input with addon */
    .ps-input-addon {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        background: var(--ps-bg);
        border: 1.5px solid var(--ps-border);
        border-right: none;
        border-radius: var(--ps-radius-sm) 0 0 var(--ps-radius-sm);
        font-size: 0.8rem;
        color: var(--ps-text-muted);
        font-family: var(--font-body);
        white-space: nowrap;
        flex-shrink: 0;
    }
    .ps-input--with-addon {
        padding-left: 12px;
        border-radius: 0 var(--ps-radius-sm) var(--ps-radius-sm) 0;
        flex: 1;
    }

    /* ─── ERROR ──────────────────────────────── */
    .ps-error {
        display: flex;
        align-items: center;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--ps-red-500);
        margin-top: 5px;
    }

    /* ─── UPLOAD ─────────────────────────────── */
    .ps-upload {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border: 2px dashed var(--ps-border);
        border-radius: var(--ps-radius-md);
        cursor: pointer;
        background: var(--ps-bg);
        transition: border-color .2s, background .2s;
    }
    .ps-upload:hover {
        border-color: var(--ps-blue-500);
        background: var(--ps-blue-50);
    }
    .ps-upload__icon {
        width: 44px; height: 44px;
        border-radius: var(--ps-radius-sm);
        background: var(--ps-white);
        border: 1.5px solid var(--ps-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--ps-blue-500);
        flex-shrink: 0;
        box-shadow: var(--ps-shadow-sm);
    }
    .ps-upload__text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .ps-upload__cta {
        font-family: var(--font-heading);
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--ps-blue-500);
    }
    .ps-upload__hint {
        font-size: 0.72rem;
        color: var(--ps-text-light);
    }
    .ps-upload__input {
        display: none;
    }
    .ps-upload-progress {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 8px;
        font-size: 0.75rem;
        color: var(--ps-blue-500);
        font-weight: 600;
    }
    .ps-upload-progress__bar {
        flex: 1;
        height: 4px;
        border-radius: 100px;
        background: var(--ps-blue-100);
        overflow: hidden;
        position: relative;
    }
    .ps-upload-progress__bar::after {
        content: '';
        position: absolute;
        inset: 0;
        width: 40%;
        background: var(--ps-blue-500);
        border-radius: 100px;
        animation: progress-slide 1.2s ease-in-out infinite;
    }
    @keyframes progress-slide {
        0%   { transform: translateX(-100%); }
        100% { transform: translateX(300%); }
    }

    /* ─── FORM FOOTER ────────────────────────── */
    .ps-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 24px;
        margin-top: 24px;
        border-top: 1px solid var(--ps-border);
        gap: 16px;
    }
    @media (max-width: 640px) {
        .ps-form-footer { flex-direction: column; align-items: stretch; }
    }
    .ps-form-footer__note {
        font-size: 0.75rem;
        color: var(--ps-text-light);
        margin: 0;
    }

    /* ─── BUTTONS ────────────────────────────── */
    .ps-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 24px;
        border-radius: var(--ps-radius-sm);
        font-family: var(--font-heading);
        font-size: 0.85rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        letter-spacing: 0.01em;
        white-space: nowrap;
    }
    .ps-btn--primary {
        background: linear-gradient(135deg, var(--ps-blue-500) 0%, var(--ps-blue-700) 100%);
        color: white;
        box-shadow: 0 4px 16px rgba(63,110,242,.35);
    }
    .ps-btn--primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(63,110,242,.45);
    }
    .ps-btn--primary:active { transform: translateY(0); }
    .ps-btn--danger {
        background: transparent;
        color: var(--ps-red-500);
        border: 1.5px solid var(--ps-red-100);
        background: var(--ps-red-50);
    }
    .ps-btn--danger:hover {
        background: var(--ps-red-500);
        color: white;
        border-color: var(--ps-red-500);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(239,68,68,.3);
    }
    .w-100 { width: 100%; }

    /* ─── SPINNER ────────────────────────────── */
    .ps-spinner {
        display: inline-block;
        width: 14px; height: 14px;
        border: 2px solid rgba(255,255,255,.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin .7s linear infinite;
        vertical-align: middle;
    }
    .ps-btn--danger .ps-spinner {
        border-color: rgba(239,68,68,.3);
        border-top-color: var(--ps-red-500);
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ─── ALERTS ─────────────────────────────── */
    .ps-alert {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 14px 18px;
        border-radius: var(--ps-radius-md);
    }
    .ps-alert--success {
        background: var(--ps-green-50);
        border: 1px solid rgba(34,197,94,.2);
    }
    .ps-alert--warning {
        background: var(--ps-amber-50);
        border: 1px solid rgba(245,158,11,.2);
    }
    .ps-alert__icon {
        width: 36px; height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .ps-alert--success .ps-alert__icon {
        background: rgba(34,197,94,.15);
        color: var(--ps-green-500);
    }
    .ps-alert--warning .ps-alert__icon {
        background: rgba(245,158,11,.15);
        color: var(--ps-amber-500);
    }
    .ps-alert__body { flex: 1; }
    .ps-alert__label {
        display: block;
        font-family: var(--font-heading);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 2px;
    }
    .ps-alert--success .ps-alert__label { color: #15803d; }
    .ps-alert--warning .ps-alert__label { color: #b45309; }
    .ps-alert__text {
        font-size: 0.84rem;
        margin: 0;
    }
    .ps-alert--success .ps-alert__text { color: #166534; }
    .ps-alert--warning .ps-alert__text { color: #92400e; }
    .ps-alert--sm {
        padding: 10px 14px;
        gap: 10px;
        font-size: 0.8rem;
        border-radius: var(--ps-radius-sm);
        align-items: center;
    }
    .ps-alert--sm i { font-size: 1rem; }
    .ps-alert--success.ps-alert--sm { color: #166534; }

    /* ─── SECURITY HEADER ────────────────────── */
    .ps-security-header {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 24px;
    }
    .ps-security-icon {
        width: 44px; height: 44px;
        border-radius: var(--ps-radius-sm);
        background: var(--ps-red-50);
        border: 1.5px solid var(--ps-red-100);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        color: var(--ps-red-500);
        flex-shrink: 0;
    }
    .ps-card__title {
        font-family: var(--font-heading);
        font-size: 1rem;
        font-weight: 700;
        color: var(--ps-text-heading);
        margin: 0 0 4px;
    }
    .ps-card__subtitle {
        font-size: 0.78rem;
        color: var(--ps-text-muted);
        margin: 0;
        line-height: 1.5;
    }

    /* ─── SECURITY TIPS ──────────────────────── */
    .ps-security-tips {
        padding: 14px 16px;
        background: var(--ps-bg);
        border-radius: var(--ps-radius-md);
        border: 1px solid var(--ps-border);
    }
    .ps-security-tips__title {
        font-family: var(--font-heading);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--ps-text-muted);
        margin: 0 0 10px;
    }
    .ps-security-tips__list {
        list-style: none;
        padding: 0; margin: 0;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }
    .ps-security-tips__list li {
        font-size: 0.78rem;
        color: var(--ps-text-muted);
        padding-left: 16px;
        position: relative;
    }
    .ps-security-tips__list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--ps-green-500);
        font-weight: 700;
        font-size: 0.7rem;
    }
</style>
</div>

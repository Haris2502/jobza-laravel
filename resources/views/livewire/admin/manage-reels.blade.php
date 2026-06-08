<div class="rv-wrapper">

    {{-- ══════════════════════════════════════════
         PAGE HEADER
    ══════════════════════════════════════════ --}}
    <div class="rv-header">
        <div class="rv-header__left">
            <a href="/dashboard" class="rv-back-btn">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <div class="rv-header__meta">
                <div class="rv-header__eyebrow">
                    <i class="bi bi-play-circle-fill rv-eyebrow-icon"></i>
                    <span>Video Reels</span>
                </div>
                <h1 class="rv-header__title">Buat Lowongan <span class="rv-title-highlight">Reels</span></h1>
                <p class="rv-header__sub">Konten video pendek kreatif akan langsung terintegrasi ke aplikasi Jobza User.</p>
            </div>
        </div>
        <div class="rv-header__badge">
            <div class="rv-phone-mockup">
                <div class="rv-phone-mockup__screen">
                    <div class="rv-phone-mockup__reel">
                        <i class="bi bi-play-fill"></i>
                    </div>
                    <div class="rv-phone-mockup__bars">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash message --}}
    @if (session()->has('message'))
        <div class="rv-alert rv-alert--success mb-4" role="alert">
            <div class="rv-alert__icon"><i class="bi bi-check-circle-fill"></i></div>
            <div class="rv-alert__body">
                <span class="rv-alert__label">Berhasil</span>
                <p class="rv-alert__text">{{ session('message') }}</p>
            </div>
            <button type="button" class="rv-alert__close" onclick="this.closest('.rv-alert').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- ══════════════════════════════════════════
         FORM
    ══════════════════════════════════════════ --}}
    <form wire:submit.prevent="save" class="rv-form">
        <div class="rv-layout">

            {{-- ── LEFT COLUMN: info fields ── --}}
            <div class="rv-col-main">

                {{-- Section 1: Identitas --}}
                <div class="rv-section">
                    <div class="rv-section__head">
                        <div class="rv-section__num rv-section__num--red">1</div>
                        <div>
                            <h2 class="rv-section__title">Identitas Konten</h2>
                            <p class="rv-section__desc">Judul, kategori, dan informasi dasar lowongan video.</p>
                        </div>
                    </div>

                    <div class="rv-fields">
                        {{-- Title --}}
                        <div class="rv-field rv-field--full">
                            <label class="rv-label">Judul Lowongan Konten <span class="rv-req">*</span></label>
                            <div class="rv-input-wrap">
                                <i class="bi bi-play-btn rv-input-icon"></i>
                                <input type="text" wire:model="title"
                                    class="rv-input @error('title') rv-input--error @enderror"
                                    placeholder="Contoh: Senior Flutter Developer (Klip Video)">
                            </div>
                            @error('title')<span class="rv-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                        </div>

                        {{-- Category --}}
                        <div class="rv-field">
                            <label class="rv-label">Kategori <span class="rv-req">*</span></label>
                            <div class="rv-input-wrap">
                                <i class="bi bi-collection rv-input-icon"></i>
                                <select wire:model="category"
                                    class="rv-input rv-select @error('category') rv-input--error @enderror">
                                    <option value="">Pilih Kategori</option>
                                    <option value="lowongan">Lowongan Kerja</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                                <i class="bi bi-chevron-down rv-select-arrow"></i>
                            </div>
                            @error('category')<span class="rv-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                        </div>

                        {{-- Salary --}}
                        <div class="rv-field">
                            <label class="rv-label">Gaji (IDR) <span class="rv-req">*</span></label>
                            <div class="rv-input-wrap rv-input-wrap--addon">
                                <span class="rv-input-addon">Rp</span>
                                <input type="text" wire:model="salary"
                                    class="rv-input rv-input--addon @error('salary') rv-input--error @enderror"
                                    placeholder="5.000.000 atau Nego">
                            </div>
                            @error('salary')<span class="rv-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                        </div>

                        {{-- Location --}}
                        <div class="rv-field">
                            <label class="rv-label">
                                <i class="bi bi-geo-alt-fill" style="color:var(--rv-red)"></i>
                                Lokasi (Link Google Maps) <span class="rv-req">*</span>
                            </label>
                            <div class="rv-input-wrap">
                                <i class="bi bi-map rv-input-icon"></i>
                                <input type="url" wire:model="location"
                                    class="rv-input @error('location') rv-input--error @enderror"
                                    placeholder="https://maps.app.goo.gl/xxx">
                            </div>
                            <div class="rv-hint"><i class="bi bi-info-circle me-1"></i>Buka Google Maps → Klik Bagikan → Salin &amp; paste tautan.</div>
                            @error('location')<span class="rv-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div class="rv-field">
                            <label class="rv-label">WhatsApp Admin <span class="rv-req">*</span></label>
                            <div class="rv-input-wrap rv-input-wrap--addon">
                                <span class="rv-input-addon"><i class="bi bi-whatsapp" style="color:#22c55e"></i></span>
                                <input type="text" wire:model="admin_phone"
                                    class="rv-input rv-input--addon @error('admin_phone') rv-input--error @enderror"
                                    placeholder="628123456789">
                            </div>
                            @error('admin_phone')<span class="rv-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                {{-- Section 2: Deskripsi --}}
                <div class="rv-section">
                    <div class="rv-section__head">
                        <div class="rv-section__num rv-section__num--orange">2</div>
                        <div>
                            <h2 class="rv-section__title">Deskripsi Singkat</h2>
                            <p class="rv-section__desc">Kualifikasi atau persyaratan utama yang ditampilkan di video.</p>
                        </div>
                    </div>

                    <div class="rv-field rv-field--full">
                        <label class="rv-label">Isi Deskripsi <span class="rv-req">*</span></label>
                        <textarea wire:model="description" rows="5"
                            class="rv-input rv-textarea @error('description') rv-input--error @enderror"
                            placeholder="Tuliskan requirement atau kualifikasi singkat posisi ini..."></textarea>
                        <div class="rv-char-hint">Tetap singkat &amp; padat — ini akan ditampilkan dalam klip reels.</div>
                        @error('description')<span class="rv-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>{{-- /rv-col-main --}}

            {{-- ── RIGHT COLUMN: media uploads ── --}}
            <div class="rv-col-side">

                {{-- Section 3: Video Upload --}}
                <div class="rv-section rv-section--video">
                    <div class="rv-section__head">
                        <div class="rv-section__num rv-section__num--red">3</div>
                        <div>
                            <h2 class="rv-section__title">File Video Reels</h2>
                            <p class="rv-section__desc">Upload klip video pendek untuk ditampilkan ke pencari kerja.</p>
                        </div>
                    </div>

                    {{-- Video upload zone --}}
                    <label class="rv-video-zone" for="videoUpload">
                        <div class="rv-video-zone__graphic">
                            <div class="rv-video-zone__rings">
                                <span class="rv-ring rv-ring--1"></span>
                                <span class="rv-ring rv-ring--2"></span>
                            </div>
                            <div class="rv-video-zone__play">
                                <i class="bi bi-camera-video-fill"></i>
                            </div>
                        </div>
                        <p class="rv-video-zone__title">Upload Video Reels</p>
                        <p class="rv-video-zone__sub">MP4, MOV, AVI, MKV yang didukung</p>
                        <div class="rv-video-zone__specs">
                            <span><i class="bi bi-phone me-1"></i>Rasio 9:16 ideal</span>
                            <span><i class="bi bi-clock me-1"></i>Durasi panjang ✅</span>
                            <span><i class="bi bi-hdd me-1"></i>Maks. 500MB</span>
                        </div>
                        <span class="rv-video-zone__btn">Pilih Video</span>
                        <input type="file" wire:model="videoFile" id="videoUpload"
                            class="rv-upload-input @error('videoFile') rv-input--error @enderror"
                            accept="video/*">
                    </label>

                    {{-- Video upload loading --}}
                    <div wire:loading wire:target="videoFile" class="rv-uploading">
                        <div class="rv-uploading__bar"></div>
                        <span>Mengunggah berkas video...</span>
                    </div>
                    @error('videoFile')<span class="rv-error mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror

                    {{-- Video ready indicator --}}
                    @if ($videoFile)
                        <div class="rv-file-ready">
                            <div class="rv-file-ready__icon"><i class="bi bi-file-earmark-play-fill"></i></div>
                            <div class="rv-file-ready__info">
                                <span class="rv-file-ready__name">{{ $videoFile->getClientOriginalName() }}</span>
                                <span class="rv-file-ready__size">{{ number_format($videoFile->getSize() / 1048576, 1) }} MB</span>
                            </div>
                            <div class="rv-file-ready__badge"><i class="bi bi-check-circle-fill"></i></div>
                        </div>
                    @endif
                </div>

                {{-- Section 4: Thumbnail --}}
                <div class="rv-section">
                    <div class="rv-section__head">
                        <div class="rv-section__num rv-section__num--purple">4</div>
                        <div>
                            <h2 class="rv-section__title">Cover / Preview</h2>
                            <p class="rv-section__desc">Gambar thumbnail yang muncul sebelum video diputar.</p>
                        </div>
                    </div>

                    @if ($thumbnailFile)
                        <div class="rv-thumb-preview">
                            <img src="{{ $thumbnailFile->temporaryUrl() }}" alt="Thumbnail preview" class="rv-thumb-preview__img">
                            <div class="rv-thumb-preview__overlay">
                                <div class="rv-thumb-preview__play"><i class="bi bi-play-fill"></i></div>
                            </div>
                            <div class="rv-thumb-preview__badge"><i class="bi bi-check-circle-fill me-1"></i>Cover aktif</div>
                            <button type="button" wire:click="$set('thumbnailFile', null)" class="rv-thumb-remove">
                                <i class="bi bi-trash3-fill me-1"></i>Ganti
                            </button>
                        </div>
                    @else
                        <label class="rv-upload-zone rv-upload-zone--thumb" for="thumbUpload">
                            <div class="rv-upload-zone__icon"><i class="bi bi-image-fill"></i></div>
                            <p class="rv-upload-zone__title">Upload Cover Thumbnail</p>
                            <p class="rv-upload-zone__sub">PNG, JPG · Rasio 9:16 · Maks. 2 MB</p>
                            <span class="rv-upload-zone__btn">Pilih Gambar</span>
                            <input type="file" wire:model="thumbnailFile" id="thumbUpload"
                                class="rv-upload-input @error('thumbnailFile') rv-input--error @enderror"
                                accept="image/*">
                        </label>
                    @endif

                    <div wire:loading wire:target="thumbnailFile" class="rv-uploading">
                        <div class="rv-uploading__bar rv-uploading__bar--purple"></div>
                        <span style="color:var(--rv-purple)">Mengunggah cover...</span>
                    </div>
                    @error('thumbnailFile')<span class="rv-error mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>@enderror
                </div>

            </div>{{-- /rv-col-side --}}

        </div>{{-- /rv-layout --}}

        {{-- ── STICKY SUBMIT BAR ── --}}
        <div class="rv-submit-bar">
            <div class="rv-submit-bar__inner">
                <div class="rv-submit-bar__info">
                    <div class="rv-submit-bar__icon">
                        <i class="bi bi-camera-reels-fill"></i>
                    </div>
                    <div>
                        <p class="rv-submit-bar__title">Siap dipublikasikan?</p>
                        <p class="rv-submit-bar__sub">Video reels akan langsung tayang di Jobza User.</p>
                    </div>
                </div>
                <div class="rv-submit-bar__actions">
                    <a href="/dashboard" class="rv-btn rv-btn--ghost">
                        <i class="bi bi-x me-1"></i> Batal
                    </a>
                    <button type="submit" class="rv-btn rv-btn--publish" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="bi bi-camera-reels-fill me-2"></i>Publish Video Reels
                        </span>
                        <span wire:loading>
                            <span class="rv-spinner me-2"></span>Memproses Media...
                        </span>
                    </button>
                </div>
            </div>
        </div>

    </form>

{{-- ══════════════════════════════════════════ STYLES ══════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@500;600;700&family=Cabinet+Grotesk:wght@400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Figtree:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap');

:root {
    --rv-bg:            #f8f7ff;
    --rv-white:         #ffffff;
    --rv-border:        #e5e3f8;
    --rv-border-focus:  #7c5ef8;

    --rv-red:           #f43f5e;
    --rv-red-dark:      #be123c;
    --rv-red-light:     #fff1f2;
    --rv-red-glow:      rgba(244,63,94,.3);

    --rv-orange:        #f97316;
    --rv-orange-light:  #fff7ed;

    --rv-purple:        #7c5ef8;
    --rv-purple-dark:   #5b3fd9;
    --rv-purple-light:  #f3f0ff;
    --rv-purple-glow:   rgba(124,94,248,.25);

    --rv-green:         #10b981;
    --rv-green-light:   #ecfdf5;

    --rv-text-h:  #0d0a1e;
    --rv-text-b:  #2d2844;
    --rv-text-m:  #6e6a8a;
    --rv-text-l:  #a09cbf;

    --rv-shadow-sm:  0 1px 4px rgba(13,10,30,.06);
    --rv-shadow-md:  0 4px 24px rgba(13,10,30,.08);
    --rv-shadow-lg:  0 16px 48px rgba(13,10,30,.12);
    --rv-shadow-red: 0 8px 28px rgba(244,63,94,.35);

    --rv-r-sm: 10px;
    --rv-r-md: 16px;
    --rv-r-lg: 22px;
    --rv-r-xl: 28px;

    --font-h: 'Outfit', sans-serif;
    --font-b: 'Figtree', sans-serif;
}

/* ─── BASE ───────────────────────────────── */
.rv-wrapper {
    font-family: var(--font-b);
    color: var(--rv-text-b);
    padding-bottom: 120px;
}

/* ─── HEADER ─────────────────────────────── */
.rv-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 36px;
    flex-wrap: wrap;
}
.rv-header__left { flex: 1; }
.rv-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--rv-text-m);
    text-decoration: none;
    padding: 6px 14px;
    border-radius: 100px;
    border: 1.5px solid var(--rv-border);
    background: var(--rv-white);
    margin-bottom: 16px;
    transition: all .2s;
    box-shadow: var(--rv-shadow-sm);
}
.rv-back-btn:hover {
    color: var(--rv-red);
    border-color: var(--rv-red);
    background: var(--rv-red-light);
    transform: translateX(-3px);
}
.rv-header__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-family: var(--font-h);
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--rv-red);
    margin-bottom: 10px;
}
.rv-eyebrow-icon {
    font-size: 0.8rem;
    animation: rv-spin-slow 4s linear infinite;
}
@keyframes rv-spin-slow {
    0%, 100% { transform: scale(1); }
    50%       { transform: scale(1.2); }
}
.rv-header__title {
    font-family: var(--font-h);
    font-size: 2rem;
    font-weight: 800;
    color: var(--rv-text-h);
    letter-spacing: -0.04em;
    line-height: 1.1;
    margin: 0 0 10px;
}
.rv-title-highlight {
    background: linear-gradient(120deg, var(--rv-red), var(--rv-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.rv-header__sub {
    font-size: 0.85rem;
    color: var(--rv-text-m);
    margin: 0;
}

/* Phone mockup decoration */
.rv-header__badge { flex-shrink: 0; }
.rv-phone-mockup {
    width: 56px; height: 88px;
    background: var(--rv-text-h);
    border-radius: 12px;
    padding: 6px;
    box-shadow: 0 12px 32px rgba(13,10,30,.3);
    position: relative;
    overflow: hidden;
}
.rv-phone-mockup::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    transform: translateX(-50%);
    width: 18px; height: 4px;
    background: #1e1a35;
    border-radius: 0 0 6px 6px;
    z-index: 2;
}
.rv-phone-mockup__screen {
    width: 100%; height: 100%;
    border-radius: 8px;
    background: linear-gradient(160deg, #1a0a2e 0%, #3d0030 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    overflow: hidden;
    position: relative;
}
.rv-phone-mockup__screen::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent 60%, rgba(244,63,94,.2) 100%);
}
.rv-phone-mockup__reel {
    width: 22px; height: 22px;
    border-radius: 50%;
    background: rgba(244,63,94,.9);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.7rem;
    padding-left: 2px;
    box-shadow: 0 0 12px rgba(244,63,94,.6);
    animation: rv-pulse-play 2s ease-in-out infinite;
}
@keyframes rv-pulse-play {
    0%, 100% { box-shadow: 0 0 6px rgba(244,63,94,.6); }
    50%       { box-shadow: 0 0 18px rgba(244,63,94,.9); }
}
.rv-phone-mockup__bars {
    display: flex;
    flex-direction: column;
    gap: 2px;
    width: 24px;
}
.rv-phone-mockup__bars span {
    display: block;
    height: 2px;
    border-radius: 2px;
    background: rgba(255,255,255,.4);
}
.rv-phone-mockup__bars span:nth-child(2) { width: 70%; }
.rv-phone-mockup__bars span:nth-child(3) { width: 50%; }

/* ─── ALERT ──────────────────────────────── */
.rv-alert {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 18px;
    border-radius: var(--rv-r-md);
    position: relative;
}
.rv-alert--success {
    background: var(--rv-green-light);
    border: 1px solid rgba(16,185,129,.2);
}
.rv-alert__icon {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: rgba(16,185,129,.15);
    color: var(--rv-green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.rv-alert__body { flex: 1; }
.rv-alert__label {
    display: block;
    font-family: var(--font-h);
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #065f46;
    margin-bottom: 2px;
}
.rv-alert__text { font-size: 0.84rem; margin: 0; color: #065f46; }
.rv-alert__close {
    background: none;
    border: none;
    color: var(--rv-text-m);
    cursor: pointer;
    font-size: 0.75rem;
    padding: 4px;
    flex-shrink: 0;
}

/* ─── LAYOUT ─────────────────────────────── */
.rv-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 24px;
    align-items: start;
}
@media (max-width: 1100px) {
    .rv-layout { grid-template-columns: 1fr; }
}

/* ─── SECTIONS ───────────────────────────── */
.rv-section {
    background: var(--rv-white);
    border-radius: var(--rv-r-xl);
    border: 1px solid var(--rv-border);
    box-shadow: var(--rv-shadow-md);
    padding: 28px 32px;
    margin-bottom: 20px;
    animation: rv-fadein .4s ease both;
    transition: box-shadow .3s;
}
.rv-section:hover { box-shadow: var(--rv-shadow-lg); }
.rv-section[data-index="2"] { animation-delay: .08s; }
.rv-section[data-index="3"] { animation-delay: .14s; }
.rv-section[data-index="4"] { animation-delay: .2s; }
.rv-section--video {
    border: 1px solid rgba(244,63,94,.2);
    background: linear-gradient(135deg, #fff 0%, #fff8f9 100%);
}
@keyframes rv-fadein {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.rv-section__head {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--rv-border);
}
.rv-section__num {
    width: 36px; height: 36px;
    border-radius: 10px;
    color: white;
    font-family: var(--font-h);
    font-size: 0.85rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.rv-section__num--red {
    background: linear-gradient(135deg, var(--rv-red), var(--rv-red-dark));
    box-shadow: 0 4px 12px var(--rv-red-glow);
}
.rv-section__num--orange {
    background: linear-gradient(135deg, var(--rv-orange), #ea580c);
    box-shadow: 0 4px 12px rgba(249,115,22,.3);
}
.rv-section__num--purple {
    background: linear-gradient(135deg, var(--rv-purple), var(--rv-purple-dark));
    box-shadow: 0 4px 12px var(--rv-purple-glow);
}
.rv-section__title {
    font-family: var(--font-h);
    font-size: 1rem;
    font-weight: 700;
    color: var(--rv-text-h);
    margin: 0 0 3px;
}
.rv-section__desc {
    font-size: 0.78rem;
    color: var(--rv-text-m);
    margin: 0;
}

/* ─── FIELDS ─────────────────────────────── */
.rv-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}
.rv-field--full { grid-column: 1 / -1; }
.rv-field { display: flex; flex-direction: column; }
@media (max-width: 640px) {
    .rv-fields { grid-template-columns: 1fr; }
    .rv-field--full { grid-column: auto; }
}

/* ─── INPUTS ─────────────────────────────── */
.rv-label {
    font-family: var(--font-h);
    font-size: 0.74rem;
    font-weight: 600;
    color: var(--rv-text-b);
    margin-bottom: 7px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.rv-req { color: var(--rv-red); font-weight: 700; }
.rv-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.rv-input-icon {
    position: absolute;
    left: 13px;
    color: var(--rv-text-l);
    font-size: 0.85rem;
    pointer-events: none;
    z-index: 1;
}
.rv-input {
    width: 100%;
    padding: 11px 14px 11px 37px;
    border: 1.5px solid var(--rv-border);
    border-radius: var(--rv-r-sm);
    font-family: var(--font-b);
    font-size: 0.875rem;
    color: var(--rv-text-h);
    background: var(--rv-white);
    transition: border-color .2s, box-shadow .2s, background .2s;
    outline: none;
    appearance: none;
}
.rv-input:focus {
    border-color: var(--rv-border-focus);
    box-shadow: 0 0 0 3px var(--rv-purple-glow);
    background: var(--rv-purple-light);
}
.rv-input::placeholder { color: var(--rv-text-l); }
.rv-input--error {
    border-color: var(--rv-red) !important;
    background: var(--rv-red-light) !important;
}
.rv-select { cursor: pointer; padding-right: 36px; }
.rv-select-arrow {
    position: absolute;
    right: 13px;
    color: var(--rv-text-l);
    font-size: 0.72rem;
    pointer-events: none;
}
.rv-input-addon {
    display: flex;
    align-items: center;
    padding: 11px 12px;
    background: #f6f5ff;
    border: 1.5px solid var(--rv-border);
    border-right: none;
    border-radius: var(--rv-r-sm) 0 0 var(--rv-r-sm);
    font-family: var(--font-h);
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--rv-text-m);
    flex-shrink: 0;
}
.rv-input--addon {
    padding-left: 12px;
    border-radius: 0 var(--rv-r-sm) var(--rv-r-sm) 0;
    flex: 1;
}
.rv-textarea {
    padding: 12px 14px;
    resize: vertical;
    min-height: 130px;
}
.rv-hint {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    color: var(--rv-text-m);
    margin-top: 6px;
    background: #f6f5ff;
    border: 1px solid var(--rv-border);
    border-radius: 8px;
    padding: 6px 10px;
}
.rv-char-hint { font-size: 0.7rem; color: var(--rv-text-l); margin-top: 6px; }
.rv-error {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--rv-red);
    margin-top: 5px;
}

/* ─── VIDEO UPLOAD ZONE ──────────────────── */
.rv-video-zone {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px;
    padding: 32px 20px;
    border: 2px dashed rgba(244,63,94,.35);
    border-radius: var(--rv-r-lg);
    cursor: pointer;
    background: linear-gradient(180deg, #fff5f6 0%, #fff 100%);
    transition: border-color .2s, background .2s, box-shadow .2s;
    min-height: 220px;
    justify-content: center;
}
.rv-video-zone:hover {
    border-color: var(--rv-red);
    background: var(--rv-red-light);
    box-shadow: 0 8px 24px var(--rv-red-glow);
}
.rv-video-zone__graphic {
    position: relative;
    width: 64px; height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.rv-video-zone__rings { position: absolute; inset: 0; }
.rv-ring {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 1.5px solid rgba(244,63,94,.3);
    animation: rv-ring-expand 2.5s ease-in-out infinite;
}
.rv-ring--2 { animation-delay: .8s; }
@keyframes rv-ring-expand {
    0%   { opacity: .8; transform: scale(.6); }
    100% { opacity: 0; transform: scale(1.4); }
}
.rv-video-zone__play {
    width: 56px; height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--rv-red), var(--rv-red-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    box-shadow: 0 6px 20px var(--rv-red-glow);
    position: relative;
    z-index: 1;
}
.rv-video-zone__title {
    font-family: var(--font-h);
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--rv-text-h);
    margin: 0;
}
.rv-video-zone__sub {
    font-size: 0.72rem;
    color: var(--rv-text-l);
    margin: 0;
}
.rv-video-zone__specs {
    display: flex;
    gap: 10px;
}
.rv-video-zone__specs span {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    background: rgba(244,63,94,.08);
    border: 1px solid rgba(244,63,94,.2);
    border-radius: 100px;
    font-size: 0.67rem;
    font-weight: 600;
    color: var(--rv-red);
    font-family: var(--font-h);
}
.rv-video-zone__btn {
    display: inline-block;
    padding: 8px 22px;
    background: linear-gradient(135deg, var(--rv-red), var(--rv-red-dark));
    color: white;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.78rem;
    font-weight: 700;
    box-shadow: 0 4px 14px var(--rv-red-glow);
    transition: all .2s;
}
.rv-video-zone:hover .rv-video-zone__btn {
    box-shadow: 0 8px 22px var(--rv-red-glow);
    transform: translateY(-1px);
}
.rv-upload-input { display: none; }

/* Video file ready card */
.rv-file-ready {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 14px;
    padding: 12px 16px;
    background: var(--rv-red-light);
    border: 1.5px solid rgba(244,63,94,.2);
    border-radius: var(--rv-r-md);
}
.rv-file-ready__icon {
    width: 40px; height: 40px;
    border-radius: var(--rv-r-sm);
    background: linear-gradient(135deg, var(--rv-red), var(--rv-red-dark));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.rv-file-ready__info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
}
.rv-file-ready__name {
    font-family: var(--font-h);
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--rv-text-h);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.rv-file-ready__size {
    font-size: 0.68rem;
    color: var(--rv-text-m);
}
.rv-file-ready__badge {
    color: var(--rv-green);
    font-size: 1.1rem;
    flex-shrink: 0;
}

/* ─── GENERIC UPLOAD ZONE ────────────────── */
.rv-upload-zone {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 8px;
    padding: 24px 20px;
    border: 2px dashed var(--rv-border);
    border-radius: var(--rv-r-lg);
    cursor: pointer;
    background: #f9f8ff;
    transition: border-color .2s, background .2s;
    min-height: 160px;
    justify-content: center;
}
.rv-upload-zone--thumb:hover {
    border-color: var(--rv-purple);
    background: var(--rv-purple-light);
}
.rv-upload-zone__icon {
    width: 48px; height: 48px;
    border-radius: var(--rv-r-sm);
    background: var(--rv-white);
    border: 1.5px solid var(--rv-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    color: var(--rv-purple);
    box-shadow: var(--rv-shadow-sm);
}
.rv-upload-zone__title {
    font-family: var(--font-h);
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--rv-text-h);
    margin: 0;
}
.rv-upload-zone__sub { font-size: 0.7rem; color: var(--rv-text-l); margin: 0; }
.rv-upload-zone__btn {
    display: inline-block;
    padding: 6px 18px;
    background: var(--rv-purple);
    color: white;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.72rem;
    font-weight: 700;
    transition: background .2s;
}
.rv-upload-zone--thumb:hover .rv-upload-zone__btn { background: var(--rv-purple-dark); }

/* ─── THUMBNAIL PREVIEW ──────────────────── */
.rv-thumb-preview {
    position: relative;
    border-radius: var(--rv-r-lg);
    overflow: hidden;
    border: 2px solid var(--rv-border);
    box-shadow: var(--rv-shadow-md);
    aspect-ratio: 9/12;
    max-height: 260px;
}
.rv-thumb-preview__img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
}
.rv-thumb-preview__overlay {
    position: absolute;
    inset: 0;
    background: rgba(13,10,30,.45);
    display: flex;
    align-items: center;
    justify-content: center;
}
.rv-thumb-preview__play {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: rgba(244,63,94,.9);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    padding-left: 3px;
    box-shadow: 0 6px 20px var(--rv-red-glow);
}
.rv-thumb-preview__badge {
    position: absolute;
    top: 10px; left: 10px;
    padding: 4px 10px;
    background: rgba(16,185,129,.9);
    color: white;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.63rem;
    font-weight: 700;
    letter-spacing: 0.04em;
}
.rv-thumb-remove {
    position: absolute;
    bottom: 12px; right: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    background: rgba(13,10,30,.75);
    color: white;
    border: none;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.72rem;
    font-weight: 700;
    cursor: pointer;
    backdrop-filter: blur(6px);
    transition: background .2s;
}
.rv-thumb-remove:hover { background: var(--rv-red); }

/* ─── UPLOADING PROGRESS ─────────────────── */
.rv-uploading {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    font-size: 0.74rem;
    color: var(--rv-red);
    font-weight: 600;
}
.rv-uploading__bar {
    flex: 1;
    height: 4px;
    border-radius: 100px;
    background: var(--rv-red-light);
    overflow: hidden;
    position: relative;
}
.rv-uploading__bar::after {
    content: '';
    position: absolute;
    inset: 0; width: 35%;
    background: var(--rv-red);
    border-radius: 100px;
    animation: rv-progress 1s ease-in-out infinite;
}
.rv-uploading__bar--purple { background: var(--rv-purple-light); }
.rv-uploading__bar--purple::after { background: var(--rv-purple); }
@keyframes rv-progress {
    0%   { transform: translateX(-100%); }
    100% { transform: translateX(350%); }
}

/* ─── SUBMIT BAR ─────────────────────────── */
.rv-submit-bar {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    z-index: 100;
    background: rgba(255,255,255,.88);
    backdrop-filter: blur(20px);
    border-top: 1px solid var(--rv-border);
    box-shadow: 0 -4px 28px rgba(13,10,30,.10);
    animation: rv-slidein .4s cubic-bezier(.4,0,.2,1) both;
    animation-delay: .3s;
}
@keyframes rv-slidein {
    from { transform: translateY(100%); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}
.rv-submit-bar__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 14px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
@media (max-width: 600px) {
    .rv-submit-bar__inner { flex-direction: column; align-items: stretch; }
}
.rv-submit-bar__info { display: flex; align-items: center; gap: 12px; }
.rv-submit-bar__icon {
    width: 42px; height: 42px;
    border-radius: var(--rv-r-sm);
    background: linear-gradient(135deg, var(--rv-red), var(--rv-red-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    box-shadow: var(--rv-shadow-red);
    flex-shrink: 0;
}
.rv-submit-bar__title {
    font-family: var(--font-h);
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--rv-text-h);
    margin: 0 0 2px;
}
.rv-submit-bar__sub { font-size: 0.72rem; color: var(--rv-text-m); margin: 0; }
.rv-submit-bar__actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

/* ─── BUTTONS ────────────────────────────── */
.rv-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 22px;
    border-radius: var(--rv-r-sm);
    font-family: var(--font-h);
    font-size: 0.85rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all .2s ease;
    white-space: nowrap;
    letter-spacing: 0.01em;
}
.rv-btn--ghost {
    background: transparent;
    color: var(--rv-text-m);
    border: 1.5px solid var(--rv-border);
}
.rv-btn--ghost:hover {
    background: #f1f0ff;
    color: var(--rv-text-h);
    border-color: var(--rv-border-focus);
}
.rv-btn--publish {
    background: linear-gradient(135deg, var(--rv-red) 0%, var(--rv-red-dark) 100%);
    color: white;
    box-shadow: var(--rv-shadow-red);
    padding: 12px 28px;
}
.rv-btn--publish:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 36px rgba(244,63,94,.5);
}
.rv-btn--publish:active { transform: translateY(0); }
.rv-btn--publish:disabled { opacity: .7; cursor: not-allowed; transform: none; }

/* ─── SPINNER ────────────────────────────── */
.rv-spinner {
    display: inline-block;
    width: 15px; height: 15px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: white;
    border-radius: 50%;
    animation: rv-spin .65s linear infinite;
    vertical-align: middle;
}
@keyframes rv-spin { to { transform: rotate(360deg); } }
</style>
</div>

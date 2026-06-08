<div class="jf-wrapper">

    {{-- ══════════════════════════════════════════
         PAGE HEADER
    ══════════════════════════════════════════ --}}
    <div class="jf-header">
        <div class="jf-header__left">
            <a href="/dashboard" class="jf-back-btn">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <div class="jf-header__meta">
                <div class="jf-header__eyebrow">
                    <span class="jf-pulse"></span>
                    <span>Lowongan Baru</span>
                </div>
                <h1 class="jf-header__title">Buat Lowongan Kerja</h1>
                <p class="jf-header__sub">Data akan otomatis tersinkron ke aplikasi Jobza User setelah dipublikasikan.</p>
            </div>
        </div>

        {{-- Progress indicator --}}
        <div class="jf-progress-ring" aria-hidden="true">
            <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="28" cy="28" r="24" stroke="var(--jf-border)" stroke-width="3"/>
                <circle cx="28" cy="28" r="24" stroke="var(--jf-accent)" stroke-width="3"
                    stroke-dasharray="150.8" stroke-dashoffset="150.8"
                    stroke-linecap="round" class="jf-ring-progress"
                    style="transform: rotate(-90deg); transform-origin: 50% 50%;"/>
            </svg>
            <div class="jf-progress-ring__label">
                <span class="jf-progress-ring__num" id="jfProgressNum">0%</span>
                <span class="jf-progress-ring__hint">lengkap</span>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         FORM LAYOUT — Stepper feel, 2 columns
    ══════════════════════════════════════════ --}}
    <form wire:submit.prevent="save" class="jf-form" id="jfMainForm">
        <div class="jf-layout">

            {{-- ── LEFT / MAIN COLUMN ── --}}
            <div class="jf-col-main">

                {{-- ─── SECTION 1: IDENTITAS ─── --}}
                <div class="jf-section" data-section="1">
                    <div class="jf-section__header">
                        <div class="jf-section__num">1</div>
                        <div>
                            <h2 class="jf-section__title">Identitas Lowongan</h2>
                            <p class="jf-section__desc">Judul, kategori, dan informasi utama posisi kerja.</p>
                        </div>
                    </div>

                    <div class="jf-fields">
                        {{-- Title --}}
                        <div class="jf-field jf-field--full">
                            <label class="jf-label">
                                Judul Lowongan
                                <span class="jf-required">*</span>
                            </label>
                            <div class="jf-input-wrap">
                                <i class="bi bi-briefcase jf-input-icon"></i>
                                <input type="text" wire:model="title"
                                    class="jf-input @error('title') jf-input--error @enderror"
                                    placeholder="Contoh: Senior Flutter Developer">
                            </div>
                            @error('title')
                                <span class="jf-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Category + Salary --}}
                        <div class="jf-field">
                            <label class="jf-label">Kategori <span class="jf-required">*</span></label>
                            <div class="jf-input-wrap">
                                <i class="bi bi-folder2 jf-input-icon"></i>
                                <select wire:model="category"
                                    class="jf-input jf-select @error('category') jf-input--error @enderror">
                                    <option value="">Pilih Kategori</option>
                                    <option value="lowongan">Lowongan Kerja</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                                <i class="bi bi-chevron-down jf-select-arrow"></i>
                            </div>
                            @error('category')
                                <span class="jf-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="jf-field">
                            <label class="jf-label">Gaji (IDR) <span class="jf-required">*</span></label>
                            <div class="jf-input-wrap jf-input-wrap--addon">
                                <span class="jf-input-addon">Rp</span>
                                <input type="number" wire:model="salary"
                                    class="jf-input jf-input--addon @error('salary') jf-input--error @enderror"
                                    placeholder="5.000.000">
                            </div>
                            @error('salary')
                                <span class="jf-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="jf-field">
                            <label class="jf-label">
                                <i class="bi bi-geo-alt-fill" style="color: var(--jf-red)"></i>
                                Lokasi (Link Google Maps)
                                <span class="jf-required">*</span>
                            </label>
                            <div class="jf-input-wrap">
                                <i class="bi bi-map jf-input-icon"></i>
                                <input type="url" wire:model="location"
                                    class="jf-input @error('location') jf-input--error @enderror"
                                    placeholder="https://maps.app.goo.gl/xxx">
                            </div>
                            <div class="jf-hint">
                                <i class="bi bi-info-circle me-1"></i>
                                Buka Google Maps → Klik Bagikan → Salin & paste tautan di sini.
                            </div>
                            @error('location')
                                <span class="jf-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div class="jf-field">
                            <label class="jf-label">WhatsApp Admin <span class="jf-required">*</span></label>
                            <div class="jf-input-wrap jf-input-wrap--addon">
                                <span class="jf-input-addon">
                                    <i class="bi bi-whatsapp" style="color: #22c55e"></i>
                                </span>
                                <input type="text" wire:model="admin_phone"
                                    class="jf-input jf-input--addon @error('admin_phone') jf-input--error @enderror"
                                    placeholder="628123456789">
                            </div>
                            @error('admin_phone')
                                <span class="jf-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ─── SECTION 2: DESKRIPSI ─── --}}
                <div class="jf-section" data-section="2">
                    <div class="jf-section__header">
                        <div class="jf-section__num">2</div>
                        <div>
                            <h2 class="jf-section__title">Deskripsi Pekerjaan</h2>
                            <p class="jf-section__desc">Jelaskan detail tugas, kualifikasi, dan benefit yang ditawarkan.</p>
                        </div>
                    </div>

                    <div class="jf-field jf-field--full">
                        <label class="jf-label">Isi Deskripsi <span class="jf-required">*</span></label>
                        <textarea wire:model="description"
                            class="jf-input jf-textarea @error('description') jf-input--error @enderror"
                            rows="7"
                            placeholder="Tuliskan tanggung jawab pekerjaan, kualifikasi yang dibutuhkan, benefit, dan informasi relevan lainnya..."></textarea>
                        <div class="jf-char-hint">Minimal 50 karakter · Semakin detail semakin menarik pelamar</div>
                        @error('description')
                            <span class="jf-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>{{-- /jf-col-main --}}

            {{-- ── RIGHT / MEDIA COLUMN ── --}}
            <div class="jf-col-side">

                {{-- ─── SECTION 3: THUMBNAIL ─── --}}
                <div class="jf-section" data-section="3">
                    <div class="jf-section__header">
                        <div class="jf-section__num jf-section__num--blue">3</div>
                        <div>
                            <h2 class="jf-section__title">Cover Banner</h2>
                            <p class="jf-section__desc">Foto utama yang tampil sebagai sampul lowongan.</p>
                        </div>
                    </div>

                    @if ($thumbnailFile)
                        <div class="jf-thumb-preview">
                            <img src="{{ $thumbnailFile->temporaryUrl() }}" alt="Thumbnail Preview" class="jf-thumb-preview__img">
                            <div class="jf-thumb-preview__overlay">
                                <button type="button" wire:click="$set('thumbnailFile', null)" class="jf-thumb-remove">
                                    <i class="bi bi-trash3-fill"></i>
                                    <span>Ganti Foto</span>
                                </button>
                            </div>
                            <div class="jf-thumb-preview__badge">
                                <i class="bi bi-check-circle-fill me-1"></i> Cover aktif
                            </div>
                        </div>
                    @else
                        <label class="jf-upload-zone" for="thumbnailUpload">
                            <div class="jf-upload-zone__icon">
                                <i class="bi bi-image-fill"></i>
                            </div>
                            <p class="jf-upload-zone__title">Unggah Cover Banner</p>
                            <p class="jf-upload-zone__sub">PNG, JPG, JPEG · Maks. 2 MB</p>
                            <span class="jf-upload-zone__btn">Pilih Foto</span>
                            <input type="file" wire:model="thumbnailFile" id="thumbnailUpload"
                                class="jf-upload-zone__input @error('thumbnailFile') jf-input--error @enderror">
                        </label>
                    @endif

                    <div wire:loading wire:target="thumbnailFile" class="jf-uploading">
                        <div class="jf-uploading__bar"></div>
                        <span>Mengunggah cover...</span>
                    </div>
                    @error('thumbnailFile')
                        <span class="jf-error mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                    @enderror
                </div>

                {{-- ─── SECTION 4: GALLERY ─── --}}
                <div class="jf-section" data-section="4">
                    <div class="jf-section__header">
                        <div class="jf-section__num jf-section__num--green">4</div>
                        <div>
                            <h2 class="jf-section__title">Galeri Foto</h2>
                            <p class="jf-section__desc">Foto suasana tempat kerja sebagai daya tarik tambahan.</p>
                        </div>
                    </div>

                    <label class="jf-upload-zone jf-upload-zone--sm" for="galleryUpload">
                        <i class="bi bi-images jf-upload-zone__icon-sm"></i>
                        <div>
                            <p class="jf-upload-zone__title jf-upload-zone__title--sm">Tambah Foto Galeri</p>
                            <p class="jf-upload-zone__sub">Bisa memilih beberapa sekaligus</p>
                        </div>
                        <span class="jf-upload-zone__btn jf-upload-zone__btn--sm">Pilih</span>
                        <input type="file" wire:model="temporaryPhotos" id="galleryUpload"
                            class="jf-upload-zone__input" multiple>
                    </label>

                    @if ($photos && count($photos) > 0)
                        <div class="jf-gallery-header mt-3">
                            <span class="jf-gallery-count">
                                <i class="bi bi-images me-1"></i>
                                {{ count($photos) }} foto dipilih
                            </span>
                        </div>
                        <div class="jf-gallery-grid">
                            @foreach ($photos as $index => $photo)
                                <div class="jf-gallery-item">
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Foto {{ $index + 1 }}" class="jf-gallery-item__img">
                                    <div class="jf-gallery-item__overlay">
                                        <button type="button"
                                            wire:click="$dispatch('swal:confirm-remove-photo', [{ index: {{ $index }} }])"
                                            class="jf-gallery-item__remove"
                                            title="Hapus foto ini">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                    <span class="jf-gallery-item__num">{{ $index + 1 }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @error('photos')
                        <span class="jf-error mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</span>
                    @enderror
                </div>

            </div>{{-- /jf-col-side --}}

        </div>{{-- /jf-layout --}}

        {{-- ── STICKY SUBMIT BAR ── --}}
        <div class="jf-submit-bar">
            <div class="jf-submit-bar__inner">
                <div class="jf-submit-bar__info">
                    <div class="jf-submit-bar__icon">
                        <i class="bi bi-send-fill"></i>
                    </div>
                    <div>
                        <p class="jf-submit-bar__title">Siap dipublikasikan?</p>
                        <p class="jf-submit-bar__sub">Pastikan semua data sudah benar sebelum publish.</p>
                    </div>
                </div>
                <div class="jf-submit-bar__actions">
                    <a href="/dashboard" class="jf-btn jf-btn--ghost">
                        <i class="bi bi-x me-1"></i> Batal
                    </a>
                    <button type="submit" class="jf-btn jf-btn--publish" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="bi bi-send-fill me-2"></i>Publish Lowongan
                        </span>
                        <span wire:loading>
                            <span class="jf-spinner me-2"></span>
                            Memproses Unggahan...
                        </span>
                    </button>
                </div>
            </div>
        </div>

    </form>

{{-- ══════════════════════════════════════════
     SCRIPT
══════════════════════════════════════════ --}}
<script>
document.addEventListener('livewire:init', () => {

    // ── SweetAlert confirm remove photo ──
    Livewire.on('swal:confirm-remove-photo', (event) => {
        const data = event[0];
        Swal.fire({
            title: 'Hapus foto ini?',
            text: "Foto akan dikeluarkan dari daftar galeri.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            borderRadius: '16px',
            customClass: {
                popup: 'swal-jobza-popup',
                confirmButton: 'swal-jobza-confirm',
                cancelButton: 'swal-jobza-cancel',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('removePhoto', data.index);
            }
        });
    });

    // ── Progress ring fill based on filled fields ──
    function updateProgress() {
        const fields = [
            document.querySelector('[wire\\:model="title"]'),
            document.querySelector('[wire\\:model="category"]'),
            document.querySelector('[wire\\:model="salary"]'),
            document.querySelector('[wire\\:model="location"]'),
            document.querySelector('[wire\\:model="admin_phone"]'),
            document.querySelector('[wire\\:model="description"]'),
        ];
        const filled = fields.filter(f => f && f.value.trim() !== '').length;
        const pct = Math.round((filled / fields.length) * 100);
        const ring = document.querySelector('.jf-ring-progress');
        const numEl = document.getElementById('jfProgressNum');
        if (ring) {
            const circumference = 150.8;
            ring.style.strokeDashoffset = circumference - (pct / 100) * circumference;
        }
        if (numEl) numEl.textContent = pct + '%';
    }

    document.querySelectorAll('.jf-input').forEach(el => {
        el.addEventListener('input', updateProgress);
        el.addEventListener('change', updateProgress);
    });

    updateProgress();
});
</script>

{{-- ══════════════════════════════════════════
     STYLES
══════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap');

:root {
    --jf-bg:           #f0f2f8;
    --jf-white:        #ffffff;
    --jf-border:       #e2e7f3;
    --jf-border-focus: #4f7ef8;

    --jf-accent:       #4f7ef8;
    --jf-accent-dark:  #2f5be0;
    --jf-accent-light: #eef2ff;
    --jf-green:        #10b981;
    --jf-green-light:  #ecfdf5;
    --jf-red:          #ef4444;
    --jf-red-light:    #fef2f2;
    --jf-amber:        #f59e0b;

    --jf-text-h:    #0f172a;
    --jf-text-b:    #334155;
    --jf-text-m:    #64748b;
    --jf-text-l:    #94a3b8;

    --jf-shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --jf-shadow-md: 0 4px 20px rgba(0,0,0,.07), 0 1px 4px rgba(0,0,0,.04);
    --jf-shadow-lg: 0 12px 40px rgba(0,0,0,.10);
    --jf-shadow-accent: 0 8px 24px rgba(79,126,248,.35);

    --jf-r-sm: 10px;
    --jf-r-md: 16px;
    --jf-r-lg: 22px;
    --jf-r-xl: 30px;

    --font-h: 'Sora', sans-serif;
    --font-b: 'Nunito', sans-serif;
}

/* ─── BASE ────────────────────────────────── */
.jf-wrapper {
    font-family: var(--font-b);
    color: var(--jf-text-b);
    padding-bottom: 120px;
}

/* ─── HEADER ──────────────────────────────── */
.jf-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 36px;
    gap: 20px;
    flex-wrap: wrap;
}
.jf-header__left { flex: 1; }
.jf-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--jf-text-m);
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 100px;
    border: 1.5px solid var(--jf-border);
    background: var(--jf-white);
    margin-bottom: 14px;
    transition: all .2s;
    box-shadow: var(--jf-shadow-sm);
}
.jf-back-btn:hover {
    color: var(--jf-accent);
    border-color: var(--jf-accent);
    background: var(--jf-accent-light);
    transform: translateX(-2px);
}
.jf-header__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-family: var(--font-h);
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--jf-accent);
    margin-bottom: 8px;
}
.jf-pulse {
    width: 7px; height: 7px;
    background: var(--jf-accent);
    border-radius: 50%;
    display: inline-block;
    animation: jf-pulse 2s ease-in-out infinite;
}
@keyframes jf-pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(79,126,248,.6); }
    50%       { box-shadow: 0 0 0 7px rgba(79,126,248,0); }
}
.jf-header__title {
    font-family: var(--font-h);
    font-size: 1.9rem;
    font-weight: 800;
    color: var(--jf-text-h);
    letter-spacing: -0.035em;
    line-height: 1.1;
    margin: 0 0 8px;
}
.jf-header__sub {
    font-size: 0.85rem;
    color: var(--jf-text-m);
    margin: 0;
}

/* ─── PROGRESS RING ──────────────────────── */
.jf-progress-ring {
    position: relative;
    width: 80px; height: 80px;
    flex-shrink: 0;
}
.jf-progress-ring svg {
    width: 100%; height: 100%;
}
.jf-ring-progress {
    transition: stroke-dashoffset .6s cubic-bezier(.4,0,.2,1);
}
.jf-progress-ring__label {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.jf-progress-ring__num {
    font-family: var(--font-h);
    font-size: 0.9rem;
    font-weight: 800;
    color: var(--jf-text-h);
    line-height: 1;
}
.jf-progress-ring__hint {
    font-size: 0.52rem;
    color: var(--jf-text-l);
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-top: 1px;
}

/* ─── LAYOUT ─────────────────────────────── */
.jf-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 24px;
    align-items: start;
}
@media (max-width: 1100px) {
    .jf-layout { grid-template-columns: 1fr; }
}

/* ─── SECTIONS ───────────────────────────── */
.jf-section {
    background: var(--jf-white);
    border-radius: var(--jf-r-xl);
    border: 1px solid var(--jf-border);
    box-shadow: var(--jf-shadow-md);
    padding: 28px 32px;
    margin-bottom: 20px;
    animation: jf-fadein .4s ease both;
    transition: box-shadow .3s;
}
.jf-section:hover { box-shadow: var(--jf-shadow-lg); }

@keyframes jf-fadein {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}
.jf-section[data-section="2"] { animation-delay: .07s; }
.jf-section[data-section="3"] { animation-delay: .12s; }
.jf-section[data-section="4"] { animation-delay: .18s; }

.jf-section__header {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--jf-border);
}
.jf-section__num {
    width: 36px; height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--jf-accent), var(--jf-accent-dark));
    color: white;
    font-family: var(--font-h);
    font-size: 0.85rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(79,126,248,.3);
}
.jf-section__num--blue {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    box-shadow: 0 4px 12px rgba(59,130,246,.3);
}
.jf-section__num--green {
    background: linear-gradient(135deg, var(--jf-green), #059669);
    box-shadow: 0 4px 12px rgba(16,185,129,.3);
}
.jf-section__title {
    font-family: var(--font-h);
    font-size: 1rem;
    font-weight: 700;
    color: var(--jf-text-h);
    margin: 0 0 3px;
    letter-spacing: -0.01em;
}
.jf-section__desc {
    font-size: 0.78rem;
    color: var(--jf-text-m);
    margin: 0;
}

/* ─── FIELDS GRID ────────────────────────── */
.jf-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}
.jf-field--full { grid-column: 1 / -1; }
.jf-field { display: flex; flex-direction: column; }

@media (max-width: 640px) {
    .jf-fields { grid-template-columns: 1fr; }
    .jf-field--full { grid-column: auto; }
}

/* ─── LABELS ─────────────────────────────── */
.jf-label {
    font-family: var(--font-h);
    font-size: 0.74rem;
    font-weight: 600;
    color: var(--jf-text-b);
    margin-bottom: 7px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.jf-required {
    color: var(--jf-red);
    font-weight: 700;
    font-size: 0.9em;
}

/* ─── INPUTS ─────────────────────────────── */
.jf-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.jf-input-wrap--addon {
    /* handled inline */
}
.jf-input-icon {
    position: absolute;
    left: 13px;
    color: var(--jf-text-l);
    font-size: 0.85rem;
    pointer-events: none;
    z-index: 1;
}
.jf-input {
    width: 100%;
    padding: 11px 14px 11px 37px;
    border: 1.5px solid var(--jf-border);
    border-radius: var(--jf-r-sm);
    font-family: var(--font-b);
    font-size: 0.875rem;
    color: var(--jf-text-h);
    background: var(--jf-white);
    transition: border-color .2s, box-shadow .2s, background .2s;
    outline: none;
    appearance: none;
}
.jf-input:focus {
    border-color: var(--jf-border-focus);
    box-shadow: 0 0 0 3px rgba(79,126,248,.12);
    background: var(--jf-accent-light);
}
.jf-input::placeholder { color: var(--jf-text-l); }
.jf-input--error {
    border-color: var(--jf-red) !important;
    background: var(--jf-red-light) !important;
}
.jf-input--error:focus {
    box-shadow: 0 0 0 3px rgba(239,68,68,.12) !important;
}
.jf-textarea {
    padding: 12px 14px;
    resize: vertical;
    min-height: 140px;
}
.jf-char-hint {
    font-size: 0.7rem;
    color: var(--jf-text-l);
    margin-top: 6px;
}

/* Select */
.jf-select { cursor: pointer; padding-right: 38px; }
.jf-select-arrow {
    position: absolute;
    right: 13px;
    color: var(--jf-text-l);
    font-size: 0.72rem;
    pointer-events: none;
}

/* Addon */
.jf-input-addon {
    display: flex;
    align-items: center;
    padding: 11px 12px;
    background: #f8fafc;
    border: 1.5px solid var(--jf-border);
    border-right: none;
    border-radius: var(--jf-r-sm) 0 0 var(--jf-r-sm);
    font-family: var(--font-h);
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--jf-text-m);
    flex-shrink: 0;
}
.jf-input--addon {
    padding-left: 12px;
    border-radius: 0 var(--jf-r-sm) var(--jf-r-sm) 0;
    flex: 1;
}

/* Hint */
.jf-hint {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    color: var(--jf-text-m);
    margin-top: 6px;
    background: #f8fafc;
    border: 1px solid var(--jf-border);
    border-radius: 8px;
    padding: 6px 10px;
}

/* Error */
.jf-error {
    display: flex;
    align-items: center;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--jf-red);
    margin-top: 5px;
}

/* ─── UPLOAD ZONE ────────────────────────── */
.jf-upload-zone {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 10px;
    padding: 28px 20px;
    border: 2px dashed var(--jf-border);
    border-radius: var(--jf-r-lg);
    cursor: pointer;
    background: #f8faff;
    transition: border-color .2s, background .2s;
    min-height: 180px;
}
.jf-upload-zone:hover {
    border-color: var(--jf-accent);
    background: var(--jf-accent-light);
}
.jf-upload-zone__icon {
    width: 56px; height: 56px;
    border-radius: var(--jf-r-md);
    background: var(--jf-white);
    border: 1.5px solid var(--jf-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--jf-accent);
    box-shadow: var(--jf-shadow-sm);
}
.jf-upload-zone__title {
    font-family: var(--font-h);
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--jf-text-h);
    margin: 0;
}
.jf-upload-zone__sub {
    font-size: 0.72rem;
    color: var(--jf-text-l);
    margin: 0;
}
.jf-upload-zone__btn {
    display: inline-block;
    padding: 6px 18px;
    background: var(--jf-accent);
    color: white;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    transition: background .2s;
}
.jf-upload-zone:hover .jf-upload-zone__btn { background: var(--jf-accent-dark); }
.jf-upload-zone__input { display: none; }

/* Upload zone sm (gallery) */
.jf-upload-zone--sm {
    flex-direction: row;
    text-align: left;
    min-height: auto;
    padding: 14px 18px;
    gap: 14px;
    border-radius: var(--jf-r-md);
}
.jf-upload-zone__icon-sm {
    font-size: 1.4rem;
    color: var(--jf-green);
    flex-shrink: 0;
}
.jf-upload-zone__title--sm {
    font-size: 0.8rem;
}
.jf-upload-zone__btn--sm {
    margin-left: auto;
    flex-shrink: 0;
    background: var(--jf-green);
}
.jf-upload-zone--sm:hover .jf-upload-zone__btn--sm { background: #059669; }
.jf-upload-zone--sm:hover { border-color: var(--jf-green); background: var(--jf-green-light); }

/* ─── THUMBNAIL PREVIEW ──────────────────── */
.jf-thumb-preview {
    position: relative;
    border-radius: var(--jf-r-lg);
    overflow: hidden;
    border: 2px solid var(--jf-border);
    box-shadow: var(--jf-shadow-md);
}
.jf-thumb-preview__img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}
.jf-thumb-preview__overlay {
    position: absolute;
    inset: 0;
    background: rgba(15,23,42,.5);
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity .2s;
}
.jf-thumb-preview:hover .jf-thumb-preview__overlay { opacity: 1; }
.jf-thumb-remove {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: var(--jf-red);
    color: white;
    border: none;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.78rem;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s;
}
.jf-thumb-remove:hover { background: #dc2626; }
.jf-thumb-preview__badge {
    position: absolute;
    top: 10px; left: 10px;
    padding: 4px 10px;
    background: rgba(16,185,129,.9);
    color: white;
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    backdrop-filter: blur(4px);
}

/* ─── UPLOAD PROGRESS ────────────────────── */
.jf-uploading {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    font-size: 0.75rem;
    color: var(--jf-accent);
    font-weight: 600;
}
.jf-uploading__bar {
    flex: 1;
    height: 4px;
    border-radius: 100px;
    background: var(--jf-accent-light);
    overflow: hidden;
    position: relative;
}
.jf-uploading__bar::after {
    content: '';
    position: absolute;
    inset: 0;
    width: 35%;
    background: var(--jf-accent);
    border-radius: 100px;
    animation: jf-progress-slide 1s ease-in-out infinite;
}
@keyframes jf-progress-slide {
    0%   { transform: translateX(-100%); }
    100% { transform: translateX(350%); }
}

/* ─── GALLERY ────────────────────────────── */
.jf-gallery-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.jf-gallery-count {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    background: var(--jf-green-light);
    color: var(--jf-green);
    border-radius: 100px;
    font-family: var(--font-h);
    font-size: 0.7rem;
    font-weight: 700;
    border: 1px solid rgba(16,185,129,.2);
}
.jf-gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 12px;
}
.jf-gallery-item {
    position: relative;
    border-radius: var(--jf-r-sm);
    overflow: hidden;
    border: 1.5px solid var(--jf-border);
    aspect-ratio: 1;
    box-shadow: var(--jf-shadow-sm);
}
.jf-gallery-item__img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .3s;
}
.jf-gallery-item:hover .jf-gallery-item__img { transform: scale(1.05); }
.jf-gallery-item__overlay {
    position: absolute;
    inset: 0;
    background: rgba(15,23,42,.45);
    opacity: 0;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 6px;
    transition: opacity .2s;
}
.jf-gallery-item:hover .jf-gallery-item__overlay { opacity: 1; }
.jf-gallery-item__remove {
    width: 26px; height: 26px;
    border-radius: 50%;
    background: var(--jf-red);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    cursor: pointer;
    transition: background .2s, transform .2s;
}
.jf-gallery-item__remove:hover { background: #dc2626; transform: scale(1.1); }
.jf-gallery-item__num {
    position: absolute;
    bottom: 5px; left: 6px;
    padding: 2px 6px;
    background: rgba(15,23,42,.65);
    color: white;
    border-radius: 4px;
    font-family: var(--font-h);
    font-size: 0.6rem;
    font-weight: 700;
    backdrop-filter: blur(4px);
}

/* ─── SUBMIT BAR ─────────────────────────── */
.jf-submit-bar {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    z-index: 100;
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(16px);
    border-top: 1px solid var(--jf-border);
    box-shadow: 0 -4px 24px rgba(0,0,0,.08);
    animation: jf-slidein .4s cubic-bezier(.4,0,.2,1) both;
    animation-delay: .3s;
}
@keyframes jf-slidein {
    from { transform: translateY(100%); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}
.jf-submit-bar__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 14px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
@media (max-width: 600px) {
    .jf-submit-bar__inner { flex-direction: column; align-items: stretch; }
}
.jf-submit-bar__info {
    display: flex;
    align-items: center;
    gap: 12px;
}
.jf-submit-bar__icon {
    width: 40px; height: 40px;
    border-radius: var(--jf-r-sm);
    background: linear-gradient(135deg, var(--jf-accent), var(--jf-accent-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    box-shadow: var(--jf-shadow-accent);
    flex-shrink: 0;
}
.jf-submit-bar__title {
    font-family: var(--font-h);
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--jf-text-h);
    margin: 0 0 2px;
}
.jf-submit-bar__sub {
    font-size: 0.72rem;
    color: var(--jf-text-m);
    margin: 0;
}
.jf-submit-bar__actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

/* ─── BUTTONS ────────────────────────────── */
.jf-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 22px;
    border-radius: var(--jf-r-sm);
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
.jf-btn--ghost {
    background: transparent;
    color: var(--jf-text-m);
    border: 1.5px solid var(--jf-border);
}
.jf-btn--ghost:hover {
    background: #f1f5f9;
    color: var(--jf-text-h);
    border-color: #cbd5e1;
}
.jf-btn--publish {
    background: linear-gradient(135deg, var(--jf-accent) 0%, var(--jf-accent-dark) 100%);
    color: white;
    box-shadow: var(--jf-shadow-accent);
    padding: 12px 28px;
}
.jf-btn--publish:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(79,126,248,.5);
}
.jf-btn--publish:active { transform: translateY(0); }
.jf-btn--publish:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* ─── SPINNER ────────────────────────────── */
.jf-spinner {
    display: inline-block;
    width: 15px; height: 15px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: white;
    border-radius: 50%;
    animation: jf-spin .65s linear infinite;
    vertical-align: middle;
}
@keyframes jf-spin { to { transform: rotate(360deg); } }
</style>
</div>

<div>
    <div class="jz-topbar">
        <div>
            <h4 class="jz-page-title">Dashboard Utama</h4>
            <p class="jz-page-sub">Selamat datang kembali di panel administrasi Jobza.</p>
        </div>
        <div class="dropdown">
            <div class="jz-profile-chip" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text-end">
                    <div class="jz-profile-name">{{ auth()->user()->name }}</div>
                    <span class="jz-role-badge">Admin</span>
                </div>
                <div class="jz-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end jz-dropdown shadow border-0 mt-2">
                <li>
                    <a class="dropdown-item jz-dropdown-item" href="/admin/profile">
                        <i class="bi bi-person-circle me-2"></i> Lihat Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider opacity-25 my-1"></li>
                <li>
                    <button onclick="document.getElementById('logout-form').submit();"
                            class="dropdown-item jz-dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                    </button>
                </li>
            </ul>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="jz-stats-grid">

        <div class="jz-stat-card jz-stat-purple">
            <div class="jz-stat-icon purple">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="jz-stat-label">Total Like</div>
            <div class="jz-stat-value">{{ number_format($totalLike, 0, ',', '.') }}</div>
            <div class="jz-stat-trend">
                <i class="bi bi-graph-up-arrow"></i> Interaksi pengguna
            </div>
        </div>

        <div class="jz-stat-card jz-stat-blue">
            <div class="jz-stat-icon blue">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <div class="jz-stat-label">Loker Aktif</div>
            <div class="jz-stat-value">{{ number_format($totalLokerAktif, 0, ',', '.') }}</div>
            <div class="jz-stat-trend">
                <i class="bi bi-graph-up-arrow"></i> Lowongan tersedia
            </div>
        </div>

        <div class="jz-stat-card jz-stat-red">
            <div class="jz-stat-icon red">
                <i class="bi bi-camera-reels-fill"></i>
            </div>
            <div class="jz-stat-label">Reels Aktif</div>
            <div class="jz-stat-value">{{ number_format($totalReelsAktif, 0, ',', '.') }}</div>
            <div class="jz-stat-trend">
                <i class="bi bi-graph-up-arrow"></i> Video tayang
            </div>
        </div>

        <div class="jz-stat-card jz-stat-orange">
            <div class="jz-stat-icon orange">
                <i class="bi bi-bookmark-star-fill"></i>
            </div>
            <div class="jz-stat-label">Disimpan</div>
            <div class="jz-stat-value">{{ number_format($totalSimpan, 0, ',', '.') }}</div>
            <div class="jz-stat-trend">
                <i class="bi bi-graph-up-arrow"></i> Total tersimpan
            </div>
        </div>

    </div>

    {{-- ==========================================
         SECTION: TABEL LOWONGAN
         ========================================== --}}
    <div class="jz-section-card mb-4">
        <div class="jz-section-head">
            <div>
                <h5 class="jz-section-title">Administrasi Lowongan</h5>
                <p class="jz-section-sub">Daftar lowongan pekerjaan yang baru ditambahkan</p>
            </div>
            <a href="/admin/jobs/create" class="jz-btn jz-btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Lowongan
            </a>
        </div>

        <div class="table-responsive">
            <table class="jz-table">
                <thead>
                    <tr>

                        <th style="width:38%; padding-left:24px;">Keterangan</th>
                        <th class="text-center" style="width:16%">Alamat</th>
                        <th class="text-center" style="width:16%">Kategori</th>
                        <th class="text-center" style="width:18%">Gaji</th>
                        <th class="text-center" style="width:14%">Status</th>
                        <th class="text-center" style="width:14%; padding-right:24px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowonganTerbaru as $job)
                        <tr>
                            <td style="padding-left:24px;">
                                <div class="d-flex align-items-center gap-3">
                                    @if($job->thumbnail)
                                        <img src="{{ asset('storage/' . $job->thumbnail) }}"
                                             class="jz-job-thumb-img" alt="{{ $job->title }}">
                                    @else
                                        <div class="jz-job-thumb-placeholder">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="jz-job-title">{{ $job->title }}</div>
                                        <td>
    <a href="{{ $job->location }}" target="_blank" class="btn btn-sm btn-light-danger text-truncate" style="max-width: 150px;" title="Buka di Google Maps">
        <i class="bi bi-geo-alt-fill me-1"></i> Alamat Lokasi
    </a>
</td>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="jz-badge-cat">{{ $job->category }}</span>
                            </td>
                            <td class="text-center jz-salary">
                                {{ is_numeric($job->salary) ? 'Rp ' . number_format($job->salary, 0, ',', '.') : $job->salary }}
                            </td>
                            <td class="text-center">
                                <button wire:click="toggleStatus({{ $job->id }})"
                                        class="jz-status-btn border-0 bg-transparent p-0">
                                    @if($job->status === 'open')
                                        <span class="jz-badge-open">
                                            <i class="bi bi-unlock-fill me-1"></i> Open
                                        </span>
                                    @else
                                        <span class="jz-badge-closed">
                                            <i class="bi bi-lock-fill me-1"></i> Closed
                                        </span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-center" style="padding-right:24px;">
                                <div class="jz-action-group">
                                    <button wire:click="editJob({{ $job->id }})"
                                            class="jz-btn-icon jz-btn-warn"
                                            title="Edit Lowongan">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button"
                                            wire:click="$dispatch('swal:confirm-delete', [{
                                                title: 'Apakah Anda yakin?',
                                                text: 'Data lowongan kerja ini akan dihapus secara permanen dari database!',
                                                action: 'deleteJob',
                                                id: {{ $job->id }}
                                            }])"
                                            class="jz-btn-icon jz-btn-danger"
                                            title="Hapus Lowongan">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="jz-empty-state">
                                <i class="bi bi-inbox jz-empty-icon d-block mb-2"></i>
                                Belum ada data lowongan kerja.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ==========================================
         SECTION: VIDEO REELS
         ========================================== --}}
    <div class="jz-section-card mb-4">
        <div class="jz-section-head">
            <div>
                <h5 class="jz-section-title">
                    <i class="bi bi-camera-reels me-2" style="color:#ef4444;"></i>
                    Koleksi Video Reels
                </h5>
                <p class="jz-section-sub">Manajemen video pendek kreatif lowongan kerja</p>
            </div>
            <a href="/admin/reels" class="jz-btn jz-btn-danger">
                <i class="bi bi-upload me-1"></i> Upload Reels
            </a>
        </div>

        <div class="jz-reels-grid">
            @forelse($reelsTerbaru as $reel)
                <div class="jz-reel-card">
                    {{-- Video Thumb Area --}}
                    <div class="jz-reel-thumb">
                        <video class="jz-reel-video"
                               poster="{{ $reel->thumbnail_url }}"
                               controls>
                            <source src="{{ $reel->video_url }}" type="video/mp4">
                        </video>
                        <span class="jz-reel-cat-badge">{{ $reel->category }}</span>
                        <div class="jz-reel-stats-overlay">
                            <span class="jz-reel-stat-item">
                                <i class="bi bi-heart-fill text-danger me-1"></i>
                                {{ is_array($reel->liked_by) ? count($reel->liked_by) : 0 }}
                            </span>
                            <span class="jz-reel-stat-item">
                                <i class="bi bi-bookmark-star-fill text-warning me-1"></i>
                                {{ is_array($reel->saved_by) ? count($reel->saved_by) : 0 }}
                            </span>
                        </div>
                    </div>

                    {{-- Reel Body --}}
                    <div class="jz-reel-body">
                        {{-- Admin Info --}}
                        <div wire:click="goToProfile({{ $reel->admin->id ?? '' }})"
                             class="jz-reel-admin-row">
                            <div class="jz-reel-avatar">
                                {{ strtoupper(substr($reel->admin->name ?? 'A', 0, 2)) }}
                            </div>
                            <div>
                                <div class="jz-reel-admin-name">
                                    {{ $reel->admin->name ?? 'Admin Jobza' }}
                                </div>
                                <div class="jz-reel-admin-role">Pembuat Reels</div>
                            </div>
                        </div>

                        {{-- Title & Desc --}}
                        <div class="jz-reel-title" title="{{ $reel->title }}">{{ $reel->title }}</div>
                        <div class="jz-reel-desc">{{ $reel->description ?? 'Tidak ada deskripsi.' }}</div>

                        {{-- Location & Salary --}}
                        <div class="jz-reel-meta">
                            <td>
    <a href="{{ $reel->location }}" target="_blank" class="btn btn-sm btn-light-danger text-truncate" style="max-width: 150px;" title="Buka di Google Maps">
        <i class="bi bi-geo-alt-fill me-1"></i> Alamat Lokasi
    </a>
</td>
                            <span class="jz-reel-sal">
                                {{ is_numeric($reel->salary) ? 'Rp ' . number_format($reel->salary, 0, ',', '.') : $reel->salary }}
                            </span>
                        </div>

                        {{-- Footer --}}
                        <div class="jz-reel-footer">
                            <button wire:click="toggleReelsStatus({{ $reel->id }})"
                                    class="jz-status-btn border-0 bg-transparent p-0">
                                @if($reel->status === 'open')
                                    <span class="jz-badge-open">Open</span>
                                @else
                                    <span class="jz-badge-closed">Closed</span>
                                @endif
                            </button>
                            <div class="jz-action-group">
                                <button wire:click="editReel({{ $reel->id }})"
                                        class="jz-btn-icon jz-btn-warn"
                                        title="Edit Reels">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button"
                                        wire:click="$dispatch('swal:confirm-delete', [{
                                            title: 'Hapus Video Reels?',
                                            text: 'Yakin ingin menghapus reels ini?',
                                            id: {{ $reel->id }},
                                            action: 'deleteReel'
                                        }])"
                                        class="jz-btn-icon jz-btn-danger"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 jz-empty-state" style="padding:48px 0;">
                    <i class="bi bi-camera-reels jz-empty-icon d-block mb-2"></i>
                    Belum ada koleksi video pendek terunggah.
                </div>
            @endforelse
        </div>
    </div>


    {{-- ==========================================
         MODAL: EDIT JOB
         ========================================== --}}
    <div wire:ignore.self class="modal fade" id="editJobModal"
         tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <form wire:submit.prevent="updateJob" class="w-100" enctype="multipart/form-data">
                <div class="modal-content jz-modal-content">

                    <div class="jz-modal-header">
                        <h5 class="jz-modal-title" id="editJobModalLabel">
                            <i class="bi bi-pencil-square me-2"></i>Edit Data Lowongan
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="row g-3">

                            {{-- Judul --}}
                            <div class="col-12">
                                <label class="jz-form-label">Judul Lowongan</label>
                                <input type="text" wire:model="title"
                                       class="jz-form-control @error('title') is-invalid @enderror"
                                       placeholder="Nama posisi pekerjaan">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Kategori --}}
                            <div class="col-md-6">
                                <label class="jz-form-label">Kategori</label>
                                <select wire:model="category"
                                        class="jz-form-control @error('category') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    <option value="lowongan">Lowongan</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="col-md-6">
                                <label class="jz-form-label">Lokasi</label>
                                <input type="text" wire:model="location"
                                       class="jz-form-control @error('location') is-invalid @enderror"
                                       placeholder="Contoh: Jakarta Selatan">
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Gaji --}}
                            <div class="col-md-6">
                                <label class="jz-form-label">Gaji (IDR)</label>
                                <input type="number" wire:model="salary"
                                       class="jz-form-control @error('salary') is-invalid @enderror"
                                       placeholder="Contoh: 8000000">
                                @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- WhatsApp --}}
                            <div class="col-md-6">
                                <label class="jz-form-label">WhatsApp Admin</label>
                                <input type="text" wire:model="admin_phone"
                                       class="jz-form-control @error('admin_phone') is-invalid @enderror"
                                       placeholder="628xxxxxxxxxx">
                                @error('admin_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label class="jz-form-label">Deskripsi Pekerjaan</label>
                                <textarea wire:model="description" rows="4"
                                          class="jz-form-control @error('description') is-invalid @enderror"
                                          placeholder="Jelaskan detail posisi, kualifikasi, dan benefit..."></textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12"><hr class="jz-divider"></div>

                            {{-- THUMBNAIL --}}
                            <div class="col-md-5">
                                <label class="jz-form-label">
                                    <i class="bi bi-image me-1 text-primary"></i>
                                    Cover / Thumbnail Utama
                                </label>
                                <input type="file" wire:model="thumbnail"
                                       class="jz-form-control @error('thumbnail') is-invalid @enderror"
                                       accept="image/*">

                                <div wire:loading wire:target="thumbnail" class="jz-upload-loading">
                                    <span class="spinner-border spinner-border-sm me-1"></span>
                                    Mengunggah sampul...
                                </div>

                                <small class="jz-form-hint">Satu foto utama sebagai tampilan depan lowongan.</small>
                                @error('thumbnail') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

                                <div class="mt-3">
                                    @if($thumbnail)
                                        <div class="jz-thumb-preview">
                                            <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview baru">
                                            <span class="jz-thumb-badge new">Baru</span>
                                        </div>
                                    @elseif($existingThumbnail)
                                        <div class="jz-thumb-preview">
                                            <img src="{{ asset('storage/' . $existingThumbnail) }}" alt="Thumbnail aktif">
                                            <span class="jz-thumb-badge active">Aktif</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- GALERI --}}
                            <div class="col-md-7">
                                <label class="jz-form-label">
                                    <i class="bi bi-images me-1 text-success"></i>
                                    Galeri Foto Tambahan
                                </label>
                                <input type="file" wire:model="image_url"
                                       class="jz-form-control @error('image_url.*') is-invalid @enderror"
                                       accept="image/*" multiple>

                                <div wire:loading wire:target="image_url" class="jz-upload-loading">
                                    <span class="spinner-border spinner-border-sm me-1"></span>
                                    Mentransfer gambar galeri...
                                </div>

                                <small class="jz-form-hint">Pilih beberapa foto sekaligus untuk galeri slide detail.</small>
                                @error('image_url.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

                                <div class="mt-3">
                                    {{-- Existing Images --}}
                                    @if(!empty($existingImageUrl))
                                        <p class="jz-gallery-label">Foto Aktif Saat Ini:</p>
                                        <div class="jz-gallery-grid">
                                            @foreach($existingImageUrl as $index => $oldImg)
                                                <div class="jz-gallery-item">
                                                    <button type="button"
                                                            onclick="confirmDeleteExistingImage({{ $index }})"
                                                            class="jz-gallery-remove"
                                                            title="Hapus foto ini">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                    <img src="{{ $oldImg }}" alt="Foto {{ $index + 1 }}">
                                                    <span class="jz-gallery-caption">Foto {{ $index + 1 }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- New Images --}}
                                    @if(!empty($new_images))
                                        <p class="jz-gallery-label text-primary mt-3">Antrean Baru:</p>
                                        <div class="jz-gallery-grid">
                                            @foreach($new_images as $index => $newImg)
                                                <div class="jz-gallery-item new">
                                                    <button type="button"
                                                            wire:click="removeNewImage({{ $index }})"
                                                            class="jz-gallery-remove warning"
                                                            title="Batalkan">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                    @php
                                                        $previewUrl = '';
                                                        try { $previewUrl = $newImg->temporaryUrl(); } catch(\Exception $e) {}
                                                    @endphp
                                                    @if($previewUrl)
                                                        <img src="{{ $previewUrl }}" alt="Baru {{ $index + 1 }}">
                                                    @else
                                                        <div class="jz-gallery-error">Error</div>
                                                    @endif
                                                    <span class="jz-gallery-caption success">+{{ $index + 1 }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="jz-modal-footer">
                        <button type="button" class="jz-btn jz-btn-ghost" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="jz-btn jz-btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="bi bi-check2 me-1"></i> Simpan Perubahan
                            </span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- ==========================================
         MODAL: EDIT REEL
         ========================================== --}}
    <div wire:ignore.self class="modal fade" id="editReelModal"
         tabindex="-1" aria-labelledby="editReelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form wire:submit.prevent="updateReel" class="w-100">
                <div class="modal-content jz-modal-content">

                    <div class="jz-modal-header">
                        <h5 class="jz-modal-title" id="editReelModalLabel">
                            <i class="bi bi-camera-reels me-2"></i>Edit Video Reels
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="jz-form-label">Judul Video</label>
                                <input type="text" wire:model="reelTitle"
                                       class="jz-form-control @error('reelTitle') is-invalid @enderror"
                                       placeholder="Judul menarik untuk reels">
                                @error('reelTitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="jz-form-label">Kategori</label>
                                <select wire:model="reelCategory"
                                        class="jz-form-control @error('reelCategory') is-invalid @enderror">
                                    <option value="lowongan">Lowongan</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                                @error('reelCategory') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="jz-form-label">Lokasi</label>
                                <input type="text" wire:model="reelLocation"
                                       class="jz-form-control" placeholder="Kota atau Remote">
                            </div>
                            <div class="col-md-6">
                                <label class="jz-form-label">Gaji</label>
                                <input type="text" wire:model="reelSalary"
                                       class="jz-form-control" placeholder="Rp atau Negotiable">
                            </div>
                            <div class="col-12">
                                <label class="jz-form-label">WhatsApp Admin</label>
                                <input type="text" wire:model="reelAdminPhone"
                                       class="jz-form-control" placeholder="628xxxxxxxxxx">
                            </div>
                            <div class="col-12">
                                <label class="jz-form-label">Deskripsi Reels</label>
                                <textarea wire:model="reelDescription" rows="3"
                                          class="jz-form-control @error('reelDescription') is-invalid @enderror"
                                          placeholder="Deskripsi singkat video..."></textarea>
                                @error('reelDescription') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="jz-form-label">Ganti File Video</label>
                                <input type="file" wire:model="reelVideoFile" class="jz-form-control">
                                @if($existingReelVideo && !$reelVideoFile)
                                    <small class="jz-form-hint text-success">
                                        <i class="bi bi-check-circle me-1"></i>Video aktif tersedia
                                    </small>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="jz-form-label">Ganti Cover / Thumbnail</label>
                                <input type="file" wire:model="reelThumbnailFile" class="jz-form-control">
                                <div class="mt-2">
                                    @if($existingReelThumbnail && !$reelThumbnailFile)
                                        <img src="{{ $existingReelThumbnail }}"
                                             class="jz-thumb-mini" alt="Thumbnail aktif">
                                    @endif
                                    @if($reelThumbnailFile)
                                        <img src="{{ $reelThumbnailFile->temporaryUrl() }}"
                                             class="jz-thumb-mini new" alt="Preview baru">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="jz-modal-footer">
                        <button type="button" class="jz-btn jz-btn-ghost" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="jz-btn jz-btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="bi bi-check2 me-1"></i> Simpan Reels
                            </span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Hidden Logout Form --}}
    <form id="logout-form" action="/logout" method="POST" class="d-none">
        @csrf
    </form>


    {{-- ==========================================
         JAVASCRIPT
         ========================================== --}}
    <script>
        document.addEventListener('livewire:init', () => {
            const modalJobEl  = new bootstrap.Modal(document.getElementById('editJobModal'));
            const modalReelEl = new bootstrap.Modal(document.getElementById('editReelModal'));

            Livewire.on('openEditModal',      () => modalJobEl.show());
            Livewire.on('closeEditModal',     () => modalJobEl.hide());
            Livewire.on('openEditReelModal',  () => modalReelEl.show());
            Livewire.on('closeEditReelModal', () => modalReelEl.hide());
        });

        function confirmDeleteExistingImage(index) {
            Swal.fire({
                title: 'Hapus foto ini?',
                text: 'Foto akan dihapus permanen dari server!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                borderRadius: '12px',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('confirmedRemoveExistingImage', { index: index });
                }
            });
        }
    </script>


    {{-- ==========================================
         CSS — JOBZA DESIGN SYSTEM v2.0
         ========================================== --}}
    <style>
        /* ---- IMPORT FONT ---- */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        /* ---- TOKENS ---- */
        :root {
            --jz-primary:       #1e40af;
            --jz-primary-hover: #1d4ed8;
            --jz-primary-light: #dbeafe;
            --jz-primary-mid:   #3b82f6;

            --jz-surface:       #ffffff;
            --jz-surface-2:     #f8fafc;
            --jz-surface-3:     #f1f5f9;

            --jz-border:        #e2e8f0;
            --jz-border-2:      #cbd5e1;

            --jz-text-1:        #0f172a;
            --jz-text-2:        #475569;
            --jz-text-3:        #94a3b8;

            --jz-purple:        #7c3aed;
            --jz-purple-bg:     #f5f3ff;
            --jz-red:           #dc2626;
            --jz-red-bg:        #fef2f2;
            --jz-orange:        #ea580c;
            --jz-orange-bg:     #fff7ed;
            --jz-green:         #16a34a;
            --jz-green-bg:      #f0fdf4;

            --jz-radius-sm:     8px;
            --jz-radius:        12px;
            --jz-radius-lg:     16px;
            --jz-radius-xl:     20px;

            --jz-shadow:        0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.05);
            --jz-shadow-md:     0 4px 16px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
            --jz-shadow-lg:     0 8px 32px rgba(0,0,0,.10), 0 2px 8px rgba(0,0,0,.05);

            --jz-font:          'Plus Jakarta Sans', system-ui, sans-serif;
        }

        /* ---- BASE ---- */
        .jz-topbar,
        .jz-stats-grid,
        .jz-section-card,
        .jz-table,
        .jz-reels-grid,
        .jz-modal-content,
        .jz-form-control,
        .jz-btn,
        .jz-btn-icon,
        .jz-stat-card,
        .jz-reel-card {
            font-family: var(--jz-font);
        }

        /* ---- TOP BAR ---- */
        .jz-topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .jz-page-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--jz-text-1);
            letter-spacing: -0.5px;
            margin: 0;
            line-height: 1.2;
        }

        .jz-page-sub {
            font-size: 13px;
            color: var(--jz-text-2);
            margin: 4px 0 0;
        }

        .jz-profile-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--jz-surface);
            border: 1px solid var(--jz-border);
            border-radius: var(--jz-radius);
            padding: 8px 14px;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
        }

        .jz-profile-chip:hover {
            border-color: var(--jz-primary-mid);
            box-shadow: 0 0 0 3px rgba(59,130,246,.1);
        }

        .jz-profile-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--jz-text-1);
            text-align: right;
        }

        .jz-role-badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            color: var(--jz-primary-mid);
            background: var(--jz-primary-light);
            padding: 2px 8px;
            border-radius: 20px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .jz-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--jz-primary), #1d4ed8);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(30,64,175,.25);
        }

        .jz-dropdown {
            border-radius: var(--jz-radius) !important;
            padding: 6px !important;
            min-width: 180px;
        }

        .jz-dropdown-item {
            border-radius: var(--jz-radius-sm) !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            padding: 8px 12px !important;
            transition: background .15s !important;
        }

        /* ---- STAT CARDS ---- */
        .jz-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .jz-stat-card {
            background: var(--jz-surface);
            border: 1px solid var(--jz-border);
            border-radius: var(--jz-radius-lg);
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .jz-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--jz-shadow-md);
        }

        .jz-stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
            border-radius: 4px 0 0 4px;
        }

        .jz-stat-purple::before { background: var(--jz-purple); }
        .jz-stat-blue::before   { background: var(--jz-primary-mid); }
        .jz-stat-red::before    { background: var(--jz-red); }
        .jz-stat-orange::before { background: var(--jz-orange); }

        .jz-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-bottom: 14px;
        }

        .jz-stat-icon.purple { background: var(--jz-purple-bg);   color: var(--jz-purple); }
        .jz-stat-icon.blue   { background: var(--jz-primary-light); color: var(--jz-primary-mid); }
        .jz-stat-icon.red    { background: var(--jz-red-bg);        color: var(--jz-red); }
        .jz-stat-icon.orange { background: var(--jz-orange-bg);     color: var(--jz-orange); }

        .jz-stat-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--jz-text-3);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 6px;
        }

        .jz-stat-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--jz-text-1);
            letter-spacing: -1px;
            line-height: 1;
            margin-bottom: 8px;
        }

        .jz-stat-trend {
            font-size: 11px;
            font-weight: 600;
            color: var(--jz-green);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ---- SECTION CARD ---- */
        .jz-section-card {
            background: var(--jz-surface);
            border: 1px solid var(--jz-border);
            border-radius: var(--jz-radius-xl);
            overflow: hidden;
            box-shadow: var(--jz-shadow);
        }

        .jz-section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--jz-border);
            flex-wrap: wrap;
            gap: 12px;
        }

        .jz-section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--jz-text-1);
            margin: 0;
        }

        .jz-section-sub {
            font-size: 12px;
            color: var(--jz-text-3);
            margin: 3px 0 0;
        }

        /* ---- BUTTONS ---- */
        .jz-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 16px;
            border-radius: var(--jz-radius-sm);
            font-size: 13px;
            font-weight: 700;
            font-family: var(--jz-font);
            cursor: pointer;
            border: none;
            transition: background .15s, transform .12s, box-shadow .15s;
            text-decoration: none;
        }

        .jz-btn:hover {
            transform: translateY(-1px);
        }

        .jz-btn-primary {
            background: var(--jz-primary);
            color: #fff;
            box-shadow: 0 2px 8px rgba(30,64,175,.25);
        }

        .jz-btn-primary:hover {
            background: var(--jz-primary-hover);
            color: #fff;
            box-shadow: 0 4px 12px rgba(30,64,175,.35);
        }

        .jz-btn-danger {
            background: var(--jz-red);
            color: #fff;
            box-shadow: 0 2px 8px rgba(220,38,38,.25);
        }

        .jz-btn-danger:hover {
            background: #b91c1c;
            color: #fff;
            box-shadow: 0 4px 12px rgba(220,38,38,.35);
        }

        .jz-btn-ghost {
            background: var(--jz-surface);
            color: var(--jz-text-2);
            border: 1px solid var(--jz-border-2);
        }

        .jz-btn-ghost:hover {
            background: var(--jz-surface-2);
            color: var(--jz-text-1);
        }

        .jz-btn-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--jz-radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            cursor: pointer;
            border: 1px solid;
            background: transparent;
            transition: all .15s;
            font-family: var(--jz-font);
        }

        .jz-btn-warn {
            color: #b45309;
            border-color: #fcd34d;
            background: #fffbeb;
        }

        .jz-btn-warn:hover {
            background: #fef3c7;
            border-color: #f59e0b;
        }

        .jz-btn-danger.jz-btn-icon {
            color: #dc2626;
            border-color: #fca5a5;
            background: #fff5f5;
            box-shadow: none;
        }

        .jz-btn-danger.jz-btn-icon:hover {
            background: #fee2e2;
            border-color: #f87171;
        }

        .jz-action-group {
            display: inline-flex;
            gap: 6px;
            justify-content: center;
        }

        /* ---- TABLE ---- */
        .jz-table {
            width: 100%;
            border-collapse: collapse;
        }

        .jz-table thead th {
            font-size: 11px;
            font-weight: 700;
            color: var(--jz-text-3);
            text-transform: uppercase;
            letter-spacing: .06em;
            background: var(--jz-surface-2);
            padding: 12px 16px;
            border-bottom: 1px solid var(--jz-border);
        }

        .jz-table tbody tr {
            border-bottom: 1px solid var(--jz-surface-2);
            transition: background .12s;
        }

        .jz-table tbody tr:last-child {
            border-bottom: none;
        }

        .jz-table tbody tr:hover {
            background: var(--jz-surface-2);
        }

        .jz-table td {
            padding: 14px 16px;
            vertical-align: middle;
        }

        .jz-job-thumb-img {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--jz-border);
            flex-shrink: 0;
        }

        .jz-job-thumb-placeholder {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--jz-surface-3);
            border: 1px solid var(--jz-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--jz-text-3);
            font-size: 18px;
            flex-shrink: 0;
        }

        .jz-job-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--jz-text-1);
        }

        .jz-job-loc {
            font-size: 12px;
            color: var(--jz-text-2);
            margin-top: 2px;
        }

        .jz-badge-cat {
            display: inline-block;
            background: var(--jz-surface-3);
            color: var(--jz-text-2);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: capitalize;
            border: 1px solid var(--jz-border);
        }

        .jz-salary {
            font-size: 13px;
            font-weight: 700;
            color: var(--jz-green);
        }

        .jz-badge-open {
            display: inline-flex;
            align-items: center;
            background: var(--jz-green-bg);
            color: #15803d;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 11px;
            border-radius: 20px;
            border: 1px solid #bbf7d0;
            cursor: pointer;
            transition: opacity .15s;
        }

        .jz-badge-closed {
            display: inline-flex;
            align-items: center;
            background: var(--jz-red-bg);
            color: #b91c1c;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 11px;
            border-radius: 20px;
            border: 1px solid #fecaca;
            cursor: pointer;
            transition: opacity .15s;
        }

        .jz-badge-open:hover,
        .jz-badge-closed:hover { opacity: .75; }

        .jz-status-btn { transition: opacity .15s; }

        /* ---- EMPTY STATE ---- */
        .jz-empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--jz-text-3);
            font-size: 13px;
        }

        .jz-empty-icon {
            font-size: 38px;
            opacity: .4;
        }

        /* ---- REELS GRID ---- */
        .jz-reels-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            padding: 20px 24px 24px;
        }

        .jz-reel-card {
            background: var(--jz-surface);
            border: 1px solid var(--jz-border);
            border-radius: var(--jz-radius-lg);
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .jz-reel-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--jz-shadow-lg);
        }

        .jz-reel-thumb {
            position: relative;
            height: 200px;
            background: #1e293b;
        }

        .jz-reel-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .jz-reel-cat-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0,0,0,.6);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 5px;
            text-transform: capitalize;
            backdrop-filter: blur(4px);
        }

        .jz-reel-stats-overlay {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: flex;
            gap: 8px;
            background: rgba(0,0,0,.55);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            padding: 4px 10px;
        }

        .jz-reel-stat-item {
            font-size: 11px;
            font-weight: 600;
            color: #fff;
        }

        .jz-reel-body {
            padding: 14px;
        }

        .jz-reel-admin-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .jz-reel-avatar {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform .15s;
        }

        .jz-reel-admin-row:hover .jz-reel-avatar {
            transform: scale(1.1);
        }

        .jz-reel-admin-name {
            font-size: 12px;
            font-weight: 700;
            color: var(--jz-text-1);
            transition: color .15s;
        }

        .jz-reel-admin-row:hover .jz-reel-admin-name {
            color: #4f46e5;
        }

        .jz-reel-admin-role {
            font-size: 10px;
            color: var(--jz-text-3);
        }

        .jz-reel-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--jz-text-1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 3px;
        }

        .jz-reel-desc {
            font-size: 11px;
            color: var(--jz-text-2);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 10px;
        }

        .jz-reel-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--jz-surface-2);
            border-radius: 8px;
            padding: 7px 10px;
            margin-bottom: 10px;
        }

        .jz-reel-loc {
            font-size: 11px;
            color: var(--jz-text-2);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .jz-reel-sal {
            font-size: 11px;
            font-weight: 700;
            color: var(--jz-green);
            white-space: nowrap;
            margin-left: 8px;
        }

        .jz-reel-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid var(--jz-border);
        }

        /* ---- MODAL ---- */
        .jz-modal-content {
            border: none;
            border-radius: var(--jz-radius-xl);
            overflow: hidden;
            box-shadow: var(--jz-shadow-lg);
        }

        .jz-modal-header {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .jz-modal-title {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .jz-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            border-top: 1px solid var(--jz-border);
            background: var(--jz-surface-2);
        }

        /* ---- FORM ELEMENTS ---- */
        .jz-form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--jz-text-1);
            margin-bottom: 6px;
        }

        .jz-form-control {
            display: block;
            width: 100%;
            padding: 9px 13px;
            font-size: 13px;
            font-family: var(--jz-font);
            color: var(--jz-text-1);
            background: var(--jz-surface);
            border: 1px solid var(--jz-border-2);
            border-radius: var(--jz-radius-sm);
            transition: border-color .15s, box-shadow .15s;
            appearance: none;
        }

        .jz-form-control:focus {
            outline: none;
            border-color: var(--jz-primary-mid);
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }

        .jz-form-control.is-invalid {
            border-color: var(--jz-red);
        }

        .jz-form-hint {
            display: block;
            font-size: 11px;
            color: var(--jz-text-3);
            margin-top: 5px;
        }

        .jz-upload-loading {
            font-size: 12px;
            color: var(--jz-primary-mid);
            display: flex;
            align-items: center;
            margin-top: 6px;
        }

        .jz-divider {
            border: none;
            border-top: 1px solid var(--jz-border);
            margin: 4px 0;
        }

        /* ---- THUMBNAIL PREVIEW ---- */
        .jz-thumb-preview {
            position: relative;
            display: inline-block;
        }

        .jz-thumb-preview img {
            width: 140px;
            height: 90px;
            object-fit: cover;
            border-radius: var(--jz-radius-sm);
            border: 1px solid var(--jz-border);
            display: block;
        }

        .jz-thumb-badge {
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .jz-thumb-badge.new    { background: var(--jz-primary); color: #fff; }
        .jz-thumb-badge.active { background: var(--jz-text-3);  color: #fff; }

        .jz-thumb-mini {
            width: 72px;
            height: 50px;
            object-fit: cover;
            border-radius: var(--jz-radius-sm);
            border: 1px solid var(--jz-border);
        }

        .jz-thumb-mini.new { border-color: var(--jz-primary-mid); }

        /* ---- GALLERY ---- */
        .jz-gallery-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--jz-text-2);
            margin-bottom: 8px;
        }

        .jz-gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .jz-gallery-item {
            position: relative;
            width: 88px;
            background: var(--jz-surface-2);
            border: 1px solid var(--jz-border);
            border-radius: var(--jz-radius-sm);
            padding: 6px;
            text-align: center;
        }

        .jz-gallery-item.new {
            border-color: #bbf7d0;
            background: var(--jz-green-bg);
        }

        .jz-gallery-item img {
            width: 76px;
            height: 56px;
            object-fit: cover;
            border-radius: 5px;
            display: block;
        }

        .jz-gallery-remove {
            position: absolute;
            top: -7px;
            right: -7px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--jz-red);
            color: #fff;
            border: 2px solid #fff;
            font-size: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background .15s;
        }

        .jz-gallery-remove.warning { background: #f59e0b; }
        .jz-gallery-remove:hover   { background: #b91c1c; }
        .jz-gallery-remove.warning:hover { background: #d97706; }

        .jz-gallery-error {
            width: 76px;
            height: 56px;
            background: var(--jz-surface-3);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: var(--jz-text-3);
        }

        .jz-gallery-caption {
            display: block;
            font-size: 10px;
            color: var(--jz-text-2);
            font-weight: 600;
            margin-top: 4px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .jz-gallery-caption.success { color: var(--jz-green); }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 992px) {
            .jz-stats-grid   { grid-template-columns: repeat(2, 1fr); }
            .jz-reels-grid   { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .jz-stats-grid   { grid-template-columns: repeat(2, 1fr); }
            .jz-reels-grid   { grid-template-columns: repeat(1, 1fr); }
            .jz-topbar       { flex-direction: column; }
            .jz-section-head { flex-direction: column; align-items: flex-start; }
            .jz-stat-value   { font-size: 22px; }
        }

        @media (max-width: 480px) {
            .jz-stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
        }
    </style>

</div>

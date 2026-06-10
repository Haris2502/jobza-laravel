<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class CreateJob extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.app')]

    // Properti Form Input Utama
    public $title;
    public $category;
    public $salary;
    public $location; // Diisi dengan Link/URL Google Maps langsung dari browser
    public $admin_phone;
    public $description;

    // 🌟 PROPERTI BARU: Pemisahan Unggahan File (Sama seperti sistem Reels)
    public $thumbnailFile;         // Untuk Cover Utama (Single File)
    public $temporaryPhotos = [];  // Untuk menangkap input galeri jamak dari browser
    public $photos = [];           // Tempat menampung antrean foto tambahan yang terkumpul

    protected $rules = [
        'title'         => 'required|min:5',
        'category'      => 'required|in:lowongan,freelance',
        'salary'        => 'required|numeric',
        'location'      => 'required|url', // 👈 SEKARANG WAJIB FORMAT LINK/URL GOOGLE MAPS
        'admin_phone'   => 'required',
        'description'   => 'required|min:20',
        'thumbnailFile' => 'required|image|max:5120', // Maksimal 5MB (Wajib Ada)
        'photos'        => 'nullable|array|max:5',     // Maksimal 5 foto tambahan
        'photos.*'      => 'image|max:5120',
    ];

    /**
     * Otomatis berjalan ketika user memilih foto tambahan di Input Galeri
     */
    public function updatedTemporaryPhotos()
    {
        $this->validate([
            'temporaryPhotos.*' => 'image|max:5120',
        ]);

        // Masukkan foto-foto baru ke dalam antrean galeri tanpa menghapus yang lama
        foreach ($this->temporaryPhotos as $photo) {
            $this->photos[] = $photo;
        }

        // Bersihkan penampung sementara agar bisa diisi ulang kembali
        $this->temporaryPhotos = [];
    }

    /**
     * Menghapus salah satu foto dari antrean pratinjau galeri tambahan
     */
    public function removePhoto($index)
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            // Susun ulang indeks array PHP agar tidak melompat (0, 1, 2...)
            $this->photos = array_values($this->photos);
        }
    }

    /**
     * Proses Simpan Data Loker Baru ke Database MySQL
     */
    public function save()
    {
        $this->validate();

        // 1. Simpan Cover Banner Utama (thumbnail) ke storage public
        $thumbnailPath = $this->thumbnailFile->store('jobs/thumbnails', 'public');

        // 2. Simpan Galeri Foto Tambahan (image_url) ke storage public
        $galleryPaths = [];
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $storedPath = $photo->store('jobs/gallery', 'public');
                // Ubah menjadi URL mutlak/absolute asset agar mudah dibaca oleh aplikasi User
                $galleryPaths[] = asset('public/storage/' . $storedPath);
            }
        }

        // 3. Masukkan data murni ke database MySQL melewati Model Job yang bersih (Tanpa SoftDeletes)
        Job::create([
            'title'       => $this->title,
            'category'    => strtolower($this->category),
            'salary'      => $this->salary,
            'location'    => $this->location, // Menyimpan link Google Maps murni ke kolom location
            'admin_phone' => $this->admin_phone,
            'description' => $this->description,
            'thumbnail'   => $thumbnailPath, // Path lokal untuk kebutuhan hapus fisik file nanti
            'image_url'   => $galleryPaths,  // Disimpan dalam format array/JSON berkat $casts di Model
            'status'      => 'open',
            'created_by'  => Auth::id() ?? 1, // Otomatis mengikat ke ID admin yang login
        ]);

        // Kirim sinyal sukses menggelegar ke sistem SweetAlert Layout utama
        $this->dispatch('swal:alert', [
            'icon'  => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Lowongan kerja baru berhasil diterbitkan permanen!'
        ]);

        // Kembalikan Admin ke halaman utama dashboard
        return redirect()->to('/dashboard');
    }

    public function render()
    {
        return view('livewire.admin.create-job');
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Reels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ManageReels extends Component
{
    use WithFileUploads;

    // Properti Lowongan berbasis Video Reels
    public $title, $description, $videoFile, $thumbnailFile, $category;
    public $salary, $location, $admin_phone;

    // Aturan validasi input form (Disinkronkan dengan sistem Google Maps URL)
    protected $rules = [
        'title'         => 'required|min:5',
        'description'   => 'required|min:20',
        'category'      => 'required|in:lowongan,freelance',
        'salary'        => 'nullable|string',
        'location'      => 'required|url', // 👈 SEKARANG WAJIB DIISI FORMAT LINK/URL GOOGLE MAPS
        'admin_phone'   => 'nullable|string',
        'videoFile'     => 'required|mimes:mp4,mov,avi,mkv|max:512000', // Video Max 500MB (mendukung durasi panjang)
        'thumbnailFile' => 'required|image|max:5120', // Wajib untuk poster video di Flutter
    ];

    protected $messages = [
        'videoFile.max' => 'Ukuran video terlalu besar. Maksimal 500MB.',
    ];

    public function save()
    {
        // 1. Jalankan Validasi Input
        $this->validate();

        // 2. Proses upload video ke folder public/storage/reels/videos
        $videoPath = null;
        if ($this->videoFile) {
            $videoPath = $this->videoFile->store('reels/videos', 'public');
        }

        // 3. Proses upload thumbnail cover ke folder public/storage/reels/thumbnails
        $thumbnailPath = null;
        if ($this->thumbnailFile) {
            $thumbnailPath = $this->thumbnailFile->store('reels/thumbnails', 'public');
        }

        // 4. Simpan data baru ke Database menggunakan Model Reels
        Reels::create([
            'title'         => $this->title,
            'description'   => $this->description,
            'video_url'     => $videoPath ? asset('public/storage/' . $videoPath) : null,
            'thumbnail_url' => $thumbnailPath ? asset('public/storage/' . $thumbnailPath) : null,
            'category'      => strtolower($this->category),
            'status'        => 'open',
            'salary'        => $this->salary ?? 'Negotiable',
            'location'      => $this->location, // 👈 Menyimpan link murni Google Maps ke kolom location
            'admin_phone'   => $this->admin_phone,
            'created_by'    => Auth::id() ?? 1,
        ]);

        // 5. Set Flash Message Sukses & Redirect ke dashboard
        session()->flash('message', 'Lowongan video Reels berhasil dipublikasikan!');
        return redirect()->to('/dashboard');
    }

    public function render()
    {
        return view('livewire.admin.manage-reels');
    }
}

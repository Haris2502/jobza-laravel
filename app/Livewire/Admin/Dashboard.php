<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use App\Models\Reels;

class Dashboard extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.app')]

    // Properti Form Edit Loker
    public $jobId, $title, $description, $category, $salary, $location, $admin_phone;
    public $thumbnail;             // Menampung file upload thumbnail baru (Single File)
    public $image_url = [];        // Menampung file upload slide mentah dari browser
    public $new_images = [];       // FIX MULTI-UPLOAD: Menampung kumpulan seluruh antrean foto baru secara akumulatif
    public $existingThumbnail;     // Menampung path lokal thumbnail lama dari DB
    public $existingImageUrl = []; // Menampung array list URL banner lama dari DB

    // Properti Form Edit Video Reels
    public $reelId, $reelTitle, $reelDescription, $reelCategory, $reelSalary, $reelLocation, $reelAdminPhone;
    public $reelVideoFile, $reelThumbnailFile, $existingReelVideo, $existingReelThumbnail;

    // 🌟 PERUBAHAN: Validasi lokasi dirubah menjadi wajib URL / Link Google Maps yang valid
    protected $rules = [
        'title'       => 'required|min:5',
        'description' => 'required|min:20',
        'category'    => 'required|in:lowongan,freelance',
        'salary'      => 'required|numeric',
        'location'    => 'required|url', // 👈 WAJIB LINK GOOGLE MAPS URL
        'admin_phone' => 'required',
        'thumbnail'   => 'nullable|image|max:2048',
    ];

    /**
     * Hook Otomatis Livewire: Dipicu sesaat setelah admin memilih file di input berkas galeri.
     */
    public function updatedImageUrl()
    {
        $this->validate([
            'image_url.*' => 'nullable|image|max:3072',
        ]);

        if (!empty($this->image_url)) {
            foreach ($this->image_url as $file) {
                $this->new_images[] = $file;
            }
        }

        $this->image_url = [];
    }

    /**
     * Menghapus item file tertentu dari dalam daftar antrean foto baru sebelum disimpan
     */
    public function removeNewImage($index)
    {
        if (isset($this->new_images[$index])) {
            unset($this->new_images[$index]);
            $this->new_images = array_values($this->new_images);
        }
    }

    public function toggleStatus($id)
    {
        $job = Job::find($id);
        if ($job) {
            $job->status = ($job->status === 'open') ? 'closed' : 'open';
            $job->save();

            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Status loker berhasil diperbarui!'
            ]);
        }
    }

    public function editJob($id)
    {
        $this->resetErrorBag();
        $job = Job::findOrFail($id);

        $this->jobId             = $job->id;
        $this->title             = $job->title;
        $this->description       = $job->description;
        $this->category          = $job->category;
        $this->salary            = $job->salary;
        $this->location          = $job->location;
        $this->admin_phone       = $job->admin_phone;
        $this->existingThumbnail = $job->thumbnail;
        $this->existingImageUrl  = is_array($job->image_url) ? $job->image_url : (json_decode($job->image_url, true) ?? []);

        $this->thumbnail         = null;
        $this->image_url         = [];
        $this->new_images        = [];

        $this->dispatch('openEditModal');
    }

    #[On('confirmedRemoveExistingImage')]
    public function confirmedRemoveExistingImage($index)
    {
        if (isset($this->existingImageUrl[$index])) {
            $urlToDelete = $this->existingImageUrl[$index];

            $cleanPath = str_replace(asset('storage/'), '', $urlToDelete);
            Storage::disk('public')->delete($cleanPath);

            unset($this->existingImageUrl[$index]);
            $this->existingImageUrl = array_values($this->existingImageUrl);

            $job = Job::find($this->jobId);
            if ($job) {
                $job->update([
                    'image_url' => $this->existingImageUrl
                ]);
            }

            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Foto tambahan berhasil dihapus!'
            ]);
        }
    }

    public function updateJob()
    {
        $this->validate();

        $job = Job::findOrFail($this->jobId);

        $thumbnailPath = $this->existingThumbnail;
        if ($this->thumbnail) {
            if ($job->thumbnail) {
                Storage::disk('public')->delete($job->thumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('jobs/thumbnails', 'public');
        }

        $finalBannersArray = $this->existingImageUrl;

        if (!empty($this->new_images)) {
            foreach ($this->new_images as $file) {
                $storedPath = $file->store('jobs/banners', 'public');
                $finalBannersArray[] = asset('storage/' . $storedPath);
            }
        }

        $job->update([
            'title'       => $this->title,
            'description' => $this->description,
            'category'    => strtolower($this->category),
            'salary'      => $this->salary,
            'location'    => $this->location, // 👈 Menyimpan link murni Google Maps
            'admin_phone' => $this->admin_phone,
            'thumbnail'   => $thumbnailPath,
            'image_url'   => $finalBannersArray,
        ]);

        $this->reset(['thumbnail', 'image_url', 'new_images', 'jobId', 'existingImageUrl', 'existingThumbnail']);
        $this->dispatch('closeEditModal');

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Loker berhasil diperbarui!'
        ]);
    }

    #[On('deleteJob')]
    public function deleteJob($id)
    {
        $targetId = null;

        if (is_array($id)) {
            if (isset($id['id'])) {
                $targetId = $id['id'];
            } elseif (isset($id[0]['id'])) {
                $targetId = $id[0]['id'];
            } elseif (isset($id[0])) {
                $targetId = $id[0];
            }
        } else {
            $targetId = $id;
        }

        if (!$targetId) {
            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Gagal Menghapus!',
                'text' => 'Sistem Livewire gagal menerjemahkan ID data dari browser.'
            ]);
            return;
        }

        $job = Job::find($targetId);
        if ($job) {
            if ($job->thumbnail) {
                Storage::disk('public')->delete($job->thumbnail);
            }

            $banners = is_array($job->image_url) ? $job->image_url : (json_decode($job->image_url, true) ?? []);
            if (is_array($banners)) {
                foreach ($banners as $url) {
                    $path = str_replace(asset('storage/'), '', $url);
                    Storage::disk('public')->delete($path);
                }
            }

            $job->delete();

            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Terhapus!',
                'text' => 'Data lowongan kerja berhasil dihapus permanen dari database.'
            ]);
        } else {
            $directDelete = Job::where('id', $targetId)->delete();

            if ($directDelete) {
                $this->dispatch('swal:alert', [
                    'icon' => 'success',
                    'title' => 'Terhapus!',
                    'text' => 'Data dibersihkan secara langsung dari database MySQL.'
                ]);
            } else {
                $this->dispatch('swal:alert', [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Data tidak ditemukan di database atau sudah terhapus sebelumnya.'
                ]);
            }
        }
    }

    public function toggleReelsStatus($id)
    {
        $reel = Reels::find($id);
        if ($reel) {
            $reel->status = ($reel->status === 'open') ? 'closed' : 'open';
            $reel->save();

            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Status Reels berhasil diperbarui!'
            ]);
        }
    }

    public function editReel($id)
    {
        $this->resetErrorBag();
        $reel = Reels::findOrFail($id);
        $this->reelId                = $reel->id;
        $this->reelTitle             = $reel->title;
        $this->reelDescription       = $reel->description;
        $this->reelCategory          = $reel->category;
        $this->reelSalary            = $reel->salary;
        $this->reelLocation          = $reel->location;
        $this->reelAdminPhone        = $reel->admin_phone;
        $this->existingReelVideo     = $reel->video_url;
        $this->existingReelThumbnail = $reel->thumbnail_url;

        $this->reelVideoFile         = null;
        $this->reelThumbnailFile     = null;

        $this->dispatch('openEditReelModal');
    }

    public function updateReel()
    {
        // 🌟 PERUBAHAN: Validasi lokasi Reels disesuaikan menjadi wajib URL murni Google Maps
        $this->validate([
            'reelTitle'         => 'required|min:5',
            'reelDescription'   => 'required|min:20',
            'reelCategory'      => 'required|in:lowongan,freelance',
            'reelSalary'        => 'nullable|string',
            'reelLocation'      => 'required|url', // 👈 WAJIB LINK MAPS DI FORM EDIT REELS
            'reelAdminPhone'    => 'nullable|string',
            'reelVideoFile'     => 'nullable|mimes:mp4,mov,avi,mkv|max:51200',
            'reelThumbnailFile' => 'nullable|image|max:5120',
        ]);

        $reel = Reels::findOrFail($this->reelId);

        $videoUrl = $this->existingReelVideo;
        if ($this->reelVideoFile) {
            if ($reel->video_url) {
                $oldPath = str_replace(asset('storage/'), '', $reel->video_url);
                Storage::disk('public')->delete($oldPath);
            }
            $videoPath = $this->reelVideoFile->store('reels/videos', 'public');
            $videoUrl = asset('storage/' . $videoPath);
        }

        $thumbnailUrl = $this->existingReelThumbnail;
        if ($this->reelThumbnailFile) {
            if ($reel->thumbnail_url) {
                $oldThumbPath = str_replace(asset('storage/'), '', $reel->thumbnail_url);
                Storage::disk('public')->delete($oldThumbPath);
            }
            $thumbnailPath = $this->reelThumbnailFile->store('reels/thumbnails', 'public');
            $thumbnailUrl = asset('storage/' . $thumbnailPath);
        }

        $reel->update([
            'title'         => $this->reelTitle,
            'description'   => $this->reelDescription,
            'category'      => strtolower($this->reelCategory),
            'salary'        => $this->reelSalary,
            'location'      => $this->reelLocation, // 👈 Menyimpan link murni Google Maps untuk Reels
            'admin_phone'   => $this->reelAdminPhone,
            'video_url'     => $videoUrl,
            'thumbnail_url' => $thumbnailUrl,
        ]);

        $this->reset(['reelVideoFile', 'reelThumbnailFile', 'reelId']);
        $this->dispatch('closeEditReelModal');

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Konten Video Reels berhasil diperbarui!'
        ]);
    }

    #[On('deleteReel')]
    public function deleteReel($id)
    {
        $targetReelId = null;

        if (is_array($id)) {
            if (isset($id['id'])) {
                $targetReelId = $id['id'];
            } elseif (isset($id[0]['id'])) {
                $targetReelId = $id[0]['id'];
            } elseif (isset($id[0])) {
                $targetReelId = $id[0];
            }
        } else {
            $targetReelId = $id;
        }

        $reel = Reels::find($targetReelId);

        if ($reel) {
            if ($reel->video_url) {
                $videoPath = str_replace(asset('storage/'), '', $reel->video_url);
                Storage::disk('public')->delete($videoPath);
            }
            if ($reel->thumbnail_url) {
                $thumbPath = str_replace(asset('storage/'), '', $reel->thumbnail_url);
                Storage::disk('public')->delete($thumbPath);
            }
            $reel->delete();

            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Terhapus!',
                'text' => 'Konten Video Reels berhasil dihapus.'
            ]);
        } else {
            Reels::where('id', $targetReelId)->delete();
            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Terhapus!',
                'text' => 'Konten Video Reels dibersihkan dari database.'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function goToProfile($adminId)
    {
        if (!$adminId) {
            return;
        }
        return redirect()->route('admin.profile', ['id' => $adminId]);
    }

    public function render()
    {
        $adminId = Auth::id();

        $lowonganTerbaru = Job::where('created_by', $adminId)->latest()->get();
        $myReels = Reels::where('created_by', $adminId)->get();

        $totalLikesCount = 0;
        $totalSavesCount = 0;

        foreach ($myReels as $reel) {
            $likedArray = is_string($reel->liked_by) ? json_decode($reel->liked_by, true) : $reel->liked_by;
            $savedArray = is_string($reel->saved_by) ? json_decode($reel->saved_by, true) : $reel->saved_by;

            $totalLikesCount += is_array($likedArray) ? count($likedArray) : 0;
            $totalSavesCount += is_array($savedArray) ? count($savedArray) : 0;
        }

        $reelsTerbaru = Reels::with('user')
            ->where('created_by', $adminId)
            ->latest()
            ->get()
            ->map(function($reel) {
                $reel->liked_by = is_string($reel->liked_by) ? json_decode($reel->liked_by, true) : $reel->liked_by;
                $reel->saved_by = is_string($reel->saved_by) ? json_decode($reel->saved_by, true) : $reel->saved_by;
                return $reel;
            });

        return view('livewire.admin.dashboard', [
            'totalLokerAktif' => Job::where('created_by', $adminId)->where('status', 'open')->count(),
            'totalReelsAktif' => Reels::where('created_by', $adminId)->where('status', 'open')->count(),
            'totalLike'       => $totalLikesCount,
            'totalLikesCount' => $totalLikesCount,
            'totalSimpan'     => $totalSavesCount,
            'totalSave'       => $totalSavesCount,
            'totalSavesCount' => $totalSavesCount,
            'lowonganTerbaru' => $lowonganTerbaru,
            'reelsTerbaru'    => $reelsTerbaru
        ]);
    }
}

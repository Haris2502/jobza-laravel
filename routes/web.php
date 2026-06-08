<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\CreateJob;
use App\Livewire\Admin\ManageReels;
use App\Livewire\Admin\Profile as AdminProfile;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

// Guest Routes (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

// Protected Routes (Sudah Login)
Route::middleware('auth')->group(function () {
    // Rute Profil Admin & Legalitas Perusahaan (tanpa middleware profile.complete)
    Route::get('/admin/profile', AdminProfile::class)
        ->name('admin.profile');

    // Rute Fungsi Akses Logout (tanpa middleware profile.complete)
    Route::any('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

    // Rute yang membutuhkan profile lengkap terlebih dahulu
    Route::middleware('profile.complete')->group(function () {
        // Rute Dashboard Utama
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        // Rute Administrasi Lowongan Pekerjaan
        Route::get('/admin/jobs/create', CreateJob::class)
            ->name('admin.jobs.create');

        // Rute Koleksi Video Reels
        Route::get('/admin/reels', ManageReels::class)
            ->name('admin.reels.index');
    });
});

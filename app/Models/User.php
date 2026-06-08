<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Tambahkan import ini
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    /**
     * Relasi Many-to-Many ke Reels melalui tabel pivot saved_reels
     * Mengambil daftar video reels yang disimpan oleh User ini.
     */
    public function savedReels(): BelongsToMany
    {
        // Parameter 1: Nama model target (Reels kamu, ganti 'Reel::class' jika nama modelmu 'Reels::class')
        // Parameter 2: Nama tabel pivot/jembatan di database
        // Parameter 3: Foreign key dari model asal (user_id)
        // Parameter 4: Foreign key dari model target (reel_id)
        return $this->belongsToMany(Reel::class, 'saved_reels', 'user_id', 'reel_id')->withTimestamps();
    }

    /**
     * Relasi ke Profile (One-to-One)
     * Setiap User memiliki satu detail data profil pendukung.
     */
    public function profile(): HasOne
    {
        // Mendefinisikan 'user_id' secara eksplisit agar sinkron dengan file migrasi
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * Relasi ke Job (One-to-Many)
     * User membuat lowongan pekerjaan (Khusus Admin/Pemberi Kerja).
     */
    public function jobs(): HasMany
    {
        // Disesuaikan jika primary creator didefinisikan lewat 'created_by'
        return $this->hasMany(Job::class, 'created_by');
    }

    /**
     * Relasi ke Application (One-to-Many)
     * Mengambil daftar berkas lamaran kerja yang dikirimkan oleh User (Pelamar).
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    /**
     * Relasi ke Admin Profile (One-to-One)
     */
    public function adminProfile(): HasOne
    {
        return $this->hasOne(AdminProfile::class, 'user_id');
    }
}

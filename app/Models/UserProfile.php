<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'user_profiles';

    // Mendaftarkan kolom yang diizinkan untuk manipulasi data massal
    protected $fillable = [
        'user_id',
        'avatar',
        'phone_number',
        'bio',
        'resume_url',
        'education',
    ];

    /**
     * Relasi ke entitas utama User (Satu profil dimiliki oleh satu User).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedReel extends Model
{
    // Tentukan nama tabel jika nama tabelmu di database memakai custom name (Opsional)
    // protected $table = 'saved_reels';

    // Izinkan kolom user_id dan reel_id diisi massal oleh controller
    protected $fillable = [
        'user_id',
        'reel_id',
    ];

    /**
     * Relasi ke model User
     * Mengindikasikan siapa user yang menyimpan reel ini
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Reel (atau Reels, sesuaikan nama file model videomu)
     * Mengindikasikan video reel mana yang disimpan
     */
    public function reel(): BelongsTo
    {
        // Ganti 'Reel::class' sesuai dengan nama Model Video Reels kamu yang sebenarnya (misal: Reels::class atau VideoReel::class)
        return $this->belongsTo(Reel::class, 'reel_id');
    }
}

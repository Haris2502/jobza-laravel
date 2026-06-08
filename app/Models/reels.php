<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 🌟 PERBAIKAN: Baris SoftDeletes di bawah ini dibuang / tidak digunakan lagi
// use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reels extends Model
{
    // 🌟 PERBAIKAN: Hapus 'SoftDeletes' dari list use di bawah ini
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'reels';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'thumbnail_url',
        'category',
        'status',
        'salary',
        'location',
        'admin_phone',
        'liked_by', 
        'saved_by', 
        'created_by',
    ];

    /**
     * Otomatis mengubah format data JSON database menjadi Array PHP.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'liked_by' => 'array',
        'saved_by' => 'array',
    ];

    /**
     * Relasi ke model User (Banyak Reels dibuat oleh satu User).
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'name',     // Tambahkan ini
        'cv_url',   // Tambahkan ini
        'message',  // Tambahkan ini
        'status'
    ];

    /**
     * Relasi ke User: Satu lamaran dimiliki oleh satu User (Pelamar)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Job: Satu lamaran ditujukan untuk satu Pekerjaan
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

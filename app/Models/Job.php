<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'category',
        'status',
        'salary',
        'location',
        'admin_phone',
        'image_url', 
        'created_by'
    ];

    protected $casts = [
        'image_url' => 'array', 
    ];

    /**
     * Relasi ke data Admin/User yang membuat lowongan
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_tags');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function adminProfile()
{
    // Gunakan belongsTo jika tabel jobs memiliki foreign key langsung ke profil admin
    return $this->belongsTo(AdminProfile::class, 'created_by', 'user_id');
}
}
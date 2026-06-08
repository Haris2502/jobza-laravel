<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminProfile extends Model
{
    use HasFactory;

    /**
     * Mengunci nama tabel secara eksplisit ke 'admin_profiles'.
     *
     * @var string
     */
    protected $table = 'admin_profiles';

    /**
     * Atribut yang diizinkan untuk pengisian data massal (Mass Assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'company_logo',
        'company_website',
        'industry_type',
        'company_description',
        'office_address',
    ];

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    /**
     * Relasi balik ke User (One-to-One Inverse)
     * Setiap data profil admin merujuk pada satu User pemiliknya (dengan role admin/company).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

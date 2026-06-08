<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompleted
{
    /**
     * Menangani permintaan yang masuk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Ambil data relasi adminProfile
            $profile = $user->adminProfile;

            // Jika belum punya profil, atau nama perusahaan masih kosong
            // Dan jika mereka SEKARANG TIDAK sedang berada di halaman profil atau rute logout
            if ((!$profile || empty($profile->company_name)) &&
                !$request->routeIs('admin.profile') &&
                !$request->routeIs('logout')) {

                // Alihkan paksa ke halaman profil dengan pesan peringatan
                return redirect()->route('admin.profile')
                    ->with('profile_warning', 'Anda wajib melengkapi informasi profil & instansi perusahaan terlebih dahulu sebelum mengakses fitur lainnya!');
            }
        }

        return $next($request);
    }
}

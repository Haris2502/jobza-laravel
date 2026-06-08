<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan apakah rolenya sesuai
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, kasih pesan error
        return response()->json([
            'message' => 'Terlarang: Anda tidak memiliki akses untuk role ' . $role
        ], 403);
    }
}

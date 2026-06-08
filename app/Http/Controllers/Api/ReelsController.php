<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reels;
use Illuminate\Http\Request;

class ReelsController extends Controller
{
    /**
     * Mengambil semua daftar reels beserta data profile admin terkait.
     */
    public function index()
    {
        $reels = Reels::with(['user.adminProfile'])->latest()->get()->map(function ($reel) {
            $likedBy = is_array($reel->liked_by) ? $reel->liked_by : json_decode($reel->liked_by, true) ?? [];
            $savedBy = is_array($reel->saved_by) ? $reel->saved_by : json_decode($reel->saved_by, true) ?? [];

            $likedBy = array_values(array_unique(array_map('intval', $likedBy)));
            $savedBy = array_values(array_unique(array_map('intval', $savedBy)));

            $user = $reel->user;
            $adminProfile = $user ? $user->adminProfile : null;

            return [
                'id' => $reel->id,
                'title' => $reel->title,
                'description' => $reel->description,
                'video_url' => $reel->video_url,
                'thumbnail_url' => $reel->thumbnail_url,
                'category' => $reel->category,
                'status' => $reel->status,
                'salary' => $reel->salary,
                'location' => $reel->location,
                'created_by' => $reel->created_by,

                'admin_name' => $user->name ?? 'Admin Tidak Diketahui',
                'admin_email' => $user->email ?? '-',
                'admin_phone' => $reel->admin_phone ?? ($user->phone ?? '-'),

                'company_name' => $adminProfile->company_name ?? 'Perusahaan Tidak Terdaftar',
                'company_logo' => $adminProfile->company_logo ?? null,
                'company_website' => $adminProfile->company_website ?? '-',
                'industry_type' => $adminProfile->industry_type ?? '-',
                'company_description' => $adminProfile->company_description ?? '-',
                'office_address' => $adminProfile->office_address ?? 'Alamat Tidak Tersedia',

                'likes_count' => count($likedBy),
                'saves_count' => count($savedBy),
                'liked_by' => $likedBy,
                'saved_by' => $savedBy,
            ];
        });

        return response()->json(['success' => true, 'data' => $reels], 200);
    }

    /**
     * Menambah atau menghapus Like (Toggle Like)
     */
    public function toggleLike(Request $request, $id)
    {
        $reel = Reels::findOrFail($id);
        $userId = intval($request->input('user_id'));

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User ID murni diperlukan'], 400);
        }

        $likedBy = is_array($reel->liked_by) ? $reel->liked_by : json_decode($reel->liked_by, true) ?? [];
        $likedBy = array_values(array_unique(array_map('intval', $likedBy)));

        if (in_array($userId, $likedBy)) {
            $likedBy = array_values(array_diff($likedBy, [$userId]));
        } else {
            $likedBy[] = $userId;
        }

        $reel->liked_by = json_encode(array_values(array_map('intval', $likedBy)));
        $reel->save();

        return response()->json([
            'success' => true,
            'likes_count' => count($likedBy),
            'liked_by' => array_values(array_map('intval', $likedBy)),
        ], 200);
    }

    /**
     * Menambah atau menghapus Simpan (Toggle Save)
     */
    public function toggleSave(Request $request, $id)
    {
        $reel = Reels::findOrFail($id);
        $userId = intval($request->input('user_id'));

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User ID murni diperlukan'], 400);
        }

        $savedBy = is_array($reel->saved_by) ? $reel->saved_by : json_decode($reel->saved_by, true) ?? [];
        $savedBy = array_values(array_unique(array_map('intval', $savedBy)));

        if (in_array($userId, $savedBy)) {
            $savedBy = array_values(array_diff($savedBy, [$userId]));
            $status = 'unsaved';
        } else {
            $savedBy[] = $userId;
            $status = 'saved';
        }

        $reel->saved_by = json_encode(array_values(array_map('intval', $savedBy)));
        $reel->save();

        return response()->json([
            'success' => true,
            'status' => $status,
            'saves_count' => count($savedBy),
            'saved_by' => array_values(array_map('intval', $savedBy)),
        ], 200);
    }

    /**
     * Mengambil daftar Reels yang disimpan oleh User tertentu untuk halaman Profile
     */
    public function getSavedReels(Request $request)
    {
        // Mendukung request POST (body json) maupun GET (query param) dari Flutter
        $userId = intval($request->input('user_id') ?? $request->query('user_id'));

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User ID murni diperlukan'], 400);
        }

        $savedReels = Reels::with(['user.adminProfile'])
            ->where(function($query) use ($userId) {
                $query->whereJsonContains('saved_by', $userId)
                      ->orWhere('saved_by', 'LIKE', '%"' . $userId . '"%')
                      ->orWhere('saved_by', 'LIKE', '%' . $userId . '%');
            })
            ->latest()
            ->get()
            ->map(function ($reel) {
                $likedBy = is_array($reel->liked_by) ? $reel->liked_by : json_decode($reel->liked_by, true) ?? [];
                $savedBy = is_array($reel->saved_by) ? $reel->saved_by : json_decode($reel->saved_by, true) ?? [];

                $likedBy = array_values(array_unique(array_map('intval', $likedBy)));
                $savedBy = array_values(array_unique(array_map('intval', $savedBy)));

                $user = $reel->user;
                $adminProfile = $user ? $user->adminProfile : null;

                return [
                    'id' => $reel->id,
                    'title' => $reel->title,
                    'description' => $reel->description,
                    'video_url' => $reel->video_url,
                    'thumbnail_url' => $reel->thumbnail_url,
                    'category' => $reel->category,
                    'status' => $reel->status,
                    'salary' => $reel->salary,
                    'location' => $reel->location,
                    'created_by' => $reel->created_by,

                    'admin_name' => $user->name ?? 'Admin Tidak Diketahui',
                    'admin_email' => $user->email ?? '-',
                    'admin_phone' => $reel->admin_phone ?? ($user->phone ?? '-'),

                    'company_name' => $adminProfile->company_name ?? 'Perusahaan Tidak Terdaftar',
                    'company_logo' => $adminProfile->company_logo ?? null,
                    'company_website' => $adminProfile->company_website ?? '-',
                    'industry_type' => $adminProfile->industry_type ?? '-',
                    'company_description' => $adminProfile->company_description ?? '-',
                    'office_address' => $adminProfile->office_address ?? 'Alamat Tidak Tersedia',

                    'likes_count' => count($likedBy),
                    'saves_count' => count($savedBy),
                    'liked_by' => $likedBy,
                    'saved_by' => $savedBy,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil saved reels',
            'data' => $savedReels
        ], 200);
    }
}

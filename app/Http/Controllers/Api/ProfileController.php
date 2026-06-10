<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan data profil user berdasarkan ID user.
     */
    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);

        if (!$user->profile) {
            $user->profile()->create([
                'avatar' => null,
                'phone_number' => null,
                'bio' => null,
                'resume_url' => null,
                'education' => null,
            ]);
            $user->load('profile');
        }

        $userData = $user->toArray();
        $userData['user_profile'] = $userData['profile'];
        unset($userData['profile']);

        return response()->json([
            'status' => 'success',
            'data' => $userData
        ], 200);
    }

    /**
     * Perbarui data profil user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $profile = UserProfile::firstOrCreate(['user_id' => $user->id]);

        $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'nullable|string',
            'bio'          => 'nullable|string',
            'education'    => 'nullable|string',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'resume'       => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->save();

        $profile->phone_number = $request->input('phone_number');
        $profile->bio = $request->input('bio');
        $profile->education = $request->input('education');

        if ($request->hasFile('avatar')) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        if ($request->hasFile('resume')) {
            if ($profile->resume_url && Storage::disk('public')->exists($profile->resume_url)) {
                Storage::disk('public')->delete($profile->resume_url);
            }

            $path = $request->file('resume')->store('resumes', 'public');
            $profile->resume_url = $path;
        }

        $profile->save();

        $user->load('profile');

        $userData = $user->toArray();
        $userData['user_profile'] = $userData['profile'];
        unset($userData['profile']);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui!',
            'data' => $userData
        ], 200);
    }

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => User::with('profile')->get()
        ]);
    }

    public function destroy($id)
    {
        $profile = UserProfile::findOrFail($id);
        $profile->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil dihapus.'
        ]);
    }

    public function downloadResume($userId)
    {
        $profile = UserProfile::where('user_id', $userId)->first();

        if (!$profile || !$profile->resume_url) {
            return response()->json(['message' => 'Resume tidak ditemukan'], 404);
        }

        $path = storage_path('app/public/' . $profile->resume_url);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        return response()->download($path, basename($profile->resume_url), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($profile->resume_url) . '"',
        ]);
    }

    public function downloadAvatar($userId)
    {
        $profile = UserProfile::where('user_id', $userId)->first();

        if (!$profile || !$profile->avatar) {
            return response()->json(['message' => 'Avatar tidak ditemukan'], 404);
        }

        $path = storage_path('app/public/' . $profile->avatar);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        $mime = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    public function downloadCompanyLogo($adminId)
    {
        $adminProfile = \App\Models\AdminProfile::where('user_id', $adminId)->first();

        if (!$adminProfile || !$adminProfile->company_logo) {
            return response()->json(['message' => 'Logo tidak ditemukan'], 404);
        }

        $path = storage_path('app/public/' . $adminProfile->company_logo);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        $mime = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}

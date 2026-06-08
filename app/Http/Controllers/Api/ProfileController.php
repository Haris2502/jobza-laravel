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
        // Temukan user berdasarkan ID, load relasi profile
        $user = User::with('profile')->findOrFail($id);

        // Jika profile belum ada, kita buatkan profile kosong agar tidak Null
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

        // Map relasi agar sesuai dengan key 'user_profile' yang diharapkan Flutter
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
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Cari atau buat profil baru jika belum ada
        $profile = UserProfile::firstOrCreate(['user_id' => $user->id]);

        // Validasi input
        $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'nullable|string',
            'bio'          => 'nullable|string',
            'education'    => 'nullable|string',
            'resume'       => 'nullable|file|mimes:pdf|max:2048', // Maksimal 2MB PDF
        ]);

        // Update nama user di tabel users
        $user->name = $request->input('name');
        $user->save();

        // Update data teks profil
        $profile->phone_number = $request->input('phone_number');
        $profile->bio = $request->input('bio');
        $profile->education = $request->input('education');

        // Logika upload file resume jika ada file baru yang diunggah
        if ($request->hasFile('resume')) {
            // Hapus file resume lama jika ada di storage demi menghemat ruang
            if ($profile->resume_url && Storage::disk('public')->exists($profile->resume_url)) {
                Storage::disk('public')->delete($profile->resume_url);
            }

            // Simpan file baru ke folder 'resumes' di dalam direktori public storage
            $path = $request->file('resume')->store('resumes', 'public');
            $profile->resume_url = $path;
        }

        $profile->save();

        // Reload relasi profile
        $user->load('profile');

        // Map relasi agar sesuai dengan key 'user_profile' yang diharapkan Flutter
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
}

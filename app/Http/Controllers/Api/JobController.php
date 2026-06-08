<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class JobController extends Controller
{
    // 1. Ambil semua daftar lowongan beserta profil admin & perusahaan
    public function index()
    {
        // ✨ FIX UTAMA: Mengambil data pekerjaan beserta relasi berantai user dan adminProfile-nya
        // Pastikan di dalam file App\Models\User.php kamu sudah memiliki fungsi public function adminProfile()
        $jobs = Job::with(['user.adminProfile'])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $jobs
        ], 200);
    }

    // 2. Simpan lowongan baru (POST)
    public function store(Request $request)
    {
        // --- VALIDATOR ---
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string',
            'description' => 'required',
            'category'    => 'required|in:lowongan,freelance',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:10000', // Key Postman: image
            'admin_phone' => 'required|string',
            'location'    => 'nullable|string',
            'salary'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // --- PROSES UPLOAD GAMBAR ---
        $imageUrl = null;
        $thumbnailPath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_job_' . str_replace(' ', '_', $file->getClientOriginalName());

            if (!File::isDirectory(public_path('images'))) {
                File::makeDirectory(public_path('images'), 0777, true, true);
            }

            $file->move(public_path('images'), $fileName);
            $imageUrl = url('images/' . $fileName);
            $thumbnailPath = 'images/' . $fileName;
        }

        // --- SIMPAN KE DATABASE ---
        $job = Job::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'thumbnail'   => $thumbnailPath,
            'image_url'   => $imageUrl,
            'location'    => $request->location ?? 'Remote',
            'salary'      => $request->salary ?? 'Negotiable',
            'admin_phone' => $request->admin_phone,
            'status'      => 'open', // Otomatis 'open' agar tidak memicu error data truncated
            'created_by'  => auth()->id() ?? 3,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Job Created Successfully!',
            'data'    => $job
        ], 201);
    }

    // 3. Detail satu pekerjaan beserta profil admin & perusahaan
    public function show($id)
    {
        // ✨ FIX UTAMA: Menyertakan relasi berantai saat memanggil detail data pekerjaan tunggal
        $job = Job::with(['user.adminProfile'])->find($id);

        if (!$job) {
            return response()->json(['message' => 'Job Not Found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $job
        ], 200);
    }

    // 4. Update pekerjaan (PUT / POST jika via form-data Postman)
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        if (!$job) return response()->json(['message' => 'Job Not Found'], 404);

        // Validasi opsional untuk update
        $validator = Validator::make($request->all(), [
            'title'       => 'sometimes|string',
            'category'    => 'sometimes|in:lowongan,freelance',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10000',
            'admin_phone' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Ambil semua data inputan request
        $input = $request->all();

        // Jalankan proses ganti gambar jika admin mengunggah file gambar baru
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_job_' . str_replace(' ', '_', $file->getClientOriginalName());

            // Hapus file gambar lama di server agar tidak menumpuk sampah storage
            if ($job->thumbnail && File::exists(public_path($job->thumbnail))) {
                File::delete(public_path($job->thumbnail));
            }

            $file->move(public_path('images'), $fileName);

            // Masukkan data path baru ke array update
            $input['image_url'] = url('images/' . $fileName);
            $input['thumbnail'] = 'images/' . $fileName;
        }

        $job->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Job Updated Successfully!',
            'data'    => $job
        ], 200);
    }

    // 5. Hapus pekerjaan
    public function destroy($id)
    {
        $job = Job::find($id);
        if (!$job) return response()->json(['message' => 'Job Not Found'], 404);

        // Hapus file fisik gambar di folder public sebelum menghapus record database
        if ($job->thumbnail && File::exists(public_path($job->thumbnail))) {
            File::delete(public_path($job->thumbnail));
        }

        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job Deleted Successfully!'
        ], 200);
    }
}
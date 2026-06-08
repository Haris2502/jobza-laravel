<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class Profile extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.app')]

    // Properti Data Utama Akun (User)
    public $name;
    public $email;

    // Properti Data Profil Perusahaan (AdminProfile)
    public $company_name;
    public $company_logo; // Untuk input file upload baru
    public $existing_company_logo; // Untuk menyimpan path logo saat ini
    public $company_website;
    public $industry_type;
    public $company_description;
    public $office_address;

    // Properti Ganti Password
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    /**
     * Mengambil data gabungan User dan AdminProfile saat halaman dimuat
     */
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

        // Ambil data dari relasi adminProfile (jika belum ada, buat instansiasi kosong agar tidak error)
        $profile = $user->adminProfile ?? null;

        if ($profile) {
            $this->company_name        = $profile->company_name;
            $this->existing_company_logo = $profile->company_logo;
            $this->company_website     = $profile->company_website;
            $this->industry_type       = $profile->industry_type;
            $this->company_description = $profile->company_description;
            $this->office_address      = $profile->office_address;
        }
    }

    /**
     * Memperbarui Informasi Profil Akun & Data Instansi/Perusahaan
     */
    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name'                => 'required|string|min:3|max:255',
            'email'               => 'required|email|max:255|unique:users,email,' . $user->id,
            'company_name'        => 'required|string|max:255',
            'company_logo'        => 'nullable|image|max:2048', // Maksimal 2MB
            'company_website'     => 'nullable|url|max:255',
            'industry_type'       => 'nullable|string|max:100',
            'company_description' => 'nullable|string|min:10',
            'office_address'      => 'nullable|string|max:500',
        ], [
            'name.required'         => 'Nama admin wajib diisi.',
            'company_name.required' => 'Nama perusahaan/instansi wajib diisi.',
            'company_logo.image'    => 'Berkas berkas logo harus berupa gambar.',
            'company_logo.max'      => 'Ukuran logo tidak boleh lebih dari 2MB.',
            'company_website.url'   => 'Format alamat website tidak valid (gunakan http:// atau https://).',
        ]);

        // 1. Update Data User Utama
        $user->update([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        // 2. Handle Upload Logo Perusahaan jika ada file baru
        $logoPath = $this->existing_company_logo;
        if ($this->company_logo) {
            // Hapus logo lama dari storage jika sebelumnya sudah ada
            if ($this->existing_company_logo) {
                Storage::disk('public')->delete($this->existing_company_logo);
            }
            // Simpan logo baru ke dalam folder 'companies/logos'
            $logoPath = $this->company_logo->store('companies/logos', 'public');
            $this->existing_company_logo = $logoPath;
        }

        // 3. Update atau Buat Baru Data AdminProfile (Menggunakan updateOrCreate)
        $user->adminProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'company_name'        => $this->company_name,
                'company_logo'        => $logoPath,
                'company_website'     => $this->company_website,
                'industry_type'       => $this->industry_type,
                'company_description' => $this->company_description,
                'office_address'      => $this->office_address,
            ]
        );

        // Reset properti temporary file setelah berhasil disimpan
        $this->reset('company_logo');

        session()->flash('profile_message', 'Data profil instansi dan akun berhasil diperbarui!');
    }

    /**
     * Memperbarui Password Keamanan Akun
     */
    public function updatePassword()
    {
        $user = Auth::user();

        $this->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password saat ini yang Anda masukkan salah.');
                }
            }],
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required'     => 'Password baru wajib diisi.',
            'new_password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('password_message', 'Password akun Anda berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}

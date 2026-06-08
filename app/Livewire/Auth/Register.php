<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    #[Layout('components.layouts.auth')]

    public $username, $email, $password, $password_confirmation;

    public function register()
    {
        $this->validate([
            'username' => 'required|min:3|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // 1. Simpan user baru ke database
        $user = User::create([
            'name'     => $this->username,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // KOREKSI: Perintah Auth::login($user); dihapus di sini
        // supaya user tidak otomatis mendapatkan session masuk.

        // 2. Berikan pesan sukses (Flash Message) ke halaman login (Opsional tapi direkomendasikan)
        session()->flash('success', 'Pendaftaran berhasil! Silakan masuk menggunakan akun Anda.');

        // 3. Alihkan langsung ke halaman login
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}

<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    #[Layout('components.layouts.auth')]

    public $email, $password, $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Coba Autentikasi Session Web
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {

            // 2. CEK ROLE: Jika bukan admin/superadmin, tendang keluar dari session web
            if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                throw ValidationException::withMessages([
                    'email' => 'Akses Ditolak. Akun Anda bukan Administrator. Hubungi superadmin.',
                ]);
            }

            // 3. Jika Valid Admin, buat session baru dan lempar ke dashboard web
            session()->regenerate();
            return redirect()->route('admin.profile');
        }

        // Jika password atau email salah
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

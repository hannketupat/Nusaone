<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FUNGSI 1: Menampilkan Halaman Formulir Login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard(Auth::user());
        }

        return view('auth.login');
    }

    // FUNGSI 2: Memverifikasi Email & Kata Sandi dari Form Login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin/transactions')->with(
                    'success',
                    'Selamat datang kembali di Seller Center, '.$user->name.'!'
                );
            }

            return redirect()->intended('/')->with(
                'success',
                'Selamat datang, '.$user->name.'!'
            );
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok. Periksa kembali alamat email dan kata sandi Anda.',
        ])->onlyInput('email');
    }

    // FUNGSI 3: Menampilkan Halaman Formulir Registrasi Customer
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard(Auth::user());
        }

        return view('auth.register');
    }

    // FUNGSI 4: Mendaftarkan Akun Customer Baru & Langsung Login
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'customer',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/')->with(
            'success',
            'Akun berhasil dibuat. Selamat berbelanja, '.$user->name.'!'
        );
    }

    // FUNGSI 5: Logout & Mengakhiri Sesi
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with(
            'status',
            'Anda telah berhasil keluar.'
        );
    }

    /**
     * Menentukan halaman tujuan berdasarkan role user yang sudah login.
     */
    private function redirectToDashboard(User $user)
    {
        return $user->role === 'admin'
            ? redirect('/admin/transactions')
            : redirect('/');
    }
}

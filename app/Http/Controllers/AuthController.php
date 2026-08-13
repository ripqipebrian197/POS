<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }


    public function login(LoginRequest $request)
    {
        // Logika verifikasi login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    public function logout(Request $request)
    {
        // Mengakhiri sesi pemgguma
        Auth::logout();

        // Menghapus session pengguna
        $request->session()->invalidate();
        // Menghapus token CSRF
        $request->session()->regenerateToken();
        // Redirect ke halaman login setelah logout
        return redirect()->route('login')->with('success', 'Anda telah keluar dari aplikasi');
    }
}

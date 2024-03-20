<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //showpagelogin
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password, // Ubah dari 'pass' ke 'password'
        ];

        // Tambahkan kondisi untuk memeriksa is_active pengguna
        $user = User::where('username', $request->username)->first();

        if ($user && $user->is_active == 1) {
            // Jika is_active adalah 1, artinya pengguna tidak dapat login
            return redirect()->route('login')->with('error', 'Your account is not active. Please contact admin.');
        }

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil, tampilkan data login di console
            Log::info('User logged in successfully.', ['username' => $request->username]);
            return redirect()->route('dashboardHandling');
        }

        // Autentikasi gagal, tampilkan pesan error
        return redirect()->route('login')->with('error', 'Invalid Username & Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

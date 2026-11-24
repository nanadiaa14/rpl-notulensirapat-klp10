<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $identifier = $request->input('login');

        // satu kolom input: bisa email, NIP (angka semua), atau username
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : (ctype_digit($identifier) ? 'nip' : 'username');

        $attempt = Auth::attempt(
            [$field => $identifier, 'password' => $request->input('password'), 'status' => 'active'],
            $request->boolean('remember')
        );

        if (! $attempt) {
            return back()
                ->withErrors(['login' => 'Email/NIP/username atau kata sandi salah.'])
                ->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('notulensi.create'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'nip' => ['required', 'string', 'max:30', 'unique:users,nip'],
            'unit' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'nomor_hp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        User::create($data);

        return redirect()->route('login')->with('status', 'Akun berhasil dibuat. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
<?php

use Illuminate\Support\Facades\Route;

// Halaman Login (Halaman Utama)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Halaman Registrasi / Buat Akun
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Halaman Buat Notulensi / Dashboard
Route::get('/buat-notulen', function () {
    return view('notulensi.dashboard');
})->name('notulensi.create');

// Halaman Buat Notulensi / Transkrip
Route::get('/transkrip-notulensi', function () {
    return view('notulensi.transkrip');
})->name('notulensi.transkrip');

// Halaman Riwayat Notulensi
Route::get('/riwayat-notulensi', function () {
    return view('notulensi.riwayat');
})->name('notulensi.riwayat');

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIGAP BRIDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F9FA] text-gray-800 font-sans min-h-screen flex flex-col justify-between antialiased">

    <!-- HEADER BRANDING (TOP BAR) -->
    <header class="w-full bg-white border-b border-gray-100 py-3 px-6 lg:px-12">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-[#6B1D1D] text-white font-bold rounded-lg flex items-center justify-center text-sm shadow-sm">
                SB
            </div>
            <div>
                <h1 class="text-sm font-bold text-gray-900 leading-tight">SIGAP BRIDA</h1>
                <p class="text-[11px] text-gray-500">Sistem Informasi Gabungan Arsip & Privasi</p>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="flex-1 flex items-center justify-center p-4 lg:p-8">
        <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
            
            <!-- CARD KIRI: BANNER INFORMASI MAROON -->
            <div class="lg:col-span-5 bg-[#6B1D1D] text-white p-8 lg:p-10 rounded-2xl flex flex-col justify-between relative overflow-hidden shadow-lg min-h-[420px]">
                <div class="relative z-10 space-y-6">
                    <div>
                        <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight mb-3">
                            Masuk ke SIGAP
                        </h2>
                        <p class="text-xs lg:text-sm text-red-100/90 leading-relaxed">
                            Akses arsip dokumen & data pegawai secara terpusat, aman, dan teraudit.
                        </p>
                    </div>

                    <!-- LIST CHECKLIST INFORMASI -->
                    <ul class="space-y-4 pt-2">
                        <li class="flex items-center gap-3 text-xs lg:text-sm font-medium">
                            <div class="w-5 h-5 rounded-full bg-red-950/40 border border-red-200/20 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span>UI terpadu untuk Dokumen & Pegawai</span>
                        </li>
                        <li class="flex items-center gap-3 text-xs lg:text-sm font-medium">
                            <div class="w-5 h-5 rounded-full bg-red-950/40 border border-red-200/20 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span>Hak akses berbasis peran (RBAC)</span>
                        </li>
                        <li class="flex items-center gap-3 text-xs lg:text-sm font-medium">
                            <div class="w-5 h-5 rounded-full bg-red-950/40 border border-red-200/20 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span>Pencatatan lengkap aktivitas view/unduh</span>
                        </li>
                    </ul>
                </div>

                <!-- Latar Belakang Dekoratif Bawah -->
                <div class="absolute -bottom-10 -left-10 w-full h-32 bg-red-950/30 rounded-full blur-2xl pointer-events-none"></div>
            </div>

            <!-- CARD KANAN: FORM LOGIN -->
            <div class="lg:col-span-7 bg-white p-8 lg:p-10 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between" x-data="{ showPassword: false }">
                <div>
                    <!-- Header Form -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-extrabold text-[#6B1D1D]">Login</h3>
                            <p class="text-xs text-gray-500 mt-1">Gunakan email dinas/username dan kata sandi Anda.</p>
                        </div>
                        <a href="#" class="text-xs font-medium text-gray-500 hover:text-gray-800 flex items-center gap-1 transition-colors">
                            &larr; Kembali
                        </a>
                    </div>

                    <!-- FORM -->
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Input Email/NIP -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Email / NIP</label>
                            <input 
                                type="text" 
                                name="login" 
                                placeholder="Masukkan email atau NIP" 
                                class="w-full px-3.5 py-2.5 text-xs lg:text-sm rounded-lg border border-gray-900 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                required
                            >
                        </div>

                        <!-- Input Kata Sandi + Toggle Eye -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Kata Sandi</label>
                            <div class="relative">
                                <input 
                                    :type="showPassword ? 'text' : 'password'" 
                                    name="password" 
                                    placeholder="••••••••" 
                                    class="w-full px-3.5 py-2.5 text-xs lg:text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400 pr-10"
                                    required
                                >
                                <!-- Tombol Toggle Mata -->
                                <button 
                                    type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                >
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.982 8.982 0 012.122-.163c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-0.469 0a8.98 8.98 0 01-2.928 1.135M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3L3 3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Checkbox Ingat Saya & Lupa Sandi -->
                        <div class="flex items-center justify-between text-xs pt-1">
                            <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                                <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-gray-300 text-[#6B1D1D] focus:ring-[#6B1D1D]">
                                <span>Ingat saya</span>
                            </label>
                            <a href="#" class="text-[#6B1D1D] font-semibold hover:underline">
                                Lupa sandi?
                            </a>
                        </div>

                        <!-- Tombol Submit Masuk -->
                        <button 
                            type="submit" 
                            class="w-full bg-[#6B1D1D] hover:bg-[#541616] text-white font-bold py-2.5 px-4 rounded-lg text-xs lg:text-sm transition-all shadow-sm active:scale-[0.99] mt-2"
                        >
                            Masuk
                        </button>
                    </form>

                    <!-- Link Daftar -->
                    <p class="text-xs text-gray-600 mt-4 text-left">
                        Belum punya akun? <a href="#" class="text-[#6B1D1D] font-bold hover:underline">Daftar</a>
                    </p>
                </div>

                <!-- Footer Warning Box (Aktivitas Login Terekam) -->
                <div class="mt-6 p-3 bg-amber-50/60 border border-amber-200/60 rounded-lg flex items-center gap-2.5 text-[11px] text-amber-800">
                    <div class="w-4 h-4 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-[10px] shrink-0">
                        !
                    </div>
                    <span>Aktivitas login terekam untuk audit internal. Jangan bagikan kredensial Anda.</span>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
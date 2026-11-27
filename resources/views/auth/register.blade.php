<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - SIGAP BRIDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 font-sans min-h-screen flex flex-col justify-between antialiased" x-data="registerForm()">

    <!-- HEADER BRANDING (TOP BAR) -->
    <header class="w-full bg-white border-b border-gray-100 py-3.5 px-6 lg:px-12 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-[#6B1D1D] text-white font-bold rounded-lg flex items-center justify-center text-sm shadow-sm shrink-0">
                SB
            </div>
            <div>
                <h1 class="text-sm font-bold text-gray-900 leading-tight">SIGAP BRIDA</h1>
                <p class="text-[11px] text-gray-500">Sistem Informasi Gabungan Arsip & Privasi</p>
            </div>
        </div>

        <div class="text-xs text-gray-600">
            Sudah punya akun? <a href="/" class="text-[#6B1D1D] font-bold hover:underline">Login</a>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="flex-1 flex items-center justify-center p-4 lg:p-8">
        <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
            
            <!-- CARD KIRI: BANNER INFORMASI MAROON -->
            <div class="lg:col-span-5 bg-[#6B1D1D] text-white p-8 lg:p-10 rounded-2xl flex flex-col justify-between relative overflow-hidden shadow-lg min-h-[460px]">
                <div class="relative z-10 space-y-6">
                    <div>
                        <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight mb-3">
                            Buat Akun SIGAP
                        </h2>
                        <p class="text-xs lg:text-sm text-red-100/90 leading-relaxed">
                            Akses arsip dokumen & data pegawai dengan kontrol dan audit ketat.
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
                            <span>Hak akses berbasis peran (RBAC)</span>
                        </li>
                        <li class="flex items-center gap-3 text-xs lg:text-sm font-medium">
                            <div class="w-5 h-5 rounded-full bg-red-950/40 border border-red-200/20 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span>Log aktivitas lengkap (view/unduh)</span>
                        </li>
                        <li class="flex items-center gap-3 text-xs lg:text-sm font-medium">
                            <div class="w-5 h-5 rounded-full bg-red-950/40 border border-red-200/20 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span>Single UI untuk Dokumen & Pegawai</span>
                        </li>
                    </ul>
                </div>

                <!-- Latar Belakang Dekoratif Bawah -->
                <div class="absolute -bottom-10 -left-10 w-full h-32 bg-red-950/40 rounded-full blur-2xl pointer-events-none"></div>
            </div>

            <!-- CARD KANAN: FORM REGISTRASI -->
            <div class="lg:col-span-7 bg-white p-7 lg:p-9 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div>
                    <!-- Header Form -->
                    <div class="mb-5">
                        <h3 class="text-xl lg:text-2xl font-extrabold text-[#6B1D1D]">Form Registrasi</h3>
                        <p class="text-xs text-gray-500 mt-1">Gunakan email dinas bila tersedia. Data akan diverifikasi admin.</p>
                    </div>

                    <!-- FORM REGISTRASI -->
                    <form method="POST" action="{{ route('register') }}" @submit="handleSubmit($event)" class="space-y-4">
                        @csrf
                    
                        @if ($errors->any())
                            <div class="p-3 rounded-lg bg-red-50 border border-red-200 text-xs text-red-700 space-y-0.5">
                                @foreach ($errors->all() as $err)
                                    <p>{{ $err }}</p>
                                @endforeach
                            </div>
                        @endif
                        
                        <!-- BARIS 1: NAMA LENGKAP & NIP -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="Nama sesuai KTP/Identitas" 
                                    class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                    required
                                >
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    NIP / No. Identitas <span class="text-red-600">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="identity_number" 
                                    placeholder="18 digit NIP / No. Identitas" 
                                    class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                    required
                                >
                            </div>
                        </div>

                        <!-- USERNAME -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Username</label>
                            <input
                                type="text"
                                name="username"
                                placeholder="Huruf, angka, strip, atau underscore"
                                class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                required
                            >
                        </div>

                        <!-- BARIS 2: EMAIL & UNIT/INSTANSI -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Email Aktif</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    placeholder="nama@email.com / email dinas" 
                                    class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                    required
                                >
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Unit / Bagian / Instansi</label>
                                <input 
                                    type="text" 
                                    name="unit" 
                                    placeholder="Contoh: Bidang Kebijakan / Umum" 
                                    class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                    required
                                >
                            </div>
                        </div>

                        <!-- BARIS 3: NO WHATSAPP & KATA SANDI (DIBAGI 2 SUB-KOLOM) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Nomor WhatsApp Aktif</label>
                                <input 
                                    type="tel" 
                                    name="whatsapp" 
                                    placeholder="08xxxxxxxxxx" 
                                    class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400"
                                    required
                                >
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <!-- KATA SANDI -->
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Kata Sandi</label>
                                    <div class="relative">
                                        <input 
                                            :type="showPassword ? 'text' : 'password'" 
                                            x-model="password"
                                            @input="checkStrength()"
                                            name="password" 
                                            placeholder="Min. 8 kar..." 
                                            class="w-full px-2.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400 pr-7"
                                            required
                                        >
                                        <button 
                                            type="button" 
                                            @click="showPassword = !showPassword" 
                                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                        >
                                            <svg x-show="!showPassword" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <svg x-show="showPassword" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.982 8.982 0 012.122-.163c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-0.469 0a8.98 8.98 0 01-2.928 1.135M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3L3 3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- KONFIRMASI KATA SANDI -->
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Konfirmasi</label>
                                    <div class="relative">
                                        <input 
                                            :type="showConfirm ? 'text' : 'password'" 
                                            x-model="confirmPassword"
                                            @input="errorMessage = ''"
                                            name="password_confirmation" 
                                            placeholder="Ulangi kat..." 
                                            class="w-full px-2.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6B1D1D]/20 focus:border-[#6B1D1D] transition-all placeholder:text-gray-400 pr-7"
                                            required
                                        >
                                        <button 
                                            type="button" 
                                            @click="showConfirm = !showConfirm" 
                                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                        >
                                            <svg x-show="!showConfirm" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <svg x-show="showConfirm" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.982 8.982 0 012.122-.163c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-0.469 0a8.98 8.98 0 01-2.928 1.135M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3L3 3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PESAN ERROR JIKA KONFIRMASI SANDI TIDAK COCOK -->
                        <div x-show="errorMessage" x-cloak class="text-xs text-red-600 font-semibold flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span x-text="errorMessage"></span>
                        </div>

                        <!-- KEKUATAN KATA SANDI -->
                        <div class="space-y-1.5 pt-0.5">
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="text-gray-600 font-medium">Kekuatan Kata Sandi</span>
                                <span class="font-semibold text-gray-500" :class="strengthTextClass" x-text="strengthText">Lemah</span>
                            </div>
                            <!-- Bar indikator -->
                            <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                                <div class="h-full transition-all duration-300" :class="strengthBarClass" :style="'width: ' + strengthWidth + '%'"></div>
                            </div>
                            <!-- Persyaratan list -->
                            <ul class="text-[11px] text-gray-500 list-disc list-inside space-y-0.5 pt-0.5">
                                <li>Minimal 8 karakter</li>
                                <li>Campuran huruf besar, kecil, angka</li>
                            </ul>
                        </div>

                        <!-- CHECKBOX PERSETUJUAN -->
                        <div class="pt-1">
                            <label class="flex items-start gap-2.5 text-xs text-gray-600 cursor-pointer">
                                <input type="checkbox" required class="w-4 h-4 mt-0.5 rounded border-gray-300 text-[#6B1D1D] focus:ring-[#6B1D1D]">
                                <span>
                                    Saya menyetujui <a href="#" class="font-semibold text-gray-900 hover:underline">Kebijakan Privasi</a> & <a href="#" class="font-semibold text-gray-900 hover:underline">Syarat Penggunaan</a>.
                                </span>
                            </label>
                        </div>

                        <!-- TOMBOL SUBMIT & BATAL -->
                        <div class="flex items-center gap-3 pt-2">
                            <button 
                                type="submit" 
                                class="flex-1 bg-[#6B1D1D] hover:bg-[#541616] text-white font-bold py-2.5 px-4 rounded-lg text-xs lg:text-sm transition-all shadow-sm active:scale-[0.99] text-center"
                            >
                                Daftar
                            </button>
                            <a 
                                href="/" 
                                class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs lg:text-sm rounded-lg transition-all active:scale-[0.99] text-center"
                            >
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                <!-- ALERT KOTAK INFORMASI KUNING (PROSEDUR AKUN BARU) -->
                <div class="mt-5 p-3.5 bg-amber-50/70 border border-amber-200/80 rounded-xl flex items-start gap-2.5 text-[11px] text-amber-900 leading-relaxed">
                    <div class="w-4 h-4 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">
                        !
                    </div>
                    <div>
                        <span class="font-bold">Prosedur Akun Baru SIGAP BRIDA:</span><br>
                        Setelah memverifikasi kode OTP email, akun Anda akan berstatus <strong class="font-semibold text-amber-950">Pending</strong> menunggu verifikasi identitas dan penugasan role resmi oleh Administrator BRIDA Kota Makassar.
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- ============================================================== -->
    <!-- POPUP MODAL SUKSES (AKUN BERHASIL DIBUAT)                      -->
    <!-- ============================================================== -->
    <div x-show="showSuccessModal" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        
        <div @click.away="handleRedirectLogin()"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-3xl p-8 sm:p-10 w-full max-w-[390px] shadow-2xl flex flex-col items-center text-center">
            
            <!-- IKON BADGE GERIGI 8 LEKUK BUNGA DENGAN CENTANG (SAMA PERSIS DENGAN SEBELUMNYA) -->
            <div class="flex items-center justify-center mb-6">
                <svg class="w-32 h-32" viewBox="45 45 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Bentuk Bunga / Gerigi 8 Lekuk -->
                    <path d="M 100.0 54.0 C 104.8 54.0, 109.1 62.6, 114.5 64.9 C 120.0 67.1, 129.1 64.0, 132.5 67.5 C 136.0 70.9, 132.9 80.0, 135.1 85.5 C 137.4 90.9, 146.0 95.2, 146.0 100.0 C 146.0 104.8, 137.4 109.1, 135.1 114.5 C 132.9 120.0, 136.0 129.1, 132.5 132.5 C 129.1 136.0, 120.0 132.9, 114.5 135.1 C 109.1 137.4, 104.8 146.0, 100.0 146.0 C 95.2 146.0, 90.9 137.4, 85.5 135.1 C 80.0 132.9, 70.9 136.0, 67.5 132.5 C 64.0 129.1, 67.1 120.0, 64.9 114.5 C 62.6 109.1, 54.0 104.8, 54.0 100.0 C 54.0 95.2, 62.6 90.9, 64.9 85.5 C 67.1 80.0, 64.0 70.9, 67.5 67.5 C 70.9 64.0, 80.0 67.1, 85.5 64.9 C 90.9 62.6, 95.2 54.0, 100.0 54.0 Z" 
                          fill="#E6CCD2" 
                          stroke="#6F1E1E" 
                          stroke-width="5" 
                          stroke-linejoin="round" />
                    <!-- Simbol Centang Tebal -->
                    <path d="M 83 104 L 95 118 L 118 88" 
                          stroke="#6F1E1E" 
                          stroke-width="6" 
                          stroke-linecap="round" 
                          stroke-linejoin="round" />
                </svg>
            </div>

            <!-- TEKS NOTIFIKASI -->
            <h3 class="text-2xl font-black text-gray-900 leading-snug tracking-tight mb-8">
                Akun Berhasil<br>Dibuat!
            </h3>

            <!-- TOMBOL OKE -->
            <button type="button" 
                    @click="handleRedirectLogin()" 
                    class="w-48 py-3 bg-[#6F1E1E] hover:bg-[#541616] text-white font-extrabold text-sm rounded-full tracking-wider shadow-md hover:shadow-lg transition-all active:scale-95">
                OKE
            </button>
        </div>
    </div>

    <!-- LOGIKA FORM ALPINE.JS -->
    <script>
        function registerForm() {
            return {
                showPassword: false,
                showConfirm: false,
                password: '',
                confirmPassword: '',
                errorMessage: '',
                showSuccessModal: false,
                strengthText: 'Lemah',
                strengthWidth: 15,
                strengthBarClass: 'bg-red-500',
                strengthTextClass: 'text-red-600',

                checkStrength() {
                    const pwd = this.password;
                    if (!pwd) {
                        this.strengthText = 'Lemah';
                        this.strengthWidth = 10;
                        this.strengthBarClass = 'bg-gray-300';
                        this.strengthTextClass = 'text-gray-500';
                        return;
                    }

                    let score = 0;
                    if (pwd.length >= 8) score++;
                    if (/[A-Z]/.test(pwd)) score++;
                    if (/[a-z]/.test(pwd)) score++;
                    if (/[0-9]/.test(pwd)) score++;
                    if (/[^A-Za-z0-9]/.test(pwd)) score++;

                    if (score <= 2) {
                        this.strengthText = 'Lemah';
                        this.strengthWidth = 25;
                        this.strengthBarClass = 'bg-red-500';
                        this.strengthTextClass = 'text-red-600';
                    } else if (score <= 4) {
                        this.strengthText = 'Sedang';
                        this.strengthWidth = 65;
                        this.strengthBarClass = 'bg-amber-500';
                        this.strengthTextClass = 'text-amber-600';
                    } else {
                        this.strengthText = 'Kuat';
                        this.strengthWidth = 100;
                        this.strengthBarClass = 'bg-emerald-500';
                        this.strengthTextClass = 'text-emerald-600';
                    }
                },

                handleSubmit(event) {
                    if (this.password !== this.confirmPassword) {
                        event.preventDefault();
                        this.errorMessage = 'Konfirmasi kata sandi tidak cocok dengan kata sandi yang dimasukkan!';
                        return;
                    }
                    this.errorMessage = '';
                },

                handleRedirectLogin() {
                    this.showSuccessModal = false;
                    window.location.href = '/';
                }
            }
        }
    </script>
</body>
</html>

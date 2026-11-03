<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Notulensi - SIGAP BRIDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }

        /* Format cetak / simpan ke PDF */
        @media print {
            aside, header, .no-print {
                display: none !important;
            }
            body, main {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .print-card {
                background-color: transparent !important;
                box-shadow: none !important;
                padding: 0 !important;
                border: none !important;
            }
        }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans antialiased min-h-screen flex" x-data="transkripApp()">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between shrink-0 min-h-screen no-print">
        <div>
            <!-- LOGO BRIDA KOTA MAKASSAR -->
            <div class="p-6 border-b border-gray-200 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#E52329] flex items-center justify-center text-white font-bold text-xs shadow-sm shrink-0">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-extrabold text-base text-gray-900 tracking-tight leading-tight">BRIDA</h1>
                    <p class="text-[9px] font-bold text-gray-700 uppercase tracking-wider">KOTA MAKASSAR</p>
                </div>
            </div>

            <!-- NAVIGASI MENU -->
            <nav class="p-4 space-y-2">
                <!-- MENU SIGAP NOTULENSI -->
                <div class="flex items-center gap-2 px-2 text-xs font-bold text-gray-900">
                    <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>SIGAP Notulensi</span>
                </div>

                <!-- SUBMENU -->
                <div class="pl-4 space-y-1.5 pt-0.5">
                    <!-- BUAT NOTULEN (AKTIF / PILL MERAH MAROON) -->
                    <a href="/buat-notulen" class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#701A1E] text-white text-xs font-bold rounded-xl shadow-sm transition">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Buat Notulen</span>
                    </a>

                    <!-- RIWAYAT -->
                    <a href="/riwayat-notulensi" class="flex items-center gap-2 px-2 py-1.5 text-xs font-medium text-gray-800 hover:text-[#701A1E] transition">
                        <svg class="w-3.5 h-3.5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Riwayat</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- TOMBOL KELUAR DI BAWAH -->
        <div class="p-4 border-t border-gray-200">
            <a href="/" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-gray-800 hover:text-red-700 transition">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- HEADER TOP BAR -->
        <header class="bg-white border-b border-gray-200 px-8 py-3.5 flex justify-end items-center no-print">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#D1D5DB] rounded-full shrink-0"></div>
                <span class="text-xs font-bold text-gray-800 tracking-wider">USERNAME</span>
            </div>
        </header>

        <!-- KONTEN TRANSKRIP / ALUR NOTULENSI -->
        <main class="p-8 space-y-6 max-w-7xl w-full mx-auto print-container">
            <h2 class="text-2xl md:text-3xl font-black text-[#701A1E] tracking-tight">Transkrip Notulensi</h2>

            <!-- ============================================================== -->
            <!-- TAMPILAN 1: BACA / EDIT NOTULENSI                              -->
            <!-- ============================================================== -->
            <div x-show="mode === 'baca' || mode === 'edit'" class="space-y-5">
                <!-- TOOLBAR FORMATTING (MUNCUL KETIKA MODE === 'edit') -->
                <div x-show="mode === 'edit'" x-cloak class="flex flex-wrap items-center gap-3">
                    <div class="bg-[#EAEAEA] p-1.5 rounded-2xl flex items-center gap-1 shadow-sm">
                        <button type="button" @click="format('bold')" class="w-9 h-9 flex items-center justify-center font-extrabold text-sm text-gray-800 hover:bg-white rounded-xl transition">
                            B
                        </button>
                        <button type="button" @click="format('italic')" class="w-9 h-9 flex items-center justify-center italic font-serif font-bold text-base text-gray-800 hover:bg-white rounded-xl transition">
                            I
                        </button>
                        <button type="button" @click="format('underline')" class="w-9 h-9 flex items-center justify-center underline font-bold text-sm text-gray-800 hover:bg-white rounded-xl transition">
                            U
                        </button>
                    </div>

                    <div class="bg-[#EAEAEA] p-1.5 rounded-2xl flex items-center gap-1 shadow-sm">
                        <button type="button" @click="format('justifyLeft')" class="w-9 h-9 flex items-center justify-center text-gray-800 hover:bg-white rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h14"/></svg>
                        </button>
                        <button type="button" @click="format('justifyCenter')" class="w-9 h-9 flex items-center justify-center text-gray-800 hover:bg-white rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M7 12h10M5 18h14"/></svg>
                        </button>
                        <button type="button" @click="format('justifyRight')" class="w-9 h-9 flex items-center justify-center text-gray-800 hover:bg-white rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M10 12h10M6 18h14"/></svg>
                        </button>
                        <button type="button" @click="format('justifyFull')" class="w-9 h-9 flex items-center justify-center text-gray-800 hover:bg-white rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>

                <!-- KOTAK TEKS TRANSKRIP -->
                <div id="editor" 
                     :contenteditable="mode === 'edit'" 
                     :class="mode === 'edit' ? 'focus:ring-2 focus:ring-[#701A1E]/30 bg-[#ECECEC]' : 'bg-[#ECECEC]'"
                     class="rounded-2xl p-6 min-h-[420px] shadow-sm outline-none text-sm text-[#701A1E] leading-relaxed transition-all">
                    Lorem ipsum dolor sit amet, enim ad adipiscing ea velit et anim. In ea commodo ut velit proident sed proident sunt in consectetur. Consequat eiusmod eiusmod ut ad dolor in et minim.
                </div>

                <!-- TOMBOL AKSI SEBELAH KANAN BAWAH -->
                <div class="flex items-center justify-end gap-4 pt-2">
                    <template x-if="mode === 'baca'">
                        <div class="flex gap-4">
                            <button type="button" 
                                    @click="mode = 'edit'" 
                                    class="px-8 py-3 bg-[#701A1E] hover:bg-[#581417] text-white text-xs font-extrabold uppercase tracking-wider rounded-2xl shadow-sm transition active:scale-95">
                                EDIT NOTULENSI
                            </button>
                            <button type="button" 
                                    @click="mode = 'finalisasi'; $nextTick(() => initCanvas())" 
                                    class="px-10 py-3 bg-[#701A1E] hover:bg-[#581417] text-white text-xs font-extrabold uppercase tracking-wider rounded-2xl shadow-sm transition active:scale-95">
                                FINALISASI
                            </button>
                        </div>
                    </template>

                    <template x-if="mode === 'edit'">
                        <button type="button" 
                                @click="mode = 'baca'" 
                                class="px-10 py-3 bg-[#701A1E] hover:bg-[#581417] text-white text-xs font-extrabold uppercase tracking-wider rounded-2xl shadow-sm transition active:scale-95">
                            SIMPAN
                        </button>
                    </template>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- TAMPILAN 2: FINALISASI & TANDA TANGAN DIGITAL                  -->
            <!-- ============================================================== -->
            <div x-show="mode === 'finalisasi'" x-cloak class="space-y-6">
                <!-- KARTU ATAS: RINGKASAN NOTULENSI -->
                <div class="bg-[#ECECEC] rounded-2xl p-6 space-y-3 shadow-sm">
                    <h3 class="text-xl md:text-2xl font-extrabold text-[#701A1E] leading-tight">
                        Lorem ipsum dolor sit amet, enim ad adipiscing ea velit et anim.
                    </h3>
                    <div class="text-xs font-bold text-[#701A1E] space-y-0.5">
                        <p>Senin, 21 Agustus 2029</p>
                        <p>09.00</p>
                    </div>
                    <p class="text-xs text-[#701A1E] leading-relaxed pt-1">
                        Lorem ipsum dolor sit amet, enim ad adipiscing ea velit et anim. In ea commodo ut velit proident sed proident sunt in consectetur. Consequat eiusmod eiusmod ut ad dolor in et minim.
                    </p>
                </div>

                <!-- KARTU BAWAH: MASUKKAN TANDA TANGAN -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-[#701A1E] uppercase tracking-wider">
                        MASUKKAN TANDA TANGAN
                    </label>
                    <div class="relative bg-[#ECECEC] rounded-2xl p-4 shadow-sm h-64 flex flex-col justify-between">
                        <!-- CANVAS TANDA TANGAN -->
                        <canvas id="signatureCanvas" class="w-full h-full cursor-crosshair rounded-xl"></canvas>

                        <!-- TOMBOL ULANGI DI POJOK KANAN BAWAH CANVAS -->
                        <div class="absolute bottom-4 right-6">
                            <button type="button" 
                                    @click="clearCanvas()" 
                                    class="text-xs font-bold text-[#701A1E] uppercase tracking-wider hover:underline transition">
                                ULANGI
                            </button>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL SIMPAN FINALISASI -->
                <div class="flex justify-end pt-2">
                    <button type="button" 
                            @click="simpanFinalisasi()" 
                            class="px-10 py-3 bg-[#701A1E] hover:bg-[#581417] text-white text-xs font-extrabold uppercase tracking-wider rounded-2xl shadow-sm transition active:scale-95">
                        SIMPAN
                    </button>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- TAMPILAN 3: TRANSKRIP NOTULENSI FINAL (SETELAH TANDA TANGAN)   -->
            <!-- ============================================================== -->
            <div x-show="mode === 'selesai'" x-cloak class="space-y-6">
                <!-- KARTU UTAMA TRANSKRIP NOTULENSI LENGKAP -->
                <div class="bg-[#ECECEC] rounded-2xl p-8 md:p-10 space-y-6 shadow-sm print-card">
                    <!-- JUDUL RAPAT / NOTULENSI -->
                    <h3 class="text-2xl md:text-3xl font-extrabold text-[#701A1E] leading-snug">
                        Lorem ipsum dolor sit amet, enim ad adipiscing ea velit et anim.
                    </h3>

                    <!-- WAKTU RAPAT -->
                    <p class="text-sm font-semibold text-[#701A1E]">
                        09.00
                    </p>

                    <!-- ISI PARAGRAF NOTULENSI -->
                    <div class="space-y-5 text-sm text-[#701A1E] leading-relaxed text-justify">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>

                    <!-- TANGGAL DAN TANDA TANGAN NOTULEN (POJOK KANAN BAWAH) -->
                    <div class="flex justify-end pt-6">
                        <div class="text-center min-w-[220px] flex flex-col items-center">
                            <p class="text-sm font-bold text-[#701A1E]">Senin, 21 Agustus 2029</p>

                            <!-- HASIL TANDA TANGAN DIGITAL DARI CANVAS -->
                            <div class="h-20 my-2 flex items-center justify-center">
                                <template x-if="signatureData">
                                    <img :src="signatureData" alt="Tanda Tangan Notulen" class="max-h-20 max-w-[200px] object-contain" />
                                </template>
                                <template x-if="!signatureData">
                                    <div class="h-16 w-32 flex items-center justify-center text-xs italic text-[#701A1E]/50 border border-dashed border-[#701A1E]/30 rounded-lg">
                                        (Tanda Tangan)
                                    </div>
                                </template>
                            </div>

                            <p class="text-sm font-bold text-[#701A1E]">Notulen</p>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI: SIMPAN NOTULENSI & UNDUH PDF (POJOK KANAN BAWAH) -->
                <div class="flex items-center justify-end gap-4 pt-2 no-print">
                    <!-- TOMBOL SIMPAN NOTULENSI -->
                    <button type="button" 
                            @click="simpanNotulensi()" 
                            class="bg-[#701A1E] hover:bg-[#581417] text-white rounded-2xl w-[140px] h-[52px] shadow-md hover:shadow-lg transition-all active:scale-95 text-center flex flex-col items-center justify-center">
                        <span class="text-xs font-bold leading-tight">Simpan</span>
                        <span class="text-xs font-bold leading-tight">Notulensi</span>
                    </button>

                    <!-- TOMBOL UNDUH PDF (.pdf) -->
                    <button type="button" 
                            @click="unduhPdf()" 
                            class="bg-[#701A1E] hover:bg-[#581417] text-white rounded-2xl w-[140px] h-[52px] shadow-md hover:shadow-lg transition-all active:scale-95 text-center flex flex-col items-center justify-center">
                        <span class="text-xs font-bold leading-tight">Unduh PDF</span>
                        <span class="text-[11px] font-medium opacity-90 leading-tight mt-0.5">(.pdf)</span>
                    </button>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- POPUP MODAL SUKSES (NOTULENSI BERHASIL DISIMPAN)                -->
            <!-- ============================================================== -->
            <div x-show="showSavedModal" 
                 x-cloak 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs no-print">
                
                <div @click.away="showSavedModal = false"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="bg-white rounded-3xl p-8 sm:p-10 w-full max-w-[390px] shadow-2xl flex flex-col items-center text-center">
                    
                    <!-- IKON BADGE GERIGI 8 LEKUK BUNGA DENGAN CENTANG -->
                    <div class="flex items-center justify-center mb-6">
                        <svg class="w-32 h-32" viewBox="45 45 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M 100.0 54.0 C 104.8 54.0, 109.1 62.6, 114.5 64.9 C 120.0 67.1, 129.1 64.0, 132.5 67.5 C 136.0 70.9, 132.9 80.0, 135.1 85.5 C 137.4 90.9, 146.0 95.2, 146.0 100.0 C 146.0 104.8, 137.4 109.1, 135.1 114.5 C 132.9 120.0, 136.0 129.1, 132.5 132.5 C 129.1 136.0, 120.0 132.9, 114.5 135.1 C 109.1 137.4, 104.8 146.0, 100.0 146.0 C 95.2 146.0, 90.9 137.4, 85.5 135.1 C 80.0 132.9, 70.9 136.0, 67.5 132.5 C 64.0 129.1, 67.1 120.0, 64.9 114.5 C 62.6 109.1, 54.0 104.8, 54.0 100.0 C 54.0 95.2, 62.6 90.9, 64.9 85.5 C 67.1 80.0, 64.0 70.9, 67.5 67.5 C 70.9 64.0, 80.0 67.1, 85.5 64.9 C 90.9 62.6, 95.2 54.0, 100.0 54.0 Z" 
                                  fill="#E6CCD2" 
                                  stroke="#701A1E" 
                                  stroke-width="5" 
                                  stroke-linejoin="round" />
                            <path d="M 83 104 L 95 118 L 118 88" 
                                  stroke="#701A1E" 
                                  stroke-width="6" 
                                  stroke-linecap="round" 
                                  stroke-linejoin="round" />
                        </svg>
                    </div>

                    <!-- TEKS NOTIFIKASI -->
                    <h3 class="text-2xl font-black text-gray-900 leading-snug tracking-tight mb-8">
                        Notulensi<br>Berhasil Disimpan!
                    </h3>

                    <!-- TOMBOL OKE -->
                    <button type="button" 
                            @click="showSavedModal = false; window.location.href = '/buat-notulen';" 
                            class="w-48 py-3 bg-[#701A1E] hover:bg-[#581417] text-white font-extrabold text-sm rounded-full tracking-wider shadow-md hover:shadow-lg transition-all active:scale-95">
                        OKE
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- SCRIPT ALPINE.JS & LOGIKA TANDA TANGAN & UNDUH DOKUMEN -->
    <script>
        function transkripApp() {
            return {
                // Mode: 'baca', 'edit', 'finalisasi', atau 'selesai'
                mode: new URLSearchParams(window.location.search).get('mode') || 'baca',
                canvas: null,
                ctx: null,
                isDrawing: false,
                signatureData: null,
                showSavedModal: false,

                format(command) {
                    document.execCommand(command, false, null);
                },

                initCanvas() {
                    this.canvas = document.getElementById('signatureCanvas');
                    if (!this.canvas) return;

                    this.ctx = this.canvas.getContext('2d');
                    
                    // Sesuaikan ukuran internal canvas
                    const rect = this.canvas.getBoundingClientRect();
                    this.canvas.width = rect.width;
                    this.canvas.height = rect.height;

                    this.ctx.strokeStyle = '#701A1E';
                    this.ctx.lineWidth = 2.5;
                    this.ctx.lineCap = 'round';
                    this.ctx.lineJoin = 'round';

                    // Mouse
                    this.canvas.onmousedown = (e) => this.startDrawing(e);
                    this.canvas.onmousemove = (e) => this.draw(e);
                    this.canvas.onmouseup = () => this.stopDrawing();
                    this.canvas.onmouseleave = () => this.stopDrawing();

                    // Touch screen (HP / Tablet)
                    this.canvas.ontouchstart = (e) => {
                        e.preventDefault();
                        this.startDrawing(e.touches[0]);
                    };
                    this.canvas.ontouchmove = (e) => {
                        e.preventDefault();
                        this.draw(e.touches[0]);
                    };
                    this.canvas.ontouchend = () => this.stopDrawing();
                },

                startDrawing(e) {
                    this.isDrawing = true;
                    const rect = this.canvas.getBoundingClientRect();
                    this.ctx.beginPath();
                    this.ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
                },

                draw(e) {
                    if (!this.isDrawing) return;
                    const rect = this.canvas.getBoundingClientRect();
                    this.ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
                    this.ctx.stroke();
                },

                stopDrawing() {
                    this.isDrawing = false;
                },

                clearCanvas() {
                    if (this.ctx && this.canvas) {
                        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                    }
                },

                // Simpan tanda tangan dan langsung beralih ke tampilan Transkrip Selesai
                simpanFinalisasi() {
                    if (this.canvas) {
                        this.signatureData = this.canvas.toDataURL('image/png');
                    }
                    this.mode = 'selesai';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                // Simpan notulensi akhir (menampilkan popup notifikasi sukses)
                simpanNotulensi() {
                    this.showSavedModal = true;
                },

                // Fungsi Unduh PDF
                unduhPdf() {
                    window.print();
                }
            }
        }
    </script>
</body>
</html>

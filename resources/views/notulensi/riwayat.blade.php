<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Notulensi - SIGAP BRIDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 font-sans antialiased min-h-screen flex">

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

    <!-- ===== MAIN AREA ===== -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-end items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                </svg>
            </div>
            <span class="text-sm font-bold text-gray-800 tracking-wide">USERNAME</span>
        </header>

        <!-- Page Content -->
        <main class="flex-1 px-8 py-8">

            <!-- Page Title -->
            <h2 class="text-2xl font-extrabold text-[#701A1E] mb-6">Riwayat Notulensi</h2>

            <!-- White Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <!-- Card Header -->
                <div class="px-8 pt-7 pb-4">
                    <h3 class="text-2xl font-extrabold text-gray-900">Daftar Arsip Notulensi</h3>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 mx-8"></div>

                <!-- Table -->
                <div class="px-8 pb-8">
                    <table class="w-full mt-5">
                        <!-- Table Head -->
                        <thead>
                            <tr>
                                <th class="text-left text-[10px] font-bold text-[#701A1E] uppercase tracking-widest pb-4 w-[32%]">Agenda Rapat</th>
                                <th class="text-left text-[10px] font-bold text-[#701A1E] uppercase tracking-widest pb-4 w-[20%]">Waktu dan Durasi</th>
                                <th class="text-left text-[10px] font-bold text-[#701A1E] uppercase tracking-widest pb-4 w-[18%]">Pimpinan</th>
                                <th class="text-left text-[10px] font-bold text-[#701A1E] uppercase tracking-widest pb-4 w-[15%]">Notulis</th>
                                <th class="text-left text-[10px] font-bold text-[#701A1E] uppercase tracking-widest pb-4 w-[10%]">Aksi</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            <!-- Row 1 -->
                            <tr class="border-t border-gray-100">
                                <td class="py-5 pr-4">
                                    <span class="text-sm font-bold text-gray-900">Evaluasi Proposal Riset Ketahanan Pangan 2026</span>
                                </td>
                                <td class="py-5 pr-4">
                                    <div class="text-sm font-semibold text-gray-900">Senin, 21 Agustus</div>
                                    <div class="text-xs text-gray-400 mt-0.5">1j 2m</div>
                                </td>
                                <td class="py-5 pr-4">
                                    <span class="text-sm text-gray-800">Agus Salim</span>
                                </td>
                                <td class="py-5 pr-4">
                                    <span class="text-sm font-bold text-gray-900">Arman</span>
                                </td>
                                <td class="py-5">
                                    <a href="#" class="text-sm font-semibold text-[#701A1E] hover:underline">Detail</a>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="border-t border-gray-100">
                                <td class="py-5 pr-4">
                                    <span class="text-sm font-bold text-gray-900">Rapat Koordinasi Indeks Inovasi Daerah (IID)</span>
                                </td>
                                <td class="py-5 pr-4">
                                    <div class="text-sm font-semibold text-gray-900">Senin, 22 Agustus</div>
                                    <div class="text-xs text-gray-400 mt-0.5">1j 2m</div>
                                </td>
                                <td class="py-5 pr-4">
                                    <span class="text-sm text-gray-800">Rizky Pratama</span>
                                </td>
                                <td class="py-5 pr-4">
                                    <span class="text-sm font-bold text-gray-900">Nadia</span>
                                </td>
                                <td class="py-5">
                                    <a href="#" class="text-sm font-semibold text-[#701A1E] hover:underline">Detail</a>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="border-t border-gray-100">
                                <td class="py-5 pr-4">
                                    <span class="text-sm font-bold text-gray-900">Pembahasan HAKI &amp; Hak Paten Produk Inovasi</span>
                                </td>
                                <td class="py-5 pr-4">
                                    <div class="text-sm font-semibold text-gray-900">Rabu, 23 Agustus</div>
                                    <div class="text-xs text-gray-400 mt-0.5">1j 2m</div>
                                </td>
                                <td class="py-5 pr-4">
                                    <span class="text-sm text-gray-800">Vania Kusuma</span>
                                </td>
                                <td class="py-5 pr-4">
                                    <span class="text-sm font-bold text-gray-900">Amanda</span>
                                </td>
                                <td class="py-5">
                                    <a href="#" class="text-sm font-semibold text-[#701A1E] hover:underline">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>


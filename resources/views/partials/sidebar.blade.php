@php
    $buatAktif = request()->routeIs('notulensi.create', 'notulensi.transkrip');
    $riwayatAktif = request()->routeIs('notulensi.riwayat', 'notulensi.detail');
    $pill = 'inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#701A1E] text-white text-xs font-bold rounded-xl shadow-sm transition';
    $plain = 'flex items-center gap-2 px-2 py-1.5 text-xs font-medium text-gray-800 hover:text-[#701A1E] transition';
@endphp
<aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between shrink-0 sticky top-0 h-screen self-start overflow-y-auto no-print">
    <div>
        <!-- LOGO BRIDA KOTA MAKASSAR -->
        <div class="h-20 px-6 border-b border-gray-200 flex items-center gap-3">
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
            <div class="flex items-center gap-2 px-2 text-xs font-bold text-gray-900">
                <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>SIGAP Notulensi</span>
            </div>

            <div class="pl-4 space-y-1.5 pt-0.5">
                <a href="{{ route('notulensi.create') }}" class="{{ $buatAktif ? $pill : $plain }}">
                    <svg class="w-3.5 h-3.5 {{ $buatAktif ? 'text-white' : 'text-gray-800' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Buat Notulen</span>
                </a>

                <a href="{{ route('notulensi.riwayat') }}" class="{{ $riwayatAktif ? $pill : $plain }}">
                    <svg class="w-3.5 h-3.5 {{ $riwayatAktif ? 'text-white' : 'text-gray-800' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Riwayat</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- TOMBOL KELUAR -->
    <div class="p-4 border-t border-gray-200">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-left text-xs font-bold text-gray-800 hover:text-red-700 transition cursor-pointer">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
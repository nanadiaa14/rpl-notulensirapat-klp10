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

    @include('partials.sidebar')

    <!-- ===== MAIN AREA ===== -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200 px-8 h-20 flex justify-end items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                </svg>
            </div>
            <span class="text-sm font-bold text-gray-800 tracking-wide">{{ auth()->user()->name }}</span>
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

                <form method="GET" action="{{ route('notulensi.riwayat') }}" class="px-8 pb-5 grid grid-cols-1 md:grid-cols-4 gap-3">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau topik"
                           class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#701A1E]/20 focus:border-[#701A1E]">
                    <input type="text" name="pimpinan" value="{{ request('pimpinan') }}" placeholder="Pimpinan rapat"
                           class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#701A1E]/20 focus:border-[#701A1E]">
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                           class="w-full px-3.5 py-2 text-xs rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#701A1E]/20 focus:border-[#701A1E]">
                    <div class="flex gap-2">
                        <button type="submit" class="px-5 py-2 bg-[#701A1E] hover:bg-[#581417] text-white text-xs font-bold rounded-xl">Cari</button>
                        <a href="{{ route('notulensi.riwayat') }}" class="px-5 py-2 border border-gray-200 text-gray-700 text-xs font-bold rounded-xl text-center">Reset</a>
                    </div>
                </form>

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
                            @forelse ($meetings as $m)
                                @php
                                    $detik = $m->audio_duration ?? 0;
                                    $durasi = $detik >= 3600
                                        ? intdiv($detik, 3600) . 'j ' . intdiv($detik % 3600, 60) . 'm'
                                        : max(1, intdiv($detik, 60)) . 'm';
                                @endphp
                                <tr class="border-t border-gray-100">
                                    <td class="py-5 pr-4">
                                        <span class="text-sm font-bold text-gray-900">{{ $m->title }}</span>
                                    </td>
                                    <td class="py-5 pr-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $m->meeting_date?->locale('id')->translatedFormat('l, d F Y') }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5">{{ substr($m->time_start ?? '', 0, 5) }} - {{ substr($m->time_end ?? '', 0, 5) }} | {{ $durasi }}</div>
                                    </td>
                                    <td class="py-5 pr-4">
                                        <span class="text-sm text-gray-800">{{ $m->meeting_leader }}</span>
                                    </td>
                                    <td class="py-5 pr-4">
                                        <span class="text-sm font-bold text-gray-900">{{ $m->notulis?->name ?? '-' }}</span>
                                    </td>
                                    <td class="py-5">
                                        <a href="{{ route('notulensi.detail', $m) }}" class="text-sm font-semibold text-[#701A1E] hover:underline">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-t border-gray-100">
                                    <td colspan="5" class="py-10 text-center text-sm text-gray-500">Daftar kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6">{{ $meetings->links() }}</div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>


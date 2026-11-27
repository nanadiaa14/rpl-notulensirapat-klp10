<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Notulensi - SIGAP BRIDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }

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
<body class="bg-white text-gray-800 font-sans antialiased min-h-screen flex">

    @include('partials.sidebar')

    @php
        $note = $meeting->meetingNote;
        $tanggal = $meeting->meeting_date
            ? $meeting->meeting_date->copy()->locale('id')->translatedFormat('l, d F Y')
            : null;
        $mulai = $meeting->time_start ? str_replace(':', '.', substr($meeting->time_start, 0, 5)) : null;
        $selesai = $meeting->time_end ? str_replace(':', '.', substr($meeting->time_end, 0, 5)) : null;
        $topics = is_array($meeting->topics) ? $meeting->topics : [];
    @endphp

    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="bg-white border-b border-gray-200 px-8 h-20 flex justify-end items-center no-print">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#D1D5DB] rounded-full shrink-0"></div>
                <span class="text-xs font-bold text-gray-800 tracking-wider">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <main class="p-8 space-y-6 max-w-7xl w-full mx-auto">
            <div class="flex items-center justify-between no-print">
                <h2 class="text-2xl md:text-3xl font-black text-[#701A1E] tracking-tight">Detail Notulensi</h2>
                <a href="{{ route('notulensi.riwayat') }}" class="text-xs font-bold text-[#701A1E] uppercase tracking-wider hover:underline">
                    &larr; Kembali ke Riwayat
                </a>
            </div>

            <div class="bg-[#ECECEC] rounded-2xl p-8 md:p-10 space-y-6 shadow-sm print-card">
                <div class="space-y-2">
                    <h3 class="text-2xl md:text-3xl font-extrabold text-[#701A1E] leading-snug">{{ $meeting->title }}</h3>
                    <p class="text-sm font-semibold text-[#701A1E]">
                        {{ $tanggal }}@if ($tanggal && $mulai) &middot; @endif{{ $mulai }}@if ($mulai && $selesai) - {{ $selesai }}@endif
                    </p>
                </div>

                <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#701A1E]">
                    <div>
                        <dt class="font-bold uppercase tracking-wider">Lokasi</dt>
                        <dd class="mt-0.5">{{ $meeting->location }}</dd>
                    </div>
                    <div>
                        <dt class="font-bold uppercase tracking-wider">Pemimpin Rapat</dt>
                        <dd class="mt-0.5">{{ $meeting->meeting_leader }}</dd>
                    </div>
                    <div>
                        <dt class="font-bold uppercase tracking-wider">Notulis</dt>
                        <dd class="mt-0.5">{{ $meeting->notulis?->name ?? '-' }}</dd>
                    </div>
                </dl>

                @if (count($topics))
                    <div class="text-xs text-[#701A1E]">
                        <p class="font-bold uppercase tracking-wider mb-1">Poin Pembahasan</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($topics as $topic)
                                <li>{{ $topic }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Isi notulen sudah dibersihkan oleh HtmlSanitizer saat disimpan --}}
                <div class="space-y-5 text-sm text-[#701A1E] leading-relaxed text-justify">
                    {!! $note?->summary !!}
                </div>

                <div class="flex justify-end pt-6">
                    <div class="text-center min-w-[220px] flex flex-col items-center">
                        @if ($note?->signed_at)
                            <p class="text-sm font-bold text-[#701A1E]">
                                {{ $note->signed_at->copy()->locale('id')->translatedFormat('l, d F Y') }}
                            </p>
                        @endif

                        <div class="h-20 my-2 flex items-center justify-center">
                            @if ($note?->signature_path)
                                <img src="{{ url('/meetings/' . $meeting->id . '/note/' . $note->id . '/signature') }}"
                                     alt="Tanda Tangan Notulis"
                                     class="max-h-20 max-w-[200px] object-contain">
                            @endif
                        </div>

                        <p class="text-sm font-bold text-[#701A1E]">Notulis</p>
                        <p class="text-xs font-semibold text-[#701A1E]">{{ $meeting->notulis?->name }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-2 no-print">
                <button type="button" onclick="window.print()"
                        class="bg-[#701A1E] hover:bg-[#581417] text-white rounded-2xl w-[140px] h-[52px] shadow-md hover:shadow-lg transition-all active:scale-95 text-center flex flex-col items-center justify-center">
                    <span class="text-xs font-bold leading-tight">Unduh PDF</span>
                    <span class="text-[11px] font-medium opacity-90 leading-tight mt-0.5">(.pdf)</span>
                </button>
            </div>
        </main>
    </div>
</body>
</html>
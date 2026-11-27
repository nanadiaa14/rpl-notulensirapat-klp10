<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Notulensi - SIGAP BRIDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 font-sans antialiased min-h-screen flex">

    @include('partials.sidebar')

    <!-- AREA KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- HEADER TOP BAR -->
        <header class="bg-white border-b border-gray-200 px-8 h-20 flex justify-end items-center">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-300 rounded-full flex items-center justify-center font-bold text-gray-600 text-xs">
                    U
                </div>
                <span class="text-xs font-bold text-gray-800 tracking-wider">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <!-- KONTEN -->
        <main class="p-8 space-y-6">
            <!-- HERO WELCOME -->
            <div>
                <h2 class="text-3xl font-black text-[#6B1D1D] tracking-tight">Selamat Datang!</h2>
            </div>

            <!-- STATISTIK NOTULENSI -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Total Notulensi</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-red-50 text-[#6B1D1D] rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">Draft</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $stats['draft'] }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Selesai</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $stats['selesai'] }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- GRID DUA KOLOM: FORM SPESIFIKASI & REKAM AUDIO -->
            <div x-data="agendaForm()" class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start relative">
                
                <!-- KOLOM KIRI: SPESIFIKASI & AGENDA RAPAT -->
                <div class="bg-[#ECECEC] p-6 rounded-2xl space-y-4">
                    <h3 class="text-base font-extrabold text-[#6B1D1D]">Spesifikasi & Agenda Rapat</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">JUDUL RAPAT</label>
                            <input type="text" x-model="formKiri.judul" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">LOKASI RAPAT</label>
                            <input type="text" x-model="formKiri.lokasi" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">PEMIMPIN RAPAT</label>
                            <input type="text" x-model="formKiri.pemimpin" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm">
                        </div>
                        <!-- FIELD NOTULIS -->
                        <div>
                            <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">NOTULIS</label>
                            <select name="notulis_id" x-model="formKiri.notulis_id" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm">
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">DAFTAR POIN INTI PEMBAHASAN</label>
                            <textarea x-model="formKiri.poin" rows="4" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm resize-none"></textarea>
                        </div>
                    </div>

                    <div class="pt-2 flex flex-col items-center gap-2">
                        <p x-show="formError" x-cloak class="text-xs text-red-600 font-semibold text-center whitespace-pre-line" x-text="formError"></p>
                        <button type="button" @click="simpanAgenda()" :disabled="saving" class="px-8 py-2.5 bg-[#6B1D1D] hover:bg-[#541616] text-white text-xs font-bold uppercase tracking-wider rounded-2xl shadow-sm transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-text="saving ? 'MENYIMPAN...' : 'SIMPAN'"></span>
                        </button>
                    </div>
                </div>

                <!-- KOLOM KANAN: REKAM / UPLOAD AUDIO INTERAKTIF -->
                <div x-data="audioRecorder()" class="bg-[#ECECEC] p-6 rounded-2xl space-y-5">
                    <!-- TAB SWITCHER -->
                    <div class="bg-white p-1 rounded-full flex shadow-sm">
                        <button type="button" 
                                @click="tab = 'rekam'" 
                                :class="tab === 'rekam' ? 'bg-[#D9D9D9] font-extrabold text-[#6B1D1D]' : 'text-[#6B1D1D] font-semibold opacity-70 hover:opacity-100'" 
                                class="flex-1 py-1.5 rounded-full text-[11px] tracking-wider uppercase transition">
                            REKAM AUDIO
                        </button>
                        <button type="button" 
                                @click="tab = 'upload'" 
                                :class="tab === 'upload' ? 'bg-[#D9D9D9] font-extrabold text-[#6B1D1D]' : 'text-[#6B1D1D] font-semibold opacity-70 hover:opacity-100'" 
                                class="flex-1 py-1.5 rounded-full text-[11px] tracking-wider uppercase transition">
                            UPLOAD AUDIO
                        </button>
                    </div>

                    <!-- AREA REKAM AUDIO -->
                    <template x-if="tab === 'rekam'">
                        <div class="flex flex-col items-center justify-center space-y-3 py-2">
                            <div class="relative">
                                <div :class="isRecording ? 'animate-ping bg-red-400 opacity-75' : ''" class="absolute inset-0 rounded-2xl"></div>
                                <div class="relative w-16 h-16 bg-[#6B1D1D] rounded-2xl flex items-center justify-center text-white shadow-md">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 14a3 3 0 0 0 3-3V5a3 3 0 0 0-6 0v6a3 3 0 0 0 3 3zm5-3a5 5 0 0 1-10 0H5a7 7 0 0 0 6 6.92V21h2v-3.08A7 7 0 0 0 19 11h-2z"/>
                                    </svg>
                                </div>
                            </div>

                            <div x-show="isRecording" class="text-xs font-bold text-red-600 animate-pulse">
                                Merekam: <span x-text="formatTime(timer)"></span>
                            </div>

                            <button type="button" 
                                    @click="toggleRecording()" 
                                    :class="isRecording ? 'bg-red-700 hover:bg-red-800' : 'bg-[#6B1D1D] hover:bg-[#541616]'"
                                    class="px-5 py-2 text-white font-bold text-[11px] rounded-xl shadow-sm transition uppercase tracking-wider">
                                <span x-text="isRecording ? 'STOP REKAMAN' : 'MULAI REKAM AUDIO'"></span>
                            </button>

                            <div x-show="audioUrl" class="w-full pt-2">
                                <p class="text-[11px] font-bold text-gray-700 mb-1">Hasil Rekaman:</p>
                                <audio :src="audioUrl" controls class="w-full rounded-lg h-9"></audio>
                            </div>

                            <div class="pt-2 flex flex-col items-center gap-2">
                                <p x-show="audioError" x-cloak class="text-xs text-red-600 font-semibold text-center whitespace-pre-line" x-text="audioError"></p>
                                <button type="button" @click="submitAudio(meetingId)" :disabled="uploading || !meetingId" class="inline-block px-8 py-2.5 bg-[#6B1D1D] hover:bg-[#541616] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-sm transition text-center disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-text="uploading ? 'MENGUNGGAH...' : 'UBAH KE TEKS'"></span>
                                </button>
                                <p x-show="!meetingId" class="text-[11px] text-gray-500">Simpan agenda rapat di sebelah kiri dulu.</p>
                            </div>
                        </div>
                    </template>

                    <!-- AREA UPLOAD AUDIO -->
                    <template x-if="tab === 'upload'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1.5">
                                    UNGGAH DOKUMEN AUDIO
                                </label>
                                <label class="flex flex-col items-center justify-center w-full py-6 bg-white rounded-2xl border border-gray-100 shadow-sm cursor-pointer hover:bg-gray-50/80 transition relative overflow-hidden group">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <div class="w-12 h-12 rounded-full bg-red-50 text-[#6B1D1D] flex items-center justify-center group-hover:scale-105 transition-transform">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>
                                        <span class="px-4 py-1.5 bg-[#6B1D1D] hover:bg-[#541616] text-white text-[11px] font-bold rounded-lg shadow-sm transition">
                                            Choose File
                                        </span>
                                        <span class="text-[11px] text-gray-600 max-w-[16rem] truncate" x-text="uploadFile ? uploadFile.name : 'Belum ada file dipilih'"></span>
                                    </div>
                                    <input type="file" accept="audio/*,.mp3,.wav,.m4a,.ogg,.webm" class="hidden" @change="onFile($event)">
                                </label>
                            </div>

                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">HARI/TANGGAL</label>
                                    <input type="date" x-model="meetingDate" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm text-gray-700">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">WAKTU MULAI</label>
                                    <input type="time" x-model="timeStart" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm text-gray-700">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">WAKTU SELESAI</label>
                                    <input type="time" x-model="timeEnd" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm text-gray-700">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">
                                        JUDUL RAPAT
                                    </label>
                                    <input type="text" x-model="formKanan.judul" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-[#6B1D1D] uppercase tracking-wider mb-1">
                                        DAFTAR POIN INTI PEMBAHASAN
                                    </label>
                                    <textarea x-model="formKanan.poin" rows="3" class="w-full px-3.5 py-2 bg-white rounded-xl text-xs font-medium border-none outline-none focus:ring-2 focus:ring-[#6B1D1D] shadow-sm resize-none"></textarea>
                                </div>
                            </div>

                            <div class="pt-2 flex flex-col items-center gap-2">
                                <p x-show="audioError" x-cloak class="text-xs text-red-600 font-semibold text-center whitespace-pre-line" x-text="audioError"></p>
                                <button type="button" @click="submitAudio(meetingId)" :disabled="uploading || !meetingId" class="inline-block px-8 py-2.5 bg-[#6B1D1D] hover:bg-[#541616] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-sm transition text-center disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-text="uploading ? 'MENGUNGGAH...' : 'UBAH KE TEKS'"></span>
                                </button>
                                <p x-show="!meetingId" class="text-[11px] text-gray-500">Simpan agenda rapat di sebelah kiri dulu.</p>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- ============================================================== -->
                <!-- POPUP MODAL SUKSES (AGENDA RAPAT BERHASIL DISIMPAN)            -->
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
                    
                    <div @click.away="showSuccessModal = false"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="bg-white rounded-3xl p-8 sm:p-10 w-full max-w-[390px] shadow-2xl flex flex-col items-center text-center">
                        
                        <!-- ICON BADGE VERIFIED / GERIGI 8 LEKUK BUNGA DENGAN CENTANG -->
                        <div class="flex items-center justify-center mb-6">
                            <svg class="w-32 h-32" viewBox="45 45 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M 100.0 54.0 C 104.8 54.0, 109.1 62.6, 114.5 64.9 C 120.0 67.1, 129.1 64.0, 132.5 67.5 C 136.0 70.9, 132.9 80.0, 135.1 85.5 C 137.4 90.9, 146.0 95.2, 146.0 100.0 C 146.0 104.8, 137.4 109.1, 135.1 114.5 C 132.9 120.0, 136.0 129.1, 132.5 132.5 C 129.1 136.0, 120.0 132.9, 114.5 135.1 C 109.1 137.4, 104.8 146.0, 100.0 146.0 C 95.2 146.0, 90.9 137.4, 85.5 135.1 C 80.0 132.9, 70.9 136.0, 67.5 132.5 C 64.0 129.1, 67.1 120.0, 64.9 114.5 C 62.6 109.1, 54.0 104.8, 54.0 100.0 C 54.0 95.2, 62.6 90.9, 64.9 85.5 C 67.1 80.0, 64.0 70.9, 67.5 67.5 C 70.9 64.0, 80.0 67.1, 85.5 64.9 C 90.9 62.6, 95.2 54.0, 100.0 54.0 Z" 
                                      fill="#E6CCD2" 
                                      stroke="#6F1E1E" 
                                      stroke-width="5" 
                                      stroke-linejoin="round" />
                                <path d="M 83 104 L 95 118 L 118 88" 
                                      stroke="#6F1E1E" 
                                      stroke-width="6" 
                                      stroke-linecap="round" 
                                      stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- TEKS NOTIFIKASI -->
                        <h3 class="text-2xl font-black text-gray-900 leading-snug tracking-tight mb-8">
                            Agenda Rapat<br>Berhasil Disimpan!
                        </h3>

                        <!-- TOMBOL OKE -->
                        <button type="button" 
                                @click="showSuccessModal = false" 
                                class="w-48 py-3 bg-[#6F1E1E] hover:bg-[#541616] text-white font-extrabold text-sm rounded-full tracking-wider shadow-md hover:shadow-lg transition-all active:scale-95">
                            OKE
                        </button>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- SCRIPT LOGIKA REKAM AUDIO ALPINE.JS -->
    <script>
        const csrfToken = () => document.querySelector('meta[name="csrf-token"]').content;
    
        function errorText(res, data) {
            if (data && data.errors) {
                return Object.values(data.errors).flat().join('\n');
            }
            if (data && data.message) return data.message;
            return 'Terjadi kesalahan (kode ' + res.status + ').';
        }
    
        function agendaForm() {
            return {
                formKiri: { judul: '', lokasi: '', pemimpin: '', notulis_id: {{ auth()->id() }}, poin: '' },
                formKanan: { judul: '', poin: '' },
                meetingId: null,
                saving: false,
                formError: '',
                showSuccessModal: false,
    
                async simpanAgenda() {
                    this.formError = '';
                    this.saving = true;
    
                    const topics = this.formKiri.poin
                        .split('\n')
                        .map(t => t.replace(/^\s*([-*\u2022]|\d+[.)])\s*/, '').trim())
                        .filter(t => t !== '');
    
                    const payload = {
                        title: this.formKiri.judul,
                        location: this.formKiri.lokasi,
                        meeting_leader: this.formKiri.pemimpin,
                        notulis_id: this.formKiri.notulis_id,
                        topics: topics,
                    };
    
                    const url = this.meetingId ? '/meetings/' + this.meetingId : '/meetings';
                    const method = this.meetingId ? 'PATCH' : 'POST';
    
                    try {
                        const res = await fetch(url, {
                            method: method,
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken(),
                            },
                            body: JSON.stringify(payload),
                        });
                        const data = await res.json().catch(() => null);
    
                        if (!res.ok) {
                            this.formError = errorText(res, data);
                            return;
                        }
    
                        this.meetingId = data.data.id;
                        this.formKanan.judul = this.formKiri.judul;
                        this.formKanan.poin = topics.join('\n');
                        this.showSuccessModal = true;
                    } catch (e) {
                        this.formError = 'Tidak dapat terhubung ke server.';
                    } finally {
                        this.saving = false;
                    }
                }
            };
        }
    
        function audioRecorder() {
            return {
                tab: 'rekam',
                isRecording: false,
                mediaRecorder: null,
                stream: null,
                audioChunks: [],
                audioBlob: null,
                audioUrl: null,
                recordedStart: null,
                recordedEnd: null,
                timer: 0,
                timerInterval: null,
    
                uploadFile: null,
                uploadDuration: null,
                meetingDate: '',
                timeStart: '',
                timeEnd: '',
    
                uploading: false,
                audioError: '',
    
                async toggleRecording() {
                    if (!this.isRecording) {
                        try {
                            this.stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                            this.mediaRecorder = new MediaRecorder(this.stream);
                            this.audioChunks = [];
                            this.audioBlob = null;
                            this.audioUrl = null;
    
                            this.mediaRecorder.ondataavailable = (event) => {
                                if (event.data.size > 0) this.audioChunks.push(event.data);
                            };
    
                            this.mediaRecorder.onstop = () => {
                                const mime = this.mediaRecorder.mimeType || 'audio/webm';
                                this.audioBlob = new Blob(this.audioChunks, { type: mime });
                                this.audioUrl = URL.createObjectURL(this.audioBlob);
                                this.stream.getTracks().forEach(t => t.stop());
                            };
    
                            this.mediaRecorder.start();
                            this.recordedStart = new Date();
                            this.recordedEnd = null;
                            this.isRecording = true;
    
                            this.timer = 0;
                            this.timerInterval = setInterval(() => { this.timer++; }, 1000);
                        } catch (err) {
                            alert('Gagal mengakses mikrofon! Pastikan izin mikrofon telah diberikan.');
                        }
                    } else {
                        this.recordedEnd = new Date();
                        this.mediaRecorder.stop();
                        this.isRecording = false;
                        clearInterval(this.timerInterval);
                    }
                },
    
                formatTime(seconds) {
                    const mins = Math.floor(seconds / 60).toString().padStart(2, '0');
                    const secs = (seconds % 60).toString().padStart(2, '0');
                    return `${mins}:${secs}`;
                },
    
                onFile(event) {
                    const file = event.target.files[0] || null;
                    this.uploadFile = file;
                    this.uploadDuration = null;
                    if (!file) return;
    
                    const probe = new Audio();
                    probe.preload = 'metadata';
                    probe.src = URL.createObjectURL(file);
                    probe.onloadedmetadata = () => {
                        if (isFinite(probe.duration) && probe.duration >= 1) {
                            this.uploadDuration = Math.round(probe.duration);
                        }
                        URL.revokeObjectURL(probe.src);
                    };
                },
    
                extensionFor(mime) {
                    if (mime.includes('ogg')) return 'ogg';
                    if (mime.includes('mp4') || mime.includes('aac') || mime.includes('m4a')) return 'm4a';
                    if (mime.includes('wav')) return 'wav';
                    if (mime.includes('mpeg') || mime.includes('mp3')) return 'mp3';
                    return 'webm';
                },
    
                async submitAudio(meetingId) {
                    this.audioError = '';
    
                    if (!meetingId) {
                        this.audioError = 'Simpan agenda rapat dulu.';
                        return;
                    }
    
                    const fd = new FormData();
    
                    if (this.tab === 'rekam') {
                        if (this.isRecording) {
                            this.audioError = 'Hentikan rekaman dulu.';
                            return;
                        }
                        if (!this.audioBlob || !this.recordedStart || !this.recordedEnd) {
                            this.audioError = 'Belum ada hasil rekaman.';
                            return;
                        }
                        if (this.recordedEnd - this.recordedStart < 1000) {
                            this.audioError = 'Rekaman terlalu singkat.';
                            return;
                        }
                        fd.append('audio', this.audioBlob, 'rekaman.' + this.extensionFor(this.audioBlob.type));
                        fd.append('source', 'record');
                        fd.append('recorded_start_at', this.recordedStart.toISOString());
                        fd.append('recorded_end_at', this.recordedEnd.toISOString());
                        fd.append('audio_duration', Math.max(1, this.timer));
                    } else {
                        if (!this.uploadFile) {
                            this.audioError = 'Pilih file audio dulu.';
                            return;
                        }
                        if (!this.meetingDate || !this.timeStart || !this.timeEnd) {
                            this.audioError = 'Isi tanggal, waktu mulai, dan waktu selesai.';
                            return;
                        }
                        fd.append('audio', this.uploadFile);
                        fd.append('source', 'upload');
                        fd.append('meeting_date', this.meetingDate);
                        fd.append('time_start', this.timeStart);
                        fd.append('time_end', this.timeEnd);
                        if (this.uploadDuration) fd.append('audio_duration', this.uploadDuration);
                    }
    
                    this.uploading = true;
                    try {
                        const res = await fetch('/meetings/' + meetingId + '/audio', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken(),
                            },
                            body: fd,
                        });
                        const data = await res.json().catch(() => null);
    
                        if (!res.ok) {
                            this.audioError = errorText(res, data);
                            return;
                        }
    
                        window.location.href = '/transkrip-notulensi/' + meetingId;
                    } catch (e) {
                        this.audioError = 'Tidak dapat terhubung ke server.';
                    } finally {
                        this.uploading = false;
                    }
                }
            };
        }
    </script>
</body>
</html>

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingNoteController;
use App\Http\Controllers\TranscriptController;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/buat-notulen', function () {
        $total = Meeting::milik(auth()->id())->count();
        $selesai = Meeting::milik(auth()->id())
            ->whereHas('meetingNote', fn ($q) => $q->where('status', 'finalized'))
            ->count();
    
        return view('notulensi.dashboard', [
            'pegawai' => User::where('status', 'active')->orderBy('name')->get(['id', 'name']),
            'stats' => ['total' => $total, 'selesai' => $selesai, 'draft' => $total - $selesai],
        ]);
    })->name('notulensi.create');
    
    Route::get('/riwayat-notulensi', [MeetingController::class, 'archive'])->name('notulensi.riwayat');

    Route::get('/meetings', [MeetingController::class, 'index']);
    Route::post('/meetings', [MeetingController::class, 'store']);

    Route::middleware('can:view,meeting')->group(function () {
        Route::get('/transkrip-notulensi/{meeting}', function (Meeting $meeting) {
            return view('notulensi.transkrip', ['meeting' => $meeting->load('meetingNote', 'transcript')]);
        })->name('notulensi.transkrip');
        
        Route::get('/riwayat-notulensi/{meeting}', function (Meeting $meeting) {
            abort_unless($meeting->isFinalized(), 404);
            return view('notulensi.detail', ['meeting' => $meeting->load('meetingNote', 'notulis')]);
        })->name('notulensi.detail');

        Route::get('/meetings/{meeting}', [MeetingController::class, 'show']);
        Route::patch('/meetings/{meeting}', [MeetingController::class, 'update']);
        Route::delete('/meetings/{meeting}', [MeetingController::class, 'destroy']);

        Route::get('/meetings/{meeting}/audio', [MeetingController::class, 'audio']);
        Route::post('/meetings/{meeting}/audio', [MeetingController::class, 'uploadAudio']);
        Route::delete('/meetings/{meeting}/audio', [MeetingController::class, 'deleteAudio']);

        Route::get('/meetings/{meeting}/transcript', [TranscriptController::class, 'show']);
        Route::post('/meetings/{meeting}/transcript', [TranscriptController::class, 'store']);
        Route::patch('/meetings/{meeting}/transcript/{transcript}', [TranscriptController::class, 'update']);
        Route::delete('/meetings/{meeting}/transcript/{transcript}', [TranscriptController::class, 'destroy']);

        Route::get('/meetings/{meeting}/note', [MeetingNoteController::class, 'show']);
        Route::post('/meetings/{meeting}/note', [MeetingNoteController::class, 'store']);
        Route::patch('/meetings/{meeting}/note/{meetingNote}', [MeetingNoteController::class, 'update']);
        Route::post('/meetings/{meeting}/note/{meetingNote}/signature', [MeetingNoteController::class, 'uploadSignature']);
        Route::post('/meetings/{meeting}/note/{meetingNote}/finalize', [MeetingNoteController::class, 'finalize']);
        Route::delete('/meetings/{meeting}/note/{meetingNote}', [MeetingNoteController::class, 'destroy']);
    });
});
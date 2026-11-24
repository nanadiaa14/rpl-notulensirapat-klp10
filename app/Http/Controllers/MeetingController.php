<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MeetingController extends Controller
{
    # Menampilkan seluruh meeting
    public function index()
    {
        $meetings = Meeting::with(['creator', 'notulis'])
            ->milik(auth()->id())
            ->latest()
            ->get();
        
        return response()->json([
            'message' => 'Daftar meeting berhasil diambil.',
            'data' => $meetings,
        ]);
    }

    # Membuat meeting baru
    public function store(Request $request)
    {
        $request->merge(['topics' => $this->cleanTopics($request->input('topics'))]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'meeting_leader' => ['required', 'string', 'max:255'],
            'notulis_id' => ['nullable', 'integer', 'exists:users,id'],

            'topics' => ['required', 'array', 'min:1', 'max:20'],
            'topics.*' => ['required', 'string', 'max:500'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['notulis_id'] = $validated['notulis_id'] ?? auth()->id();

        $meeting = Meeting::create($validated);

        return response()->json([
            'message' => 'Meeting berhasil dibuat.',
            'data' => $meeting->load('notulis'),
        ], 201);
    }

    # Menampilkan detail sebuah meeting
    public function show(Meeting $meeting)
    {
        $meeting->load([
            'creator:id,name',
            'notulis:id,name',
            'transcript',
            'meetingNote',
        ]);

        return response()->json([
            'message' => 'Detail meeting berhasil diambil.',
            'data' => $meeting,
        ]);
    }

    # Memperbarui data meeting 
    public function update(Request $request, Meeting $meeting)
    {
        if ($meeting->isFinalized()) {
            return response()->json(['message' => 'Meeting yang notulennya sudah difinalisasi tidak dapat diubah.'], 422);
        }
        
        if ($request->has('topics')) {
            $request->merge(['topics' => $this->cleanTopics($request->input('topics'))]);
        }
        
        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'location' => ['sometimes', 'required', 'string', 'max:255'],
            'meeting_leader' => ['sometimes', 'required', 'string', 'max:255'],
            'notulis_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
        
            'topics' => ['sometimes', 'required', 'array', 'min:1', 'max:20'],
            'topics.*' => ['required', 'string', 'max:500'],
        
            'meeting_date' => ['sometimes', 'nullable', 'date'],
            'time_start' => ['sometimes', 'required_with:time_end', 'date_format:H:i,H:i:s'],
            'time_end' => ['sometimes', 'required_with:time_start', 'date_format:H:i,H:i:s', 'after:time_start'],
        ]);

        if (array_key_exists('meeting_date', $validated) || array_key_exists('time_start', $validated)) {
            $base = $validated['meeting_date'] ?? $meeting->meeting_date;
            $time = $validated['time_start'] ?? $meeting->time_start;
        
            if ($base && $time) {
                $validated['meeting_date'] = Carbon::parse($base)->setTimeFromTimeString($time);
            }
        }

        $meeting->update($validated);

        return response()->json([
            'message' => 'Meeting berhasil diperbarui.',
            'data' => $meeting->fresh(),
        ]);
    }

    # Upload audio meeting
    public function uploadAudio(Request $request, Meeting $meeting)
    {
        if ($meeting->isFinalized()) {
            return response()->json(['message' => 'Meeting yang notulennya sudah difinalisasi tidak dapat diubah.'], 422);
        }

        $validated = $request->validate([
            'audio' => ['required', 'file', 'mimes:mp3,wav,m4a,ogg,webm', 'max:102400'],
            'source' => ['required', 'in:record,upload'],

            // jalur rekam: waktu dari jam perangkat saat rekaman mulai dan berhenti
            'recorded_start_at' => ['required_if:source,record', 'date'],
            'recorded_end_at' => ['required_if:source,record', 'date', 'after:recorded_start_at'],

            // jalur upload: diisi manual oleh user
            'meeting_date' => ['required_if:source,upload', 'date'],
            'time_start' => ['required_if:source,upload', 'date_format:H:i'],
            'time_end' => ['required_if:source,upload', 'date_format:H:i', 'after:time_start'],

            'audio_duration' => ['nullable', 'integer', 'min:1'],
        ]);

        $tz = config('app.timezone');

        if ($validated['source'] === 'record') {
            $start = Carbon::parse($validated['recorded_start_at'])->timezone($tz);
            $end = Carbon::parse($validated['recorded_end_at'])->timezone($tz);
        } else {
            $date = Carbon::parse($validated['meeting_date'], $tz)->format('Y-m-d');
            $start = Carbon::parse($date . ' ' . $validated['time_start'], $tz);
            $end = Carbon::parse($date . ' ' . $validated['time_end'], $tz);
        }

        // durasi audio dari frontend (timer rekaman); kalau kosong, pakai selisih jam
        $duration = $validated['audio_duration'] ?? max(1, $end->getTimestamp() - $start->getTimestamp());

        if ($meeting->audio_path && Storage::disk('local')->exists($meeting->audio_path)) {
            Storage::disk('local')->delete($meeting->audio_path);
        }

        $audioPath = $request->file('audio')->store('meetings/' . $meeting->id . '/audio', 'local');

        $meeting->update([
            'audio_path' => $audioPath,
            'audio_duration' => $duration,
            'meeting_date' => $start,
            'time_start' => $start->format('H:i'),
            'time_end' => $end->format('H:i'),
        ]);

        return response()->json([
            'message' => 'Audio meeting berhasil diunggah.',
            'data' => $meeting->fresh(),
        ]);
    }

    public function audio(Meeting $meeting)
    {
        abort_unless(
            $meeting->audio_path && Storage::disk('local')->exists($meeting->audio_path),
            404,
            'File audio tidak ditemukan.'
        );

        return Storage::disk('local')->response($meeting->audio_path);
    }

    # Menghapus audio meeting.
    public function deleteAudio(Meeting $meeting)
    {
        if ($meeting->isFinalized()) {
            return response()->json(['message' => 'Meeting yang notulennya sudah difinalisasi tidak dapat diubah.'], 422);
        }

        if (!$meeting->audio_path) {
            return response()->json([
                'message' => 'Meeting belum memiliki file audio.',
            ], 404);
        }

        if (Storage::disk('local')->exists($meeting->audio_path)) {
            Storage::disk('local')->delete($meeting->audio_path);
        }

        $meeting->update([
            'audio_path' => null,
            'audio_duration' => null,
        ]);

        return response()->json([
            'message' => 'Audio meeting berhasil dihapus.',
        ]);
    }

    # Menghapus meeting.
    public function destroy(Meeting $meeting)
    {
        if ($meeting->isFinalized()) {
            return response()->json(['message' => 'Meeting yang notulennya sudah difinalisasi tidak dapat dihapus.'], 422);
        }

        $meeting->delete();
        Storage::disk('local')->deleteDirectory('meetings/' . $meeting->id);

        return response()->json(['message' => 'Meeting berhasil dihapus.']);
    }

    public function archive(Request $request)
    {
        $request->validate([
            'tanggal' => ['nullable', 'date'],
            'pimpinan' => ['nullable', 'string', 'max:255'],
            'q' => ['nullable', 'string', 'max:255'],
        ]);

        $meetings = Meeting::with('notulis')
            ->milik(auth()->id())
            ->whereHas('meetingNote', fn ($q) => $q->where('status', 'finalized'))
            ->when($request->filled('tanggal'), fn ($q) => $q->whereDate('meeting_date', $request->input('tanggal')))
            ->when($request->filled('pimpinan'), fn ($q) => $q->where('meeting_leader', 'like', '%' . $request->input('pimpinan') . '%'))
            ->when($request->filled('q'), function ($q) use ($request) {
                $keyword = '%' . $request->input('q') . '%';
                $q->where(fn ($w) => $w->where('title', 'like', $keyword)->orWhere('topics', 'like', $keyword));
            })
            ->latest('meeting_date')
            ->paginate(10)
            ->withQueryString();

        return view('notulensi.riwayat', ['meetings' => $meetings]);
    }

    private function cleanTopics(mixed $topics): array
    {
        return collect(is_array($topics) ? $topics : [])
            ->map(fn ($topic) => trim((string) $topic))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
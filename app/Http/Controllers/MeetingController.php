<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingController extends Controller
{
    # Menampilkan seluruh meeting
    public function index()
    {
        $meetings = Meeting::with('creator')
            ->latest('meeting_date')
            ->get();

        return response()->json([
            'message' => 'Daftar meeting berhasil diambil.',
            'data' => $meetings,
        ]);
    }

    # Membuat meeting baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'meeting_date' => ['required', 'date'],
            'meeting_leader' => ['required', 'string', 'max:255'],

            'topics' => ['required', 'array', 'min:1'],
            'topics.*' => ['required', 'string', 'max:500'],

            'time_start' => ['nullable', 'date_format:H:i'],
            'time_end' => ['nullable', 'date_format:H:i', 'after:time_start'],
        ]);

        $validated['created_by'] = auth()->id();

        $meeting = Meeting::create($validated);

        return response()->json([
            'message' => 'Meeting berhasil dibuat.',
            'data' => $meeting,
        ], 201);
    }

    # Menampilkan detail sebuah meeting
    public function show(Meeting $meeting)
    {
        $meeting->load([
            'creator',
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
        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'location' => ['sometimes', 'required', 'string', 'max:255'],
            'meeting_date' => ['sometimes', 'required', 'date'],
            'meeting_leader' => ['sometimes', 'required', 'string', 'max:255'],

            'topics' => ['sometimes', 'required', 'array', 'min:1'],
            'topics.*' => ['required', 'string', 'max:500'],

            'time_start' => ['nullable', 'date_format:H:i'],
            'time_end' => ['nullable', 'date_format:H:i', 'after:time_start'],
        ]);

        $meeting->update($validated);

        return response()->json([
            'message' => 'Meeting berhasil diperbarui.',
            'data' => $meeting->fresh(),
        ]);
    }

    # Upload audio meeting
    public function uploadAudio(Request $request, Meeting $meeting)
    {
        $validated = $request->validate([
            'audio' => [
                'required',
                'file',
                'mimes:mp3,wav,m4a,ogg,webm',
                'max:102400',
            ],

            'audio_duration' => [
                'nullable',
                'integer',
                'min:1',
            ],
        ]);

        if (
            $meeting->audio_path &&
            Storage::disk('public')->exists($meeting->audio_path)
        ) {
            Storage::disk('public')->delete($meeting->audio_path);
        }

        $audioPath = $request->file('audio')->store(
            'meetings/' . $meeting->id . '/audio',
            'public'
        );

        $meeting->update([
            'audio_path' => $audioPath,
            'audio_duration' => $validated['audio_duration'] ?? null,
        ]);

        return response()->json([
            'message' => 'Audio meeting berhasil diunggah.',
            'data' => [
                'meeting_id' => $meeting->id,
                'audio_path' => $meeting->audio_path,
                'audio_url' => Storage::url($meeting->audio_path),
                'audio_duration' => $meeting->audio_duration,
            ],
        ]);
    }

    # Menghapus audio meeting.
    public function deleteAudio(Meeting $meeting)
    {
        if (!$meeting->audio_path) {
            return response()->json([
                'message' => 'Meeting belum memiliki file audio.',
            ], 404);
        }

        if (Storage::disk('public')->exists($meeting->audio_path)) {
            Storage::disk('public')->delete($meeting->audio_path);
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
        if (
            $meeting->audio_path &&
            Storage::disk('public')->exists($meeting->audio_path)
        ) {
            Storage::disk('public')->delete($meeting->audio_path);
        }

        $meeting->delete();

        return response()->json([
            'message' => 'Meeting berhasil dihapus.',
        ]);
    }
}
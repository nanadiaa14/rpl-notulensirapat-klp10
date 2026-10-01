<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingNoteController extends Controller
{
    # Menampilkan notulen berdasarkan meeting_id
    public function show(Meeting $meeting)
    {
        $meetingNote = $meeting->meetingNote;

        if (!$meetingNote) {
            return response()->json(['message' => 'Notulen belum tersedia.'], 404);
        }

        return response()->json([
            'message' => 'Notulen berhasil diambil.',
            'data' => $meetingNote,
        ]);
    }

    # Membuat draft notulen
    public function store(Request $request, Meeting $meeting)
    {
        if ($meeting->meetingNote) {
            return response()->json(['message' => 'Meeting ini sudah memiliki notulen.'], 409);
        }

        $validated = $request->validate([
            'summary' => 'required|string',
        ]);

        $meetingNote = MeetingNote::create([
            'meeting_id' => $meeting->id,
            'summary' => $validated['summary'],
            'status' => 'draft',
        ]);

        return response()->json([
            'message' => 'Draft notulen berhasil dibuat.',
            'data' => $meetingNote,
        ], 201);
    }

    # Memperbarui isi notulen
    public function update(Request $request, Meeting $meeting, MeetingNote $meetingNote)
    {
        if (!$meetingNote->meeting_id != $meeting->id) {
            return response()->json(['message' => 'Notulen tidak sesuai dengan meeting.'], 404);
        }

        if ($meetingNote->status === 'finalized') {
            return response()->json(['message' => 'Notulen yang sudah difinalisasi tidak dapat diubah.'], 422);
        }

        $validated = $request->validate([
            'summary' => 'required|string',
        ]);

        $meetingNote->update([
            'summary' => $validated['summary'],
        ]);

        return response()->json([
            'message' => 'Notulen berhasil diperbarui.',
            'data' => $meetingNote->fresh(),
        ]);
    }

    # Upload e-signature
    public function uploadSignature(Request $request, Meeting $meeting, MeetingNote $meetingNote)
    {
        if (!$meetingNote->meeting_id != $meeting->id) {
            return response()->json(['message' => 'Notulen tidak sesuai dengan meeting.'], 404);
        }

        if ($meetingNote->status === 'finalized') {
            return response()->json(['message' => 'Notulen yang sudah difinalisasi tidak dapat diubah.'], 422);
        }

        $request->validate([
            'signature' => 'required|file|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Hapus signature lama jika ada
        if ($meetingNote->signature_path && Storage::disk('public')->exists($meetingNote->signature_path)) {
            Storage::disk('public')->delete($meetingNote->signature_path);
        }

        $signaturePath = $request->file('signature')->store(
            'meetings/' . $meeting->id . '/signatures',
            'public'
        );

        $meetingNote->update([
            'signature_path' => $signaturePath,
        ]);

        return response()->json([
            'message' => 'Tanda tangan berhasil diunggah.',
            'data' => [
                'signature_path' => $meetingNote->signature_path,
                'signature_url' => Storage::url($meetingNote->signature_path),
        ]]);
    }

    # Finalisasi notulen
    public function finalize(Meeting $meeting, MeetingNote $meetingNote)
    {
        if (!$meetingNote->meeting_id != $meeting->id) {
            return response()->json(['message' => 'Notulen tidak sesuai dengan meeting.'], 404);
        }

        if ($meetingNote->status === 'finalized') {
            return response()->json(['message' => 'Notulen sudah difinalisasi.'], 422);
        }

        if (!$meetingNote->signature_path) {
            return response()->json(['message' => 'Tanda tangan belum diunggah.'], 422);
        }

        $meetingNote->update([
            'status' => 'finalized',
            'signed_at' => now(),
        ]);

        return response()->json([
            'message' => 'Notulen berhasil difinalisasi.',
            'data' => $meetingNote->fresh(),
        ]);
    }

    # Menghapus draft notulen
    public function destroy(Meeting $meeting, MeetingNote $meetingNote)
    {
        if (!$meetingNote->meeting_id != $meeting->id) {
            return response()->json(['message' => 'Notulen tidak sesuai dengan meeting.'], 404);
        }

        if ($meetingNote->status === 'finalized') {
            return response()->json(['message' => 'Notulen yang sudah difinalisasi tidak dapat dihapus.'], 422);
        }

        // Hapus signature jika ada
        if ($meetingNote->signature_path && Storage::disk('public')->exists($meetingNote->signature_path)) {
            Storage::disk('public')->delete($meetingNote->signature_path);
        }

        $meetingNote->delete();

        return response()->json([
            'message' => 'Draft notulen berhasil dihapus.',
        ]);
    }
}

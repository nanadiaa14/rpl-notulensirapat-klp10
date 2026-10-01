<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Transcript;
use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    # Menampilkan transcript berdasarkan meeting_id
    public function show(Meeting $meeting)
    {
        $transcript = $meeting->transcript;

        if (!$transcript) {
            return response()->json(['message' => 'Transcript belum tersedia.'], 404);
        }

        return response()->json([
            'message' => 'Transcript berhasil diambil.',
            'data' => $transcript,
        ]);
    }

    # Membuat transcript baru  
    public function store(Request $request, Meeting $meeting)
    {
        if ($meeting->transcript) {
            return response()->json(['message' => 'Meeting ini sudah memiliki transcript.'], 400);
        }
        
        $validated = $request->validate([
            'raw_text' => 'required|string',
            'normalized_text' => 'nullable|string',
            'segments' => 'nullable|array',
            'segments.*.start' => 'nullable|numeric|min:0',
            'segments.*.end' => 'nullable|numeric|min:0',
            'segments.*.text' => 'nullable|string',
            'processing_status' => 'nullable|in:pending,processing,completed,failed',
        ]);

        $validated['meeting_id'] = $meeting->id;

        $validated['processing_status'] = $validated['processing_status'] ?? 'pending';

        $transcript = Transcript::create($validated);

        return response()->json([
            'message' => 'Transcript berhasil disimpan.',
            'data' => $transcript,
        ], 201);
    }

    # Memperbarui transcript  
    public function update(Request $request, Meeting $meeting, Transcript $transcript)
    {
        if (!$transcript->meeting_id != $meeting->id) {
            return response()->json(['message' => 'Transcript tidak sesuai dengan meeting.'], 404);
        }

        $validated = $request->validate([
            'raw_text' => 'sometimes|required|string',
            'normalized_text' => 'nullable|string',
            'segments' => 'nullable|array',
            'segments.*.start' => 'nullable|numeric|min:0',
            'segments.*.end' => 'nullable|numeric|min:0',
            'segments.*.text' => 'nullable|string',
            'processing_status' => 'sometimes|required|in:pending,processing,completed,failed',
        ]);

        $transcript->update($validated);

        return response()->json([
            'message' => 'Transcript berhasil diperbarui.',
            'data' => $transcript->fresh(),
        ]);
    }

    # Mengubah status proses transcript
    public function updateStatus(Request $request, Meeting $meeting)
    {
        $transcript = $meeting->transcript;

        if ($transcript) {
            return response()->json(['message' => 'Transcript belum tersedia.'], 404);
        }

        $validated = $request->validate([
            'processing_status' => 'required|in:pending,processing,completed,failed',
        ]);

        $transcript->update('processing_status', $validated['processing_status']);  

        return response()->json([
            'message' => 'Status proses transcript berhasil diperbarui.',
            'data' => $transcript,
        ]);
    }

    # Menghapus transcript
    public function destroy(Meeting $meeting, Transcript $transcript)
    {
        if ($transcript->meeting_id != $meeting->id) {
            return response()->json(['message' => 'Transcript tidak sesuai dengan meeting.'], 404);
        }

        $transcript->delete();

        return response()->json([
            'message' => 'Transcript berhasil dihapus.',
        ]);
    }
}

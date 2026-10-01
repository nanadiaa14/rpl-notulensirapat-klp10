<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'summary',
        'signature_path',
        'signed_at',
        'docx_path',
        'pdf_path',
        'status',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'notulis_id',
        'title',
        'location',
        'meeting_date',
        'meeting_leader',
        'topics',
        'time_start',
        'time_end',
        'audio_path',
        'audio_duration',
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
        'topics' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function transcript()
    {
        return $this->hasOne(Transcript::class);
    }

    public  function meetingNote()
    {
        return $this->hasOne(MeetingNote::class);
    }

    public function notulis()
    {
        return $this->belongsTo(User::class, 'notulis_id');
    }

    public function isFinalized(): bool
    {
        return $this->meetingNote?->status === 'finalized';
    }

    public function scopeMilik($query, int $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('created_by', $userId)->orWhere('notulis_id', $userId);
        });
    }
}

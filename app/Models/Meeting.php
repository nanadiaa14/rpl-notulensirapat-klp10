<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
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

    public function meetingNote()
    {
        return $this->hasOne(MeetingNote::class);
    }
}

<?php

namespace App\Policies;

use App\Models\Meeting;
use App\Models\User;

class MeetingPolicy
{
    public function view(User $user, Meeting $meeting): bool
    {
        return $user->id === $meeting->created_by || $user->id === $meeting->notulis_id;
    }
}
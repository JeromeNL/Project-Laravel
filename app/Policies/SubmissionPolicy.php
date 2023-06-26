<?php

namespace App\Policies;

use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;

class SubmissionPolicy
{
    public function showRatingsForSubmission(User $user, Submission $submission): bool
    {
        return $user->id === $submission->user_id || $submission->competition->owner_id === $user->id;
    }

    public function create(User $user, Competition $competition): bool
    {
        return ($user->isAcceptedForCompetition($competition) || (!$competition->private)) && $competition->users->contains($user);
    }
}

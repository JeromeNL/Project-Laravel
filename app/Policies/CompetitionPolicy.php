<?php

namespace App\Policies;

use App\Models\Competition;
use App\Models\Enums\CompetitionPublicationStatus;
use App\Models\User;

class CompetitionPolicy
{
    public function show(?User $user, Competition $competition)
    {
        if (is_null($user)) {
            return $competition->publication_status->value === CompetitionPublicationStatus::Published->value;
        }

        return $competition->publication_status->value === CompetitionPublicationStatus::Published->value || $competition->owner_id === $user->id || $user->competitions->contains('id', $competition->id);
    }

    public function createSubmission(User $user, Competition $competition)
    {
        $hasJoinedCompetition = $user->competitions->contains('id', $competition->id);

        if (!$hasJoinedCompetition) {
            abort(403, 'Je moet eerst deelnemen aan de competitie om een inzending te maken!');
        }

        return true;
    }

    public function evaluateSubmission(User $user, Competition $competition)
    {
        $hasJoinedCompetition = $user->competitions->contains('id', $competition->id);

        if ($hasJoinedCompetition) {
            return true;
        } else {
            abort(403, 'Je moet eerst deelnemen voordat je inzendingen kan beoordelen');
        }
    }
}

<?php

namespace App\Models\Enums;

enum CompetitionPublicationStatus: string
{
    case Draft = 'Concept';
    case Published = 'Gepubliceerd';

    public static function getPossiblePublicationStatuses()
    {
        return [
            CompetitionPublicationStatus::Draft,
            CompetitionPublicationStatus::Published,
        ];
    }
}

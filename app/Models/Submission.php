<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'submission_url',
    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function winnerOfCompetition(): belongsTo
    {
        return $this->belongsTo(Competition::class, 'winning_submission_id');
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function winningSubmissionQuotes(): HasMany
    {
        return $this->hasMany(WinningSubmissionQuote::class);
    }

    public function hasBeenRatedByUser($user): bool
    {
        return $this->ratings->contains('user_id', $user->id);
    }

    public function getHasMaximumWinnerQuotesAttribute(): bool
    {
        return $this->winningSubmissionQuotes->count() >= 3;
    }

    public function hasBeenPostedBy($user): bool
    {
        return $this->user->id === $user->id;
    }

    public function getIsWinningSubmissionAttribute(): bool
    {
        return $this->competition->winning_submission_id === $this->id;
    }

}

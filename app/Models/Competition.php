<?php

namespace App\Models;

use App\Models\Enums\CompetitionPublicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use function Symfony\Component\String\u;

/**
 * @mixin Builder
 */
class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'thumbnail_url', 'submissions_limit', 'publication_status', 'private'
    ];


    protected $casts = [
        'publication_status' => CompetitionPublicationStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function winningSubmission(): BelongsTo
    {
        return $this->belongsTo(Submission::class, 'winning_submission_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'competition_user')->withPivot('accepted');

    }

    public function customLink(): HasOne
    {
        return $this->hasOne(CustomLink::class, 'competition_id');
    }

    public function toggleActive(): void
    {
        $this->ended = !$this->ended;
        $this->save();
    }

    public function getUnlimitedSubmissionsAllowedAttribute(): bool
    {
        return $this->submissions_limit === 1024;
    }

    public function getStartedAttribute(): bool
    {
        return $this->start_date < now();
    }

    public function getPublishedAttribute(): bool
    {
        return $this->publication_status->value === CompetitionPublicationStatus::Published->value;
    }

    public function getPublishableAttribute(): bool
    {
        return $this->publication_status->value === CompetitionPublicationStatus::Draft->value && $this->end_date > now();
    }

    public function getHasEndDateAttribute(): bool
    {
        return $this['end_date'] != null;
    }

    public function getCustomLinkAliasAttribute(): string
    {
        $url = $this->customLink->link_url ?? '';

        if ($url === '') {
            return '';
        }

        return u($url)->afterLast('/')->toString();
    }

    public function getHasWinnerAttribute(): bool
    {
        return $this->winning_submission_id != null;
    }

    public function getHasCustomLinkAttribute(): bool
    {
        return $this->customLink()->exists();
    }

    public function hasReachedSubmissionsLimit(User $user): Bool{
        $amountOfSubmissions = $user->submissions->where('competition_id', $this->id)->count();
        $submissionsLimit = $this->submissions_limit;
        return $amountOfSubmissions >= $submissionsLimit;
    }

    public function setPrivateAttribute($value): void
    {
        $this->attributes['private'] = $value == 'private';
    }

}

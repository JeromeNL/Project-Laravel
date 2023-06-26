<?php

namespace App\Models;


use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @mixin Builder
 * @mixin Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function competitions(): belongsToMany
    {
        return $this->belongsToMany(Competition::class)->withPivot('accepted');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function isCompetitionOwner(Competition $competition): bool
    {
        return $this->id === $competition->owner_id;
    }

    public function isRatingOwner(Rating $rating): bool
    {
        return $this->id === $rating->user_id;
    }

    public function isAcceptedForCompetition(Competition $competition): bool
    {
        return $this->competitions()
            ->where('competition_id', $competition->id)
            ->wherePivot('accepted', true)
            ->exists();
    }

    public function hasBeenRemoved(Competition $competition): bool
    {
        return RemovedUser::where('competition_id', $competition->id)
            ->where('user_id', $this->id)
            ->exists();
    }
}

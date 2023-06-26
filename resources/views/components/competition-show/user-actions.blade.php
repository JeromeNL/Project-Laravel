<div>
    @if (!empty($joined) && !$joined->contains($competition->id) && $competition->started && $competition->published && !$competition->ended && !Auth::user()->hasBeenRemoved($competition))
        <a href="{{ route('user.join', $competition->id) }}" class="btn btn-primary align-self-start">Deelnemen</a>
    @endif
    @if (Auth::check() && Auth::user()->competitions->contains('id', $competition->id) && (Auth::user()->isAcceptedForCompetition($competition) || !$competition->private) && !$competition->hasReachedSubmissionsLimit(Auth::user())
             && !$competition->ended && $competition->start_date <= date("Y-m-d"))
        <a href="{{route('competition.submission.create', $competition->id)}}" class="btn btn-primary">Inzending maken</a>
    @endif
</div>

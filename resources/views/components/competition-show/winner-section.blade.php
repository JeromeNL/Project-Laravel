<div class="row">
    <div class="col">
        @if(!$competition->ended && Auth::check() && Auth::user()->isCompetitionOwner($competition))
            <p class="text-muted">De competitie is nog bezig, dus je kunt op het moment geen winnaar kiezen.
                Wel kun je de inzendingen beoordelen.</p>
            <hr>
        @else
            @if($competition->hasWinner)
                <div class="card mt-2 mb-3">
                    <div class="card-body">
                        <h2 class="fw-bold">Gefeliciteerd, {{$winnerEmail}}</h2>
                        <h4 class="mb-0">De competitie is gewonnen door <b>{{$winnerEmail}}</b> met de volgende
                            inzending:</h4>
                        <div class="d-flex justify-content-center p-1 border my-2 rounded-2">
                            @if($fileIsPdf)
                                <embed src="{{ url($winningSubmissionImage) ?? url($winningSubmissionUrl) }}"
                                       width="100%" height="900px" type="application/pdf">
                            @else
                                <img class="winner-image object-fit-contain img-fluid rounded"
                                     src="{{ $winningSubmissionUrl == '' ? asset($winningSubmissionImage) : $winningSubmissionUrl }}"
                                     alt="Winner image"
                                     onerror="this.onerror = null; this.src='{{ asset('images/fallback_image.png') }}'">
                            @endif
                        </div>
                        @if(Auth::check() && Auth::user()->isCompetitionOwner($competition) && !$winningSubmission->hasMaximumWinnerQuotes)
                            <form
                                class="row mb-2 g-1"
                                action="{{ route('submission.postWinnerText', $competition->winning_submission_id) }}"
                                method="POST">
                                @csrf
                                <div class="col-md-2">
                                    <input type="text" name="winner_name" class="form-control"
                                           placeholder="Voer een naam in">
                                    <x-validation-error name="winner_name"/>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="message" class="form-control"
                                           placeholder="Laat een bericht achter voor de winnaar!">
                                    <x-validation-error name="message"/>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-primary btn-block" type="submit">Verstuur</button>
                                </div>
                            </form>
                        @endif
                        <div class="row">
                            @foreach($winningSubmission->winningSubmissionQuotes as $quote)
                                <div class="col-12 col-md-4">
                                    <div class="card w-100">
                                        <blockquote class="blockquote card-body">
                                            <p class="fw-light card-text"
                                               style="height: 3em; overflow: hidden;">{{$quote->winner_text}}</p>
                                            <footer
                                                class="blockquote-footer card-subtitle">{{$quote->name}}</footer>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @elseif(Auth::check() && Auth::user()->isCompetitionOwner($competition))
                <p class="text-muted">De competitie is afgelopen. Er kan nu een winnaar gekozen worden door
                    de competitiebeheerder</p>
            @endif
        @endif
    </div>
</div>

<div class="d-flex justify-content-between align-items-center">
    @if((Auth::check() && !$submissions[$i]->is_winning_submission && ($submissions[$i]->hasBeenPostedBy(Auth::user()) || Auth::user()->isCompetitionOwner($competition))))
        <div class="modal fade" id="removeSubmissionModal{{$i}}" tabindex="-1"
             aria-labelledby="removeSubmissionModal{{$i}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Inzending
                            verwijderen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Weet je zeker dat je deze inzending wilt verwijderen?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Annuleren
                        </button>
                        <form method="post"
                              action="{{route('competition.submission.destroy', ['competition' => $competition, 'submission' => $submissions[$i]])}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Definitief
                                verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <i data-bs-toggle="modal" data-bs-target="#removeSubmissionModal{{$i}}"
           class="delete_button text-danger fa-sharp fa-solid fa-l fa-trash mt-4"></i>
    @endif
    @if($competition->ended && !$competition->hasWinner && Auth::check() && Auth::user()->isCompetitionOwner($competition))
        <form method="post"
              action="{{route('submission.pickWinner', $submissions[$i]->id)}}">
            @csrf
            <input type="hidden" name="competition_id"
                   value="{{$submissions[$i]->competition_id}}">
            <input type="hidden" name="submission_id"
                   value="{{$submissions[$i]->id}}">
            <button type="submit" class="mt-3 btn btn-secondary">Markeer als
                winnaar
            </button>
        </form>
    @endif
    <div class="d-flex justify-content-end">
        <a href="{{route('submissions.showRatingsForSubmission', $submissions[$i]->id)}}"
           class="btn btn-secondary mt-3">Bekijk beoordelingen</a>
    </div>
</div>

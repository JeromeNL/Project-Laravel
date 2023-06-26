@if(Auth::check() && (Auth::user()->isAcceptedForCompetition($competition) || (!$competition->private)) && !$competition->ended  && $joined->contains('id', $submissions[$i]->competition_id))
    @if(!$submissions[$i]->hasBeenRatedByUser(Auth::user()))
        <div class="rating-wrap">
            <form action="{{route('submission.postScore', $submissions[$i]->id)}}" method="POST">
                <div class="center">
                    @csrf
                    <div class="rating">
                        <input type="hidden" name="competition_id" value="{{$submissions[$i]->competition_id}}">
                        <input type="hidden" name="submission_id" value="{{$submissions[$i]->id}}">
                        <input type="radio" id={{"star5-".$i}} name={{"rating".$i}} value="5"/>
                        <label for={{"star5-".$i}} class="full" title="Awesome"></label>
                        <input type="radio" id={{"star4.5-".$i}} name={{"rating".$i}} value="4.5"/>
                        <label for={{"star4.5-".$i}} class="half"></label>
                        <input type="radio" id={{"star4-".$i}} name={{"rating".$i}} value="4"/>
                        <label for={{"star4-".$i}} class="full"></label>
                        <input type="radio" id={{"star3.5-".$i}} name={{"rating".$i}} value="3.5"/>
                        <label for={{"star3.5-".$i}} class="half"></label>
                        <input type="radio" id={{"star3-".$i}} name={{"rating".$i}} value="3"/>
                        <label for={{"star3-".$i}} class="full"></label>
                        <input type="radio" id={{"star2.5-".$i}} name={{"rating".$i}} value="2.5"/>
                        <label for={{"star2.5-".$i}} class="half"></label>
                        <input type="radio" id={{"star2-".$i}} name={{"rating".$i}} value="2"/>
                        <label for={{"star2-".$i}} class="full"></label>
                        <input type="radio" id={{"star1.5-".$i}} name={{"rating".$i}} value="1.5"/>
                        <label for={{"star1.5-".$i}} class="half"></label>
                        <input type="radio" id={{"star1-".$i}} name={{"rating".$i}} value="1"/>
                        <label for={{"star1-".$i}} class="full"></label>
                        <input type="radio" id={{"star0.5-".$i}} name={{"rating".$i}} value="0.5"/>
                        <label for={{"star0.5-".$i}} class="half"></label>
                    </div>
                </div>
                <textarea class="form-control mb-2" name="comment" id="comment" rows="4"
                          placeholder="Laat een comment achter!"></textarea>
                <x-validation-error name="rating"/>
                <x-validation-error name="comment"/>
                @if ($joined->contains('id', $submissions[$i]->competition_id))
                    <input type="submit" name="Beoordeel" value="Beoordeel" class="btn btn-primary">
                @endif
            </form>
        </div>
    @else
        <p class="text-muted">Reeds beoordeeld</p>
        <button class="mb-1 btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#edit-form-{{ $i }}"
                aria-expanded="false" aria-controls="edit-form-{{ $i }}">Bewerk
        </button>

        <div class="rating-wrap collapse" id="edit-form-{{ $i }}">
            <form action="{{ route('submission.updateScore', $submissions[$i]->id) }}" method="POST">
                <div class="center">
                    @csrf
                    <div class="rating">
                        @php($oldRating = $submissions[$i]->ratings()->where('user_id', Auth::id())->first()->rating)
                        <input type="hidden" name="competition_id" value="{{$submissions[$i]->competition_id}}">
                        <input type="hidden" name="submission_id" value="{{$submissions[$i]->id}}">
                        <input type="radio" id="{{ 'star5-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="5" {{ $oldRating == 5 ? 'checked' : '' }} />
                        <label for="{{ 'star5-'.$i }}" class="full" title="Awesome"></label>
                        <input type="radio" id="{{ 'star4.5-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="4.5" {{ $oldRating == 4.5 ? 'checked' : '' }} />
                        <label for="{{ 'star4.5-'.$i }}" class="half"></label>
                        <input type="radio" id="{{ 'star4-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="4" {{ $oldRating == 4 ? 'checked' : '' }} />
                        <label for="{{ 'star4-'.$i }}" class="full"></label>
                        <input type="radio" id="{{ 'star3.5-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="3.5" {{ $oldRating == 3.5 ? 'checked' : '' }} />
                        <label for="{{ 'star3.5-'.$i }}" class="half"></label>
                        <input type="radio" id="{{ 'star3-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="3" {{ $oldRating == 3 ? 'checked' : '' }} />
                        <label for="{{ 'star3-'.$i }}" class="full"></label>
                        <input type="radio" id="{{ 'star2.5-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="2.5" {{ $oldRating == 2.5 ? 'checked' : '' }} />
                        <label for="{{ 'star2.5-'.$i }}" class="half"></label>
                        <input type="radio" id="{{ 'star2-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="2" {{ $oldRating == 2 ? 'checked' : '' }} />
                        <label for="{{ 'star2-'.$i }}" class="full"></label>
                        <input type="radio" id="{{ 'star1.5-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="1.5" {{ $oldRating == 1.5 ? 'checked' : '' }} />
                        <label for="{{ 'star1.5-'.$i }}" class="half"></label>
                        <input type="radio" id="{{ 'star1-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="1" {{ $oldRating == 1 ? 'checked' : '' }} />
                        <label for="{{ 'star1-'.$i }}" class="full"></label>
                        <input type="radio" id="{{ 'star0.5-'.$i }}" name="{{ 'rating-'.$i }}"
                               value="0.5" {{ $oldRating == 0.5 ? 'checked' : '' }} />
                        <label for="{{ 'star0.5-'.$i }}" class="half"></label>
                    </div>
                </div>
                <textarea class="form-control mb-2" name="comment" id="comment" rows="4"
                          placeholder="Laat een comment achter!">{{ $submissions[$i]->ratings()->where('user_id', Auth::id())->first()->comment }}</textarea>
                <x-validation-error name="rating"/>
                <x-validation-error name="comment"/>
                @if ($joined->contains('id', $submissions[$i]->competition_id))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#update-modal-{{ $i }}">Update
                    </button>
            @endif
        </div>

        <div class="modal fade" id="update-modal-{{ $i }}" tabindex="-1" aria-labelledby="update-modal-label-{{ $i }}"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="update-modal-label-{{ $i }}">Beoordeling bijwerken</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Weet je zeker dat je deze beoordeling wilt bijwerken?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                        <input type="submit" name="Update" value="Update" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
        </form>
    @endif
@endif

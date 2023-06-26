<div>
    @if(Auth::check() && Auth::user()->isCompetitionOwner($competition))
        <hr>
        <div class="d-flex flex-row gap-1 flex-wrap">
            <a class="btn btn-primary"
               href="{{route('competition.edit', $competition)}}">Bewerken</a>
            @if($competition->publication_status == \App\Models\Enums\CompetitionPublicationStatus::Published)
                <form method="POST"
                      action="{{route('competition.toggleActive', $competition->id)}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="competition_id" value="{{$competition->id}}">
                    <button type="submit" class="btn btn-primary">
                        {{$competition->ended ? "Hervat" : "Stop"}} competitie
                    </button>
                </form>
            @endif
            @if($competition->publication_status == \App\Models\Enums\CompetitionPublicationStatus::Draft)
                <form method="post" action="{{ route('competition.publish', $competition) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary">Publiceren</button>
                </form>
            @endif
        </div>
        @if($competition->published && !$competition->hasCustomLink)
            <hr>
            <form method="POST" action="{{route('customlink.store', $competition)}}">
                @csrf
                <div>
                    <h5 class="m-0">Deelbare link aanmaken</h5>
                    <div class="my-2">
                        <p class="d-inline">{{url(Request::getSchemeAndHttpHost()) . "/uitnodiging/"}}</p>
                        <div class="d-inline-block">
                            <input class="form-control" name="custom_link"
                                   id="custom_link" type="text"
                                   placeholder="Zelfgekozen alias">
                        </div>
                        <x-validation-error name="custom_link"/>
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" value="Link aanmaken">
            </form>
        @elseif(!$competition->published)
            <hr>
            <p>De competitie is nog <b>als concept</b> opgeslagen. Pas
                als je de
                competitie
                gepubliceerd hebt, kun je hem delen.</p>
        @elseif($competition->hasCustomLink)
            <hr>
            <div class="d-block">
                <div class="d-inline-block">
                    <label for="custom_link">Deelbare link:</label>
                    <a id="custom_link"
                       href="{{url($customLink)}}">{{url($customLink)}}</a>
                    <span onclick="copyCustomLinkToClipboard()" id="copyButton"
                          class="input-group-addon btn"
                          title="Link kopiëren"><i
                            class="fa-regular fa-clipboard"></i></span>
                </div>
            </div>
        @endif
    @endif
</div>

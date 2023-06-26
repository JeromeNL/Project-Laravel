@php use App\Models\User;use Illuminate\Support\Facades\Auth; @endphp
<x-html title="Beoordelingen inzien">
    <h1>Beoordelingen inzien</h1>
    <h3>{{$submission->title}}</h3>
    <p class="mb-0">{{$submission->description}}</p>
    @if(pathinfo($submission->submission_url, PATHINFO_EXTENSION) == 'pdf' || pathinfo($submission->submission_image, PATHINFO_EXTENSION) == 'pdf')
        <embed
            src="{{ url($submission->submission_url == '' ? asset($submission->submission_image) : $submission->submission_url) }}"
            width="100%" height="250px" type="application/pdf">
    @else
        <img class="show-ratings-image my-4 img-fluid"
             src="{{ $submission->submission_url == '' ? asset($submission->submission_image) : $submission->submission_url }}"
             alt="Winner image"
             onerror="this.onerror = null; this.src='{{ asset('images/fallback_image.png') }}'">
    @endif

    @if (flash()->message)
        <div class="{{ flash()->class }}">
            {{ flash()->message }}
        </div>
    @endif

    @if($ratings->count() > 0)
        <div class="mb-2">
            <h5 class="d-inline">Gemiddelde score:</h5>
            <x-stars :amount="$averageScore"/>
        </div>
        <div class="row gy-2">
            @foreach($ratings as $rating)
                @php
                    $cardBackground = $rating->user_id == auth()->id() ? "bg-secondary text-light" : "bg-light";
                    /** @var User $user */
                    $user = Auth::user();
                    $isRatingOwner = $user !== null ? $user->isRatingOwner($rating) : false;
                @endphp
                @if($isRatingOwner)
                    <x-modal :id="'modal' . $rating->id">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Beoordeling
                                verwijderen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Weet je zeker dat je deze beoordeling wilt verwijderen?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                Annuleren
                            </button>
                            <form method="post" action="{{ route('ratings.destroy', $rating) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" dusk="deleteRating{{ $rating->id }}">
                                    Definitief verwijderen
                                </button>
                            </form>
                        </div>
                    </x-modal>
                @endif

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card rating_card">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item rating_header">
                                    @if($isRatingOwner)
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="submission_title me-2">
                                                <h4><span class="badge border border-success rounded-pill text-success">Mijn beoordeling</span>
                                                </h4>
                                            </div>
                                            <div>
                                                <i class="fa-trash fa-solid text-danger fa-xl mouse-hover"
                                                   data-bs-toggle="modal" data-bs-target="#modal{{ $rating->id }}"
                                                   dusk="openModal{{ $rating->id }}"></i>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                                <li class="list-group-item mt-1">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Beoordeling:
                                            <x-stars :amount="$rating->rating"/>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item mt-1">
                                    Opmerking: {{$rating->comment}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Er zijn nog geen beoordelingen voor deze inzending.</p>
    @endif
</x-html>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="row g-0">
                <div class="col-9 card-body">
                    <h2 class="submission_title">{{ $competition->title }}</h2>
                    <p class="submission_description">{{ $competition->description }}</p>
                    <div class="card-text mt-3">
                        <div>Aantal toegestane inzendingen: {{ $competition->submissions_limit }}</div>
                        <div>Startdatum: {{ date('d-m-Y', strtotime($competition->start_date)) }}</div>
                        <div>
                            @if($competition->has_end_date)
                                Einddatum: {{ date('d-m-Y', strtotime($competition->end_date)) }}
                            @else
                                Geen einddatum opgegeven.
                            @endif
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-competition-show.user-actions :competition="$competition" :joined="$joined"/>
                        <x-competition-show.owner-actions :competition="$competition" :customLink="$customLink"/>
                    </div>
                    <hr>
                    <div>Beheerder: {{ $competition->user->name }} {{ $competition->user->last_name }}</div>
                </div>
                <div class="col-3 px-0">
                    <img alt="Thumbnail voor de competitie met titel {{$competition->title}}"
                         class="w-100 object-fit-contain competition-header-image"
                         src="{{ $competition->thumbnail_url }}"
                         onerror="this.onerror = null; this.src='{{ asset('images/fallback_image.png') }}'">
                </div>
            </div>
        </div>
    </div>
</div>

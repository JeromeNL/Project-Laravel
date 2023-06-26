<div class="card competition-card">
    <img class="card-img-top" src="{{ $competition->thumbnail_url  }}" alt="{{$competition->title}}"
         onerror="this.onerror = null; this.src='{{ asset('images/fallback_image.png') }}'">
    <div class="card-body d-flex flex-column" style="max-height: 25rem">
        <div class="overflow-hidden d-flex flex-column mb-1 flex-grow-1">
            <h2 class="comp_title">{{ $competition->title }}</h2>
            <p class="comp_description">{{ $competition->description }}</p>
        </div>
        <div class="m-1">
            @if(!$competition->started)
                <h5><span class="badge border border-primary rounded-pill text-primary">Start binnenkort</span></h5>
            @elseif($competition->ended)
                <h5><span class="badge border border-danger rounded-pill text-danger">Afgelopen</span></h5>
            @elseif (!empty($joined) && $joined->contains($competition))
                <h5><span class="badge border border-success rounded-pill text-success">Reeds deelgenomen</span></h5>
            @endif
        </div>
        <div class="gap-2 d-flex flex-column">
            <ul class="list-group">
                <li class="list-group-item">
                    Startdatum: {{ date('d-m-Y', strtotime($competition->start_date)) }}
                </li>
                @if ($competition->end_date != null)
                    <li class="list-group-item">
                        Einddatum: {{ date('d-m-Y', strtotime($competition->end_date)) }}
                    </li>
                @else
                    <li class="list-group-item">
                        Geen einddatum opgegeven
                    </li>
                @endif
            </ul>
            <div class="row">
                <div class="col">
                    @auth()
                        @if($competition->publishable)
                            <form class="d-inline" method="POST"
                                  action="{{route('competition.publish', $competition->id)}}">
                                <input class="btn btn-primary" type="submit" value="Publiceren">
                                @method('PATCH')
                                @csrf
                            </form>
                        @endif
                    @endauth()
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="{{route('competition.show', $competition->id)}}"
                       class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
    </div>
</div>

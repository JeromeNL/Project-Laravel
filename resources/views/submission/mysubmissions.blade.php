<x-html title="Mijn inzendingen">
    <h1>Mijn inzendingen</h1>
    <div class="row">
        @foreach($mySubmissions as $index => $submissions)
            <div class="col-12 col-md-6 col-xl-4 mb-3">
                <div class="card submission-card">
                    @if(pathinfo($submissions->submission_url, PATHINFO_EXTENSION) == 'pdf' || pathinfo($submissions->submission_image, PATHINFO_EXTENSION) == 'pdf')
                        <embed
                            src="{{ url($submissions->submission_url == '' ? asset($submissions->submission_image) : $submissions->submission_url) }}"
                            width="100%" height="250px" type="application/pdf">
                    @else
                        <img class="card-img-top object-fit-contain object-position-bottom"
                             src="{{ $submissions->submission_url == '' ? asset($submissions->submission_image) : $submissions->submission_url }}"
                             alt="{{$submissions->title}}"
                             onerror="this.onerror = null; this.src='{{ asset('images/fallback_image.png') }}'">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h2 class="flex-grow-1 lines-2">{{ $submissions->competition->title }}</h2>
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <a href="{{route('submissions.showRatingsForSubmission', $submissions->id)}}"
                               class="btn btn-primary">Bekijk beoordelingen</a>
                            <a href="{{route('competition.show', $submissions->competition->id)}}"
                               class="btn btn-primary">Competitie details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-html>

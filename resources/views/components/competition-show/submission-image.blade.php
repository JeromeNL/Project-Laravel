<body>
<div>
    @if(pathinfo($submissions[$i]->submission_url, PATHINFO_EXTENSION) == 'pdf' || pathinfo($submissions[$i]->submission_image, PATHINFO_EXTENSION) == 'pdf')
        <embed
            src="{{ url($submissions[$i]->submission_url == '' ? asset($submissions[$i]->submission_image) : $submissions[$i]->submission_url) }}"
            width="100%" height="250px" type="application/pdf">
    @else
        <a href="{{ $submissions[$i]->submission_url == '' ? asset($submissions[$i]->submission_image) : $submissions[$i]->submission_url }}" data-toggle="lightbox">
            <img class="card-img-top object-fit-contain"
                 src="{{ $submissions[$i]->submission_url == '' ? asset($submissions[$i]->submission_image) : $submissions[$i]->submission_url }}"
                 alt="{{$submissions[$i]->title}}"
                 onerror="this.onerror = null; this.src='{{ asset('images/fallback_image.png') }}'">
        </a>
    @endif
</div>
</body>

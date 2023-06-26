<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="row">
        @for($i = 0; $i < count($submissions); $i++)
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card mt-3">
                    <x-competition-show.submission-image :submissions="$submissions" :i="$i"/>

                    <div class="card-body">
                        <h4 class="submission_title card-title">{{ $submissions[$i]->title }}</h4>
                        <p class="submission_description card-text">{{ $submissions[$i]->description }}</p>
                        <p>Gemiddelde beoordeling:
                            <x-stars
                                :amount="round($submissions[$i]->ratings->avg('rating'), 1)"/>
                        </p>
                        <x-competition-show.submission-rating :competition="$competition" :submissions="$submissions" :i="$i" :user="$user" :joined="$joined"/>
                        <x-competition-show.submission-actions :submissions="$submissions" :i="$i" :competition="$competition"/>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>

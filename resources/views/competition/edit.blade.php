<x-html title="Competitie bewerken">
    <head>
        <script defer src="{{ asset('js/charactercount.js') }}"></script>
        <title>Competitie bewerken</title>
    </head>
    <div class="d-flex justify-content-center">
        <div class="card mx-auto">
            <div class="card-header">
                <h1>Competitie '{{$competition->title}}' bewerken</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('competition.update', $competition)}}" class="needs-validation"
                      novalidate>
                    @method('PUT')
                    <div class="form-group">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Titel <span class="text-danger">*</span></label>
                            <input maxlength="45" type="text" name="title" id="title" value="{{ old('title', $competition->title) }}"
                                   class="form-control">
                            <div>
                                <small><span id="title-counter">{{ 45 - strlen(old('title', $competition->title)) }}</span> karakters resterend</small>
                            </div>
                            @foreach($errors->get('title') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Beschrijving</label>
                            <textarea maxlength="200" name="description" id="description" class="form-control">{{ old('description', $competition->description) }}</textarea>
                            <div>
                                <small><span id="description-counter">{{ 200 - strlen(old('description', $competition->description)) }}</span> karakters resterend</small>
                            </div>
                            @foreach($errors->get('description') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="start_date">Startdatum <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                   value="{{ old('start_date', $competition->start_date) }}">
                            <x-validation-error name="start_date"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="date">Einddatum</label>
                            <input type="date" id="date" name="end_date" class="form-control"
                                   @if ($competition->end_date) value="{{ old('end_date', date('Y-m-d', strtotime($competition->end_date))) }}" @endif>
                            <x-validation-error name="end_date"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="thumbnail_url">Thumbnail</label>
                            <input type="url" name="thumbnail_url" id="thumbnail_url" class="form-control"
                                   value="{{ old('thumbnail_url') ?? $competition->thumbnail_url }}">
                            <x-validation-error name="thumbnail_url"/>
                            <p class="text-muted">Vul hierboven de URL in van een afbeelding die je wilt gebruiken als
                                thumbnail van de competitie.</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="submissions_limit">Inzendingen per gebruiker <span
                                    class="text-danger">*</span></label>
                            <select class="form-select mr-sm-2" id="submissions_limit" name="submissions_limit">
                                @for($i = $competition->submissions_limit; $i <= 5; $i++)
                                    <option @if($i == $competition->submissions_limit) selected @endif
                                    value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <p class="text-muted">Het is enkel mogelijk om het limiet omhoog aan te passen.</p>
                            <x-validation-error name="submissions_limit"/>
                        </div>
                        @if($competition->submissions()->count() == 0)
                            <div class="mb-3">
                                <label class="form-label" for="publication_status">Welke publicatiestatus wil je
                                    toekennen aan de competitie?</label>
                                <select name="publication_status" class="form-select" aria-label="publication_status">
                                    @foreach($possiblePublicationStatuses as $status)
                                        <option @if($status === $competition->publication_status) selected @endif
                                        value="{{$status}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mb-3 d-block">
                            <label for="custom_link">Deelbare link</label>
                            <br>
                            <div class="d-inline-block">
                                <p class="mt-2">{{url(Request::getSchemeAndHttpHost()) . "/uitnodiging/"}}</p>
                            </div>
                            <div class="d-inline-block">
                                <input class="form-control" name="custom_link"
                                       id="custom_link" type="text"
                                       placeholder="Zelfgekozen alias"
                                       value="{{old('custom_link') ?? $competition->custom_link_alias}}">
                            </div>
                            <x-validation-error name="custom_link"/>
                        </div>
                        <p id="submission-method-error" class="text-danger">* Verplichte velden</p>
                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" value="Aanpassen">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-html>
